<?php

namespace App\Filament\Resources\SickLetters\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class SickLetterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->required(),
                Select::make('poli_id')
                    ->relationship('poli', 'policlinic')
                    ->required(),
                TextInput::make('patient_name')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                Textarea::make('diagnosis')
                    ->columnSpanFull(),
            ]);
    }
}
