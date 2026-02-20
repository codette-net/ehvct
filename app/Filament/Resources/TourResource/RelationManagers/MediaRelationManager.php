<?php

namespace App\Filament\Resources\TourResource\RelationManagers;

use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    public function form(Form $form): Form
    {
        return $form->schema([
            // This form edits the PIVOT fields (role, sort_order) + can also edit Media if you want.
            // We'll keep Media metadata editing in MediaResource, and here only set attachment fields.

            Forms\Components\Select::make('id')
                ->label('Media')
                ->options(fn () => Media::query()->latest()->limit(200)->pluck('alt_text', 'id'))
                ->searchable()
                ->required()
                ->helperText('Attach an existing image from the Media library.'),

            Forms\Components\Select::make('pivot.role')
                ->label('Role')
                ->options([
                    'cover' => 'Cover',
                    'gallery' => 'Gallery',
                ])
                ->default('gallery')
                ->required(),

            Forms\Components\TextInput::make('pivot.sort_order')
                ->numeric()
                ->default(0)
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order') // uses pivot column
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->disk('public')
                    ->label('Image')
                    ->square(),

                Tables\Columns\TextColumn::make('alt_text')->label('Alternative text')->limit(40),

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
                    ->recordSelectSearchColumns(['alt_text', 'title'])
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),

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
                    ->mutateFormDataUsing(function (array $data): array {
                        // AttachAction stores pivot fields directly in $data
                        // Ensure pivot column names match your pivot schema:
                        return [
                            'role' => $data['role'],
                            'sort_order' => (int) $data['sort_order'],
                        ];
                    }),

                Tables\Actions\CreateAction::make()
                    ->label('Upload new media')
                    ->modalHeading('Upload new image to Media library')
                    ->using(function (array $data) {
                        // Keep uploads in MediaResource usually.
                        // You can remove this action if you want all uploads only from MediaResource.
                        return Media::create($data);
                    })
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
                Tables\Actions\EditAction::make()
                    ->label('Edit attachment')
                    ->form([
                        Forms\Components\Select::make('pivot.role')
                            ->label('Role')
                            ->options([
                                'cover' => 'Cover',
                                'gallery' => 'Gallery',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('pivot.sort_order')
                            ->numeric()
                            ->required(),
                    ]),

                Tables\Actions\DetachAction::make(),
            ]);
    }
}
