let modalAjuste;
let estoque = [];
const carregarEstoque = async () => {
    const dados1 = await Estoque.listar();
    estoque = JSON.parse(dados1);

    return estoque;
};
document.addEventListener("DOMContentLoaded", () => {

    const modalEl = document.getElementById('modalAjusteEstoque');
    modalAjuste = new bootstrap.Modal(modalEl);

    // chamando
    carregarEstoque().then(estoque => {
        renderTabela(estoque);
    });

    const tabela = document.getElementById("tabelaEstoque");

    function statusBadge(saldo, minimo) {
        if (saldo === 0) {
            return `<span class="badge bg-danger badge-status">
                        <i class="bi bi-x-circle"></i> Zerado
                    </span>`;
        }
        if (saldo <= minimo) {
            return `<span class="badge bg-warning text-dark badge-status">
                        <i class="bi bi-exclamation-triangle"></i> ${saldo} | Baixo
                    </span>`;
        }
        return `<span class="badge bg-success badge-status">
                        <i class="bi bi-check-circle"></i> ${saldo} | OK
                    </span>`;
    }
    window.renderTabela = function (lista) {

        tabela.innerHTML = "";

        let valorTotal = 0;
        let itensTotais = 0;
        let itensBaixo = 0;

        lista.forEach(item => {
            const quantidade = Number(item.quantidade);
            const custo = Number(item.custo_medio);


            itensTotais += quantidade;
            valorTotal += quantidade * custo;

            if (quantidade <= item.estoque_minimo) {
                itensBaixo++;
            }

            tabela.innerHTML += `
        <tr>
            <td data-label="Insumo">${item.nome}</td>
            <td data-label="Tamanho">${item.tamanho}</td>
            <td data-label="Custo Médio">
                R$ ${custo.toLocaleString('pt-BR', { minimumFractionDigits: 2 })}
            </td>
            <td data-label="Saldo Atual">
                ${statusBadge(item.quantidade, item.estoque_minimo)}
            </td>
            <td data-label="Ações">
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">

                    <button class="btn btn-primary btn-sm"
                        onclick='verHistoricoInsumo(${item.insumo_id},"${item.nome}")'>
                        <i class="bi bi-list"></i>
                        <span class="d-none d-md-inline"> Histórico</span>
                    </button>

                    <button class="btn btn-outline-secondary btn-sm"
                        onclick="abrirAjusteEstoque(${item.insumo_id},'${item.nome}')">
                        <i class="bi bi-sliders"></i> Ajustar
                    </button>

                </div>
            </td>
        </tr>
        `;
        });

        // Atualiza os cards
        document.getElementById("valorTotalEstoque").innerText =
            valorTotal.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });

        document.getElementById("itensTotais").innerText =
            itensTotais.toLocaleString("pt-BR");

        document.getElementById("itensBaixo").innerText =
            itensBaixo + " itens";
    }

    function aplicarFiltros() {

        const termo = document.getElementById("buscar").value.toLowerCase();
        const status = document.getElementById("filtroStatus").value;
        const tamanho = document.getElementById("filtroTamanho").value;

        const filtrado = estoque.filter(item => {

            // 🔎 Busca por nome
            const nomeMatch = item.nome.toLowerCase().includes(termo);

            // 📦 Filtro por status
            const quantidade = Number(item.quantidade);
            const minimo = Number(item.estoque_minimo);

            let statusMatch = true;

            if (status === "ok") statusMatch = quantidade > minimo;
            if (status === "baixo") statusMatch = quantidade <= minimo;
            if (status === "zerado") statusMatch = quantidade === 0;

            // 📏 Filtro por tamanho
            let tamanhoMatch = true;
            if (tamanho !== "todos" && tamanho !== "") {
                tamanhoMatch = item.tamanho === tamanho;
            }

            return nomeMatch && statusMatch && tamanhoMatch;
        });

        renderTabela(filtrado);
    }
    document.getElementById("buscar").addEventListener("keyup", aplicarFiltros);
    document.getElementById("filtroStatus").addEventListener("change", aplicarFiltros);
    document.getElementById("filtroTamanho").addEventListener("change", aplicarFiltros);

});


