@extends('layouts.app')

@section('title', 'Eventos')
@section('meta_description', 'Explore todos os eventos locais disponíveis. Filtre por categoria, data e localização.')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--gray-900) 0%, var(--blue-950) 100%);
        padding: 6rem 0 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--blue-500), transparent);
    }

    /* ========== FILTROS ========== */
    .filters-bar {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-lg);
        padding: 1.5rem 2rem;
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 2rem;
    }

    .filter-group {
        flex: 1;
        min-width: 180px;
    }

    .filter-group label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray-400);
        margin-bottom: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-group select,
    .filter-group input {
        width: 100%;
        padding: 0.7rem 1rem;
        background: var(--gray-800);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-sm);
        color: var(--white);
        font-family: inherit;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .filter-group select:focus,
    .filter-group input:focus {
        outline: none;
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
    }

    .filter-group select option {
        background: var(--gray-800);
    }

    .filter-btn {
        align-self: flex-end;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        color: var(--white);
        border: none;
        padding: 0.7rem 2rem;
        border-radius: var(--radius-sm);
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        font-size: 0.9rem;
        transition: var(--transition);
        white-space: nowrap;
    }

    .filter-btn:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-glow);
    }

    /* ========== CARDS DE EVENTOS ========== */
    .events-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 2rem;
    }

    .event-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
    }

    .event-card:hover {
        border-color: rgba(59, 130, 246, 0.3);
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }

    .event-image {
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        position: relative;
    }

    .event-image .event-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(10px);
        color: var(--white);
        padding: 0.3rem 0.8rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
    }

    .event-body {
        padding: 1.5rem;
    }

    .event-category-tag {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .event-title {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .event-details {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
    }

    .event-detail {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: var(--gray-400);
        font-size: 0.9rem;
    }

    .event-detail i {
        color: var(--blue-500);
        width: 16px;
        text-align: center;
    }

    .event-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1.25rem;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    .event-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--blue-400);
    }

    .event-price small {
        font-size: 0.8rem;
        font-weight: 400;
        color: var(--gray-400);
    }

    .buy-btn {
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        color: var(--white);
        border: none;
        padding: 0.65rem 1.5rem;
        border-radius: var(--radius-full);
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .buy-btn:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-glow);
    }

    /* No results */
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--gray-400);
    }

    .no-results i {
        font-size: 3rem;
        color: var(--gray-600);
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .filters-bar {
            flex-direction: column;
        }

        .filter-group {
            width: 100%;
        }

        .events-list {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <span class="section-badge"><i class="fas fa-calendar-alt"></i> Descubra</span>
            <h1 class="section-title">Todos os <span>Eventos</span></h1>
            <p class="section-subtitle">Encontre o evento perfeito filtrando por categoria, data ou localização.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <!-- Filtros -->
            <div class="filters-bar" id="filtersBar">
                <div class="filter-group">
                    <label for="filterCategoria"><i class="fas fa-tag"></i> Categoria</label>
                    <select id="filterCategoria">
                        <option value="">Todas as categorias</option>
                        <option value="musica">🎵 Música</option>
                        <option value="gastronomia">🍽️ Gastronomia</option>
                        <option value="esportes">⚽ Esportes</option>
                        <option value="educacao">📚 Educação</option>
                        <option value="tecnologia">💻 Tecnologia</option>
                        <option value="arte">🎨 Arte e Cultura</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filterData"><i class="fas fa-calendar"></i> Data</label>
                    <input type="date" id="filterData">
                </div>

                <div class="filter-group">
                    <label for="filterLocal"><i class="fas fa-map-marker-alt"></i> Localização</label>
                    <select id="filterLocal">
                        <option value="">Todas as cidades</option>
                        <option value="bh">Belo Horizonte - MG</option>
                        <option value="sp">São Paulo - SP</option>
                        <option value="rj">Rio de Janeiro - RJ</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="filterPreco"><i class="fas fa-dollar-sign"></i> Preço máximo</label>
                    <select id="filterPreco">
                        <option value="">Qualquer preço</option>
                        <option value="50">Até R$ 50</option>
                        <option value="100">Até R$ 100</option>
                        <option value="200">Até R$ 200</option>
                    </select>
                </div>

                <button class="filter-btn" onclick="filterEvents()">
                    <i class="fas fa-search"></i> Filtrar
                </button>
            </div>

            <!-- Lista de Eventos -->
            <div class="events-list" id="eventsList">
                <article class="event-card" data-categoria="musica" data-preco="85">
                    <div class="event-image" style="background: linear-gradient(135deg, #1e40af, #3b82f6);">
                        🎵
                        <span class="event-badge">⭐ Destaque</span>
                    </div>
                    <div class="event-body">
                        <span class="event-category-tag" style="background: rgba(59,130,246,0.15); color: var(--blue-400);">Música</span>
                        <h3 class="event-title">Festival de Jazz ao Vivo</h3>
                        <div class="event-details">
                            <div class="event-detail"><i class="fas fa-calendar"></i> 20 Jul 2026 às 19:00</div>
                            <div class="event-detail"><i class="fas fa-map-marker-alt"></i> Praça da Liberdade, BH - MG</div>
                            <div class="event-detail"><i class="fas fa-ticket-alt"></i> 150 ingressos restantes</div>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 85 <small>/pessoa</small></div>
                            <button class="buy-btn" onclick="window.location='/ingressos'"><i class="fas fa-shopping-cart"></i> Comprar</button>
                        </div>
                    </div>
                </article>

                <article class="event-card" data-categoria="gastronomia" data-preco="25">
                    <div class="event-image" style="background: linear-gradient(135deg, #059669, #10b981);">
                        🍽️
                    </div>
                    <div class="event-body">
                        <span class="event-category-tag" style="background: rgba(5,150,105,0.15); color: #10b981;">Gastronomia</span>
                        <h3 class="event-title">Feira Gastronômica Regional</h3>
                        <div class="event-details">
                            <div class="event-detail"><i class="fas fa-calendar"></i> 25 Jul 2026 às 11:00</div>
                            <div class="event-detail"><i class="fas fa-map-marker-alt"></i> Parque das Mangabeiras, BH - MG</div>
                            <div class="event-detail"><i class="fas fa-ticket-alt"></i> 500 ingressos restantes</div>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 25 <small>/pessoa</small></div>
                            <button class="buy-btn" onclick="window.location='/ingressos'"><i class="fas fa-shopping-cart"></i> Comprar</button>
                        </div>
                    </div>
                </article>

                <article class="event-card" data-categoria="educacao" data-preco="120">
                    <div class="event-image" style="background: linear-gradient(135deg, #7c3aed, #a78bfa);">
                        📚
                    </div>
                    <div class="event-body">
                        <span class="event-category-tag" style="background: rgba(124,58,237,0.15); color: #a78bfa;">Educação</span>
                        <h3 class="event-title">Workshop de Fotografia Urbana</h3>
                        <div class="event-details">
                            <div class="event-detail"><i class="fas fa-calendar"></i> 02 Ago 2026 às 09:00</div>
                            <div class="event-detail"><i class="fas fa-map-marker-alt"></i> Centro Cultural UFMG, BH - MG</div>
                            <div class="event-detail"><i class="fas fa-ticket-alt"></i> 30 ingressos restantes</div>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 120 <small>/pessoa</small></div>
                            <button class="buy-btn" onclick="window.location='/ingressos'"><i class="fas fa-shopping-cart"></i> Comprar</button>
                        </div>
                    </div>
                </article>

                <article class="event-card" data-categoria="esportes" data-preco="60">
                    <div class="event-image" style="background: linear-gradient(135deg, #dc2626, #f97316);">
                        ⚽
                        <span class="event-badge">🔥 Popular</span>
                    </div>
                    <div class="event-body">
                        <span class="event-category-tag" style="background: rgba(220,38,38,0.15); color: #ef4444;">Esportes</span>
                        <h3 class="event-title">Campeonato de E-Sports</h3>
                        <div class="event-details">
                            <div class="event-detail"><i class="fas fa-calendar"></i> 10 Ago 2026 às 14:00</div>
                            <div class="event-detail"><i class="fas fa-map-marker-alt"></i> Arena Esportiva, BH - MG</div>
                            <div class="event-detail"><i class="fas fa-ticket-alt"></i> 200 ingressos restantes</div>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 60 <small>/pessoa</small></div>
                            <button class="buy-btn" onclick="window.location='/ingressos'"><i class="fas fa-shopping-cart"></i> Comprar</button>
                        </div>
                    </div>
                </article>

                <article class="event-card" data-categoria="tecnologia" data-preco="150">
                    <div class="event-image" style="background: linear-gradient(135deg, #0891b2, #22d3ee);">
                        💻
                    </div>
                    <div class="event-body">
                        <span class="event-category-tag" style="background: rgba(8,145,178,0.15); color: #22d3ee;">Tecnologia</span>
                        <h3 class="event-title">Hackathon Dev Weekend</h3>
                        <div class="event-details">
                            <div class="event-detail"><i class="fas fa-calendar"></i> 15 Ago 2026 às 08:00</div>
                            <div class="event-detail"><i class="fas fa-map-marker-alt"></i> Hub de Inovação, BH - MG</div>
                            <div class="event-detail"><i class="fas fa-ticket-alt"></i> 80 ingressos restantes</div>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 150 <small>/pessoa</small></div>
                            <button class="buy-btn" onclick="window.location='/ingressos'"><i class="fas fa-shopping-cart"></i> Comprar</button>
                        </div>
                    </div>
                </article>

                <article class="event-card" data-categoria="arte" data-preco="40">
                    <div class="event-image" style="background: linear-gradient(135deg, #db2777, #f472b6);">
                        🎨
                    </div>
                    <div class="event-body">
                        <span class="event-category-tag" style="background: rgba(219,39,119,0.15); color: #f472b6;">Arte e Cultura</span>
                        <h3 class="event-title">Exposição Arte Contemporânea</h3>
                        <div class="event-details">
                            <div class="event-detail"><i class="fas fa-calendar"></i> 22 Ago 2026 às 10:00</div>
                            <div class="event-detail"><i class="fas fa-map-marker-alt"></i> Palácio das Artes, BH - MG</div>
                            <div class="event-detail"><i class="fas fa-ticket-alt"></i> 300 ingressos restantes</div>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 40 <small>/pessoa</small></div>
                            <button class="buy-btn" onclick="window.location='/ingressos'"><i class="fas fa-shopping-cart"></i> Comprar</button>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    function filterEvents() {
        const categoria = document.getElementById('filterCategoria').value;
        const preco = document.getElementById('filterPreco').value;
        const cards = document.querySelectorAll('.event-card');

        cards.forEach(card => {
            let show = true;

            if (categoria && card.dataset.categoria !== categoria) {
                show = false;
            }

            if (preco && parseFloat(card.dataset.preco) > parseFloat(preco)) {
                show = false;
            }

            card.style.display = show ? '' : 'none';
            if (show) {
                card.style.animation = 'fadeInUp 0.4s ease-out';
            }
        });
    }
</script>
@endsection
