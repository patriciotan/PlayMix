            <div class="centered" id="edit_personal_info" style="overflow:auto; margin-bottom:120px;">
              <div>
                <?php echo form_open_multipart("user/update_personal_info"); ?>
                <form method="post" action="some_action" enctype="multipart/form-data">
                  <div style="float:right; margin-right:30px">
                    <label for="user_fname">First name</label>
                    <input type="text" id="user_fname" name="user_fname" value="<?=$info['user_fname']?>" />
                    <label for="user_lname">Last name</label>
                    <input type="text" id="user_lname" name="user_lname" value="<?=$info['user_lname']?>" />
                    <label for="user_city">City</label>
                    <input type="text" id="user_city" name="user_city" value="<?=$info['user_city']?>" />
                    <label for="user_country">Country</label>
                    <input type="text" id="user_country" name="user_country" value="<?=$info['user_country']?>" />                  
                    <br/>
                    <br/>

                    <label for="user_fb">Facebook</label>
                    <input type="text" id="user_fb" name="user_fb" value="<?=$info['user_fb']?>" />
                    <label for="user_google">Google+</label>
                    <input type="text" id="user_google" name="user_google" value="<?=$info['user_google']?>" />
                    <label for="user_twitter">Twitter</label>
                    <input type="text" id="user_twitter" name="user_twitter" value="<?=$info['user_twitter']?>" />   

                    <div style="margin-top:20px">
                      <input type="submit" class="btn btn_red"  value="Save" id="submit_edit" style="margin-right:10px"/>
                      <input type="reset" class="btn"  value="Cancel" id="cancel_edit_personal_info" />
                    </div>                    
                  </div>

 

                  <div>
                    <div id="img_container" class="profile-circular-mask" style="float:left;">
                      <img class="img_profile" id="user_photo" src="<?php echo base_url();?><?php echo $info['user_photo']?>"/>
                    </div>                  
                    <!--<ul style="list-style:none"></ul>-->
                    <div style="float:left;width:50%; margin-top:20px">
                      <a href="#" class="btn btn_white" id="select_pp" style="margin-left:44px">Select photo</a>
                    </div>
                  </div>
                  <div style="float:left; margin-top:40px">
                    <label for="user_bio">Biography</label>
                    <textarea id="user_bio" name="user_bio" cols="40" rows="8" style="margin: 0px 0px 9px; width: 400px; height: 140px;"><?=$info['user_bio']?></textarea>                                   
                  </div>
            <!--     </form>
                <?php echo form_close();?>-->
              </div>
            </div>


            <div id="popup_pp" class="notifpopup" style="display:none">

              <div id="popup_dialog_pp" class="notifpopupdialog" style="height:420px; width:430px;">
                <legend><h1 style="font-size:18px">Choose new photo</h1></legend>
                <div id="img_container" class="profile-circular-mask" style="position:relative; float:none; display:block; margin:-10px auto 30px auto; height:300px; width:300px;">                                                                
                      <img class="img_profile" id="user_current_photo" src="<?php echo base_url();?><?php echo $info['user_photo']?>"/>
                </div>
                <!--<?php echo form_open_multipart("user/do_uploadphoto"); ?>
                <form>-->
                <label class="upload-img-button" style="display:block; width:105px; float:left;">
                  <input type="file" name="user_new_photo" accept="image/png, image/jpeg, image/jpg" id="user_new_photo">
                  Upload new photo
                </label>
                </form>
                <?php echo form_close();?>
                
                <button class="btn" id="cancel_choose" style="float:right;">Close</button>
              </div>
              <div id="popup_bg" class="notifpopup" style="background: transparent;"></div>
            </div>
