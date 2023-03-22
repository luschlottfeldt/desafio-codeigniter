<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UsuariosModel extends CI_Model
{
  private $idUsuario;
  private $nome;
  private $email;
  private $ativo;
  private $senha;

  public function setNome($nome)
  {
    $this->nome = $nome;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setSenha($senha)
  {
    $this->senha = $senha;
  }

  public function setIdUsuario($idUsuario)
  {
    $this->idUsuario = $idUsuario;
  }

  public function setAtivo($ativo)
  {
    $this->ativo = $ativo;
  }

  public function register()
  {
    $senha = $this->hashPassword();

    $insertData = array(
      'Nome' => $this->nome,
      'Email' => $this->email,
      'Senha' => $senha
    );

    if ($this->db->insert('Usuarios', $insertData)) {
      return $this->db->insert_id();
    }

    return false;
  }

  public function update()
  {
    $senha = $this->hashPassword();

    $updateData = array(
      'Nome' => $this->nome,
      'Senha' => $senha,
      'Ativo' => $this->ativo
    );

    $this->db->where('IdUsuario', $this->idUsuario);
    
    if($this->db->update('Usuarios', $updateData)) {
      return true;
    }

    return false;
  }

  private function hashPassword()
  {
    return password_hash($this->senha, PASSWORD_DEFAULT);
  }

  public function checkExistingEmail()
  {
    $sql = "SELECT 
                    *
                FROM Usuarios
                WHERE Email = ?";

    $query = $this->db->query($sql, array($this->email));

    if ($query) {
      return count($query->result());
    } else {
      return false;
    }
  }

  public function userLogin()
  {
    $sql = "SELECT 
                    *
                FROM Usuarios
                WHERE Email = ?";

    $query = $this->db->query($sql, array($this->email));

    if ($query->num_rows() != 0) {
      $result = $query->row();

      if (password_verify($this->senha, $result->Senha)) {
        return $result;
      }
    }

    return false;
  }

  public function getUsuario()
  {
    $sql = "SELECT * FROM Usuarios WHERE IdUsuario = ?";

    $query = $this->db->query($sql, array($this->idUsuario));

    if ($query) {
      return $query->result();
    }

    return false;
  }

  public function getUsuarios()
  {
    $sql = "SELECT * FROM Usuarios ORDER BY IdUsuario DESC";

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

    $this->db->where('IdUsuario', $this->idUsuario);
    
    if($this->db->update('Usuarios', $updateData)) {
      return true;
    }

    return false;
  }
}
