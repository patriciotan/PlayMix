
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
              <th width="50px"></th>
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
                  <td align="center"><input onclick="updatePhoto(this)" type="image" src="<?php echo base_url(); ?>assets/controls/update_photo.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="delete"/></td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>

          <?php echo form_open("user/updatePhoto"); ?>
            <form>
              <input type="hidden" name="aid" id="aid" value="" style="display:none"/>
              <input type="hidden" name="atitle" id="atitle" value="" style="display:none"/>
              <input type="submit" id="update_photo" style="display:none"/>
            </form>
          <?php echo form_close();?> 

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

  function updatePhoto(node){
    var id = node.parentNode.parentNode.cells[2].textContent;
    var title = node.parentNode.parentNode.cells[6].textContent;
    $("#aid").attr("value",id);
    $("#atitle").attr("value",title);
    $("#update_photo").click();
  }

</script>            