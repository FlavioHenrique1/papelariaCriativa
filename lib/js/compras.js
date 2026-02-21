function formatarData(data) {
    return new Date(data).toLocaleDateString('pt-BR');
}

document.addEventListener('DOMContentLoaded', () => {
    let listCompras = [];
    totalCompras = document.getElementById("totalCompras");
    totalMes = document.getElementById("totalMes");
    totalInsumos = document.getElementById("totalInsumos");

    let pagina = 1;
    const porPagina = 10;
    let listaFiltrada = [];



    window.carregarCompras = async function () {
        const dados = await Compras.listar();
        // listCompras = JSON.parse(dados);
        console.log(dados);
        listCompras = dados;

        const mesAtual = new Date().toISOString().slice(0, 7);
        // console.log(resumoCompras);
        const resumo = resumoCompras(listCompras);
        totalCompras.innerHTML = `R$ ${Number(resumo.totalGeral).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`
        const resumoMes = resumoCompras(listCompras, mesAtual);
        totalMes.innerHTML = `R$ ${Number(resumoMes.totalGeral).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}`
        totalInsumos.innerHTML = resumoMes.quantidadeTotal

        renderTabela(listCompras);
        popularSelect();
    }
    carregarCompras();
    const tabelaBody = document.querySelector('#tabelaCompras tbody');
    const buscarInput = document.getElementById('buscarCompra');
    const selectInsumo = document.getElementById('insumoSelect');

    // ==============================
    // MODAL
    // ==============================
    const modalCompraEl = document.getElementById('modalCompra');
    const modalCompra = new bootstrap.Modal(modalCompraEl);

    const btnNovaCompra = document.getElementById('btnNovaCompra');

    btnNovaCompra.addEventListener('click', () => {
        modalCompra.show();
    });

    const insumoInput = document.getElementById('compraInsumo');
    const qtdInput = document.getElementById('compraQtd');
    const valorInput = document.getElementById('compraValor');
    const dataInput = document.getElementById('compraData');
    const totalInput = document.getElementById('compraTotal');
    const salvarBtn = document.getElementById('salvarCompra');
    const inputFator = document.getElementById('compraFator');
    const custoUnitarioBase=document.getElementById('custoUnitarioBase');
    function atualizarPaginacao() {
        const totalPaginas = Math.ceil(listaFiltrada.length / porPagina);

        document.getElementById('paginaAtual').innerText =
            `Página ${pagina} de ${totalPaginas}`;

        document.getElementById('infoPaginacao').innerText =
            `Mostrando ${listaFiltrada.length} registros`;

        document.getElementById('btnAnterior').disabled = pagina === 1;
        document.getElementById('btnProximo').disabled = pagina === totalPaginas;
    }

    document.getElementById('btnAnterior').addEventListener('click', () => {
        if (pagina > 1) {
            pagina--;
            renderTabela(listaFiltrada);
        }
    });

    document.getElementById('btnProximo').addEventListener('click', () => {
        const totalPaginas = Math.ceil(listaFiltrada.length / porPagina);
        if (pagina < totalPaginas) {
            pagina++;
            renderTabela(listaFiltrada);
        }
    });


    // ==============================
    // RENDER TABELA
    // ==============================
    function renderTabela(lista) {
        tabelaBody.innerHTML = '';

        if (!Array.isArray(lista) || lista.length === 0) {
            tabelaBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Nenhuma compra encontrada
                    </td>
                </tr>
            `;
            return;
        }

        listaFiltrada = lista;

        const inicio = (pagina - 1) * porPagina;
        const fim = inicio + porPagina;
        const paginaDados = listaFiltrada.slice(inicio, fim);

        paginaDados.forEach(compra => {
            const statusBadge =
                compra.status === 'Concluída'
                    ? 'success'
                    : 'warning';
            tabelaBody.innerHTML += `
                <tr>
                    <td>${formatarData(compra.data)}</td>
                    <td>${compra.insumo}</td>
                    <td>${compra.quantidade}</td>
                    <td>R$ ${Number(compra.valor_unitario).toFixed(2).replace('.', ',')}</td>
                    <td>
                        <span class="badge bg-${statusBadge}">
                            ${compra.status}
                        </span>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-primary"
                            onclick="visualizarCompra(${compra.compra_id})"
                            title="Visualizar">
                            <i class="bi bi-eye"></i>
                        </button>

                        <button class="btn btn-sm btn-outline-danger"
                            onclick="excluirCompra(${compra.compra_id})"
                            title="Excluir">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

        });

        atualizarPaginacao();
    }


    // ==============================
    // POPULAR SELECT INSUMOS
    // ==============================
    function popularSelect() {
        selectInsumo.innerHTML = `<option value="">Todos os insumos</option>`;
        const insumos = [...new Set(listCompras.map(c => c.insumo))];
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

        const filtrado = listCompras.filter(c => {
            const matchNome = c.insumo.toLowerCase().includes(termo);
            const matchSelect = insumoSelecionado === '' || c.insumo === insumoSelecionado;
            return matchNome && matchSelect;
        });

        pagina = 1;
        renderTabela(filtrado);

    }

    buscarInput.addEventListener('input', aplicarFiltros);
    selectInsumo.addEventListener('change', aplicarFiltros);

    // ==============================
    // CALCULAR TOTAL
    // ==============================
    function calcularTotal() {
        const q = parseFloat(qtdInput.value) || 0;
        const v = parseFloat(valorInput.value) || 0;
        // totalInput.value = `R$ ${(q * v).toFixed(2)}`;
        totalInput.value = `R$ ${Number(q * v)
                    .toFixed(2)
                    .replace('.', ',')}`;
        custoUnitarioBase.value =`R$ ${Number(v / inputFator.value)
                    .toFixed(2)
                    .replace('.', ',')}`;
    }

    qtdInput.addEventListener('input', calcularTotal);
    valorInput.addEventListener('input', calcularTotal);

    // ==============================
    // SALVAR COMPRA (PADRÃO DO SISTEMA)
    // ==============================
    const formCompra = document.getElementById('formCompra');

    if (formCompra) {

        Form.submit(
            formCompra,
            'controllers/controllerCompras',
            (response) => {

                if (response.success) {

                    UI.success(response.message || 'Compra registrada com sucesso');

                    setTimeout(() => {
                        modalCompra.hide();
                        formCompra.reset();
                        carregarCompras();
                        popularSelect();
                        aplicarFiltros();
                    }, 800);

                } else {
                    UI.error(response.message || 'Erro ao registrar compra');
                }
            },
            (err) => {
                UI.error('Erro de comunicação com o servidor');
                console.error(err);
            }
        );
    }


    function limparFormulario() {
        insumoInput.value = '';
        qtdInput.value = '';
        valorInput.value = '';
        dataInput.value = '';
        totalInput.value = '';
    }

    // ==============================
    // INIT
    // ==============================
    // popularSelect();
    // renderTabela(compras);

    function resumoCompras(dados, mes = null) {
        return dados.reduce((acc, item) => {

            const mesItem = item.data.slice(0, 7); // YYYY-MM

            // 👉 Se foi passado um mês e não bate, ignora
            if (mes && mesItem !== mes) return acc;

            const total = Number(item.total);
            const quantidade = Number(item.quantidade);

            acc.totalGeral += total;
            acc.quantidadeTotal += quantidade;

            return acc;

        }, {
            totalGeral: 0,
            quantidadeTotal: 0
        });
    }
Insumo.preencherSelect('#compraInsumo');

async function excluirCompra(id) {

    if (!confirm('Tem certeza que deseja excluir esta compra?')) {
        return;
    }

    try {
        const response = await Compras.deletar(id);
        const res = response;
        // console.log(res.success);
        if (res.success) {
            alert(res.message || 'Compra excluída');
            carregarCompras(); // recarrega tabela
        } else {
            alert(res.message || 'Erro ao excluir');
        }

    } catch (e) {
        console.error(e);
        alert('Erro de comunicação com o servidor');
    }
}

window.visualizarCompra = async function (id) {
    try {
        const response = await Compras.listar(id);
        const dados = JSON.parse(response);

        if (!dados || dados.length === 0) {
            UI.warning('Compra não encontrada');
            return;
        }

        // Exemplo simples (alert)
        const compra = dados[0];

        let itens = '';
        dados.forEach(item => {
            itens += `
                • ${item.insumo}
                  Qtd: ${item.quantidade}
                  Valor: R$ ${Number(item.valor_unitario)
                    .toFixed(2)
                    .replace('.', ',')}
                \n`;
        });

        alert(`
    Compra #${compra.compra_id}
    Data: ${formatarData(compra.data)}
    Status: ${compra.status}

    Itens:
    ${itens}
            `);

    } catch (e) {
        console.error(e);
        UI.error('Erro ao buscar detalhes da compra');
    }
}

// let conversoesAtuais = [];
document.getElementById('compraInsumo')
    .addEventListener('change', async (e) => {

        const insumoId = e.target.value;
        const selectUnidade = document.getElementById('compraUnidade');

        // reset
        selectUnidade.innerHTML = '<option value="">Selecione</option>';
        inputFator.value = '';
        conversoesAtuais = [];

        if (!insumoId) return;

        try {
            const conversoes = await Insumo.getConversoes(insumoId);
            // ex: [{ unidade_compra: "Resma", fator: 500 }]
            conversoesAtuais = conversoes;
            

            conversoes.forEach(c => {
                const option = document.createElement('option');
                option.value = c.descricao;
                option.textContent = c.descricao;
                selectUnidade.appendChild(option);
            });

            selectUnidade.addEventListener('change', (e) => {
                // console.log("teste");
            });

        } catch (err) {
            console.error(err);
            UI.error('Erro ao carregar unidades de compra');
        }
    });

    document.getElementById('compraUnidade')
        .addEventListener('change', (e) => {
            // console.log(conversoesAtuais);
            const unidadeSelecionada = e.target.value;
            
            if (!unidadeSelecionada) {
                inputFator.value = '';
                return;
            }

            const conversao = conversoesAtuais.find(
                c => c.descricao === unidadeSelecionada
            );
            console.log(conversao);

            inputFator.value = conversao ? conversao.fator : '';
    });




});

