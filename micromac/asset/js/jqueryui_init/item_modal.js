// Add Modal window settigns


   item_dialog = $( "#add_item_form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 750,
      modal: true,
      buttons: {
        "Add": additem
      },
      close: function() {
        form1[ 0 ].reset();
      }
    });

   form1 = item_dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      additem();
    });

  /* -- Modal Pop-up  --*/
  
   $( "#add_item_button" ).button().on( "click", function() {
      item_dialog.dialog( "open" );
    });


//preparing Edit Brand Modal;

      edit_item_dialog = $( "#edit_item_form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 750,
      modal: true,
      buttons: {
        "Update": do_edititem
      },
      close: function() {
        form2[ 0 ].reset();
      }
    });


     form2 = edit_item_dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      do_edititem();
    });


    
  //Initiating Delete Popup/Modal;

   delete_dialog =$( "#delete_item" ).dialog({
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