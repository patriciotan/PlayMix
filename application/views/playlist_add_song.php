<div id="confirmOverlay">
    <div id="confirmBox">
      
      <h1 style="text-shadow:0 0; color:white; margin-left:20px"><img src="<?php echo base_url(); ?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>Add to playlist</h1>
      <h3 style="margin-left:90px; margin-top:20px">Choose from your playlists:</h3></td>
        

        <div class="centered" style="margin-top:10px">
          <select id="chplaylist" name="playlists" style="width:300px; height:230px; position:relative; margin-left:50px;" size="5" required>
          <?php foreach($rec1->result() as $row): ?>            
              <option value="<?=$row->playlist_id;?>" class="chplaylist_options"><?=$row->playlist_name;?></option>
          <?php endforeach;?>
          </select>
        </div>

        <div class="centered" style="margin-bottom:40px">
          <?php echo form_open("user/add2playlist"); ?>  
          <form>
            <input type="hidden" id="added_from" name="added_from" value="">
            <input type="hidden" id="audio_id" name="audio_id" value="">
            <input type="hidden" id="playlist_id" name="playlist_id" value="">
            <input type="hidden" id="playlist_name" name="playlist_name" value="">
            <input type="submit" class="btn btn_red" value="Add" style="margin-left:50px; width:90px;">
            <input type="reset" id="cancel_add" class="btn" value="Cancel" style="display:inline; margin-left:10px; width:90px;" >            
          </form>
          <?php echo form_close(); ?>

        </div>       
    </div>
</div>


<script type="text/javascript">

  $(document).ready(function(){
    $("#confirmOverlay").hide();

    $("#cancel_add").click(function()
      {
        $("#confirmOverlay").fadeOut("fast");
        $("#confirmOverlay").hide();
      });

    $("#chplaylist").change(function()
      {

        $("#playlist_id").val($('#chplaylist option:selected').val());
        $("#playlist_name").val($('#chplaylist option:selected').text());
        // var c = $('#playlist_id').val();
        // var d = $('#playlist_name').val();
        // var e = $('#added_from').val();
        // alert(c+" "+d+" "+e);
      });
  
  });  

</script>