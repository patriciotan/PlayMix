<div class="navbar navbar-fixed-bottom" style="width:750px; left:50%; margin-left:-375px;">
  <div class="navbar-inner" style="background-color:#363636; height:100px;">
  	<div class="row-fluid">

	  	<div id="imageDiv" class="span3">
	  		
	  	</div>
	    
	    <div id="controlsDiv" class="span9">
		    <div id="audioDiv" class="pull-right" style="width:650px; top50%; margin-top:40px;">
		      <audio id="audio" controls preload="none" style="width:650px;">
		      	<source id="audioSrc" src="" type="audio/mp3">
		      	<code>Your browser does not support the audio element!</code>
		      </audio>
		    </div>
	    </div>

    </div>
  </div>
</div>

</body>

<script type="text/javascript">

	function playSong(node)
	{
		var audio = document.getElementById("audio");
		var source = "<?php echo base_url(); ?>uploads/mp3/";
		var file = node.parentNode.parentNode.cells[0].textContent;
		source = source.concat(file);
		audioSrc.src = source;
		audio.load();
		audio.play();
	}

</script>

</html>