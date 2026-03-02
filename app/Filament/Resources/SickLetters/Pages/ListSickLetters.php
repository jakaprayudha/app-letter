<?php

namespace App\Filament\Resources\SickLetters\Pages;

use App\Filament\Resources\SickLetters\SickLetterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSickLetters extends ListRecords
{
    protected static string $resource = SickLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
