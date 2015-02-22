
<div class="centered">
   <button id="createplaylist" class="btn btn_primary" ><img src="<?php echo base_url();?>assets/controls/plus.ico" style="float:center;margin-top:-1px;z-index:5;width:16px;height:10px;width:10px;" alt="logo"/> New Playlist</button>

   <table class="hover" id="playlists_table" style="margin-top:30px">
      <thead>
         <th style="display:none"></th>
         <th align="left">TITLE</th>
         <th width="60px">ADDED</th>
         <th width="25px"></th>     
         <th width="25px"></th>     
      </thead>
      <tbody>
      <?php foreach ($playlists->result() as $row): ?>
         <tr class="<?php echo alternator('background:#cfc', 'background:#ffc');?>">           
            <td style="display:none"><?=$row->playlist_id;?></td>
            <td align="left"><a href="#" onclick="viewPlaylist(this)"><?= $row->playlist_name; ?></a></td>           
            <td style="padding-bottom:10px;" align="left"><?= $row->playlist_date_added; ?></td>  
            <td align="left"><input onclick="renPlaylist(this)" type="image" src="<?php echo base_url(); ?>assets/controls/edit.png" style="float:right;margin-top:5px;z-index:5;width:16px;height:16px;" alt="edit"/></td>
            <td align="left"><input onclick="delPlaylist(this)" type="image" src="<?php echo base_url();?>assets/controls/delete.png" style="float:right;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>                     
         </tr>
      <?php endforeach; ?>
      </tbody>
   </table>
</div>

<div id="createOverlay" class="notifpopup">
   <div id="confirmBox" class="centered">
      <h1 style="color:white; text-shadow:0 0"><img src="<?php echo base_url();?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>&nbsp;New Playlist</h1>

      <?php echo form_open("user/add_playlist");?> 
      <form>
         <label for="playlist_name">
            <h3 style="margin-left:100px;margin-top:20px; margin-bottom:10px"> Playlist name</h3>
         </label>
         
         <input style="margin-left:100px; width:240px" id="playlist_name" name="playlist_name" type="text" value="" required="">
         <div id="confirmButtons">
            <input type="submit" value="Create playlist" class="btn btn_red" style="width:130px"/>
            <button id="cancel" class="btn" style="width:130px">Cancel</button>
         </div>
      </form>
      <?php echo form_close();?>         
   </div>
</div>


<div id="renameOverlay" class="notifpopup">
    <div id="confirmBox">
      
      <h1 style="font-color:white; text-shadow:0 0"><img src="<?php echo base_url();?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>&nbsp;Rename Playlist</h1>

      <?php echo form_open("user/rename_playlist"); ?> 
      <form>
         <label>
            <h3 style="margin-left:100px;margin-top:20px; margin-bottom:10px"> New playlist name</h3>
         </label>

         <input style="margin-left:100px; width:240px" id="renamefield" value="" name="rename" type="text" required/>
         <input id="renameid" value="" name="rename_id" type="hidden" />
         <input type="submit" id="rename_playlist" style="display:none"/>

      </form>
        <div id="confirmButtons">
            <button id="confirmren" class="btn btn_red"  style="width:130px">Save</button>
            <button id="cancelren" class="btn" style="width:130px">Cancel</button>
        </div>
      
      <?php echo form_close(); ?>        
    </div>
</div>

<div id="deleteOverlay" class="notifpopup">
    <div id="confirmBox">     
      <h1 style="font-color:white; text-shadow:0 0"><img src="<?php echo base_url();?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>&nbsp;Delete Playlist</h1>
         <label>
            <p style="margin-left:30px;margin-top:15px; margin-bottom:5px"> Are you sure you want to delete this playlist?</p>         
          </label>        
        <div id="confirmButtons">
            <button id="confirmdel" class="btn btn_red" style="width:130px">Delete</button>
            <button id="canceldel" class="btn" style="width:130px">Cancel</button>
        </div>      
    </div>
</div>


   <?php echo form_open("user/playlist"); ?>         
      <form id="viewplaylistform">
         <input id="playlist_id" for="playlist_id" name="playlist_id" type="hidden" value="" />
         <input id="playlist_name" for="playlist_name" name="playlist_name" type="hidden"  value="" />
         <input type="submit" id="view_playlist" style="display:none"/>
      </form>
   <?php echo form_close();?>

   <?php  echo form_open("user/delete_playlist");?>
      <form>
         <input id="pid" for="pid" name="delete" type="hidden" value= "" />
         <input type="submit" id="delete_playlist" style="display:none"/>
      </form>
   <?php echo form_close();?>




<script src="<?php echo base_url();?>assets/js/script.js"></script>
<script>
$(document).ready(function(){

   $("#createOverlay").hide();
   $("#renameOverlay").hide();
   $("#deleteOverlay").hide();


   $("#createplaylist").click(function(){
      $("#createOverlay").fadeIn("fast");
      $("#createOverlay").show();
   });

   $("#cancel").click(function(){
    $("#createOverlay").fadeOut("fast");
    $("#createOverlay").hide();
    });
   
   
   $("#cancelren").click(function(){
    $("#renameOverlay").fadeOut("fast");
    $("#renameOverlay").hide();
   });

   $("#canceldel").click(function(){
    $("#deleteOverlay").fadeOut("fast");
    $("#deleteOverlay").hide();
   });

   $("#confirmdel").click(function(){
    $("#delete_playlist").click();
   });

   $("#confirmren").click(function(){
    $("#rename_playlist").click();
   });   

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
    $("#deleteOverlay").fadeIn("fast");
    $("#deleteOverlay").show();
   
  }

  function renPlaylist(node){

    var id = node.parentNode.parentNode.cells[0].textContent;
    var name = node.parentNode.parentNode.cells[1].textContent;
    $("#pid").attr("value",id);
    $("#renameid").attr("value",id);
    $("#renamefield").attr("value",name);
    $("#renameOverlay").fadeIn("fast");
    $("#renameOverlay").show();
  }

</script>

