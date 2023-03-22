<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TokensModel extends CI_Model
{
  private $idToken;
  private $token;
  private $ativo;

  public function setIdToken($idToken)
  {
    $this->idToken = $idToken;
  }

  public function setToken($token)
  {
    $this->token = $token;
  }

  public function setAtivo($ativo)
  {
    $this->ativo = $ativo;
  }

  public function register()
  {
    $this->generateToken();

    $insertData = array(
      'Token' => $this->token,
    );

    if ($this->db->insert('Tokens', $insertData)) {
      return $this->db->insert_id();
    }

    return false;
  }

  public function getToken()
  {
    $sql = "SELECT * FROM Tokens WHERE IdToken = ? ORDER BY IdToken DESC";

    $query = $this->db->query($sql, array($this->idToken));

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getTokenByToken()
  {
    $sql = "SELECT * FROM Tokens WHERE Token = ? AND Deletado = 0";

    $query = $this->db->query($sql, array($this->token));

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getTokens()
  {
    $sql = "SELECT * FROM Tokens WHERE Deletado = 0 ORDER BY IdToken DESC";

    $query = $this->db->query($sql);

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function switchActive()
  {
    $updateData = array(
      'Ativo' => $this->ativo
    );

    $this->db->where('IdToken', $this->idToken);
    
    if($this->db->update('Tokens', $updateData)) {
      return true;
    }

    return false;
  }

  public function deleteToken()
  {
    $this->db->where('IdToken', $this->idToken);

    if ($this->db->update('Tokens', array('Deletado' => 1))) {
      return true;
    }

    return false;
  }

  private function generateToken()
  {
    $this->token = md5(random_bytes(64));
  }
}
