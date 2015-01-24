<div class="navbar navbar-fixed-bottom" style="width:750px; left:50%; margin-left:-375px;">
  <div class="navbar-inner" style="background-color:#363636;">
    <div id="audioDiv">
      <audio id="audio" controls preload="none" style="width:750px; margin-top:7px;">
      	<source id="audioSrc" src="" type="audio/mp3">
      	<code>Your browser does not support the audio element!</code>
      </audio>
    </div>
  </div>
</div>



<script type="text/javascript">

	function playSong(node)
	{
		var audio = document.getElementById("audio");
		var source = "<?php echo base_url(); ?>uploads/mp3/";
		var file = node.parentNode.parentNode.cells[0].textContent;
		source = source.concat(file);
		audioSrc.src = source.concat(".mp3");
		audio.load();
		audio.play();
	}

</script>
</body>
</html>