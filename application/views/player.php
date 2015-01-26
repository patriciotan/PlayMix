<div class="navbar navbar-fixed-bottom" style="width:740px; left:50%; margin-left:-375px;">
  <div class="navbar-inner" style="background-color:#363636; height:100px;">
  	<div class="row-fluid">

	  	<div id="imageDiv" class="span2" style="padding-left:5px; padding-top:5px;">
	  		<img id="audioPic" src="<?php echo base_url(); ?>assets/playmix_logo.png" height="90px;">
	  	</div>
	    
	    <div id="controlsDiv" class="span10">
    		<div id="titleDiv" style="margin-left:-23px; margin-top:5px; margin-right:17px;">
    			<div id="left1" class="pull-left">
	    			<h2 id="title" style="display:inline"></h2>
	    			<h1 id="songId" style="display:none"></h1>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h6 id="divider" style="display:inline"></h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<h3 id="artist" style="display:inline"></h3>
				</div>
				<div id="right1" class="pull-right" style="margin-top:2px;">
					<input id="share" type="image" src="<?php echo base_url(); ?>assets/controls/share.png" style="height:25px; width:25px;" alt="share"/>&nbsp;&nbsp;
					<a id="download" href="" download><img src="<?php echo base_url(); ?>assets/controls/download.png" height="22px;" width="22px;"></a>
				</div>
    		</div>

		    <div id="audioDiv" class="pull-right" style="width:650px; margin-top:-5px;">
		      <audio id="audio" controls preload="none" style="width:100%;">
		      	<source id="audioSrc" src="" type="audio/mp3">
		      	<code>Your browser does not support the audio element!</code>
		      </audio>
		    </div>

		    <div id="contDiv" style="margin-left:-22px; margin-right:15px;">
		    	<div id="left2" class="pull-left">
					<input id="previous" onclick="prevSong()" type="image" src="<?php echo base_url(); ?>assets/controls/previous.png" style="height:22px; width:22px;" alt="previous"/>&nbsp;&nbsp;
					<input id="stop" onclick="stopSong()" type="image" src="<?php echo base_url(); ?>assets/controls/stop.png" style="height:22px; width:22px;" alt="stop"/>&nbsp;&nbsp;
					<input id="next" onclick="nextSong()" type="image" src="<?php echo base_url(); ?>assets/controls/next.png" style="height:22px; width:22px;" alt="next"/>
		    	</div>
		    	<div id="right2" class="pull-right">
					<input id="shuffle" type="image" src="<?php echo base_url(); ?>assets/controls/shuffle.png" style="height:24px; width:24px;" alt="shuffle"/>&nbsp;&nbsp;
					<input id="repeat" type="image" src="<?php echo base_url(); ?>assets/controls/repeat.png" style="height:24px; width:24px;" alt="repeat"/>
		    	</div>
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
		var title = document.getElementById("title");
		var songId = document.getElementById("songId");
		var divider = document.getElementById("divider");
		var artist = document.getElementById("artist");
		var audioSrc = document.getElementById("audioSrc");
		var audioPic = document.getElementById("audioPic");
		var download = document.getElementById("download");

		var fileSrc = "<?php echo base_url(); ?>uploads/mp3/";
		var picSrc = "<?php echo base_url(); ?>uploads/audio_pics/";

		var file = node.parentNode.parentNode.cells[0].textContent;
		var pic = node.parentNode.parentNode.cells[1].textContent;
		var id = node.parentNode.parentNode.cells[2].textContent;
		title.innerHTML = node.parentNode.parentNode.cells[6].textContent;
		artist.innerHTML = node.parentNode.parentNode.cells[7].textContent;

		var bullet="";
		bullet += "&#9679;";
		divider.innerHTML = bullet;
		songId.innerHTML = id;
		audioSrc.src = fileSrc.concat(file);
		audioPic.src = picSrc.concat(pic);
		download.href = fileSrc.concat(file);

		audio.load();
		audio.play();
	}

	function prevSong()
	{
		var audio = document.getElementById("audio");
		var title = document.getElementById("title");
		var songId = document.getElementById("songId");
		var divider = document.getElementById("divider");
		var artist = document.getElementById("artist");
		var audioSrc = document.getElementById("audioSrc");
		var audioPic = document.getElementById("audioPic");
		var sId = document.getElementById("songId");
		var download = document.getElementById("download");

		var fileSrc = "<?php echo base_url(); ?>uploads/mp3/";
		var picSrc = "<?php echo base_url(); ?>uploads/audio_pics/";
		var curId = sId.innerHTML;

		var file = $("#"+curId).prev().children().eq(0).text();
		var pic = $("#"+curId).prev().children().eq(1).text();
		var id = $("#"+curId).prev().children().eq(2).text();
		title.innerHTML = $("#"+curId).prev().children().eq(6).text();
		artist.innerHTML = $("#"+curId).prev().children().eq(7).text();

		var bullet="";
		bullet += "&#9679;";
		divider.innerHTML = bullet;
		songId.innerHTML = id;
		audioSrc.src = fileSrc.concat(file);
		audioPic.src = picSrc.concat(pic);
		download.href = fileSrc.concat(file);

		audio.load();
		audio.play();
	}

	function nextSong()
	{
		var audio = document.getElementById("audio");
		var title = document.getElementById("title");
		var songId = document.getElementById("songId");
		var divider = document.getElementById("divider");
		var artist = document.getElementById("artist");
		var audioSrc = document.getElementById("audioSrc");
		var audioPic = document.getElementById("audioPic");
		var sId = document.getElementById("songId");
		var download = document.getElementById("download");

		var fileSrc = "<?php echo base_url(); ?>uploads/mp3/";
		var picSrc = "<?php echo base_url(); ?>uploads/audio_pics/";
		var curId = sId.innerHTML;

		var file = $("#"+curId).next().children().eq(0).text();
		var pic = $("#"+curId).next().children().eq(1).text();
		var id = $("#"+curId).next().children().eq(2).text();
		title.innerHTML = $("#"+curId).next().children().eq(6).text();
		artist.innerHTML = $("#"+curId).next().children().eq(7).text();

		var bullet="";
		bullet += "&#9679;";
		divider.innerHTML = bullet;
		songId.innerHTML = id;
		audioSrc.src = fileSrc.concat(file);
		audioPic.src = picSrc.concat(pic);
		download.href = fileSrc.concat(file);

		audio.load();
		audio.play();
	}

	function stopSong()
	{
		var audio = document.getElementById("audio");
		audio.load();
	}

	function downloadSong()
	{
		var audioSrc = document.getElementById("audioSrc");
		var title = document.getElementById("title");

		var data = audioSrc.src;
		var name = title.innerHTML;

		alert("You cannot download "+name+" from "+data+"! Never!");

		//pass data and name to downloadSong() in user controller
	}

</script>

</html>