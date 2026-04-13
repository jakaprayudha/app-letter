<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SickLetter extends Model
{
    //
    protected $fillable = [
        'doctor_id',
        'poli_id',
        'patient_name',
        'start_date',
        'end_date',
        'diagnosis',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
    use Illuminate\Support\Facades\DB;

    protected static function booted()
    {
        static::creating(function ($model) {

            DB::transaction(function () use ($model) {

                $last = self::lockForUpdate()
                    ->orderBy('id', 'desc')
                    ->first();

                $nextNumber = 1;

                if ($last && $last->number_letter) {
                    $lastNumber = (int) substr($last->number_letter, -4);
                    $nextNumber = $lastNumber + 1;
                }

                $model->number_letter = 'SK-' . date('Y') . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            });
        });
    }
}
