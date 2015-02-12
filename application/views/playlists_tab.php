<!--<link rel="stylesheet" type="text/css" href="<?php
   echo base_url();
   ?>assets/css/styles_dialog.css" />-->
<button id="createplaylist" class="btn btn_primary" style="float:left;margin-left:100px;">
<input id="add2playlist" type="image" src="<?php echo base_url(); ?>assets/controls/plus.ico" style="float:center;margin-top:-1px;z-index:5;width:16px;height:10px;width:10px;" alt="logo"/>
 New Playlist</button>
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
            <button type="submit" class="button blue">Create playlist</button>
      </form>
      <?php echo form_close(); ?>
            <button id="cancel" class="button gray" href="#">Cancel</button>
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
            <button id="cancelren" class="button gray" href="#">Cancel</button>
        </div>
  	</div>
</div>
<div style="margin-left:100px;">
<br/><br/><br/><br/>
   <table>
      <tbody>
         <?php foreach ($playlists->result() as $row): ?>
         <tr class="<?php
            echo alternator('background:#cfc', 'background:#ffc');
            ?>">
            <td align="left">
              <?php echo form_open("user/playlist"); ?>
              <form id="viewplaylistform">
                    <input id="playlist_id" for="playlist_id" name="playlist_id" type="hidden" value= "<?php
                     echo $row->playlist_id;
                     ?> " />
                       <input id="playlist_name" for="playlist_name" name="playlist_name" type="hidden"  value= "<?php
                     echo $row->playlist_name;
                     ?> " />
                     <h3><button type="submit" class="btn btn-default"><?= $row->playlist_name; ?></button></h3>
                     </td>
               </form>
            <?php echo form_close(); ?>
         	<td>
				<button style="margin-top:-18px" class="btn btn_red renameplaylist">
					<img src="<?php echo base_url(); ?>assets/controls/edit.png" width="16px;" alt="edit"/>
				</button>            
				<input type="hidden" name="delete" value="<?=$row->playlist_id; ?>"/>           
				<input type="hidden" value="<?=$row->playlist_name; ?>"/>
			</td>
            <?php  echo form_open("user/delete_playlist"); ?>
            <form>
               <td>
 					<button type="submit" style="margin-top:-18px" class="btn btn_red" onclick="return confirm('Are you sure you want to delete this playlist?')">
						<img src="<?php echo base_url(); ?>assets/controls/delete.png" width="16px;" alt="delete"/>
					</button>
        	  		<input type="hidden" name="delete" value= "<?php echo $row->playlist_id; ?>"/>
               </td>
            </form>
         	<?php echo form_close(); ?>
         </tr>
         <tr>
            <td style="padding-bottom:10px;" align="left"><a> Date Added: <?= $row->playlist_date_added; ?></a></td>
            <!-- <td align="left"> &nbsp; <a>&#8226; <?= $row->playlist_audio_count; ?> TRACKS</a></td> -->
         </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$("#renameOverlay").hide();

		$(".renameplaylist").click(function(){
			$("#renameid").val($(this).next().val());
			$("#renamefield").val($(this).next().next().val());
			$("#renameOverlay").fadeIn("fast");
			$("#renameOverlay").show();
		});

		$("#cancelren").click(function(){
			$("#renameOverlay").fadeOut("fast");
			$("#renameOverlay").hide();
		});
	});

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
