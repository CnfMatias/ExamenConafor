<?Php

$url = $_SERVER['REQUEST_URI'];

$titulo_m = '';
$descri_m = '';
$fa_icon = '';

$m_superior_admin = '';


$configuraciones_m = '';
$empleados_m = '';


switch (true) {
        ///////////////// Administracion //////
    case strpos($url, 'configuraciones') !== false:
        $configuraciones_m = 'active';
        $fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Catalogos';
        $descri_m = 'Módulo para la configuracion de los catalogos';
        $m_superior_admin = 'active open';
        break;
    case strpos($url, 'empleados') !== false:
        $empleados_m = 'active';
        $fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Empleados';
        $descri_m = 'Módulo para la creación y administración de empleados';
        $m_superior_admin = 'active open';
        break;
    
}

    $menu = '
    <li class="nav-title">Menú</li>
    <li class="'.$m_superior_admin.'">
        <a href="#"><i class="fal fa-cogs m-r-10"></i><span class="nav-link-text"> Administración</span></a>
        <ul>
            <li class="'.$configuraciones_m.'">
                <a href="'.base_url().'configuraciones" title="Catalogos" data-filter-tags="configuraciones">
                    <span class="nav-link-text">Catalogos </span>
                </a>
            </li>  
            <li class="'.$empleados_m.'">
                <a href="'.base_url().'empleados" title="Empleados" data-filter-tags="empleados">
                    <span class="nav-link-text">Empleados</span>
                </a>
            </li>
        </ul>
    </li>';
?>
    <ul id="js-nav-menu" class="nav-menu">
        <?=$menu?>
    </ul>
    <div class="filter-message js-filter-message bg-success-600"></div>
</nav>
</aside>
<div class="page-content-wrapper">
<header class="page-header" role="banner">
    <?=$logo?>
    <?=$boton_menu?>
    <?=$ajustes_perfil?>
</header>
<main id="js-page-content" role="main" class="page-content">
<div class="subheader"><h1 class="subheader-title">
    <i class="<?=$fa_icon?> m-r-10"></i><?=$titulo_m?><small><?=$descri_m?></small>
</h1>
</div>

                    