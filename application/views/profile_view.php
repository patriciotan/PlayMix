<div id="wrapper">
  <div class="container" > <!-- This is the div that contains the most-played songs according to the database -->
    <div class="centered" style="position:relative; top:150px; width:870px;">
      <div class="tabbable" id="profileTab">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#personal_info" data-toggle="tab" id="personal_infoTab">Personal Info</a></li>
          <li><a href="#uploaded" data-toggle="tab" id="uploadedTab">Uploaded Songs</a></li>
          <li><a href="#playlists" data-toggle="tab" id="playlistsTab">Playlists</a></li>
          <li><a href="#account" data-toggle="tab" id="accountTab">Account</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="personal_info">
            <div class="centered">
              <div id="image">
                <div id="img_container" class="profile-circular-mask">
                  <img class="img_profile" src="<?php echo base_url();?><?php echo $info['user_photo']?>"/>
                </div>
              </div>
            
            
              <div id="info">
                <div id="user_name">
                  <h1><?=$info['user_fname']?>&nbsp;<?=$info['user_lname']?></h1>
                </div>
                <div id="user_country">
                  <h3><?=$info['user_city']?>, &nbsp;<?=$info['user_country']?></h3>
                </div>
                <div id="user_bio" style="border-top:1px solid gray; margin-top:20px">
                  <br/>
                  <h3>Biography</h3>
                  <br/>
                  <p style="margin-left:30px"><?=$info['user_bio']?></p>
                </div>          
            
                <div id="user_sites" style="border-top:1px solid gray; margin-top:20px">
                  <br/>
                  <h3>Websites</h3>
                  <ul class="user_websites">
                    <br/>
                    <a href="<?php echo $info['user_fb']?>" id="fb"><img src="" id="fb_img"/></a>
                    <a href="<?php echo $info['user_google']?>" id="google"><img src="" id="google_img"/></a>
                    <a href="<?php echo $info['user_twitter']?>" id="twitter"><img src="" id="twitter_img"/></a>
                  </ul>
                </div>
              </div>
            
            
            </div>
          </div>
          <div class="tab-pane" id="uploaded">
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
          <div class="tab-pane" id="playlists">

          </div>
          <div class="tab-pane" id="account">
            <h3><?=$info['user_name']?></h3>
            <h3><?=$info['user_email']?></h3>
          </div>          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){

    $('li > a').click(function() {
      $('li').removeClass();
      $(this).parent().addClass('active');
    });

    $('#personal_infoTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#personal_info").addClass("active");
    });
    $('#uploadedTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#uploaded").addClass("active");
    });
    $('#playlistsTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#playlists").addClass("active");
    });
    $('#accountTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#account").addClass("active");
    });
  });

    $(document).ready(function(){
      var a = $('#fb').attr("href");
      if(a==""){
        jQuery('#fb_img').attr("src", "<?php echo base_url();?>assets/img/facebook_off.png");
        jQuery('#fb_img').click(function(){return false});
      }
      else
        jQuery('#fb_img').attr("src", "<?php echo base_url();?>assets/img/facebook.png");
    });

    $(document).ready(function(){
      var a = $('#google').attr("href");
      if(a==""){
        jQuery('#google_img').attr("src", "<?php echo base_url();?>assets/img/google_off.png");
        jQuery('#google_img').click(function(){return false});
      }
      else
        jQuery('#google_img').attr("src", "<?php echo base_url();?>assets/img/google.png");      
    });

    $(document).ready(function(){
      var a = $('#twitter').attr("href");
      if(a==""){
        jQuery('#twitter_img').attr("src", "<?php echo base_url();?>assets/img/twitter_off.png");
        jQuery('#twitter_img').click(function(){return false});
      }
      else
        jQuery('#twitter_img').attr("src", "<?php echo base_url();?>assets/img/google.png");      
    });
</script>