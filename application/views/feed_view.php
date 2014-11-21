<div id="wrapper">


<div class="container" > <!-- This is the div that contains the most-played songs according to the database -->

<div class="centered" style="position:relative; top:150px; width:870px;"><ul style="width:500px;"><h1>FEED</h1></ul>
    <?php foreach($rec->result() as $row): ?>
    <a href="#"><li><p><img src="<?php echo base_url(); ?>assets/control_play.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a> 
    &nbsp;<?php echo $row->audio_title; ?> 
    &nbsp;<?php echo $row->audio_play_count; ?> plays</p></li>
    <a href="#"><li><p><img src="<?php echo base_url(); ?>assets/play.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a> 
    <a href="#"><li><p><img src="<?php echo base_url(); ?>assets/plus.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a> 
    &nbsp;<?php echo $row->audio_title; ?> by 
    &nbsp;<?php echo $row->user_username; ?>, 
    &nbsp;<?php echo $row->audio_date_added; ?> 
    &nbsp;<?php echo $row->audio_play_count; ?> plays</p></li>
    <a href="#"><li><p><img src="<?php echo base_url(); ?>assets/share.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a> 
    <a href="#"><li><p><img src="<?php echo base_url(); ?>assets/download.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a> 
    <?php endforeach;
    ?>
</div>
</div>
</div>