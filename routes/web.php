<?php

use Illuminate\Support\Facades\Route;
use App\Models\Doctor;
use App\Models\SickLetter;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

Route::get('doctors/export-pdf', function () {

    $doctors = Doctor::all();

    $pdf = Pdf::loadView('pdf.doctors', [
        'doctors' => $doctors
    ])->setPaper('a4', 'landscape');

    return $pdf->download('doctors.pdf');
})->name('doctors.export-pdf');

Route::get('/sick-letter/{record}/print', function (SickLetter $record) {
    $pdf = Pdf::loadView('pdf.sick-letter', [
        'data' => $record
    ]);
    return $pdf->stream('Surat-Sakit.pdf');
})->name('sick-letter.print');
