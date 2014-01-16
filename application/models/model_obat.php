<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_obat extends CI_Model {
	
	private $obat= 'obat';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($obat);
	}
	
	function count_all(){
		return $this->db->count_all($this->obat);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->obat, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->obat);
	}
	
	function save($obat){
		$this->db->insert($this->obat, $obat);
		return $this->db->insert_id();
	}
	
	function update($id, $obat){
		$this->db->where('id', $id);
		$this->db->update($this->obat, $obat);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->obat);
	}
}
?>
