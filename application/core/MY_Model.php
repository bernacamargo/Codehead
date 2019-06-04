<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * MY_Model
 *
 * Classe criada para facilitar as consultas SQL utilizando 
 * o query builder do Codeigniter.
 * 
 * @author Bernardo Pinheiro Camargo
 * @since 2019
 */
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

   /**
	* delete
	* 
	* deleta um dado
	*
	* @param Any $id [Chave primária da tabela]
	* @return Boolean [Retorna true caso remova a linha ou false caso contrario]
	*/
	public function delete( $id ) {
		$this->db->where( $this->table_id, $id );
		return $this->db->delete( $this->table ); 
	}

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

	/**
	* getAll
	* 
	* pega todos os registros
	*
	* @param mixed $where [Opcional: Condições da consulta]
	* @param String $fields [Opcional: Campos do SELECT da consulta]
	* @param mixed $orderby [Opcional: Ordenação da consulta]
	* @return mixed [Retorna a coleção de dados requisitadas em uma matriz ou false caso não encontre nada]
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

    /**
     * count
     *
     * @return Integrer [Retorna a quantidade de registros resultantes]
     */
    public function count($where){

    	$this->db->from($this->table)
    	->select('*')
    	->where($where);

    	$busca = $this->db->get();

    	return $busca->num_rows();
    }

	/**
	* table
	* 
	* pega a tabela atual
	* 
	*/
	public function table() {
		return $this->table;
	}

    /**
	* table_id
	* 
	* pega o id da tabela atual
	* 
	*/
	public function table_id() {
		return $this->table_id;
	}

}

/* end of file */