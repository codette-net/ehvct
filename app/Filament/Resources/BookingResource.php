<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingCanceledMail;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use App\Services\MolliePayments;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Customer')->schema([
                Forms\Components\TextInput::make('reference')->disabled(),
                Forms\Components\TextInput::make('name')->disabled(),
                Forms\Components\TextInput::make('email')->disabled(),
                Forms\Components\TextInput::make('phone')->disabled(),
            ])->columns(2),

            Forms\Components\Section::make('Booking')->schema([
                Forms\Components\TextInput::make('people_count')->disabled(),
                Forms\Components\TextInput::make('unit_price_cents')->disabled(),
                Forms\Components\TextInput::make('total_amount_cents')->disabled(),
                Forms\Components\TextInput::make('currency')->disabled(),
                Forms\Components\TextInput::make('status')->disabled(),
                Forms\Components\DateTimePicker::make('paid_at')->disabled(),
                Forms\Components\DateTimePicker::make('confirmed_at')->disabled(),
                Forms\Components\DateTimePicker::make('canceled_at')->disabled(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('reference')->searchable(),
                Tables\Columns\TextColumn::make('slot.starts_at')->label('When')->dateTime('D d M, H:i')->sortable(),
                Tables\Columns\TextColumn::make('slot.variant.tour.title')->label('Tour')->searchable(),
                Tables\Columns\TextColumn::make('people_count')->label('People')->sortable(),
                Tables\Columns\TextColumn::make('total_amount_cents')
                    ->label('Total')
                    ->formatStateUsing(fn(Booking $record) => '€ ' . number_format($record->total_amount_cents / 100, 2))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'pending',
                        'paid' => 'paid',
                        'confirmed' => 'confirmed',
                        'canceled' => 'canceled',
                        'expired' => 'expired',
                        'failed' => 'failed',
                        'refunded' => 'refunded',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), Tables\Actions\Action::make('cancel')
                    ->label('Admin Cancel booking')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('reason')
                            ->label('Reason (sent to customer)')
                            ->rows(3)
                            ->maxLength(500)
                            ->required(),
                    ])
                    ->visible(fn(Booking $record) => in_array($record->status, ['pending', 'confirmed', 'paid'], true))
                    ->action(function (Booking $record, array $data) {
                        if ($record->status === 'canceled') return;

                        $record->update([
                            'status' => 'canceled',
                            'canceled_at' => now(),
                            'canceled_reason' => $data['reason'],
                        ]);

                        try {
                            Mail::to($record->email)->send(new BookingCanceledMail($record));

                            Notification::make()
                                ->title('Booking canceled')
                                ->body('Customer email sent.')
                                ->success()
                                ->send();
                        } catch (\Throwable $e) {
                            Log::error('Cancel email failed', [
                                'booking_id' => $record->id,
                                'reference' => $record->reference,
                                'error' => $e->getMessage(),
                            ]);

                            Notification::make()
                                ->title('Booking canceled')
                                ->body('Canceled, but email could not be sent. You can retry later.')
                                ->warning()
                                ->send();
                        }
                    }),
                Tables\Actions\Action::make('cancel_payment')
                    ->label('Cancel payment')
                    ->color('warning')
                    ->icon('heroicon-o-no-symbol')
                    ->requiresConfirmation()
                    ->visible(function (Booking $record) {
                        return $record->status === 'pending'
                            && optional($record->payment)->provider_status === 'open';
                    })
                    ->action(function (Booking $record, MolliePayments $molliePayments) {
                        try {
                            $molliePayments->cancelPaymentForBooking($record);

                            Notification::make()
                                ->title('Payment canceled')
                                ->body('The Mollie payment and booking were canceled.')
                                ->success()
                                ->send();
                        } catch (\Throwable $e) {
                            Log::error('Cancel Mollie payment failed', [
                                'booking_id' => $record->id,
                                'reference' => $record->reference,
                                'error' => $e->getMessage(),
                            ]);

                            Notification::make()
                                ->title('Could not cancel payment')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
                Tables\Actions\Action::make('refund_payment')
                    ->label('Refund')
                    ->color('info')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\TextInput::make('amount_cents')
                            ->label('Refund amount (cents)')
                            ->numeric()
                            ->default(fn (Booking $record) => $record->total_amount_cents)
                            ->required()
                            ->helperText('Use full booking amount for full refund.'),
                    ])
                    ->visible(function (Booking $record) {
                        return in_array($record->status, ['confirmed', 'paid'], true)
                            && optional($record->payment)->provider_status === 'paid';
                    })
                    ->action(function (Booking $record, array $data, MolliePayments $molliePayments) {
                        try {
                            $molliePayments->refundPaymentForBooking(
                                $record,
                                (int) $data['amount_cents']
                            );

                            Notification::make()
                                ->title('Refund created')
                                ->body('Refund was sent to Mollie and booking marked refunded.')
                                ->success()
                                ->send();
                        } catch (\Throwable $e) {
                            Log::error('Refund Mollie payment failed', [
                                'booking_id' => $record->id,
                                'reference' => $record->reference,
                                'error' => $e->getMessage(),
                            ]);

                            Notification::make()
                                ->title('Could not create refund')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ],

            );
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
