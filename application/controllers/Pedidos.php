<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('ProdutosModel', 'produtos');
		$this->load->model('FornecedoresModel', 'fornecedores');
		$this->load->model('PedidosModel', 'pedidos');
		$this->load->model('PedidosProdutosModel', 'pedidosProdutos');

		$this->hasActiveSession();
	}

	public function index()
	{
		$this->data['produtos'] = $this->produtos->getProdutosAtivos();
		$this->data['fornecedores'] = $this->fornecedores->getFornecedoresAtivos();
		$this->data['scripts'] = array('pedidos');
		$this->content = "pedidos/index";
		$this->renderer();
	}

	public function gerenciar()
	{
		$this->data['pedidos'] = $this->pedidos->getPedidosListagem();
		$this->data['scripts'] = array('pedidos');
		$this->content = "pedidos/gerenciar";
		$this->renderer();
	}

	public function alterar()
	{
		$this->pedidos->setIdPedido($this->input->get('idPedido'));

		$pedido = $this->pedidos->getPedido()[0];

		if (!$pedido || $pedido->Status == 2) {
			redirect(base_url('pedidos/gerenciar'));
		}

		$this->pedidosProdutos->setIdPedido($this->input->get('idPedido'));
		$pedidoProdutos = $this->pedidosProdutos->getPedidosProdutosByIdPedido();
		$items = array();

		foreach ($pedidoProdutos as $item) {
			$items[$item->IdProduto] = array(
				'quantidade' => $item->Quantidade
			);
		}

		$this->data['produtos'] = $this->produtos->getProdutosAtivos();
		$this->data['fornecedores'] = $this->fornecedores->getFornecedoresAtivos();
		$this->data['items'] = $items;
		$this->data['pedido'] = $pedido;
		$this->data['scripts'] = array('pedidos');
		$this->content = "pedidos/alterar";
		$this->renderer();
	}

	public function addToCart()
	{
		$this->validateRequiredParameters(
			$_POST,
			array(
				'idProduto',
				'quantidade',
			)
		);

		$idProduto = $this->input->post('idProduto');
		$quantidade = $this->input->post('quantidade');
		$valorUnitario = $this->input->post('valorUnitario');

		if ($quantidade != 0) {
			$_SESSION['cart']['itens'][$idProduto] = array(
				'quantidade' => $quantidade,
				'valorUnitario' => $valorUnitario,
			);
		} else {
			unset($_SESSION['cart']['itens'][$idProduto]);
		}

		$this->calculateTotalValue();

		$this->sendJSON(
			array(
				'success' => true,
				'title' => 'Tudo certo!',
				'text' => 'Produto adicionado com sucesso.'
			),
			200
		);
	}

	public function finish()
	{
		if (empty($_SESSION['cart']['itens'])) {
			$this->sendJSON(
				array(
					'success' => false,
					'title' => 'Atenção',
					'text' => 'Pedido não possui itens.'
				),
				400
			);
		}

		if (empty($this->input->post('fornecedor'))) {
			$this->sendJSON(
				array(
					'success' => false,
					'title' => 'Atenção',
					'text' => 'Selecione o fornecedor.'
				),
				400
			);
		}

		$this->pedidos->setIdFornecedor($this->input->post('fornecedor'));
		$this->pedidos->setObservacoes($this->input->post('observacoes'));
		$this->pedidos->setTotal($_SESSION['cart']['total']);
		$idPedido = $this->pedidos->register();

		if ($idPedido) {
			foreach ($_SESSION['cart']['itens'] as $idProduto => $item) {
				$this->pedidosProdutos->setIdPedido($idPedido);
				$this->pedidosProdutos->setIdProduto($idProduto);
				$this->pedidosProdutos->setQuantidade($item['quantidade']);
				$this->pedidosProdutos->setSubtotal($item['quantidade'] * $item['valorUnitario']);
				$this->pedidosProdutos->register();
			}
		}

		$this->session->set_userdata('cart', array(
			'itens' => [],
			'total' => '0.00'
		));

		$this->sendJSON(
			array(
				'success' => true,
				'title' => 'Tudo certo!',
				'text' => 'Pedido criado com sucesso.'
			),
			200
		);
	}

	public function delete()
	{
		$this->pedidos->setIdPedido($this->input->get('idPedido'));
		$pedido = $this->pedidos->getPedido();

		if (!$pedido) {
			redirect(base_url('pedidos/gerenciar'));
		}

		$this->pedidos->deletePedido();
		redirect(base_url('pedidos/gerenciar'));
	}

	public function changeProduct()
	{
		$quantidade = $this->input->post('quantidade');

		$this->pedidosProdutos->setIdPedido($this->input->post('idPedido'));
		$this->pedidosProdutos->setIdProduto($this->input->post('idProduto'));
		$this->pedidosProdutos->setQuantidade($quantidade);
		$this->pedidosProdutos->setSubtotal($this->input->post('valorUnitario') * $quantidade);
		$pedidosProdutos = $this->pedidosProdutos->getPedidosProdutosByIdPedido();

		$pedidoProduto = $this->pedidosProdutos->getPedidoProduto();

		if ($pedidoProduto && $quantidade > 0) { // change item
			$this->pedidosProdutos->update();
		} elseif ($pedidoProduto && $quantidade == 0) { // delete item
			if (count($pedidosProdutos) == 1) {
				$this->sendJSON(
					array(
						'success' => false,
						'title' => 'Atenção',
						'text' => 'Pedido deve conter ao menos um item.'
					),
					400
				);
			}

			$this->pedidosProdutos->delete();
		} else { // add item
			if ($quantidade == 0) {
				if (empty($_SESSION['cart']['itens'])) {
					$this->sendJSON(
						array(
							'success' => false,
							'title' => 'Atenção',
							'text' => 'Quantidade deve ser maior que zero.'
						),
						400
					);
				}
			}

			$this->pedidosProdutos->register();
		}

		$pedidosProdutos = $this->pedidosProdutos->getPedidosProdutosByIdPedido(); // get updated values
		$total = 0;
		foreach ($pedidosProdutos as $pp) {
			$total += $pp->Subtotal;
		}

		$this->pedidos->setTotal($total);
		$this->pedidos->setIdPedido($this->input->post('idPedido'));
		$this->pedidos->updateValorTotal();

		$this->sendJSON(
			array(
				'success' => true,
				'title' => 'Tudo certo!',
				'text' => 'Item alterado com sucesso.'
			),
			200
		);
	}

	public function update()
	{
		if (empty($this->input->post('fornecedor'))) {
			$this->sendJSON(
				array(
					'success' => false,
					'title' => 'Atenção',
					'text' => 'Selecione o fornecedor.'
				),
				400
			);
		}

		$this->pedidos->setIdPedido($this->input->post('idPedido'));
		$this->pedidos->setIdFornecedor($this->input->post('fornecedor'));
		$this->pedidos->setObservacoes($this->input->post('observacoes'));

		if ($this->pedidos->update()) {
			$this->sendJSON(
				array(
					'success' => true,
					'title' => 'Tudo certo!',
					'text' => 'Pedido alterado com sucesso.'
				),
				200
			);
		}

		$this->sendJSON(
			array(
				'success' => false,
				'title' => 'Atenção',
				'text' => 'Erro ao tentar alterar o pedido. Tente novamente.'
			),
			400
		);
	}

	public function finalizeOrder()
	{
		$this->pedidos->setIdPedido($this->input->post('idPedido'));
		$this->pedidos->setStatus(STATUS_FINALIZADO);
		$this->pedidos->updateStatus();

		$this->sendJSON(
			array(
				'success' => true,
				'title' => 'Tudo certo!',
				'text' => 'Pedido finalizado com sucesso.'
			),
			200
		);
	}

	private function calculateTotalValue()
	{
		$_SESSION['cart']['total'] = 0;

		if (empty($_SESSION['cart']['itens'])) {
			$_SESSION['cart']['total'] = 0;
		} else {
			foreach ($_SESSION['cart']['itens'] as $item) {
				$_SESSION['cart']['total'] += $item['valorUnitario'] * $item['quantidade'];
			}
		}
	}
}
