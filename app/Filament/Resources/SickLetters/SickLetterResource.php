<?php

namespace App\Filament\Resources\SickLetters;

use App\Filament\Resources\SickLetters\Pages\CreateSickLetter;
use App\Filament\Resources\SickLetters\Pages\EditSickLetter;
use App\Filament\Resources\SickLetters\Pages\ListSickLetters;
use App\Filament\Resources\SickLetters\Schemas\SickLetterForm;
use App\Filament\Resources\SickLetters\Tables\SickLettersTable;
use App\Models\SickLetter;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SickLetterResource extends Resource
{
    protected static ?string $model = SickLetter::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'patient_name';

    public static function form(Schema $schema): Schema
    {
        return SickLetterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SickLettersTable::configure($table);
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
            'index' => ListSickLetters::route('/'),
            'create' => CreateSickLetter::route('/create'),
            'edit' => EditSickLetter::route('/{record}/edit'),
        ];
    }
}
