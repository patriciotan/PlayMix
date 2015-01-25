<div id="wrapper">


<div class="container" style="padding-bottom: 80px; padding-top: 80px;"> <!-- This is the div that contains the most-played songs according to the database -->
<div class="centered" style="position:relative; width:870px;">

<ul style="width:500px;"><h1>FEED</h1></ul>
  <table class="display" id="feed">  
    <thead>
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
    <?php foreach($rec->result() as $row): ?>
      <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
        <td style="display:none"><?=$row->audio_file;?></td>
        <td align="center"><input id="play" onclick="playSong(this)" type="image" src="<?php echo base_url(); ?>assets/controls/play.ico" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
        <td align="center"><input type="image" src="<?php echo base_url(); ?>assets/controls/plus.ico" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
        <td style="display:none"><?=$row->user_id;?></td>
        <td align="left"><?=$row->audio_title;?></td>
        <td align="left"><?=$row->user_username;?></a></td>
        <td align="center"><?=$row->audio_date_added;?></td>
        <td align="right"><?=$row->audio_play_count;?></td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table>

</div>
</div>
</div>

<script type="text/javascript">

  $(document).ready(function(){
    $('#feed').DataTable();
  });

</script>