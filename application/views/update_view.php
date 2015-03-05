<head>
<!-- Generic page styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style1.css">
<!-- blueimp Gallery styles -->
</head>

<div class="wrapper" style="height:500px; margin-top:-20px">
  <div class="container centered" style="top:14%; transform:translateY(-50%); min-width:800px">
    <!-- Upload Form -->
    <div class="centered" style="width:240px; top: 250px;">
      <div class="signup_wrap centered">   
      <p><legend>Upload your photo here!</legend></p>
      <?php echo form_open_multipart('user/update_audphoto');?> <!--at this point you were gonna grab the data and put them back in case of error uploading-->
      <form class="dropzone dz-clickable">      
          <h4><?=$atitle?></h4>
          <br/>
          <br/>

              <input type="hidden" name="aid" value="<?=$aid?>">
              <input type="hidden" name="atitle" value="<?=$atitle?>">

              <input type="file" id="audio_photo" name="audio_photo" accept="image/jpeg, image/png" id="audio_photo" style="display:inline; position:absolute;margin-top:10px; margin-left:25px;"  required/>    
              <label class="upload-img-button" for="audio_photo" style="position:absolute;z-index:20">                  
              Select photo
              </label>                   

              <div id="img_container" style="float:left; width:100px;height:100px; margin-top:50px; overflow:hidden">
                <img class="img_profile" id="cur_audio_photo" src="<?php echo base_url();?>assets/default.png"/>
              </div>  
    	      
          <div class="" style="position:relative; margin-left:50px">
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