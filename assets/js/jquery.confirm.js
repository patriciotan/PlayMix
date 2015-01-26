(function($){

	 $("#confirmOverlay").hide();

	  $("#add2playlist").click(function(){
     // $("#notificationContainer").fadeToggle(300);
     // $("#notification_count").fadeOut("slow");
      $("#confirmOverlay").fadeIn("fast");
      $("#confirmOverlay").show();
      //$("#popup-dialog").fadeIn("fast");
    });

	$("#cancel").click(function(){
    $("#confirmOverlay").fadeOut("fast");
    $("#confirmOverlay").hide();
    });
	
	
})(jQuery);