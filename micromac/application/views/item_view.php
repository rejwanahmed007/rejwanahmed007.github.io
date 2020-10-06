<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Item List</title>
	<link rel="stylesheet" href="<?php echo base_url();?>asset/jquery_ui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url();?>asset/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>asset/css/navbar.css">
	<link rel="stylesheet" href="<?php echo base_url();?>asset/css/button.css">
    <script src="<?php echo base_url();?>asset/jquery/jquery-3.4.1.min.js"></script>
	<script src="<?php echo base_url();?>asset/jquery_ui/jquery-ui.min.js"></script>
	

</head>
<body>

	<?php
	$this->load->view("menu");
	?>
	<h1>Item List</h1>

<table border="1" cellspacing="5" cellpadding="10" style="border-collapse: collapse;">
	<thead>
	<tr>
		<td>SL</td>
		<td>Item</td>
		<td>Model Name</td>
		<td>Brand Name</td>
		<td>Entry Date</td>
		<td>Action</td>
	</tr>
	</thead>
	<tbody id="itemlist"></tbody>
</table>
	<!-- Paginate -->
	  <div style='margin-top: 10px;' id='pagination'></div>
	 <button id="add_item_button" class="button button1">Add Item</button>

	 <!-- Add Item Form -->
	<div id="add_item_form" title="Add Item">
		
		<form>
			<fieldset>
				<div>
					<label for="nb">Fields marked with * are mandatory</label>
				</div>
				<div>
					<label>------------------------------------------------</label>
				</div>
				<div>
					<label for="brand_name">Brand *</label>
					<select name="brand_name" id="brand_name">
			            <option>---Select Brand---</option>
			            <?php
			            foreach($brand_name as $s)
			            {
			            ?>
			            <option value="<?php echo $s->id;?>"><?php echo $s->name ?></option>
			            <?php
			            }
			            ?>
          			</select>
				</div>
				<div>
					<label for="model_name">Model *</label>
					<select name="model_name" id="model_name">
			            <option>---Select Model---</option>
			            <?php
			            foreach($model_name as $s)
			            {
			            ?>
			            <option value="<?php echo $s->id;?>"><?php echo $s->name ?></option>
			            <?php
			            }
			            ?>
          			</select>
				</div>
				<div style="margin-top: 10px;">
					<label for="item_name">Item Name *</label>
					<input type="text" name="item_name" id="item_name" value="" style="margin-left: 30px;" class="text ui-widget-content ui-corner-all">
				</div>
				<!-- Allow form submission with keyboard without duplicating the dialog button -->
				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>
	<!-- Edit Item Form -->
	<div id="edit_item_form" title="Edit Item">
		
		<form>
			<fieldset>
				<div>
					<label for="nb">Fields marked with * are mandatory</label>
				</div>
				<div>
					<label>------------------------------------------------</label>
				</div>
				<div>
					<label for="edit_brand_name">Brand *</label>
					<select name="edit_brand_name" id="edit_brand_name">
			            <option>---Select Brand---</option>
			            <?php
			            foreach($brand_name as $s)
			            {
			            ?>
			            <option value="<?php echo $s->id;?>"><?php echo $s->name ?></option>
			            <?php
			            }
			            ?>
          			</select>
				</div>
				<div>
					<label for="edit_model_name">Item *</label>
					<select name="edit_model_name" id="edit_model_name">
			            <option>---Select Model---</option>
			            <?php
			            foreach($model_name as $s)
			            {
			            ?>
			            <option value="<?php echo $s->id;?>"><?php echo $s->name ?></option>
			            <?php
			            }
			            ?>
          			</select>
				</div>
				<div style="margin-top: 10px;">
					<label for="edit_item_name">Model Name *</label>
					<input type="text" name="edit_item_name" id="edit_item_name" value="" style="margin-left: 30px;" class="text ui-widget-content ui-corner-all">
				</div>
				<!-- Allow form submission with keyboard without duplicating the dialog button -->
        		<input type="hidden" name="item_id" id="item_id" value="0">

				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
			</fieldset>
		</form>
	</div>
	 <!-- Delete  Item Modal/Window -->
  	<div id="delete_item" title="Delete Item Info">
	    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span><h3>Are You sure to delete the selected item?</h5> </p>
	    <input type="hidden" id="delete_item_id" value="0">
  	</div>

</body>

 <script>

  	$(document).ready(function(){

  		 // Detect pagination click
     $('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pagination-page');
       load_item_list(pageno);
     });

  		load_item_list(0);

  	});

</script>

<script src="<?php echo base_url();?>asset/js/app_action/item_action.js"></script>
<script src="<?php echo base_url();?>asset/js/jqueryui_init/item_modal.js"></script>
</html>
