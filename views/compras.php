<?php \Classes\ClassLayout::setHeader('Compras', 'Visualizar estoque', "", "compras.css"); ?>
<?php \Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setNav("compras"); ?>


<div class="container-fluid mt-4">

    <!-- TÍTULO -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-bag-plus-fill text-success"></i> Compras
        </h4>
        <button class="btn btn-success" id="btnNovaCompra">
            <i class="bi bi-plus-circle"></i> Nova Compra
        </button>
    </div>

    <!-- CARDS RESUMO -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card resumo-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Total Compras</small>
                            <h5 class="fw-bold" id="totalCompras">R$ 1.250,00</h5>
                        </div>
                        <i class="bi bi-currency-dollar resumo-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card resumo-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Total no Mês</small>
                            <h5 class="fw-bold" id="totalMes">12</h5>
                        </div>
                        <i class="bi bi-calendar-event resumo-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card resumo-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">Insumos Comprados</small>
                            <h5 class="fw-bold" id="totalInsumos">18</h5>
                        </div>
                        <i class="bi bi-box-seam resumo-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTRO -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" id="buscarCompra" class="form-control" placeholder="Buscar por insumo...">
                </div>
                <div class="col-md-3">
                    <select class="form-select" id="insumoSelect">
                        <option value="">Todos os insumos</option>
                    </select>
                </div>
                <div class="col-md-3 text-end">
                    <button class="btn btn-outline-secondary w-100">
                        <i class="bi bi-funnel"></i> Filtrar
                    </button>
                </div>
            </div>
        </div>
    </div>
        <div id="appMessage" class="alert d-none" role="alert"></div>

    <!-- TABELA -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle" id="tabelaCompras">
                <thead class="table-dark">
                    <tr>
                        <th>Data</th>
                        <th>Insumo</th>
                        <th>Qtd</th>
                        <th>Valor Unit.</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- JS -->
                </tbody>
            </table>
        </div>
    </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div id="infoPaginacao" class="text-muted small"></div>

            <div>
                <button class="btn btn-sm btn-outline-secondary" id="btnAnterior">
                    Anterior
                </button>
                <span id="paginaAtual" class="mx-2"></span>
                <button class="btn btn-sm btn-outline-secondary" id="btnProximo">
                    Próximo
                </button>
            </div>
        </div>
    <!-- MODAL NOVA COMPRA -->
    <div class="modal fade" id="modalCompra" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-bag-plus"></i> Nova Compra
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formCompra">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Insumo</label>
                                <select id="compraInsumo" class="form-select" name="insumo" required>
                                    <option value="">Selecione</option>
                                    <option value="Papel A4">Papel A4</option>
                                    <option value="Cartucho Preto">Cartucho Preto</option>
                                    <option value="Papel Fotográfico">Papel Fotográfico</option>
                                </select>
                            </div>
                            <div class="col-md-4">
    <label class="form-label">Unidade de Compra</label>
    <select id="compraUnidade" class="form-select" name="unidade_compra" required>
        <option value="">Selecione</option>
        <!-- JS -->
    </select>
</div>

<div class="col-md-2">
    <label class="form-label">Fator</label>
    <input type="number"
           id="compraFator"
           class="form-control"
           name="fator"
           readonly>
</div>

<div class="col-md-2">
    <label class="form-label">Tamanho</label>
<select name="tamanho" id="tamanho" class="form-control" required>
                                <option value="">Selecione</option>
                                <option value="A3">A3</option>
                                <option value="A4">A4</option>
                                <option value="A5">A5</option>
                                <option value="A6">A6</option>
                                <option value="Documento">Documento</option>
                                <option value="7">7</option>
                                <option value="9">9</option>
                                <option value="12">12</option>
                                <option value="A6">14</option>
                                <option value="A6">17</option>
                                <option value="A6">A6</option>
                                <option value="A6">A6</option>
                                <option value="A6">A6</option>
                                <option value="A6">A6</option>
                            </select>
</div>


                            <div class="col-md-3">
                                <label class="form-label">Quantidade</label>
                                <input type="number" id="compraQtd" class="form-control" min="1" name="quantidade" required>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Valor Unitário</label>
                                <input type="number" id="compraValor" class="form-control" step="0.01" name="valorUnitario" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">
                                    Custo por unidade base
                                    <small class="text-muted">(calculado)</small>
                                </label>
                                <input type="text"
                                    id="custoUnitarioBase"
                                    name="custoUnitarioBase"
                                    class="form-control"
                                    readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Data da Compra</label>
                                <input type="date" id="compraData" class="form-control" name="data" required>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Total</label>
                                <input type="text" id="compraTotal" class="form-control fw-bold" readonly name="total" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button  type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Registrar Compra
                        </button>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>

</div>

<?php \Classes\ClassLayout::setFooter('compras.js',['compras','insumos']); ?>