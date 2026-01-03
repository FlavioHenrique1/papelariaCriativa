<?php \Classes\ClassLayout::setHeader('Cadastro','Realize seu cadastro em nosso sistema',"","cadastroservicos.css");?>
    
<div class="container">
    <h2>Cadastro de Serviços</h2>

    <form action="salvar_servico.php" method="POST">

        <div class="form-group">
            <label>Nome do Serviço</label>
            <input type="text" name="nome_servico" required>
        </div>

        <div class="form-group">
            <label>Categoria</label>
            <select name="categoria" required>
                <option value="">Selecione</option>
                <option value="impressao">Impressão</option>
                <option value="encadernacao">Encadernação</option>
                <option value="plastificacao">Plastificação</option>
                <option value="xerox">Xerox</option>
                <option value="outros">Outros</option>
            </select>
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Preço do Serviço (R$)</label>
            <input type="number" step="0.01" name="preco" required>
        </div>

        <!-- INSUMOS -->
        <h3>Insumos Utilizados</h3>

        <div id="insumos">
            <div class="insumo-item">
                <input type="text" name="insumo_nome[]" placeholder="Ex: Espiral" required>
                <input type="number" name="insumo_qtd[]" placeholder="Qtd" min="1" required>
                <button type="button" class="btn-remove" onclick="removerInsumo(this)">✖</button>
            </div>
        </div>

        <button type="button" class="btn-add" onclick="adicionarInsumo()">+ Adicionar Insumo</button>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>

        <button type="submit">Salvar Serviço</button>

    </form>
</div>

<script>
function adicionarInsumo() {
    const div = document.createElement("div");
    div.classList.add("insumo-item");

    div.innerHTML = `
        <input type="text" name="insumo_nome[]" placeholder="Ex: Papel A4" required>
        <input type="number" name="insumo_qtd[]" placeholder="Qtd" min="1" required>
        <button type="button" class="btn-remove" onclick="removerInsumo(this)">✖</button>
    `;

    document.getElementById("insumos").appendChild(div);
}
function removerInsumo(botao) {
    botao.parentElement.remove();
}
</script>
<?php \Classes\ClassLayout::setFooter();?>