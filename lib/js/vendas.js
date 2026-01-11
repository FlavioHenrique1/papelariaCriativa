let total = 0;

    function adicionarServico() {

        const select = document.getElementById('servicoSelect');
        const nome = select.options[select.selectedIndex].text;
        const valorUnit = parseFloat(select.value);
        const qtd = parseInt(document.getElementById('qtd').value);

        const subtotal = valorUnit * qtd;
        total += subtotal;

        const tbody = document.getElementById('listaCaixa');

        if (tbody.children[0]?.children.length === 4) {
            tbody.innerHTML = '';
        }

        tbody.innerHTML += `
        <tr>
            <td>${nome}</td>
            <td>${qtd}</td>
            <td>R$ ${subtotal.toFixed(2)}</td>
            <td>
                <button class="btn btn-sm btn-danger" onclick="remover(this, ${subtotal})">
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
        document.getElementById('total').innerText = total.toFixed(2);

        const pago = parseFloat(document.getElementById('pago').value) || 0;
        const saldo = pago - total;

        document.getElementById('troco').value =
            saldo >= 0 ? `Troco: R$ ${saldo.toFixed(2)}` : `Devendo: R$ ${Math.abs(saldo).toFixed(2)}`;
    }

    document.getElementById('pago').addEventListener('input', atualizarTotal);