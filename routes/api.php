<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas da API - Radar Eventos
|--------------------------------------------------------------------------
|
| Endpoints públicos da API do Radar Eventos.
| Todas as respostas são em JSON.
|
*/

// ==========================================
// 1. STATUS DA API
// ==========================================
Route::get('/status', function () {
    return response()->json([
        'status'    => 'online',
        'aplicacao' => 'Radar Eventos API',
        'versao'    => '1.0.0',
        'descricao' => 'API para descoberta e compra de ingressos de eventos locais',
        'timestamp' => now()->toIso8601String(),
    ]);
});

// ==========================================
// 2. LISTAR EVENTOS
// ==========================================
Route::get('/eventos', function () {
    return response()->json([
        'sucesso' => true,
        'total'   => 4,
        'dados'   => [
            [
                'id'         => 1,
                'titulo'     => 'Festival de Jazz ao Vivo',
                'categoria'  => 'Música',
                'data'       => '2026-07-20',
                'horario'    => '19:00',
                'local'      => 'Praça da Liberdade, Belo Horizonte - MG',
                'latitude'   => -19.9320,
                'longitude'  => -43.9381,
                'preco'      => 85.00,
                'ingressos_disponiveis' => 150,
                'imagem_url' => '/images/eventos/jazz.jpg',
                'destaque'   => true,
            ],
            [
                'id'         => 2,
                'titulo'     => 'Feira Gastronômica Regional',
                'categoria'  => 'Gastronomia',
                'data'       => '2026-07-25',
                'horario'    => '11:00',
                'local'      => 'Parque das Mangabeiras, Belo Horizonte - MG',
                'latitude'   => -19.9550,
                'longitude'  => -43.9195,
                'preco'      => 25.00,
                'ingressos_disponiveis' => 500,
                'imagem_url' => '/images/eventos/gastronomia.jpg',
                'destaque'   => false,
            ],
            [
                'id'         => 3,
                'titulo'     => 'Workshop de Fotografia Urbana',
                'categoria'  => 'Educação',
                'data'       => '2026-08-02',
                'horario'    => '09:00',
                'local'      => 'Centro Cultural UFMG, Belo Horizonte - MG',
                'latitude'   => -19.9196,
                'longitude'  => -43.9378,
                'preco'      => 120.00,
                'ingressos_disponiveis' => 30,
                'imagem_url' => '/images/eventos/workshop.jpg',
                'destaque'   => false,
            ],
            [
                'id'         => 4,
                'titulo'     => 'Campeonato de E-Sports',
                'categoria'  => 'Esportes',
                'data'       => '2026-08-10',
                'horario'    => '14:00',
                'local'      => 'Arena Esportiva, Belo Horizonte - MG',
                'latitude'   => -19.9123,
                'longitude'  => -43.9400,
                'preco'      => 60.00,
                'ingressos_disponiveis' => 200,
                'imagem_url' => '/images/eventos/esports.jpg',
                'destaque'   => true,
            ],
        ],
    ]);
});

// ==========================================
// 3. LISTAR CATEGORIAS DE EVENTOS
// ==========================================
Route::get('/categorias', function () {
    return response()->json([
        'sucesso' => true,
        'total'   => 6,
        'dados'   => [
            [
                'id'              => 1,
                'nome'            => 'Música',
                'icone'           => '🎵',
                'cor'             => '#2563eb',
                'total_eventos'   => 12,
            ],
            [
                'id'              => 2,
                'nome'            => 'Gastronomia',
                'icone'           => '🍽️',
                'cor'             => '#059669',
                'total_eventos'   => 8,
            ],
            [
                'id'              => 3,
                'nome'            => 'Esportes',
                'icone'           => '⚽',
                'cor'             => '#dc2626',
                'total_eventos'   => 15,
            ],
            [
                'id'              => 4,
                'nome'            => 'Educação',
                'icone'           => '📚',
                'cor'             => '#7c3aed',
                'total_eventos'   => 6,
            ],
            [
                'id'              => 5,
                'nome'            => 'Tecnologia',
                'icone'           => '💻',
                'cor'             => '#0891b2',
                'total_eventos'   => 9,
            ],
            [
                'id'              => 6,
                'nome'            => 'Arte e Cultura',
                'icone'           => '🎨',
                'cor'             => '#db2777',
                'total_eventos'   => 11,
            ],
        ],
    ]);
});

// ==========================================
// 4. LISTAR INGRESSOS / COMPRAS
// ==========================================
Route::get('/ingressos', function () {
    return response()->json([
        'sucesso' => true,
        'total'   => 2,
        'dados'   => [
            [
                'id'              => 1,
                'evento_id'       => 1,
                'evento_titulo'   => 'Festival de Jazz ao Vivo',
                'comprador'       => 'Maria Silva',
                'email'           => 'maria@email.com',
                'tipo'            => 'VIP',
                'quantidade'      => 2,
                'valor_unitario'  => 85.00,
                'valor_total'     => 170.00,
                'status_pagamento'=> 'confirmado',
                'codigo_ingresso' => 'RE-2026-JAZZ-001',
                'data_compra'     => '2026-06-10T14:30:00-03:00',
            ],
            [
                'id'              => 2,
                'evento_id'       => 4,
                'evento_titulo'   => 'Campeonato de E-Sports',
                'comprador'       => 'João Santos',
                'email'           => 'joao@email.com',
                'tipo'            => 'Pista',
                'quantidade'      => 1,
                'valor_unitario'  => 60.00,
                'valor_total'     => 60.00,
                'status_pagamento'=> 'pendente',
                'codigo_ingresso' => 'RE-2026-ESPT-002',
                'data_compra'     => '2026-06-11T09:15:00-03:00',
            ],
        ],
    ]);
});
