<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login
 * 
 * @author Bernardo Pinheiro Camargo
 * @since 2019
 */
class Login extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
    	parent::__construct();
		$this->load->model('Usuarios_model');    	
	}

	public function index(){
		$this->template->set("container", 'login');
	}

	/**
	 * login
	 *
	 * Tenta realizar o login e redireciona para a tela inicial
	 * 
	 * @return void
	 */
	public function login(){
		$post = $this->input->post();

		if($this->guard->login($post['email'], $post['senha'])){
			$this->session->set_flashdata('success', 'Bem vindo!');
		}
		else
			$this->session->set_flashdata('error', 'Credenciais inválidas.');
	
		redirect(site_url(),'location');
	}

	/**
	 * logout
	 *
	 * Faz o logout e redireciona para a tela inicial
	 * 
	 * @return void
	 */
	public function logout(){
		$this->guard->logout();

		redirect(site_url(),'location');
	}
}