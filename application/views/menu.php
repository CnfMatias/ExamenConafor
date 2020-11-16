<?Php
//$url = $_SERVER['PHP_SELF'];
$url = $_SERVER['REQUEST_URI'];

$titulo_m = '';
$descri_m = '';
$fa_icon = '';

$m_superior_admin = '';
$m_superior_oper = '';
$m_superior_alma = '';
$m_superior_nomi = '';
$m_superior_finan = '';

$configuraciones_m = '';
$perfiles_m = '';
$empleados_m = '';
$usuarios_m = '';
$tecnicos_m = '';
$polizas_m = '';
$proveedores_m = '';
$clientes_m = '';
$prollos_m = '';
$corte_m = '';
$maquila_m = '';
$checador_m = '';
$pagos_m = '';
$prestamos_m = '';
$materiaprima_m = '';
$compras_m = '';
$ventas_m = '';
$caja_chica_m = '';
$accesos_m = '';

$vacia_m = '';

$presupuesto_m = '';


switch (true) {
        ///////////////// Administracion //////
    case strpos($url, 'configuraciones') !== false:
        $configuraciones_m = 'active';
        $fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Configuraciones';
        $descri_m = 'Módulo para la configuración del Sistema Olimpoos';
        $m_superior_admin = 'active open';
        break;
    case strpos($url, 'presupuesto') !== false:
        $presupuesto_m = 'active';
        $fa_icon = 'fa fa-archive';
        $titulo_m = 'Administración / presupuesto';
        $descri_m = 'Presupuesto de lavadoras';
        $m_superior_admin = 'active open';
        break;
    case strpos($url, 'perfiles') !== false:
        $perfiles_m = 'active';
        $fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Perfiles';
        $descri_m = 'Módulo para la administración de perfiles de usuarios';
        $m_superior_admin = 'active open';
        break;
    case strpos($url, 'empleados') !== false:
        $empleados_m = 'active';
        $fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Empleados';
        $descri_m = 'Módulo para la creación y administración de empleados';
        $m_superior_admin = 'active open';
        break;
    case strpos($url, 'tecnicos') !== false:
		$tecnicos_m = 'active';
		$fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Técnicos';
        $descri_m = 'Módulo para la creación y administración de técnicos';
        $m_superior_admin = 'active open';
    break;
    case strpos($url, 'polizas') !== false:
		$polizas_m = 'active';
		$fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Polizas';
        $descri_m = 'Módulo para la creación y administración de polizas';
        $m_superior_admin = 'active open';
    break;
    case strpos($url, 'clientes') !== false:
		$clientes_m = 'active';
		$fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Clientes';
        $descri_m = 'Módulo para la creación y administración de clientes';
        $m_superior_admin = 'active open';
    break;
    case strpos($url, 'usuarios') !== false:
		$usuarios_m = 'active';
		$fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / Usuarios';
        $descri_m = 'Módulo para la creación y administración de usuarios';
        $m_superior_admin = 'active open';
    break;
    /* case strpos($url, 'acionnes') !== false:
		$accesos_m = 'active';
		$fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración / accesos';
        $descri_m = 'Módulo para la creación y administración de accesos';
        $m_superior_admin = 'active open';
    break; */
    case strpos($url, 'reloj') !== false:
		$checador_m = 'active';
		$fa_icon = 'fal fa-cogs';
        $titulo_m = 'Administración - Reloj Checador';
        $descri_m = 'Módulo para la revisión del Reloj Checador';
        $m_superior_admin = 'active open';
    break;
    /////////////// Produccion //////////////
    case strpos($url, 'rollos') !== false:
		$prollos_m = 'active';
		$fa_icon = 'fal fa-puzzle-piece';
        $titulo_m = 'Producción / Producción de Rollos';
        $descri_m = 'Módulo para la administración en la producción de rollos';
        $m_superior_oper = 'active open';
    break;
    case strpos($url, 'maquila') !== false:
		$maquila_m = 'active';
		$fa_icon = 'fal fa-puzzle-piece';
        $titulo_m = 'Producción / Recepcion de Maquila';
        $descri_m = 'Módulo para la recepción de piezas provenientes de un corte';
        $m_superior_oper = 'active open';
    break;
    case strpos($url, 'corte') !== false:
		$corte_m = 'active';
		$fa_icon = 'fal fa-puzzle-piece';
        $titulo_m = 'Producción / Programación de Cortes';
        $descri_m = 'Módulo para la creación y administración en la producción de piezas';
        $m_superior_oper = 'active open';
    break;
    ///////////////// Almacen //////////////
    case strpos($url, 'insumos') !== false:
		$materiaprima_m = 'active';
		$fa_icon = 'fa fa-box';
        $titulo_m = 'Materia Prima e Insumos';
        $descri_m = 'Módulo para el registro de Materia prima o Insumos';
        $m_superior_alma = 'active open';
    break;
    ///////////////////////////////////////
    case strpos($url, 'pagos') !== false:
		$pagos_m = 'active';
		$fa_icon = 'fa fa-coins';
        $titulo_m = 'Pago a Empleados';
        $descri_m = 'Módulo para definición y pago de nomina a empleados';
        $m_superior_nomi = 'active open';
    break;
    case strpos($url, 'prestamos') !== false:
		$prestamos_m = 'active';
		$fa_icon = 'fa fa-coins';
        $titulo_m = 'Prestamos';
        $descri_m = 'Módulo para el registro de prestamos a empleados';
        $m_superior_nomi = 'active open';
    break;
    ///////////////////////////////////////
    case strpos($url, 'compras') !== false:
		$compras_m = 'active';
		$fa_icon = 'fal fa-euro-sign';
        $titulo_m = 'Compras';
        $descri_m = 'Módulo para el registro de compras a proveedores';
        $m_superior_finan = 'active open';
    break;
    case strpos($url, 'ventas') !== false:
		$ventas_m = 'active';
		$fa_icon = 'fal fa-euro-sign';
        $titulo_m = 'Ventas';
        $descri_m = 'Módulo para el registro de ventas a clientes';
        $m_superior_finan = 'active open';
    break;
    case strpos($url, 'caja') !== false:
		$caja_chica_m = 'active';
		$fa_icon = 'fal fa-euro-sign';
        $titulo_m = 'Caja Chica';
        $descri_m = 'Módulo para el registro de todos los movimientos que surjan de caja chica';
        $m_superior_finan = 'active open';
	break;
	default:
	break;
}

    $menu = '
    <li class="nav-title">Menú</li>
    <li class="'.$m_superior_admin.'">
        <a href="#"><i class="fal fa-cogs m-r-10"></i><span class="nav-link-text"> Administración</span></a>
        <ul>
            <li class="'.$configuraciones_m.'">
                <a href="'.base_url().'configuraciones" title="Configuraciones" data-filter-tags="configuraciones">
                    <span class="nav-link-text">Configuraciones </span>
                </a>
            </li> 
            <li class="'.$empleados_m.'">
                <a href="'.base_url().'empleados" title="Empleados" data-filter-tags="empleados">
                    <span class="nav-link-text">Empleados</span>
                </a>
            </li>
            <li class="'.$usuarios_m.'">
                <a href="'.base_url().'usuarios" title="Usuarios" data-filter-tags="usuarios">
                    <span class="nav-link-text">Usuarios</span>
                </a>
            </li>
            <li class="'.$clientes_m.'">
                <a href="'.base_url().'clientes" title="Clientes" data-filter-tags="clientes">
                    <span class="nav-link-text">Clientes</span>
                </a>
            </li> 
            <li class="'.$polizas_m.'">
                <a href="'.base_url().'polizas" title="Polizas" data-filter-tags="polizas">
                    <span class="nav-link-text">Polizas</span>
                </a>
            </li>
            <li class="'.$accesos_m.'">
                <a href="'.base_url().'accesos" title="Accesos" data-filter-tags="Accesos">
                    <span class="nav-link-text">Accesos</span>
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
<div class="nav-footer shadow-top">
    <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
        <i class="ni ni-chevron-right"></i>
        <i class="ni ni-chevron-right"></i>
    </a>
    <ul class="list-table m-auto nav-footer-buttons">
        <li>
            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat">
                <i class="fal fa-comments"></i>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Llamadas">
                <i class="fal fa-phone"></i>
            </a>
        </li>
    </ul>
</div>
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

                    