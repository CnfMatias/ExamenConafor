<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Componentes {

	public function logo(){
		return '<div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center" data-toggle="modal" data-target="#modal-shortcut">
            <img src="'.base_url().'frontend/images/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>';
	}

	public function boton_menu(){
		return '<div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>';
	}

	public function ajustes_perfil(){
		return '<div class="ml-auto d-flex">
        <div class="hidden-md-down">
            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                <i class="fal fa-cog"></i>
            </a>
        </div>
        <div>
            <a href="#" data-toggle="dropdown" title="Perfil" class="header-icon d-flex align-items-center justify-content-center ml-2">
                <img src="'.base_url().'frontend/images/avatar-m.png" class="profile-image rounded-circle" alt="User">
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            <img src="'.base_url().'frontend/images/avatar-m.png" class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">NOMBRE DE USUARIO</div>
                            <span class="text-truncate text-truncate-md opacity-80">EMAIL DE USUARIO</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider m-0"></div>
                <a href="#" class="dropdown-item" data-action="app-fullscreen">
                    <span data-i18n="drpdwn.fullscreen">Pantalla Completa</span>
                    <i class="float-right text-muted fw-n">F11</i>
                </a>
                <a href="#" class="dropdown-item" data-action="app-print">
                    <span data-i18n="drpdwn.print">Imprimir</span>
                    <i class="float-right text-muted fw-n">Ctrl + P</i>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item fw-500 pt-3 pb-3 text-center" href="page_login-alt.html">
                    <span data-i18n="drpdwn.page-logout">Salir</span>
                </a>
            </div>
        </div>
    </div>';
	}

}
