<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('inicio');
});

Route::get('/filosofia', function () {
    return view('filosofia');
});

Route::get('/soluciones', function () {
    return view('soluciones');
});

Route::get('/proyectos', function () {
    return view('proyectos');
});

Route::get('/documentacion', function () {
    return view('documentacion');
});

Route::get('/fundador', function () {
    return view('fundador');
});

Route::get('/blog', function () {
    return view('blog');
});

// Ruta para mostrar la página de contacto (incluye formulario de cotización)
Route::get('/contacto', [ContactController::class, 'show'])->name('contact.show');

// Ruta para procesar el formulario de contacto
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Ruta para procesar el formulario de cotización
Route::post('/quotation', [QuotationController::class, 'submit'])->name('quotation.submit');