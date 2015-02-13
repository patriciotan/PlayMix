

<div class="centered">
   <button id="createplaylist" class="btn btn_primary" ><img src="<?php echo base_url();?>assets/controls/plus.ico" style="float:center;margin-top:-1px;z-index:5;width:16px;height:10px;width:10px;" alt="logo"/> New Playlist</button>

   <table class="hover" id="playlists_table" style="margin-top:30px">
      <thead>
         <th style="display:none"></th>
         <th>TITLE</th>
         <th width="50px">ADDED</th>
         <th width="50px"></th>         
      </thead>
      <tbody>
      <?php foreach ($playlists->result() as $row): ?>
         <tr class="<?php echo alternator('background:#cfc', 'background:#ffc');?>">           
            <td style="display:none"><?=$row->playlist_id;?></td>
            <td align="left"><a href="#" onclick="viewPlaylist(this)"><?= $row->playlist_name; ?></a></td>           
            <td style="padding-bottom:10px;" align="left"><?= $row->playlist_date_added; ?></td>  
            <td><input onclick="delPlaylist(this)" type="image" src="<?php echo base_url();?>assets/img/delete_icon.ico" style="float:right;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>                     
         </tr>
      <?php endforeach; ?>
      </tbody>
   </table>
</div>

<div id="createOverlay" class="notifpopup">
   <div id="confirmBox" class="centered">
      <h1 style="font-color:white; text-shadow:0 0"><img src="<?php echo base_url();?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>&nbsp;New Playlist</h1>

      <?php echo form_open("user/add_playlist");?> 
      <form>
         <label for="playlist_name">
            <h3 style="margin-left:80px"> Playlist name</h3>
         </label>
         
         <input style="margin-left:80px" id="playlist_name" name="playlist_name" type="text" placeholder="Input playlist name..." value="<?php echo set_value('playlist_name');?>" required>

         <div id="confirmButtons">
            <input type="submit" value="Create playlist" class="btn btn_red"/>
            <button id="cancel" class="btn" href="#">Cancel</button>
         </div>
      </form>
      <?php echo form_close();?>         
   </div>
</div>

   <?php echo form_open("user/playlist"); ?>         
      <form id="viewplaylistform">
         <input id="playlist_id" for="playlist_id" name="playlist_id" type="hidden" value= "<?php echo $row->playlist_id;?> " />
         <input id="playlist_name" for="playlist_name" name="playlist_name" type="hidden"  value= "<?php echo $row->playlist_name;?> " />
         <input type="submit" id="view_playlist" style="display:none"/>
      </form>
   <?php echo form_close();?>

   <?php  echo form_open("user/delete_playlist");?>
      <form>
         <input id="pid" for="pid" name="id" type="hidden" value= "<?php echo $row->playlist_id;?> " />
         <input type="submit" id="delete_playlist" style="display:none"/>
      </form>
   <?php echo form_close();?>




<script src="<?php echo base_url();?>assets/js/script.js"></script>
<script>
$(document).ready(function(){

   $("#createOverlay").hide();

   $("#createplaylist").click(function(){
      $("#createOverlay").fadeIn("fast");
      $("#createOverlay").show();
   });

   $("#cancel").click(function(){
    $("#createOverlay").fadeOut("fast");
    $("#createOverlay").hide();
    });


    $("#confirmOverlay").hide();
});
   


  function viewPlaylist(node){

    var id = node.parentNode.parentNode.cells[0].textContent;
    var pname = node.parentNode.parentNode.cells[1].textContent;
    $("#playlist_id").attr("value",id);
    $("#playlist_name").attr("value",pname);
    $("#view_playlist").click();
  }

  function delPlaylist(node){

    var id = node.parentNode.parentNode.cells[0].textContent;
    $("#pid").attr("value",id);
    $("#delete_playlist").click();
  }
</script>