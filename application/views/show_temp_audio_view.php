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
    <div id="user_register" class="centered" style="width:240px; top: 150px;">
      <div class="signup_wrap centered">   
      <p><legend>Upload your song here!</legend></p>
      <?php echo form_open_multipart("user/addAudio"); ?> 
      <form>      
          <label for="audio_title">Title</label>
          <input type="text" id="audio_title" style="height:12px"; name="audio_title" maxlength="256" value="<?php echo set_value('audio_title'); ?>" required/>
          
          <label for="audio_genre">Genre</label>
          <select>
          <option selected="selected" id="audio_genre" name="audio_genre"><?php echo $audio_genre; ?> </option>
            <option>Alternative</option>
            <option>Classical</option>
            <option>Country</option>
            <option>EDM</option>
            <option>Jazz</option>
            <option>Pop</option>
            <option>Rock</option>
          </select>
        <tr>
        <td style="width: 120px">Uploaded Audio:</td>
      <td></td>
      </tr>
       <tr>
        <td style="width: 120px"><?php echo $audio_file; ?></td>
      <td></td>
      </tr>
   



    <tr> 
      <td style="width: 120px">

      <div style="position:absolute;top:350px;left:0px;height:200px;width:200px">
       <div class="one_half"><a href="<?php echo base_url(); ?>index.php/user/feed" class="btn back_btn" ><i class="fa fa-angle-double-left" ></i> Back</a></div>


       
      </div>

      <div style="position:absolute;top:350px;left:100px;height:200px;width:200px"> 

        
       <input name="submit" class="btn btn-default" style="width: 120px" type="submit" value="Submit" /></td>
      </div>
      
    </tr>
  </table>
</form>

</div>
</td></tr></table></div></form>
<?php echo form_close(); ?>
<script type="text/javascript">
  
  $("input[name='userfile']").each(function() {
    var fileName = $(this).val().split('/').pop().split('\\').pop();
    console.log(fileName);
});

</script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

