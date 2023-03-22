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
        Cadastrar Token
      </li>
    </ol>
  </nav>
</div>
</header>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="card mb-4">
      <div class="card-header">
        Cadastrar Token
      </div>
      <div class="card-body">
        <form id="cadastrar">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
          <div class="mb-3">
            <button class="btn btn-primary px-4" type="submit">Gerar Token</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>