<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Guard
 *
 * Classe criada para manipular o template
 * 
 * @author Bernardo Pinheiro Camargo
 * @since 2019
 */
class Template {

    // instancia do codeigniter
    public $ci;

    // arquivos de css para carregar na página
    public $css;

    // arquivos de js para carregar na página
    public $js;

    // as views que serão carregadas
    public $views = array();

    // modulos para carregar
    public $modules = array();

    // adiciona uma variavel a ser carregada na view
    public $data = array();

    // pagina a ser carregada
    public $p_page = 'home';

    // guard
    public $guard;

    // permissoes
    public $plano;

    // titulo da pagina
    public $title = '';

    // método construtor
    public function __construct() {

        // pega a instancia do ci
        $this->ci =& get_instance();

        // pega a biblioteca de configuração
        $this->ci->config->load( 'assets' );

        // pega a biblioteca de guard
        $this->ci->load->library( 'Guard' );
        $this->guard = $this->ci->guard;

        // carrega os módulos padrão
        $this->loadDefault();
    }

    /**
     * set_title
     *
     * Define o titulo da página html
     * 
     * @param String $title [Titulo da página]
     * @return void
     */
    public function set_title( $title ) {
        $this->title = $title;
    }

    /**
     * print_title
     *
     * Exibe o titulo atual
     * 
     * @return void
     */
    public function print_title() {
        echo $this->title;
    }

    /**
     * loadDefault
     *
     * carrega os módulos padrão
     * 
     * @return void
     */    
    public function loadDefault() {

        // pega os módulos setados no arquivo de configuracao
        $default = $this->ci->config->item('default');

        // junta com o que já tem guardado
        $this->modules = array_merge( $this->modules, $default );
    }

    /**
     * use_module
     *
     * adiciona um novo modulo a ser carregado
     * 
     * @return void
     */        
    public function use_module( $module ) {

        // adiciona o módulo
        $this->modules[] = $module;
    }

    /**
     * addCss
     *
     * adiciona o css
     *
     * @param String $css [SRC to a css file]     
     * @return void
     */            
    public function addCss( $css ) {
        $this->css[] = $css;
    }

    /**
     * addJs
     *
     * adiciona o css
     *
     * @param String $js [SRC to a js file]
     * @return void
     */            
    public function addJs( $js ) {
        $this->js[] = $js;
    }

    /**
     * view
     *
     * adiciona uma nova view
     * 
     * @param  String
     * @param  String
     * @return void
     */
    public function view( $chave, $view ) {
        $this->view[$chave] = $view;
    }

    /**
     * set
     *
     * seta o valor para uma variavel
     * 
     * @param String $chave
     * @param String $valor
     * @return void
     */
    public function set( $chave, $valor ) {
        $this->data[$chave] = $valor;
    }

    /**
     * item
     *
     * pega o valor de uma varivel
     * 
     * @param  String
     * @return mixed [Retorna o objeto do array indicado pela $chave ou null caso não exista]
     */
    public function item( $chave ) {
        return ( isset( $this->data[$chave] ) ) ? $this->data[$chave] : null;
    }

    /**
     * print_view
     *
     * Carrega uma view através do nome do seu arquivo
     * 
     * @param  String $view
     * @return void
     */
    public function print_view( $view ) {
        $this->ci->load->view( $view );
    } 
    
    /**
     * page
     *
     * seta a pagina a ser carregada
     * 
     * @param  String
     * @return void
     */
    public function page( $page ) {
        $this->p_page = $page;
    }

    /**
     * page
     *
     * carrega um componente
     * 
     * @param  String
     * @param Array $var [Array de dados a serem enviados para a view]
     * @return void
     */
    public function print_component( $component , $var = false) {
        
        // carrega a pagina
        $this->ci->load->view( 'components/'.$component, $var);
    }

    /**
     * print_page
     *
     * Carrega uma view salva em views/pages/[view].php
     * 
     * @param  String
     * @return void
     */
    public function print_page( $page = false ){

        // verifica se o usuário deseja carregar uma pagina em especifico
        $this->p_page = $page ? $page : $this->p_page;

        // carrega a pagina
        $this->ci->load->view( 'pages/'.$this->p_page );
    }

    /**
     * loadModules
     *
     * Carrega os modulos
     * 
     * @return void
     */
    public function loadModules(){

        // pega os modulos
        $modules = array_unique( $this->modules );

        // percorre todos os modulos
        foreach( $modules as $module ) {

            // carrega os arquivos de configuração
            $config = $this->ci->config->item( $module );

            // verifica se existem css
            if ( isset( $config['css'] ) ) {
                foreach ( $config['css'] as $css ) {
                    $this->addCss( $css );
                }
            }

            // verifica se existem js
            if ( isset( $config['js'] ) ) {
                foreach ( $config['js'] as $js ) {
                    $this->addJs( $js );
                }
            }
        }
    }

    /**
     * print_js
     *
     * Imprime o js
     * 
     * @return void
     */
    public function print_js() {
        foreach( $this->js as $js ) {
            if(ENVIRONMENT == 'production')
                echo '<script src="'.$js.'" type="text/javascript"></script>';
            else{
                echo '<script src="'.$js.'?version='.time().'" type="text/javascript"></script>';
            }
        }
    }

    /**
     * print_css
     *
     * Imprime o css
     * 
     * @return void
     */
    public function print_css() {
        foreach( $this->css as $css ) {
            if(ENVIRONMENT == 'production'){
                echo '<link href="'.$css.'" rel="stylesheet" media="screen"/>';
            }
            else{
                echo '<link href="'.$css.'?version='.time().'" rel="stylesheet" media="screen"/>';   
            }
            
        }
    }

    /**
     * render
     *
     * Renderiza a página escolhida em um layout escolhido (master.php)
     * 
     * @param  String $layout
     * @param  String $page
     * @return void
     */
    public function render( $layout = false, $page = false ) {

        // carrega os modulos
        $this->loadModules();

        // verifica se o usuário deseja carregar uma pagina em especifico
        $this->p_page = $page ? $page : $this->p_page;

        // carrega a view
        $this->ci->load->view( $layout, [ 'template' => $this ] );
    }

}
