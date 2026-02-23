<?php \Classes\ClassLayout::setHeader('insumos','Realize so cadastro dos insumos',"Flávio","insumos.css");?>
<?php \Classes\ClassLayout::setHeadRestrito("user");?>
<?php \Classes\ClassLayout::setNav("insumos");?>
    
<div class="container mt-4">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <!-- Cabeçalho -->
            <div class="d-flex flex-column flex-md-row 
                        justify-content-between 
                        align-items-md-center 
                        gap-2 mb-3">

                <h5 class="mb-0">Insumos</h5>

                <button class="btn btn-primary rounded-3"
                        onclick="novoInsumo()">
                    <i class="bi bi-plus-circle"></i> Novo Insumo
                </button>
            </div>

            <!-- Mensagem -->
            <div id="appMessage"
                 class="alert d-none rounded-3"
                 role="alert">
            </div>

            <!-- Tabela -->
            <div class="table-responsive">
                <table class="table table-hover align-middle"
                       id="tabelaInsumos">

                    <thead class="table-light">
                        <tr>
                            <th>Nome do Insumo</th>
                            <th>Descrição</th>
                            <th>Tamanho</th>
                            <th>Unidade Base</th>
                            <th>Estoque Mínimo</th>
                            <th width="160" class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- JS preenche -->
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>


<!-- MODAL INCLUIR / EDITAR INSUMO -->
<div class="modal fade" id="modalInsumo" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formInsumo">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Novo Insumo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div id="appMessageModal" class="alert d-none" role="alert"></div>

                    <input type="hidden" id="insumo_id" name="id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome do Insumo</label>
                            <input type="text" id="nome" class="form-control" name="nome" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Descrição</label>
                            <input type="text" name="descricao" id="descricao" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tamanho</label>
                            <select name="tamanho" id="tamanho" class="form-control" required>
                                <option value="">Selecione</option>
                                <option value="A4">A4</option>
                                <option value="A3">A3</option>
                                <option value="A5">A5</option>
                                <option value="Documento">Documento</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Unidade de Medida (Base)</label>
                            <select name="unidade_base" id="unidade_base" class="form-control" required>
                                <option value="">Selecione</option>
                                <option value="unidade">Unidade</option>
                                <option value="folha">Folha</option>
                                <option value="ml">Mililitro (ml)</option>
                                <option value="g">Grama (g)</option>
                                <option value="m">Metro (m)</option>
                                <option value="cm">Centímetros (cm)</option>
                                <option value="ml">Mililitro (mL)</option>
                                <option value="l">litro (L)</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Estoque Mínimo</label>
                            <input type="number" name="estoqueMinimo" id="estoqueMinimo" class="form-control" required>
                        </div>
                    </div>

                    <!-- TABELA DE CONVERSÃO -->
                    <div id="blocoConversao" class="d-none mt-4">

                        <hr>
                        <h6 class="fw-bold mb-3">
                            Conversão de Unidades de Compra
                        </h6>

                        <table class="table table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Unidade de Compra</th>
                                    <th>Equivale a (em unidade base)</th>
                                    <th width="60">Ação</th>
                                </tr>
                            </thead>
                            <tbody id="tabelaConversao">
                                <!-- JS -->
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-outline-primary btn-sm" id="btnAddConversao">
                            <i class="bi bi-plus"></i> Adicionar Conversão
                        </button>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php \Classes\ClassLayout::setFooter("insumos.js",['insumos']);?>

