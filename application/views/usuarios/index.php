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
        <?= $update ? 'Atualizar' : 'Cadastrar' ?> Usuário
      </div>
      <div class="card-body">
        <form id="<?= $update ? 'atualizar' : 'cadastrar' ?>">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
          <input type="hidden" name="idUsuario" value="<?= $update ? $this->input->get('idUsuario') : '' ?>">
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?= $update ? $usuario->Nome : '' ?>" <?= $update && !$usuario->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" <?= $update ? 'disabled' : '' ?> value="<?= $update ? $usuario->Email : '' ?>" <?= $update && !$usuario->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" class="form-control" name="senha" <?= $update && !$usuario->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Repita a senha</label>
            <input type="password" class="form-control" name="senha2" <?= $update && !$usuario->Ativo ? 'disabled' : '' ?>>
          </div>
          <?php
          if ($update && $usuario->Ativo) {
          ?>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="ativo" checked name="ativo" value="1">
              <label class="form-check-label" for="ativo">Ativo</label>
            </div>
          <?php } ?>
          <?php
          if ($usuario && $usuario->Ativo) {
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