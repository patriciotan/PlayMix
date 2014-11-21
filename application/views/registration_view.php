<div class="wrapper" style="height:500px">

<div class="container centered" style="top:60%; transform:translateY(-50%); min-width:800px">



      <!-- Register Form -->
    <div id="user_register" class="centered" style="width:240px">
      <div class="signup_wrap centered">
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
</div>
</div>
