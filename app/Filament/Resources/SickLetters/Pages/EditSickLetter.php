<?php

namespace App\Filament\Resources\SickLetters\Pages;

use App\Filament\Resources\SickLetters\SickLetterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSickLetter extends EditRecord
{
    protected static string $resource = SickLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
