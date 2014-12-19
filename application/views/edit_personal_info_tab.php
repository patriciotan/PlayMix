            <div class="centered" id="edit_personal_info">
              <div>
                <?php echo form_open("user/edit_personal_info"); ?>
                <form>
                  <div style="float:right; margin-right:30px">
                    <label for="user_fname">First name</label>
                    <input type="text" id="user_fname" name="user_fname" value="" />
                    <label for="user_lname">Last name</label>
                    <input type="text" id="user_lname" name="user_lname" value="" />
                    <label for="user_city">City</label>
                    <input type="text" id="user_city" name="user_city" value="" />
                    <label for="user_country">Country</label>
                    <input type="text" id="user_country" name="user_country" value="" />                  
                    <br/>
                    <br/>

                    <label for="user_fb">Facebook</label>
                    <input type="text" id="user_fb" name="user_fb" value="" />
                    <label for="user_google">Google+</label>
                    <input type="text" id="user_google" name="user_google" value="" />
                    <label for="user_twitter">Twitter</label>
                    <input type="text" id="user_twitter" name="user_twitter" value="" />   

                    <div style="margin-top:20px">
                      <input type="submit" class="btn btn_white"  value="Submit" id="submit_edit" style="margin-right:10px"/>
                      <input type="reset" class="btn btn_red"  value="Cancel" id="cancel_edit" />
                    </div>                    
                  </div>

 

                  <div>
                    <div id="img_container" class="profile-circular-mask" style="float:left;">
                      <img class="img_profile" src="<?php echo base_url();?><?php echo $info['user_photo']?>"/>
                    </div>                  
                    <!--<ul style="list-style:none"></ul>-->
                    <div style="float:left;width:50%; margin-top:20px">
                      <input type="file" name="user_photo" accept="image/png, image/jpeg">
                    </div>
                  </div>
                  <div style="float:left; margin-top:40px">
                    <label for="user_bio">Biography</label>
                    <textarea id="user_bio" name="user_bio" value="" cols="40" rows="8" style="margin: 0px 0px 9px; width: 400px; height: 140px;"></textarea>                                   
                  </div>

                </form>
                <?php echo form_close();?>
              </div>
            
            </div>