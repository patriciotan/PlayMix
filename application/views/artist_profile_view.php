<div id="wrapper">
  <div class="container" >
    <div class="centered" style="position:relative; top:120px; width:870px;">
      <div>
        
          <form id="collab" method="post">
            <input type="hidden" name="user_email" id="user_email" value="<?=$info['user_email']?>" style="display:none"/>
            <input type="submit" class="btn btn_red" value="Collaborate!" style="float:right" id="colb"/>
          </form>
        
      </div>
      <div class="tabbable" id="profileTab">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#personal_info" data-toggle="tab" id="personal_infoTab">Personal Info</a></li>
          <li><a href="#uploaded" data-toggle="tab" id="uploadedTab">Uploaded Songs</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="personal_info">
            <?php echo $personal_info?>
          </div>
          <div class="tab-pane" id="uploaded" style="padding:3px; overflow:hidden">
            <?php echo $uploaded?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){

    $("#collab").submit(function(){
         dataString = $("#collab").serialize();
 
         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>index.php/user/send_collab",
           data: dataString,
           beforeSend: function () {
                $("#colb").animate({opacity: 0.5}, 150);
                $("#colb").val("Hold On...");
                $("#colb").click(function(e){
                  e.preventDefault();
                });
           },
           success: function(data){
               alert('E-mail sent!');
                $("#colb").val("Sent!");
                $("#colb").animate({opacity: 1.0}, 150);
                $("#colb").click(function(e){
                  return false;
                });
           },
           error: function(data) { // if error occured
                $("#colb").animate({opacity: 1.0}, 150);
                $("#colb").val("Error occured.please try again");
                $("#colb").click(function(e){
                  return true;
                });

           }        

         });
 
         return false;  //stop the actual form post !important!
 
      });    
  
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
    });

</script>