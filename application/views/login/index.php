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
  <link rel="stylesheet" href="<?= base_url() ?>vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>css/vendors/simplebar.css">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.min.css" rel="stylesheet">
  <!-- Main styles for this application-->
  <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/examples.css" rel="stylesheet">
</head>

<body>
  <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-medium-emphasis">Acesse sua conta</p>
                <form id="login">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                  <div class="input-group mb-3"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg></span>
                    <input class="form-control" type="text" placeholder="E-mail" name="email">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                      </svg></span>
                    <input class="form-control" type="password" placeholder="Senha" name="senha">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card col-md-5 text-white bg-primary py-5">
            <div class="card-body text-center">
              <div>
                <h2>Criar conta</h2>
                <a href="<?= base_url() ?>login/register">
                  <button class="btn btn-lg btn-outline-light mt-3" type="button">Criar</button>
                </a>
              </div>
            </div>
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
  <script src="<?= base_url('assets/') ?>js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.19.0/dist/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="<?= base_url() ?>vendors/simplebar/js/simplebar.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/login.js"></script>
  <script>
  </script>

</body>

</html>