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
        <?= $update ? 'Atualizar' : 'Cadastrar' ?>
      </li>
    </ol>
  </nav>
</div>
</header>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="card mb-4">
      <div class="card-header">
        <?= $update ? 'Atualizar' : 'Cadastrar' ?> Fornecedor
      </div>
      <div class="card-body">
        <form id="<?= $update ? 'atualizar' : 'cadastrar' ?>">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
          <input type="hidden" name="idProduto" value="<?= $update ? $this->input->get('idProduto') : '' ?>">
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?= $update ? $produto->Nome : '' ?>" <?= $update && !$produto->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Código de Barras</label>
            <input type="text" class="form-control" name="codigoDeBarras" value="<?= $update ? $produto->CodigoDeBarras : '' ?>" <?= $update && !$produto->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" rows="3" <?= $update && !$produto->Ativo ? 'disabled' : '' ?>><?= $update ? $produto->Descricao : '' ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Valor (R$)</label>
            <input type="text" class="form-control" name="valor" value="<?= $update ? $produto->Valor : '' ?>" <?= $update && !$produto->Ativo ? 'disabled' : '' ?>>
          </div>
          <?php
          if ($update && $produto->Ativo) {
          ?>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="ativo" checked name="ativo" value="1">
              <label class="form-check-label" for="ativo">Ativo</label>
            </div>
          <?php } ?>
          <?php
          if ($produto && $produto->Ativo) {
          ?>
            <div class="mb-3">
              <button class="btn btn-primary px-4" type="submit"><?= $update ? 'Atualizar' : 'Cadastrar' ?></button>
            </div>
          <?php } elseif (!$update) { ?>
            <div class="mb-3">
              <button class="btn btn-primary px-4" type="submit"><?= $update ? 'Atualizar' : 'Cadastrar' ?></button>
            </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>