<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UsuariosModel', 'usuarios');
		$this->hasActiveSession();
	}

	public function index()
	{
		$update = false;
		$usuario = null;
		if ($this->input->get('idUsuario')) {
			$this->usuarios->setIdUsuario($this->input->get('idUsuario'));
			$usuario = $this->usuarios->getUsuario()[0];
			$update = true;

			if (!$usuario) {
				redirect(base_url('usuarios'));
			}
		}

		$this->data['update'] = $update;
		$this->data['usuario'] = $usuario;
		$this->data['scripts'] = array('usuarios');
		$this->content = "usuarios/index";
		$this->renderer();
	}

	public function gerenciar()
	{
		$this->data['usuarios'] = $this->usuarios->getUsuarios();
		$this->data['scripts'] = array('usuarios');
		$this->content = "usuarios/gerenciar";
		$this->renderer();
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
		$this->usuarios->setAtivo($this->input->post('ativo') ? 1 : 0);

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

		if ($this->usuarios->register()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Usuário cadastrado com sucesso.'
				),
				200
			);
		}

		$this->sendJSON(
			array(
				'success' => false,
				'title' => 'Ops...',
				'text' => 'Algo deu errado ao tentar realizar o cadastro. Tente novamente, por favor.'
			),
			400
		);
	}

	public function update()
	{
		$this->validateRequiredParameters(
			$_POST,
			array(
				'nome',
				'senha',
				'idUsuario',
			)
		);

		$this->usuarios->setIdUsuario($this->input->post('idUsuario'));
		$this->usuarios->setNome($this->input->post('nome'));
		$this->usuarios->setEmail($this->input->post('email'));
		$this->usuarios->setSenha($this->input->post('senha'));
		$this->usuarios->setAtivo($this->input->post('ativo') ? 1 : 0);

		if ($this->usuarios->update()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Usuário alterado com sucesso.'
				),
				200
			);
		}

		$this->sendJSON(
			array(
				'success' => false,
				'title' => 'Ops...',
				'text' => 'Algo deu errado ao tentar atualizar o cadastro. Tente novamente, por favor.'
			),
			400
		);
	}

	public function active()
	{
		$this->validateRequiredParameters(
			$_POST,
			array(
				'ativo',
				'idUsuario'
			)
		);

		$ativo = $this->input->post('ativo') === 'true' ? 1 : 0;
		$this->usuarios->setIdUsuario($this->input->post('idUsuario'));
		$this->usuarios->setAtivo($ativo);

		$switchActive = $this->usuarios->switchActive();

		if (!$switchActive) {
			$this->sendJSON(
				array(
					'success' => false,
					'title' => 'Ops...',
					'text' => 'Algo deu errado ao tentar atualizar o cadastro. Tente novamente, por favor.'
				),
				400
			);
		}
	}
}
