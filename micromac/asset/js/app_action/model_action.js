/* -------- Loading Model List------------*/

  function load_model_list(pagno)
  {

    $.ajax({
               type : "POST",
               url  : "get_model_list/"+pagno,
               type: 'get',
            dataType: 'json',
             success: function(response){
              //console.log(response)
                $('#pagination').html(response.pagination);
                draw_modelTable(response.result,response.row,response.sl);
            }

            });
  }


 // Create table for Model list
     function draw_modelTable(result,sno,sl){
       sno = Number(sno);

       $('#modellist').empty();
       //var sl = 1;
        for(index in result){
          var id = result[index].id;
          var brand_name = result[index].brand_name;
          var model_name = result[index].model_name;
          var entry_date = result[index].entry_date;
          
          sno+=1;
          sl++;
          var tr = "<tr>";
          tr += "<td>"+ sl +"</td>";
          tr += "<td>"+ model_name +"</td>";
          tr += "<td>"+ brand_name +"</td>";
          tr += "<td>"+ entry_date +"</td>";
          tr += "<td><span onclick='edit_model("+id+")' style='cursor:pointer'><i class='far fa-edit' ></i></span>&nbsp;&nbsp;<span onclick='delete_model("+id+")' style='cursor:pointer'><i class='fas fa-trash-alt'></i></span></td>";
          tr += "</tr>";
          $('#modellist').append(tr);
    
          //sl++;
        }
      }
  //----------- Delete Model Info ------------

  function delete_model(id)
  {
    $("#delete_model_id").val(id);
       delete_dialog.dialog( "open" );
  }

  function do_delete()
  {
    var dlt_id = $("#delete_model_id").val();
    $.ajax({
               type : "POST",
               url  : "delete_model",
               dataType : "JSON",
               data:{delete_id:dlt_id},
               async:true,
               success: function(response){

                if(response == 'OK')
                {

                  alert("Successfully Deleted!");
                  load_model_list(0);
                  delete_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to delete!");
                }


                }
            });
  }


  /* -- selecting brand_name --*/
  $(function() {
    $( "#brand_name" ).selectmenu();
  } );



  
   /*--  Add Model Operation --*/

   function addmodel()
   {
      var name = $("#model_name").val();
      var brand_id = $("#brand_name").val();

      //alert("<?php echo base_url()?>");
       $.ajax({
               type : "POST",
               url  : "save_model",
               dataType : "JSON",
               data:{model_name:name,
                     bname:brand_id
               },
               async:true,
               success: function(response){

                if(response == 'success')
                {
                  load_model_list(0);
                  alert("Model has been added successfully");
                  model_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to save!");
                }


                }
            });

      
   }

   // edit operation 




// loading Model info into the Modal form;
   function edit_model(id)
   {
       $.ajax({
               type : "POST",
               url  : "get_model_info_byID",
               dataType : "JSON",
               data:{sid:id},
               async:true,
               success: function(response){


                if(response.response_code == 'success')
                {
                  $("#edit_model_name").val(response.model_name);
                  $("#edit_brand_name").val(response.brand_id);
                  $("#model_id").val(id);
                  edit_model_dialog.dialog( "open" );
                     
                }
                else
                {
                  alert("Failed to edit!");
                }


                }
            });
   }

   function do_editmodel()
   {
        var edit_model_name =$("#edit_model_name").val();
        var edit_brand_name =$("#edit_brand_name").val();
        
        var model_id = $("#model_id").val();

        $.ajax({
               type : "POST",
               url  : "update_model_info",
               dataType : "JSON",
               data:{sname:edit_model_name,bname:edit_brand_name,edit_id:model_id},
               async:true,
               success: function(response){

                if(response == 'success')
                {
                  load_model_list(0);
                  alert("Model has been updated successfully");
                  edit_model_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to Update!");
                }


                }
            });
   }