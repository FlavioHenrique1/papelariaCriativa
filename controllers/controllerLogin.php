<?php

$validate=new Classes\ClassValidate();

if(isset($_POST['lembrar'])){

    setcookie(
        'lembrar_email',
        $_POST['email'],
        time() + (86400 * 30), // 30 dias
        "/"
    );

}else{

    setcookie('lembrar_email', '', time() - 3600, "/");
}

$validate->validateFields($_POST);
$validate->validateEmail($email);
$validate->validateIssetEmail($email,"login");
#$validate->validateStrongSenha($senha);
$validate->validateSenha($email,$senha);
// $validate->validateUserActive($email);
$validate->validateAttemptLogin();
echo $validate->validateFinalLogin($email);
