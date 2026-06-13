@extends('layouts.app')

@section('title', 'Contato')
@section('meta_description', 'Entre em contato com a equipe do Radar Eventos. Estamos prontos para ajudar!')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, var(--gray-900) 0%, var(--blue-950) 100%);
        padding: 6rem 0 3rem;
        text-align: center;
        position: relative;
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

    /* ========== CONTACT LAYOUT ========== */
    .contact-layout {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 3rem;
        align-items: start;
    }

    /* ========== INFO LATERAL ========== */
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .contact-info-title {
        font-size: 1.6rem;
        font-weight: 800;
        line-height: 1.3;
    }

    .contact-info-title span {
        background: linear-gradient(135deg, var(--blue-400), var(--blue-600));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-info-desc {
        color: var(--gray-400);
        font-size: 1rem;
        line-height: 1.7;
    }

    .info-card {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.5rem;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-lg);
        transition: var(--transition);
    }

    .info-card:hover {
        background: rgba(59, 130, 246, 0.08);
        border-color: rgba(59, 130, 246, 0.2);
        transform: translateX(5px);
    }

    .info-card-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        background: rgba(59, 130, 246, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--blue-400);
        flex-shrink: 0;
    }

    .info-card-content h4 {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .info-card-content p {
        color: var(--gray-400);
        font-size: 0.9rem;
    }

    .info-card-content a {
        color: var(--blue-400);
        text-decoration: none;
        transition: var(--transition);
    }

    .info-card-content a:hover {
        color: var(--blue-300);
        text-decoration: underline;
    }

    /* Social Links */
    .social-links {
        display: flex;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .social-link {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-sm);
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray-400);
        font-size: 1.1rem;
        text-decoration: none;
        transition: var(--transition);
    }

    .social-link:hover {
        background: var(--blue-600);
        border-color: var(--blue-500);
        color: var(--white);
        transform: translateY(-3px);
    }

    /* ========== FORMULÁRIO ========== */
    .contact-form-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-xl);
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .contact-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--blue-500), var(--blue-700));
    }

    .form-title {
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        color: var(--gray-400);
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.25rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray-300);
        margin-bottom: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem 1rem;
        background: var(--gray-800);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-sm);
        color: var(--white);
        font-family: inherit;
        font-size: 0.9rem;
        transition: var(--transition);
        resize: vertical;
    }

    .form-group textarea {
        min-height: 130px;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
    }

    .form-group select option {
        background: var(--gray-800);
    }

    .submit-btn {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        color: var(--white);
        border: none;
        border-radius: var(--radius-md);
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 40px rgba(37, 99, 235, 0.4);
    }

    /* ========== SUCCESS TOAST ========== */
    .toast {
        position: fixed;
        top: calc(var(--nav-height) + 1rem);
        right: 1rem;
        background: var(--gray-800);
        border: 1px solid rgba(16,185,129,0.3);
        border-radius: var(--radius-md);
        padding: 1rem 1.5rem;
        display: none;
        align-items: center;
        gap: 0.75rem;
        z-index: 1500;
        animation: slideInRight 0.4s ease-out;
        box-shadow: var(--shadow-xl);
    }

    .toast.show {
        display: flex;
    }

    .toast-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: rgba(16,185,129,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--success);
    }

    .toast-text strong {
        display: block;
        font-size: 0.95rem;
    }

    .toast-text span {
        color: var(--gray-400);
        font-size: 0.85rem;
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* ========== FAQ ========== */
    .faq-section {
        margin-top: 4rem;
    }

    .faq-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .faq-item {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        transition: var(--transition);
    }

    .faq-item:hover {
        border-color: rgba(59, 130, 246, 0.2);
    }

    .faq-question {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .faq-question i {
        color: var(--blue-500);
        font-size: 0.9rem;
    }

    .faq-answer {
        color: var(--gray-400);
        font-size: 0.9rem;
        line-height: 1.7;
    }

    @media (max-width: 968px) {
        .contact-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full-width {
            grid-column: 1;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <span class="section-badge"><i class="fas fa-envelope"></i> Suporte</span>
            <h1 class="section-title">Fale <span>Conosco</span></h1>
            <p class="section-subtitle">Tem dúvidas, sugestões ou precisa de ajuda? Nossa equipe está pronta para atender você.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="contact-layout">
                <!-- Info -->
                <div class="contact-info">
                    <div>
                        <h2 class="contact-info-title">Estamos aqui<br>para <span>ajudar</span></h2>
                        <p class="contact-info-desc">
                            Responderemos sua mensagem em até 24 horas úteis.
                            Você também pode nos encontrar nas redes sociais.
                        </p>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-envelope"></i></div>
                        <div class="info-card-content">
                            <h4>E-mail</h4>
                            <p><a href="mailto:contato@radareventos.com.br">contato@radareventos.com.br</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-phone"></i></div>
                        <div class="info-card-content">
                            <h4>Telefone</h4>
                            <p><a href="tel:+5531999999999">(31) 99999-9999</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="info-card-content">
                            <h4>Endereço</h4>
                            <p>Belo Horizonte, MG - Brasil</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon"><i class="fas fa-clock"></i></div>
                        <div class="info-card-content">
                            <h4>Horário de Atendimento</h4>
                            <p>Seg. a Sex. — 08:00 às 18:00</p>
                        </div>
                    </div>

                    <div>
                        <h4 style="margin-bottom: 0.75rem; font-size: 0.9rem; color: var(--gray-300);">Siga-nos nas redes</h4>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Formulário -->
                <div class="contact-form-card">
                    <h3 class="form-title">Envie sua Mensagem</h3>
                    <p class="form-subtitle">Preencha o formulário abaixo e retornaremos em breve.</p>

                    <form id="contactForm" onsubmit="submitContact(event)">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="contactName">Nome</label>
                                <input type="text" id="contactName" placeholder="Seu nome" required>
                            </div>

                            <div class="form-group">
                                <label for="contactEmail">E-mail</label>
                                <input type="email" id="contactEmail" placeholder="seu@email.com" required>
                            </div>

                            <div class="form-group">
                                <label for="contactPhone">Telefone</label>
                                <input type="tel" id="contactPhone" placeholder="(00) 00000-0000">
                            </div>

                            <div class="form-group">
                                <label for="contactSubject">Assunto</label>
                                <select id="contactSubject" required>
                                    <option value="">Selecione...</option>
                                    <option value="duvida">Dúvida sobre evento</option>
                                    <option value="ingresso">Problema com ingresso</option>
                                    <option value="sugestao">Sugestão</option>
                                    <option value="parceria">Parceria</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>

                            <div class="form-group full-width">
                                <label for="contactMessage">Mensagem</label>
                                <textarea id="contactMessage" placeholder="Descreva sua dúvida ou mensagem..." required></textarea>
                            </div>

                            <div class="form-group full-width">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i> Enviar Mensagem
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- FAQ -->
            <div class="faq-section">
                <div class="section-header">
                    <span class="section-badge"><i class="fas fa-question-circle"></i> Dúvidas</span>
                    <h2 class="section-title">Perguntas <span>Frequentes</span></h2>
                </div>

                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question"><i class="fas fa-chevron-right"></i> Como comprar ingressos?</div>
                        <p class="faq-answer">Acesse a página de Ingressos, selecione o evento desejado, escolha o tipo e quantidade, preencha seus dados e finalize a compra.</p>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"><i class="fas fa-chevron-right"></i> Posso cancelar uma compra?</div>
                        <p class="faq-answer">Sim, cancelamentos podem ser feitos até 48h antes do evento. Entre em contato conosco com o código do ingresso.</p>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"><i class="fas fa-chevron-right"></i> Como funciona o mapa?</div>
                        <p class="faq-answer">O mapa interativo exibe todos os eventos registrados com marcadores. Clique em um marcador para ver os detalhes e comprar ingressos.</p>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"><i class="fas fa-chevron-right"></i> É seguro comprar pelo site?</div>
                        <p class="faq-answer">Todos os pagamentos são processados com criptografia SSL. Seus dados estão protegidos com as melhores práticas de segurança.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Toast de Sucesso -->
    <div class="toast" id="successToast">
        <div class="toast-icon"><i class="fas fa-check"></i></div>
        <div class="toast-text">
            <strong>Mensagem enviada!</strong>
            <span>Retornaremos em até 24h.</span>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function submitContact(e) {
        e.preventDefault();

        const toast = document.getElementById('successToast');
        toast.classList.add('show');

        document.getElementById('contactForm').reset();

        setTimeout(() => {
            toast.classList.remove('show');
        }, 4000);
    }
</script>
@endsection
