<?php 

$envPath = dirname(__DIR__) . '/.env';
$env = parse_ini_file($envPath);

#Caminhos absolutos
$pastaInterna=$env['APP_FOLDER'];
define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");

(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/')?$barra="":$barra="/";
define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$barra}{$pastaInterna}");

#Atalhos
define('DIRIMG',DIRPAGE.'img/');
define('DIRCSS',DIRPAGE.'lib/css/');
define('DIRJS',DIRPAGE.'lib/js/');
define('DIRCONT',DIRPAGE.'controllers/');

#Acesso ao BD
define('HOST',$env['DB_HOST']);
define('BD',$env['DB_NAME']);
define('USER',$env['DB_USER']);
define('PASS',$env['DB_PASS']);

include(DIRREQ."ignore/dadosUser.php");
#Informações do servidor de email
define("HOSTMAIL",$env['MAIL_HOST']);
define("USERMAIL",$env['MAIL_USER']);
define("PASSMAIL",$env['MAIL_PASS']);


#Outras Informações
define("DOMAIN",$_SERVER["HTTP_HOST"]."/".$pastaInterna);
