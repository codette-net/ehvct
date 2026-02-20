<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourResource\Pages;
use App\Filament\Resources\TourResource\RelationManagers;
use App\Filament\Resources\TourResource\RelationManagers\VariantsRelationManager;
use App\Filament\Resources\TourResource\RelationManagers\MediaRelationManager;
use App\Models\Tour;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TourResource extends Resource
{
    protected static ?string $model = Tour::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
            ]),

            Forms\Components\TextInput::make('meeting_point')->maxLength(255),
            Forms\Components\Toggle::make('is_active')->default(true),

            Forms\Components\RichEditor::make('description')
                ->columnSpanFull()
                ->default('')
                ->formatStateUsing(fn ($state) => is_string($state) ? $state : '')
                ->afterStateHydrated(fn ($component, $state) => $component->state(is_string($state) ? $state : ''))
                ->dehydrateStateUsing(fn ($state) => $state ?? ''),

            Forms\Components\RichEditor::make('highlights')
                ->columnSpanFull()
                ->default('')
                ->formatStateUsing(fn ($state) => is_string($state) ? $state : '')
                ->afterStateHydrated(fn ($component, $state) => $component->state(is_string($state) ? $state : ''))
                ->dehydrateStateUsing(fn ($state) => $state ?? ''),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_active')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            VariantsRelationManager::class,

            MediaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
