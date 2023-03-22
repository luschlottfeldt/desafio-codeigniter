<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<!-- Breadcrumb-->
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Desafio</title>
  <!-- Vendors styles-->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>/vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="<?= base_url('assets') ?>/css/style.css" rel="stylesheet">
</head>

<body>
  <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="<?= base_url() ?>assets/brand/coreui.svg#full"></use>
      </svg>
      <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="<?= base_url() ?>assets/brand/coreui.svg#signet"></use>
      </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-user"></use>
          </svg> Usuários</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>usuarios"><span class="nav-icon"></span> Cadastrar</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>usuarios/gerenciar"><span class="nav-icon"></span> Gerenciar</a></li>
        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-truck"></use>
          </svg> Fornecedores</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>fornecedores"><span class="nav-icon"></span> Cadastrar</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>fornecedores/gerenciar"><span class="nav-icon"></span> Gerenciar</a></li>
        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-list"></use>
          </svg> Produtos</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>produtos"><span class="nav-icon"></span> Cadastrar</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>produtos/gerenciar"><span class="nav-icon"></span> Gerenciar</a></li>
        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-cart"></use>
          </svg> Pedidos</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>pedidos"><span class="nav-icon"></span> Cadastrar</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>pedidos/gerenciar"><span class="nav-icon"></span> Gerenciar</a></li>
        </ul>
      </li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-list"></use>
          </svg> Web Service</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>webservice"><span class="nav-icon"></span> Cadastrar Token</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>webservice/gerenciar"><span class="nav-icon"></span> Gerenciar</a></li>
        </ul>
      </li>
  </div>
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
      <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
          <svg class="icon icon-lg">
            <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button><a class="header-brand d-md-none" href="#">
          <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="<?= base_url() ?>assets/brand/coreui.svg#full"></use>
          </svg></a>
        <ul class="header-nav ms-3">
          <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-md">
                <svg class="icon icon-lg">
                  <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
              <a href="<?= base_url('login/logout') ?>">
                <svg class="icon me-2">
                  <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                </svg> Sair</a>
              </a>
            </div>
          </li>
        </ul>
      </div>
      <div class="header-divider"></div>