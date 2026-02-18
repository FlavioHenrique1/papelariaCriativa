<?php \Classes\ClassLayout::setHeader('Login','Entre com seu usuário e senha',"","login.css");?>
    
<div class="container">

    <div class="login-box">
        <img src="<?php echo DIRIMG.'Logo-removebg-preview.png';?>" alt="Arte no Papel Alto do Sol" class="logo">
        <div class="resultadoForm float w100 center"></div>

        <form name="formLogin" id="formLogin" method="post">

            <input type="email" 
                   placeholder="Email" 
                   name="email" 
                   id="email" 
                   value="<?php echo $_COOKIE['lembrar_email'] ?? ''; ?>" 
                   required>

            <input type="password" 
                   placeholder="Senha" 
                   name="senha" 
                   id="senha" 
                   required>

            <!-- Lembrar dados -->
            <div class="remember">
                <label>
                    <input type="checkbox" name="lembrar" value="1"
                           <?php echo isset($_COOKIE['lembrar_email']) ? 'checked' : ''; ?>>
                    Lembrar meus dados
                </label>
            </div>

            <div class="actions">
                <button type="submit" class="btn-login">Entrar</button>
            </div>

            <div class="links">
                <a href="<?php echo DIRPAGE.'esqueci-minha-senha';?>">
                    Esqueci minha senha
                </a>
            </div>

            <div class="register-link">
                Não tem cadastro? 
                <a href="<?php echo DIRPAGE.'cadastro';?>">
                    Cadastre-se
                </a>
            </div>

        </form>

    </div>

</div>

<?php \Classes\ClassLayout::setFooter('app.js');?>
