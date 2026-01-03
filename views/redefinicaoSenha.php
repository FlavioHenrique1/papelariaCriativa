<?php \Classes\ClassLayout::setHeader('Redefinição de Senha','Redefina sua senha');?>
    
    <div class="topFaixa float w100 center">
        Cadastro de Clientes
    </div>
    <div class="retornoSen"></div>
    <form  name="formRedSenha" id="formRedSenha" action="<?php echo DIRPAGE.'controllers/controllerConfirmacaoSenha';?>" method="post">
        <div class="cadastro float center">
            <input class="float w100 h40" type="hidden" id="email" name="email" value="<?php echo \Traits\TraitParseUrl::parseUrl(1); ?>" required>
            <input class="float w100 h40" type="hidden" id="token" name="token"  value="<?php echo \Traits\TraitParseUrl::parseUrl(2); ?>" required>
            <input class="float w100 h40" type="password" id="senha" name="senha" placeholder="Senha:" required>
            <input class="float w100 h40" type="password" id="senhaConf" name="senhaConf" placeholder="Confirmação de Senha:" required>
            <input class="inlineBlock h40" type="submit" value="Cadastrar Nova Senha">            
        
        </div>
    </form>

<?php \Classes\ClassLayout::setFooter();?>