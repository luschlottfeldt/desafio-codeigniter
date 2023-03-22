<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CoreUI Free Bootstrap Admin Template</title>
  <!-- Vendors styles-->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/examples.css" rel="stylesheet">
</head>

<body>
  <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mb-4 mx-4">
            <div class="card-body p-4">
              <h1>Register</h1>
              <p class="text-medium-emphasis">Crie sua conta</p>
              <form id="register">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-user"></use>

                    </svg></span>
                  <input class="form-control" type="text" placeholder="Nome" name="nome">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                    </svg></span>
                  <input class="form-control" type="text" placeholder="Email" name="email">
                </div>
                <div class="input-group mb-3"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                    </svg></span>
                  <input class="form-control" type="password" placeholder="Senha" name="senha">
                </div>
                <div class="input-group mb-4"><span class="input-group-text">
                    <svg class="icon">
                      <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                    </svg></span>
                  <input class="form-control" type="password" placeholder="Repita a senha" name="senha2">
                </div>
                <button class="btn btn-block btn-success" type="submit">Criar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="<?= base_url('assets/') ?>js/mask.js"></script>
  <script src="<?= base_url('assets/') ?>js/validate.js"></script>
  <script src="<?= base_url() ?>vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="<?= base_url() ?>vendors/simplebar/js/simplebar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/main.js"></script>
  <script src="<?= base_url('assets/') ?>js/register.js"></script>
  <script>
  </script>

</body>

</html>