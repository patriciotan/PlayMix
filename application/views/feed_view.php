<div id="wrapper">


<div class="container" style="padding-bottom: 80px; padding-top: 80px;"> <!-- This is the div that contains the most-played songs according to the database -->
<div class="centered" style="position:relative; width:870px;">

<ul style="width:500px;"><h1>FEED</h1></ul>
  <table class="display" id="feed">  
    <thead>
      <th>TITLE</th>
      <th>ARTIST</th>
      <th width="50px">ADDED</th>
      <th width="50px">PLAYS</th>
      <th width="5px"></th>
      <th width="5px"></th>
      <th width="5px"></th>
      <th width="5px"></th>
    </thead>
    <tbody>
    <?php foreach($rec->result() as $row): ?>
      <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
        <td><a href="#"><?=$row->audio_title;?></a></td>
        <td align="left"><a href="#"><?=$row->user_username;?></a></td>
        <td align="center"><?=$row->audio_date_added;?></td>
        <td align="left"><?=$row->audio_play_count;?></td>
        <td align="center"><a href="#"><img src="<?php echo base_url(); ?>assets/play.ico" style="float:center;margin-top:5px;z-index:5" alt="logo"/></a></td>
        <td align="center"><a href="#"><img src="<?php echo base_url(); ?>assets/plus.ico" style="float:center;margin-top:5px;z-index:5" alt="logo"/></a></td>
        <td align="center"><a href="#"><img src="<?php echo base_url(); ?>assets/share.ico" style="float:center;margin-top:5px;z-index:5" alt="logo"/></a> </td>
        <td align="center"><a href="#"><img src="<?php echo base_url(); ?>assets/download.ico" style="float:center;margin-top:5px;z-index:5" alt="logo"/></a></td>
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