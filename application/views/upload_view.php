<html>

<head>
<!-- Generic page styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
</head>

<div class="wrapper" style="height:500px">
  <div class="container centered" style="top:20%; transform:translateY(-50%); min-width:800px">
    <!-- Upload Form -->
    <div class="centered" style="width:240px; top: 300px;">
      <div class="signup_wrap centered">   
      <p><legend>Upload your song here!</legend></p>
      <?php echo form_open_multipart('user/do_uploadaudio');?> 
      <form>      
          <label for="audio_title">Title</label>
          <input type="text" id="audio_title" style="height:12px"; name="audio_title" maxlength="256" value="<?php echo set_value('audio_title'); ?>" required/>
          
          <label for="audio_genre">Genre</label>
          <select name="audio_genre" id="audio_genre">
            <option selected="selected" id="audio_genre" name="audio_genre">Select Genre</option>
            <option>Alternative</option>
            <option>Classical</option>
            <option>Country</option>
			      <option>EDM</option>
			      <option>Jazz</option>
			      <option>Pop</option>
			      <option>Rock</option>
          </select>
       	<tr>
      	 <td>Upload Audio</td>
                <br/>
                <label class="upload-img-button" style="display:block; float:left; margin-top:10px">
                  <input type="file" name="user_new_photo" accept="audio/mp3, audio/wav" id="audio_file">
                  Select audio file
                </label>         
    	  </tr>        
        <tr>    
            <div class="" style="position:relative; margin-top:20px; margin-bottom:50px">
              <input name="submit" class="btn btn-default" style="width: 120px" type="submit" value="Submit" />
            </div>   
        </tr>
      </table>
      </form>
      </div>
    </div>
      
  <p><?php echo validation_errors('<p class="error">'); ?></p>

  </div>
</div>

<?php echo form_close(); ?>
<script type="text/javascript">
  
  $("input[name='userfile']").each(function() {
    var fileName = $(this).val().split('/').pop().split('\\').pop();
    console.log(fileName);
});

</script>

