
        <div class="centered">
          <table class="hover" id="songs_table">  
            <thead>
		      <th style="display:none"></th>
		      <th style="display:none"></th>
		      <th style="display:none"></th>
		      <th width="25px"></th>
		      <th width="25px"></th>
		      <th style="display:none"></th>
		      <th align="left">TITLE</th>
		      <th align="right">ARTIST</th>
		      <th width="60px">ADDED</th>
		      <th align="left" width="40px">PLAYS</th>
            </thead>
            <tbody id="feedBody">
              <?php
              if($rec==''){

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
                  <td align="left"><?=$row->audio_title;?></td>
                  <td align="right"><?=$row->user_username;?></td>
                  <td align="center"><?=$row->audio_date_added;?></td>
                  <td align="left"><?=$row->audio_play_count;?></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>

<script type="text/javascript">

  function popUp(node){

    var id = node.parentNode.parentNode.cells[2].textContent;
    $("#confirmOverlay").css("display","inline");
    $("#confirmOverlay").fadeIn("fast");
    $("#confirmOverlay").show();
    $("#audio_id").attr("value",id);
    $("#added_from").attr("value","profile");
  
  }   

</script>            