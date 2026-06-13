@extends('layouts.app')

@section('title', 'Entrar')
@section('meta_description', 'Faça login na sua conta Radar Eventos para gerenciar seus ingressos e preferências.')

@section('styles')
<style>
    .login-page {
        min-height: calc(100vh - var(--nav-height));
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    /* Background effects */
    .login-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .login-bg::before {
        content: '';
        position: absolute;
        top: -20%;
        right: -10%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.15), transparent 70%);
        border-radius: 50%;
    }

    .login-bg::after {
        content: '';
        position: absolute;
        bottom: -10%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.1), transparent 70%);
        border-radius: 50%;
    }

    .login-container {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        max-width: 960px;
        width: 100%;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0,0,0,0.3);
    }

    /* ========== LADO ESQUERDO: BRANDING ========== */
    .login-branding {
        background: linear-gradient(135deg, var(--blue-800), var(--blue-950));
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .login-branding::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.3), transparent 70%);
        border-radius: 50%;
    }

    .login-branding::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: -15%;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.2), transparent 70%);
        border-radius: 50%;
    }

    .login-branding > * {
        position: relative;
        z-index: 1;
    }

    .branding-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 2rem;
    }

    .branding-logo img {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-sm);
    }

    .branding-logo span {
        font-size: 1.5rem;
        font-weight: 800;
    }

    .branding-logo span em {
        color: var(--blue-400);
        font-style: normal;
    }

    .branding-title {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .branding-title span {
        color: var(--blue-400);
    }

    .branding-desc {
        color: var(--blue-200);
        font-size: 1rem;
        line-height: 1.7;
        margin-bottom: 2rem;
    }

    .branding-features {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .branding-feature {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.95rem;
        color: var(--blue-100);
    }

    .branding-feature-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        background: rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    /* ========== LADO DIREITO: FORMULÁRIO ========== */
    .login-form-side {
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: var(--gray-900);
    }

    .login-tabs {
        display: flex;
        background: var(--gray-800);
        border-radius: var(--radius-sm);
        padding: 4px;
        margin-bottom: 2rem;
    }

    .login-tab {
        flex: 1;
        padding: 0.6rem;
        text-align: center;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        color: var(--gray-400);
        border: none;
        background: none;
        font-family: inherit;
    }

    .login-tab.active {
        background: var(--blue-600);
        color: var(--white);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
    }

    .form-header {
        margin-bottom: 1.75rem;
    }

    .form-header h2 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
    }

    .form-header p {
        color: var(--gray-400);
        font-size: 0.9rem;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .login-form .form-group {
        display: flex;
        flex-direction: column;
    }

    .login-form label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray-300);
        margin-bottom: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-500);
        font-size: 0.9rem;
    }

    .input-wrapper input {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 2.75rem;
        background: var(--gray-800);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-sm);
        color: var(--white);
        font-family: inherit;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .input-wrapper input:focus {
        outline: none;
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
    }

    .input-wrapper input:focus + i,
    .input-wrapper input:focus ~ i {
        color: var(--blue-500);
    }

    .form-extras {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--gray-400);
        cursor: pointer;
    }

    .remember-me input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--blue-600);
        cursor: pointer;
    }

    .forgot-link {
        color: var(--blue-400);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
    }

    .forgot-link:hover {
        color: var(--blue-300);
        text-decoration: underline;
    }

    .login-btn {
        width: 100%;
        padding: 0.9rem;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        color: var(--white);
        border: none;
        border-radius: var(--radius-sm);
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 30px rgba(37, 99, 235, 0.4);
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: var(--gray-500);
        font-size: 0.85rem;
        margin: 0.5rem 0;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(255,255,255,0.1);
    }

    .social-logins {
        display: flex;
        gap: 0.75rem;
    }

    .social-login-btn {
        flex: 1;
        padding: 0.7rem;
        background: var(--gray-800);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-sm);
        color: var(--white);
        font-size: 1.1rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-family: inherit;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .social-login-btn:hover {
        background: rgba(255,255,255,0.08);
        border-color: rgba(255,255,255,0.2);
        transform: translateY(-1px);
    }

    .switch-form {
        text-align: center;
        margin-top: 1.25rem;
        color: var(--gray-400);
        font-size: 0.9rem;
    }

    .switch-form a {
        color: var(--blue-400);
        text-decoration: none;
        font-weight: 600;
    }

    .switch-form a:hover {
        text-decoration: underline;
    }

    /* ========== REGISTER FORM (hidden) ========== */
    .register-form {
        display: none;
    }

    .register-form.active {
        display: flex;
    }

    .login-form-container.hidden {
        display: none;
    }

    @media (max-width: 768px) {
        .login-container {
            grid-template-columns: 1fr;
        }

        .login-branding {
            display: none;
        }

        .login-form-side {
            padding: 2rem;
        }
    }
</style>
@endsection

