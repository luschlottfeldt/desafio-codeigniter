<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item">
        Webservice
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
          <th>Token</th>
          <th>Ativo</th>
          <th>Data de criação</th>
          <th>Deletar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($tokens as $token) {
        ?>
          <tr>
            <td><?= $token->Token ?></td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="ativo" <?= $token->Ativo ? 'checked' : '' ?> name="ativo" value="<?= $token->IdToken ?>">
              </div>
            </td>
            <td><?= date('d/m/Y H:i:s', strtotime($token->DataCriacao)) ?></td>
            <td>
              <a href="<?= base_url() ?>/webservice/delete?idToken=<?= $token->IdToken ?>">
                <svg class="nav-icon" style="width: 20px; height: 20px">
                  <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-delete"></use>
                </svg>
              </a>
            </td>
          </tr>
        <?php } ?>
        <tr>
          <td colspan="4">
            <p>Utilize o endpoint `<?= base_url('webservice/getPedidos') ?>` no método -POST utilizando o bearer token criado para visualizar os pedidos realizados.</p>
          </td>
        </tr>
      </tbody>
    </table>

  </div>
</div>