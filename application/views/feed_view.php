<link href='http://fonts.googleapis.com/css?family=Cuprum&subset=latin' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles_dialog.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.confirm.css" />




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
        <td align="center"><input id="add2playlist" type="image" src="<?php echo base_url(); ?>assets/controls/plus.ico" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
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

<div id="page">

        <div class="item">
        
        </div>

</div>

<div id="confirmOverlay">
    <div id="confirmBox">

        <h1><img src="<?php echo base_url(); ?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/>Add a song to a playlist...</h1>
      <table>

        <thead>

        </thead>
        <tbody>
        <?php foreach($rec1->result() as $row): ?>

            <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">

              <td align="left"><h3><?=$row->playlist_name;?></h3></td>
            </tr>

            <tr>
              <td align="left"><a> DATE ADDED: <?=$row->playlist_date_added;?></a></td>
              <td align="left"> &nbsp; <a>&#8226; <?=$row->playlist_audio_count;?> TRACKS</a></td>
            </tr>
              

        <?php endforeach;?>
        </tbody>
      </table>
        <div id="confirmButtons">
            <button class="button blue" onclick="location.href = '<?php echo base_url(); ?>index.php/user/profile#playlists' ">Add</button>
            <button id="cancel" class="button gray" href="#">Cancel</button>
        </div>
    </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){
    $('#feed').DataTable();
  });

</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.confirm.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>





   
        