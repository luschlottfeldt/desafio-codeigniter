<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UsuariosModel', 'usuarios');
	}

	public function register()
	{
		$this->validateRequiredParameters(
			$_POST,
			array(
				'nome',
				'email',
				'senha'
			)
		);

		$this->usuarios->setNome($this->input->post('nome'));
		$this->usuarios->setEmail($this->input->post('email'));
		$this->usuarios->setSenha($this->input->post('senha'));

		$emailExists = $this->usuarios->checkExistingEmail();

		if ($emailExists) {
			$this->sendJSON(
				array(
					'success' => false,
					'title' => 'Ops',
					'text' => 'Email já cadastrado no sistema'
				),
				400
			);
		}

		if($this->usuarios->register()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Seu cadastro foi realizado com sucesso.'
				),
				200
			);
		}

		$this->sendJSON(
			array(
				'success' => false,
				'title' => 'Ops...',
				'text' => 'Algo deu errado ao tentar realizar seu cadastro. Tente novamente, por favor.'
			),
			400
		);
	}
}
