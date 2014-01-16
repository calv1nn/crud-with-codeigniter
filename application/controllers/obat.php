<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obat extends CI_Controller {

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
		$this->load->model('Model_obat','',TRUE);
	}
	
	function index($offset = 0)
	{
		date_default_timezone_set('UTC');
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$obats = $this->Model_obat->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('obat/index/');
 		$config['total_rows'] = $this->Model_obat->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('ID', 'Nama', 'Golongan', 'Stok', 'Harga', 'Actions');
		$i = 0 + $offset;
		foreach ($obats as $obat)
		{
			$this->table->add_row($obat->id, $obat->nama, $obat->golongan, $obat->stok, $obat->harga ,
				anchor('obat/view/'.$obat->id,'view',array('class'=>'view')).' '.
				anchor('obat/update/'.$obat->id,'update',array('class'=>'update')).' '.
				anchor('obat/delete/'.$obat->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this Obat?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$this->load->view('ListObat', $data);
	}
	
	function add()
	{
		date_default_timezone_set('UTC');
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new Obat';
		$data['message'] = 'Kolom dengan * harus diisi';
		$data['action'] = site_url('obat/addobat');
		$data['link_back'] = anchor('obat/index/','Back to list of Obat',array('class'=>'back'));
	
		// load view
		$this->load->view('EditObat', $data);
	}
	
	function addobat()
	{
		date_default_timezone_set('UTC');
		// set common properties
		$data['title'] = 'Add new Obat';
		$data['action'] = site_url('obat/addobat');
		$data['link_back'] = anchor('obat/index/','Back to list of Obat',array('class'=>'back'));
		
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
			//------added for upload picture
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '10240';
			$config['max_height']  = '7680';
			
// 			$_FILES['userfile']['name'] = $_POST['userfile'];
// 			$_FILES['userfile']['tmp_name'] = $_POST['userfile'];
// 			move_uploaded_file($_FILES['userfile']['tmp_name'], "uploads/".$_POST['userfile']);
			//echo $_POST['userfile']['tmp_name'];die;
			$this->load->library('upload', $config);
			
			 if ( ! $this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_errors());
				//redirect('obat/addobat'); 
				//echo "GAGAL";
			}
			else
			{ 
				$data = $this->upload->data();
				//$this->users->insert_user($uname,$pass,$jk,$agm,$data['file_name']);
			
				$obat = array('nama' => $this->input->post('nama'),
						'golongan' => $this->input->post('golongan'),
						'stok' => $this->input->post('stok'),
						'gambar' => $data['file_name'],
						'harga' => $this->input->post('harga')
				);
				$id = $this->Model_obat->save($obat);
			
			// set user message
			$data['message'] = '<div class="success">add new Obat success</div>';
			}
		}
		
		// load view
		$this->load->view('EditObat', $data);
	}
	
	function view($id)
	{
		date_default_timezone_set('UTC');
		// set common properties
	
		$data['title'] = 'Obat Details';
		$data['link_back'] = anchor('obat/index/','Back to list of Obat',array('class'=>'back'));
		
		// get obat details
		$data['obat'] = $this->Model_obat->get_by_id($id)->row();
		
		// load view
		$this->load->view('ViewObat', $data);
		
	}
	
	function update($id)
	{
		date_default_timezone_set('UTC');
		// set validation properties
		$this->_set_rules();
		
		// prefill form values
		$obat = $this->Model_obat->get_by_id($id)->row();
		$this->form_data->id = $id;
		$this->form_data->nama = $obat->nama;
		$this->form_data->golongan = $obat->golongan;
		$this->form_data->stok = $obat->stok;
		$this->form_data->gambar = $obat->gambar;
		$this->form_data->harga = $obat->harga;
		
		// set common properties
		$data['title'] = 'Update Costumer';
		$data['message'] = 'Kolom dengan * harus diisi';
		$data['action'] = site_url('obat/updateobat');
		$data['link_back'] = anchor('obat/index/','Back to list of costumer',array('class'=>'back'));
	
		// load view
		$this->load->view('EditObat', $data);
	}
	
	function updateobat()
	{
		date_default_timezone_set('UTC');
		// set common properties
		$data['title'] = 'Update obat';
		$data['action'] = site_url('obat/updateobat');
		$data['link_back'] = anchor('obat/index/','Back to list of obats',array('class'=>'back'));
		
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
			$obat = array('nama' => $this->input->post('nama'),
							'golongan' => $this->input->post('golongan'),
					'stok' => $this->input->post('stok'),
					'gambar' => $this->input->post('gambar'),	
					'harga' => $this->input->post('harga')
			);
			$this->Model_obat->update($id,$obat);
			
			// set user message
			$data['message'] = '<div class="success">update obat success</div>';
		}
		
		// load view
		$this->load->view('EditObat', $data);
	}
	
	function delete($id)
	{
		// delete obat
		$this->Model_obat->delete($id);
		
		// redirect to obat list page
		redirect('obat/index/','refresh');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->nama = '';
		$this->form_data->golongan = '';
		$this->form_data->stok = '';
		$this->form_data->gambar = '';
		$this->form_data->harga = '';
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('nama', 'Name', 'trim|required');
		$this->form_validation->set_rules('golongan', 'golongan', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');
		//$this->form_validation->set_rules('gambar', 'gambar', 'trim|required');
		$this->form_validation->set_rules('harga', 'gambar', 'trim|required');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	
}
?>
