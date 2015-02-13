

<div style="display:none">
	<table id="shuffleTable">
		<tr id="shuffleRow"></tr>
	</table>
</div>

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
					<a id="download" href="" download><img src="<?php echo base_url(); ?>assets/controls/download.png" height="21px;" width="21px;"></a>
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
					<input id="previous" onclick="prevSong()" type="image" src="<?php echo base_url(); ?>assets/controls/previous.png" style="height:21px; width:21px;" alt="previous"/>&nbsp;&nbsp;
					<input id="stop" onclick="stopSong()" type="image" src="<?php echo base_url(); ?>assets/controls/stop.png" style="height:21px; width:21px;" alt="stop"/>&nbsp;&nbsp;
					<input id="next" onclick="nextSong()" type="image" src="<?php echo base_url(); ?>assets/controls/next.png" style="height:21px; width:21px;" alt="next"/>
		    	</div>
		    	<div id="right2" class="pull-right">
					<input id="shuffle" onclick="shuffle()" type="image" src="<?php echo base_url(); ?>assets/controls/shuffle.png" style="height:25px; width:25px;" alt="shuffle"/>&nbsp;&nbsp;
					<input id="repeat" onclick="switchRepeat()" type="image" src="<?php echo base_url(); ?>assets/controls/repeat.png" style="height:25px; width:25px;" alt="repeat"/>
		    		<h1 id="repeatSwitch" hidden>off</h1><h1 id="shuffleSwitch" hidden>off</h1>
		    	</div>
		    </div>
	    </div>

    </div>
  </div>
</div>



