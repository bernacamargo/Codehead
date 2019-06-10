# Codehead - Template para Codeigniter
[![Latest Stable Version](https://poser.pugx.org/bernacamargo/template_codeigniter-3.1.10/v/stable)](https://packagist.org/packages/bernacamargo/template_codeigniter-3.1.10)
[![Licença](https://poser.pugx.org/bernacamargo/template_codeigniter-3.1.10/license)](https://packagist.org/packages/bernacamargo/template_codeigniter-3.1.10)

<!-- [![Total Downloads](https://poser.pugx.org/bernacamargo/template_codeigniter-3.1.10/downloads)](https://packagist.org/packages/bernacamargo/template_codeigniter-3.1.10) -->

Codehead é uma biblioteca com otimizações voltadas para evitar a repetição de código e aumentar a produtividade através de métodos úteis. Utilizaremos [Twitter Bootstrap 4](https://getbootstrap.com.br/docs/4.1/getting-started/introduction/), [JQuery 3.4.1](https://jquery.com/), [Font-awesome 5.8.1](http://fontawesome.io/icons), [PNotify](https://sciactive.com/pnotify/), [Core System Classes](https://www.codeigniter.com/user_guide/general/core_classes.html) e [Bibliotecas PHP](https://www.codeigniter.com/user_guide/libraries/loader.html) para manipular funções do [Codeigniter](https://www.codeigniter.com/).

* Links úteis
    * [Codeigniter user guide](https://www.codeigniter.com/user_guide/)(docs)
    * [Awesome codeigniter](https://github.com/codeigniter-id/awesome-codeigniter)(A list of awesome CodeIgniter core, helpers, hooks, language, libraries, third_party and other cool resources for CodeIgniter.)
    * [Codeigniter Ion Auth 3](https://github.com/benedmunds/CodeIgniter-Ion-Auth)(Simple and lightweight authentication for your CodeIgniter apps)
    * [FUEL CMS](https://www.getfuelcms.com/home)(The content management system for premium-grade websites)


## Sumário
* [Instalando](#instalando)
* [Configurando](#configurando)
* [Config Assets](#config-assets)
* [Biblioteca Template](#biblioteca-template)
    * [Métodos](#métodos)
    * [Métodos principais](#métodos-principais)
* [Biblioteca Guard](#biblioteca-guard)
    * [Métodos](#métodos-1)
* [Core MY_Controller](#core-my_controller)
* [Core MY_Model](#core-my_model)
    * [Métodos](#métodos-2)
* [Notificação(PNotify)](#notificações)
* [Plugins JS](#plugins-js)
* [Licença MIT](#license)

## Instalando
Faça o [download como ZIP](https://github.com/bernacamargo/codehead/archive/master.zip) ou clone o repósitorio em seu ambiente local, em seguida basta realizar a configuração da aplicação e começar a usa-la para desenvolver sua aplicação.

## Configurando
### Config.php
Configure o base_url em `application/config/config.php`

- Troque `yourapp` pelo nome do seu aplicativo local

```php
$config['base_url'] = 'http://localhost/yourapp'
```

### Conectando ao Banco de Dados

Credenciais do banco configuradas em `application/config/database.php`

- Troque os valores `YOURHOST`, `DB_USERNAME`, `DB_PASSWORD` e `DB_NAME` pelo host, username, senha e nome do banco de dados respectivamente

```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'YOURHOST',
    'username' => 'DB_USERNAME',
    'password' => 'DB_PASSWORD',
    'database' => 'DB_NAME',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

## Config Assets

Configure a source de todos os import `.js` e `.css` em `application/config/assets.php`

- No array `$config['default']` configure a ordem, da esquerda para a direita, em que os assets serão carregados. Note que os arquivos `functions.js` e `style.css` devem ser carregados por último. É válido freezar que os assets apenas serão carregados caso sejam definidos nesse array.

```php
$config['default'] = ['bootstrap', 'vendors', 'pnotify', 'custom'];
```

> O indice `custom` deve estar **sempre** na última posição do vetor.

- Defina o caminho dos plugins a serem utilizados sempre respeitando a estrutura dos arrays(como no exemplo a seguir) e adicionando o nome deste ao `$config['default']`(como mostrado a cima).

```php
$config['modulo_name'] = [
    'css'   =>  [
        'path/to/css/file1.css';
        'path/to/css/file2.css';
        'path/to/css/file3.css';
    ],
    'js'    =>  [
        'path/to/js/file1.js';
        'path/to/js/file2.js';
        'path/to/js/file3.js';
    ]
];
```


#### Carregado por padrão(bootstrap e pnotify)

> Note que o Jquery não é carregado nos `assets`, pois visto que se carrega-lo ao final do documento, não será possível utiliza-lo no meio do `<body>`, então carrego o `jquery 3.4.1` no head da view `application/views/master.php`

```php
// Bootstrap 4.3.1
$config['bootstrap'] = [
    'css' => [ 
        'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
        site_url('assets/vendors/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css')
    ],
    'js'  => [
        'https://unpkg.com/popper.js/dist/umd/popper.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
        site_url('assets/vendors/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js')
    ]
];

// Notificação carregada por default
$config['pnotify'] = [
    'css'   =>  [
        site_url('assets/vendors/pnotify/dist/pnotify.css'), 
        site_url('assets/vendors/pnotify/dist/pnotify.buttons.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.nonblock.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.material.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.mobile.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.brighttheme.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.history.css'),         

    ],
    'js'    => [
        site_url('assets/vendors/pnotify/dist/pnotify.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.buttons.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.nonblock.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.animate.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.callbacks.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.confirm.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.history.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.mobile.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.reference.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.tooltip.js'),         

    ]
];



/**
 * ================================
 * ALTERAR SOMENTE OS ARRAYS ABAIXO
 * ================================
 */



// Plugins localizados na pasta assets/vendors
$config['vendors'] = [
    'css' => [

    ],

    'js' => [

    ]
];



// Ultimo módule a ser carregado
$config['custom'] = [
    'css' => [  
        site_url('assets/css/style.css'),
    ],
    'js' => [ 
        site_url('assets/js/functions.js'),         
    ]
];
```

## Biblioteca Template

Essa classe tem como função principal auxiliar no fluxo `MVC` e possue métodos para carregar os [assets](#assets)(módulos), renderizar views, definir o `title` da página e carregar informações do `Controller => View`.


```php
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
}
```

### Métodos

* set_title()
* print_title()
* loadDefault()
* use_module()
* loadModules()
* set()
* item()
* addCss()
* addJs()
* print_js()
* print_css()
* view()
* print_view()
* page()
* print_component()
* print_page()
* render()

*Não explicarei todos os métodos, pois muitos deles são apenas funções auxiliares e acabam nunca sendo utilizadas na prática pelo desenvolvedor.*

### Métodos principais

- set()
```php
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
```

> Essa função deve ser utilizada nos controllers para enviar informação para as views

Exemplo

```php
class Usuario extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_model');
    }

    public function index(){
        $usuarios = $this->Usuarios_model->getAll(); // busca todos os usuarios no bd
        $this->template->set("usuarios", $usuarios); // seta os usuarios ($usuarios) encontrados para a posição 'usuarios' do array do template
    }
}
```


- item()
```php
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
```

> Essa função deve ser utilizada nas views para recuperar informações passadas pelo controller.

Exemplo

```php
$usuarios = $this->template->item('usuarios'); //Armazena em $usuarios os dados adicionados anteriormente no controller

foreach ($usuarios as $user) {
    echo $user['nome'] . '<br>';
}
```


- set_title()
```php
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
```

> Essa função deve ser utilizada nos controllers para definir o título da página que será carregada.

Exemplo

```php
class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->template->set_title("Página inicial"); // Seta o titulo da pagina
    }
}
```

- print_title()
```php
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
```

> Essa função deve ser utilizada nas views para printar o titulo da página uma vez que este tenha sido definido no controller pela função `set_title`. Deve ser chamada na view `master.php` a qual carrega a estrutura do HTML.

Exemplo

```HTML
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Language" content="pt-br">
  
        <!-- TITLE -->
        <title><?PHP $template->print_title(); ?></title> <!-- Exibe na tela o title setado no controller -->
        .
        .
        .
```

- print_js()
```php
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
```

> Essa função deve ser utilizada nas views para imprimir na tela os arquivos JS definidos nos [Assets](#config-assets). Deve ser chamada na view `master.php` a qual carrega a estrutura do HTML.

Exemplo

```HTML
        .
        .
        .
        <!-- PRINT JS - CONFIG IN config/assets.php -->
        <?php $template->print_js(); ?>
    </body>
</html>
```

- print_css()
```php
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
                echo '<link href="'.$css.'" rel="stylesheet" media="screen"></script>';
            }
            else{
                echo '<link href="'.$css.'?version='.time().'" rel="stylesheet" media="screen"></script>';   
            }
            
        }
    }
```
> Essa função deve ser utilizada nas views para imprimir na tela os arquivos CSS definidos nos [Assets](#config-assets). Deve ser chamada na view `master.php` a qual carrega a estrutura do HTML.

Exemplo

```HTML
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Language" content="pt-br">
        
        <title><?PHP $template->print_title(); ?></title> <!-- Exibe na tela o title setado no controller -->


        <?PHP $template->print_css(); ?>

    </head>
    .
    .
    .

```

> Note que nas funções `print_css` e `print_js` possuem uma verificação de `ENVIRONMENT` a qual define o estágio que está o projeto, possuindo os valores: `production`, `testing` e `development`. Quando não estivermos em ambiente de produção, a URL do arquivo recebe um sufixo `?version='.time().'`, para que o navegador seja sempre forçado a baixar o arquivo evitando problemas de cache.


- print_component()
```php
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
```

> Essa função deve ser utilizada nas views para imprimir um componente existente em `application/views/components/`

- print_page()
```php
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
```

> Essa função deve ser utilizada nas views para imprimir uma página existente em `application/views/pages/`

- render()

Deve ser utilizado como um substituto do `$this->load->view()` do codeigniter para carregar páginas completas, dê uma olhada na [view master](https://github.com/bernacamargo/codehead/blob/master/application/views/master.php) para entender melhor o fluxo de carregamento.

```php
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
```
> Essa função deve ser utilizada nos controllers para exibir uma página existente em `application/views/pages/` dentro do layout `application/views/master.php` com seus respectivos módulos de css/js.

Exemplo

```php
class Home extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->template->set_title("Página inicial"); // Seta o titulo da pagina
        $this->template->render('master', 'home'); // Carrega a view /views/pages/home.php dentro do layout views/master.php
    }
}
```

## Biblioteca Guard

Essa classe tem como função facilitar a manipulação da variável de sessão do usuário, utiliza-se as funções do [Session Library](https://www.codeigniter.com/user_guide/libraries/sessions.html) do Codeigniter.

> É restrito apenas à sessão de usuário (`$_SESSION['user']` ou `$this->session->user`);


```php
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
```

### Métodos

- logged()

```php
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
```
Exemplo
  ```php
  if($this->guard->logged()){
    echo 'Usuário logado';
  }
  else{
    echo 'Usuário deslogado';
  }
  ```

- item()

```php
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
```

Exemplo
  ```php
$nome = $this->guard->item('nome');
echo $nome;
// Fulano da Silva
```

- login()

```php
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
```

> Percebam que nessa função é utilizado o método `validate()` do model de Usuarios. Essa função é responsável por fazer a busca através do email e da senha informados como parâmetros e retornar as tuplas referente ao usuário buscado ou false caso não encontre.

Exemplo

```php
$email = 'fulano@example.com';
$senha = '123456';

if($this->guard->login($email, $senha)){
    echo 'Bem-vindo!';
}
else{
    echo 'Credenciais inválidas';
}
```

- update()

```php
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
```

Exemplo

```php
echo $this->guard->item('nome'); // Fulano da Silva

$dados = ['id' => $id_usuario, 'nome' => 'Bernardo'];  //Seta os dados para o update

$this->Usuarios_model->update($dados); // Atualiza o nome do usuario com id = $id_usuario

echo $this->guard->item('nome'); // Fulano da Silva

$this->guard->update(); // Atualiza a sessão com os valores do banco

echo $this->guard->item('nome'); // Bernardo
```


- getShortName()
```php
    /**
     * getShortName
     *
     * @param String $nome [Nome completo do usuario]
     * @return String [Concatena o primeiro e o ultimo nome do usuario]
     */
    public function getShortName($nome = $this->user['nome']){
        $nomes = explode(" ", $nome);

        if(count($nomes) > 1)
            $nome = $nomes[0] . " " . $nomes[count($nomes)-1];        
        else
            $nome = $nomes[0];

        return $nome;
    }
```

Exemplo

```php
echo $this->guard->item('nome'); // Fulano da Silva

echo $this->guard->getShortName(); // Bernardo Camargo
```

* logout()
```php
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
```

Exemplo

```php
$this->guard->logout();
```

## Core MY_Controller
Localizado em `application/core/MY_Controller.php`

Essa classe acaba sendo mais simples, pois cada `controller` é muito específico. Contudo é no método construtor que carregamos as bibliotecas [Template](#biblioteca-template) e [Guard](#biblioteca-guard).

> **Todos** os controllers devem herdar o `MY_Controller` através da palavra chave `extends` do PHP.

```php
class MY_Controller extends CI_Controller {
    
    // médoto construtor
    public function __construct() {
        parent::__construct();
     
        // Carrega o Template e Guard
        $this->load->library( 'Template' );
        $this->load->library( 'Guard' );
    }
}
```

## Core MY_Model
Localizado em `application/core/MY_Model.php`

Essa classe é responsável por permitir a reutilização de funções que são comuns em aplicações web que utilizam SQL para manipular um banco de dados.

**Nota: O MY_Model não substitui o [Query Builder](https://www.codeigniter.com/userguide3/database/query_builder.html), então se você tem que usar alguma query complexa, não utilize o MY_Model para isso.**


```php
class MY_Model extends CI_Model {
    
    /**
    * table
    *
    * nome da tabela no model
    *
    * @protected
    */
    protected $table;

    /**
    * table_id
    *
    * chave da tabela no model
    *
    * @protected
    */
    protected $table_id;

    public function __construct() {
        parent::__construct();
    }
}
```

Basicamente a mágica acontece ao utilizar-se do conceito de herança da *Programação Orientada a Objetos*. Dessa forma os models a serem criados pelo desenvolvedor devem herdar essa classe através da palavra chave `extends`. 

O `$table`(nome da tabela) e `$table_id`(chave primária) são atributos essenciais para isso, pois ambas representam as variáveis de qualquer consulta SQL básica, dessa forma podemos reutilizar funções como create, update e delete que ja existem no CI e além disso criar algumas novas como getAll() ou getAllLimit() para todos os models básicos.

> É obrigatório a inicialização destas variáveis **em todos os models** que herdarem esta classe.


- Exemplo Model para tabela de `usuarios` cuja a chave primária é `id_usuario`

```php
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
}
```


### Métodos
- create()
 ```php
    /**
    * create
    * 
    * insere um novo dado
    *
    * @param Array $dados [Dados a serem inseridos na tabela]
    * @return Boolean [Retorna true caso os dados tenham sido inseridos e false caso contrario]
    */
    public function create( $dados ){
        return $this->db->insert( $this->table, $dados );
    }
```
Exemplo

 ```php
$this->load->model('Usuarios_model');

$dados = [
    'nome'          => 'Fulano da Silva',
    'email'         => 'fulano@example.com',
    'senha'         => '123456',
    'sexo'          => 'masculino',
    'data_nasc'     => '1996-04-03'
]; 

if($this->Usuarios_model->create($dados)){
    echo 'Usuário cadastrado com sucesso!';
}
else{
    echo 'Houve um erro no servidor.';
}

```

- update()
 ```php
   /**
    * update
    * 
    * atualiza um dado
    *
    * @param Array $dados [Dados a serem atualizados. *O campo 'id' deve ser passado obrigatoriamente]
    * @return Boolean [Retorna true caso os dados tenham sido atualizados e false caso tenha algum erro de lógica no SQL]
    */
    public function update( $dados ) {

        // prepara os dados
        $this->db->where( $this->table_id, $dados['id']);

        // deleta o id
        unset( $dados['id'] );
        if ( isset( $dados[$this->table_id] ) ) unset( $dados[$this->table_id] );

        // faz o update
        return $this->db->update($this->table, $dados); 
    }
```
> O campo `id` do array é **obrigatório**

Exemplo

```php
$this->load->model('Usuarios_model');

$dados = [
    'id'            => 1,
    'nome'          => 'Fulano da Silva',
    'email'         => 'fulano@example.com',
    'senha'         => '123456',
    'sexo'          => 'masculino',
    'data_nasc'     => '1996-04-03'
]; 

if($this->Usuarios_model->update($dados)){
    echo 'Usuário atualizado com sucesso!';
}
else{
    echo 'Houve um erro no servidor.';
}

```

> Perceba que não importa o nome da sua chave primária, o array com dados para update deve sempre conter um campo chamado `id`!

- delete()
 ```php
   /**
    * delete
    * 
    * deleta um dado
    *
    * @param mixed $id [Chave primária da tabela]
    * @return Boolean [Retorna true caso remova a linha ou false caso contrario]
    */
    public function delete( $id ) {
        $this->db->where( $this->table_id, $id );
        return $this->db->delete( $this->table ); 
    }
```

Exemplo

```php
$this->load->model('Usuarios_model');

if($this->Usuarios_model->delete(1)){
    echo 'Usuário deletado com sucesso!';
}
else{
    echo 'Houve um erro no servidor.';
}
```

- getById()
 ```php
    /**
    * getById
    * 
    * pega um dado por id
    *
    * @param  $id [Chave primária da tabela]
    * @return mixed [Retorna um array com os dados requisitados ou false caso não encontre nada]
    */
    public function getById( $id ){
        
        // faz a busca
        $this->db->select( '*' )
        ->from( $this->table )
        ->where( [$this->table_id => $id ] );
        $query = $this->db->get();

        // verifica se existem resultados
        return ( $query->num_rows() > 0 ) ? $query->result_array()[0] : false;
    }
```
Exemplo

```php
$this->load->model('Usuarios_model');

$user = $this->Usuarios_model->getById(1);

if($user){
    echo $user['nome']; //Fulano da Silva
}
else{
    echo 'Usuário não encontrado';
}
```


- getAll()
 ```php
    /**
    * getAll
    * 
    * pega todos os registros
    *
    * @param mixed $where [Opcional: Condições da consulta]
    * @param String $fields [Opcional: Campos do SELECT da consulta]
    * @param mixed $orderby [Opcional: Ordenação da consulta]
    * @return mixed [Retorna a coleção de dados requisitadas em uma matriz]
    */
    public function getAll( $where = false, $fields = '*', $orderby = false) {
        
        if($orderby){
            $orderby = explode(" ", $orderby);
            $order = $orderby[1];
            $order_colum = $orderby[0];
        }
        else{
            $order = 'asc';
            $order_colum = $this->table_id;
        }

        // monta a busca
        $this->db->select( $fields );
        $this->db->from( $this->table );

        //verifica se existe um where
        if ( $where ) $this->db->where( $where );

        $this->db->order_by($order_colum, $order);

        // pega os dados do banco
        $query = $this->db->get();

        // verifica se existem resultados
        return ( $query->num_rows() > 0 ) ? $query->result_array() : false;
    }   
```

Exemplo 1:

```php
$this->load->model('Usuarios_model');

$users = $this->Usuarios_model->getAll(); // Busca todas as tuplas da tabela `usuarios`

if($users){
    foreach ($users as $user) {
        echo $user['nome'] . '<br>';
    }
}
else{
    echo 'Usuário não encontrado';
}
```

Exemplo 2:

```php
$this->load->model('Usuarios_model');

$users = $this->Usuarios_model->getAll('sexo = masculino', 'usuarios.nome', 'nome asc'); // Será feita a consulta na tabela `usuarios` atrás das tuplas que possuem o sexo definido como masculino e retornará todos os nomes em ordem crescente.

if($users){
    foreach ($users as $user) {
        echo $user['nome'] . '<br>';
    }
}
else{
    echo 'Usuário não encontrado';
}
```


Exemplo 3:

```php
$this->load->model('Usuarios_model');

$users = $this->Usuarios_model->getAll(false, 'usuarios.nome', 'nome asc'); // Será feita a consulta na tabela `usuarios` e retornara todos os nomes dos usuarios ordenados pelo nome crescente.

if($users){
    foreach ($users as $user) {
        echo $user['nome'] . '<br>';
    }
}
else{
    echo 'Usuário não encontrado';
}
```


- getAllLimit()
 ```php
    /**
     * getAllLimit
     * 
     * @param int $limit [Inteiro que define a quantidade máxima de resultados da consulta]
     * @return Array[] [Retorna a coleção de dados requisitadas em uma matriz]    
     * 
     */
    public function getAllLimit($limit){
        $this->db->from($this->table)
        ->select('*')
        ->limit($limit);

        $busca = $this->db->get();

        return ($busca->num_rows() > 0) ? $busca->result_array() : array();

    }
```

Exemplo

```php
$this->load->model('Usuarios_model');

$users = $this->Usuarios_model->getAllLimit(5); // Será feita a consulta na tabela `usuarios` e retornará as 5 primeiras linhas.

if($users){
    foreach ($users as $user) {
        echo $user['nome'] . '<br>';
    }
}
else{
    echo 'Usuário não encontrado';
}
```

> Esta função foi feita apenas para auxiliar no desenvolvimento da aplicação, dificilmente você usará ela em produção. Deve ser utilizada quando você queira testar uma listagem de dados e possa limitar a quantidade de resultados, porém sem poder filtra-los.


## Notificações

O sistema de notificações deste template utiliza a biblioteca javascript [PNotify](https://sciactive.com/pnotify/) juntamente com a função nativa do Codeigniter [SESSION Flashdata](https://www.codeigniter.com/user_guide/libraries/sessions.html#flashdata).

O arquivo `application/views/components/alerts.php` contém a ligação entre o `PHP` e o `Javascript`:

```php
<?php if($this->session->flashdata('success')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('success', '<?php echo $this->session->flashdata('success') ?>');
        });
    </script>
<?php endif; ?>


<?php if($this->session->flashdata('error')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('error', '<?php echo $this->session->flashdata('error') ?>');
        });
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('warning')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('warning', '<?php echo $this->session->flashdata('warning') ?>');
        });
    </script>
<?php endif; ?>

<?php if($this->session->flashdata('info')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('info', '<?php echo $this->session->flashdata('info') ?>');
        });
    </script>
<?php endif; ?>


<?php if($this->session->flashdata('loading')): ?>
    <script>
        $(document).ready(function(){
            notifyUser('loading', '<?php echo $this->session->flashdata('loading') ?>');
        });
    </script>
<?php endif; ?>
```

> A função `notifyUser()` está definida em `assets/js/functions.js`

Existem duas formas de se exibir uma notificação para o usuário

* PHP

No controller, antes do `redirect()`, deve-se criar uma session flashdata com o índice definido como sendo um dos cinco tipos citados abaixo.

```php
$this->session->set_flashdata('success', 'Muito bom, sua ação foi concluída com sucesso!');
```

* Javascript

Em qualquer view basta chamar a função `notifyUser` passando como primeiro parâmetro o tipo da notificação e segundo a mensagem que desejar.

```javascript
notifyUser('success', 'Muito bom, sua ação foi concluída com sucesso!');
```

Existem cinco tipos de notificações pré-definidas: `success`, `error`, `warning`, `info` e `loading`.

* success:

Deve ser utilizada para notificações de sucesso.

* error:

Deve ser utilizada para notificações de erros ou falhas do sistema

* warning:

Deve ser utilizada para notificações de atenção ao usuário

* info:

Deve ser utilizada para dar informações extras ao usuário

* loading:

Deve ser utilizada para funções que utilizem `ajax` chamando a função `notifyUser` na `beforeSend()` para que passe para o usuário a sensação de que algo está acontecendo visto que o `ajax` é dinâmico e não é percebido pelo usuário final.


Exemplo de notificação `loading`:

```javascript
$.ajax({
    url: '/path/to/file',
    type: 'POST',
    dataType: 'json',
    data: data,
    beforeSend: function(){
        notifyUser('loading', 'Carregando informações...');
    }
})
.done(function(response) {
    PNotify.removeAll(); //Remove todas as notificações

    console.log("success");
})
.fail(function(xhr, status) {
    console.log("error");
})
.always(function() {
    console.log("complete");
});

```

* Remover as notificações ativas

Para fazer com que as notificações desapareçam basta usar a função do PNotify:

```javascript
PNotify.removeAll();
```


## Plugins JS
Localizados em `assets/vendors/`

- [animate.css](https://daneden.github.io/animate.css/)
- [animsition](https://git.blivesta.com/animsition/)
- [autosize textarea](http://www.jacklmoore.com/autosize/)
- [bootstrap-4.1.3-dist](https://getbootstrap.com.br/docs/4.1/getting-started/introduction/)
- [bootstrap-daterangepicker](http://www.daterangepicker.com/)
- [bootstrap-datetimepicker](https://eonasdan.github.io/bootstrap-datetimepicker/)
- [bootstrap-wysiwyg](https://mdbootstrap.com/plugins/jquery/wysiwyg/)(Text editor)
- [Chart.js](https://www.chartjs.org/)
- [countdown.js](http://countdownjs.org)
- [cropper](https://fengyuanchen.github.io/cropperjs/)
- [css-hamburgers](https://jonsuh.com/hamburgers/)
- [datatables.net](https://datatables.net/)
- [datatables.net-buttons](https://datatables.net/extensions/buttons)
- [datatables.net-fixedheader](https://datatables.net/extensions/fixedheader)
- [datatables.net-keytable](https://datatables.net/extensions/keytable)
- [datatables.net-responsive](https://datatables.net/extensions/responsive)
- [datatables.net-scroller](https://datatables.net/extensions/scroller)
- [DateJS](https://github.com/datejs/Datejs)
- [devbridge-autocomplete](https://github.com/devbridge/jQuery-Autocomplete)
- [dropzone](https://www.dropzonejs.com/)(Drag'n'drop files)
- [eve](http://evejs.com/)
- [fastclick](https://github.com/ftlabs/fastclick)
- [Flot](https://www.flotcharts.org/)
- [flot.curvedlines](http://curvedlines.michaelzinsmaier.de/)
- [fullcalendar](https://fullcalendar.io/)
- [gauge.js](https://bernii.github.io/gauge.js/)
- [google-code-prettify](https://github.com/google/code-prettify)
- [iCheck](http://icheck.fronteed.com/)
- [ion.rangeSlider](http://ionden.com/a/plugins/ion.rangeSlider/)
- [jquery.easy-pie-chart](https://github.com/rendro/easy-pie-chart)
- [jquery.hotkeys](https://github.com/tzuryby/jquery.hotkeys)
- [jquery.inputmask](https://github.com/RobinHerbots/Inputmask)
- [jquery.tagsinput](https://github.com/xoxco/jQuery-Tags-Input)
- [jquery-knob](http://anthonyterrien.com/demo/knob/)
- [jquery-mousewheel](https://plugins.jquery.com/mousewheel/)
- [jQuery-Smart-Wizard](https://github.com/mstratman/jQuery-Smart-Wizard)
- [jquery-sparkline](https://omnipotent.net/jquery.sparkline/)
- [jqvmap](https://github.com/10bestdesign/jqvmap)
- [kartik-v-bootstrap-fileinput](https://github.com/kartik-v/bootstrap-fileinput)
- [malihu-custom-scrollbar-plugin](https://github.com/malihu/malihu-custom-scrollbar-plugin)
- [mjolnic-bootstrap-colorpicker](https://github.com/ColorlibHQ/gentelella/tree/master/vendors/mjolnic-bootstrap-colorpicker)
- [mocha](https://github.com/mochajs/mocha)
- [moment](https://momentjs.com/)
- [morris.js](https://morrisjs.github.io/morris.js/)
- [normalize-css](https://necolas.github.io/normalize.css/)
- [nprogress](https://ricostacruz.com/nprogress/)
- [parsleyjs](https://parsleyjs.org/)
- [pdfmake](http://pdfmake.org/#/)
- [perfect-scrollbar](https://github.com/mdbootstrap/perfect-scrollbar)
- [pnotify](https://sciactive.com/pnotify/)
- [requirejs](https://requirejs.org/)
- [select2](https://select2.org/)
- [skycons](https://darkskyapp.github.io/skycons/)
- [starrr](http://dobtco.github.io/starrr/)
- [switchery](https://abpetkov.github.io/switchery/)
- [transitionize](https://github.com/abpetkov/transitionize)
- [validator](https://validatejs.org/)


## Contribuição
Desenvolvido por Bernardo Camargo [@bernacamargo](https://github.com/bernacamargo)
 

## Licença
[MIT](https://choosealicense.com/licenses/mit/)
