<div class="wrapper" style="height:500px">

<div class="container centered" style="top:60%; transform:translateY(-50%); min-width:800px">
    <div id="user_forgot" class="centered" style="width:240px">
      <div class="signup_wrap centered">
        <?php echo validation_errors('<p class="error">'); ?>
        <?php echo form_open("user/login"); ?>       
        <form action="<?php echo base_url('user/forgot_login'); ?>">
          <label for="user_email">Enter your e-mail address:</label>
          <input type="text" id="user_email" style="height:12px"; name="user_email" value="<?php echo set_value('user_email'); ?>" required/>
          <div class="action_btns">
            <input type="submit" class="btn btn_white" value="Submit">
          </div>
        </form>
        <?php echo form_close(); ?>
      </div>
    </div>

</div>
</div>
