<?php \Classes\ClassLayout::setHeader('Estoque', 'Visualizar estoque', "", "estoque.css"); ?>
<?php \Classes\ClassLayout::setHeadRestrito("user"); ?>
<?php \Classes\ClassLayout::setNav("estoque"); ?>


<style>

</style>
<div class="container my-5">
  <header class="mb-4">
    <h1 class="h2 fw-bold">Controle de Estoque</h1>
    <p class="text-muted">Gerencie seus insumos e acompanhe os níveis de saldo em tempo real.</p>
  </header>
  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card p-3 h-100">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="text-muted small fw-medium">Valor Total em Estoque</span>
          <span class="material-symbols-outlined text-primary">payments</span>
        </div>
        <h3 class="fw-bold mb-0" id="valorTotalEstoque">R$ 48.650,32</h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 h-100">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="text-muted small fw-medium">Itens Totais</span>
          <span class="material-symbols-outlined text-primary">inventory_2</span>
        </div>
        <h3 class="fw-bold mb-0" id="itensTotais">12.430</h3>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 h-100">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <span class="text-muted small fw-medium">Itens com Saldo Baixo</span>
          <span class="material-symbols-outlined text-danger">error</span>
        </div>
        <h3 class="fw-bold text-danger mb-0" id="itensBaixo">8 itens</h3>
      </div>
    </div>
  </div>
  <div class="card p-3 mb-4">
    <div class="row g-3 align-items-end">
      <div class="col-md-5">
        <label class="form-label small text-muted mb-1">Pesquisa</label>
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0">
            <span class="material-symbols-outlined text-muted fs-5">search</span>
          </span>
          <input class="form-control border-start-0" placeholder="Buscar insumo por nome..." type="text" id="buscar" />
        </div>
      </div>
      <div class="col-md-2">
        <label class="form-label small text-muted mb-1">Status</label>
        <select class="form-select" id="filtroStatus">
          <option value="todos" selected>Todos Status</option>
          <option value="ok">Saldo OK</option>
          <option value="baixo">Saldo Baixo</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label small text-muted mb-1">Tamanho</label>
        <select class="form-select" id="filtroTamanho">
          <option value="todos" selected>Todos Tamanhos</option>
          <option value="A3">A3</option>
          <option value="A4">A4</option>
          <option value="A5">A5</option>
          <option value="A6">A6</option>
          <option value="Documento">Documento</option>
          <option value="7">7</option>
          <option value="9">9</option>
          <option value="12">12</option>
          <option value="14">14</option>
          <option value="17">17</option>
          <option value="20">20</option>
          <option value="23">23</option>
          <option value="25">25</option>
          <option value="29">29</option>
          <option value="33">33</option>
          <option value="40">40</option>
          <option value="45">45</option>
          <option value="50">50</option>
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2" type="button">
          <span class="material-symbols-outlined fs-5">download</span>
          <span>Gerar Relatório</span>
        </button>
      </div>
    </div>
  </div>
  <div class="table-container p-0 overflow-hidden">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th class="ps-4 py-3">Insumo</th>
            <th class="py-3">Tamanho</th>
            <th class="py-3">Custo Médio</th>
            <th class="py-3">Saldo Atual</th>
            <th class="pe-4 py-3 text-center">Ações</th>
          </tr>
        </thead>
        <tbody id="tabelaEstoque">
          <tr>
            <td class="ps-4 fw-medium">papel a4</td>
            <td class="text-muted">A4</td>
            <td class="text-muted">R$ 31,67</td>
            <td><span class="badge rounded-pill bg-success px-3 py-2 d-inline-flex align-items-center"><span class="material-symbols-outlined me-1 fs-6">check_circle</span> 1536 | OK</span></td>
            <td class="pe-4 text-end">
              <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-primary btn-sm d-flex align-items-center"><span class="material-symbols-outlined me-1 fs-6">history</span> Histórico</button>
                <button class="btn btn-outline-secondary btn-sm d-flex align-items-center"><span class="material-symbols-outlined me-1 fs-6">tune</span> Ajustar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td class="ps-4 fw-medium">Tinta Impressora Preta</td>
            <td class="text-muted">500ml</td>
            <td class="text-muted">R$ 85,00</td>
            <td><span class="badge rounded-pill bg-danger-subtle text-danger px-3 py-2 d-inline-flex align-items-center"><span class="material-symbols-outlined me-1 fs-6">warning</span> 12 | BAIXO</span></td>
            <td class="pe-4 text-end">
              <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-primary btn-sm">Histórico</button>
                <button class="btn btn-outline-secondary btn-sm">Ajustar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td class="ps-4 fw-medium">Caneta Esferográfica Azul</td>
            <td class="text-muted">Unidade</td>
            <td class="text-muted">R$ 1,20</td>
            <td><span class="badge rounded-pill bg-success px-3 py-2">250 | OK</span></td>
            <td class="pe-4 text-end">
              <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-primary btn-sm">Histórico</button>
                <button class="btn btn-outline-secondary btn-sm">Ajustar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td class="ps-4 fw-medium">Grampo 26/6</td>
            <td class="text-muted">Caixa 5000un</td>
            <td class="text-muted">R$ 12,40</td>
            <td><span class="badge rounded-pill bg-success px-3 py-2">45 | OK</span></td>
            <td class="pe-4 text-end">
              <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-primary btn-sm">Histórico</button>
                <button class="btn btn-outline-secondary btn-sm">Ajustar</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="p-3 border-top d-flex justify-content-between align-items-center">
      <small class="text-muted">Mostrando 1 até 4 de 24 resultados</small>
      <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm mb-0">
          <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">Próximo</a></li>
        </ul>
      </nav>
    </div>
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