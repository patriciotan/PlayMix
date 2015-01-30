            <table class="feed_table" id="songs">  
              
              <?php 
              if($rec==''){
                echo 'No songs here!';
              }
              else
              foreach($rec->result() as $row): ?>
      <tr id="<?=$row->audio_id;?>" class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
        <td style="display:none" value="<?=$row->audio_file;?>"><?=$row->audio_file;?></td>
        <td style="display:none"><?=$row->audio_photo;?></td>
        <td style="display:none"><?=$row->audio_id;?></td>
        <td align="center"><input id="play" onclick="playSong(this)" type="image" src="<?php echo base_url(); ?>assets/controls/play.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
        <td align="center"><input onclick="popUp(this)" type="image" src="<?php echo base_url(); ?>assets/controls/plus.ico" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
        <td style="display:none"><?=$row->user_id;?></td>
        <td class="spotify" align="left"><?=$row->audio_title;?></td>
        <td align="left"><?=$row->user_username;?></td>
        <td align="center"><?=$row->audio_date_added;?></td>
        <td align="right"><?=$row->audio_play_count;?></td>
      </tr>
              <?php endforeach;?>
            </table>


<script type="text/javascript">
</script>            