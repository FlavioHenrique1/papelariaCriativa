<?php

namespace Classes;

class ClassLayout
{

    public static function setHeadRestrito($permition)
    {
        $session = new ClassSessions();
        $session->verifyInsideSession($permition);
    }

    #Setar as tags do head
    public static function setHeader($title, $description, $author = 'Flávio', $cssPage = null)
    {

        $html = "<!DOCTYPE html>\n";
        $html .= "<html lang='pt-br'>\n";
        $html .= "<head>\n";
        $html .= "    <meta charset='UTF-8'>\n";
        $html .= "    <meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
        $html .= "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
        $html .= "    <meta name='author' content='$author'>\n";
        $html .= "    <meta name='format-detection' content='telephone=no'>\n";
        $html .= "    <meta name='description' content='$description'>\n";
        $html .= "    <title>$title</title>\n";

        #FAVICON
        $html .= "<link rel='icon' type='image/x-icon' href='" . DIRIMG . "iconLogo2.ico'>\n";
        $html .= "<link rel='stylesheet' href='" . DIRCSS . "bootstrap.min.css'>\n";
        $html .= "<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css' rel='stylesheet'>\n";
        $html .="<link href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap' rel='stylesheet'/>";
        $html .= "<link rel='stylesheet' href='" . DIRCSS . "style.css'>\n";
        if ($cssPage) {
            $html .= "<link rel='stylesheet' href='" . DIRCSS . $cssPage . "'>\n";
        }
        $html .= "</head>\n\n";
        $html .= "<body>\n";
        echo $html;
    }

    public static function setFooter($jsPage = null, array $cores = [])
    {
        $html = "";

        // libs base (sempre)
        $html .= "<script src='" . DIRJS . "bootstrap.bundle.min.js'></script>\n";
        $html .= "<script src='" . DIRJS . "vanilla-masker.min.js'></script>\n";

        // cores comuns
        $defaultCores = ['http', 'ui','form'];

        $cores = array_unique(array_merge($defaultCores, $cores));

        foreach ($cores as $core) {
            $html .= "<script src='" . DIRJS . "core/{$core}.js'></script>\n";
        }

        // js da página
        if ($jsPage) {
            $html .= "<script src='" . DIRJS . $jsPage . "'></script>\n";
        }

        $html .= "</body></html>";

        echo $html;
    }



public static function setNav(string $paginaAtiva = '')
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $nome = $_SESSION['name'] ?? 'Usuário';
    $permition = $_SESSION['permition'] ?? 'User';


    $active = function ($pagina) use ($paginaAtiva) {
        return $pagina === $paginaAtiva ? 'active' : '';
    };

    echo "
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark shadow-sm'>
        <div class='container-fluid'>

            <!-- Logo -->
            <a class='navbar-brand fw-bold' href='" . DIRPAGE . "'>
                <i class='bi bi-shop'></i> Papelaria
            </a>

            <!-- Botão Mobile -->
            <button class='navbar-toggler' type='button'
                    data-bs-toggle='collapse'
                    data-bs-target='#menuNavbar'>
                <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='menuNavbar'>

                <!-- Menu Principal -->
                <ul class='navbar-nav ms-lg-4 mb-2 mb-lg-0'>

                    <li class='nav-item'>
                        <a class='nav-link {$active('vendas')}' href='" . DIRPAGE . "vendas'>
                            <i class='bi bi-cart-check'></i> Vendas
                        </a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link {$active('insumos')}' href='" . DIRPAGE . "insumos'>
                            <i class='bi bi-box-seam'></i> Insumos
                        </a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link {$active('compras')}' href='" . DIRPAGE . "compras'>
                            <i class='bi bi-bag-plus'></i> Compras
                        </a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link {$active('estoque')}' href='" . DIRPAGE . "estoque'>
                            <i class='bi bi-clipboard-data'></i> Estoque
                        </a>
                    </li>

                    <li class='nav-item'>
                        <a class='nav-link {$active('servicos')}' href='" . DIRPAGE . "servicos'>
                            <i class='bi bi-gear'></i> Serviços
                        </a>
                    </li>

                </ul>

                <!-- Área Direita -->
                <div class='ms-lg-auto d-flex align-items-center gap-4 mt-3 mt-lg-0'>

                    <!-- Sino -->
                    <a href='#' class='text-white position-relative'>
                        <i class='bi bi-bell fs-5'></i>
                        <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger'>
                            3
                        </span>
                    </a>

                    <!-- Engrenagem -->
                    <a href='#' class='text-white'>
                        <i class='bi bi-gear fs-5'></i>
                    </a>

                    <!-- Divisor -->
                    <div class='vr bg-light'></div>

                    <!-- Info + Avatar -->
                    <div class='d-flex align-items-center gap-3'>

<div class='text-end text-white'>
    <div class='fw-semibold small'>{$nome}</div>
    <div class='text-white-50 small'>{$permition}</div>
</div>

                        <div class='rounded-circle overflow-hidden border'
                             style='width:40px; height:40px;'>
                            <img src='https://lh3.googleusercontent.com/aida-public/AB6AXuB5UDJa56RGm1t2y_-jNV6mBfLx2-B2B0KBrxTRgMZZKMfTZVYlWmiiUh_2-3pMbimhKnIoINDvrRjrzly4gDVILpofRa1AUOCHwipa_8hgf5k7wywY6t_08vh9hznWzs1XWvbUst9HlyJF9tYgTTD_MKux4beWpiL5OeCo6ByGkkTBbyeX7LAn3Pdaqjsusyr4x1_xgZmYyFndczURPtc5in3xssVlQ9REECp8tRsN721vHA0tPfR9pUwO8Xil0D_ItfRfOJvpZSMX'
                                 class='w-100 h-100 object-fit-cover'>
                        </div>

                        <div class='text-white'>
                            
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </nav>";
}
}
