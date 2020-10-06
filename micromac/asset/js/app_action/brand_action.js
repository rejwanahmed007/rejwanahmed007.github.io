/* -------- Loading Brand List------------*/

  function load_brand_list(pagno)
  {

    $.ajax({
               type : "POST",
               url  : "get_brand_list/"+pagno,
               type: 'get',
            dataType: 'json',
             success: function(response){
              //console.log(response)
                $('#pagination').html(response.pagination);
                draw_brandTable(response.result,response.row,response.sl);
            }

            });
  }


 // Create table for Brand list
     function draw_brandTable(result,sno,sl){
       sno = Number(sno);

       $('#brandlist').empty();
       //var sl = 1;
        for(index in result){
          var id = result[index].id;
          var brand_name = result[index].name;
          var entry_date = result[index].entry_date;
          
          sno+=1;
          sl++;
          var tr = "<tr>";
          tr += "<td>"+ sl +"</td>";
          tr += "<td>"+ brand_name +"</td>";
          tr += "<td>"+ entry_date +"</td>";
          tr += "<td><span onclick='edit_brand("+id+")' style='cursor:pointer'><i class='far fa-edit' ></i></span>&nbsp;&nbsp;<span onclick='delete_brand("+id+")' style='cursor:pointer'><i class='fas fa-trash-alt'></i></span></td>";
          tr += "</tr>";
          $('#brandlist').append(tr);
    
          //sl++;
        }
      }
      //onclick='edit_brand("+id+")'
      //onclick='delete_brand("+id+")'
  //----------- Delete Item ------------

  function delete_brand(id)
  {
    $("#delete_brand_id").val(id);
       delete_dialog.dialog( "open" );
  }

  function do_delete()
  {
    var dlt_id = $("#delete_brand_id").val();
    $.ajax({
               type : "POST",
               url  : "delete_brand",
               dataType : "JSON",
               data:{delete_id:dlt_id},
               async:true,
               success: function(response){

                if(response == 'OK')
                {

                  alert("Successfully Deleted!");
                  load_brand_list(0);
                  delete_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to delete!");
                }


                }
            });
  }

/* -------- End :: Loading Student Item ---------*/
  /* -- Menu item --*/
  $(function() {
    $( "#section" ).selectmenu();
  } );



  
   /*--  Add Brand Operation --*/

   function addbrand()
   {
      var name = $("#brand_name").val();

      //alert("<?php echo base_url()?>");
       $.ajax({
               type : "POST",
               url  : "save_brand",
               dataType : "JSON",
               data:{brand_name:name},
               async:true,
               success: function(response){

                if(response == 'success')
                {
                  load_brand_list(0);
                  alert("Brand has been added successfully");
                  brand_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to save!");
                }


                }
            });

      
   }

   // edit operation 





   function edit_brand(id)
   {
       $.ajax({
               type : "POST",
               url  : "get_brand_info_byID",
               dataType : "JSON",
               data:{sid:id},
               async:true,
               success: function(response){


                if(response.response_code == 'success')
                {
                  $("#edit_brand_name").val(response.brand_name);
                  $("#brand_id").val(id);
                  edit_brand_dialog.dialog( "open" );
                     
                }
                else
                {
                  alert("Failed to edit!");
                }


                }
            });
   }

   function do_editbrand()
   {
        var edit_brand_name =$("#edit_brand_name").val();
        
        var brand_id = $("#brand_id").val();

        $.ajax({
               type : "POST",
               url  : "update_brand_info",
               dataType : "JSON",
               data:{sname:edit_brand_name,edit_id:brand_id},
               async:true,
               success: function(response){

                if(response == 'success')
                {
                  load_brand_list(0);
                  alert("Brand has been updated successfully");
                  edit_brand_dialog.dialog( "close" );
                     
                }
                else
                {
                  alert("Failed to Update!");
                }


                }
            });
   }