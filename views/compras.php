<?php \Classes\ClassLayout::setHeader('Login','Entre com seu usuário e senha',"","compras.css");?>
<?php \Classes\ClassLayout::setNav("compras");?>


<div class="container-fluid mt-4">

    <!-- TÍTULO -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="bi bi-bag-plus-fill text-success"></i> Compras
        </h4>
        <button class="btn btn-success">
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
                            <h5 class="fw-bold">R$ 1.250,00</h5>
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
                            <small class="text-muted">Compras no Mês</small>
                            <h5 class="fw-bold">12</h5>
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
                            <h5 class="fw-bold">18</h5>
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

</div>

<?php \Classes\ClassLayout::setFooter('compras.js');?>