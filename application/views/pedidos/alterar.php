<style>
  button {
    background: none;
    border: none;
  }
</style>
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item">
        Pedidos
      </li>
      <li class="breadcrumb-item">
        Alterar
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
          <th>Código de Barras</th>
          <th>Valor</th>
          <th>Quantidade</th>
          <th>Alterar Pedido</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($produtos as $produto) {
        ?>
          <tr>
            <form class="alterarProdutos">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
              <input type="hidden" name="idProduto" value="<?= $produto->IdProduto ?>">
              <input type="hidden" name="idPedido" value="<?= $pedido->IdPedido ?>">
              <input type="hidden" name="valorUnitario" value="<?= $produto->Valor ?>">
              <td><?= $produto->Nome ?></td>
              <td><?= $produto->CodigoDeBarras ?></td>
              <td>R$ <?= $produto->Valor ?></td>
              <td>
                <input type="number" min='0' class="form-control" name="quantidade" value="<?= isset($items[$produto->IdProduto]) ? $items[$produto->IdProduto]['quantidade'] : 0 ?>" />
              </td>
              <td>
                <button type="submit">
                  <svg class="nav-icon" style="width: 20px; height: 20px">
                    <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-cart"></use>
                  </svg>
                  </a>
              </td>
          </tr>
          </form>
        <?php } ?>
        <form id="alterar">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
          <input type="hidden" name="idPedido" value="<?= $pedido->IdPedido ?>">
          <tr>
            <td colspan="5">
              <select class="form-control" name="fornecedor">
                <option value="">Selecione o fornecedor</option>
                <?php foreach ($fornecedores as $fornecedor) { ?>
                  <option value="<?= $fornecedor->IdFornecedor ?>" <?= $pedido->IdFornecedor === $fornecedor->IdFornecedor ? 'selected' : '' ?>><?= $fornecedor->NomeFantasia ?></option>
                <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <label class="form-label">Observações</label>
              <textarea class="form-control" name="observacoes" rows="3"><?= $pedido->Observacoes ?></textarea>
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <button class="btn btn-primary px-4" type="submit" id="alterarPedido">Alterar Pedido</button>
              <button class="btn btn-primary px-4" type="button" id="finalizarPedido" data-id='<?= $pedido->IdPedido ?>'>Finalizar Pedido</button>
            </td>
          </tr>
        </form>
      </tbody>
    </table>

  </div>
</div>