@section('content')
    <div class="login-page">
        <div class="login-bg"></div>

        <div class="login-container">
            <!-- Branding -->
            <div class="login-branding">
                <div class="branding-logo">
                    <img src="/images/logo.png" alt="Radar Eventos">
                    <span>Radar<em>Eventos</em></span>
                </div>

                <h2 class="branding-title">Sua porta de entrada<br>para <span>eventos incríveis</span></h2>
                <p class="branding-desc">Crie sua conta e tenha acesso a eventos exclusivos, compre ingressos com segurança e nunca mais perca um evento na sua cidade.</p>

                <div class="branding-features">
                    <div class="branding-feature">
                        <div class="branding-feature-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <span>Mapa interativo com eventos próximos</span>
                    </div>
                    <div class="branding-feature">
                        <div class="branding-feature-icon"><i class="fas fa-ticket-alt"></i></div>
                        <span>Compra de ingressos 100% segura</span>
                    </div>
                    <div class="branding-feature">
                        <div class="branding-feature-icon"><i class="fas fa-filter"></i></div>
                        <span>Filtros avançados por categoria</span>
                    </div>
                    <div class="branding-feature">
                        <div class="branding-feature-icon"><i class="fas fa-bell"></i></div>
                        <span>Alertas personalizados de eventos</span>
                    </div>
                </div>
            </div>

            <!-- Formulário -->
            <div class="login-form-side">
                <div class="login-tabs">
                    <button class="login-tab active" onclick="showTab('login')">Entrar</button>
                    <button class="login-tab" onclick="showTab('register')">Criar Conta</button>
                </div>

                <!-- LOGIN -->
                <div id="loginForm" class="login-form-container">
                    <div class="form-header">
                        <h2>Bem-vindo de volta!</h2>
                        <p>Entre com suas credenciais para acessar sua conta.</p>
                    </div>

                    <form class="login-form" onsubmit="handleLogin(event)">
                        <div class="form-group">
                            <label for="loginEmail">E-mail</label>
                            <div class="input-wrapper">
                                <input type="email" id="loginEmail" placeholder="seu@email.com" required>
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="loginPassword">Senha</label>
                            <div class="input-wrapper">
                                <input type="password" id="loginPassword" placeholder="••••••••" required>
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                        <div class="form-extras">
                            <label class="remember-me">
                                <input type="checkbox"> Lembrar de mim
                            </label>
                            <a href="#" class="forgot-link">Esqueceu a senha?</a>
                        </div>

                        <button type="submit" class="login-btn">
                            <i class="fas fa-sign-in-alt"></i> Entrar
                        </button>
                    </form>

                    <div class="divider">ou entre com</div>

                    <div class="social-logins">
                        <button class="social-login-btn"><i class="fab fa-google"></i> Google</button>
                        <button class="social-login-btn"><i class="fab fa-facebook-f"></i> Facebook</button>
                    </div>

                    <p class="switch-form">
                        Não tem uma conta? <a href="#" onclick="showTab('register'); return false;">Cadastre-se</a>
                    </p>
                </div>

                <!-- REGISTER -->
                <div id="registerForm" class="login-form-container hidden">
                    <div class="form-header">
                        <h2>Crie sua conta</h2>
                        <p>É rápido, gratuito e sem compromisso.</p>
                    </div>

                    <form class="login-form" onsubmit="handleRegister(event)">
                        <div class="form-group">
                            <label for="regName">Nome completo</label>
                            <div class="input-wrapper">
                                <input type="text" id="regName" placeholder="Seu nome" required>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="regEmail">E-mail</label>
                            <div class="input-wrapper">
                                <input type="email" id="regEmail" placeholder="seu@email.com" required>
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="regPassword">Senha</label>
                            <div class="input-wrapper">
                                <input type="password" id="regPassword" placeholder="Mínimo 8 caracteres" required minlength="8">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="regPasswordConfirm">Confirmar Senha</label>
                            <div class="input-wrapper">
                                <input type="password" id="regPasswordConfirm" placeholder="Repita a senha" required>
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>

                        <button type="submit" class="login-btn">
                            <i class="fas fa-user-plus"></i> Criar Conta
                        </button>
                    </form>

                    <p class="switch-form">
                        Já tem uma conta? <a href="#" onclick="showTab('login'); return false;">Entrar</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function showTab(tab) {
        const tabs = document.querySelectorAll('.login-tab');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        tabs.forEach(t => t.classList.remove('active'));

        if (tab === 'login') {
            tabs[0].classList.add('active');
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
        } else {
            tabs[1].classList.add('active');
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
        }
    }

    function handleLogin(e) {
        e.preventDefault();
        alert('Login realizado com sucesso! 🎉\n\nRedirecionando para a página de eventos...');
        window.location.href = '/eventos';
    }

    function handleRegister(e) {
        e.preventDefault();
        const pass = document.getElementById('regPassword').value;
        const confirm = document.getElementById('regPasswordConfirm').value;

        if (pass !== confirm) {
            alert('As senhas não coincidem!');
            return;
        }

        alert('Conta criada com sucesso! 🎉\n\nVocê já pode fazer login.');
        showTab('login');
    }
</script>
@endsection
