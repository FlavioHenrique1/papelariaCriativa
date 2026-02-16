<?php \Classes\ClassLayout::setHeader('Login','Entre com seu usuário e senha',"","login.css");?>
    
    <div class="container">

        <div class="login-box">
            <img src="<?php echo DIRIMG.'Logo-removebg-preview.png';?>" alt="Arte no Papel Alto do Sol" class="logo">
            <div class="resultadoForm float w100 center"></div>

            <form name="formLogin" id="formLogin" action="<?php #echo DIRCONT.'controllerLogin';?>" method="post">
                <input type="email" placeholder="Email" name="email" id="email" required>
                <input type="password" placeholder="Senha" name="senha" id="senha" required>

                <div class="actions">
                    <button type="submit">Entrar</button>
                    <a href="<?php echo DIRPAGE.'esqueci-minha-senha';?>">Esqueci minha senha</a>
                </div>
            </form>

        </div>

    </div>

<?php \Classes\ClassLayout::setFooter('app.js');?>