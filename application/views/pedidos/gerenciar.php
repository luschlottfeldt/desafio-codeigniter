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
          <th>Id Pedido</th>
          <th>Valor Total</th>
          <th>Quantidade de Itens</th>
          <th>Status</th>
          <th>Data de criação</th>
          <th>Editar</th>
          <th>Deletar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($pedidos as $pedido) {
        ?>
          <tr>
            <td><?= $pedido->IdPedido ?></td>
            <td><?= $pedido->Total ?></td>
            <td><?= $pedido->TotalItens ?></td>
            <td><?= $pedido->Status == 1 ? 'Ativo' : 'Finalizado' ?></td>
            <td><?= date('d/m/Y H:i:s', strtotime($pedido->DataCriacao)) ?></td>
            <td>
              <?php if ($pedido->Status != 2) { ?>
                <a href="<?= base_url() ?>pedidos/alterar?idPedido=<?= $pedido->IdPedido ?>">
                  <svg class="nav-icon" style="width: 20px; height: 20px">
                    <use xlink:href="<?= base_url() ?>vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                  </svg>
                </a>
              <?php } ?>
            </td>
            <td>
              <a href="<?= base_url() ?>/pedidos/delete?idPedido=<?= $pedido->IdPedido ?>">
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