<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Guard
 *
 * Classe criada para manipular a sessão do usuario
 * 
 * @author Bernardo Pinheiro Camargo
 * @since 2019
 */
class Guard {

    // instancia do codeigniter
    public $ci;

    // dados do usuario logado
    public $user = false;

    // método construtor
    public function __construct() {

        // pega a instancia do ci
        $this->ci =& get_instance();

        // carrega a librarie de sessao
        $this->ci->load->library( 'session' );

        // pega os dados do usuario
        if ( $user = $this->ci->session->userdata( 'user' ) ) {
            $this->user = $user;
        }
    }
  
    /**
     * getShortName
     *
     * @param String $nome [Nome completo do usuario]
     * @return String [Concatena o primeiro e o ultimo nome do usuario]
     */
    public function getShortName($nome = false){

        if (!$nome) {
            $nome = $this->user['nome'];
        }

        $nomes = explode(" ", $nome);

        if(count($nomes) > 1)
            $nome = $nomes[0] . " " . $nomes[count($nomes)-1];        
        else
            $nome = $nomes[0];

        return $nome;
    }

    /**
     * logged
     *
     * Verifica se o usuário está logado ou não
     * 
     * @return Boolean
     */
    public function logged(){
        return $this->user ? true : false;
    }


    /**
     * item
     *
     * Retorna um item do array $user salvo na sessão
     * 
     * @param  String $key [Campo do array $user]
     * @return Object or NULL
     */
    public function item( $key ) {
        return isset( $this->user[$key] ) ? $this->user[$key] : null;
    }


    /**
     * login
     *
     * Tenta fazer o login do usuario através de um e-mail e senha inseridos
     * 
     * @param  String $email [E-mail para logar]
     * @param  String $senha [Senha para logar]
     * @return Boolean
     */
    public function login( $email, $senha ) {

        // carrega a model de usuários
        $this->ci->load->model( 'Usuarios_model' );

        // faz o login
        if ( $user = $this->ci->Usuarios_model->validate( $email, $senha ) ) {
            
            // guarda na sessao
            $this->ci->session->set_userdata( 'user', $user );            
            
            // guarda no atributo
            $this->user = $user;

            return true;
        } else return false;
    }

    /**
     * update
     *
     * Busca o usuario no banco de dados e atualiza a sessão com os dados 'novos'
     * 
     * @return Boolean
     */
    public function update() {

        // verifica se existe um usuário logado
        if ( !$this->user ) return false;

        // carrega a model de usuários
        $this->ci->load->model( 'Usuarios_model' );

        // pega os dados do perfil do usuario logado
        if ( $user = $this->ci->Usuarios_model->getById( $this->user['id_usuario'] ) ) {

            // seta a sessao
            $this->ci->session->set_userdata( 'user', $user );

            // seta o usuario
            $this->user = $user;

            return true;

        } else return false;
    }


    /**
     * logout
     *
     * Limpa a sessão 'user'
     * 
     * @return void
     */
    public function logout() {
        $this->ci->session->unset_userdata('user');
    }
}