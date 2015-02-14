            <div class="centered" id="edit_account_info">
              <div>
                <?php echo form_open("user/edit_account_info"); ?>
                <form>
                    <div style="float:left; margin-right:30px">
                        <label for="user_username">User name</label>
                        <input type="text" id="user_username" name="user_username" value="<?=$info['user_name']?>" required/>
                        <label for="user_email">Email</label>
                        <input type="text" id="user_email" name="user_email" value="<?=$info['user_email']?>" required/>
                        <label for="user_password">Old Password</label>
                        <input type="password" id="user_password" name="user_password" value=""/>
                        <label for="new_user_password">New Password</label>
                        <input type="password" id="new_user_password" name="new_user_password" value=""/>                        
                    </div>
                    <div style="margin-top:20px; width:90%; float:left; display:block">
                      <input type="submit" class="btn btn_red"  value="Save" id="submit_edit" style="margin-right:10px"/>
                      <input type="reset" class="btn"  value="Cancel" id="cancel_edit_account" />
                    </div> 

                </form>
                <?php echo form_close();?>                   
                </div>
            <?php echo validation_errors('<p class="error">'); ?>
            </div>

            <script>
                $(document).ready(function(){
                    
                    $('#user_password').change(function()
                        {
                            if($('#user_password').val()!=''){
                                $('#new_user_password').prop('required',true);
                            }

                            else if($('#user_password').val()==''){
                                $('#new_user_password').prop('required',false);
                            }

                        });

                    $('#new_user_password').change(function()
                        {
                            if($('#new_user_password').val()!=''){
                                $('#user_password').prop('required',true);
                            }
                            else if($('#new_user_password').val()==''){
                                $('#user_password').prop('required',false);
                            }                            

                        });

                });
            </script>