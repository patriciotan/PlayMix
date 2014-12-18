<div id="wrapper">


<div class="container" > <!-- This is the div that contains the most-played songs according to the database -->

<div class="centered" style="position:relative; top:150px; width:870px;">

<ul style="width:500px;"><h1>FEED</h1></ul>

  <table class="feed_table">  
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

</div>
</div>
</div>