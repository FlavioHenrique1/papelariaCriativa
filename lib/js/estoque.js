document.addEventListener("DOMContentLoaded", () => {

    const dados = [
        { nome: "Papel A4", tamanho: "A4", minimo: 10, saldo: 0 },
        { nome: "Cartucho de Tinta Preto", tamanho: "-", minimo: 5, saldo: 3 },
        { nome: "Papel A3", tamanho: "A3", minimo: 15, saldo: 25 },
        { nome: "Toner Laser", tamanho: "-", minimo: 2, saldo: 0 },
        { nome: "Envelope Documento", tamanho: "Documento", minimo: 20, saldo: 40 },
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

    lista.forEach(item => {
        tabela.innerHTML += `
            <tr>
                <td data-label="Insumo">${item.nome}</td>
                <td data-label="Tamanho">${item.tamanho}</td>
                <td data-label="Estoque Mínimo">${item.minimo}</td>
                <td data-label="Saldo Atual">
                    ${statusBadge(item.saldo, item.minimo)}
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
