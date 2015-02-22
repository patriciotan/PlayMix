<head>
<!-- Generic page styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css">
<!-- blueimp Gallery styles -->
</head>

<div class="wrapper" style="height:500px; margin-top:-20px">
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
            <div style="position:relative;">  
              <br/>

              <input type="file" id="audio_file" name="audio_file" accept="audio/mp3, audio/wav" id="audio_file" style="display:inline; position:absolute; margin-top:15px; margin-left:47px" required/>    
              <label class="upload-img-button" for="audio_file" style="position:absolute; margin-top:5px; width:90px">                  
              Select audio file
              </label>     
              <br/>

              <!-- <input type="file" id="audio_photo" name="audio_photo" accept="image/jpeg, image/png" id="audio_photo" style="display:inline; position:absolute; margin-top:40px; margin-left:47px;"  required/>    
              <label class="upload-img-button" for="audio_photo" style="position:absolute; margin-top:30px;width:90px">                  
              Select photo
              </label>  -->                  

              <!-- <div id="img_container" style="float:left; width:100px;height:100px; margin-top:80px; overflow:hidden">
                <img class="img_profile" id="cur_audio_photo" src="<?php echo base_url();?>assets/default.png"/>
              </div>    -->           

              <div class="centered" style="margin-top:50px;">
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

<script>
$(document).ready(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#cur_audio_photo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#audio_photo").change(function(){
        readURL(this);
    });
});    
</script>