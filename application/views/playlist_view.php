<div id="wrapper">


<div class="container" style="padding-bottom: 80px; padding-top: 80px;"> <!-- This is the div that contains the most-played songs according to the database -->
<div class="centered" style="position:relative; width:670px;">

<ul style="width:500px;"><h1 id="theName"><?php print $playlist_name; ?></h1></ul>
<br/>
  <table class="hover" id="mytable">  
    <thead>
      <th style="display:none"></th>
      <th style="display:none"></th>
      <th style="display:none"></th>
      <th width="50px"></th>
      <th style="display:none"></th>
      <th style="display:none"></th>
      <th align="left">TITLE</th>
      <th style="display:none">ARTIST</th>
      <th style="display:none" width="50px">ADDED</th>
      <th style="display:none" width="50px">PLAYS</th>
      <th width="50px"></th>
    </thead>
    <tbody id="feedBody">
    <?php 
      if(!empty($rec))
        foreach($rec as $row): 
    ?>
      <tr id="<?=$row->audio_id;?>" class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
        <td style="display:none" value="<?=$row->audio_file;?>"><?=$row->audio_file;?></td>
        <td style="display:none"><?=$row->audio_photo;?></td>
        <td style="display:none"><?=$row->audio_id;?></td>
        <td align="center"><input id="play" onclick="playSong(this)" type="image" src="<?php echo base_url(); ?>assets/controls/play.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="play"/></td>
        <td style="display:none"><?=$row->audio_id;?></td>
        <td style="display:none"><?=$row->user_id;?></td>
        <td align="left"><?=$row->audio_title;?></td>
        <td style="display:none" align="left"><?php echo $owner; ?></a></td>
        <td style="display:none" align="center"><?=$row->audio_date_added;?></td>
        <td style="display:none" align="right"><?=$row->audio_play_count;?></td>
        <td align="center"><input id="delete" onclick="delSong(this)" type="image" src="<?php echo base_url(); ?>assets/controls/delete.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="delete"/></td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table>

<div id="deleteOverlay" class="notifpopup">
    <div id="confirmBox">     
      <h1 style="font-color:white; text-shadow:0 0"><img src="<?php echo base_url();?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>&nbsp;Delete Playlist</h1>
         <label>
            <p style="margin-left:30px;margin-top:15px; margin-bottom:5px"> Are you sure you want to delete this song from playlist?</p>         
          </label>        
        <div id="confirmButtons">
            <button id="confirmdel" class="btn btn_red" style="width:130px">Delete</button>
            <button id="canceldel" class="btn" style="width:130px">Cancel</button>
        </div>      
    </div>
</div>
        <?php echo form_open("user/delfrom_playlist"); ?>
        <form>
          <input type="hidden" id="pId" name="pId" value="<?php echo $playlist_id; ?>"/>
          <input type="hidden" id="aId" name="aId" value=""/>
          <input id="remSong" type="submit" style="display:none">
        </form>
        <?php echo form_close(); ?>

</div>
</div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $("#deleteOverlay").hide();

   $("#canceldel").click(function(){
    $("#deleteOverlay").fadeOut("fast");
    $("#deleteOverlay").hide();
   });

   $("#confirmdel").click(function(){
    $("#remSong").click();
   });    


    $('#mytable').DataTable({
      "scrollCollapse": true,
      "paging":         false,
      "bInfo":          false,
      "scrollY":        "500px",     
      "oLanguage": {
        "sEmptyTable":     "You don't have any songs here!"
      },      "aoColumnDefs": [{
        'bSortable': false, 
        'aTargets': [-1,-2,-3,-4,-6,-7,-8,-9,-10,-11]
        }]
    });
  });  

  function delSong(node){

    var aId = node.parentNode.parentNode.cells[4].textContent;
    $("#aId").attr("value",aId);
    //alert("Value: "+$("#uid").val());
    $("#deleteOverlay").fadeIn("fast");
    $("#deleteOverlay").show();
  }

</script>