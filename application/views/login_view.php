<div class="wrapper" style="height:500px">

<div class="container centered" style="top:50%; transform:translateY(-50%); min-width:800px">
  <!-- Username & Password Login form -->
    <div id="user_login" class="centered" style="width:240px;">
      <div class="signup_wrap centered">
      <p><legend>Log in to PlayMix!</legend></p>
      
        <?php echo form_open("user/login"); ?>
        <form class="centered">
          <label for="user_email">Email</label>
          <input type="text" id="user_email" name="user_email" value="" required />
          <br />

          <label for="user_password">Password</label>
          <input type="password" id="user_password" name="user_password" value="" maxlength="20" required/>
          <br />
        <a href="<?php echo base_url('index.php/user/forgot'); ?>" id="forgot_password">Forgot password?</a>
        <p></p>
          <div class="action_btns">
            <input type="submit" style="width:106px;" class="btn btn_white"  value="Login" />
            <input type="reset" style="width:106px;" class="btn btn_red pull-right"  value="Reset" />
          </div>   
        </form>
        <?php echo form_close();?>

        <div>
          <p style="font-size:13px">
          <a href="<?php echo base_url('index.php/user/registration'); ?>" id="register_form" style="display:inline">Register</a> now!
          </p>
        </div>
        <?php echo validation_errors('<p class="error">'); ?>
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