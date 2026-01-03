<?php
$validate=new Classes\ClassValidate();
$validate->validateFields($_POST);
$validate->validateEmail($email);
$validate->validateData($dataNascimento);
if($validate->validateIssetEmail($email,"senha")){
    $validate->validateDataNascimento($dataNascimento,$email);    
}
echo $validate->validateFinalSen($arrVar);
