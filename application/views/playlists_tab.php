<!--<link rel="stylesheet" type="text/css" href="<?php
   echo base_url();
   ?>assets/css/styles_dialog.css" />-->
<button id="createplaylist" class="btn btn_primary" style="margin-left:100px">
<input id="add2playlist" type="image" src="<?php echo base_url(); ?>assets/controls/plus.ico" style="float:center;margin-top:-1px;z-index:5;width:16px;height:10px;width:10px;" alt="logo"/>
 New Playlist</button>
<div class="centered" style="position:relative; width:670px; padding-bottom:100px;">
<br/><br/>
   <table class="display" id="mytable2">
      <thead>
        <th>Name</th>
        <th>Added</th>
        <th width="50px"></th>
        <th width="50px"></th>
      </thead>
      <tbody>
          <?php foreach ($playlists->result() as $row): ?>
          <tr class="<?php  echo alternator('background:#cfc', 'background:#ffc'); ?>">
            <td align="left">
              <h1 style="display:none"><?=$row->playlist_id; ?></h1>
              <a href="#" onclick="viewPlaylist(this)"><?= $row->playlist_name; ?></a>
            </td>
            <td align="center"><?= $row->playlist_date_added; ?></td>
         	  <td align="center">
              <input class="renameplaylist" type="image" src="<?php echo base_url(); ?>assets/controls/edit.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="edit"/>
  				    <h1 style="display:none"><?=$row->playlist_id; ?></h1>
              <h1 style="display:none"><?=$row->playlist_name; ?></h1>
            </td>
            <td align="center">
              <input type="image" onclick="delPlaylist(this)" src="<?php echo base_url(); ?>assets/controls/delete.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="delete"/>
 					    <h1 style="display:none"><?=$row->playlist_id; ?></h1>
            </td>
         </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
  <div>
    <?php echo form_open("user/playlist"); ?>
    <form>
      <input id="vplaylist_id" name="playlist_id" type="hidden" value=""/>
      <input id="vplaylist_name" name="playlist_name" type="hidden" value=""/>
      <input id="viewP" type="submit" style="display:none">
    </form>
    <?php echo form_close(); ?>
  </div>

  <div>
    <?php  echo form_open("user/delete_playlist"); ?>
    <form>
      <input id="dplaylist_id" name="delete" type="hidden" value=""/>
      <input id="delP" type="submit" onclick="return confirm('Are you sure you want to delete this playlist?');" style="display:none">
    </form>
    <?php echo form_close(); ?>
  </div>


<div id="createOverlay">
    <div id="confirmBox">
      <img src="<?php echo base_url(); ?>assets/playmix_logo_icon.png" style="float:left;margin-top:15px;margin-left:15px;z-index:5; height:30px;" alt="logo"/>
      <h1 style="margin-left:20px;">&nbsp;New Playlist</h1>
      <br/> &nbsp;&nbsp;
      <?php echo form_open("user/add_playlist"); ?> 
      <form>
         <label for="playlist_name">
            <h3 style="margin-left:80px"> Playlist name</h3>
         </label>
         <br/>
         <input style="margin-left:80px" name="playlist_name" type="text" required/>
      <div id="confirmButtons">
            <button type="submit" class="button blue">Create</button>
      </form>
      <?php echo form_close(); ?>
            <button id="cancel" class="button gray">Cancel</button>
        </div>
    </div>
</div>
<div id="renameOverlay">
    <div id="confirmBox">
      <img src="<?php echo base_url(); ?>assets/playmix_logo_icon.png" style="float:left;margin-top:15px;margin-left:15px;z-index:5; height:30px;" alt="logo"/>
      <h1 style="margin-left:20px;">&nbsp;Rename Playlist</h1>
      <br/> &nbsp;&nbsp;
      <?php echo form_open("user/rename_playlist"); ?> 
      <form>
         <label for="playlist_name">
            <h3 style="margin-left:110px"> New playlist name</h3>
         </label>
         <br/>
         <input style="margin-left:110px" id="renamefield" value="" name="rename" type="text" required/>
         <input id="renameid" value="" name="rename_id" type="hidden" />
        <div id="confirmButtons">
            <button type="submit" class="button blue">Save</button>
      </form>
      <?php echo form_close(); ?>
            <button id="cancelren" class="button gray">Cancel</button>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
  
  $(document).ready(function(){
    $('#mytable2').DataTable();
  });

  $(document).ready(function(){

    $("#renameOverlay").hide();

    $(".renameplaylist").click(function(){
      $("#renameid").val($(this).next().html());
      $("#renamefield").val($(this).next().next().html());
      $("#renameOverlay").fadeIn("fast");
      $("#renameOverlay").show();
    });
  });

  function viewPlaylist(node){
    alert("here!");
    var pId = node.parentNode.cells[0].textContent;
    var pName = node.textContent;
    alert(pId);
    alert(pName);
    $("#vplaylist_id").attr("value",pId);
    $("#vplaylist_name").attr("value",pName);
    $("#viewP").click();
  }

  function delPlaylist(node){
    var pId = node.parentNode.cells[1].textContent;
    alert(pId);
    $("#dplaylist_id").attr("value",pId);
    $("#delP").click();
  }

</script>

<script src="<?php
   echo base_url();
   ?>assets/js/addplaylistpopup.js"></script>
<script src="<?php
   echo base_url();
   ?>assets/js/jquery.confirm.js"></script>
<script src="<?php
   echo base_url();
   ?>assets/js/script.js"></script>
