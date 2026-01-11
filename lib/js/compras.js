document.addEventListener('DOMContentLoaded', () => {

    // ==============================
    // DADOS MOCK (SIMULAÇÃO)
    // ==============================
    let compras = [
        {
            id: 1,
            data: '2026-01-05',
            insumo: 'Papel A4',
            quantidade: 10,
            valor_unitario: 22.50,
            status: 'Concluída'
        },
        {
            id: 2,
            data: '2026-01-08',
            insumo: 'Cartucho Preto',
            quantidade: 2,
            valor_unitario: 180.00,
            status: 'Concluída'
        },
        {
            id: 3,
            data: '2026-01-10',
            insumo: 'Papel Fotográfico',
            quantidade: 5,
            valor_unitario: 35.00,
            status: 'Pendente'
        }
    ];

    const tabelaBody = document.querySelector('#tabelaCompras tbody');
    const buscarInput = document.getElementById('buscarCompra');
    const selectInsumo = document.getElementById('insumoSelect');

    // ==============================
    // RENDERIZAR TABELA
    // ==============================
    function renderTabela(lista) {
        tabelaBody.innerHTML = '';

        if (lista.length === 0) {
            tabelaBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Nenhuma compra encontrada
                    </td>
                </tr>
            `;
            return;
        }

        lista.forEach(compra => {
            const total = (compra.quantidade * compra.valor_unitario).toFixed(2);

            const statusBadge = compra.status === 'Concluída'
                ? 'success'
                : 'warning';

            tabelaBody.innerHTML += `
                <tr>
                    <td>${formatarData(compra.data)}</td>
                    <td>${compra.insumo}</td>
                    <td>${compra.quantidade}</td>
                    <td>R$ ${compra.valor_unitario.toFixed(2)}</td>
                    <td>
                        <span class="badge bg-${statusBadge}">
                            ${compra.status}
                        </span>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-primary" title="Ver">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" title="Excluir">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        });
    }

    // ==============================
    // POPULAR SELECT DE INSUMOS
    // ==============================
    function popularSelect() {
        const insumos = [...new Set(compras.map(c => c.insumo))];

        insumos.forEach(insumo => {
            const option = document.createElement('option');
            option.value = insumo;
            option.textContent = insumo;
            selectInsumo.appendChild(option);
        });
    }

    // ==============================
    // FILTROS
    // ==============================
    function aplicarFiltros() {
        const termo = buscarInput.value.toLowerCase();
        const insumoSelecionado = selectInsumo.value;

        const filtrado = compras.filter(c => {
            const matchNome = c.insumo.toLowerCase().includes(termo);
            const matchSelect = insumoSelecionado === '' || c.insumo === insumoSelecionado;
            return matchNome && matchSelect;
        });

        renderTabela(filtrado);
    }

    buscarInput.addEventListener('input', aplicarFiltros);
    selectInsumo.addEventListener('change', aplicarFiltros);

    // ==============================
    // FORMATAR DATA
    // ==============================
    function formatarData(data) {
        const d = new Date(data);
        return d.toLocaleDateString('pt-BR');
    }

    // ==============================
    // INIT
    // ==============================
    popularSelect();
    renderTabela(compras);
});
