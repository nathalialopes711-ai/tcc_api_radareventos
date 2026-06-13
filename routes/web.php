<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Web - Radar Eventos
|--------------------------------------------------------------------------
|
| Páginas da aplicação Radar Eventos.
|
*/

// Página Inicial
Route::get('/', function () {
    return view('pages.home');
});

// Eventos
Route::get('/eventos', function () {
    return view('pages.eventos');
});

// Mapa Interativo
Route::get('/mapa', function () {
    return view('pages.mapa');
});

// Compra de Ingressos
Route::get('/ingressos', function () {
    return view('pages.ingressos');
});

// Contato
Route::get('/contato', function () {
    return view('pages.contato');
});

// Login / Cadastro
Route::get('/login', function () {
    return view('pages.login');
});
