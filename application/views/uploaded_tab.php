            <table class="feed_table">  
              <?php 
              if($rec==''){
                echo 'You don\'t have any songs here!';
              }
              else
              foreach($rec->result() as $row): ?>
              <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
                <td><a href="#"><img src="<?php echo base_url(); ?>assets/play.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a></td>
                <td><a href="#"><img src="<?php echo base_url(); ?>assets/plus.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a></td>
                <td><a href="#"><?=$row->audio_title;?></a></td>
                <td style="width:10px; padding-right:20px">by</td>
                <td ><a href="#"><?=$row->user_username;?></a></td>
                <td ><?=$row->audio_date_added;?></td>
                <td ><?=$row->audio_play_count;?></td>
                <td><a href="#"><img src="<?php echo base_url(); ?>assets/share.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a> </td>
                <td><a href="#"><img src="<?php echo base_url(); ?>assets/download.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a></td>
              </tr>
              <?php endforeach;?>
            </table>