<?php

namespace App\Filament\Resources\TourResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('alt_text')
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->disk('public')
                    ->label('Image')
                    ->square(),

                Tables\Columns\TextColumn::make('alt_text')
                    ->label('Alternative text')
                    ->limit(40),

                Tables\Columns\TextColumn::make('pivot.role')
                    ->badge()
                    ->label('Role'),

                Tables\Columns\TextColumn::make('pivot.sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Attach media')
                    ->form([
                        Forms\Components\Select::make('recordId')
                            ->label('Media')
                            ->options(fn () => \App\Models\Media::query()
                                ->orderByDesc('id')
                                ->pluck('alt_text', 'id')
                                ->toArray()
                            )
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('role')
                            ->options([
                                'cover' => 'Cover',
                                'gallery' => 'Gallery',
                            ])
                            ->default('gallery')
                            ->required(),

                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        // $data['recordId'] is guaranteed now
                        $this->getOwnerRecord()->media()->attach((int) $data['recordId'], [
                            'role' => $data['role'],
                            'sort_order' => (int) $data['sort_order'],
                        ]);
                    }),

                Tables\Actions\CreateAction::make()
                    ->label('Upload new media')
                    ->modalHeading('Upload new image to Media library')
                    ->form([
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Image')
                            ->image()
                            ->disk('public')
                            ->directory('media')
                            ->required(),

                        Forms\Components\TextInput::make('alt_text')
                            ->required()
                            ->maxLength(160),

                        Forms\Components\TextInput::make('title')->maxLength(120),
                        Forms\Components\Textarea::make('caption')->rows(2),
                        Forms\Components\TextInput::make('credits')->maxLength(120),
                    ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
                Tables\Actions\EditAction::make()
                    ->label('Edit attachment')
                    ->form([
                        Forms\Components\Select::make('pivot.role')
                            ->options([
                                'cover' => 'Cover',
                                'gallery' => 'Gallery',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('pivot.sort_order')
                            ->numeric()
                            ->required(),
                    ])
                    ->mutateFormDataUsing(function (array $data): array {
                        // Ensure pivot updates are applied:
                        return [
                            'pivot' => [
                                'role' => $data['pivot']['role'] ?? 'gallery',
                                'sort_order' => (int) ($data['pivot']['sort_order'] ?? 0),
                            ],
                        ];
                    }),
            ]);
    }
}
