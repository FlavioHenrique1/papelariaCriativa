<?php 
#Caminhos absolutos
$pastaInterna="papelariaCriativa/";
define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");

(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/')?$barra="":$barra="/";
define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$barra}{$pastaInterna}");

#Atalhos
define('DIRIMG',DIRPAGE.'img/');
define('DIRCSS',DIRPAGE.'lib/css/');
define('DIRJS',DIRPAGE.'lib/js/');
define('DIRCONT',DIRPAGE.'controllers/');

#Acesso ao BD
define('HOST',"localhost");
define('BD',"papelariacriativa");
define('USER',"root");
define('PASS',"");

include(DIRREQ."ignore/dadosUser.php");
#Informações do servidor de email
define("HOSTMAIL","smtp.office365.com");
define("USERMAIL",$emailUser);
define("PASSMAIL",$senhaUser);


#Outras Informações
define("DOMAIN",$_SERVER["HTTP_HOST"]."/".$pastaInterna);
