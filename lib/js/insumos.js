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
    window.editarInsumo = (id, nome, estoque) => {
        document.getElementById('modalTitulo').innerText = 'Editar Insumo';
        document.getElementById('insumo_id').value = id;
        document.getElementById('nome').value = nome;
        document.getElementById('estoque').value = estoque;
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
                        location.reload();
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

        Http.post(
            'controllers/insumoController',
            `action=delete&id=${id}`
        ).then(response => {
            if (response.success) {
                location.reload();
            } else {
                alert(response.message);
            }
        });
    };

});
