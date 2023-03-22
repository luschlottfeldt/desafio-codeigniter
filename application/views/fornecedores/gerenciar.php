<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item">
        Fornecedores
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
          <th>Razão Social</th>
          <th>Nome Fantasia</th>
          <th>CNPJ</th>
          <th>Ativo</th>
          <th>Data de criação</th>
          <th>Editar</th>
          <th>Deletar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($fornecedores as $fornecedor) {
        ?>
          <tr>
            <td><?= $fornecedor->RazaoSocial ?></td>
            <td><?= $fornecedor->NomeFantasia ?></td>
            <td><?= $fornecedor->CNPJ ?></td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="ativo" <?= $fornecedor->Ativo ? 'checked' : '' ?> name="ativo" value="<?= $fornecedor->IdFornecedor ?>">
              </div>
            </td>
            <td><?= date('d/m/Y H:i:s', strtotime($fornecedor->DataCriacao)) ?></td>
            <td>
              <a href="<?= base_url() ?>/fornecedores?idFornecedor=<?= $fornecedor->IdFornecedor ?>">
                <svg class="nav-icon" style="width: 20px; height: 20px">
                  <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                </svg>
              </a>
            </td>
            <td>
              <a href="<?= base_url() ?>/fornecedores/delete?idFornecedor=<?= $fornecedor->IdFornecedor ?>">
                <svg class="nav-icon" style="width: 20px; height: 20px">
                  <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-delete"></use>
                </svg>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
</div>