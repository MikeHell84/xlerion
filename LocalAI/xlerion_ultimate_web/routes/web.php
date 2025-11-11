<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/convocatorias', function () {
    return view('convocatorias');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/contacto', function () {
    return view('contacto');
});

require __DIR__.'/auth.php';