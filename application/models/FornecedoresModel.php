<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FornecedoresModel extends CI_Model
{
  private $idFornecedor;
  private $razaoSocial;
  private $nomeFantasia;
  private $cnpj;
  private $nomeResponsavel;
  private $email;
  private $telefone;
  private $endereco;
  private $numero;
  private $complemento;
  private $bairro;
  private $cidade;
  private $estado;
  private $cep;
  private $ativo;

  public function setIdFornecedor($idFornecedor)
  {
    $this->idFornecedor = $idFornecedor;
  }

  public function setRazaoSocial($razaoSocial)
  {
    $this->razaoSocial = $razaoSocial;
  }

  public function setNomeFantasia($nomeFantasia)
  {
    $this->nomeFantasia = $nomeFantasia;
  }

  public function setCnpj($cnpj)
  {
    $this->cnpj = $cnpj;
  }

  public function setNomeResponsavel($nomeResponsavel)
  {
    $this->nomeResponsavel = $nomeResponsavel;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setTelefone($telefone)
  {
    $this->telefone = $telefone;
  }

  public function setEndereco($endereco)
  {
    $this->endereco = $endereco;
  }

  public function setNumero($numero)
  {
    $this->numero = $numero;
  }

  public function setComplemento($complemento)
  {
    $this->complemento = $complemento;
  }

  public function setBairro($bairro)
  {
    $this->bairro = $bairro;
  }

  public function setCidade($cidade)
  {
    $this->cidade = $cidade;
  }

  public function setEstado($estado)
  {
    $this->estado = $estado;
  }

  public function setCep($cep)
  {
    $this->cep = $cep;
  }

  public function setAtivo($ativo)
  {
    $this->ativo = $ativo;
  }

  public function register()
  {
    $insertData = array(
      'RazaoSocial' => $this->razaoSocial,
      'NomeFantasia' => $this->nomeFantasia,
      'CNPJ' => $this->cnpj,
      'NomeResponsavel' => $this->nomeResponsavel,
      'Email' => $this->email,
      'Telefone' => $this->telefone,
      'Endereco' => $this->endereco,
      'Numero' => $this->numero,
      'Complemento' => $this->complemento,
      'Bairro' => $this->bairro,
      'Cidade' => $this->cidade,
      'Estado' => $this->estado,
      'CEP' => $this->cep,
    );

    if ($this->db->insert('Fornecedores', $insertData)) {
      return $this->db->insert_id();
    }

    return false;
  }

  public function update()
  {
    $updateData = array(
      'RazaoSocial' => $this->razaoSocial,
      'NomeFantasia' => $this->nomeFantasia,
      'CNPJ' => $this->cnpj,
      'NomeResponsavel' => $this->nomeResponsavel,
      'Email' => $this->email,
      'Telefone' => $this->telefone,
      'Endereco' => $this->endereco,
      'Endereco' => $this->numero,
      'Complemento' => $this->complemento,
      'Bairro' => $this->bairro,
      'Cidade' => $this->cidade,
      'Estado' => $this->estado,
      'CEP' => $this->cep,
      'Ativo' => $this->ativo,
    );

    $this->db->where('IdFornecedor', $this->idFornecedor);

    if ($this->db->update('Fornecedores', $updateData)) {
      return true;
    }

    return false;
  }

  public function getFornecedor()
  {
    $sql = "SELECT * FROM Fornecedores WHERE IdFornecedor = ? AND Deletado = 0";

    $query = $this->db->query($sql, array($this->idFornecedor));

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getFornecedores()
  {
    $sql = "SELECT * FROM Fornecedores WHERE Deletado = 0 ORDER BY IdFornecedor DESC";

    $query = $this->db->query($sql);

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getFornecedoresAtivos()
  {
    $sql = "SELECT * FROM Fornecedores WHERE Deletado = 0 AND Ativo = 1 ORDER BY IdFornecedor DESC";

    $query = $this->db->query($sql);

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function deleteFornecedor()
  {
    $this->db->where('IdFornecedor', $this->idFornecedor);

    if ($this->db->update('Fornecedores', array('Deletado' => 1))) {
      return true;
    }

    return false;
  }

  public function switchActive()
  {
    $updateData = array(
      'Ativo' => $this->ativo
    );

    $this->db->where('IdFornecedor', $this->idFornecedor);

    if ($this->db->update('Fornecedores', $updateData)) {
      return true;
    }

    return false;
  }
}
