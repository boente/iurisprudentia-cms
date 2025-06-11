<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollectionResource\Pages;
use App\Models\Collection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Collection Details')
                    ->columnSpanFull()
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->schema([
                                Forms\Components\Section::make('Basic Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('id')
                                            ->label('ID')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->readonly(),
                                        Forms\Components\TextInput::make('data.name')
                                            ->label('Name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('data.col_id')
                                            ->label('Collection ID')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('data.crowd_id')
                                            ->label('Crowd ID')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('data.editionName')
                                            ->label('Edition Name')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('data.editionLink')
                                            ->label('Edition Link')
                                            ->required()
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Visual Assets')
                                    ->schema([
                                        Forms\Components\FileUpload::make('data.background')
                                            ->label('Background')
                                            ->disk('assets_backgrounds')
                                            ->image()
                                            ->preserveFilenames(),
                                        Forms\Components\FileUpload::make('data.logo')
                                            ->label('Logo')
                                            ->disk('assets_logos')
                                            ->image()
                                            ->preserveFilenames(),
                                        Forms\Components\FileUpload::make('data.portrait')
                                            ->label('Portrait')
                                            ->disk('assets_portraits')
                                            ->image()
                                            ->preserveFilenames(),
                                        Forms\Components\FileUpload::make('data.timelineThumbnail')
                                            ->label('Timeline Thumbnail')
                                            ->disk('assets_thumbnails')
                                            ->image()
                                            ->preserveFilenames(),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Color Configuration')
                                    ->schema([
                                        Forms\Components\TextInput::make('data.colors.primaryColor')
                                            ->label('Primary Color')
                                            ->helperText('RGB format: 184, 153, 90'),
                                        Forms\Components\TextInput::make('data.colors.primaryColorLight')
                                            ->label('Primary Color Light')
                                            ->helperText('RGB format: 200, 176, 128'),
                                        Forms\Components\TextInput::make('data.colors.primaryColorDark')
                                            ->label('Primary Color Dark')
                                            ->helperText('RGB format: 10, 10, 10'),
                                        Forms\Components\TextInput::make('data.colors.secondaryColor')
                                            ->label('Secondary Color')
                                            ->helperText('RGB format: 208, 188, 147'),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Footer Logos')
                                    ->schema([
                                        Forms\Components\Repeater::make('data.footerLogos')
                                            ->label('Footer Logos')
                                            ->schema([
                                                Forms\Components\FileUpload::make('src')
                                                    ->label('Logo')
                                                    ->disk('assets_logos')
                                                    ->image()
                                                    ->preserveFilenames(),
                                                Forms\Components\TextInput::make('link')
                                                    ->required(),
                                                Forms\Components\TextInput::make('alt')
                                                    ->label('Alt Text')
                                                    ->required(),
                                            ])
                                            ->columns(3)
                                            ->defaultItems(0)
                                            ->reorderable()
                                            ->addActionLabel('Add Footer Logo'),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Static Directory')
                            ->schema([
                                Forms\Components\Repeater::make('data.staticDirectory')
                                    ->label('Static Directory')
                                    ->itemLabel(fn (array $state): ?string => $state['index'] ?? null)
                                    ->schema([
                                        Forms\Components\TextInput::make('index')
                                            ->required(),
                                        Forms\Components\Repeater::make('documents')
                                            ->collapsed()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required()
                                                    ->columnSpanFull(),
                                                Forms\Components\TextInput::make('docId')
                                                    ->label('Document ID')
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('metadata.Entstehungsjahr')
                                                    ->label('Publication Year'),
                                                Forms\Components\TextInput::make('metadata.Institution')
                                                    ->label('Institution'),
                                                Forms\Components\TextInput::make('metadata.Signatur')
                                                    ->label('Signature'),
                                                Forms\Components\TextInput::make('metadata.Link')
                                                    ->label('Link'),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(0)
                                            ->addActionLabel('Add Document'),
                                    ])
                                    ->defaultItems(0)
                                    ->reorderable()
                                    ->addActionLabel('Add Static Directory Entry'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Crowd Directory')
                            ->schema([
                                Forms\Components\Repeater::make('data.crowdDirectory')
                                    ->label('Crowd Directory')
                                    ->itemLabel(fn (array $state): ?string => $state['index'] ?? null)
                                    ->schema([
                                        Forms\Components\TextInput::make('index')
                                            ->required(),
                                        Forms\Components\Repeater::make('documents')
                                            ->collapsed()
                                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->required()
                                                    ->columnSpanFull(),
                                                Forms\Components\TextInput::make('docId')
                                                    ->label('Document ID')
                                                    ->numeric()
                                                    ->required(),
                                                Forms\Components\TextInput::make('metadata.Entstehungsjahr')
                                                    ->label('Publication Year'),
                                                Forms\Components\TextInput::make('metadata.Institution')
                                                    ->label('Institution'),
                                                Forms\Components\TextInput::make('metadata.Signatur')
                                                    ->label('Signature'),
                                                Forms\Components\TextInput::make('metadata.Link')
                                                    ->label('Link'),
                                            ])
                                            ->columns(2)
                                            ->defaultItems(0)
                                            ->addActionLabel('Add Document'),
                                    ])
                                    ->defaultItems(0)
                                    ->reorderable()
                                    ->addActionLabel('Add Crowd Directory Entry'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('data.name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('data.col_id')
                    ->label('Collection ID')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->headerActions([
                //
            ])
            ->defaultSort('data.name')
            ->defaultPaginationPageOption(50);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
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
            'index' => Pages\ListCollections::route('/'),
            'edit' => Pages\EditCollection::route('/{record}/edit'),
        ];
    }
}
