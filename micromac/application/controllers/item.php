<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
	function __construct()
	{

		parent::__construct();

		
		$this->load->model("item_db");
		$this->load->model("brand_db");
		$this->load->model("model_db");
		$this->load->library("pagination");

	}
	
	public function index()
	{
		
		redirect('item/itemlist');

	}
	public function itemlist()
	{
		$brand_name = $this->brand_db->get_brand_list();
		$model_name = $this->model_db->get_model_list();
		$data = array(
			'brand_name'=>$brand_name,
			'model_name'=>$model_name
		);
		
		$this->load->view('item_view',$data);

	}
	function save_item()
	{
		$result = $this->item_db->add_item();

		echo json_encode($result);
	}
	function update_item_info()
	{
		$result = $this->item_db->update_item_info();

		echo json_encode($result);
	}
	
	function get_item_list($rowno=0)
	{
		// Row per page
	    $rowperpage = 5;

	    // Row position
	    if($rowno != 0){
	      $rowno = ($rowno-1) * $rowperpage;
	    }
	 
	    // All records count
	    $total_count = $this->item_db->get_item_getrecordCount();

	    // Get records
	    $item_data = $this->item_db->get_item($rowno,$rowperpage);
	 
	    // Pagination Configuration
	    $config['base_url'] = base_url().'item/get_item_list';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = $total_count;
	    $config['per_page'] = $rowperpage;

	    // Initialize
	    $this->pagination->initialize($config);

	    // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $item_data;
	    $data['row'] = $total_count;
	    $data['sl'] = $rowno;


	    echo json_encode($data);


		
	}

	//single item info

	function get_item_info_byID()
	{
		$data = $this->item_db->get_item_data();

		if($data !='')
		{
			$response_data = array(
				'response_code'=>'success',
				'model_id'=>$data->model_id,
				'brand_id'=>$data->brand_id,
				'item_name'=>$data->name,
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
	function delete_item()
	{
		$result = $this->item_db->delete_item();

		echo json_encode($result);
	}

}
