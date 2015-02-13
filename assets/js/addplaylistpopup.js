(function($){

	 $("#createOverlay").hide();

	  $("#createplaylist").click(function(){
      $("#createOverlay").fadeIn("fast");
      $("#createOverlay").show();
    });

	$("#cancel").click(function(){
    $("#createOverlay").fadeOut("fast");
    $("#createOverlay").hide();
  });
  

    $("#cancelren").click(function(){
      $("#renameOverlay").fadeOut("fast");
      $("#renameOverlay").hide();
    });
	
	
})(jQuery);