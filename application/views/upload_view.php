<head>
<!-- Generic page styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
</head>

<div class="wrapper" style="height:500px">
  <div class="container centered" style="top:14%; transform:translateY(-50%); min-width:800px">
    <!-- Upload Form -->
    <div class="centered" style="width:240px; top: 300px;">
      <div class="signup_wrap centered">   
      <p><legend>Upload your song here!</legend></p>
      <?php echo form_open_multipart('user/addAudio');?> <!--at this point you were gonna grab the data and put them back in case of error uploading-->
      <form class="dropzone dz-clickable">      
          <label for="audio_title">Title</label>
          <input type="text" id="audio_title" style="height:12px"; name="audio_title" maxlength="256" value="<?php echo set_value('audio_title'); ?>" required/>
          
          <label for="audio_genre">Genre</label>
          <input type="text" style="margin-bottom:5px;" list="audio_genre_list" name="audio_genre" id="audio_genre" required/>
          <datalist id="audio_genre_list">
            <option selected="selected" id="audio_genre" name="audio_genre"></option>
            <option>Alternative</option>
            <option>Classical</option>
            <option>Country</option>
      			<option>EDM</option>
      			<option>Jazz</option>
      			<option>Pop</option>
      			<option>Rock</option>
            <option>Hardcore</option>
            <option>Metal</option>
            <option>Soul</option>
            <option>House</option>
            <option>Trance</option>
            <option>Hip-Hop</option>
            <option>Other</option>
          </datalist>
          
          <div>      	                 
            <div style="position:relative">  
              <br/>
              <input type="file" id="audio_file" name="audio_file" accept="audio/mp3, audio/wav" id="audio_file" style="display:inline; position:absolute; margin-top:15px; margin-left:43px;" required/>    
              <label class="upload-img-button" for="audio_file" style="position:absolute; margin-top:5px">                  
              Select audio file
              </label>     
              <div class="centered" style="margin-top:55px;">
                <input type="checkbox" name="audio_private" id="audio_private">Make this private</br>
              </div>
    	      </div>
          </div>
          <div class="" style="position:relative; margin-top:30px; margin-bottom:50px; margin-left:50px">
            <input name="submit" class="btn btn-default" style="width: 120px" type="submit" value="Submit" />
          </div>   

      </form>
      </div>
    </div> 
  </div>
</div>

<?php echo form_close(); ?>
<script type="text/javascript">
  
  $("input[name='userfile']").each(function() {
    var fileName = $(this).val().split('/').pop().split('\\').pop();
    console.log(fileName);
});


Dropzone.options.audio_file = {
  paramName: "audio_file", // The name that will be used to transfer the file
  maxFilesize: 50, // MB
  accept: function(file, done) {
    if (file.name == "justinbieber.jpg") {
      done("Naha, you don't.");
    }
    else { done(); } //just for the lols
  }
};

  $(function(){

    var dropzone = new Dropzone("#audio_file");
    dropzone.on("addedfile", function(file)){  

    });
  })

</script>

