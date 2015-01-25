            <table class="feed_table" id="songs">  
              
              <?php 
              if($rec==''){
                echo 'You don\'t have any songs here!';
              }
              else
              foreach($rec->result() as $row): ?>
              <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
                <td style="display:none"><?=$row->audio_file;?></td>
                <td><input id="play" onclick="playSong(this)" type="image" src="<?php echo base_url(); ?>assets/controls/play.ico" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
                <td><a href="#"><img src="<?php echo base_url(); ?>assets/plus.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a></td>
                <td><?=$row->audio_title;?></td>
                <td style="width:10px; padding-right:20px">by</td>
                <td ><?=$row->user_username;?></td>
                <td ><?=$row->audio_date_added;?></td>
                <td ><?=$row->audio_play_count;?></td>
                <td><a href="#"><img src="<?php echo base_url(); ?>assets/share.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a> </td>
                <td><a href="#"><img src="<?php echo base_url(); ?>assets/download.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a></td>
              </tr>
              <?php endforeach;?>
            </table>


<script type="text/javascript">

  $(document).ready(function(){
    $('songs').DataTable();
  });

</script>            