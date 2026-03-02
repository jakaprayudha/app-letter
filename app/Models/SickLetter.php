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
}
