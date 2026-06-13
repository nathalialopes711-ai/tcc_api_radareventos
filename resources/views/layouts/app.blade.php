<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Radar Eventos - Descubra e compre ingressos para os melhores eventos locais da sua cidade.')">
    <title>@yield('title', 'Radar Eventos') - Descubra Eventos Locais</title>
    <link rel="icon" href="/images/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        /* ========================================
           DESIGN SYSTEM - RADAR EVENTOS
           Paleta: Azul, Branco, Preto
           ======================================== */

        :root {
            /* Cores Primárias */
            --blue-50:  #eff6ff;
            --blue-100: #dbeafe;
            --blue-200: #bfdbfe;
            --blue-300: #93c5fd;
            --blue-400: #60a5fa;
            --blue-500: #3b82f6;
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
            --blue-800: #1e40af;
            --blue-900: #1e3a8a;
            --blue-950: #0f1d3d;

            /* Neutras */
            --black:    #000000;
            --gray-900: #0a0f1a;
            --gray-800: #111827;
            --gray-700: #1f2937;
            --gray-600: #374151;
            --gray-500: #6b7280;
            --gray-400: #9ca3af;
            --gray-300: #d1d5db;
            --gray-200: #e5e7eb;
            --gray-100: #f3f4f6;
            --gray-50:  #f9fafb;
            --white:    #ffffff;

            /* Semânticas */
            --success:  #10b981;
            --warning:  #f59e0b;
            --danger:   #ef4444;

            /* Espaçamentos */
            --nav-height: 72px;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-full: 9999px;

            /* Sombras */
            --shadow-sm:  0 1px 2px rgba(0,0,0,0.05);
            --shadow-md:  0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -2px rgba(0,0,0,0.1);
            --shadow-lg:  0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1);
            --shadow-xl:  0 20px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
            --shadow-glow: 0 0 30px rgba(37, 99, 235, 0.3);

            /* Transições */
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--gray-900);
            color: var(--white);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ========== NAVBAR ========== */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--nav-height);
            background: rgba(10, 15, 26, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            z-index: 1000;
            transition: var(--transition);
        }

        .navbar.scrolled {
            background: rgba(10, 15, 26, 0.95);
            box-shadow: 0 4px 30px rgba(0,0,0,0.3);
        }

        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--white);
        }

        .nav-logo img {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-sm);
        }

        .nav-logo-text {
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .nav-logo-text span {
            color: var(--blue-500);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--gray-300);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-sm);
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--white);
            background: rgba(59, 130, 246, 0.1);
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 3px;
            background: var(--blue-500);
            border-radius: var(--radius-full);
        }

        .nav-cta {
            background: linear-gradient(135deg, var(--blue-600), var(--blue-700)) !important;
            color: var(--white) !important;
            padding: 0.6rem 1.5rem !important;
            border-radius: var(--radius-full) !important;
            font-weight: 600 !important;
            box-shadow: var(--shadow-glow);
        }

        .nav-cta:hover {
            transform: translateY(-1px);
            box-shadow: 0 0 40px rgba(37, 99, 235, 0.5) !important;
        }

        /* Mobile Menu */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            margin-top: var(--nav-height);
            min-height: calc(100vh - var(--nav-height));
        }

        /* ========== FOOTER ========== */
        .footer {
            background: var(--black);
            border-top: 1px solid rgba(59, 130, 246, 0.1);
            padding: 3rem 0 1.5rem;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-bottom: 2rem;
        }

        .footer-brand p {
            color: var(--gray-400);
            margin-top: 1rem;
            font-size: 0.9rem;
            line-height: 1.7;
        }

        .footer-col h4 {
            color: var(--white);
            margin-bottom: 1rem;
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .footer-col a {
            display: block;
            color: var(--gray-400);
            text-decoration: none;
            font-size: 0.9rem;
            padding: 0.3rem 0;
            transition: var(--transition);
        }

        .footer-col a:hover {
            color: var(--blue-400);
            padding-left: 5px;
        }

        .footer-social {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .footer-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: var(--gray-800);
            border-radius: var(--radius-sm);
            color: var(--gray-400);
            font-size: 1.1rem;
            transition: var(--transition);
        }

        .footer-social a:hover {
            background: var(--blue-600);
            color: var(--white);
            transform: translateY(-2px);
            padding-left: 0;
        }

        .footer-bottom {
            border-top: 1px solid var(--gray-800);
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: var(--gray-500);
        }

        .footer-bottom a {
            color: var(--blue-400);
            text-decoration: none;
        }

        /* ========== UTILITY CLASSES ========== */
        .section {
            padding: 5rem 0;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: var(--blue-400);
            padding: 0.4rem 1rem;
            border-radius: var(--radius-full);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.2;
        }

        .section-title span {
            background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-subtitle {
            color: var(--gray-400);
            font-size: 1.1rem;
            margin-top: 1rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            border-radius: var(--radius-full);
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            font-family: inherit;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
            color: var(--white);
            box-shadow: var(--shadow-glow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 50px rgba(37, 99, 235, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid rgba(255,255,255,0.2);
        }

        .btn-outline:hover {
            border-color: var(--blue-500);
            background: rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }

        .btn-white {
            background: var(--white);
            color: var(--gray-900);
        }

        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        /* Cards genéricos */
        .card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: var(--radius-lg);
            padding: 2rem;
            transition: var(--transition);
        }

        .card:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(59, 130, 246, 0.2);
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
        }

        /* ========== ANIMATIONS ========== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(37, 99, 235, 0.3); }
            50% { box-shadow: 0 0 40px rgba(37, 99, 235, 0.6); }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-40px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }

        /* ========== RESPONSIVO ========== */
        @media (max-width: 968px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .mobile-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: var(--nav-height);
                left: 0;
                right: 0;
                background: rgba(10, 15, 26, 0.98);
                flex-direction: column;
                padding: 1rem;
                border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            }

            .nav-links.open {
                display: flex;
            }

            .nav-links a {
                padding: 0.75rem 1rem;
                width: 100%;
            }

            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- ========== NAVBAR ========== -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="/" class="nav-logo">
                <img src="/images/logo.png" alt="Radar Eventos Logo">
                <span class="nav-logo-text">Radar<span>Eventos</span></span>
            </a>

            <button class="mobile-toggle" id="mobileToggle" aria-label="Abrir menu">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-links" id="navLinks">
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Início</a></li>
                <li><a href="/eventos" class="{{ request()->is('eventos') ? 'active' : '' }}">Eventos</a></li>
                <li><a href="/mapa" class="{{ request()->is('mapa') ? 'active' : '' }}">Mapa</a></li>
                <li><a href="/ingressos" class="{{ request()->is('ingressos') ? 'active' : '' }}">Ingressos</a></li>
                <li><a href="/contato" class="{{ request()->is('contato') ? 'active' : '' }}">Contato</a></li>
                <li><a href="/login" class="nav-cta"><i class="fas fa-user"></i> Entrar</a></li>
            </ul>
        </div>
    </nav>

    <!-- ========== CONTEÚDO ========== -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- ========== FOOTER ========== -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/" class="nav-logo" style="margin-bottom: 0.5rem;">
                        <img src="/images/logo.png" alt="Radar Eventos" style="width:36px;height:36px;border-radius:6px;">
                        <span class="nav-logo-text">Radar<span>Eventos</span></span>
                    </a>
                    <p>Descubra os melhores eventos locais, explore o mapa interativo e compre seus ingressos com segurança e praticidade.</p>
                    <div class="footer-social">
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Navegação</h4>
                    <a href="/">Início</a>
                    <a href="/eventos">Eventos</a>
                    <a href="/mapa">Mapa</a>
                    <a href="/ingressos">Ingressos</a>
                </div>

                <div class="footer-col">
                    <h4>Suporte</h4>
                    <a href="/contato">Contato</a>
                    <a href="#">FAQ</a>
                    <a href="#">Termos de Uso</a>
                    <a href="#">Privacidade</a>
                </div>

                <div class="footer-col">
                    <h4>API</h4>
                    <a href="/api/status" target="_blank">/api/status</a>
                    <a href="/api/eventos" target="_blank">/api/eventos</a>
                    <a href="/api/categorias" target="_blank">/api/categorias</a>
                    <a href="/api/ingressos" target="_blank">/api/ingressos</a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Radar Eventos &mdash; Projeto de TCC</p>
                <p>Desenvolvido com <i class="fas fa-heart" style="color: var(--blue-500);"></i> usando Laravel</p>
            </div>
        </div>
    </footer>

    <!-- ========== SCRIPTS ========== -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobileToggle').addEventListener('click', () => {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('open');
            const icon = document.querySelector('#mobileToggle i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });
    </script>
    @yield('scripts')
</body>
</html>
