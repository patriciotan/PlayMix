<div class="wrapper" style="height:500px">

<div class="container centered" style="top:60%; transform:translateY(-50%); min-width:800px">
  <!-- Username & Password Login form -->
    <div id="user_login" class="centered" style="width:240px;">
      <div class="signup_wrap centered">
        <?php echo form_open("user/login"); ?>
        <form class="centered">
          <label for="user_email">Email</label>
          <input type="text" id="user_email" name="user_email" value="" required />
          <br />

          <label for="user_password">Password</label>
          <input type="password" id="user_password" name="user_password" value="" required/>
          <br />
        <a href="#" id="forgot_password">Forgot password?</a>
          <div class="action_btns">
            <input type="submit" class="btn btn_white"  value="Login" />
            <input type="reset" class="btn btn_red"  value="Reset" />
          </div>   
        </form>
        <?php echo form_close(); ?>

        <div>
          <p style="font-size:13px">
          <a href="#" class="social_box fb">
            <span class="icon"><i class="fa fa-facebook"></i></span>
            <span class="icon_title">Log in with Facebook</span>
          </a>or <a href="#" class="forgot_password" id="register_form" style="display:inline">Register</a> now!
          </p>
        </div>
      </div>
    </div>

      <!-- Register Form -->
    <div id="user_register" class="centered" style="width:240px">
      <div class="signup_wrap centered">
      <?php echo validation_errors('<p class="error">'); ?>
      <?php echo form_open("user/registration"); ?>       
        <form>
          <label for="user_username">User Name</label>
          <input type="text" id="user_username" style="height:12px"; name="user_username" value="<?php echo set_value('user_username'); ?>" required/>
          

          <label for="user_email">Email Address</label>
          <input type="text" id="user_email"style="height:12px"; type="user_email" name="user_email" value="<?php echo set_value('user_email'); ?>" required />
                

          <label for="user_password">Password</label>
          <input type="password" id="user_password"style="height:12px"; name="user_password" value="<?php echo set_value('user_password'); ?>" required />
         

          <label for="user_conpassword">Confirm Password</label>
          <input type="password" style="height:12px"; id="user_conpassword" name="user_conpassword" value="<?php echo set_value('user_conpassword'); ?>" required />
         

          <div class="action_btns">
            <input type="submit" class="btn btn_white" value="Sign Up">
            <input type="reset" class="btn btn_red"  value="Reset" />
            <a href="#" id="back_btn" class="btn"><i class="fa fa-angle-double-left"></i>Back</a>
          </div>
        </form>
        <?php echo form_close(); ?>
        <div>
          <a href="#" class="social_box fb">
            <span class="icon"><i class="fa fa-facebook"></i></span>
            <span class="icon_title">Sign up with Facebook</span>
          </a>
        </div>
       <!-- type="submit" class="btn btn-primary" value="Submit" -->
      </div>
    </div>

    <div id="user_forgot" class="centered" style="width:240px">
      <div class="signup_wrap centered">
        <?php echo validation_errors('<p class="error">'); ?>
        <?php echo form_open("user/login"); ?>       
        <form>
          <label for="user_email">Enter your e-mail address:</label>
          <input type="text" id="user_email" style="height:12px"; name="user_email" value="<?php echo set_value('user_email'); ?>" required/>
          <div class="action_btns">
            <input type="submit" class="btn btn_white" value="Submit">
            <a href="#" id="back_btn" class="btn"><i class="fa fa-angle-double-left"></i>Back</a>
          </div>
        </form>
        <?php echo form_close(); ?>
      </div>
    </div>

</div>
</div>

<script type="text/javascript">
  $("#user_register").hide();
  $("#user_forgot").hide();


  $(function() {

      // Calling Register Form
      $("#register_form").click(function() {      
          $("#user_login").fadeOut("slow"); 
          $("#user_login").hide();        
          $("#user_register").fadeIn("slow");
          $("#user_register").show();
          $(".header_title").text('Register');
          return false;
      });

      // Going back to Login
      $("#back_btn").click(function() {
          $("#user_register").fadeOut("slow");
          $("#user_register").hide();
          $("#user_forgot").fadeOut("slow");
          $("#user_forgot").hide();          
          $("#user_login").fadeIn("slow");
          $("#user_login").show();
          $(".header_title").text('Login');
          return false;
            });
      //Forgot password
      $("#forgot_password").click(function() {
          $("#user_login").fadeOut("slow");
          $("#user_login").hide();
          $("#user_forgot").fadeIn("slow");
          $("#user_forgot").show();
          $(".header_title").text('Forgot Password');
          return false;
      });
    })
</script>