@extends('layouts.app')

@section('title', 'Ingressos')
@section('meta_description', 'Compre ingressos para os melhores eventos locais com segurança e praticidade.')

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

    /* ========== CHECKOUT LAYOUT ========== */
    .checkout-layout {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 2rem;
        align-items: start;
    }

    /* ========== SELEÇÃO DE EVENTO ========== */
    .ticket-selector {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    .ts-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    .ts-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
    }

    .ts-header p {
        color: var(--gray-400);
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    .ticket-event {
        display: flex;
        gap: 1.5rem;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        cursor: pointer;
        transition: var(--transition);
    }

    .ticket-event:hover,
    .ticket-event.selected {
        background: rgba(59, 130, 246, 0.08);
    }

    .ticket-event.selected {
        border-left: 3px solid var(--blue-500);
    }

    .te-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .te-info {
        flex: 1;
    }

    .te-info h4 {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .te-info .te-meta {
        color: var(--gray-400);
        font-size: 0.85rem;
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .te-info .te-meta i {
        color: var(--blue-500);
        width: 14px;
        margin-right: 0.4rem;
    }

    .te-price-col {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
        gap: 0.25rem;
    }

    .te-price {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--blue-400);
    }

    .te-stock {
        font-size: 0.75rem;
        color: var(--gray-400);
    }

    .te-stock.low {
        color: var(--danger);
    }

    /* ========== TIPO DE INGRESSO ========== */
    .ticket-types {
        padding: 1.5rem 2rem;
    }

    .ticket-types h4 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .ticket-type {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.25rem;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-md);
        margin-bottom: 0.75rem;
        transition: var(--transition);
    }

    .ticket-type:hover {
        border-color: rgba(59, 130, 246, 0.3);
    }

    .tt-info h5 {
        font-weight: 700;
        font-size: 0.95rem;
    }

    .tt-info p {
        color: var(--gray-400);
        font-size: 0.8rem;
        margin-top: 0.2rem;
    }

    .tt-controls {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .tt-price {
        font-weight: 800;
        color: var(--blue-400);
        font-size: 1.1rem;
        min-width: 70px;
        text-align: right;
    }

    .qty-control {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: var(--radius-sm);
        border: 1px solid rgba(255,255,255,0.15);
        background: var(--gray-800);
        color: var(--white);
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .qty-btn:hover {
        background: var(--blue-600);
        border-color: var(--blue-500);
    }

    .qty-value {
        width: 32px;
        text-align: center;
        font-weight: 700;
        font-size: 1rem;
    }

    /* ========== RESUMO DA COMPRA ========== */
    .order-summary {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: var(--radius-lg);
        padding: 2rem;
        position: sticky;
        top: calc(var(--nav-height) + 2rem);
    }

    .os-title {
        font-size: 1.2rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .os-title i {
        color: var(--blue-500);
    }

    .os-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        font-size: 0.95rem;
    }

    .os-item-label {
        color: var(--gray-400);
    }

    .os-item-value {
        font-weight: 600;
    }

    .os-total {
        display: flex;
        justify-content: space-between;
        padding: 1.25rem 0 0;
        font-size: 1.3rem;
        font-weight: 800;
    }

    .os-total-value {
        color: var(--blue-400);
    }

    .os-form {
        margin-top: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .os-form label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray-400);
        margin-bottom: 0.25rem;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .os-form input {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--gray-800);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-sm);
        color: var(--white);
        font-family: inherit;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .os-form input:focus {
        outline: none;
        border-color: var(--blue-500);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
    }

    .checkout-btn {
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

    .checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 40px rgba(37, 99, 235, 0.4);
    }

    .secure-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 1rem;
        font-size: 0.8rem;
        color: var(--gray-500);
    }

    .secure-badge i {
        color: var(--success);
    }

    /* ========== SUCCESS MODAL ========== */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.7);
        backdrop-filter: blur(8px);
        z-index: 2000;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-box {
        background: var(--gray-800);
        border: 1px solid rgba(59,130,246,0.2);
        border-radius: var(--radius-xl);
        padding: 3rem;
        max-width: 440px;
        width: 90%;
        text-align: center;
        animation: fadeInUp 0.4s ease-out;
    }

    .modal-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(16,185,129,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: var(--success);
    }

    .modal-box h3 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
    }

    .modal-box p {
        color: var(--gray-400);
        margin-bottom: 1.5rem;
    }

    .modal-code {
        background: var(--gray-900);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: var(--radius-md);
        padding: 1rem;
        font-family: monospace;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--blue-400);
        letter-spacing: 2px;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 968px) {
        .checkout-layout {
            grid-template-columns: 1fr;
        }

        .order-summary {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .ticket-event {
            flex-direction: column;
            gap: 1rem;
        }

        .te-price-col {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        .tt-controls {
            flex-direction: column;
            align-items: flex-end;
            gap: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <div class="container">
            <span class="section-badge"><i class="fas fa-ticket-alt"></i> Compra Segura</span>
            <h1 class="section-title">Comprar <span>Ingressos</span></h1>
            <p class="section-subtitle">Selecione um evento, escolha o tipo de ingresso e finalize sua compra com segurança.</p>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="checkout-layout">
                <!-- Lado Esquerdo: Seleção -->
                <div>
                    <div class="ticket-selector">
                        <div class="ts-header">
                            <h3><i class="fas fa-calendar-check" style="color: var(--blue-500); margin-right: 0.5rem;"></i> Selecione o Evento</h3>
                            <p>Clique no evento para selecionar</p>
                        </div>

                        <div class="ticket-event selected" onclick="selectEvent(this, 'Festival de Jazz ao Vivo', 85)" data-event="jazz">
                            <div class="te-icon" style="background: rgba(59,130,246,0.2);">🎵</div>
                            <div class="te-info">
                                <h4>Festival de Jazz ao Vivo</h4>
                                <div class="te-meta">
                                    <span><i class="fas fa-calendar"></i> 20 Jul 2026 · 19:00</span>
                                    <span><i class="fas fa-map-marker-alt"></i> Praça da Liberdade, BH</span>
                                </div>
                            </div>
                            <div class="te-price-col">
                                <span class="te-price">R$ 85</span>
                                <span class="te-stock">150 disponíveis</span>
                            </div>
                        </div>

                        <div class="ticket-event" onclick="selectEvent(this, 'Feira Gastronômica Regional', 25)" data-event="gastro">
                            <div class="te-icon" style="background: rgba(5,150,105,0.2);">🍽️</div>
                            <div class="te-info">
                                <h4>Feira Gastronômica Regional</h4>
                                <div class="te-meta">
                                    <span><i class="fas fa-calendar"></i> 25 Jul 2026 · 11:00</span>
                                    <span><i class="fas fa-map-marker-alt"></i> Parque das Mangabeiras, BH</span>
                                </div>
                            </div>
                            <div class="te-price-col">
                                <span class="te-price">R$ 25</span>
                                <span class="te-stock">500 disponíveis</span>
                            </div>
                        </div>

                        <div class="ticket-event" onclick="selectEvent(this, 'Workshop de Fotografia', 120)" data-event="foto">
                            <div class="te-icon" style="background: rgba(124,58,237,0.2);">📚</div>
                            <div class="te-info">
                                <h4>Workshop de Fotografia Urbana</h4>
                                <div class="te-meta">
                                    <span><i class="fas fa-calendar"></i> 02 Ago 2026 · 09:00</span>
                                    <span><i class="fas fa-map-marker-alt"></i> Centro Cultural UFMG, BH</span>
                                </div>
                            </div>
                            <div class="te-price-col">
                                <span class="te-price">R$ 120</span>
                                <span class="te-stock low">30 disponíveis</span>
                            </div>
                        </div>

                        <div class="ticket-event" onclick="selectEvent(this, 'Campeonato de E-Sports', 60)" data-event="esports">
                            <div class="te-icon" style="background: rgba(220,38,38,0.2);">⚽</div>
                            <div class="te-info">
                                <h4>Campeonato de E-Sports</h4>
                                <div class="te-meta">
                                    <span><i class="fas fa-calendar"></i> 10 Ago 2026 · 14:00</span>
                                    <span><i class="fas fa-map-marker-alt"></i> Arena Esportiva, BH</span>
                                </div>
                            </div>
                            <div class="te-price-col">
                                <span class="te-price">R$ 60</span>
                                <span class="te-stock">200 disponíveis</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de ingresso -->
                    <div class="ticket-selector" style="margin-top: 2rem;">
                        <div class="ticket-types">
                            <h4><i class="fas fa-layer-group" style="color: var(--blue-500); margin-right: 0.5rem;"></i> Tipo de Ingresso</h4>

                            <div class="ticket-type">
                                <div class="tt-info">
                                    <h5>🎟️ Pista / Geral</h5>
                                    <p>Acesso geral ao evento</p>
                                </div>
                                <div class="tt-controls">
                                    <span class="tt-price" id="priceNormal">R$ 85</span>
                                    <div class="qty-control">
                                        <button class="qty-btn" onclick="changeQty('normal', -1)">−</button>
                                        <span class="qty-value" id="qtyNormal">1</span>
                                        <button class="qty-btn" onclick="changeQty('normal', 1)">+</button>
                                    </div>
                                </div>
                            </div>

                            <div class="ticket-type">
                                <div class="tt-info">
                                    <h5>⭐ VIP</h5>
                                    <p>Acesso preferencial + área exclusiva</p>
                                </div>
                                <div class="tt-controls">
                                    <span class="tt-price" id="priceVIP">R$ 170</span>
                                    <div class="qty-control">
                                        <button class="qty-btn" onclick="changeQty('vip', -1)">−</button>
                                        <span class="qty-value" id="qtyVIP">0</span>
                                        <button class="qty-btn" onclick="changeQty('vip', 1)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lado Direito: Resumo -->
                <div class="order-summary">
                    <h3 class="os-title"><i class="fas fa-receipt"></i> Resumo do Pedido</h3>

                    <div id="orderDetails">
                        <div class="os-item">
                            <span class="os-item-label">Evento</span>
                            <span class="os-item-value" id="summaryEvent">Festival de Jazz ao Vivo</span>
                        </div>
                        <div class="os-item">
                            <span class="os-item-label">Pista × <span id="summaryQtyNormal">1</span></span>
                            <span class="os-item-value" id="summaryPriceNormal">R$ 85,00</span>
                        </div>
                        <div class="os-item">
                            <span class="os-item-label">VIP × <span id="summaryQtyVIP">0</span></span>
                            <span class="os-item-value" id="summaryPriceVIP">R$ 0,00</span>
                        </div>
                        <div class="os-item">
                            <span class="os-item-label">Taxa de serviço</span>
                            <span class="os-item-value" id="summaryFee">R$ 8,50</span>
                        </div>
                    </div>

                    <div class="os-total">
                        <span>Total</span>
                        <span class="os-total-value" id="summaryTotal">R$ 93,50</span>
                    </div>

                    <form class="os-form" id="checkoutForm" onsubmit="submitPurchase(event)">
                        <div>
                            <label for="buyerName">Nome Completo</label>
                            <input type="text" id="buyerName" placeholder="Seu nome completo" required>
                        </div>
                        <div>
                            <label for="buyerEmail">E-mail</label>
                            <input type="email" id="buyerEmail" placeholder="seu@email.com" required>
                        </div>
                        <div>
                            <label for="buyerCPF">CPF</label>
                            <input type="text" id="buyerCPF" placeholder="000.000.000-00" required>
                        </div>

                        <button type="submit" class="checkout-btn">
                            <i class="fas fa-lock"></i> Finalizar Compra
                        </button>
                    </form>

                    <div class="secure-badge">
                        <i class="fas fa-shield-alt"></i>
                        Pagamento 100% seguro e criptografado
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Sucesso -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-check"></i></div>
            <h3>Compra Realizada! 🎉</h3>
            <p>Seus ingressos foram reservados com sucesso. Guarde o código abaixo:</p>
            <div class="modal-code" id="ticketCode">RE-2026-XXXX-000</div>
            <p style="font-size: 0.85rem;">Um e-mail de confirmação foi enviado para você.</p>
            <button class="btn btn-primary" onclick="document.getElementById('successModal').classList.remove('show')" style="width: 100%; justify-content: center;">Fechar</button>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let selectedEvent = 'Festival de Jazz ao Vivo';
    let basePrice = 85;
    let qtyNormal = 1;
    let qtyVIP = 0;

    function selectEvent(el, name, price) {
        document.querySelectorAll('.ticket-event').forEach(e => e.classList.remove('selected'));
        el.classList.add('selected');
        selectedEvent = name;
        basePrice = price;

        document.getElementById('priceNormal').textContent = `R$ ${price}`;
        document.getElementById('priceVIP').textContent = `R$ ${price * 2}`;
        updateSummary();
    }

    function changeQty(type, delta) {
        if (type === 'normal') {
            qtyNormal = Math.max(0, qtyNormal + delta);
            document.getElementById('qtyNormal').textContent = qtyNormal;
        } else {
            qtyVIP = Math.max(0, qtyVIP + delta);
            document.getElementById('qtyVIP').textContent = qtyVIP;
        }
        updateSummary();
    }

    function updateSummary() {
        const normalTotal = basePrice * qtyNormal;
        const vipTotal = (basePrice * 2) * qtyVIP;
        const fee = (normalTotal + vipTotal) * 0.1;
        const total = normalTotal + vipTotal + fee;

        document.getElementById('summaryEvent').textContent = selectedEvent;
        document.getElementById('summaryQtyNormal').textContent = qtyNormal;
        document.getElementById('summaryPriceNormal').textContent = `R$ ${normalTotal.toFixed(2).replace('.', ',')}`;
        document.getElementById('summaryQtyVIP').textContent = qtyVIP;
        document.getElementById('summaryPriceVIP').textContent = `R$ ${vipTotal.toFixed(2).replace('.', ',')}`;
        document.getElementById('summaryFee').textContent = `R$ ${fee.toFixed(2).replace('.', ',')}`;
        document.getElementById('summaryTotal').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
    }

    function submitPurchase(e) {
        e.preventDefault();

        if (qtyNormal + qtyVIP === 0) {
            alert('Selecione pelo menos 1 ingresso!');
            return;
        }

        const code = 'RE-2026-' + Math.random().toString(36).substring(2, 6).toUpperCase() + '-' + String(Math.floor(Math.random() * 999)).padStart(3, '0');
        document.getElementById('ticketCode').textContent = code;
        document.getElementById('successModal').classList.add('show');
    }
</script>
@endsection
