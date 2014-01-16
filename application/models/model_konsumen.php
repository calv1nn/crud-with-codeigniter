<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_konsumen extends CI_Model {
	
	private $konsumen= 'konsumen';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($konsumen);
	}
	
	function count_all(){
		return $this->db->count_all($this->konsumen);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->konsumen, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->konsumen);
	}
	
	function save($konsumen){
		$this->db->insert($this->konsumen, $konsumen);
		return $this->db->insert_id();
	}
	
	function update($id, $konsumen){
		$this->db->where('id', $id);
		$this->db->update($this->konsumen, $konsumen);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->konsumen);
	}
	public function check_login($uname,$pass)
	{
		$this->db->where(array('uname'=>$uname, 'pass'=>$pass));
		$query=$this->db->get('users');
		if($query->num_rows()>0) return true; else return false;
	}
}
?>
