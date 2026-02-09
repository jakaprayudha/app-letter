<?php

namespace App\Filament\Resources\Polis;

use App\Filament\Resources\Polis\Pages\CreatePoli;
use App\Filament\Resources\Polis\Pages\EditPoli;
use App\Filament\Resources\Polis\Pages\ListPolis;
use App\Filament\Resources\Polis\Schemas\PoliForm;
use App\Filament\Resources\Polis\Tables\PolisTable;
use App\Models\Poli;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PoliResource extends Resource
{
    protected static ?string $model = Poli::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'policlinic';

    public static function form(Schema $schema): Schema
    {
        return PoliForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PolisTable::configure($table);
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
            'index' => ListPolis::route('/'),
            'create' => CreatePoli::route('/create'),
            'edit' => EditPoli::route('/{record}/edit'),
        ];
    }
}
