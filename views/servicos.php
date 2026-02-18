<?php \Classes\ClassLayout::setHeader('Cadastro', 'Realize seu cadastro em nosso sistema', "", "cadastroservicos.css"); ?>
<?php \Classes\ClassLayout::setNav("servicos");?>

<div class="container mt-4">

    <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-2">
            <h3 class="mb-0">Serviços Cadastrados</h3>
            <button class="btn btn-primary rounded-3" onclick="modalShow()">
                <i class="bi bi-plus-circle"></i> Novo Serviço
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center" id="tabelaServicos">
                <thead class="table-light">
                    <tr>
                        <th>Serviço</th>
                        <th>Categoria</th>
                        <th>Tamanho</th>
                        <th>Preço</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop PHP aqui -->
                </tbody>
            </table>
        </div>

    </div>
</div>

</div>

<!-- MODAL VISUALIZAR -->
<div class="modal fade" id="modalServico" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">

            <div class="modal-header">
                <h5 class="modal-title" id="h2Modal">Cadastro de Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="formServico">

                    <input type="hidden" id="idservico" name="idservico">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nome do Serviço</label>
                            <input type="text" class="form-control" name="nome_servico" id="m-nome" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" name="categoria" id="m-categoria" required>
                                <option value="">Selecione</option>
                                <option value="grafica">Gráfica</option>
                                <option value="servicos">Serviços</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Tamanho</label>
                            <select class="form-select" name="tamanho" id="tamanho" required>
                                <option value="">Selecione</option>
                                <option value="A4">A4</option>
                                <option value="A3">A3</option>
                                <option value="A5">A5</option>
                                <option value="documento">Documento</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Preço (R$)</label>
                            <input type="number" step="0.01" class="form-control" name="preco" id="m-preco" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control" rows="3" name="descricao" id="m-descricao"></textarea>
                        </div>

                    </div>

                    <hr class="my-4">

                    <h6 class="mb-3">Insumos Utilizados</h6>

                    <div id="insumos" class="d-flex flex-column gap-2"></div>

                    <button type="button" 
                            class="btn btn-outline-secondary btn-sm mt-3"
                            onclick="adicionarInsumo()">
                        + Adicionar Insumo
                    </button>

                    <div class="mt-4">
                        <button type="submit" 
                                class="btn btn-success w-100 rounded-3">
                            Salvar Serviço
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php \Classes\ClassLayout::setFooter("servicos.js"); ?>