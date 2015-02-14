<div class="navbar navbar-fixed-top">
      <div class="navbar-inner" style="height: 53px;">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div style="position:relative;">
            <div style="position:relative; padding-top:8px; top:5px;left:30px;"></div>
            <div style="padding-left:50px;">
              <a class="brand" href="<?php echo base_url('index.php/user/feed/navbar_admin'); ?>"><img src="<?php echo base_url(); ?>assets/playmix_logo_icon.png" style="float:left;margin-top:-5px;z-index:5; height:30px;" alt="logo"/><img src="<?php echo base_url(); ?>assets/playmix_logo_text.png" style="float:left;margin-top:-6px; margin-left:3px; z-index:5; height:30px;" alt="logo"/></a>
            </div>
            <div style="height: 0px" class="nav-collapse collapse">
              <ul class="nav">
                <li><a href="<?php echo base_url('index.php/user/profile'); ?>">Profile</a></li>
                <li><a href="<?php echo base_url('index.php/user/upload')?>">Upload</a></li>
                <li><a href="<?php echo base_url('index.php/user/admin'); ?>">Admin</a></li> 
                <li id="notification_li">
                  <span id="notification_count" style="display:none"><?=$notif['notif_count']?></span>
                  <a href="#" id="notificationLink" style="position: relative; float:right; margin-top:7px; margin-left:13px; background: url(<?php echo base_url();?>assets/notif.png) no-repeat; background-position: 1px; background-size:20px;"></a>                                    
                </li>    
              </ul>                        
            </div>
            <div>
              <ul class="nav navr" id="navr" style="float:right">               
                <li><a style="position: relative; float:right" href="<?php echo base_url('index.php/user/logout'); ?>">Log out</a></li>
              </ul>
            </div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<div id="popup" class="notifpopup" style="display:none">
  <div id="popup-dialog" class="notifpopupdialog">
    <p id="popup-message"><strong><?php echo $notif['notif_count']?></strong>&nbsp;artists want to collaborate with you. You may check your <br>e-mail for their contact information!</p>
    <a href="#" id="gotthat" class="btn btn-white" style="position:relative; width:15%; margin:0 auto">Got that!</a>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $("#popup").hide();

    $('li > a').click(function() {
      $('li').removeClass();
      $(this).parent().addClass('active');
    });

    if($("#notification_count").html()=="0")
    {
      $("#popup-message").html("You don't have any notifications right now."); 
    }

    else if($("#notification_count").html()!="0")
    {
      $("#notification_count").css("display","inline");
      $("#popup-message").html("<strong><?php echo $notif['notif_count']?></strong> artists want to collaborate with you. You may check your <br>e-mail for their contact information!");
    }    

    $("#popup").click(function(){
      $("#popup").fadeOut("fast");
      $("#popup").hide();
      $("#notification_count").hide();
    });

    $("#gotthat").click(function(){
      $("#popup").fadeOut("fast");
      $("#popup").hide();
      $("#notification_count").hide();
    });

    $("#notificationLink").click(function(){
      $("#notificationContainer").fadeToggle(300);
      $("#notification_count").fadeOut("slow");
      $("#popup").fadeIn("fast");
      $("#popup").css("display","inline");
      $("#popup").show();
      $("#popup-dialog").fadeIn("fast");
    });

    $("#gotthat").click(function(){
    	$.ajax({
			url: '<?php echo base_url('index.php/user/reset_notif')?>',
			type:'Get',
			data:{'id':$(this).children(".resId").val()},
			success:function(){
			   $("#notification_count").html("0");
			},  
			    error : function(e) {  
			    alert('Error: ' + e);   
			}
		});
    });

    //Document Click hiding the popup 
    $(document).click(function(){
      $("#notificationContainer").hide();
    });

    //Popup on click
    $("#notificationContainer").click(function(){
      return false;
    });

    
  });
</script>
