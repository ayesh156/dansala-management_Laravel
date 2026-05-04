<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationLabel = 'භාණ්ඩ';

    protected static ?string $modelLabel = 'භාණ්ඩය';

    protected static ?string $pluralModelLabel = 'භාණ්ඩ';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'දානශාලා කළමනාකරණය';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('භාණ්ඩ විස්තර')
                    ->description('භාණ්ඩයේ නම සහ අවශ්‍ය ප්‍රමාණය ඇතුළත් කරන්න.')
                    ->icon('heroicon-o-archive-box')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('භාණ්ඩයේ නම')
                            ->placeholder('උදා: බත්, පරිප්පු, සීනි')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('required_quantity')
                            ->label('අවශ්‍ය ප්‍රමාණය')
                            ->numeric()
                            ->minValue(0.01)
                            ->step(0.01)
                            ->required()
                            ->suffix(fn ($get) => $get('unit') ?: 'ඒකක')
                            ->columnSpan(2),

                        Forms\Components\Select::make('unit')
                            ->label('ඒකකය')
                            ->options([
                                'kg'       => 'කිලෝග්‍රෑම් (kg)',
                                'g'        => 'ග්‍රෑම් (g)',
                                'L'        => 'ලීටර් (L)',
                                'ml'       => 'මිලිලීටර් (ml)',
                                'packets'  => 'පැකට්',
                                'boxes'    => 'පෙට්ටි',
                                'pieces'   => 'කෑලි',
                                'bags'     => 'බෑග්',
                                'cans'     => 'ටින්',
                                'bottles'  => 'බෝතල්',
                                'numbers'  => 'ගණන (numbers)',
                                'cylinders'=> 'සිලින්ඩර',
                            ])
                            ->searchable()
                            ->required()
                            ->native(false)
                            ->columnSpan(2),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ── Card-style layout on mobile ──────────────────────────
                TextColumn::make('name')
                    ->label('භාණ්ඩයේ නම')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::SemiBold)
                    ->description(fn ($record): string =>
                        'ලැබුණු: ' . number_format($record->total_pledged, 2) . ' ' . $record->unit .
                        ' | ඉතිරි: ' . number_format($record->remaining_quantity, 2) . ' ' . $record->unit
                    ),

                TextColumn::make('required_quantity')
                    ->label('අවශ්‍ය')
                    ->numeric(decimalPlaces: 2)
                    ->sortable()
                    ->suffix(fn ($record) => ' ' . $record->unit),

                TextColumn::make('total_pledged')
                    ->label('ලැබුණු')
                    ->getStateUsing(fn ($record) => number_format($record->total_pledged, 2) . ' ' . $record->unit)
                    ->color(fn ($record) => $record->fulfillment_percentage >= 100 ? 'success'
                        : ($record->fulfillment_percentage >= 50 ? 'warning' : 'danger'))
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('fulfillment_percentage')
                    ->label('ප්‍රගතිය')
                    ->getStateUsing(fn ($record) => $record->fulfillment_percentage . '%')
                    ->badge()
                    ->sortable()
                    ->color(fn ($record) => match (true) {
                        $record->fulfillment_percentage >= 100 => 'success',
                        $record->fulfillment_percentage >= 50  => 'warning',
                        default                                => 'danger',
                    }),

                TextColumn::make('unit')
                    ->label('ඒකකය')
                    ->badge()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('බලන්න')
                    ->iconButton(),
                Tables\Actions\EditAction::make()
                    ->label('සංස්කරණය')
                    ->iconButton(),
                Tables\Actions\DeleteAction::make()
                    ->label('මකන්න')
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('තෝරාගත් ඒවා මකන්න'),
                ]),
            ])
            ->defaultSort('name')
            ->emptyStateHeading('භාණ්ඩ නොමැත')
            ->emptyStateDescription('ආරම්භ කිරීමට නව භාණ්ඩයක් එකතු කරන්න.')
            ->emptyStateIcon('heroicon-o-archive-box');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'view'   => Pages\ViewItem::route('/{record}'),
            'edit'   => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
