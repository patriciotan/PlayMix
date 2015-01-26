
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles_dialog.css" />-->

<button id="createplaylist" class="btn btn_primary" style="float:left"><input id="add2playlist" type="image" src="<?php echo base_url(); ?>assets/controls/plus.ico" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/>Create New Playlist</button>

<div id="createOverlay">
    <div id="confirmBox">

        <h1><img src="<?php echo base_url(); ?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>New Playlist</h1>
        <br> &nbsp;&nbsp;
        <?php echo form_open("user/add_playlist"); ?> 
        <form>
        <label for="playlist_name"><h3> Playlist name</h3></label>
        <input id="playlist_name" name="playlist_name" type="text" placeholder="Input playlist name..." value="<?php echo set_value('playlist_name'); ?>" required>

        <div id="confirmButtons">
            <button id="submit" type="submit" class="button blue">Create playlist</button>
            <button id="cancel" class="button gray" href="#">Cancel</button>
        </form>
        <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div>      
      <table>
        <tbody>
        <br><br>
        <?php foreach($playlists->result() as $row): ?>

            <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
            <br>
              <td align="left"><h3><?=$row->playlist_name;?></h3></td>
               <?php echo form_open("user/delete_playlist");?>
   				 <form>
              <td>
              <button type="submit" onclick="return confirm('Are you sure you want to delete this playlist?') "><img src="<?php echo base_url(); ?>assets/img/delete_icon.ico" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/></a></button>
              <input id="id" for="id" name="id" type="hidden" name="delete" value= "<?php echo $row->playlist_id; ?> " />
              </td>
            </tr>
            </form>
    		<?php echo form_close();  ?>
            <tr>
              <td align="left"><a> DATE ADDED: <?=$row->playlist_date_added;?></a></td>
              <td align="left"> &nbsp; <a>&#8226; <?=$row->playlist_audio_count;?> TRACKS</a></td>
            </tr>
              <br>

        <?php endforeach;?>
        </tbody>
      </table>
</div>

<script src="<?php echo base_url(); ?>assets/js/addplaylistpopup.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.confirm.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>