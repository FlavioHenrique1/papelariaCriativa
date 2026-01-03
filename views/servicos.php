<?php \Classes\ClassLayout::setHeader('Cadastro','Realize seu cadastro em nosso sistema',"","servicos.css");?>
    
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Serviços Cadastrados</h4>
        <a href="<?= DIRPAGE.'cadastroservicos';?>" class="btn btn-primary">
            Novo Serviço
        </a>
    </div>

    <table class="table table-striped table-hover align-middle" id="tabelaServicos">
        <thead class="table-light text-center">
            <tr>
                <th>Serviço</th>
                <th>Descrição</th>
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalhes do Serviço</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p><strong>Serviço:</strong> <span id="m-nome"></span></p>
        <p><strong>Categoria:</strong> <span id="m-categoria"></span></p>
        <p><strong>Preço:</strong> <span id="m-preco"></span></p>

        <h6>Insumos</h6>
        <ul id="m-insumos"></ul>
      </div>
    </div>
  </div>
</div>


<?php \Classes\ClassLayout::setFooter("servicos.js");?>