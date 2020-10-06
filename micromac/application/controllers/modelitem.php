<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelitem extends CI_Controller {
	function __construct()
	{

		parent::__construct();

		
		$this->load->model("model_db");
		$this->load->model("brand_db");
		$this->load->library("pagination");

	}
	
	public function index()
	{
		
		redirect('modelitem/modellist');

	}
	public function modellist()
	{
		$data['brand_name'] = $this->brand_db->get_brand_list();
		$this->load->view('model_view',$data);

	}
	function save_model()
	{
		$result = $this->model_db->add_model();

		echo json_encode($result);
	}
	function update_model_info()
	{
		$result = $this->model_db->update_model_info();

		echo json_encode($result);
	}

	
	
	function get_model_list($rowno=0)
	{
		// Row per page
	    $rowperpage = 5;

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
	 
	    // All records count
	    $total_count = $this->model_db->get_model_getrecordCount();

	    // Get records
	    $model_data = $this->model_db->get_model($rowno,$rowperpage);
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'modelitem/get_model_list';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $total_count;
	    $config['per_page'] = $rowperpage;

	    // Initialize
	    $this->pagination->initialize($config);

	    // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $model_data;
	    $data['row'] = $total_count;
	    $data['sl'] = $rowno;


	    echo json_encode($data);


		
	}

	//single model info

	function get_model_info_byID()
	{
		$data = $this->model_db->get_model_data();

		if($data !='')
		{
			$response_data = array(
				'response_code'=>'success',
				'model_id'=>$data->id,
				'brand_id'=>$data->brand_id,
				'model_name'=>$data->name,
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
	function delete_model()
	{
		$result = $this->model_db->delete_model();

		echo json_encode($result);
	}

}
