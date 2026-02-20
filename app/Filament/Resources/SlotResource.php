<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlotResource\Pages;
use App\Models\Slot;
use App\Models\TourVariant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SlotResource extends Resource
{
    protected static ?string $model = Slot::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Slots';
    protected static ?string $navigationGroup = 'Bookings';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Slot')->schema([
                Forms\Components\Select::make('tour_variant_id')
                    ->label('Tour variant')
                    ->options(function () {
                        return TourVariant::query()
                            ->with('tour')
                            ->orderByDesc('id')
                            ->get()
                            ->mapWithKeys(fn (TourVariant $v) => [
                                $v->id => $v->tour->title . ' — ' . $v->label,
                            ])
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),

                Forms\Components\DateTimePicker::make('starts_at')
                    ->seconds(false)
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options(['active' => 'Active', 'canceled' => 'Canceled'])
                    ->default('active')
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('Capacity')->schema([
                Forms\Components\TextInput::make('min_people')->numeric()->minValue(1)->default(1)->required(),
                Forms\Components\TextInput::make('max_people')->numeric()->minValue(1)->default(10)->required(),
            ])->columns(2),

            Forms\Components\Section::make('Cutoffs')->schema([
                Forms\Components\TextInput::make('booking_cutoff_hours')->numeric()->minValue(0)->default(2)->required(),
                Forms\Components\TextInput::make('cancel_cutoff_hours')->numeric()->minValue(0)->default(24)->required(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('starts_at', 'asc')
            ->modifyQueryUsing(fn (Builder $query) => $query->with(['variant.tour']))
            ->columns([
                Tables\Columns\TextColumn::make('starts_at')
                    ->dateTime('D d M Y, H:i')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('variant.tour.title')
                    ->label('Tour')
                    ->searchable(),

                Tables\Columns\TextColumn::make('variant.label')
                    ->label('Variant')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')->badge(),

                Tables\Columns\TextColumn::make('max_people')->label('Max')->sortable(),

                Tables\Columns\TextColumn::make('booked')
                    ->label('Booked')
                    ->state(fn (Slot $record) => $record->confirmedSeats()),

                Tables\Columns\TextColumn::make('left')
                    ->label('Left')
                    ->state(fn (Slot $record) => $record->remainingSeats()),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['active' => 'Active', 'canceled' => 'Canceled'])
                    ->default('active'),

                Tables\Filters\Filter::make('upcoming')
                    ->query(fn (Builder $q) => $q->where('starts_at', '>=', now()))
                    ->default(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSlots::route('/'),
            'create' => Pages\CreateSlot::route('/create'),
            'edit' => Pages\EditSlot::route('/{record}/edit'),
        ];
    }
}
