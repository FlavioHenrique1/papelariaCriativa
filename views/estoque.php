<?php \Classes\ClassLayout::setHeader('Login', 'Entre com seu usuário e senha', "", "estoque.css"); ?>
<?php \Classes\ClassLayout::setNav("estoque"); ?>



<div class="container mt-4">

    <h3 class="mb-4">Controle de Estoque</h3>

    <div class="row g-2 mb-3">
        <div class="col-12 col-md-4">
            <input type="text" id="buscar" class="form-control" placeholder="Buscar insumo...">
        </div>

        <div class="col-12 col-md-8 text-md-end">
            <div class="d-grid gap-2 d-md-inline-flex">
                <button class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Nova Entrada
                </button>
                <button class="btn btn-secondary">
                    <i class="bi bi-file-earmark-text"></i> Relatório
                </button>
            </div>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Insumo</th>
                    <th>Tamanho</th>
                    <th>Custo Médio</th>
                    <th>Saldo Atual</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody id="tabelaEstoque">
                <!-- JS vai preencher -->
            </tbody>
        </table>
    </div>

</div>
<!-- MODAL HISTÓRICO DO INSUMO -->
<div class="modal fade" id="modalHistoricoInsumo" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Histórico do Insumo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <strong>Insumo:</strong>
                    <span id="historicoNomeInsumo" class="text-primary"></span>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Qtd</th>
                                <th>Custo Unit.</th>
                                <th>Saldo</th>
                                <th>Origem</th>
                            </tr>
                        </thead>
                        <tbody id="historicoTabela">
                            <!-- JS -->
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
            </div>

        </div>
    </div>
</div>

<!-- MODAL AJUSTE DE ESTOQUE -->
<div class="modal fade" id="modalAjusteEstoque" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Ajustar estoque — <span id="ajusteNomeInsumo"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formAjusteEstoque">

                    <input type="hidden" id="ajusteInsumoId">

                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" id="ajusteTipo" required>
                            <option value="">Selecione</option>
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                            <option value="ajuste">Ajuste manual</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="ajusteQuantidade" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Custo unitário (opcional)</label>
                        <input type="number" step="0.01" class="form-control" id="ajusteCusto">
                        <small class="text-muted">
                            Usado apenas em entradas para recalcular o custo médio
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Motivo / Observação</label>
                        <input type="text" class="form-control" id="ajusteMotivo">
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button class="btn btn-primary" id="btnSalvarAjuste">
                    Salvar ajuste
                </button>
            </div>

        </div>
    </div>
</div>



<?php \Classes\ClassLayout::setFooter('estoque.js', ["estoque"]); ?>