<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_db extends CI_Model
{

	function __construct()
	{

		parent::__construct();

		$this->load->database();

	}
	function get_brand_list()
	{
		$this->db->select("*");
		$this->db->from("brand");
		$this->db->order_by("brand.name", "asc");
		$result = $this->db->get()->result();

		if(count($result)>0)
		{
			return $result;
		}

	}
	function update_brand_info()
	{

	  	$edit_brand_name = trim($this->input->post('sname'));
		$edit_id = trim($this->input->post('edit_id'));

		$data = array(
			'name'=>$edit_brand_name
		);

		$this->db->update('brand',$data,array('id'=>$edit_id));

		 if($this->db->affected_rows()>0)
		 {
		 	return "success";
		 }
		 else
		 {
		 	return "fail";
		 }
	}

	function add_brand()
	{
		$brand_name = trim($this->input->post('brand_name'));
		//date_default_timezone_set('Asia/Dhaka');
		$entry_date =  date('Y-m-d H:i:s');
		$data = array(
			'name'=>$brand_name,
			'entry_date'=>$entry_date
		);

		$this->db->insert('brand',$data);

		 $id = $this->db->insert_id();

		 if($id>0)
		 {
		 	return "success";
		 }
		 else
		 {
		 	return "fail";
		 }
	}

	// Select total records for Brand
	  public function get_brand_getrecordCount()
	  {

		    $this->db->select('count(*) as allcount');
		    $this->db->from('brand');
		    $query = $this->db->get();
		    $result = $query->result_array();
		 
		    return $result[0]['allcount'];
	  }
	  // Get Brand Records to be shown in the table/grid;

	  	function get_brand($rowno,$rowperpage)
		{
			$this->db->select('*');
		    $this->db->from('brand');
		    $this->db->order_by("brand.entry_date", "desc");
		    $this->db->limit($rowperpage, $rowno);  
		    $query = $this->db->get();
		 
		    return $query->result();
		}
		 function delete_brand()
	  	{
		  	$delete_id = trim($this->input->post('delete_id'));

		  	$this->db->delete('brand',array('id'=>$delete_id));

		  	if($this->db->affected_rows()>0)
		  	{
		  		return "OK";
		  	}
		  	else
		  	{
		  		"Fail";
		  	}
	  	}

		function get_brand_data()
	   {
		  	$brand_id = trim($this->input->post('sid'));

		  	$this->db->select("*");
		  	$this->db->from("brand");
		  	$this->db->where("id",$brand_id);

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