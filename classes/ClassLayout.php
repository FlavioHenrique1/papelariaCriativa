<?php
namespace Classes;

class ClassLayout{

    public static function setHeadRestrito($permition)
    {
        $session=new ClassSessions();
        $session->verifyInsideSession($permition);
    }

    #Setar as tags do head
    public static function setHeader($title,$description, $author='Flávio',$cssPage=null)
    {

        $html="<!DOCTYPE html>\n";
        $html.="<html lang='pt-br'>\n";
        $html.="<head>\n";
        $html.="    <meta charset='UTF-8'>\n";
        $html.="    <meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
        $html.="    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
        $html.="    <meta name='author' content='$author'>\n";
        $html.="    <meta name='format-detection' content='telephone=no'>\n";
        $html.="    <meta name='description' content='$description'>\n";
        $html.="    <title>$title</title>\n";
        #FAVICON
        $html.="<link rel='stylesheet' href='".DIRCSS."bootstrap.min.css'>\n";
        $html.="<link rel='stylesheet' href='".DIRCSS."style.css'>\n";
        if($cssPage){
            $html.="<link rel='stylesheet' href='".DIRCSS.$cssPage."'>\n";
        }
        $html.="</head>\n\n";
        $html.="<body>\n";
        echo $html;

    }
    
    # Setar as tags do footer
    public static function setFooter($jsPage = null)
    {
        $html  = "";

        /* =========================
        LIBS BASE
        ========================== */
        $html .= "<script src='" . DIRJS . "bootstrap.bundle.min.js'></script>\n";
        $html .= "<script src='" . DIRJS . "vanilla-masker.min.js'></script>\n";

        /* =========================
        CORE DO SISTEMA
        ========================== */
        $html .= "<script src='" . DIRJS . "core/http.js'></script>\n";
        $html .= "<script src='" . DIRJS . "core/form.js'></script>\n";
        $html .= "<script src='" . DIRJS . "core/ui.js'></script>\n";

        /* =========================
        JS GLOBAL DO SISTEMA
        ========================== */
        $html .= "<script src='" . DIRJS . "app.js'></script>\n";

        /* =========================
        JS ESPECÍFICO DA PÁGINA
        ========================== */
        if ($jsPage) {
            $html .= "<script src='" . DIRJS . $jsPage . "'></script>\n";
        }

        /* =========================
        FECHAMENTO HTML
        ========================== */
        $html .= "</body>\n";
        $html .= "</html>";

        echo $html;
    }


        #Setar as tags do footer
        public static function setNav()
        {
            @session_start();
            $nome= $_SESSION["name"];
            $html="<nav class='navbar navbar-expand-md navbar-dark fixed-top bg-dark'>
                <div class='container-fluid'>
                    <a class='navbar-brand' href='#'>Fixed navbar</a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarCollapse' aria-controls='navbarCollapse' aria-expanded='false' aria-label='Toggle navigation'>
                        <span class='navbar-toggler-icon'></span>
                    </button>
                    <div class='collapse navbar-collapse' id='navbarCollapse'>
                        <ul class='navbar-nav me-auto mb-2 mb-md-0'>
                            <li class='nav-item'>
                                <a class='nav-link active' aria-current='page' href='".DIRPAGE."atividades'>Home</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link active' aria-current='page' href='#'>Calendário</a>
                            </li>
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    Opções
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a class='dropdown-item' id='btnAtvRot' href='".DIRCONT."controllerAtvRot'>Adc. Atividade</a></li>
                                    <li><a class='dropdown-item' href='#'>Another action</a></li>
                                    <li><hr class='dropdown-divider'></li>
                                    <li><a class='dropdown-item' href='#'>Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class='navbar-nav me-4 mb-2 mb-md-0'>
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    {$nome}
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a class='dropdown-item' href='#'>Action</a></li>
                                    <li><a class='dropdown-item' href='#'>Another action</a></li>
                                    <li><hr class='dropdown-divider'></li>
                                    <li><a class='dropdown-item' href='".DIRCONT."controllerLogout'>Sair</a></li>
                                </ul>
                            </li>
                            <div class='img_user'>
                                <img src='".DIRIMG."logoExemplo.jpg' class='rounded-circle user_img'>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>";
            echo $html;
        }
    


}