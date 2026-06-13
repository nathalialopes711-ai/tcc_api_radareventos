@extends('layouts.app')

@section('title', 'Início')
@section('meta_description', 'Radar Eventos - Encontre os melhores eventos da sua cidade, explore o mapa e compre ingressos online.')

@section('styles')
<style>
    /* ========== HERO ========== */
    .hero {
        position: relative;
        min-height: 92vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        background: url('/images/hero-bg.png') center/cover no-repeat;
        z-index: 0;
    }

    .hero-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg,
            rgba(10, 15, 26, 0.92) 0%,
            rgba(10, 15, 26, 0.75) 50%,
            rgba(30, 64, 175, 0.4) 100%);
    }

    .hero-particles {
        position: absolute;
        inset: 0;
        z-index: 1;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: var(--blue-400);
        border-radius: 50%;
        opacity: 0.3;
        animation: float 6s ease-in-out infinite;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .hero-text {
        animation: fadeInUp 0.8s ease-out;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(59, 130, 246, 0.15);
        border: 1px solid rgba(59, 130, 246, 0.3);
        color: var(--blue-400);
        padding: 0.5rem 1.2rem;
        border-radius: var(--radius-full);
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        animation: pulse-glow 3s infinite;
    }

    .hero-title {
        font-size: clamp(2.5rem, 5.5vw, 4rem);
        font-weight: 900;
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 1.5rem;
    }

    .hero-title .gradient {
        background: linear-gradient(135deg, var(--blue-400), var(--blue-600), #818cf8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-description {
        font-size: 1.2rem;
        color: var(--gray-300);
        line-height: 1.7;
        margin-bottom: 2.5rem;
        max-width: 520px;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .hero-stats {
        display: flex;
        gap: 2rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    .hero-stat {
        text-align: center;
    }

    .hero-stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--blue-400);
        display: block;
    }

    .hero-stat-label {
        font-size: 0.85rem;
        color: var(--gray-400);
        margin-top: 0.25rem;
    }

    .hero-visual {
        animation: fadeInUp 0.8s ease-out 0.3s backwards;
    }

    .hero-card-stack {
        position: relative;
        height: 420px;
    }

    .hero-card {
        position: absolute;
        background: rgba(255,255,255,0.06);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-xl);
        padding: 1.5rem;
        transition: var(--transition);
    }

    .hero-card-1 {
        top: 0;
        right: 0;
        width: 320px;
        animation: float 5s ease-in-out infinite;
    }

    .hero-card-2 {
        top: 140px;
        left: 0;
        width: 280px;
        animation: float 6s ease-in-out infinite 1s;
    }

    .hero-card-3 {
        bottom: 0;
        right: 40px;
        width: 260px;
        animation: float 7s ease-in-out infinite 0.5s;
    }

    .hc-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .hc-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .hc-title {
        font-weight: 700;
        font-size: 0.95rem;
    }

    .hc-subtitle {
        font-size: 0.8rem;
        color: var(--gray-400);
    }

    .hc-tag {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* ========== CATEGORIAS ========== */
    .categories-section {
        background: var(--gray-800);
        position: relative;
    }

    .categories-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--blue-500), transparent);
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
    }

    .category-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-lg);
        padding: 2rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        color: inherit;
    }

    .category-card:hover {
        background: rgba(59, 130, 246, 0.1);
        border-color: var(--blue-500);
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
    }

    .category-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: block;
    }

    .category-name {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .category-count {
        color: var(--gray-400);
        font-size: 0.85rem;
    }

    /* ========== EVENTOS EM DESTAQUE ========== */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
        box-shadow: var(--shadow-xl);
    }

    .event-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
    }

    .event-body {
        padding: 1.5rem;
    }

    .event-category {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 600;
        background: rgba(59, 130, 246, 0.15);
        color: var(--blue-400);
        margin-bottom: 0.75rem;
    }

    .event-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .event-info {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        color: var(--gray-400);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .event-info i {
        width: 18px;
        color: var(--blue-500);
        margin-right: 0.5rem;
    }

    .event-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid rgba(255,255,255,0.06);
    }

    .event-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--blue-400);
    }

    .event-price small {
        font-size: 0.8rem;
        font-weight: 400;
        color: var(--gray-400);
    }

    .event-buy-btn {
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        color: var(--white);
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: var(--radius-full);
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
    }

    .event-buy-btn:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-glow);
    }

    /* ========== CTA SECTION ========== */
    .cta-section {
        position: relative;
        overflow: hidden;
    }

    .cta-box {
        background: linear-gradient(135deg, var(--blue-800), var(--blue-900));
        border-radius: var(--radius-xl);
        padding: 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-box::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.3), transparent 70%);
        border-radius: 50%;
    }

    .cta-box::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.2), transparent 70%);
        border-radius: 50%;
    }

    .cta-box > * {
        position: relative;
        z-index: 1;
    }

    .cta-title {
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 800;
        margin-bottom: 1rem;
    }

    .cta-description {
        color: var(--blue-200);
        font-size: 1.1rem;
        margin-bottom: 2rem;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
    }

    /* ========== RESPONSIVO ========== */
    @media (max-width: 968px) {
        .hero-content {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .hero-description {
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            justify-content: center;
        }

        .hero-stats {
            justify-content: center;
        }

        .hero-visual {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.2rem;
        }

        .cta-box {
            padding: 2.5rem 1.5rem;
        }
    }
</style>
@endsection

@section('content')
    <!-- ========== HERO ========== -->
    <section class="hero" id="hero">
        <div class="hero-bg"></div>

        <div class="hero-particles">
            <div class="particle" style="top: 20%; left: 10%;"></div>
            <div class="particle" style="top: 60%; left: 25%; animation-delay: 2s;"></div>
            <div class="particle" style="top: 30%; left: 70%; animation-delay: 4s;"></div>
            <div class="particle" style="top: 75%; left: 85%; animation-delay: 1s;"></div>
            <div class="particle" style="top: 45%; left: 50%; animation-delay: 3s;"></div>
        </div>

        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fas fa-radar"></i>
                    🎯 Plataforma de Eventos #1
                </div>

                <h1 class="hero-title">
                    Descubra eventos<br>
                    <span class="gradient">perto de você</span>
                </h1>

                <p class="hero-description">
                    Explore o mapa interativo, filtre por categorias e compre ingressos
                    para os melhores eventos da sua região com total segurança.
                </p>

                <div class="hero-buttons">
                    <a href="/eventos" class="btn btn-primary">
                        <i class="fas fa-search"></i> Explorar Eventos
                    </a>
                    <a href="/mapa" class="btn btn-outline">
                        <i class="fas fa-map-marked-alt"></i> Ver no Mapa
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <span class="hero-stat-number">150+</span>
                        <span class="hero-stat-label">Eventos Ativos</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">50k+</span>
                        <span class="hero-stat-label">Ingressos Vendidos</span>
                    </div>
                    <div class="hero-stat">
                        <span class="hero-stat-number">30+</span>
                        <span class="hero-stat-label">Cidades</span>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-card-stack">
                    <div class="hero-card hero-card-1">
                        <div class="hc-header">
                            <div class="hc-icon" style="background: rgba(59,130,246,0.2); color: var(--blue-400);">
                                <i class="fas fa-music"></i>
                            </div>
                            <div>
                                <div class="hc-title">Festival de Jazz</div>
                                <div class="hc-subtitle">Praça da Liberdade</div>
                            </div>
                        </div>
                        <span class="hc-tag" style="background: rgba(16,185,129,0.15); color: #10b981;">🎟️ Ingressos disponíveis</span>
                    </div>

                    <div class="hero-card hero-card-2">
                        <div class="hc-header">
                            <div class="hc-icon" style="background: rgba(245,158,11,0.2); color: #f59e0b;">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div>
                                <div class="hc-title">Feira Gastronômica</div>
                                <div class="hc-subtitle">Parque das Mangabeiras</div>
                            </div>
                        </div>
                        <span class="hc-tag" style="background: rgba(59,130,246,0.15); color: var(--blue-400);">📍 2.5 km de você</span>
                    </div>

                    <div class="hero-card hero-card-3">
                        <div class="hc-header">
                            <div class="hc-icon" style="background: rgba(139,92,246,0.2); color: #8b5cf6;">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <div>
                                <div class="hc-title">E-Sports Arena</div>
                                <div class="hc-subtitle">Arena Esportiva</div>
                            </div>
                        </div>
                        <span class="hc-tag" style="background: rgba(239,68,68,0.15); color: #ef4444;">🔥 Últimos ingressos</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== CATEGORIAS ========== -->
    <section class="section categories-section" id="categorias">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><i class="fas fa-th-large"></i> Categorias</span>
                <h2 class="section-title">Explore por <span>Categorias</span></h2>
                <p class="section-subtitle">Encontre eventos que combinam com seus interesses. Filtre por tipo e descubra experiências incríveis.</p>
            </div>

            <div class="categories-grid">
                <a href="/eventos?categoria=musica" class="category-card">
                    <span class="category-icon">🎵</span>
                    <div class="category-name">Música</div>
                    <div class="category-count">12 eventos</div>
                </a>
                <a href="/eventos?categoria=gastronomia" class="category-card">
                    <span class="category-icon">🍽️</span>
                    <div class="category-name">Gastronomia</div>
                    <div class="category-count">8 eventos</div>
                </a>
                <a href="/eventos?categoria=esportes" class="category-card">
                    <span class="category-icon">⚽</span>
                    <div class="category-name">Esportes</div>
                    <div class="category-count">15 eventos</div>
                </a>
                <a href="/eventos?categoria=educacao" class="category-card">
                    <span class="category-icon">📚</span>
                    <div class="category-name">Educação</div>
                    <div class="category-count">6 eventos</div>
                </a>
                <a href="/eventos?categoria=tecnologia" class="category-card">
                    <span class="category-icon">💻</span>
                    <div class="category-name">Tecnologia</div>
                    <div class="category-count">9 eventos</div>
                </a>
                <a href="/eventos?categoria=arte" class="category-card">
                    <span class="category-icon">🎨</span>
                    <div class="category-name">Arte e Cultura</div>
                    <div class="category-count">11 eventos</div>
                </a>
            </div>
        </div>
    </section>

    <!-- ========== EVENTOS EM DESTAQUE ========== -->
    <section class="section" id="destaques">
        <div class="container">
            <div class="section-header">
                <span class="section-badge"><i class="fas fa-fire"></i> Destaques</span>
                <h2 class="section-title">Eventos em <span>Destaque</span></h2>
                <p class="section-subtitle">Os eventos mais procurados e populares da região. Garanta seu ingresso!</p>
            </div>

            <div class="events-grid">
                <article class="event-card">
                    <div class="event-image" style="background: linear-gradient(135deg, #1e40af, #3b82f6);">🎵</div>
                    <div class="event-body">
                        <span class="event-category">Música</span>
                        <h3 class="event-title">Festival de Jazz ao Vivo</h3>
                        <div class="event-info">
                            <span><i class="fas fa-calendar"></i> 20 Jul 2026 às 19:00</span>
                            <span><i class="fas fa-map-marker-alt"></i> Praça da Liberdade, BH</span>
                            <span><i class="fas fa-ticket-alt"></i> 150 ingressos restantes</span>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 85 <small>/pessoa</small></div>
                            <button class="event-buy-btn" onclick="window.location='/ingressos'">Comprar</button>
                        </div>
                    </div>
                </article>

                <article class="event-card">
                    <div class="event-image" style="background: linear-gradient(135deg, #059669, #10b981);">🍽️</div>
                    <div class="event-body">
                        <span class="event-category" style="background: rgba(5,150,105,0.15); color: #10b981;">Gastronomia</span>
                        <h3 class="event-title">Feira Gastronômica Regional</h3>
                        <div class="event-info">
                            <span><i class="fas fa-calendar"></i> 25 Jul 2026 às 11:00</span>
                            <span><i class="fas fa-map-marker-alt"></i> Parque das Mangabeiras, BH</span>
                            <span><i class="fas fa-ticket-alt"></i> 500 ingressos restantes</span>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 25 <small>/pessoa</small></div>
                            <button class="event-buy-btn" onclick="window.location='/ingressos'">Comprar</button>
                        </div>
                    </div>
                </article>

                <article class="event-card">
                    <div class="event-image" style="background: linear-gradient(135deg, #dc2626, #f97316);">⚽</div>
                    <div class="event-body">
                        <span class="event-category" style="background: rgba(220,38,38,0.15); color: #ef4444;">Esportes</span>
                        <h3 class="event-title">Campeonato de E-Sports</h3>
                        <div class="event-info">
                            <span><i class="fas fa-calendar"></i> 10 Ago 2026 às 14:00</span>
                            <span><i class="fas fa-map-marker-alt"></i> Arena Esportiva, BH</span>
                            <span><i class="fas fa-ticket-alt"></i> 200 ingressos restantes</span>
                        </div>
                        <div class="event-footer">
                            <div class="event-price">R$ 60 <small>/pessoa</small></div>
                            <button class="event-buy-btn" onclick="window.location='/ingressos'">Comprar</button>
                        </div>
                    </div>
                </article>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <a href="/eventos" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i> Ver Todos os Eventos
                </a>
            </div>
        </div>
    </section>

    <!-- ========== CTA ========== -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-box">
                <h2 class="cta-title">Pronto para descobrir seu próximo evento?</h2>
                <p class="cta-description">Cadastre-se gratuitamente e receba alertas personalizados sobre eventos na sua região.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="/login" class="btn btn-white"><i class="fas fa-user-plus"></i> Criar Conta Gratuita</a>
                    <a href="/mapa" class="btn btn-outline"><i class="fas fa-map"></i> Explorar Mapa</a>
                </div>
            </div>
        </div>
    </section>
@endsection
