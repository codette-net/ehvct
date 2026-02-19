<?php

namespace App\Filament\Resources\TourResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('label')
                ->required()
                ->maxLength(60),

            Forms\Components\TextInput::make('duration_minutes')
                ->numeric()
                ->minValue(1)
                ->nullable(),

            Forms\Components\TextInput::make('price_per_person_cents')
                ->label('Price per person (cents)')
                ->numeric()
                ->required()
                ->minValue(0),

            Forms\Components\Select::make('currency')
                ->options(['EUR' => 'EUR'])
                ->default('EUR')
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('label')->sortable(),
            Tables\Columns\TextColumn::make('duration_minutes')->label('Min')->sortable(),
            Tables\Columns\TextColumn::make('price_per_person_cents')->label('Cents')->sortable(),
            Tables\Columns\TextColumn::make('currency')->sortable(),
        ])->headerActions([
            Tables\Actions\CreateAction::make(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }
}
