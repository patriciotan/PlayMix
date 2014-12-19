<div id="wrapper">


<div class="container feed_container span10" > <!-- This is the div that contains the most-played songs according to the database -->
<br />
<div class="centered" style="position:relative; width:870px;">

<ul style="width:500px;"><h1>FEED</h1></ul>
<br /><br />
  <table class="display" id="feed">  
    <thead>
      <th>Play</th>
      <th>Add to playlist</th>
      <th>Title</th>
      <th>by</th>
      <th>Artist</th>
      <th>Date uploaded</th>
      <th>No. of plays</th>
      <th>Share</th>
      <th>Download</th>
    </thead>
    <tbody>
    <?php foreach($rec->result() as $row): ?>
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