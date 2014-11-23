<div class="wrapper" style="height:500px">

<div class="container centered" style="top:30%; transform:translateY(-50%); min-width:800px">
    <div id="user_forgot" class="centered" style="width:240px">
      <div class="signup_wrap centered">
        <p><a href="<?php echo base_url('index.php/user/index'); ?>" id="register_form" style="display:inline">Home</a> / Registration</p>
        <p>&nbsp;</p><p>&nbsp;</p>
        <?php echo form_open("user/forgot_validation"); ?>       
        <form>
          <label for="user_email">Enter your e-mail address:</label>
          <input type="text" id="user_email" style="height:12px"; name="user_email" value="<?php echo set_value('user_email'); ?>" required/>
          <div class="action_btns">
            <input type="submit" class="btn btn_white" value="Ok">
          </div>
        </form>
        <?php echo form_close(); ?>

        <?php echo validation_errors('<p class="error">'); ?>
      </div>
    </div>

</div>
</div>
