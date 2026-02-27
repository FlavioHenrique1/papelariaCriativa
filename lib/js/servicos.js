
const h2Modal=document.getElementById("h2Modal");

async function visualizarServico(id) {

    try {

        const response = await carregarServicos(id);
        const servico = response.data.data;

        // Preenche campos
        document.querySelector("[name='nome_servico']").value = servico.nome || "";
        document.querySelector("[name='categoria']").value = servico.categoria || "";
        document.querySelector("[name='tamanho']").value = servico.tamanho || "";
        document.querySelector("[name='preco']").value = servico.preco || "";
        document.querySelector("[name='descricao']").value = servico.descricao || "";
        document.getElementById("idservico").value = servico.id;

        // Atualiza título do modal
        document.querySelector("#modalServico .modal-title").innerText = "Editar Serviço";

        // Limpa insumos
        const container = document.getElementById("insumos");
        container.innerHTML = "";

        // Renderiza insumos existentes
        if (response.insumos && response.insumos.length) {

            response.insumos.forEach((insumo) => {

                const div = document.createElement("div");

                div.classList.add(
                    "row",
                    "g-2",
                    "align-items-center",
                    "border",
                    "rounded-3",
                    "p-2",
                    "bg-light",
                    "mb-2"
                );

                div.innerHTML = `
                    <div class="col-md-6 col-12">
                        <select class="form-select selectInsumos"
                                name="insumo_nome[]"
                                required>
                            <option value="${insumo.id}" selected>
                                ${insumo.nome}
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4 col-8">
                        <input type="number"
                               class="form-control"
                               name="insumo_qtd[]"
                               min="1"
                               value="${insumo.quantidade}"
                               required>
                    </div>

                    <div class="col-md-2 col-4 text-end">
                        <button type="button"
                                class="btn btn-outline-danger btn-sm w-100"
                                onclick="removerInsumo(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;

                container.appendChild(div);

                // 🔥 Atualiza opções do select mantendo selecionado
                const select = div.querySelector(".selectInsumos");
                carregarInsumos(select, insumo.id);

            });
        }

        // Abre modal
        const modal = new bootstrap.Modal(
            document.getElementById("modalServico")
        );
        modal.show();

    } catch (e) {
        console.error(e);
        alert("Erro ao carregar serviço.");
    }
}


modalShow=()=>{
    // 🔥 ABRE O MODAL
    const modal = new bootstrap.Modal(
        document.getElementById('modalServico')
    );
    document.getElementById('formServico').reset();
    const ul = document.getElementById("insumos");
    ul.innerHTML="";
    h2Modal.innerHTML = "Cadastro de Serviços";
    modal.show();
}

function adicionarInsumo() {

    const container = document.getElementById("insumos");
    if (!container) return;

    const div = document.createElement("div");

    div.classList.add(
        "row",
        "g-2",
        "align-items-center",
        "border",
        "rounded-3",
        "p-2",
        "bg-light",
        "mb-2"
    );

    div.innerHTML = `
        <div class="col-md-6 col-12">
            <select class="form-select selectInsumos" name="insumo_nome[]" required>
                <option value="">Carregando...</option>
            </select>
        </div>

        <div class="col-md-4 col-8">
            <input type="number"
                   class="form-control"
                   name="insumo_qtd[]"
                   placeholder="Quantidade"
                   min="1"
                   required>
        </div>

        <div class="col-md-2 col-4 text-end">
            <button type="button"
                    class="btn btn-outline-danger btn-sm w-100"
                    onclick="removerInsumo(this)">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;

    container.appendChild(div);

    const novoSelect = div.querySelector(".selectInsumos");
    carregarInsumos(novoSelect);
}


function removerInsumo(botao) {
    botao.closest(".row").remove();
}


/* ==========================
BUSCAR INSUMOS
========================== */
function carregarInsumos(select, selecionado = null) {

    Http.post('controllers/controllerInsumo', 'action=list')
        .then(response => {

            // dependendo de como seu Http está configurado
            const data = response.data || response;

            select.innerHTML = '<option value="">Selecione o insumo</option>';

            data.forEach(insumo => {

                const option = document.createElement('option');
                option.value = insumo.id;
                option.textContent = insumo.nome + " - " + insumo.tamanho;

                if (selecionado && insumo.id == selecionado) {
                    option.selected = true;
                }

                select.appendChild(option);
            });

        })
        .catch(error => {
            console.error("Erro ao carregar insumos:", error);
        });
}


function popularSelectInsumos(dados, selectEl) {
    // Limpa opções atuais (exceto a primeira, se quiser manter "Selecione um insumo")
    selectEl.innerHTML = '<option value="">Selecione um insumo</option>';

    dados.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id; // ou item.id se preferir
        option.textContent = item.nome + " - " + item.tamanho;
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

function renderizarTabela(servicos) {
    
    const tbody = document.querySelector('#tabelaServicos tbody');
    
    if (!tbody) return;

    tbody.innerHTML = '';

    if (!servicos || !servicos.length) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-4 text-muted">
                    Nenhum serviço cadastrado
                </td>
            </tr>
        `;
        return;
    }

    servicos.forEach(item => {

        const tr = document.createElement('tr');

        const statusNormalizado = (item.status || '').toLowerCase();
        const classStatus = statusNormalizado === "ativo"
            ? "badge bg-success"
            : "badge bg-danger";

        const statusTexto = statusNormalizado === "ativo"
            ? "Ativo"
            : "Inativo";

        tr.innerHTML = `
            <td class="fw-semibold">${item.nome}</td>
            <td>${item.categoria}</td>
            <td>${item.tamanho}</td>
            <td class="text-success fw-bold">
                R$ ${Number(item.preco).toFixed(2).replace('.', ',')}
            </td>
            <td>
                <span class="${classStatus}">
                    ${statusTexto}
                </span>
            </td>
            <td>
                <button class="btn btn-sm btn-outline-warning me-1"
                    onclick="visualizarServico(${item.id})">
                    <i class="bi bi-pencil"></i>
                </button>

                <button class="btn btn-sm btn-outline-danger"
                    onclick="excluirServicos(${item.id})">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
    });
}

