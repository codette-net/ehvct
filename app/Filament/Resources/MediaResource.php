<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Filament\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('file_path')
                ->label('Image')
                ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('media')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif',])
                    ->maxSize(5120)
                    ->required(),

                Forms\Components\TextInput::make('alt_text')
                    ->label('alt text')
                    ->required()
                    ->maxLength(160),

                Forms\Components\TextInput::make('title')
                    ->maxLength(120),

                Forms\Components\Textarea::make('caption')
                ->rows(2),

                Forms\Components\TextInput::make('credits')
                ->maxLength(120),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->disk('public')
                    ->square(),
                Tables\Columns\TextColumn::make('alt_text')->limit(50)->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
