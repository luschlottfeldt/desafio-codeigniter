<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item">
        Produtos
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
          <th>Valor</th>
          <th>Ativo</th>
          <th>Data de criação</th>
          <th>Editar</th>
          <th>Deletar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($produtos as $produto) {
        ?>
          <tr>
            <td><?= $produto->Nome ?></td>
            <td>R$ <?= $produto->Valor ?></td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="ativo" <?= $produto->Ativo ? 'checked' : '' ?> name="ativo" value="<?= $produto->IdProduto ?>">
              </div>
            </td>
            <td><?= date('d/m/Y H:i:s', strtotime($produto->DataCriacao)) ?></td>
            <td>
              <a href="<?= base_url() ?>/produtos?idProduto=<?= $produto->IdProduto ?>">
                <svg class="nav-icon" style="width: 20px; height: 20px">
                  <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                </svg>
              </a>
            </td>
            <td>
              <a href="<?= base_url() ?>/produtos/delete?idProduto=<?= $produto->IdProduto ?>">
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