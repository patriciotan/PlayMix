<div id="confirmOverlay">
    <div id="confirmBox">
      
      <h1><img src="<?php echo base_url(); ?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>Add a song to a playlist...</h1>
      <table>
        <tbody>
        <tr>
            <td><h3 style="margin-left:100px">Choose from your playlists:</h3></td>
        </tr>

        <select name="playlists" style="width:300px; height:230px;" multiple>
        <?php foreach($rec1->result() as $row): ?>            
              <!--<td><h3><button style="margin-top: 10px;margin-left:100px;" class="btn btn-default addtoplaylist"><?=$row->playlist_name;?></button></h3></td>-->
              <option value="<?=$row->playlist_name;?>"><?=$row->playlist_name;?>
              <!--<input type="hidden" value="<?=$row->playlist_id; ?>"/>
              <input type="hidden" value="<?=$row->playlist_name; ?>"/>--></option>

        <?php endforeach;?>
        </select>

        <?php echo form_open("user/add2playlist"); ?>       
          
        </tbody>
      </table>

        <form>
            <input type="hidden" id="audio_id" name="audio_id" value="">
            <input type="hidden" id="playlist_id" name="playlist_id" value="">
            <input type="hidden" id="playlist_name" name="playlist_name" value="">
        <div id="confirmButtons">
            <button type="submit" class="button blue">Add</button></form>
            <button id="cancel" class="button gray" href="#">Cancel</button>
        </div>
          

        <?php echo form_close(); ?>
    </div>
</div>


<script type="text/javascript">

  $(document).ready(function(){
    $('#feed').DataTable();
    $("#confirmOverlay").hide();
  });

</script>

<script>

  $("#cancel").click(function(){
    $("#confirmOverlay").fadeOut("fast");
    $("#confirmOverlay").hide();
  });

  $(".addtoplaylist").click(function()
    {
        $("#playlist_id").val($(this).parent().parent().next().children().val());
        $("#playlist_name").val($(this).parent().parent().next().next().children().val());
        alert($("#audio_id").val());
        alert($("#playlist_id").val());
        alert($("#playlist_name").val());
    });

</script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>