<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProdutosModel', 'produtos');
		$this->hasActiveSession();
	}

	public function index()
	{
		$update = false;
		$produto = null;
		if ($this->input->get('idProduto')) {
			$this->produtos->setIdProduto($this->input->get('idProduto'));
			$produto = $this->produtos->getProduto()[0];
			$update = true;

			if (!$produto) {
				redirect(base_url('produtos'));
			}
		}

		$this->data['update'] = $update;
		$this->data['produto'] = $produto;
		$this->data['scripts'] = array('produtos');
		$this->content = "produtos/index";
		$this->renderer();
	}

	public function gerenciar()
	{
		$this->data['produtos'] = $this->produtos->getProdutos();
		$this->data['scripts'] = array('produtos');
		$this->content = "produtos/gerenciar";
		$this->renderer();
	}

	public function register()
	{
		$this->validateRequiredParameters(
			$_POST,
			array(
				'nome',
				'codigoDeBarras',
				'descricao',
				'valor',
			)
		);

		$this->produtos->setNome($this->input->post('nome'));
		$this->produtos->setCodigoDeBarras($this->input->post('codigoDeBarras'));
		$this->produtos->setDescricao($this->input->post('descricao'));
		$this->produtos->setValor($this->input->post('valor'));
		
		if ($this->produtos->register()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Produto cadastrado com sucesso.'
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
				'idProduto',
				'nome',
				'codigoDeBarras',
				'descricao',
				'valor',
			)
		);

		$this->produtos->setIdProduto($this->input->post('idProduto'));
		$this->produtos->setNome($this->input->post('nome'));
		$this->produtos->setCodigoDeBarras($this->input->post('codigoDeBarras'));
		$this->produtos->setDescricao($this->input->post('descricao'));
		$this->produtos->setValor($this->input->post('valor'));
		$this->produtos->setAtivo($this->input->post('ativo'));

		if ($this->produtos->update()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Produto alterado com sucesso.'
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
				'idProduto'
			)
		);

		$ativo = $this->input->post('ativo') === 'true' ? 1 : 0;
		$this->produtos->setIdProduto($this->input->post('idProduto'));
		$this->produtos->setAtivo($ativo);

		$switchActive = $this->produtos->switchActive();

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
		$this->produtos->setIdProduto($this->input->get('idProduto'));
		$produto = $this->produtos->getProduto();
		if (!$produto) {
			redirect(base_url('produtos/gerenciar'));
		}
		
		$this->produtos->deleteProduto();
		redirect(base_url('produtos/gerenciar'));
	}
}
