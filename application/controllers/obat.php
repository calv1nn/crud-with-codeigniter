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
		if($this->session->userdata('admin',TRUE) or $this->session->userdata('manager',TRUE) ){
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
			if ($this->session->userdata('admin',TRUE)) {
			$this->table->add_row($obat->id, $obat->nama, $obat->golongan, $obat->stok, $obat->harga ,
				anchor('obat/view/'.$obat->id,'view',array('class'=>'view')).' '.
				anchor('obat/update/'.$obat->id,'update',array('class'=>'update')).' '.
				anchor('obat/buy/'.$obat->id,'buy',array('class'=>'buy','onclick'=>"return confirm('Are you sure want to buy this Obat?')"))
			);
			}else if ($this->session->userdata('manager',TRUE))
				{
					//echo "2";die;
					$this->table->add_row($obat->id, $obat->nama, $obat->golongan, $obat->stok, $obat->harga ,
							anchor('obat/view/'.$obat->id,'view',array('class'=>'view'))
					);
				}
		}
		
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
			//print_r($config);die;
// 			$_FILES['userfile']['name'] = $_POST['userfile'];
// 			$_FILES['userfile']['tmp_name'] = $_POST['userfile'];
// 			move_uploaded_file($_FILES['userfile']['tmp_name'], "uploads/".$_POST['userfile']);
			//echo $_POST['userfile']['tmp_name'];die;
			$this->load->library('upload', $config);
			
			 if (!$this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				//redirect('obat/addobat'); 
				//echo "GAGAL";
				//echo "1";die;
				$data['message'] = "gagal";
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
		$data['title'] = 'Update Obat';
		$data['message'] = 'Kolom dengan * harus diisi';
		$data['action'] = site_url('obat/updateobat');
		$data['link_back'] = anchor('obat/index/','Back to list of obat',array('class'=>'back'));
	
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
			//echo "1";die;
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
			//echo "2";die;
			$this->Model_obat->update($id,$obat);
			
			// set user message
			$data['message'] = '<div class="success">update obat success</div>';
		}
		
		// load view
		$this->load->view('EditObat', $data);
	}
	
	function buy($id)
	{
		date_default_timezone_set('UTC');
		// set common properties
	
		$data['title'] = 'Obat Details';
		$data['link_back'] = anchor('obat/index/','Back to list of Obat',array('class'=>'back'));
		
		// get obat details
		$data['obat'] = $this->Model_obat->get_by_id($id)->row();
		
		// load view
		$this->load->view('BuyObat', $data);
	}
	
	function buyobat()
	{
		date_default_timezone_set('UTC');
		// set common properties
		$data['title'] = 'Add new Obat';
		$data['action'] = site_url('obat/buyobat');
		$data['link_back'] = anchor('obat/index/','Back to list of Obat',array('class'=>'back'));
		
		$this->form_validation->set_rules('buy', 'buy', 'numerik|required');
		$id = $this->input->post('id');
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = 'Gagal';
			
		}
		else
		{
			$total = $this->input->post('harga')*$this->input->post('buy');
			if ($this->input->post('stok') > $this->input->post('buy')) 
			{
				$buy=array('id_obat' => $this->input->post('id'),
							'jumlah' => $this->input->post('buy'),	
					'total_harga' => $total);
				$stok1 = $this->input->post('stok')-$this->input->post('buy');
				$stok= array('stok'=>$stok1);
				//echo $stok;die;
				$this->Model_obat->insert($id,$stok,$buy);
				$data['message'] = 'Berhasil';
				//echo "3";die;
			} else 
			{
				$data['message'] = 'Stok Kurang CUk';
			}
			
		}
	
		// load view
		$id = $this->input->post('id');
		//print_r($id);die;
		$data['obat'] = $this->Model_obat->get_by_id($id)->row();
		$this->load->view('BuyObat', $data);
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
		//$this->form_validation->set_rules('id', 'ID', 'trim|required');
		$this->form_validation->set_rules('nama', 'Name', 'trim|required');
		$this->form_validation->set_rules('golongan', 'golongan', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');
		//$this->form_validation->set_rules('gambar', 'gambar', 'required');
		//$this->form_validation->set_rules('buy', 'buy', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}
	
	
	
}
?>
