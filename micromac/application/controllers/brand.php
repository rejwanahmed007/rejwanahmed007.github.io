<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
	function __construct()
	{

		parent::__construct();

		
		$this->load->model("brand_db");
		$this->load->library("pagination");

	}
	
	public function index()
	{
		
		redirect('brand/brandlist');

	}
	public function brandlist()
	{
		
		$this->load->view('brand_view');

	}
	function save_brand()
	{
		$result = $this->brand_db->add_brand();

		echo json_encode($result);
	}
	function update_brand_info()
	{
		$result = $this->brand_db->update_brand_info();

		echo json_encode($result);
	}

	
	
	function get_brand_list($rowno=0)
	{
		// Row per page
	    $rowperpage = 5;

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
	 
	    // All records count
	    $total_count = $this->brand_db->get_brand_getrecordCount();

	    // Get records
	    $brand_data = $this->brand_db->get_brand($rowno,$rowperpage);
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'brand/get_brand_list';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $total_count;
	    $config['per_page'] = $rowperpage;

	    // Initialize
	    $this->pagination->initialize($config);

	    // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $brand_data;
	    $data['row'] = $total_count;
	    $data['sl'] = $rowno;


	    echo json_encode($data);


		
	}

	//single brand info

	function get_brand_info_byID()
	{
		$data = $this->brand_db->get_brand_data();

		if($data !='')
		{
			$response_data = array(
				'response_code'=>'success',
				'id'=>$data->id,
				'brand_name'=>$data->name,
				'entry_date'=>$data->entry_date,
				
			);

			
		}
		else
		{
			$response_data = array(
				'response_code'=>'fail'
			);
		}

		echo json_encode($response_data);
	}
	function delete_brand()
	{
		$result = $this->brand_db->delete_brand();

		echo json_encode($result);
	}

}
