
const h2Modal=document.getElementById("h2Modal");

async function visualizarServico(id) {
    try {
    const servico = await carregarServicos(id);
    document.getElementById("m-nome").value = servico.data.data.nome;
    document.getElementById("m-categoria").value = servico.data.data.categoria;
    document.getElementById("m-preco").value = servico.data.data.preco;
    document.getElementById("m-descricao").value = servico.data.data.descricao;
    document.getElementById("idservico").value = servico.data.data.id;
    h2Modal.innerHTML = "Editar Serviços";

    const ul = document.getElementById("insumos");
    ul.innerHTML="";
    servico.insumos.map((insumo)=>{
        ul.innerHTML += `
            <div class="insumo-item">
                <select class="selectInsumos" name="insumo_nome[]" placeholder="Ex: Espiral" required>>
                <option value="${insumo.id}" selected>
                    ${insumo.nome}
                </option>
                    <option value="encadernacao">papel a4</option>
                    <option value="plastificacao">Plastico</option>
                    <option value="xerox">tinta</option>
                </select>
                <input type="number" name="insumo_qtd[]" placeholder="Qtd" min="1" value=${insumo.quantidade} required>
                <button type="button" class="btn-remove" onclick="removerInsumo(this)">✖</button>
            </div>
        `;
    })

    // 🔥 ABRE O MODAL
    const modal = new bootstrap.Modal(
        document.getElementById('modalServico')
    );
    modal.show();
    } catch (e) {
        alert(e.message);
    }

}

modalShow=()=>{
    // 🔥 ABRE O MODAL
    const modal = new bootstrap.Modal(
        document.getElementById('modalServico')
    );
    document.getElementById('formServiço').reset();
    const ul = document.getElementById("insumos");
    ul.innerHTML="";
    h2Modal.innerHTML = "Cadastro de Serviços";
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

/* ==========================
   SUBMIT DO FORMULÁRIO
   (SUBSTITUI salvarInsumo)
========================== */

const form = document.getElementById('formServiço');
const msgBox = document.getElementById('msgBox');

if (form) {

    // Limpa mensagens quando a página carrega
    UI.clear();

    Form.submit(
        form,
        'controllers/controllerServicos',

        // onSuccess
        (response) => {
            if (response.success) {
                UI.success(response.message);
                form.reset();
            } else {
                UI.error(response.message || response.errors);
            }
        },

        // onError
        () => {
            UI.error('Erro de comunicação com o servidor');
        }
    );
}

/* ==========================
   BUSCAR SERVIÇOS
========================== */
async function carregarServicos(id = null) {

    let dados = 'action=list';
    if (id !== null) {
        dados += '&id=' + id;
    }

    const response = await Http.post(
        'controllers/controllerServicos',
        dados
    );

    if (!response.success) {
        throw new Error(response.message);
    }

    if (id == null) {
        renderizarTabela(response.data)
    }

    return response;
}

carregarServicos()

const excluirServicos = (id) => {
    if (!confirm('Deseja realmente excluir este insumo?')) return;
    UI.clear();
    Http.post(
        'controllers/controllerServicos',
        `action=delete&id=${id}`
    ).then(response => {
        if (response.success) {
            // UI.success(response.message);
            carregarServicos();
        } else {
            // UI.error(response.message || response.errors);
            alert(response.message);
        }
    });
}

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
        let classStatus = item.status === "ativo" ? "badge bg-success" : "badge bg-danger";
        tr.innerHTML = `
            <td>${item.nome}</td>
            <td>${item.categoria}</td>
            <td class="valor">R$ ${Number(item.preco)
                    .toFixed(2)
                    .replace('.', ',')}</td>
            <td>
                <span class="${classStatus}">${item.status}</span>
            </td>
            <td class="">
                <button class="btn btn-sm btn-warning"
                    onclick="visualizarServico(${item.id})">
                    Editar
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });
}
