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
                Forms\Components\DatePicker::make('refunded_at')->disabled(),
                Forms\Components\Textarea::make('canceled_reason')->disabled()
                    ->rows(3)
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'refunded' => 'info',
                        'canceled' => 'warning',
                        'failed', 'expired' => 'danger',
                        'pending' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
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
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('cancel_booking')
                    ->label('Cancel booking')
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Placeholder::make('cutoff_info')
                            ->label('Cancellation policy')
                            ->content(function (Booking $record) {
                                $cutoff = $record->slot->starts_at->copy()->subHours((int)$record->slot->cancel_cutoff_hours);

                                return $record->canCancel()
                                    ? 'This booking is still before the cancellation cutoff.'
                                    : 'This booking is past the cancellation cutoff.';
                            }),

                        Forms\Components\Textarea::make('reason')
                            ->label('Reason (sent to customer)')
                            ->rows(3)
                            ->maxLength(500)
                            ->required(),

                        Forms\Components\Toggle::make('override_cutoff')
                            ->label('Allow cancellation even after cutoff')
                            ->default(false)
                            ->visible(fn(Booking $record) => !$record->canCancel()),
                    ])
                    ->visible(fn(Booking $record) => in_array($record->status, ['pending', 'confirmed', 'paid'], true))
                    ->action(function (Booking $record, array $data, MolliePayments $molliePayments) {
                        $beforeCutoff = $record->isBeforeCancellationCutoff();
                        $override = (bool)($data['override_cutoff'] ?? false);

                        if (!$beforeCutoff && !$override) {
                            Notification::make()
                                ->title('Past cancellation cutoff')
                                ->body('This booking is past the cancellation cutoff. Enable override if you still want to cancel it.')
                                ->warning()
                                ->send();

                            return;
                        }

                        $record->update([
                            'canceled_reason' => $data['reason'],
                        ]);

                        try {
                            $result = $molliePayments->cancelOrRefundBooking($record);

                            try {
                                Mail::to($record->email)->send(new BookingCanceledMail($record));

                                Notification::make()
                                    ->title('Booking updated')
                                    ->body(
                                        $result === 'refunded'
                                            ? 'Booking refunded and customer email sent.'
                                            : 'Booking canceled and customer email sent.'
                                    )
                                    ->success()
                                    ->send();
                            } catch (\Throwable $mailException) {
                                Log::error('Cancel/refund email failed', [
                                    'booking_id' => $record->id,
                                    'reference' => $record->reference,
                                    'error' => $mailException->getMessage(),
                                ]);

                                Notification::make()
                                    ->title('Booking updated')
                                    ->body(
                                        $result === 'refunded'
                                            ? 'Booking refunded, but customer email could not be sent.'
                                            : 'Booking canceled, but customer email could not be sent.'
                                    )
                                    ->warning()
                                    ->send();
                            }
                        } catch (\Throwable $e) {
                            Log::error('Cancel/refund booking failed', [
                                'booking_id' => $record->id,
                                'reference' => $record->reference,
                                'error' => $e->getMessage(),
                            ]);

                            Notification::make()
                                ->title('Could not cancel booking')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ]);
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
