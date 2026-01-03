
function visualizarServico(id) {

    // Exemplo de dados
    document.getElementById("m-nome").innerText = "Encadernação Simples";
    document.getElementById("m-categoria").innerText = "Encadernação";
    document.getElementById("m-preco").innerText = "R$ 12,00";

    const ul = document.getElementById("m-insumos");
    ul.innerHTML = `
        <li>1 Espiral</li>
        <li>10 Folhas Papel A4</li>
    `;

    // 🔥 ABRE O MODAL
    const modal = new bootstrap.Modal(
        document.getElementById('modalServico')
    );
    modal.show();
}


function adicionarInsumo() { 
    const container = document.getElementById("insumos");
    if (!container) return; // sai da função se não existir o container

    const div = document.createElement("div");
    div.classList.add("insumo-item");

    div.innerHTML = `
        <select class="selectInsumos" name="insumo_nome[]" placeholder="Ex: Espiral" required>
            <option value="">Carregando...</option>
        </select>
        <input type="number" name="insumo_qtd[]" placeholder="Qtd" min="1" required>
        <button type="button" class="btn-remove" onclick="removerInsumo(this)">✖</button>
    `;

    container.appendChild(div);

    // Seleciona o select recém-criado
    const novoSelect = div.querySelector(".selectInsumos");

    // Carrega os dados para esse select
    carregarInsumos(novoSelect);
}

function removerInsumo(botao) {
    botao.parentElement.remove();
}

/* ==========================
   BUSCAR INSUMOS
========================== */
function carregarInsumos(selectEl) {
    Http.post('controllers/controllerInsumo', 'action=list')
        .then(response => {
            if (response.success && response.data) {
                popularSelectInsumos(response.data, selectEl);
            } else {
                console.error('Erro ao buscar insumos:', response.message);
            }
        });
}



function popularSelectInsumos(dados, selectEl) {
    // Limpa opções atuais (exceto a primeira, se quiser manter "Selecione um insumo")
    selectEl.innerHTML = '<option value="">Selecione um insumo</option>';

    dados.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id; // ou item.id se preferir
        option.textContent = item.nome;
        selectEl.appendChild(option);
    });
}
adicionarInsumo()

const form = document.getElementById('formServiço');
const erroBox = document.getElementById('erroBox'); // ajuste se tiver
const sucessoBox = document.getElementById('sucessoBox');
    /* ==========================
       SUBMIT DO FORMULÁRIO
       (SUBSTITUI salvarInsumo)
    ========================== */
if (form) {
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // ❌ previne o reload da página

        // // Limpa mensagens
        // erroBox.classList.add('d-none');
        // sucessoBox.classList.add('d-none');

        // Envia via AJAX
        Form.submit(form, 'controllers/controllerServicos', (response) => {
            if (response.success) {
                sucessoBox.innerText = response.message;
                sucessoBox.classList.remove('d-none');
            } else {
                erroBox.innerText = response.message;
                erroBox.classList.remove('d-none');
            }
        });
    });
}

/* ==========================
   BUSCAR INSUMOS
========================== */
function carregarServicos() {
    Http.post(
        'controllers/controllerServicos',
        'action=list'
    ).then(response => {
        if (!response.success) {
            alert(response.message);
            return;
        }
        // console.log(response.data)
        renderizarTabela(response.data);
    });
}
carregarServicos()

function renderizarTabela(serviços) {
    const tbody = document.querySelector('#tabelaServicos tbody');
    if (!tbody) return; // sai da função se não existir o container
    tbody.innerHTML = '';
    if (!serviços.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center">Nenhum insumo cadastrado</td>
            </tr>
        `;
        return;
    }

    serviços.forEach(item => {
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td>${item.nome}</td>
            <td>${item.categoria}</td>
            <td>${item.preco}</td>
            <td>${item.status}</td>
            <td class="">
                <button class="btn btn-sm btn-info"
                    onclick="visualizarServico(${item.id})">
                    Visualizar
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
