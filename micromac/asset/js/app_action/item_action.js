/* -------- Loading Item List------------*/

	function load_item_list(pagno)
	{

		$.ajax({
               type : "POST",
               url  : "get_item_list/"+pagno,
               type: 'get',
         		dataType: 'json',
		         success: function(response){
		         	//console.log(response)
		            $('#pagination').html(response.pagination);
		            draw_itemTable(response.result,response.row,response.sl);
         		}

            });
	}


 // Create table for Item list
     function draw_itemTable(result,sno,sl){
       sno = Number(sno);

       $('#itemlist').empty();
       //var sl = 1;
       for(index in result){
          var id = result[index].id;
          var item_name = result[index].item_name;
          var model_name = result[index].model_name;
          var brand_name = result[index].brand_name;
          var entry_date = result[index].entry_date;
          
          sno+=1;
          sl++;
          var tr = "<tr>";
          tr += "<td>"+ sl +"</td>";
          tr += "<td>"+ item_name +"</td>";
          tr += "<td>"+ model_name +"</td>";
          tr += "<td>"+ brand_name +"</td>";
          tr += "<td>"+ entry_date +"</td>";
          tr += "<td><span onclick='edit_item("+id+")' style='cursor:pointer'><i class='far fa-edit' ></i></span>&nbsp;&nbsp;<span onclick='delete_item("+id+")' style='cursor:pointer'><i class='fas fa-trash-alt'></i></span></td>";
          tr += "</tr>";
          $('#itemlist').append(tr);
 		
 		      //sl++;
        }
      }
      
      
  //----------- Delete Item ------------

    function delete_item(id)
  {
    $("#delete_item_id").val(id);
       delete_dialog.dialog( "open" );
  }

  function do_delete()
  {
    var dlt_id = $("#delete_item_id").val();
    $.ajax({
               type : "POST",
               url  : "delete_item",
               dataType : "JSON",
               data:{delete_id:dlt_id},
               async:true,
               success: function(response){

                if(response == 'OK')
                {

                  alert("Successfully Deleted!");
                  load_item_list(0);
                  delete_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to delete!");
                }


                }
            });
  }


  /* -- selecting Item_name --*/
  $(function() {
    $( "#model_name" ).selectmenu();
    $( "#brand_name" ).selectmenu();
  } );



  
   /*--  Add Item Operation --*/

   function additem()
   {
      var name = $("#item_name").val();
      var brand_id = $("#brand_name").val();
      var model_id = $("#model_name").val();

      //alert("<?php echo base_url()?>");
       $.ajax({
               type : "POST",
               url  : "save_item",
               dataType : "JSON",
               data:{item_name:name,
                     bname:brand_id,
                     mname:model_id
               },
               async:true,
               success: function(response){

                if(response == 'success')
                {
                  load_item_list(0);
                  alert("Item has been added successfully");
                  item_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to save!");
                }


                }
            });

      
   }

   // edit operation 




// loading Item info into the Modal form;
   function edit_item(id)
   {
       $.ajax({
               type : "POST",
               url  : "get_item_info_byID",
               dataType : "JSON",
               data:{sid:id},
               async:true,
               success: function(response){


                if(response.response_code == 'success')
                {
                  $("#edit_model_name").val(response.model_id);
                  $("#edit_item_name").val(response.item_name);
                  $("#edit_brand_name").val(response.brand_id);
                  $("#item_id").val(id);
                  edit_item_dialog.dialog( "open" );
                     
                }
                else
                {
                  alert("Failed to edit!");
                }


                }
            });
   }

   function do_edititem()
   {
        var edit_model_name =$("#edit_model_name").val();
        var edit_brand_name =$("#edit_brand_name").val();
        var edit_item_name =$("#edit_item_name").val();
        
        var item_id = $("#item_id").val();

        $.ajax({
               type : "POST",
               url  : "update_item_info",
               dataType : "JSON",
               data:{sname:edit_item_name,bname:edit_brand_name,mname:edit_model_name,edit_id:item_id},
               async:true,
               success: function(response){

                if(response == 'success')
                {
                  load_item_list(0);
                  alert("Item has been updated successfully");
                  edit_item_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to Update!");
                }


                }
            });
   }