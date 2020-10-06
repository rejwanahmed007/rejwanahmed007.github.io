// Add  Modal window settigns


   model_dialog = $( "#add_model_form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 750,
      modal: true,
      buttons: {
        "Add": addmodel
      },
      close: function() {
        form1[ 0 ].reset();
      }
    });

   form1 = model_dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      addmodel();
    });

  /* -- Modal Pop-up  --*/
  
   $( "#add_model_button" ).button().on( "click", function() {
      model_dialog.dialog( "open" );
    });


//preparing Edit Brand Modal;

      edit_model_dialog = $( "#edit_model_form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 750,
      modal: true,
      buttons: {
        "Update": do_editmodel
      },
      close: function() {
        form2[ 0 ].reset();
      }
    });


     form2 = edit_model_dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      do_editmodel();
    });


    
  //Initiating Delete Popup/Modal;

   delete_dialog =$( "#delete_model" ).dialog({
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