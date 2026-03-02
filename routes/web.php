<?php

use Illuminate\Support\Facades\Route;
use App\Models\Doctor;
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
