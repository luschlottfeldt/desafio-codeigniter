<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UsuariosModel', 'usuarios');
	}

	public function index()
	{
		$this->isUserAlreadyLogedIn();
		$this->load->view('login/index');
	}

	public function register()
	{
		$this->isUserAlreadyLogedIn();
		$this->load->view('login/register');
	}

	public function Login()
	{
		$this->validateRequiredParameters(
			$_POST,
			array(
				'email',
				'senha',
			)
		);

		$this->usuarios->setEmail($this->input->post('email'));
		$this->usuarios->setSenha($this->input->post('senha'));
		$ip = $this->input->ip_address();

		$userLogin = $this->usuarios->userLogin();

		if ($userLogin) {
			if (!$userLogin->Ativo) {
				$this->sendJSON(
					array(
						'success' => false,
						'title' => 'Atenção',
						'text' => 'Procure o administrador do sistema'
					),
					400
				);
			}

			$this->usuarios->setIdUsuario($userLogin->IdUsuario);
			$user = $this->usuarios->getUsuario();
			unset($user[0]->Senha);

			if (isset($_SESSION['login_atempt'])) {
				unset($_SESSION['login_atempt']);
			}

			$this->session->set_userdata('userSession', $user);
			$this->session->set_userdata('cart', array(
				'itens' => [],
				'total' => '0.00'
			));

			$this->sendJSON(
				array(
					'success' => true
				),
				200
			);
		}
		
		if (
			isset($_SESSION['login_atempt']) &&
			isset($_SESSION['login_atempt'][$ip]) &&
			$_SESSION['login_atempt'][$ip]['atempts'] == 3 &&
			$_SESSION['login_atempt'][$ip]['wait_until'] > time()
		) {
			$this->sendJSON(
				array(
					'success' => false,
					'title' => 'Atenção',
					'text' => 'Excesso de tentativas. Tente novamente em alguns minutos.'
				),
				400
			);
		} else {
			$atempts = 0;
			
			if (isset($_SESSION['login_atempt'][$ip]) && $_SESSION['login_atempt'][$ip]['wait_until'] > time()) {
				$atempts = $_SESSION['login_atempt'][$ip]['atempts'];
			}

			$lock = array(
				$ip => [
					'wait_until' => time() + 3 * 60,
					'atempts' => $atempts + 1
				]
			);
			$this->session->set_userdata('login_atempt', $lock);
		}

		$this->sendJSON(
			array(
				'success' => false,
				'title' => 'Ops',
				'text' => 'Email ou senha inválido.'
			),
			400
		);
	}

	public function logout()
	{
		session_destroy();

		redirect('/login');
	}

	private function isUserAlreadyLogedIn()
	{
		if ($this->session->userSession) {
			redirect('home');
		}
	}
}
