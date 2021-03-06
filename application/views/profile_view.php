<div id="wrapper">
  <div class="container" >
    <div class="centered" style="position:relative; top:120px; width:870px;">
      <!--<div>
        <button class="btn btn_red" style="float:right">Collaborate!</button>
      </div>-->
      <span id="open_tab" style="display:none"><?=$tab?></span>
      <div class="tabbable" id="profileTab">
        <ul class="nav nav-tabs" id="prof_tabs">
          <li id="tab1"><a href="#personal_info" data-toggle="tab" id="personal_infoTab">Personal Info</a></li>
          <li id="tab2"><a href="#uploaded" data-toggle="tab" id="uploadedTab">Uploaded Songs</a></li>
          <li id="tab3"><a href="#playlists" data-toggle="tab" id="playlistsTab">Playlists</a></li>
          <li id="tab4"><a href="#account" data-toggle="tab" id="accountTab">Account</a></li>
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

    var tab = $('#open_tab').html();
    $('.tab-pane').removeClass("active");
    $('#'+tab).addClass('active');

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
    $('#cancel_edit_personal_info').click(function(){
      $("#edit_personal_info").hide(); 
      $("#personal_info_contents").show();
      jQuery('#user_current_photo').attr("src", "<?php echo base_url();?><?php echo $info['user_photo']?>");
    });
    $('#edit_account_button').click(function(){
      //onclick, remove personal info contents, replace with forms
      $("#account_contents").hide();
      $("#edit_account_info").show();
    });
    $('#cancel_edit_account').click(function(){
      $("#edit_account_info").hide(); 
      $("#account_contents").show();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#user_current_photo').attr('src', e.target.result);
                $('#user_photo').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#user_new_photo").change(function(){
        readURL(this);
    });


    $('#popup_pp').hide();

    $('#select_pp').click(function(){
      $("#popup_pp").fadeIn("slow");
      $("#popup_pp").css("display","inline");
      
    });

    $("#popup_bg").click(function(){
      $("#popup_pp").fadeOut("slow");
    });

    $("#cancel_choose").click(function(){
      $("#popup_pp").fadeOut("slow");
      $("#popup_pp").hide();
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
        jQuery('#twitter_img').attr("src", "<?php echo base_url();?>assets/img/twitter.png");      
    });    

    $(document).ready(function(){
      var uploaded = $('#songs_table').DataTable({
      "order": [[ 9, "desc" ]],
      "scrollCollapse": true,
      "paging":         false,
      "bInfo":          false,     
      "oLanguage": {
        "sEmptyTable":     "You don't have any songs here!"
      },
      "aoColumnDefs": [{
        'bSortable': false, 
        'aTargets': [-6,-7]
        }]
      });

      var playlists = $('#playlists_table').DataTable({
      "scrollCollapse": true,
      "paging":         false,
      "bInfo":          false,
      "bFilter":        false,
      "oLanguage": {
        "sEmptyTable":     "You don't have any playlists here!"
      },
      "aoColumnDefs": [{
        'bSortable': false, 
        'aTargets': [-1,-4]
        }]
      });

    });

</script>