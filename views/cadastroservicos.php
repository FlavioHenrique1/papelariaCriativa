<?php \Classes\ClassLayout::setHeader('Cadastro','Realize seu cadastro em nosso sistema',"","cadastroservicos.css");?>
    
<div class="container">
    <h2>Cadastro de Serviços</h2>

    <form name="formServiço" id="formServiço" action="" method="post">

        <div class="form-group">
            <div id="appMessage" class="alert d-none" role="alert"></div>
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
            <!-- <div class="insumo-item">
                <select class="selectInsumos" name="insumo_nome[]" placeholder="Ex: Espiral" required>>
                    <option value="encadernacao">papel a4</option>
                    <option value="plastificacao">Plastico</option>
                    <option value="xerox">tinta</option>
                </select>
                <input type="number" name="insumo_qtd[]" placeholder="Qtd" min="1" required>
                <button type="button" class="btn-remove" onclick="removerInsumo(this)">✖</button>
            </div> -->
        </div>

        <button type="button" class="btn-add" onclick="adicionarInsumo()">+ Adicionar Insumo</button>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
            </select>
        </div>

        <button type="submit">Salvar Serviço</button>

    </form>
</div>
<?php \Classes\ClassLayout::setFooter("servicos.js");?>