<div id="confirmOverlay">
    <div id="confirmBox">

        <h1><img src="<?php echo base_url(); ?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>Add a song to a playlist...</h1>
      <table>

        <thead>

        </thead>
        <tbody>
        <?php foreach($rec1->result() as $row): ?>

            <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">

              <td align="left"><h3><?php echo $row->playlist_name;?></h3></td>
            </tr>

            <tr>
              <td align="left"><a> DATE ADDED: <?php echo $row->playlist_date_added;?></a></td>
              <td align="left"> &nbsp; <a>&#8226; <?php echo $row->playlist_audio_count;?> TRACKS</a></td>
            </tr>
              

        <?php endforeach;?>
        </tbody>
      </table>
        <div id="confirmButtons">
            <button class="button blue" onclick="location.href = '<?php echo base_url(); ?>index.php/user/profile#playlists' ">Add</button>
            <button id="cancel" class="button gray" href="#">Cancel</button>
        </div>
    </div>
</div>