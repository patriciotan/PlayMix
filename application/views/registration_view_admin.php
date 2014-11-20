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
          <a class="brand" href="#">Taking You Forward Inc.</a>
          </div>
          <div style="height: 0px;" class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="<?php echo base_url(); ?>index.php/admin">Home</a></li>
        <li><a href="<?php echo base_url(); ?>index.php/admin/about">About Us</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
</div>

<div class="container" style="position: relative; top:200px; left:100px;">
  <a id="modal_trigger" href="#modal" class="btn">Get Started</a>

  <div id="modal" class="popupContainer" style="display:none;">
    <header class="popupHeader">
      <span class="header_title">Login</span>
      <span class="modal_close"><i class="fa fa-times"></i></span>
    </header>
    
    <section class="popupBody">
      <!-- Social Login -->
      <div class="social_login">
        <div class="">
          <a href="#" class="social_box fb">
            <span class="icon"><i class="fa fa-facebook"></i></span>
            <span class="icon_title">Connect with Facebook</span>
            
          </a>

          <a href="#" class="social_box google">
            <span class="icon"><i class="fa fa-google-plus"></i></span>
            <span class="icon_title">Connect with Google</span>
          </a>
        </div>

        <div class="centeredText">
          <span>Or use your Email address</span>
        </div>

        <div class="action_btns">
          <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
          <div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
        </div>
      </div>

      <!-- Username & Password Login form -->
      <div id="content">
      <div class="user_login">
      <div class="signup_wrap">
      <div class="signin_form">
        <?php echo form_open("admin/login"); ?>
        <form>
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="" required />
          <br />

          <label for="password">Password</label>
          <input type="password" id="pass" name="pass" value="" required/>
          <br />

          <div class="checkbox">
            <input id="remember" type="checkbox" />
            <label for="remember">Remember me on this computer</label>
          </div>

          <div class="action_btns">
            <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
            <div class="one_half last"><input type="submit" class="btn btn_red"  value="Login" /></div>
          </div>   
        </form>

        <a href="#" class="forgot_password">Forgot password?</a>
        <?php echo form_close(); ?>
      </div>
      </div>
      </div>

      <!-- Register Form -->
      <?php echo validation_errors('<p class="error">'); ?>
      <?php echo form_open("admin/registration"); ?>
      <div class="user_register">
      <div class="reg_form">
        <form>
          <label for="user_name">User Name</label>
          <input type="text" id="user_name" style="height:1.5px"; name="user_name" value="<?php echo set_value('user_name'); ?>" required/>
          

          <label for="email_address">Email Address</label>
          <input type="text" id="email_address"style="height:1.5px"; type="email" name="email_address" value="<?php echo set_value('email_address'); ?>" required />
         

          <label for="user_fname">First Name</label>
          <input type="text" id="user_fname"style="height:1.5px";  name="user_fname" value="<?php echo set_value('user_fname'); ?>" required />
        

          <label for="user_lname">Last Name</label>
          <input type="text" id="user_lname" style="height:1.5px"; name="user_lname" value="<?php echo set_value('user_lname'); ?>" requried />
            


          <label for="password">Password</label>
          <input type="password" id="password"style="height:12px"; name="password" value="<?php echo set_value('password'); ?>" required />
         

          <label for="con_password">Confirm Password</label>
          <input type="password" style="height:12px"; id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" required />
         

          <div class="checkbox">
            <input id="send_updates" type="checkbox" />
            <label for="send_updates">Send me occasional email updates</label>
          </div>

          <div class="action_btns">
            <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a></div>
            <div class="one_half last"><input type="submit" class="btn btn_red" value="Submit"></div>
          </div>
        </form>
        <?php echo form_close(); ?>
        </div>       <!-- type="submit" class="btn btn-primary" value="Submit" -->
      </div>
    </section>
  </div>
</div>
</section>
</div></div></div></div></div>

<script type="text/javascript">
  $("#modal_trigger").leanModal({
      top: 140,
      overlay: 0.6,
      closeButton: ".modal_close"
  });

  $(function() {
      // Calling Login Form
      $("#login_form").click(function() {
          $(".social_login").hide();
          $(".user_login").show();
          return false;
      });

      // Calling Register Form
      $("#register_form").click(function() {
          $(".social_login").hide();
          $(".user_register").show();
          $(".header_title").text('Register');
          return false;
      });

      // Going back to Social Forms
      $(".back_btn").click(function() {
          $(".user_login").hide();
          $(".user_register").hide();
          $(".social_login").show();
          $(".header_title").text('Login');
          return false;
      });

  })
</script>