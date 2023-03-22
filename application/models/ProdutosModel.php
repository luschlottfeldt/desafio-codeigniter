<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProdutosModel extends CI_Model
{
  private $idProduto;
  private $nome;
  private $codigoDeBarras;
  private $descricao;
  private $valor;
  private $ativo;

  public function setIdProduto($idProduto)
  {
    $this->idProduto = $idProduto;
  }

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function setCodigoDeBarras($codigoDeBarras)
  {
    $this->codigoDeBarras = $codigoDeBarras;
  }

  public function setDescricao($descricao)
  {
    $this->descricao = $descricao;
  }

  public function setValor($valor)
  {
    $this->valor = $valor;
  }

  public function setAtivo($ativo)
  {
    $this->ativo = $ativo;
  }

  public function register()
  {
    $insertData = array(
      'Nome' => $this->nome,
      'CodigoDeBarras' => $this->codigoDeBarras,
      'Descricao' => $this->descricao,
      'Valor' => $this->valor,
    );

    if ($this->db->insert('Produtos', $insertData)) {
      return $this->db->insert_id();
    }

    return false;
  }

  public function update()
  {
    $updateData = array(
      'Nome' => $this->nome,
      'CodigoDeBarras' => $this->codigoDeBarras,
      'Descricao' => $this->descricao,
      'Valor' => $this->valor,
      'Ativo' => $this->ativo,
    );

    $this->db->where('IdProduto', $this->idProduto);

    if ($this->db->update('Produtos', $updateData)) {
      return true;
    }

    return false;
  }

  public function getProduto()
  {
    $sql = "SELECT * FROM Produtos WHERE IdProduto = ? AND Deletado = 0";

    $query = $this->db->query($sql, array($this->idProduto));

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getProdutos()
  {
    $sql = "SELECT * FROM Produtos WHERE Deletado = 0 ORDER BY IdProduto DESC";

    $query = $this->db->query($sql);

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getProdutosAtivos()
  {
    $sql = "SELECT * FROM Produtos WHERE Deletado = 0 AND Ativo = 1 ORDER BY IdProduto DESC";

    $query = $this->db->query($sql);

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function deleteProduto()
  {
    $this->db->where('IdProduto', $this->idProduto);

    if ($this->db->update('Produtos', array('Deletado' => 1))) {
      return true;
    }

    return false;
  }

  public function switchActive()
  {
    $updateData = array(
      'Ativo' => $this->ativo
    );

    $this->db->where('IdProduto', $this->idProduto);

    if ($this->db->update('Produtos', $updateData)) {
      return true;
    }

    return false;
  }
}
