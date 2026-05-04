<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashDonationResource\Pages;
use App\Models\CashDonation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CashDonationResource extends Resource
{
    protected static ?string $model = CashDonation::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'සල්ලි දායකත්ව';

    protected static ?string $modelLabel = 'සල්ලි දායකත්වය';

    protected static ?string $pluralModelLabel = 'සල්ලි දායකත්ව';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = null;

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('දායකයාගේ තොරතුරු')
                    ->description('සල්ලි දායකත්වය ලබා දෙන්නාගේ විස්තර ඇතුළත් කරන්න.')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\TextInput::make('donor_name')
                            ->label('දායකයාගේ නම')
                            ->placeholder('සම්පූර්ණ නම')
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

                Forms\Components\Section::make('දායකත්ව විස්තර')
                    ->description('ලබා දෙන මුදල සහ සටහන ඇතුළත් කරන්න.')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label('මුදල (රු.)')
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01)
                            ->nullable()
                            ->prefix('රු.')
                            ->placeholder('0.00')
                            ->helperText('මුදල නොදන්නේ නම් හිස් කරන්න.')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('note')
                            ->label('සටහන')
                            ->placeholder('අමතර සටහනක් ඇත්නම් ඇතුළත් කරන්න')
                            ->nullable()
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('donor_name')
                    ->label('දායකයාගේ නම')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::SemiBold)
                    ->description(fn ($record): string =>
                        ($record->donor_mobile ?? '') .
                        ($record->donor_mobile && $record->donor_address ? ' · ' : '') .
                        ($record->donor_address ?? '')
                    ),

                TextColumn::make('donor_mobile')
                    ->label('දුරකථනය')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('දුරකථන අංකය පිටපත් විය!')
                    ->icon('heroicon-m-phone')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('amount')
                    ->label('මුදල')
                    ->getStateUsing(fn ($record) => $record->amount ? 'රු. ' . number_format($record->amount, 2) : '—')
                    ->badge()
                    ->color(fn ($record) => $record->amount ? 'success' : 'gray')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('note')
                    ->label('සටහන')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->note ?: '—')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('created_at')
                    ->label('දිනය')
                    ->dateTime('d M Y, h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('සල්ලි දායකත්ව නොමැත')
            ->emptyStateDescription('ආරම්භ කිරීමට නව සල්ලි දායකත්වයක් එකතු කරන්න.')
            ->emptyStateIcon('heroicon-o-banknotes');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCashDonations::route('/'),
            'create' => Pages\CreateCashDonation::route('/create'),
            'view'   => Pages\ViewCashDonation::route('/{record}'),
            'edit'   => Pages\EditCashDonation::route('/{record}/edit'),
        ];
    }
}
