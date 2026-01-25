<?php \Classes\ClassLayout::setHeader('Cadastro','Realize seu cadastro em nosso sistema');?>
<?php \Classes\ClassLayout::setNav("insumos");?>
    
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Insumos</h4>
        <button class="btn btn-success"onclick="novoInsumo()">
            <i class="bi bi-plus-circle"></i> Novo Insumo
        </button>
    </div>
        <div id="appMessage" class="alert d-none" role="alert"></div>
    <!-- TABELA DE INSUMOS -->
    <table class="table table-bordered table-hover" id="tabelaInsumos">
        <thead class="table-light">
            <tr>
                <!-- <th>ID</th> -->
                <th>Nome do Insumo</th>
                <th>Descrição</th>
                <th>Tamanho</th>
                <th>Estoque Mínimo</th>
                <th width="160">Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- EXEMPLO (depois vem do BD) -->
            <tr>
                <td>1</td>
                <td>Papel A4</td>
                <td>descricao</td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        onclick="editarInsumo(1, 'Papel A4', 500)">
                        Editar
                    </button>
                    <button class="btn btn-sm btn-danger"
                        onclick="excluirInsumo(1)">
                        Excluir
                    </button>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Espiral</td>
                <td>120</td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        onclick="editarInsumo(2, 'Espiral', 120)">
                        Editar
                    </button>
                    <button class="btn btn-sm btn-danger"
                        onclick="excluirInsumo(2)">
                        Excluir
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- MODAL INCLUIR / EDITAR -->
<div class="modal fade" id="modalInsumo" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formInsumo" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitulo">Novo Insumo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                    <div class="modal-body">
                    <div class="alert alert-danger d-none" id="insumoErro"></div>
                    <div class="alert alert-success d-none" id="insumoSucesso"></div>
                        <input type="hidden" id="insumo_id" name="id">

                        <div class="mb-3">
                            <label class="form-label">Nome do Insumo</label>
                            <input type="text" id="nome" class="form-control" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label>Descrição</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Tamanho</label>
                            <select name="tamanho" id="tamanho" class="form-control" required>
                                <option value="">Selecione</option>
                                <option value="A4">A4</option>
                                <option value="A3">A3</option>
                                <option value="A5">A5</option>
                                <option value="Documento">Documento</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Estoque Mínimo</label>
                            <input type="number" name="estoqueMinimo" id="estoqueMinimo" class="form-control" required>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success" onclick="">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php \Classes\ClassLayout::setFooter("insumos.js");?>

