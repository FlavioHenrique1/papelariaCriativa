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
