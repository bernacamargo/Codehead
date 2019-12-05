<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends MY_Model {

    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table = 'usuarios';

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id = 'id_usuario';

    // metodo construtor
    public function __construct() {
        parent::__construct();
    }


    /**
     * validade
     *
     * Busca o email do usuario no banco utilizando o email passado como parametro
     * 
     * @param  String $email
     * @return Array or false [Retorna um array com os dados do usuario ou false caso não encontre]
     */
    function validate($email) {
        $this->db->from($this->table.' u')
        ->select('u.*')
        ->where('u.email', $email)
        ->where('u.acesso !=', 0)
        ->limit(1);

        $query = $this->db->get(); 

        return  ( $query->num_rows() == 1 ) ? $query->result_array()[0] : false;        
    }

}
