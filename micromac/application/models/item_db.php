<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_db extends CI_Model
{

	function __construct()
	{

		parent::__construct();

		$this->load->database();

	}

	function update_item_info()
	{

	  	$edit_item_name = trim($this->input->post('sname'));
	  	$edit_brand_name = trim($this->input->post('bname'));
	  	$edit_model_name = trim($this->input->post('mname'));
		$edit_id = trim($this->input->post('edit_id'));

		$data = array(
			'brand_id'=>$edit_brand_name,
			'model_id'=>$edit_model_name,
			'name'=>$edit_item_name
		);

		$this->db->update('items',$data,array('id'=>$edit_id));

		 if($this->db->affected_rows()>0)
		 {
		 	return "success";
		 }
		 else
		 {
		 	return "fail";
		 }
	}
	function get_item_list()
	{
		$this->db->select("*");
		$this->db->from("items");

		$result = $this->db->get()->result();

		if(count($result)>0)
		{
			return $result;
		}

	}

	function add_item()
	{
		$item_name = trim($this->input->post('item_name'));
		$brand_id = trim($this->input->post('bname'));
		$model_id = trim($this->input->post('mname'));
		//date_default_timezone_set('Asia/Dhaka');
		$entry_date =  date('Y-m-d H:i:s');
		$data = array(
			'brand_id'=>$brand_id,
			'model_id'=>$model_id,
			'name'=>$item_name,
			'entry_date'=>$entry_date
		);

		$this->db->insert('items',$data);

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
	// Select total records for Items
	  public function get_item_getrecordCount()
	  {

		    $this->db->select('count(*) as allcount');
		    $this->db->from('items');
		    $query = $this->db->get();
		    $result = $query->result_array();
		 
		    return $result[0]['allcount'];
	  }
	  // Get Items Records to be shown in the table/grid;

	  	function get_item($rowno,$rowperpage)
		{
			$this->db->select('i.id,i.name item_name,m.name model_name,b.name brand_name,i.entry_date');
		    $this->db->from('items i');
		    $this->db->join("brand b","i.brand_id=b.id","left");
		    $this->db->join("models m","i.model_id=m.id","left");
		    $this->db->order_by("i.entry_date", "desc");
		    $this->db->limit($rowperpage, $rowno);  
		    $query = $this->db->get();
		 
		    return $query->result();
		}

		 function delete_item()
	  	{
		  	$delete_id = trim($this->input->post('delete_id'));

		  	$this->db->delete('items',array('id'=>$delete_id));

		  	if($this->db->affected_rows()>0)
		  	{
		  		return "OK";
		  	}
		  	else
		  	{
		  		"Fail";
		  	}
	  	}

		function get_item_data()
	   {
		  	$item_id = trim($this->input->post('sid'));

		  	$this->db->select("*");
		  	$this->db->from("items");
		  	$this->db->where("id",$item_id);

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