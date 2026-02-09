<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Crypt;

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
}
