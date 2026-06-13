@extends('layouts.app')

@section('title', 'Mapa de Eventos')
@section('meta_description', 'Veja no mapa interativo onde estão os eventos mais próximos de você.')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .map-page {
        display: flex;
        height: calc(100vh - var(--nav-height));
    }

    /* ========== SIDEBAR ========== */
    .map-sidebar {
        width: 380px;
        background: var(--gray-900);
        border-right: 1px solid rgba(255,255,255,0.06);
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .sidebar-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .sidebar-header h2 {
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
    }

    .sidebar-header h2 i {
        color: var(--blue-500);
        margin-right: 0.5rem;
    }

    .search-input {
        width: 100%;
        padding: 0.7rem 1rem 0.7rem 2.5rem;
        background: var(--gray-800);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-sm);
        color: var(--white);
        font-family: inherit;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
    }

    .search-wrapper {
        position: relative;
    }

    .search-wrapper i {
        position: absolute;
        left: 0.85rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-500);
        font-size: 0.9rem;
    }

    .event-list {
        flex: 1;
        overflow-y: auto;
        padding: 0.75rem;
    }

    .event-list::-webkit-scrollbar {
        width: 6px;
    }

    .event-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .event-list::-webkit-scrollbar-thumb {
        background: var(--gray-700);
        border-radius: 3px;
    }

    .map-event-item {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-md);
        padding: 1rem;
        margin-bottom: 0.75rem;
        cursor: pointer;
        transition: var(--transition);
    }

    .map-event-item:hover,
    .map-event-item.active {
        background: rgba(59, 130, 246, 0.1);
        border-color: var(--blue-500);
    }

    .map-event-item .mei-top {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .mei-icon {
        width: 42px;
        height: 42px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .mei-title {
        font-weight: 700;
        font-size: 0.95rem;
    }

    .mei-category {
        font-size: 0.75rem;
        color: var(--gray-400);
    }

    .mei-details {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        font-size: 0.85rem;
        color: var(--gray-400);
    }

    .mei-details i {
        color: var(--blue-500);
        width: 14px;
        margin-right: 0.4rem;
        font-size: 0.8rem;
    }

    .mei-price {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    .mei-price-value {
        font-weight: 800;
        color: var(--blue-400);
        font-size: 1.1rem;
    }

    .mei-price-btn {
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        color: var(--white);
        border: none;
        padding: 0.4rem 1rem;
        border-radius: var(--radius-full);
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
    }

    .mei-price-btn:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-glow);
    }

    /* ========== MAPA ========== */
    .map-container {
        flex: 1;
        position: relative;
    }

    #map {
        width: 100%;
        height: 100%;
    }

    .map-controls {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 500;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .map-control-btn {
        width: 40px;
        height: 40px;
        background: var(--gray-900);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-sm);
        color: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        font-size: 1rem;
    }

    .map-control-btn:hover {
        background: var(--blue-600);
        border-color: var(--blue-500);
    }

    .map-legend {
        position: absolute;
        bottom: 2rem;
        left: 1rem;
        z-index: 500;
        background: rgba(10, 15, 26, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-md);
        padding: 1rem;
    }

    .map-legend h4 {
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--gray-300);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        color: var(--gray-400);
        margin-bottom: 0.3rem;
    }

    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    @media (max-width: 768px) {
        .map-page {
            flex-direction: column;
            height: auto;
        }

        .map-sidebar {
            width: 100%;
            max-height: 300px;
        }

        .map-container {
            height: 50vh;
        }
    }
</style>
@endsection

