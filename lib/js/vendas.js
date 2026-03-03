/* ==========================================
   ELEMENTOS PRINCIPAIS
========================================== */
const select     = document.getElementById("servicoSelect");
const custoUnit  = document.getElementById("custoUnit");
const troco      = document.getElementById("troco");
const form       = document.getElementById("formVendas");
const tbody      = document.getElementById("listaCaixa");

let total = 0;


/* ==========================================
   FORMATADORES
========================================== */

// Formata número para moeda brasileira
function formatarMoeda(valor) {
    return valor.toLocaleString("pt-BR", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

// Converte string BR para número real JS
function converterParaNumero(valor) {
    return parseFloat(
        valor
            .replace(/\./g, "")
            .replace(",", ".")
    ) || 0;
}


/* ==========================================
   MÁSCARA DE DINHEIRO (ESTILO CAIXA)
========================================== */
function mascaraDinheiro(input) {

    let valor = input.value.replace(/\D/g, "");

    if (!valor) {
        input.value = "0,00";
        return;
    }

    valor = (parseInt(valor) / 100).toFixed(2);

    input.value = valor
        .replace(".", ",")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


/* ==========================================
   ADICIONAR SERVIÇO
========================================== */
function adicionarServico() {

    if (!select.value) return;

    const servicoId = select.value;
    const nome      = select.options[select.selectedIndex].text;
    const valorUnit = parseFloat(select.options[select.selectedIndex].dataset.valor);
    const qtd       = parseInt(document.getElementById('qtd').value) || 1;

    const subtotal  = valorUnit * qtd;

    // Remove mensagem vazia
    if (tbody.querySelector('.text-muted')) {
        tbody.innerHTML = '';
    }

    // Cria linha
    const tr = document.createElement("tr");
    tr.dataset.valor = valorUnit;

    tr.innerHTML = `
        <td class="py-3">
            <input type="hidden" name="servico_id[]" value="${servicoId}">
            <input type="hidden" name="quantidade[]" value="${qtd}">
            <input type="hidden" name="valor_unitario[]" value="${valorUnit}">
            <input type="hidden" name="valor_total[]" value="${subtotal}">
            <div class="fw-bold text-dark">${nome}</div>
        </td>

        <td class="text-center fw-bold text-dark">
            R$ ${formatarMoeda(valorUnit)}
        </td>

        <td class="text-center">
            <div class="d-inline-flex align-items-center gap-2">
                <button class="btn btn-sm bg-light fw-bold border-0" 
                        type="button"
                        onclick="alterarQtd(this, -1)">-</button>

                <span class="fw-bold text-dark mx-2 qtd">${qtd}</span>

                <button class="btn btn-sm bg-light fw-bold border-0"
                        type="button"
                        onclick="alterarQtd(this, 1)">+</button>
            </div>
        </td>

        <td class="text-center fw-bold text-dark subtotal">
            R$ ${formatarMoeda(subtotal)}
        </td>

        <td class="text-end pe-4">
            <button class="btn btn-link text-danger p-0"
                    type="button"
                    onclick="removerLinha(this)">
                <span class="material-symbols-outlined">delete</span>
            </button>
        </td>
    `;

    tbody.appendChild(tr);

    recalcularTotal();
}


/* ==========================================
   ALTERAR QUANTIDADE
========================================== */
function alterarQtd(botao, operacao) {

    const tr        = botao.closest("tr");
    const qtdSpan   = tr.querySelector(".qtd");
    const valorUnit = parseFloat(tr.dataset.valor);

    let qtdAtual = parseInt(qtdSpan.textContent);
    let novaQtd  = qtdAtual + operacao;

    // Se zerar remove linha
    if (novaQtd <= 0) {
        tr.remove();
        recalcularTotal();
        return;
    }

    qtdSpan.textContent = novaQtd;

    // Atualiza subtotal
    const subtotal = valorUnit * novaQtd;
    tr.querySelector(".subtotal").textContent =
        `R$ ${formatarMoeda(subtotal)}`;

    // Atualiza input hidden quantidade
    tr.querySelector('input[name="quantidade[]"]').value = novaQtd;
    tr.querySelector('input[name="valor_total[]"]').value = subtotal;

    recalcularTotal();
}


/* ==========================================
   REMOVER LINHA
========================================== */
function removerLinha(botao) {
    botao.closest("tr").remove();
    recalcularTotal();
}


/* ==========================================
   RECALCULAR TOTAL GERAL
========================================== */
function recalcularTotal() {

    total = 0;

    document.querySelectorAll("#listaCaixa tr").forEach(tr => {
        const valorUnit = parseFloat(tr.dataset.valor);
        const qtd       = parseInt(tr.querySelector(".qtd").textContent);
        total += valorUnit * qtd;
    });

    atualizarTotal();
}


/* ==========================================
   ATUALIZAR RESUMO (DESCONTO / TROCO)
========================================== */
function atualizarTotal() {

    const descontoInput = document.getElementById('desconto');
    const pagoInput     = document.getElementById('pago');

    const desconto = converterParaNumero(descontoInput.value);
    const totalComDesconto = Math.max(total - desconto, 0);

    document.getElementById('total').innerText =
        formatarMoeda(totalComDesconto);

    const pago  = converterParaNumero(pagoInput.value);
    const saldo = pago - totalComDesconto;

    troco.innerHTML =
        saldo >= 0
            ? `Troco: R$ ${formatarMoeda(saldo)}`
            : `Devendo: R$ ${formatarMoeda(Math.abs(saldo))}`;
}


/* ==========================================
   EVENTOS INPUT
========================================== */
document.getElementById('desconto')
    .addEventListener('input', atualizarTotal);

document.getElementById('pago')
    .addEventListener('input', atualizarTotal);


/* ==========================================
   CARREGAR SERVIÇOS (API)
========================================== */
async function carregarServicos() {

    const response = await Http.post(
        'controllers/controllerServicos',
        'action=list'
    );

    if (!response.success) {
        throw new Error(response.message);
    }

    select.innerHTML = '<option value="">Selecione um serviço</option>';

    response.data.forEach(item => {

        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = `${item.nome} - ${item.tamanho}`;
        option.dataset.valor = item.preco;

        select.appendChild(option);
    });
}

carregarServicos();


/* ==========================================
   ATUALIZA PREÇO AO TROCAR SERVIÇO
========================================== */
select.addEventListener('change', (e) => {

    const option = e.target.selectedOptions[0];
    if (!option || !option.dataset.valor) return;

    custoUnit.innerHTML =
        "R$ " + formatarMoeda(Number(option.dataset.valor));
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