// Add Brand Modal window settigns


   brand_dialog = $( "#add_brand_form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 750,
      modal: true,
      buttons: {
        "Add Brand": addbrand
      },
      close: function() {
        form1[ 0 ].reset();
      }
    });

   form1 = brand_dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addbrand();
    });

  /* -- Modal Pop-up  --*/
  
   $( "#add_brand_button" ).button().on( "click", function() {
      brand_dialog.dialog( "open" );
    });


//preparing Edit Brand Modal;

      edit_brand_dialog = $( "#edit_brand_form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 750,
      modal: true,
      buttons: {
        "Update": do_editbrand
      },
      close: function() {
        form2[ 0 ].reset();
      }
    });


     form2 = edit_brand_dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      do_editbrand();
    });


    
  //Initiating Delete Popup/Modal;

   delete_dialog =$( "#delete_brand" ).dialog({
    autoOpen: false,
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "OK": do_delete,
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });