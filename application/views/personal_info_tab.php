            <div class="centered" id="personal_info_contents" style="margin-bottom:220px">
              <a href="#" style="float:right" id="edit_personal_info_button"><img src="<?php echo base_url()?>assets/edit_ico.png" style="height:20px;width:20px;"/></a>
              <div id="image">
                <div id="img_container" class="profile-circular-mask">
                  <img class="img_profile" src="<?php echo base_url();?><?php echo $info['user_photo']?>"/>
                </div>

              </div>
            
              <div id="info">
                <div id="user_name">
                  <h1><?=$info['user_fname']?>&nbsp;<?=$info['user_lname']?></h1>
                </div>
                <div id="user_country">
                  <h3><?=$info['user_city']?>, &nbsp;<?=$info['user_country']?></h3>
                </div>
                <div id="user_bio" style="border-top:1px solid gray; margin-top:20px">
                  <br/>
                  <h3>Biography</h3>
                  <br/>
                  <p style="margin-left:30px"><?=$info['user_bio']?></p>
                </div>          
            
                <div id="user_sites" style="border-top:1px solid gray; margin-top:20px">
                  <br/>
                  <h3>Websites</h3>
                  <ul class="user_websites">
                    <br/>
                    <a href="<?php echo $info['user_fb']?>" id="fb"><img src="" id="fb_img"/></a>
                    <a href="<?php echo $info['user_google']?>" id="google"><img src="" id="google_img"/></a>
                    <a href="<?php echo $info['user_twitter']?>" id="twitter"><img src="" id="twitter_img"/></a>
                  </ul>
                </div>
              </div>
            
            
            </div>