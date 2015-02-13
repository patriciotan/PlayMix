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


<script type="text/javascript">
  $(document).ready(function(){

    $('#loginFb').click(function(){
      alert('This functionality will be coming soon!');
    });

  });
</script>