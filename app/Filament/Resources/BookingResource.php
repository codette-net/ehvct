<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                    ->label('Total (cents)')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('cancel')
                    ->label('Cancel')
                    ->requiresConfirmation()
                    ->visible(fn (Booking $record) => in_array($record->status, ['pending','confirmed','paid'], true))
                    ->action(function (Booking $record) {
                        $record->update([
                            'status' => 'canceled',
                            'canceled_at' => now(),
                        ]);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'edit'  => Pages\EditBooking::route('/{record}/edit'),
//            'view' => Pages\EditBooking::route('/{record}/edit'),
//            php artisan make:filament-page ViewBooking --resource=BookingResource --type=view
        ];
    }
}
