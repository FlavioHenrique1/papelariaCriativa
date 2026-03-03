const servicoSelect=document.getElementById("servicoSelect");
const custoUnit=document.getElementById("custoUnit");
const troco=document.getElementById("troco");
const form=document.getElementById("formVendas");

let total = 0;

function adicionarServico() {

    const select = document.getElementById('servicoSelect');
    if (!select.value) return;

    const servicoId = select.value;
    const nome = select.options[select.selectedIndex].text;
    const valorUnit = parseFloat(select.options[select.selectedIndex].dataset.valor);
    const qtd = parseInt(document.getElementById('qtd').value);

    const subtotal = valorUnit * qtd;
    total += subtotal;

    const tbody = document.getElementById('listaCaixa');

    // remove mensagem "Nenhum serviço"
    if (tbody.querySelector('.text-muted')) {
        tbody.innerHTML = '';
    }

    tbody.innerHTML += `
        <tr>
            <td>
                ${nome}

                <!-- INPUTS ESCONDIDOS -->
                <input type="hidden" name="servico_id[]" value="${servicoId}">
                <input type="hidden" name="quantidade[]" value="${qtd}">
                <input type="hidden" name="valor_unitario[]" value="${valorUnit}">
                <input type="hidden" name="valor_total[]" value="${subtotal}">
            </td>

            <td>${qtd}</td>
            <td>R$ ${subtotal.toFixed(2)}</td>
            <td>
                <button type="button"
                        class="btn btn-sm btn-danger"
                        onclick="remover(this, ${subtotal})">
                    ✖
                </button>
            </td>
        </tr>
    `;

    atualizarTotal();
}


function remover(btn, valor) {
    btn.closest('tr').remove();
    total -= valor;
    atualizarTotal();
}

function atualizarTotal() {

    const desconto = parseFloat(document.getElementById('desconto').value) || 0;
    if (desconto > total) {
        document.getElementById('desconto').value = total.toFixed(2);
    }
    // 🔹 garante que desconto não seja maior que o total
    const totalComDesconto = Math.max(total - desconto, 0);

    document.getElementById('total').innerText = totalComDesconto.toFixed(2);

    const pago = parseFloat(document.getElementById('pago').value) || 0;
    const saldo = pago - totalComDesconto;

    document.getElementById('troco').innerHTML =
        saldo >= 0
            ? `Troco: R$ ${saldo.toFixed(2)}`
            : `Devendo: R$ ${Math.abs(saldo).toFixed(2)}`;
}


document.getElementById('desconto').addEventListener('input', atualizarTotal);
document.getElementById('pago').addEventListener('input', atualizarTotal);


function popularSelectServicos(dados) {
    servicoSelect.innerHTML = '<option value="">Selecione um serviço</option>';

    dados.forEach(item => {
        const option = document.createElement('option');

        option.value = item.id;
        option.textContent = `${item.nome} - ${item.tamanho}`;

        // 🔥 dados extras escondidos
        option.dataset.valor   = item.preco;
        option.dataset.nome    = item.nome;
        option.dataset.tamanho = item.tamanho;

        servicoSelect.appendChild(option);
    });
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
        popularSelectServicos(response.data)
    }

    return response;
}
carregarServicos()

servicoSelect.addEventListener('change', (e) => {
    const option = e.target.selectedOptions[0];
    if (!option || !option.dataset.valor) return;
    
    const valor = Number(option.dataset.valor);
    const qtd   = Number(document.getElementById('qtd').value || 1);
    
    custoUnit.value = valor
    
});

if (form) {

    // Limpa mensagens quando a página carrega
    UI.clear();

    Form.submit(
        form,
        'controllers/controllerVendas',

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