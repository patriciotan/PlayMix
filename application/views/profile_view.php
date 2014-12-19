<div id="wrapper">
  <div class="container" >
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
            <?php echo $personal_info?>
            <?php echo $edit_personal_info?>
          </div>
          <div class="tab-pane" id="uploaded" style="padding:3px">
            <?php echo $uploaded?>
          </div>

          <div class="tab-pane" id="playlists">
            <?php echo $playlists?>
          </div>

          <div class="tab-pane" id="account">
            <?php echo $account?>
            <?php echo $edit_account?>
          </div>          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){

    $("#edit_personal_info").hide();
    $("#edit_account_info").hide();    
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
    $('#edit_personal_info_button').click(function(){
      //onclick, remove personal info contents, replace with forms
      $("#personal_info_contents").hide();
      $("#edit_personal_info").show();
    });
    $('#cancel_edit').click(function(){
      $("#edit_personal_info").hide(); 
      $("#personal_info_contents").show();
    });
    $('#edit_account_button').click(function(){
      //onclick, remove personal info contents, replace with forms
      $("#account_contents").hide();
      $("#edit_account").show();
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