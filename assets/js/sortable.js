// Jquery function for order fields
// When the page is loaded define the current order and items to reorder
$(document).ready( function(){
/* Call the container items to reorder fields */
  $( function() {
    $( "#sortable-objatts" ).sortable({
			update: function(event, ui) {
				var list = $(this).sortable( 'serialize');
				$.post( 'attributes.php?op=order', list );
			},
			receive: function(event, ui) {
				var list = $(this).sortable( 'serialize');                    
				$.post( 'attributes.php?op=order', list );                      
			}
		});
    $( "#sortable-objatts" ).disableSelection();
    $( "#sortable-costs" ).sortable({
			update: function(event, ui) {
				var list = $(this).sortable( 'serialize');
				$.post( 'costs.php?op=order', list );
			},
			receive: function(event, ui) {
				var list = $(this).sortable( 'serialize');                    
				$.post( 'costs.php?op=order', list );                      
			}
		});
    $( "#sortable-costs" ).disableSelection();
    $( "#sortable-attdefs" ).sortable({
			update: function(event, ui) {
				var list = $(this).sortable( 'serialize');
				$.post( 'attdefaults.php?op=order', list );
			},
			receive: function(event, ui) {
				var list = $(this).sortable( 'serialize');                    
				$.post( 'attdefaults.php?op=order', list );                      
			}
		});
    $( "#sortable-attdefs" ).disableSelection();
    $( "#sortable-images" ).sortable({
			update: function(event, ui) {
				var list = $(this).sortable( 'serialize');
				$.post( 'images.php?op=order', list );
			},
			receive: function(event, ui) {
				var list = $(this).sortable( 'serialize');                    
				$.post( 'images.php?op=order', list );                      
			}
		});
    $( "#sortable-images" ).disableSelection();
    $( "#sortable-attcats" ).sortable({
			update: function(event, ui) {
				var list = $(this).sortable( 'serialize');
				$.post( 'attcategories.php?op=order', list );
			},
			receive: function(event, ui) {
				var list = $(this).sortable( 'serialize');                    
				$.post( 'attcategories.php?op=order', list );                      
			}
		});
    $( "#sortable-attcats" ).disableSelection();
	$( "#sortable-files" ).sortable({
			update: function(event, ui) {
				var list = $(this).sortable( 'serialize');
				$.post( 'files.php?op=order', list );
			},
			receive: function(event, ui) {
				var list = $(this).sortable( 'serialize');                    
				$.post( 'files.php?op=order', list );                      
			}
		});
    $( "#sortable-files" ).disableSelection();
  } );
});