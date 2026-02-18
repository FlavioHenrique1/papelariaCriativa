<?php \Classes\ClassLayout::setHeader('Esqueci minha senha','Recupere sua senha.',"","login.css");?>

<div class="container">

    <div class="login-box">

        <img src="<?php echo DIRIMG.'Logo-removebg-preview.png';?>" 
             alt="Arte no Papel Alto do Sol" 
             class="logo">

        <h3 class="title">Recuperar Senha</h3>

        <div class="retornoSen"></div>

        <form name="formSenha" 
              id="formSenha" 
              action="<?php echo DIRPAGE.'controllers/controllerSenha';?>" 
              method="post">

            <input type="email" 
                   name="email" 
                   placeholder="Seu email" 
                   required>

            <input type="date" 
                   name="dataNascimento" 
                   required>

            <button type="submit" class="btn-login">
                Solicitar recuperação
            </button>

        </form>

        <div class="links">
            <a href="<?php echo DIRPAGE.'login';?>">
                Voltar para login
            </a>
        </div>

    </div>

</div>

<?php \Classes\ClassLayout::setFooter();?>
