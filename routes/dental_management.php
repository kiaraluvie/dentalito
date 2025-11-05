<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DentalManagement\PatientController;
use App\Http\Controllers\DentalManagement\ProcedureController;
use App\Http\Controllers\DentalManagement\TreatmentController;
use App\Http\Controllers\DentalManagement\MedicalHistoryController;
use App\Http\Controllers\DentalManagement\DentistController;
use App\Http\Controllers\DentalManagement\AppointmentController;
use App\Http\Controllers\DentalManagement\OdontogramController;
use App\Http\Controllers\DentalManagement\SpecialtyController;


Route::prefix('dental_management')->name('dental_management.')->middleware(['auth'])->group(function () {

    // ------------------------------
    // Patients
    // ------------------------------
    Route::resource('patients', PatientController::class)->names('patients');
    Route::get('patients/{patient}/delete', [PatientController::class, 'delete'])->name('patients.delete');
    Route::delete('patients/{patient}/deleteSave', [PatientController::class, 'deleteSave'])->name('patients.deleteSave');

    // ------------------------------
    // Odontogram
    // ------------------------------
    Route::get('patients/{patient}/odontogram', [OdontogramController::class, 'show'])->name('patients.odontogram.show');
    Route::post('patients/{patient}/odontogram', [OdontogramController::class, 'store'])->name('patients.odontogram.store');
    Route::patch('patients/{patient}/odontogram/{odontogram}', [OdontogramController::class, 'update'])->name('patients.odontogram.update');

    // ------------------------------
    // Procedures
    // ------------------------------
    Route::resource('procedures', ProcedureController::class)->names('procedures');
    Route::get('procedures/{procedure}/delete', [ProcedureController::class, 'delete'])->name('procedures.delete');
    Route::delete('procedures/{procedure}/deleteSave', [ProcedureController::class, 'deleteSave'])->name('procedures.deleteSave');

    // ------------------------------
    // Treatments
    // ------------------------------
    Route::resource('treatments', TreatmentController::class)->names('treatments');
    Route::get('treatments/{treatment}/delete', [TreatmentController::class, 'delete'])->name('treatments.delete');
    Route::delete('treatments/{treatment}/deleteSave', [TreatmentController::class, 'deleteSave'])->name('treatments.deleteSave');

    // ------------------------------
    // Medical Histories
    // ------------------------------
    Route::resource('medical_histories', MedicalHistoryController::class)->names('medical_histories');
    Route::get('medical_histories/{medical_history}/delete', [MedicalHistoryController::class, 'delete'])->name('medical_histories.delete');
    Route::delete('medical_histories/{medical_history}/deleteSave', [MedicalHistoryController::class, 'deleteSave'])->name('medical_histories.deleteSave');

    // ------------------------------
    // Dentists
    // ------------------------------
    Route::resource('dentists', DentistController::class)->names('dentists');
    Route::get('dentists/{dentist}/delete', [DentistController::class, 'delete'])->name('dentists.delete');
    Route::delete('dentists/{dentist}/deleteSave', [DentistController::class, 'deleteSave'])->name('dentists.deleteSave');
    Route::get('dentists/edit_all', [DentistController::class, 'editAll'])->name('dentists.edit_all');
    Route::post('dentists/update_inline', [DentistController::class, 'updateInline'])->name('dentists.update_inline');
    Route::get('dentists/export_pdf', [DentistController::class, 'exportPdf'])->name('dentists.export_pdf');
    Route::get('dentists/export_excel', [DentistController::class, 'exportExcel'])->name('dentists.export_excel');
    Route::get('dentists/export_word', [DentistController::class, 'exportWord'])->name('dentists.export_word');

    // ------------------------------
    // Appointments
    // ------------------------------
    Route::resource('appointments', AppointmentController::class)->names('appointments');
    Route::get('appointments/{appointment}/delete', [AppointmentController::class, 'delete'])->name('appointments.delete');
    Route::delete('appointments/{appointment}/deleteSave', [AppointmentController::class, 'deleteSave'])->name('appointments.deleteSave');
    Route::get('appointments/edit_all', [AppointmentController::class, 'editAll'])->name('appointments.edit_all');
    Route::post('appointments/update_inline', [AppointmentController::class, 'updateInline'])->name('appointments.update_inline');
    Route::get('appointments/export_pdf', [AppointmentController::class, 'exportPdf'])->name('appointments.export_pdf');
    Route::get('appointments/export_excel', [AppointmentController::class, 'exportExcel'])->name('appointments.export_excel');
    Route::get('appointments/export_word', [AppointmentController::class, 'exportWord'])->name('appointments.export_word');
    // ------------------------------
    // Specialties
    // ------------------------------
    Route::resource('specialties', SpecialtyController::class)->names('specialties');

    Route::get('specialties/{specialty}/delete', [SpecialtyController::class, 'delete'])->name('specialties.delete');
    Route::delete('specialties/{specialty}/deleteSave', [SpecialtyController::class, 'deleteSave'])->name('specialties.deleteSave');

    Route::get('specialties/edit_all', [SpecialtyController::class, 'editAll'])->name('specialties.edit_all');
    Route::post('specialties/update_inline', [SpecialtyController::class, 'updateInline'])->name('specialties.update_inline');

    Route::get('specialties/export_pdf', [SpecialtyController::class, 'exportPdf'])->name('specialties.export_pdf');
    Route::get('specialties/export_excel', [SpecialtyController::class, 'exportExcel'])->name('specialties.export_excel');
    Route::get('specialties/export_word', [SpecialtyController::class, 'exportWord'])->name('specialties.export_word');


});
