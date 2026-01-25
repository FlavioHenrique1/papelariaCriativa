document.addEventListener("DOMContentLoaded", () => {

    const carregarEstoque = async () => {
        const dados1 = await Estoque.listar();
        const estoque = JSON.parse(dados1);

        return estoque;
    };

    // chamando
    carregarEstoque().then(estoque => {
        renderTabela(estoque);
        console.log(estoque);
    });


    const dados = [
        { nome: "Papel A4", tamanho: "A4", custo_medio: 10, saldo: 0 },
        { nome: "Cartucho de Tinta Preto", tamanho: "-", custo_medio: 5, saldo: 3 },
        { nome: "Papel A3", tamanho: "A3", custo_medio: 15, saldo: 25 },
        { nome: "Toner Laser", tamanho: "-", custo_medio: 2, saldo: 0 },
        { nome: "Envelope Documento", tamanho: "Documento", custo_medio: 20, saldo: 40 },
    ];

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

function renderTabela(lista) {
    tabela.innerHTML = "";
    minimo=50;
    console.log(lista);
    lista.forEach(item => {
        tabela.innerHTML += `
            <tr>
                <td data-label="Insumo">${item.nome}</td>
                <td data-label="Tamanho">${item.tamanho}</td>
                <td data-label="Estoque Mínimo">R$ ${Number(item.custo_medio).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</td>
                <td data-label="Saldo Atual">
                    ${statusBadge(item.quantidade, item.estoque_minimo)}
                </td>
                <td data-label="Ações">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button class="btn btn-primary btn-sm">
                            <i class="bi bi-list"></i>
                            <span class="d-none d-md-inline"> Histórico</span>
                        </button>

                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-pencil"></i>
                            <span class="d-none d-md-inline"> Ajustar</span>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    });
}

    renderTabela(dados);

    // Busca
    document.getElementById("buscar").addEventListener("keyup", (e) => {
        const termo = e.target.value.toLowerCase();
        const filtrado = dados.filter(item =>
            item.nome.toLowerCase().includes(termo)
        );
        renderTabela(filtrado);
    });

});
