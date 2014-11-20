<div class="bs-docs-section" style="position:absolute; top:12.5px;left:10px;height:200px;width:2000px">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
            <h1 id="forms"> &nbsp; &nbsp;Taking You Forward Inc.</h1>
            </div>
          </div>
        </div>
</div>
        <div class="row" style="position:absolute;top:180px;left:500px;height:200px;width:400px">
	      <h3>Thank you for joining us!</h3>
        </div>
        <div class="row" style="position:absolute;top:240px;left:500px;height:200px;width:400px">
        <div id="content">
		<div class="signup_wrap">
		<div class="signin_form"> 
		<?php echo form_open("user/login"); ?>
          <div class="col-lg-6">
            <div class="well bs-component">
              <form class="form-horizontal">
                <fieldset>
                  <legend>Sign in</legend>
                  <div class="form-group">
                    <input name="email" type="email" for="email" placeholder="Email" id="email">
                    <div class="col-lg-10">
                      <input for="pass" id="pass" name="pass" type="password" class="form-control" placeholder="Password" onkeypress="capLock(event)" required>
                       <SPAN><div id="divMayus" style="visibility:hidden">Caps Lock is on.</div>
                    </div>
                  </div>
    
                     
                      <div class="checkbox">
                        <label>
                          <input type="checkbox">Keep me logged in
                        </label>
                       
                        <br><br><input name="login" type="submit" class="btn btn-default" value="Submit" style="position:relative; left:-15px;">
                         <a class="btn btn-default" href="<?php echo base_url(); ?>index.php/user"><i class="fa fa-angle-double-left"></i>Back</a></li>
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                  </div>
                  </fieldset>

                        <script>

                        function capLock(e){
                             kc = e.keyCode?e.keyCode:e.which;
                             sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
                                 if(((kc >= 65 && kc <= 90) && !sk)||
                                  ((kc >= 97 && kc <= 122) && sk))
                                  document.getElementById('divMayus').style.visibility = 'visible';
                                 else
                                  document.getElementById('divMayus').style.visibility = 'hidden';
                                }

                        </script>


