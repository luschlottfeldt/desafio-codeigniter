<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PedidosProdutosModel extends CI_Model
{
  private $idPedido;
  private $idProduto;
  private $quantidade;
  private $subtotal;

  public function setIdPedido($idPedido)
  {
    $this->idPedido = $idPedido;
  }

  public function setIdProduto($idProduto)
  {
    $this->idProduto = $idProduto;
  }

  public function setQuantidade($quantidade)
  {
    $this->quantidade = $quantidade;
  }

  public function setSubtotal($subtotal)
  {
    $this->subtotal = $subtotal;
  }

  public function register()
  {
    $insertData = array(
      'IdPedido' => $this->idPedido,
      'IdProduto' => $this->idProduto,
      'Quantidade' => $this->quantidade,
      'Subtotal' => $this->subtotal
    );

    if ($this->db->insert('PedidosProdutos', $insertData)) {
      return $this->db->insert_id();
    }

    return false;
  }

  public function update()
  {
    $updateData = array(
      'IdPedido' => $this->idPedido,
      'IdProduto' => $this->idProduto,
      'Quantidade' => $this->quantidade,
      'Subtotal' => $this->subtotal
    );

    $where = array(
      'IdPedido' => $this->idPedido,
      'IdProduto' => $this->idProduto,
    );

    $this->db->where($where);

    if ($this->db->update('PedidosProdutos', $updateData)) {
      return true;
    }

    return false;
  }

  public function delete()
  {
    $where = array(
      'IdPedido' => $this->idPedido,
      'IdProduto' => $this->idProduto,
    );

    $this->db->where($where);
    if ($this->db->delete('PedidosProdutos')) {
      return true;
    }

    return false;
  }

  public function getPedidosProdutosByIdPedido()
  {
    $sql = "SELECT * FROM PedidosProdutos WHERE IdPedido = ?";

    $query = $this->db->query($sql, array($this->idPedido));

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getPedidoProduto()
  {
    $sql = "SELECT * FROM PedidosProdutos WHERE IdPedido = ? AND IdProduto = ?";

    $query = $this->db->query($sql, array($this->idPedido, $this->idProduto));

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getPedidoProdutosWithInfo()
  {
    $sql = "
      SELECT 
        Quantidade,
          Subtotal,
          Nome,
          CodigoDeBarras,
          Descricao,
          Valor
      FROM 
        PedidosProdutos PP
      INNER JOIN
        Produtos P
      ON
        PP.IdProduto = P.IdProduto
      WHERE 
        PP.IdPedido = ?
    ";

    $query = $this->db->query($sql, array($this->idPedido));

    if ($query) {
      return $query->result();
    }

    return false;
  }
}
