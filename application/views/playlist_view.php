<div id="wrapper">


<div class="container" style="padding-bottom: 80px; padding-top: 80px;"> <!-- This is the div that contains the most-played songs according to the database -->
<div class="centered" style="position:relative; width:670px;">

<ul style="width:500px;"><h1><?php echo $playlist_name; ?></h1></ul>
<br/>
  <table class="display" id="mytable">  
    <thead>
      <th style="display:none"></th>
      <th style="display:none"></th>
      <th style="display:none"></th>
      <th width="50px"></th>
      <th style="display:none"></th>
      <th align="left">TITLE</th>
      <th style="display:none">ARTIST</th>
      <th style="display:none" width="50px">ADDED</th>
      <th style="display:none" width="50px">PLAYS</th>
      <th width="50px"></th>
    </thead>
    <tbody id="feedBody">
    <?php 
      if(!empty($rec))
        foreach($rec as $row): 
    ?>
      <tr id="<?=$row->audio_id;?>" class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
        <td style="display:none" value="<?=$row->audio_file;?>"><?=$row->audio_file;?></td>
        <td style="display:none"><?=$row->audio_photo;?></td>
        <td style="display:none"><?=$row->audio_id;?></td>
        <td align="center"><input id="play" onclick="playSong(this)" type="image" src="<?php echo base_url(); ?>assets/controls/play.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
        <td style="display:none"><?=$row->audio_id;?></td>
        <td style="display:none"><?=$row->user_id;?></td>
        <td class="spotify" align="left"><?=$row->audio_title;?></td>
        <td style="display:none" align="left"><?php echo $owner; ?></a></td>
        <td style="display:none" align="center"><?=$row->audio_date_added;?></td>
        <td style="display:none" align="right"><?=$row->audio_play_count;?></td>
        <td align="center"><input onclick="popUp(this)" type="image" src="<?php echo base_url(); ?>assets/controls/delete.png" style="float:center;margin-top:3px;z-index:5;width:15px;height:15px;" alt="logo"/></td>
        
      </tr>
    <?php endforeach;?>
    </tbody>
  </table>

</div>
</div>
</div>

<script type="text/javascript">

  $(document).ready(function(){
    $('#mytable').DataTable({
      "order": [[ 9, "desc" ]]
    });
  });

</script>