async function verHistoricoInsumo(insumoId, nomeInsumo) {

    const modalEl = document.getElementById('modalHistoricoInsumo');
    const modal = new bootstrap.Modal(modalEl);

    document.getElementById('historicoNomeInsumo').innerText = nomeInsumo;

    const tabelaBody = document.getElementById('historicoTabela');
    tabelaBody.innerHTML = `
        <tr>
            <td colspan="6" class="text-center text-muted">
                Carregando histórico...
            </td>
        </tr>
    `;

    try {
        const dados = await Estoque.historico(insumoId);

        let historico = typeof dados === 'string'
            ? JSON.parse(dados)
            : dados;

        // console.log('Histórico bruto:', historico);

        // 🔒 GARANTE QUE SEMPRE SEJA ARRAY
        if (!historico) {
            historico = [];
        } else if (!Array.isArray(historico)) {
            historico = Object.keys(historico).length ? [historico] : [];
        }

        tabelaBody.innerHTML = '';

        if (!historico.length) {
            tabelaBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Nenhuma movimentação encontrada
                    </td>
                </tr>
            `;
        } else {

            historico.forEach(item => {

                const badgeTipo = {
                    entrada: 'success',
                    saida: 'danger',
                    ajuste: 'warning'
                };

                const custo = item.custo_unitario !== null
                    ? Number(item.custo_unitario).toLocaleString('pt-BR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })
                    : '0,00';

                tabelaBody.innerHTML += `
                    <tr>
                        <td>${new Date(item.created_at).toLocaleDateString('pt-BR')}</td>
                        <td>
                            <span class="badge bg-${badgeTipo[item.tipo] || 'secondary'}">
                                ${item.tipo}
                            </span>
                        </td>
                        <td>${item.quantidade}</td>
                        <td>R$ ${custo}</td>
                        <td>${item.saldo_resultante ?? '-'}</td>
                        <td>${item.origem || '-'}</td>
                    </tr>
                `;
            });
        }

        modal.show();

    } catch (e) {
        console.error('Erro histórico:', e);
        tabelaBody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center text-danger">
                    Erro ao carregar histórico
                </td>
            </tr>
        `;
    }
}

function abrirAjusteEstoque(insumoId, nomeInsumo) {
    document.getElementById('ajusteInsumoId').value = insumoId;
    document.getElementById('ajusteNomeInsumo').innerText = nomeInsumo;

    document.getElementById('formAjusteEstoque').reset();

    modalAjuste.show();
}

document.getElementById('btnSalvarAjuste').addEventListener('click', async () => {

    const dados = {
        insumo_id: document.getElementById('ajusteInsumoId').value,
        tipo: document.getElementById('ajusteTipo').value,
        quantidade: document.getElementById('ajusteQuantidade').value,
        valor_unitario: document.getElementById('ajusteCusto').value,
        motivo: document.getElementById('ajusteMotivo').value
    };

    if (!dados.tipo || !dados.quantidade) {
        UI.warning('Preencha o tipo e a quantidade');
        return;
    }

    try {
        const response = await Estoque.ajuste(dados.insumo_id, dados.quantidade, dados.tipo);
        const res = typeof response === 'string' ? JSON.parse(response) : response;

        if (res.success) {

            UI.success(res.message || 'Estoque ajustado com sucesso');

            modalAjuste.hide();

            // chamando
            carregarEstoque().then(estoque => {
                renderTabela(estoque);
            }) // função que recarrega a tabela principal

        } else {
            UI.error(res.message || 'Erro ao ajustar estoque');
        }

    } catch (e) {
        console.error(e);
        UI.error('Erro de comunicação com o servidor');
    }
});
