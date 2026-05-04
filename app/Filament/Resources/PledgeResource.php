<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PledgeResource\Pages;
use App\Models\Item;
use App\Models\Pledge;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PledgeResource extends Resource
{
    protected static ?string $model = Pledge::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'පොරොන්දු';
    protected static ?string $modelLabel = 'පොරොන්දුව';
    protected static ?string $pluralModelLabel = 'පොරොන්දු';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = null;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('දායකයාගේ තොරතුරු')
                    ->description('දායකයාගේ විස්තර ඇතුළත් කරන්න.')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\TextInput::make('donor_name')
                            ->label('දායකයාගේ නම')
                            ->placeholder('දායකයාගේ සම්පූර්ණ නම')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('donor_mobile')
                            ->label('දුරකථන අංකය')
                            ->placeholder('077 123 4567')
                            ->tel()
                            ->nullable()
                            ->maxLength(20),

                        Forms\Components\TextInput::make('donor_address')
                            ->label('ලිපිනය')
                            ->placeholder('ලිපිනය (අත්‍යවශ්‍ය නොවේ)')
                            ->nullable()
                            ->maxLength(500),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('පොරොන්දු විස්තර')
                    ->description('භාණ්ඩය සහ ප්‍රමාණය තෝරන්න.')
                    ->icon('heroicon-o-archive-box')
                    ->schema([
                        Forms\Components\Select::make('item_id')
                            ->label('භාණ්ඩය')
                            ->relationship('item', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->native(false)
                            ->getOptionLabelFromRecordUsing(function (Item $record) {
                                $pledged   = (float) $record->pledges()->sum('pledged_quantity');
                                $remaining = max(0, (float) $record->required_quantity - $pledged);
                                $pct       = $record->required_quantity > 0
                                    ? min(100, round(($pledged / $record->required_quantity) * 100))
                                    : 0;
                                $unknownCount = $record->pledges()->whereNull('pledged_quantity')->count();
                                $status = $pct >= 100 ? '✅' : ($pct >= 50 ? '⏳' : '⚠️');
                                $extra  = $unknownCount > 0 ? " + {$unknownCount} නොදනී" : '';
                                return "{$status} {$record->name} — ඉතිරි: {$remaining} {$record->unit} ({$pct}%){$extra}";
                            })
                            ->helperText('භාණ්ඩය සොයා තෝරන්න.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('pledged_quantity')
                            ->label('පොරොන්දු ප්‍රමාණය')
                            ->numeric()
                            ->minValue(0.01)
                            ->step(0.01)
                            ->nullable()
                            ->helperText('ප්‍රමාණය නොදන්නේ නම් හිස් කරන්න — "ගෙනෙනවා" ලෙස සටහන් වේ.'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ── Primary column with card-style sub-info ──────────────
                TextColumn::make('donor_name')
                    ->label('දායකයාගේ නම')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::SemiBold)
                    ->description(fn ($record): string =>
                        optional($record->item)->name . ' · ' .
                        number_format($record->pledged_quantity, 2) . ' ' .
                        optional($record->item)->unit
                    ),

                // Item badge — visible always
                TextColumn::make('item.name')
                    ->label('භාණ්ඩය')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Qty — visible always
                TextColumn::make('pledged_quantity')
                    ->label('ප්‍රමාණය')
                    ->getStateUsing(fn ($record) =>
                        $record->pledged_quantity
                            ? number_format($record->pledged_quantity, 2) . ' ' . optional($record->item)->unit
                            : '—'
                    )
                    ->badge()
                    ->color(fn ($record) => $record->pledged_quantity ? 'success' : 'gray')
                    ->sortable(),

                // Mobile — hidden by default
                TextColumn::make('donor_mobile')
                    ->label('දුරකථනය')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('දුරකථන අංකය පිටපත් විය!')
                    ->icon('heroicon-m-phone')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Address — hidden by default
                TextColumn::make('donor_address')
                    ->label('ලිපිනය')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->donor_address ?: '—')
                    ->toggleable(isToggledHiddenByDefault: true),

                // Date
                TextColumn::make('created_at')
                    ->label('දිනය')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('item_id')
                    ->label('භාණ්ඩය අනුව')
                    ->relationship('item', 'name')
                    ->searchable()
                    ->preload(),
            ])
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
            ->defaultSort('created_at', 'desc')
            ->recordUrl(null)
            ->emptyStateHeading('පොරොන්දු නොමැත')
            ->emptyStateDescription('ආරම්භ කිරීමට නව පොරොන්දුවක් එකතු කරන්න.')
            ->emptyStateIcon('heroicon-o-heart');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPledges::route('/'),
            'create' => Pages\CreatePledge::route('/create'),
            'view'   => Pages\ViewPledge::route('/{record}'),
            'edit'   => Pages\EditPledge::route('/{record}/edit'),
        ];
    }
}
