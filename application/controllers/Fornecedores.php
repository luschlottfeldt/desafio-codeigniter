<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fornecedores extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('FornecedoresModel', 'fornecedores');
		$this->hasActiveSession();
	}

	public function index()
	{
		$update = false;
		$fornecedor = null;
		if ($this->input->get('idFornecedor')) {
			$this->fornecedores->setIdFornecedor($this->input->get('idFornecedor'));
			$fornecedor = $this->fornecedores->getFornecedor()[0];
			$update = true;

			if (!$fornecedor) {
				redirect(base_url('usuarios'));
			}
		}

		$this->data['update'] = $update;
		$this->data['fornecedor'] = $fornecedor;
		$this->data['estados'] = ESTADOS;
		$this->data['scripts'] = array('fornecedores');
		$this->content = "fornecedores/index";
		$this->renderer();
	}

	public function gerenciar()
	{
		$this->data['fornecedores'] = $this->fornecedores->getFornecedores();
		$this->data['scripts'] = array('fornecedores');
		$this->content = "fornecedores/gerenciar";
		$this->renderer();
	}

	public function register()
	{
		$this->validateRequiredParameters(
			$_POST,
			array(
				'razaoSocial',
				'nomeFantasia',
				'cnpj',
				'nomeResponsavel',
				'email',
				'telefone',
				'endereco',
				'numero',
				'complemento',
				'bairro',
				'cidade',
				'estado',
				'cep',
			)
		);

		$this->fornecedores->setRazaoSocial($this->input->post('razaoSocial'));
		$this->fornecedores->setNomeFantasia($this->input->post('nomeFantasia'));
		$this->fornecedores->setCnpj($this->input->post('cnpj'));
		$this->fornecedores->setNomeResponsavel($this->input->post('nomeResponsavel'));
		$this->fornecedores->setEmail($this->input->post('email'));
		$this->fornecedores->setTelefone($this->input->post('telefone'));
		$this->fornecedores->setEndereco($this->input->post('endereco'));
		$this->fornecedores->setNumero($this->input->post('numero'));
		$this->fornecedores->setComplemento($this->input->post('complemento'));
		$this->fornecedores->setBairro($this->input->post('bairro'));
		$this->fornecedores->setCidade($this->input->post('cidade'));
		$this->fornecedores->setEstado($this->input->post('estado'));
		$this->fornecedores->setCep($this->input->post('cep'));

		if ($this->fornecedores->register()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Fornecedor cadastrado com sucesso.'
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
				'idFornecedor',
				'razaoSocial',
				'nomeFantasia',
				'cnpj',
				'nomeResponsavel',
				'email',
				'telefone',
				'endereco',
				'numero',
				'complemento',
				'bairro',
				'cidade',
				'estado',
				'cep',
			)
		);

		$this->fornecedores->setIdFornecedor($this->input->post('idFornecedor'));
		$this->fornecedores->setRazaoSocial($this->input->post('razaoSocial'));
		$this->fornecedores->setNomeFantasia($this->input->post('nomeFantasia'));
		$this->fornecedores->setCnpj($this->input->post('cnpj'));
		$this->fornecedores->setNomeResponsavel($this->input->post('nomeResponsavel'));
		$this->fornecedores->setEmail($this->input->post('email'));
		$this->fornecedores->setTelefone($this->input->post('telefone'));
		$this->fornecedores->setEndereco($this->input->post('endereco'));
		$this->fornecedores->setNumero($this->input->post('numero'));
		$this->fornecedores->setComplemento($this->input->post('complemento'));
		$this->fornecedores->setBairro($this->input->post('bairro'));
		$this->fornecedores->setCidade($this->input->post('cidade'));
		$this->fornecedores->setEstado($this->input->post('estado'));
		$this->fornecedores->setCep($this->input->post('cep'));
		$this->fornecedores->setAtivo($this->input->post('ativo'));

		if ($this->fornecedores->update()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Fornecedor alterado com sucesso.'
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
				'idFornecedor'
			)
		);

		$ativo = $this->input->post('ativo') === 'true' ? 1 : 0;
		$this->fornecedores->setIdFornecedor($this->input->post('idFornecedor'));
		$this->fornecedores->setAtivo($ativo);

		$switchActive = $this->fornecedores->switchActive();

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

	public function delete()
	{
		$this->fornecedores->setIdFornecedor($this->input->get('idFornecedor'));
		$fornecedor = $this->fornecedores->getFornecedor();
		if (!$fornecedor) {
			redirect(base_url('fornecedores/gerenciar'));
		}
		
		$this->fornecedores->deleteFornecedor();
		redirect(base_url('fornecedores/gerenciar'));
	}
}
