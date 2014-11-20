<div id="wrapper">

 <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div style="position:relative; left:-120px;">
          <div style="position:relative; padding-top:8px; top:5px;left:30px;"><img src="<?php echo base_url(); ?>assets/forward.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></div>
          <div style="padding-left:50px;">
          <a class="brand" href="#">PlayMix</a>
          </div>
          <div style="height: 0px;" class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="<?php echo base_url(); ?>index.php/user">Home</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/user/about">About Us</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
</div>

<div class="container" >
  <!-- Login form -->
    <div id="user_login">
      <div class="signup_wrap" style="position: relative; margin-top:40%; margin-left:50%;">
      <div class="signin_form">
        <?php echo form_open("user/login"); ?>
        <form action="<?php echo base_url('user/login'); ?>">
          <label for="user_email">Email</label>
          <input type="user_email" id="user_email" name="user_email" value="" required />
          <br />

          <label for="user_password">Password</label>
          <input type="password" id="user_password" name="user_password" value="" required/>
          <br />

        <a href="#" class="forgot_password">Forgot password?</a>

          <div class="action_btns">
            <input type="submit" class="btn btn_white"  value="Login" />
            <input type="reset" class="btn btn_red"  value="Reset" />
          </div>   
        </form>
        <?php echo form_close(); ?>
      </div>
      </div>

      <div style="position: relative; margin-left:50%;">
      <p>
        <a href="#" class="social_box fb">
          <span class="icon"><i class="fa fa-facebook"></i></span>
          <span class="icon_title">Connect with Facebook</span>
        </a>or <a href="#" class="forgot_password" id="register_form" style="display:inline">Register</a> now!
      </p>
      </div>
    </div>

      <!-- Register Form -->
    <div id="register_container">
      <div class="signup_wrap" style="position: relative; margin-top:40%; margin-left:50%;">
      <div class="reg_form">
      <?php echo validation_errors('<p class="error">'); ?>
      <?php echo form_open("user/registration"); ?>       
        <form action="<?php echo base_url('user/registration'); ?>">
          <label for="user_username">User Name</label>
          <input type="text" id="user_username" style="height:12px"; name="user_username" value="<?php echo set_value('user_username'); ?>" required/>
          

          <label for="user_email">Email Address</label>
          <input type="text" id="user_email"style="height:12px"; type="user_email" name="user_email" value="<?php echo set_value('user_email'); ?>" required />
                

          <label for="user_password">Password</label>
          <input type="password" id="user_password"style="height:12px"; name="user_password" value="<?php echo set_value('user_password'); ?>" required />
         

          <label for="user_conpassword">Confirm Password</label>
          <input type="password" style="height:12px"; id="user_conpassword" name="user_conpassword" value="<?php echo set_value('user_conpassword'); ?>" required />
         

          <div class="action_btns">
            <div class="one_half"><input type="submit" class="btn btn_red" value="Sign Up"></div>
            <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i>Back</a></div>
          </div>
        </form>
        <?php echo form_close(); ?>
        <div>
          <a href="#" class="social_box fb">
            <span class="icon"><i class="fa fa-facebook"></i></span>
            <span class="icon_title">Connect with Facebook</span>
          </a>
        </div>


      </div>       <!-- type="submit" class="btn btn-primary" value="Submit" -->
      </div>
  </div>


<script type="text/javascript">
  $("#modal_trigger").leanModal({
      top: 140,
      overlay: 0.6,
      closeButton: ".modal_close"
  });

  $("#register_container").hide();

  $(function() {

      // Calling Register Form
      $("#register_form").click(function() {
          $("#user_login").hide();
          $("#register_container").show();
          $(".header_title").text('Register');
          return false;
      });

      // Going back to Login
      $(".back_btn").click(function() {
          $("#register_container").hide();
          $("#user_login").show();
          $(".header_title").text('Login');
          return false;
      });

  })
</script>