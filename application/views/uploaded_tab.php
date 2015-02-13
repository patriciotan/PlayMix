            <table class="display" id="mytable">  
              <thead>
                <th style="display:none"></th>
                <th style="display:none"></th>
                <th style="display:none"></th>
                <th width="5px"></th>
                <th width="5px"></th>
                <th style="display:none"></th>
                <th>TITLE</th>
                <th>ARTIST</th>
                <th width="50px">ADDED</th>
                <th width="50px">PLAYS</th>
              </thead>
              <tbody>
                <?php 
                  if(!empty($rec))
                    foreach($rec->result() as $row): 
                ?>
                  <tr id="<?=$row->audio_id;?>" class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
                    <td style="display:none" value="<?=$row->audio_file;?>"><?=$row->audio_file;?></td>
                    <td style="display:none"><?=$row->audio_photo;?></td>
                    <td style="display:none"><?=$row->audio_id;?></td>
                    <td align="center"><input id="play" onclick="playSong(this)" type="image" src="<?php echo base_url(); ?>assets/controls/play.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
                    <td align="center"><input onclick="popUp(this)" type="image" src="<?php echo base_url(); ?>assets/controls/plus.ico" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
                    <td style="display:none"><?=$row->user_id;?></td>
                    <td align="left"><?=$row->audio_title;?></td>
                    <td align="left"><?=$row->user_username;?></td>
                    <td align="center"><?=$row->audio_date_added;?></td>
                    <td align="right"><?=$row->audio_play_count;?></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>


<script type="text/javascript">

  $(document).ready(function(){
    $('#mytable').DataTable({
      "order": [[ 9, "desc" ]]
    });
  });

  function popUp(node){
    // $("#notificationContainer").fadeToggle(300);
    // $("#notification_count").fadeOut("slow");
    var id = node.parentNode.parentNode.cells[2].textContent;
    $("#confirmOverlay").fadeIn("fast");
    $("#confirmOverlay").show();
    // alert(id);
    $("#audio_id").attr("value",id);
    $("#added_from").attr("value","profile");
  
    //$("#popup-dialog").fadeIn("fast");
  }   

</script>            