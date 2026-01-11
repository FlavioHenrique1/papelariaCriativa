<?php \Classes\ClassLayout::setHeader('Login','Entre com seu usuário e senha',"","estoque.css");?>
<?php \Classes\ClassLayout::setNav("estoque");?>



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
                    <th>Estoque Mínimo</th>
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

<?php \Classes\ClassLayout::setFooter('estoque.js');?>