<script type="text/javascript">

	var audio = document.getElementById("audio");
	var repeatSwitch = document.getElementById("repeatSwitch");
	var shuffleSwitch = document.getElementById("shuffleSwitch");
	
	audio.onended = function() {
		var sId = $("#songId").text();
		increment_play(sId);
		auto_next();
	    
	};

	function increment_play(sId)
	{
		$.ajax({
			url: '<?php echo base_url('index.php/user/increment_play')?>',
			type:'POST',
			data:{'sId':sId},
			success:function(){
			},  
				error : function(e) {  
				alert('Error: ' + e);   
			}
		});
	}

	function auto_next()
	{
		var audio = document.getElementById("audio");
		var repeatSwitch = document.getElementById("repeatSwitch");
		var shuffleSwitch = document.getElementById("shuffleSwitch");

		if(repeatSwitch.innerHTML === "one")
	    {
	    	audio.play();
	    }
	    else
	    {
	    	if(shuffleSwitch.innerHTML === "on")
	    		nextShuffleSong();
	    	else
	    		nextSong();
	    }
	}

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
		var shuffleSwitch = document.getElementById("shuffleSwitch");
		if(shuffleSwitch.innerHTML === "on")
			prevShuffleSong();
		else
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

			var prevv = $("#"+curId).prev().children();
			var songTitle = prevv.eq(6).text();
			if(songTitle != "")
			{
				var file = prevv.eq(0).text();
				var pic = prevv.eq(1).text();
				var id = prevv.eq(2).text();
				title.innerHTML = songTitle;
				artist.innerHTML = prevv.eq(7).text();

				var bullet="";
				bullet += "&#9679;";
				divider.innerHTML = bullet;
				songId.innerHTML = id;
				audioSrc.src = fileSrc.concat(file);
				audioPic.src = picSrc.concat(pic);
				download.href = fileSrc.concat(file);
			}

			audio.load();
			audio.play();
		}
	}

	function prevShuffleSong()
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
		var shuffleRow = document.getElementById("shuffleRow");

		var fileSrc = "<?php echo base_url(); ?>uploads/mp3/";
		var picSrc = "<?php echo base_url(); ?>uploads/audio_pics/";
		var curId = sId.innerHTML;

		var row = $("#"+curId).index();
		var curOrder = $("#"+row).text();
		var first = $("#"+row).parent().children().first().text();
		if(curOrder === first)
			var prevOrder = $("#"+row).parent().children().last().text();
		else
			var prevOrder = $("#"+row).prev().text();
		// alert(prevOrder);
		var prevRow = $("#"+curId).parent().children();
		var prevv = prevRow.eq(prevOrder).children();
		var songTitle = prevv.eq(6).text();
		// alert(songTitle);

		var file = prevv.eq(0).text();
		var pic = prevv.eq(1).text();
		var id = prevv.eq(2).text();
		title.innerHTML = songTitle;
		// alert(title.innerHTML);
		artist.innerHTML = prevv.eq(7).text();

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
		var repeatSwitch = document.getElementById("repeatSwitch");
		var shuffleSwitch = document.getElementById("shuffleSwitch");
		if(repeatSwitch.innerHTML != "one" && shuffleSwitch.innerHTML === "on")
			nextShuffleSong();
		else
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

			var nextt = $("#"+curId).next().children();
			var songTitle = nextt.eq(6).text();

			if(songTitle === "")
			{
				if(repeatSwitch.innerHTML === "all")
				{
					nextt = $("#"+curId).parent().children().eq(0).children();
				
					var file = nextt.eq(0).text();
					var pic = nextt.eq(1).text();
					var id = nextt.eq(2).text();
					title.innerHTML = nextt.eq(6).text();
					artist.innerHTML = nextt.eq(7).text();

					var bullet="";
					bullet += "&#9679;";
					divider.innerHTML = bullet;
					songId.innerHTML = id;
					audioSrc.src = fileSrc.concat(file);
					audioPic.src = picSrc.concat(pic);
					download.href = fileSrc.concat(file);
				}
			}	
			else
			{
				if(repeatSwitch.innerHTML != "one")
				{
					var file = nextt.eq(0).text();
					var pic = nextt.eq(1).text();
					var id = nextt.eq(2).text();
					title.innerHTML = nextt.eq(6).text();
					artist.innerHTML = nextt.eq(7).text();

					var bullet="";
					bullet += "&#9679;";
					divider.innerHTML = bullet;
					songId.innerHTML = id;
					audioSrc.src = fileSrc.concat(file);
					audioPic.src = picSrc.concat(pic);
					download.href = fileSrc.concat(file);
				}
			}

			audio.load();
			audio.play();
		}
	}

	function nextShuffleSong()
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
		var shuffleRow = document.getElementById("shuffleRow");

		var fileSrc = "<?php echo base_url(); ?>uploads/mp3/";
		var picSrc = "<?php echo base_url(); ?>uploads/audio_pics/";
		var curId = sId.innerHTML;

		var row = $("#"+curId).index();
		var curOrder = $("#"+row).text();
		var last = $("#"+row).parent().children().last().text();
		if(curOrder === last)
			var nextOrder = $("#"+row).parent().children().last().text();
		else
			var nextOrder = $("#"+row).prev().text();
		// alert(nextOrder);
		var nextRow = $("#"+curId).parent().children();
		var nextt = nextRow.eq(nextOrder).children();
		var songTitle = nextt.eq(6).text();
		// alert(songTitle);

		var file = nextt.eq(0).text();
		var pic = nextt.eq(1).text();
		var id = nextt.eq(2).text();
		title.innerHTML = songTitle;
		// alert(title.innerHTML);
		artist.innerHTML = nextt.eq(7).text();

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
		audio.pause();
		$("#audio").prop("currentTime",0);
	}

	function switchRepeat()
	{
		var repeatSwitch = document.getElementById("repeatSwitch");
		
		if(repeatSwitch.innerHTML === "off"){
			repeatSwitch.innerHTML = "one";
			alert("repeat "+repeatSwitch.innerHTML);
		}
		else if(repeatSwitch.innerHTML === "one"){
			repeatSwitch.innerHTML = "all";
			alert("repeat "+repeatSwitch.innerHTML);
		}
		else{
			repeatSwitch.innerHTML = "off";
			alert("repeat "+repeatSwitch.innerHTML);
		}
	}

	function shuffle()
	{
		var shuffleSwitch = document.getElementById("shuffleSwitch");

		if(shuffleSwitch.innerHTML === "off"){
			shuffleSwitch.innerHTML = "on";
			alert("shuffle "+shuffleSwitch.innerHTML);
		}
		else{
			shuffleSwitch.innerHTML = "off";
			alert("shuffle "+shuffleSwitch.innerHTML);
		}

		var table = document.getElementById("mytable");
		var count = table.rows.length;
		// alert(count);
		$.ajax({
			url: '<?php echo base_url('index.php/user/shuffle_songs')?>',
			type: 'POST',
			data: {'count':count},
			success:function(data){
				var x = data.toString();
				// alert("asdsd");
				var order = x.split("%");
				if(data!="")
				{
					// alert("not empty!");
					for(var i=0;i<count; i++)
					{
						$("#shuffleRow").append("<td id="+order[i]+">"+order[i]+"</td>");
					}
				}
			   	
			},  
			    error : function(e) {  
			    alert('Error: ' + e);   
			}
		});
	}

</script>
</body>
</html>