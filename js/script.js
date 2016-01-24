(function( $ ) {
	// Inside of this function, $() will work as an alias for jQuery ()
	// and other libraries also using $ will not be accessible under this shortcut
	$( document ).ready(function() {
		$("#sort").click(function() {
			$('#outbox').tablesorter( {sortlist: [[2], [1,0]]} );
		});
		$("#namesort").click(function() {
			$('#outbox').tablesorter( {sortlist: [[0], [1,0]]} );
		});
		$(".inbox").click(function(){
			$("#outbox").css("display", "none")
			$("#inbox").css("display", "table");
			$(".del").css("display", "block");
			$(".message").css("display", "block");
		});
		$(".outbox").click(function(){
			$("#outbox").css("display", "table")
			$("#inbox").css("display", "none");
			$(".del").css("display", "none");
			$(".message").css("display", "none");
		})
	});
} )( jQuery );