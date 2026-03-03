<?php \Classes\ClassLayout::setHeader(
    'Área Restrita',
    'Exclusivos para membros',
    '',
    'vendas.css'
); ?>
<?php \Classes\ClassLayout::setHeadRestrito("user"); ?>
<?php \Classes\ClassLayout::setNav("vendas"); ?>

<body class="font-sans antialiased text-slate-800">
    <div class="d-flex flex-column h-100 bg-light">
        <div class="d-flex flex-grow-1 overflow-hidden">
            <!-- Main Content -->
            <main class="flex-grow-1 d-flex flex-column bg-white">

                <div class="table-container p-4">
                    <div class="container-fluid gap-3">
                        <div class="container-fluid d-flex flex-wrap align-items-end gap-3">

                            <!-- Select Serviço -->
                            <div class="flex-grow-1">
                                <label class="form-label fw-semibold small text-muted">Serviço</label>
                                <select aria-label="Select product or service"
                                    class="form-select bg-light border-0 ps-3 selectTabe"
                                    id="servicoSelect">
                                    <option disabled selected>Selecione um produto ou serviço...</option>
                                    <option value="1">Cópia P&B - A4</option>
                                    <option value="2">Encadernação Capa Dura</option>
                                    <option value="3">Papel Foto Glossy</option>
                                </select>
                            </div>

                            <!-- Quantidade -->
                            <div style="width: 120px;">
                                <label class="form-label fw-semibold small text-muted">Qtd</label>
                                <input type="number"
                                    class="form-control bg-light border-0"
                                    id="qtd"
                                    min="1"
                                    value="1">
                            </div>

                            <!-- Valor -->
                            <div style="width: 150px;">
                                <label class="form-label fw-semibold small text-muted">Valor</label>
                                <div class="form-control bg-light border-0 fw-bold" id="custoUnit">
                                    R$ 0,00
                                </div>
                            </div>

                            <!-- Botão -->
                            <div>
                                <button class="btn btn-primary fw-bold d-flex align-items-center gap-2 px-3"
                                    type="button"
                                    onclick="adicionarServico()">
                                    <span class="material-symbols-outlined">add_circle</span>
                                    Add Item
                                </button>
                            </div>

                        </div>
                    </div>
                    <form action="post" name="formVendas" id="formVendas" method="post">

                        <table class="table table-borderless align-middle" >
                            <thead class="border-bottom">
                                <tr class="text-secondary text-uppercase text-xxs fw-bold">
                                    <th class="pb-3">Nome do serviço</th>
                                    <th class="pb-3 text-center">Preço unitário</th>
                                    <th class="pb-3 text-center">Quantidade</th>
                                    <th class="pb-3 text-center">Subtotal</th>
                                    <th class="pb-3 text-end pe-4">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="text-secondary" id="listaCaixa">
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Nenhum serviço adicionado
                                </td>
                            </tr>
                            <!-- <tr>
                                <td class="py-3">
                                    <div class="fw-bold text-dark">Color Printing (A4, 80gsm)</div>
                                    <div class="text-xxs text-muted">SKU: PR-001-CLR</div>
                                </td>
                                <td class="text-center fw-bold text-dark">$0.75</td>
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <button class="btn btn-sm bg-light text-blue-600 fw-bold border-0">-</button>
                                        <span class="fw-bold text-dark mx-2">24</span>
                                        <button class="btn btn-sm bg-light text-blue-600 fw-bold border-0">+</button>
                                    </div>
                                </td>
                                <td class="text-center fw-bold text-dark">$18.00</td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-link text-danger p-0"><span class="material-symbols-outlined">delete</span></button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- Table Footer -->
                <div class="bg-light border-top p-3 d-flex justify-content-between align-items-center text-xxs fw-bold text-muted">
                    <div>Itens no carrinho: <span class="text-dark">3 itens</span> (27 unidades no total)</div>
                    <button class="btn btn-link text-muted text-decoration-none text-xxs p-0 d-flex align-items-center gap-1"><span class="material-symbols-outlined fs-6">delete_sweep</span> Clear List</button>
                </div>
            </main>
            <!-- Sidebar -->
            <aside class="sidebar d-flex flex-column p-4 overflow-auto">
                <!-- Customer Info -->
                <section class="mb-4">
                    <div class="d-flex align-items-center gap-2 text-muted mb-3">
                        <span class="material-symbols-outlined fs-6">person</span>
                        <h6 class="text-xxs fw-bold text-uppercase mb-0 tracking-wider">Informações do cliente</h6>
                    </div>
                    <div class="mb-3">
                        <label class="text-xxs fw-bold text-uppercase text-muted d-block mb-1">Nome do cliente</label>
                        <input class="form-control form-control-sm" placeholder="e.g. John Smith" type="text"  id="clienteNome" name="cliente_nome"/>
                    </div>
                    <div class="mb-3">
                        <label class="text-xxs fw-bold text-uppercase text-muted d-block mb-1">Número de telefone</label>
                        <input class="form-control form-control-sm" placeholder="(555) 000-0000" type="text" id="clienteContato" name="cliente_contato"/>
                    </div>
                </section>
                <!-- Payment Summary -->
                <section class="border-top pt-4 mb-4">
                    <div class="d-flex align-items-center gap-2 text-muted mb-3">
                        <span class="material-symbols-outlined fs-6">payments</span>
                        <h6 class="text-xxs fw-bold text-uppercase mb-0 tracking-wider">Resumo de Pagamentos</h6>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-xs">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold" id="total">R$ 0,00</span>
                    </div>
                    <!-- <div class="d-flex justify-content-between mb-2 text-xs">
                        <span class="text-muted">Tax (5%)</span>
                        <span class="fw-bold">$1.48</span>
                    </div> -->
                    <div class="d-flex justify-content-between align-items-center mb-2 text-xs">
                        <span class="text-muted">Aplicar desconto</span>
                        <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text bg-white border-start-0 text-xxs text-muted px-2">R$</span>
                            <input class="form-control text-end p-1 border-end-0" style="width: 50px;" type="text" value="0.00" id="desconto" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-3 text-xs fw-bold text-success">
                        <span>Desconto (PROMO10)</span>
                        <span>-$2.95</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <span class="text-xxs fw-bold text-uppercase text-dark">Valor pago</span>
                        <div class="input-group input-group-sm w-auto bg-light border rounded">
                            <span class="input-group-text bg-transparent border-0 border-end text-xxs text-muted px-2">R$</span>
                            <input class="form-control bg-transparent border-0 fw-bold text-end" style="width: 70px;" type="text" value="0,00" id="pago" />
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <div class="text-xxs fw-bold text-uppercase text-dark mb-1">Troco / Dívida:</div>
                        <!-- <div class="text-xxs fw-bold text-uppercase text-dark mb-1">Total a Pagar</div> -->
                        <div class="h2 fw-black text-blue-600 mb-0" id="troco" >R$ 0,00</div>
                    </div>
                </section>
                <!-- Payment Methods -->
                <section class="mt-auto">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <button class="btn btn-outline-light border w-100 d-flex flex-column align-items-center py-3" data-pagamento="dinheiro" onclick="selecionarPagamento(this)">
                                <span class="material-symbols-outlined text-blue-600">payments</span>
                                <span class="text-xxs fw-bold text-muted mt-1">Dinheiro</span>
                            </button>
                        </div>
                        <!-- <div class="col-6">
                            <button class="btn bg-blue-50 border-2 border-blue-600 w-100 d-flex flex-column align-items-center py-3">
                                <span class="material-symbols-outlined text-blue-600">credit_card</span>
                                <span class="text-xxs fw-bold text-blue-600 mt-1">Cartão</span>
                            </button>
                        </div> -->
                        <div class="col-6">
                            <button class="btn btn-outline-light border w-100 d-flex flex-column align-items-center py-3" data-pagamento="pix" onclick="selecionarPagamento(this)">
                                <span class="material-symbols-outlined text-blue-600">qr_code_2</span>
                                <span class="text-xxs fw-bold text-muted mt-1">PIX</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-outline-light border w-100 d-flex flex-column align-items-center py-3" data-pagamento="orcamento" onclick="selecionarPagamento(this)">
                                <span class="material-symbols-outlined text-blue-600">description</span>
                                <span class="text-xxs fw-bold text-muted mt-1">Orçamento</span>
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="forma_pagamento" id="formaPagamento" value="dinheiro">
                    <button class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-sm d-flex align-items-center justify-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span> FINISH SALE
                    </button>
                    <!-- <p class="text-center text-xxs text-muted mt-2 mb-0">Receipt will be printed automatically</p> -->
                </section>
            </aside>
        </form>
        </div>
    </div>
    <?php \Classes\ClassLayout::setFooter("vendas1.js"); ?>