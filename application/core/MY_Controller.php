<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MY_Controller
 * 
 * @author Bernardo Pinheiro Camargo
 * @since 2019
 */
class MY_Controller extends CI_Controller {
    
    // médoto construtor
    public function __construct() {
        parent::__construct();
        // Carrega o Template e Guard
        $this->load->library( 'Template' );
        $this->load->library( 'Guard' );
    }

}

/* end of file */