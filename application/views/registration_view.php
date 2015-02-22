<div class="wrapper" style="height:500px">

<div class="container centered" style="top:60%; transform:translateY(-50%); min-width:800px">



      <!-- Register Form -->
    <div id="user_register" class="centered" style="width:240px">
      <div class="signup_wrap centered">
      <ul class="breadcrumb">
        <li><a href="<?php echo base_url('index.php/user/index'); ?>">Home</a> <span class="divider">/</span></li>
        <li class="active">Registration</li>
      </ul>
      <p>&nbsp;</p>
      <p><legend>Register an Account</legend></p>
      <?php echo form_open("user/reg_validation"); ?>       
        <form>
          <label for="user_username">User Name</label>
          <input type="text" id="user_username" style="height:12px"; name="user_username" maxlength="256" value="<?php echo set_value('user_username'); ?>" required/>
          

          <label for="user_email">Email Address</label>
          <input type="text" id="user_email"style="height:12px"; type="user_email" name="user_email" value="<?php echo set_value('user_email'); ?>" required />
                

          <label for="user_password">Password</label>
          <input type="password" id="user_password"style="height:12px"; name="user_password" maxlength="20" value="<?php echo set_value('user_password'); ?>" required />
         

          <label for="user_conpassword">Confirm Password</label>
          <input type="password" style="height:12px"; id="user_conpassword" name="user_conpassword" maxlength="20" value="<?php echo set_value('user_conpassword'); ?>" required />

          <p>By clicking Sign Up, you agree to our <a href="#" id="termslink">Terms of Use</a></p>

          <div class="action_btns">
            <input type="submit" style="width:106px;" class="btn btn_white" value="Sign Up">
            <input type="reset" style="width:106px;" class="btn btn_red pull-right"  value="Reset" />
          </div>
        </form>
        <?php echo form_close(); ?>



      <p><?php echo validation_errors('<p class="error">'); ?></p>
       <!-- type="submit" class="btn btn-primary" value="Submit" -->
      </div>

    </div>
</div>
</div>

        <div id="popup" class="notifpopup" style="display:none">
          <div id="popup-dialog" class="notifpopupdialog">
            <p><legend>PlayMix Terms of Use</legend></p>
            <p id="popup-message">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <br/>
            <a href="#" id="gotthat" class="btn btn-white" style="position:relative; width:15%; margin:0 auto">Got that!</a>
          </div>
        </div>


<script type="text/javascript">
  $(document).ready(function(){

    $("#gotthat").click(function(){
      $("#popup").fadeOut("fast");
      $("#popup").hide();
    });

    $("#termslink").click(function(){
      $("#popup").fadeIn("fast");
      $("#popup").css("display","inline");
      $("#popup").show();
      $("#popup-dialog").fadeIn("fast");
    });

  });
</script>