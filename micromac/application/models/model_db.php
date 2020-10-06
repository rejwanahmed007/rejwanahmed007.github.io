<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_db extends CI_Model
{

	function __construct()
	{

		parent::__construct();

		$this->load->database();

	}
	function update_model_info()
	{

	  	$edit_model_name = trim($this->input->post('sname'));
	  	$edit_brand_name = trim($this->input->post('bname'));
		$edit_id = trim($this->input->post('edit_id'));

		$data = array(
			'brand_id'=>$edit_brand_name,
			'name'=>$edit_model_name
		);

		$this->db->update('models',$data,array('id'=>$edit_id));

		 if($this->db->affected_rows()>0)
		 {
		 	return "success";
		 }
		 else
		 {
		 	return "fail";
		 }
	}
	function get_model_list()
	{
		$this->db->select("*");
		$this->db->from("models");
		$this->db->order_by("models.name", "asc");
		$result = $this->db->get()->result();

		if(count($result)>0)
		{
			return $result;
		}

	}

	function add_model()
	{
		$model_name = trim($this->input->post('model_name'));
		$brand_id = trim($this->input->post('bname'));
		//date_default_timezone_set('Asia/Dhaka');
		$entry_date =  date('Y-m-d H:i:s');
		$data = array(
			'brand_id'=>$brand_id,
			'name'=>$model_name,
			'entry_date'=>$entry_date
		);

		$this->db->insert('models',$data);

		 //$id = $this->db->insert_id();

		 if($this->db->affected_rows()>0)
		 {
		 	return "success";
		 }
		 else
		 {
		 	return "fail";
		 }
	}

	// Select total records for Model
	  public function get_model_getrecordCount()
	  {

		    $this->db->select('count(*) as allcount');
		    $this->db->from('models');
		    $query = $this->db->get();
		    $result = $query->result_array();
		 
		    return $result[0]['allcount'];
	  }
	  // Get Models Records to be shown in the table/grid;

	  	function get_model($rowno,$rowperpage)
		{
			$this->db->select('m.id,m.name model_name,b.name brand_name,m.entry_date');
		    $this->db->from('models m');
		    $this->db->join("brand b","m.brand_id=b.id","left");
		    $this->db->order_by("m.entry_date", "asc");
		    $this->db->limit($rowperpage, $rowno);  
		    $query = $this->db->get();
		 
		    return $query->result();

		}
		 function delete_model()
	  	{
		  	$delete_id = trim($this->input->post('delete_id'));

		  	$this->db->delete('models',array('id'=>$delete_id));

		  	if($this->db->affected_rows()>0)
		  	{
		  		return "OK";
		  	}
		  	else
		  	{
		  		"Fail";
		  	}
	  	}

		function get_model_data()
	   {
		  	$model_id = trim($this->input->post('sid'));

		  	$this->db->select("*");
		  	$this->db->from("models");
		  	$this->db->where("id",$model_id);

		  	$query = $this->db->get();

		  	$result = $query->row();

		  	if(is_object($result))
		  	{
		  		return $result;
		  	}
		  	else
		  	{
		  		return '';
		  	}
	  	}
}