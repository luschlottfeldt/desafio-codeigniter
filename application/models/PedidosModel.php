<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PedidosModel extends CI_Model
{
  private $idPedido;
  private $idFornecedor;
  private $observacoes;
  private $total;
  private $status;

  public function setIdPedido($idPedido)
  {
    $this->idPedido = $idPedido;
  }

  public function setIdFornecedor($idFornecedor)
  {
    $this->idFornecedor = $idFornecedor;
  }

  public function setObservacoes($observacoes)
  {
    $this->observacoes = $observacoes;
  }

  public function setTotal($total)
  {
    $this->total = $total;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function register()
  {
    $insertData = array(
      'IdFornecedor' => $this->idFornecedor,
      'Observacoes' => $this->observacoes,
      'Total' => $this->total,
      'Status' => STATUS_ATIVO,
    );

    if ($this->db->insert('Pedidos', $insertData)) {
      return $this->db->insert_id();
    }

    return false;
  }

  public function update()
  {
    $updateData = array(
      'IdFornecedor' => $this->idFornecedor,
      'Observacoes' => $this->observacoes,
    );

    $this->db->where('IdPedido', $this->idPedido);

    if ($this->db->update('Pedidos', $updateData)) {
      return true;
    }

    return false;
  }

  public function updateValorTotal()
  {
    $updateData = array(
      'Total' => $this->total,
    );

    $this->db->where('IdPedido', $this->idPedido);

    if ($this->db->update('Pedidos', $updateData)) {
      return true;
    }

    return false;
  }

  public function getPedido()
  {
    $sql = "SELECT * FROM Pedidos WHERE IdPedido = ? AND Deletado = 0";

    $query = $this->db->query($sql, array($this->idPedido));

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getPedidos()
  {
    $sql = "SELECT * FROM Pedidos WHERE Deletado = 0 ORDER BY IdPedido DESC";

    $query = $this->db->query($sql);

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getPedidosListagem()
  {
    $sql = "SELECT 
                IdPedido,
                Total,
                Status,
                DataCriacao,
                (SELECT COUNt(*) FROM PedidosProdutos PP WHERE PP.IdPedido = P.IdPedido) as TotalItens
            FROM
              Pedidos P
            WHERE
              Deletado = 0
            ORDER BY IdPedido DESC";

    $query = $this->db->query($sql);

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function deletePedido()
  {
    $this->db->where('IdPedido', $this->idPedido);

    if ($this->db->update('Pedidos', array('Deletado' => 1))) {
      return true;
    }

    return false;
  }

  public function updateStatus()
  {
    $updateData = array(
      'Status' => $this->status,
    );

    $this->db->where('IdPedido', $this->idPedido);

    if ($this->db->update('Pedidos', $updateData)) {
      return true;
    }

    return false;
  }
}
