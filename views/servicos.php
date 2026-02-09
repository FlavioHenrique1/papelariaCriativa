<?php \Classes\ClassLayout::setHeader('Cadastro', 'Realize seu cadastro em nosso sistema', "", "cadastroservicos.css"); ?>
<?php \Classes\ClassLayout::setNav("servicos");?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Serviços Cadastrados</h4>
        <a class="btn btn-success" onclick="modalShow()">
            <i class="bi bi-plus-circle"></i> Novo Serviço
        </a>
    </div>
    
    <table class="table table-striped table-hover align-middle" id="tabelaServicos">
        <thead class="table-light text-center">
            <tr>
                <th>Serviço</th>
                <th>Categoria</th>
                <th>Tamanho</th>
                <th>Preço</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <tr>
                <td>Encadernação Simples</td>
                <td>Encadernação</td>
                <td>R$ 12,00</td>
                <td>
                    <span class="badge bg-success">Ativo</span>
                </td>
                <td>
                    <button class="btn btn-sm btn-info"
                        onclick="visualizarServico(1)">
                        Visualizar
                    </button>
                    <a href="editar_servico.php?id=1"
                        class="btn btn-sm btn-warning">
                        Editar
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- MODAL VISUALIZAR -->
<div class="modal fade" id="modalServico" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title">Detalhes do Serviço</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h2 id="h2Modal">Cadastro de Serviços</h2>
                    <div id="appMessage" class="alert d-none" role="alert"></div>
                    <form name="formServiço" id="formServiço" action="" method="post">

                        <div class="form-group">
                            <div id="appMessage" class="alert d-none" role="alert"></div>
                            <input type="hidden" id="idservico" value="" name="idservico">
                            <label>Nome do Serviço</label>
                            <input type="text" name="nome_servico" id="m-nome" required>
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select name="categoria" id="m-categoria" required>
                                <option value="">Selecione</option>
                                <option value="grafica">Gráfica</option>
                                <option value="servicos">Serviços</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tamanho</label>
                            <select name="tamanho" id="tamanho" required>
                                <option value="">Selecione</option>
                                <option value="A4">A4</option>
                                <option value="A3">A3</option>
                                <option value="A5">A5</option>
                                <option value="documento">Documento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="descricao" rows="3" id="m-descricao"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Preço do Serviço (R$)</label>
                            <input type="number" step="0.01" name="preco" id="m-preco" required>
                        </div>

                        <!-- INSUMOS -->
                        <h3>Insumos Utilizados</h3>

                        <div id="insumos" class="row g-2 align-items-center">
                            <!-- <div class="insumo-item">
                <select class="selectInsumos" name="insumo_nome[]" placeholder="Ex: Espiral" required>>
                    <option value="encadernacao">papel a4</option>
                    <option value="plastificacao">Plastico</option>
                    <option value="xerox">tinta</option>
                </select>
                <input type="number" name="insumo_qtd[]" placeholder="Qtd" min="1" required>
                <button type="button" class="btn-remove" onclick="removerInsumo(this)">✖</button>
            </div> -->
                        </div>

                        <button type="button" class="btn-add" onclick="adicionarInsumo()">+ Adicionar Insumo</button>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status">
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>

                        <button class="btnModal" type="submit">Salvar Serviço</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php \Classes\ClassLayout::setFooter("servicos.js"); ?>