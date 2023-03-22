<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item">
        Usuários
      </li>
      <li class="breadcrumb-item">
        Gerenciar
      </li>
    </ol>
  </nav>
</div>
</header>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <table class="table table-striped table-hover" style="text-align: center">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Ativo</th>
          <th>Data de criação</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($usuarios as $usuario) {
        ?>
          <tr>
            <td><?= $usuario->Nome ?></td>
            <td><?= $usuario->Email ?></td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="ativo" <?= $usuario->Ativo ? 'checked' : '' ?> name="ativo" value="<?= $usuario->IdUsuario ?>">
              </div>
            </td>
            <td><?= date('d/m/Y H:i:s', strtotime($usuario->DataCriacao)) ?></td>
            <td>
              <a href="<?= base_url() ?>/usuarios?idUsuario=<?= $usuario->IdUsuario ?>">
                <svg class="nav-icon" style="width: 20px; height: 20px">
                  <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                </svg>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
</div>