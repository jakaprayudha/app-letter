<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'nip',
        'sip',
        'category',
        'poli',
    ];

    protected function nip(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (! $value) {
                    return null;
                }

                try {
                    return Crypt::decryptString($value);
                } catch (\Throwable $e) {
                    return $value;
                }
            },

            set: function ($value) {
                if (! $value) {
                    return null;
                }

                // supaya tidak double encrypt
                try {
                    Crypt::decryptString($value);

                    return $value;
                } catch (\Throwable $e) {
                    return Crypt::encryptString($value);
                }
            }
        );
    }

    public static function exportPdf($query = null)
    {
        $doctors = $query ? $query->get() :
            self::orderBy('name')->get();
        $pdf = Pdf::loadView('pdf.doctors', ['doctors' => $doctors])
            ->setPaper('a4', 'landscape');
        return $pdf;
    }
}
