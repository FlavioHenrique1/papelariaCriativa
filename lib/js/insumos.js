// pages/insumos.js

document.addEventListener('DOMContentLoaded', () => {

    /* ==================================================
       ELEMENTOS GERAIS
    ================================================== */
    const modalEl     = document.getElementById('modalInsumo');
    const modal       = new bootstrap.Modal(modalEl);
    const form        = document.getElementById('formInsumo');

    /* ==================================================
       MODAL - NOVO INSUMO
    ================================================== */
    window.novoInsumo = () => {
        document.getElementById('modalTitulo').innerText = 'Novo Insumo';
        document.getElementById('insumo_id').value = '';
        document.getElementById('nome').value = '';
        document.getElementById('descricao').value = '';
        document.getElementById('unidade_base').value='';

        modal.show();
    };

    /* ==================================================
       MODAL - EDITAR INSUMO
    ================================================== */
    window.editarInsumo = (id, nome, estoque, descricao) => {
        document.getElementById('modalTitulo').innerText = 'Editar Insumo';
        document.getElementById('insumo_id').value = id;
        document.getElementById('nome').value = nome;
        document.getElementById('descricao').value = descricao;
        modal.show();
    };

    /* ==================================================
       SUBMIT DO FORMULÁRIO (CRIAR / EDITAR)
    ================================================== */
    if (form) {
        Form.submit(
            form,
            'controllers/controllerInsumo',
            (response) => {
                if (response.success) {
                    UI.success(response.message);
                    setTimeout(() => {
                        modal.hide();
                        carregarInsumos();
                    }, 800);
                } else {
                    console.log(response.message);

                    UI.error(response.message,"modal");

                    // UI.error(response.message || response.errors);
                }
            }
        );
    }

    /* ==================================================
       EXCLUIR INSUMO
    ================================================== */
    window.excluirInsumo = (id) => {
        if (!confirm('Deseja realmente excluir este insumo?')) return;

        UI.clear();

        Http.post(
            'controllers/controllerInsumo',
            `action=delete&id=${id}`
        ).then(response => {
            if (response.success) {
                UI.success(response.message);
                carregarInsumos();
            } else {
                UI.error(response.message || response.errors);
            }
        });
    };

    /* ==================================================
       CONVERSÃO DE UNIDADES
    ================================================== */
    const unidadeBase     = document.getElementById('unidade_base');
    const blocoConversao  = document.getElementById('blocoConversao');
    const tabelaConversao = document.getElementById('tabelaConversao');
    const btnAddConversao = document.getElementById('btnAddConversao');

    const unidadesComConversao = ['folha', 'ml', 'g'];

    if (unidadeBase) {
        unidadeBase.addEventListener('change', () => {
            const valor = unidadeBase.value;

            if (unidadesComConversao.includes(valor)) {
                blocoConversao.classList.remove('d-none');
            } else {
                blocoConversao.classList.add('d-none');
                tabelaConversao.innerHTML = '';
            }
        });
    }

    if (btnAddConversao) {
        btnAddConversao.addEventListener('click', () => {
            tabelaConversao.insertAdjacentHTML('beforeend', `
                <tr>
                    <td>
                        <input type="text"
                               class="form-control form-control-sm unidade_compra"
                               placeholder="Ex: Resma" name="unidade_compra[]"
                               required>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm fator"
                               placeholder="Ex: 500" name="fator[]"
                               required>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remover">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
    }

    tabelaConversao?.addEventListener('click', (e) => {
        if (e.target.closest('.remover')) {
            e.target.closest('tr').remove();
        }
    });

    /* ==================================================
       INICIALIZAÇÃO
    ================================================== */
    carregarInsumos();

});

/* ==================================================
   LISTAGEM DE INSUMOS
================================================== */
function carregarInsumos() {
    Http.post(
        'controllers/controllerInsumo',
        'action=list'
    ).then(response => {
        if (!response.success) {
            alert(response.message);
            return;
        }
        renderizarTabela(response.data);
    });
}

/* ==================================================
   RENDERIZAÇÃO DA TABELA
================================================== */
function renderizarTabela(insumos) {
    const tbody = document.querySelector('#tabelaInsumos tbody');
    tbody.innerHTML = '';

    if (!insumos.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center">
                    Nenhum insumo cadastrado
                </td>
            </tr>
        `;
        return;
    }

    insumos.forEach(item => {
        const tr = document.createElement('tr');
        // console.log(item);
        tr.innerHTML = `
            <td>${item.nome}</td>
            <td>${item.descricao}</td>
            <td>${item.tamanho}</td>
            <td>${item.unidade_base}</td>
            <td>${item.estoque_minimo}</td>
            <td class="text-end">
                <button class="btn btn-sm btn-warning"
                    onclick="editarInsumo(${item.id}, '${item.nome}', ${item.estoque}, '${item.descricao}')">
                    Editar
                </button>
                <button class="btn btn-sm btn-danger"
                    onclick="excluirInsumo(${item.id})">
                    Excluir
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });
    
}
