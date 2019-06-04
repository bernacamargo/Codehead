<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home
 * 
 * @author Bernardo Pinheiro Camargo
 * @since 2019
 */
class Home extends MY_Controller {

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
	}

	public function index(){
		header("Access-Control-Allow-Origin: *");

		// Verifica se o usuario ta logado
		if($this->guard->logged()){
			// Redireciona para o dashboard
			$this->template->set_title('Dashboard');
			$this->template->render('master', 'home' );
		}
		else{
			// Redireciona para o login
			$this->template->set_title("Login");
			$this->template->render('master','login');
		}
	}


}
