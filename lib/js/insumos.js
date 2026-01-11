// pages/insumos.js

document.addEventListener('DOMContentLoaded', () => {

    const modalEl = document.getElementById('modalInsumo');
    const modal = new bootstrap.Modal(modalEl);

    const form = document.getElementById('formInsumo');
    const erroBox = document.getElementById('insumoErro');
    const sucessoBox = document.getElementById('insumoSucesso');

    /* ==========================
       NOVO INSUMO
    ========================== */
    window.novoInsumo = () => {
        document.getElementById('modalTitulo').innerText = 'Novo Insumo';
        document.getElementById('insumo_id').value = '';
        document.getElementById('nome').value = '';
        document.getElementById('estoque').value = '';
        erroBox.classList.add('d-none');
        sucessoBox.classList.add('d-none');

        modal.show();
    };

    /* ==========================
       EDITAR INSUMO
    ========================== */
    window.editarInsumo = (id, nome, estoque,descricao) => {
        document.getElementById('modalTitulo').innerText = 'Editar Insumo';
        document.getElementById('insumo_id').value = id;
        document.getElementById('nome').value = nome;
        document.getElementById('estoque').value = estoque;
        document.getElementById('descricao').value = descricao;
        erroBox.classList.add('d-none');
        sucessoBox.classList.add('d-none');

        modal.show();
    };

    /* ==========================
       SUBMIT DO FORMULÁRIO
       (SUBSTITUI salvarInsumo)
    ========================== */
    if (form) {
        Form.submit(
            form,
            'controllers/controllerInsumo',
            (response) => {
                erroBox.classList.add('d-none');
                sucessoBox.classList.add('d-none');

                if (response.success) {
                    sucessoBox.innerText = response.message;
                    sucessoBox.classList.remove('d-none');

                    setTimeout(() => {
                        modal.hide();
                        carregarInsumos();
                    }, 800);
                } else {
                    erroBox.innerText = response.message;
                    erroBox.classList.remove('d-none');
                }
            }
        );
    }

    /* ==========================
       EXCLUIR INSUMO
    ========================== */
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
                alert(response.message);
            }
        });
    };
    carregarInsumos();

});

/* ==========================
   BUSCAR INSUMOS
========================== */
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

function renderizarTabela(insumos) {
    const tbody = document.querySelector('#tabelaInsumos tbody');
    tbody.innerHTML = '';
    if (!insumos.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center">Nenhum insumo cadastrado</td>
            </tr>
        `;
        return;
    }

    insumos.forEach(item => {
        const tr = document.createElement('tr');

        tr.innerHTML = `
        <td>${item.nome}</td>
        <td>${item.descricao}</td>
        <td>${item.tamanho}</td>
        <td>${item.estoque}</td>
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
