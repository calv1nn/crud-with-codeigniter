<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Konsumen extends CI_Controller {

	// num of records per page
	private $limit = 10;
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Model_konsumen','',TRUE);
	}
	
	function index($offset = 0)
	{
		date_default_timezone_set('UTC');
		// offset
		if($this->session->userdata('login_valid')){
			$this->load->model('model_konsumen');
			$data['uname']=$this->session->userdata('uname');
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$konsumens = $this->Model_konsumen->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('konsumen/index/');
 		$config['total_rows'] = $this->Model_konsumen->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Nama', 'Jenis Kelamin', 'Tanggal Lahir (dd-mm-yyyy)', 'Actions');
		$i = 0 + $offset;
		foreach ($konsumens as $konsumen)
		{
			$this->table->add_row(++$i, $konsumen->name, strtoupper($konsumen->gender)=='M'? 'Pria':'Perempuan', date('d-m-Y',strtotime($konsumen->dob)), 
				anchor('konsumen/view/'.$konsumen->id,'view',array('class'=>'view')).' '.
				anchor('konsumen/update/'.$konsumen->id,'update',array('class'=>'update')).' '.
				anchor('konsumen/delete/'.$konsumen->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Customer?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$this->load->view('ListKonsumen', $data);
	
		}else{
			redirect("konsumen/login");
		}
	}
	
	function add()
	{
		date_default_timezone_set('UTC');
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new Customer';
		$data['message'] = 'Kolom dengan * harus diisi';
		$data['action'] = site_url('konsumen/addKonsumen');
		$data['link_back'] = anchor('konsumen/index/','Back to list of Customer',array('class'=>'back'));
	
		// load view
		$this->load->view('EditKonsumen', $data);
	}
	
	function addKonsumen()
	{
		date_default_timezone_set('UTC');
		// set common properties
		$data['title'] = 'Add new Costomer';
		$data['action'] = site_url('konsumen/addKonsumen');
		$data['link_back'] = anchor('konsumen/index/','Back to list of customer',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$konsumen = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$id = $this->Model_konsumen->save($konsumen);
			
			// set user message
			$data['message'] = '<div class="success">add new customer success</div>';
		}
		
		// load view
		$this->load->view('EditKonsumen', $data);
	}
	
	function view($id)
	{
		date_default_timezone_set('UTC');
		// set common properties
		if($this->session->userdata('login_valid')){
		$this->load->model('model_konsumen');
		$data['uname']=$this->session->userdata('uname');
		$data['title'] = 'Customer Details';
		$data['link_back'] = anchor('konsumen/index/','Back to list of customer',array('class'=>'back'));
		
		// get konsumen details
		$data['konsumen'] = $this->Model_konsumen->get_by_id($id)->row();
		
		// load view
		$this->load->view('ViewKonsumen', $data);
		}else{
			redirect("konsumen/login");
		}
	}
	
	function update($id)
	{
		date_default_timezone_set('UTC');
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$konsumen = $this->Model_konsumen->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->name = $konsumen->name;
		$this->form_data->gender = strtoupper($konsumen->gender);
		$this->form_data->dob = date('d-m-Y',strtotime($konsumen->dob));
		
		// set common properties
		$data['title'] = 'Update Costumer';
		$data['message'] = 'Kolom dengan * harus diisi';
		$data['action'] = site_url('konsumen/updateKonsumen');
		$data['link_back'] = anchor('konsumen/index/','Back to list of costumer',array('class'=>'back'));
	
		// load view
		$this->load->view('EditKonsumen', $data);
	}
	
	function updateKonsumen()
	{
		date_default_timezone_set('UTC');
		// set common properties
		$data['title'] = 'Update Konsumen';
		$data['action'] = site_url('konsumen/updateKonsumen');
		$data['link_back'] = anchor('konsumen/index/','Back to list of Customer',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('id');
			$konsumen = array('name' => $this->input->post('name'),
							'gender' => $this->input->post('gender'),
							'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
			$this->Model_konsumen->update($id,$konsumen);
			
			// set user message
			$data['message'] = '<div class="success">update konsumen success</div>';
		}
		
		// load view
		$this->load->view('EditKonsumen', $data);
	}
	
	function delete($id)
	{
		// delete konsumen
		$this->Model_konsumen->delete($id);
		
		// redirect to konsumen list page
		redirect('konsumen/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->name = '';
		$this->form_data->gender = '';
		$this->form_data->dob = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'DoB', 'trim|required|callback_valid_date');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_message('valid_date', 'date format is not valid. dd-mm-yyyy');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	// date_validation callback
	function valid_date($str)
	{
		//match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $str, $parts))
		{
			//check weather the date is valid of not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	public function menu()
	{
		$this->load->view('menu');
	}
	
	public function login()
	{
		$this->load->view('ViewLogin');
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		$this->load->view('ViewLogin');
	}

	//check login validation
	public function check_login()
	{
		$this->load->model('model_konsumen');
		$uname=$this->input->post("uname");
		$pass=$this->input->post("pass");
		if($this->Model_konsumen->check_login($uname,$pass))
		{	$this->session->set_userdata('login_valid',true);
			$this->session->set_userdata('uname',$uname);
			redirect("konsumen/menu");
		}
		else
			redirect("konsumen/login");
	}
}
?>
