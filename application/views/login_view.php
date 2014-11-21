<div class="wrapper" style="height:500px">

<div class="container centered" style="top:60%; transform:translateY(-50%); min-width:800px">
  <!-- Username & Password Login form -->
    <div id="user_login" class="centered" style="width:240px;">
      <div class="signup_wrap centered">
      <?php echo validation_errors('<p class="error">'); ?>
        <?php echo form_open("user/login"); ?>
        <form class="centered">
          <label for="user_email">Email</label>
          <input type="text" id="user_email" name="user_email" value="" required />
          <br />

          <label for="user_password">Password</label>
          <input type="password" id="user_password" name="user_password" value="" required/>
          <br />
        <a href="<?php echo base_url('index.php/user/forgot'); ?>" id="forgot_password">Forgot password?</a>
          <div class="action_btns">
            <input type="submit" class="btn btn_white"  value="Login" />
            <input type="reset" class="btn btn_red"  value="Reset" />
          </div>   
        </form>
        <?php echo form_close();?>

        <div>
          <p style="font-size:13px">
          <a href="#" class="social_box fb">
            <span class="icon"><i class="fa fa-facebook"></i></span>
            <span class="icon_title">Log in with Facebook</span>
          </a>or <a href="<?php echo base_url('index.php/user/registration'); ?>" id="register_form" style="display:inline">Register</a> now!
          </p>
        </div>
      </div>
    </div>

</div>
</div>
