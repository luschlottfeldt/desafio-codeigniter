<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Webservice extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('TokensModel', 'tokens');
		$this->load->model('PedidosModel', 'pedidos');
		$this->load->model('FornecedoresModel', 'fornecedores');
		$this->load->model('PedidosProdutosModel', 'pedidosProdutos');
	}

	public function index()
	{
		$this->hasActiveSession();
		$this->data['scripts'] = array('tokens');
		$this->content = "webservice/index";
		$this->renderer();
	}

	public function gerenciar()
	{
		$this->hasActiveSession();
		$this->data['tokens'] = $this->tokens->getTokens();
		$this->data['scripts'] = array('tokens');
		$this->content = "webservice/gerenciar";
		$this->renderer();
	}

	public function register()
	{
		$this->hasActiveSession();
		if ($this->tokens->register()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Token cadastrado com sucesso.'
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

	public function active()
	{
		$this->hasActiveSession();
		$this->validateRequiredParameters(
			$_POST,
			array(
				'ativo',
				'idToken'
			)
		);

		$ativo = $this->input->post('ativo') === 'true' ? 1 : 0;
		$this->tokens->setIdToken($this->input->post('idToken'));
		$this->tokens->setAtivo($ativo);

		$switchActive = $this->tokens->switchActive();

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
		$this->hasActiveSession();
		$this->tokens->setIdToken($this->input->get('idToken'));
		$token = $this->tokens->getToken();
		if (!$token) {
			redirect(base_url('webservice/gerenciar'));
		}
		
		$this->tokens->deleteToken();
		redirect(base_url('webservice/gerenciar'));
	}

	public function getPedidos() {
		$headers = $this->input->request_headers();

		if (!isset($headers['Authorization']) || empty($headers['Authorization'])) {
			$this->sendJSON(
				array(
					'success' => false,
					'response' => 'Unauthorized'
				),
				401
			);
		}

		$token = explode(' ', $headers['Authorization']);
		$this->tokens->setToken($token[1]);
		$response = $this->tokens->getTokenByToken();
		
		if (!$response || $response[0]->Ativo == 0) {
			$this->sendJSON(
				array(
					'success' => false,
					'response' => 'Unauthorized'
				),
				401
			);
		}

		$pedidos = $this->pedidos->getPedidos();

		$response = array();
		foreach ($pedidos as $pedido) {
			$this->fornecedores->setIdFornecedor($pedido->IdFornecedor);
			$fornecedorResponse = $this->fornecedores->getFornecedor()[0];
			
			$this->pedidosProdutos->setIdPedido($pedido->IdPedido);
			$produtosResponse = $this->pedidosProdutos->getPedidoProdutosWithInfo();

			$produtos = array();
			foreach ($produtosResponse as $produto) {
				$arr = array(
					'nome' => $produto->Nome,
					'codigo-de-barras' => $produto->CodigoDeBarras,
					'descricao' => $produto->Descricao,
					'valor-unitario' => $produto->Valor,
					'quantidade' => $produto->Quantidade,
					'subtotal' => $produto->Subtotal,
				);

				array_push($produtos, $arr);
			}

			$arr = array(
				'idPedido' => $pedido->IdPedido,
				'observacoes' => $pedido->Observacoes,
				'valorTotal' => $pedido->Total,
				'dataCriacao' => date('d/m/Y H:i:s', strtotime($pedido->DataCriacao)),
				'fornecedor' => array(
					'razao-social' => $fornecedorResponse->RazaoSocial,
					'nome-fantasia' => $fornecedorResponse->NomeFantasia,
					'CNPJ' => $fornecedorResponse->CNPJ,
					'nome-responsavel' => $fornecedorResponse->NomeResponsavel,
					'e-mail' => $fornecedorResponse->Email,
					'telefone' => $fornecedorResponse->Telefone,
					'cep' => $fornecedorResponse->CEP,
					'endereco' => $fornecedorResponse->Endereco,
					'numero' => $fornecedorResponse->Numero,
					'complemento' => $fornecedorResponse->Complemento,
					'bairro' => $fornecedorResponse->Bairro,
					'cidade' => $fornecedorResponse->Cidade,
					'estado' => $fornecedorResponse->Estado,
				),
				'produtos' => $produtos,
			);
			array_push($response, $arr);
		}
		
		$this->sendJSON(
			array(
				'success' => true,
				'response' => $response,
			),
			201
		);
	}
}
