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
          <input type="hidden" name="idFornecedor" value="<?= $update ? $this->input->get('idFornecedor') : '' ?>">
          <div class="mb-3">
            <label class="form-label">Razão Social</label>
            <input type="text" class="form-control" name="razaoSocial" value="<?= $update ? $fornecedor->RazaoSocial : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Nome Fantasia</label>
            <input type="text" class="form-control" name="nomeFantasia" value="<?= $update ? $fornecedor->RazaoSocial : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">CNPJ</label>
            <input type="text" class="form-control" name="cnpj" value="<?= $update ? $fornecedor->CNPJ : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Nome Responsável</label>
            <input type="text" class="form-control" name="nomeResponsavel" value="<?= $update ? $fornecedor->NomeResponsavel : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" value="<?= $update ? $fornecedor->Email : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" class="form-control" name="telefone" value="<?= $update ? $fornecedor->Telefone : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">CEP</label>
            <input type="text" class="form-control" name="cep" value="<?= $update ? $fornecedor->CEP : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" class="form-control" name="endereco" value="<?= $update ? $fornecedor->Endereco : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Número</label>
            <input type="text" class="form-control" name="numero" value="<?= $update ? $fornecedor->Numero : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Complemento</label>
            <input type="text" class="form-control" name="complemento" value="<?= $update ? $fornecedor->Complemento : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Bairro</label>
            <input type="text" class="form-control" name="bairro" value="<?= $update ? $fornecedor->Bairro : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label class="form-label">Cidade</label>
            <input type="text" class="form-control" name="cidade" value="<?= $update ? $fornecedor->Bairro : '' ?>" <?= $update && !$fornecedor->Ativo ? 'disabled' : '' ?>>
          </div>
          <div class="mb-3">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado">
              <option value="">Selecione</option>
              <?php foreach ($estados as $sigla => $estado) { ?>
                <option value="<?= $sigla ?>" <?= $update && $fornecedor->Estado == $sigla ? 'selected' : '' ?>><?= $estado ?></option>
              <?php } ?>
            </select>
          </div>
          <?php
          if ($update && $fornecedor->Ativo) {
          ?>
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" role="switch" id="ativo" checked name="ativo" value="1">
              <label class="form-check-label" for="ativo">Ativo</label>
            </div>
          <?php } ?>
          <?php
          if ($fornecedor && $fornecedor->Ativo) {
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