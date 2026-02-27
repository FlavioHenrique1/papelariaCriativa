<?php \Classes\ClassLayout::setHeader(
    'Área Restrita',
    'Exclusivos para membros',
    '',
    'vendas.css'
); ?>
<?php \Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setNav("vendas"); ?>

<div class="caixa-wrapper">
    <form name="formVendas" id="formVendas" method="post">
        <div class="caixa-card">

            <div class="caixa-header">
                <h3>🖨️ Caixa – Gráfica Rápida</h3>
            </div>
            <div class="appMessage" id="appMessage"></div>
            <!-- CLIENTE -->
            <div class="caixa-section">
                <div class="section-header">
                    <h5>Cliente</h5>
                </div>
                <div class="section-body">
                    <div class="row g-2">
                        <div class="col-md-8">
                            <input
                                type="text"
                                class="form-control"
                                id="clienteNome"
                                name="cliente_nome"
                                placeholder="Nome do cliente"
                                required>
                        </div>

                        <div class="col-md-4">
                            <input
                                type="text"
                                class="form-control"
                                id="clienteContato"
                                name="cliente_contato"
                                placeholder="Telefone (opcional)">
                        </div>
                    </div>
                </div>

            </div>

            <!-- ADICIONAR SERVIÇO -->
            <div class="caixa-section">
                <div class="section-header">
                    <h5>Adicionar Serviço</h5>
                </div>

                <div class="section-body">

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Serviço</label>
                            <select class="form-select" id="servicoSelect">
                                <option value="5">Xerox P&B</option>
                                <option value="7">Xerox Colorido</option>
                                <option value="10">Plastificação</option>
                                <option value="15">Encadernação</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Valor</label>
                            <input type="text" class="form-control" id="custoUnit" readonly>
                            <!-- <select class="form-select" id="tamanhoSelect">
                                <option>A4</option>
                                <option>A5</option>
                                <option>A3</option>
                                <option>Documento</option>
                            </select> -->
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Qtd</label>
                            <input type="number" class="form-control" id="qtd" value="1" min="1">
                        </div>
                    </div>

                    <button type="button" class="btn-add" onclick="adicionarServico()">
                        ➕ Adicionar
                    </button>
                </div>
            </div>
            <!-- ITENS DO CAIXA -->
            <div class="caixa-section">
                <div class="section-header">
                    <h5>Serviços no Caixa</h5>
                </div>

                <div class="section-body">

                    <table class="table table-sm align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Serviço</th>
                                <th>Qtd</th>
                                <th>Valor</th>
                                <th>Apagar</th>
                            </tr>
                        </thead>
                        <tbody id="listaCaixa">
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Nenhum serviço adicionado
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- PAGAMENTO -->
            <div class="caixa-section">
                <div class="section-header">
                    <h5>Pagamento</h5>
                </div>

                <div class="total-box">
                    Total: R$ <span id="total">0.00</span>
                </div>

                <div class="mb-2">
                    <label class="form-label">Valor Pago</label>
                    <input type="number" class="form-control" id="pago" step="0.01" name='valor_pago' required>
                </div>
                    <div class="mb-2">
                        <label class="form-label">Desconto</label>
                        <input type="number" class="form-control" id="desconto" step="0.01" name='desconto' >
                    </div>
                <div class="mb-2">
                    <label class="form-label">Forma de pagamento</label>
                    <select class="form-select" name="forma_pagamento" id="forma_pagamento">
                        <option value="dinheiro">Dinheiro</option>
                        <option value="pix">PIX</option>
                    </select>
                </div>
                <div class="troco-box" id="troco">
                    Troco / Dívida: R$ 0.00
                </div>

                <button type="submit" class="btn-finalizar">
                    ✔ Finalizar
                </button>
            </div>
        </div>
    </form>
</div>

<?php \Classes\ClassLayout::setFooter("vendas.js"); ?>