@section('content')
    <div class="map-page">
        <!-- Sidebar -->
        <aside class="map-sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-map-marked-alt"></i> Mapa de Eventos</h2>
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search-input" placeholder="Buscar eventos no mapa..." id="mapSearch">
                </div>
            </div>

            <div class="event-list" id="mapEventList">
                <div class="map-event-item" data-lat="-19.9320" data-lng="-43.9381" onclick="focusEvent(this)">
                    <div class="mei-top">
                        <div class="mei-icon" style="background: rgba(59,130,246,0.2);">🎵</div>
                        <div>
                            <div class="mei-title">Festival de Jazz ao Vivo</div>
                            <div class="mei-category">Música</div>
                        </div>
                    </div>
                    <div class="mei-details">
                        <span><i class="fas fa-calendar"></i> 20 Jul 2026 · 19:00</span>
                        <span><i class="fas fa-map-marker-alt"></i> Praça da Liberdade, BH</span>
                    </div>
                    <div class="mei-price">
                        <span class="mei-price-value">R$ 85</span>
                        <button class="mei-price-btn" onclick="event.stopPropagation(); window.location='/ingressos'">Ingressos</button>
                    </div>
                </div>

                <div class="map-event-item" data-lat="-19.9550" data-lng="-43.9195" onclick="focusEvent(this)">
                    <div class="mei-top">
                        <div class="mei-icon" style="background: rgba(5,150,105,0.2);">🍽️</div>
                        <div>
                            <div class="mei-title">Feira Gastronômica Regional</div>
                            <div class="mei-category">Gastronomia</div>
                        </div>
                    </div>
                    <div class="mei-details">
                        <span><i class="fas fa-calendar"></i> 25 Jul 2026 · 11:00</span>
                        <span><i class="fas fa-map-marker-alt"></i> Parque das Mangabeiras, BH</span>
                    </div>
                    <div class="mei-price">
                        <span class="mei-price-value">R$ 25</span>
                        <button class="mei-price-btn" onclick="event.stopPropagation(); window.location='/ingressos'">Ingressos</button>
                    </div>
                </div>

                <div class="map-event-item" data-lat="-19.9196" data-lng="-43.9378" onclick="focusEvent(this)">
                    <div class="mei-top">
                        <div class="mei-icon" style="background: rgba(124,58,237,0.2);">📚</div>
                        <div>
                            <div class="mei-title">Workshop de Fotografia Urbana</div>
                            <div class="mei-category">Educação</div>
                        </div>
                    </div>
                    <div class="mei-details">
                        <span><i class="fas fa-calendar"></i> 02 Ago 2026 · 09:00</span>
                        <span><i class="fas fa-map-marker-alt"></i> Centro Cultural UFMG, BH</span>
                    </div>
                    <div class="mei-price">
                        <span class="mei-price-value">R$ 120</span>
                        <button class="mei-price-btn" onclick="event.stopPropagation(); window.location='/ingressos'">Ingressos</button>
                    </div>
                </div>

                <div class="map-event-item" data-lat="-19.9123" data-lng="-43.9400" onclick="focusEvent(this)">
                    <div class="mei-top">
                        <div class="mei-icon" style="background: rgba(220,38,38,0.2);">⚽</div>
                        <div>
                            <div class="mei-title">Campeonato de E-Sports</div>
                            <div class="mei-category">Esportes</div>
                        </div>
                    </div>
                    <div class="mei-details">
                        <span><i class="fas fa-calendar"></i> 10 Ago 2026 · 14:00</span>
                        <span><i class="fas fa-map-marker-alt"></i> Arena Esportiva, BH</span>
                    </div>
                    <div class="mei-price">
                        <span class="mei-price-value">R$ 60</span>
                        <button class="mei-price-btn" onclick="event.stopPropagation(); window.location='/ingressos'">Ingressos</button>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mapa -->
        <div class="map-container">
            <div id="map"></div>

            <div class="map-legend">
                <h4>Legenda</h4>
                <div class="legend-item"><div class="legend-dot" style="background: #3b82f6;"></div> Música</div>
                <div class="legend-item"><div class="legend-dot" style="background: #10b981;"></div> Gastronomia</div>
                <div class="legend-item"><div class="legend-dot" style="background: #8b5cf6;"></div> Educação</div>
                <div class="legend-item"><div class="legend-dot" style="background: #ef4444;"></div> Esportes</div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Inicializa o mapa centrado em Belo Horizonte
    const map = L.map('map', {
        zoomControl: false
    }).setView([-19.9320, -43.9381], 14);

    L.control.zoom({ position: 'topright' }).addTo(map);

    // Tile layer com tema escuro
    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; OpenStreetMap &copy; CARTO',
        maxZoom: 19
    }).addTo(map);

    // Eventos com marcadores
    const eventos = [
        {
            nome: 'Festival de Jazz ao Vivo',
            lat: -19.9320, lng: -43.9381,
            categoria: 'Música', icone: '🎵', cor: '#3b82f6',
            preco: 'R$ 85', data: '20 Jul 2026'
        },
        {
            nome: 'Feira Gastronômica Regional',
            lat: -19.9550, lng: -43.9195,
            categoria: 'Gastronomia', icone: '🍽️', cor: '#10b981',
            preco: 'R$ 25', data: '25 Jul 2026'
        },
        {
            nome: 'Workshop de Fotografia Urbana',
            lat: -19.9196, lng: -43.9378,
            categoria: 'Educação', icone: '📚', cor: '#8b5cf6',
            preco: 'R$ 120', data: '02 Ago 2026'
        },
        {
            nome: 'Campeonato de E-Sports',
            lat: -19.9123, lng: -43.9400,
            categoria: 'Esportes', icone: '⚽', cor: '#ef4444',
            preco: 'R$ 60', data: '10 Ago 2026'
        }
    ];

    const markers = [];

    eventos.forEach((ev, i) => {
        const icon = L.divIcon({
            html: `<div style="
                background: ${ev.cor};
                width: 36px; height: 36px;
                border-radius: 50%;
                display: flex; align-items: center; justify-content: center;
                font-size: 18px;
                border: 3px solid rgba(255,255,255,0.9);
                box-shadow: 0 3px 12px rgba(0,0,0,0.4);
            ">${ev.icone}</div>`,
            className: '',
            iconSize: [36, 36],
            iconAnchor: [18, 18]
        });

        const marker = L.marker([ev.lat, ev.lng], { icon })
            .addTo(map)
            .bindPopup(`
                <div style="font-family: Inter, sans-serif; min-width: 200px;">
                    <strong style="font-size: 1rem;">${ev.icone} ${ev.nome}</strong><br>
                    <span style="color: ${ev.cor}; font-weight: 600;">${ev.categoria}</span><br>
                    <span>📅 ${ev.data}</span><br>
                    <span style="font-size: 1.2rem; font-weight: 800; color: ${ev.cor};">${ev.preco}</span>
                    <br><br>
                    <a href="/ingressos" style="
                        background: ${ev.cor}; color: #fff;
                        padding: 6px 16px; border-radius: 20px;
                        text-decoration: none; font-weight: 600; font-size: 0.85rem;
                    ">Comprar Ingresso</a>
                </div>
            `);

        markers.push(marker);
    });

    // Focar evento do sidebar
    function focusEvent(el) {
        const lat = parseFloat(el.dataset.lat);
        const lng = parseFloat(el.dataset.lng);

        map.flyTo([lat, lng], 16, { duration: 1 });

        document.querySelectorAll('.map-event-item').forEach(item => item.classList.remove('active'));
        el.classList.add('active');

        markers.forEach(m => {
            const pos = m.getLatLng();
            if (Math.abs(pos.lat - lat) < 0.001 && Math.abs(pos.lng - lng) < 0.001) {
                m.openPopup();
            }
        });
    }

    // Busca na sidebar
    document.getElementById('mapSearch').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.map-event-item').forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(query) ? '' : 'none';
        });
    });
</script>
@endsection
