<div class="navbar navbar-fixed-top">
      <div class="navbar-inner" style="height: 53px;">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div style="position:relative; left:-100px;">
          <div style="position:relative; padding-top:8px; top:5px;left:30px;"><img src="<?php echo base_url(); ?>assets/forward.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></div>
          <div style="padding-left:50px;">
          <a class="brand" href="<?php echo base_url('index.php/user/feed/navbar_user'); ?>">PlayMix</a>
          </div>
          <div style="height: 0px;" class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Profile</a></li>
              <li><a href="#">Upload</a></li>
              <li><div class="input-group">

  <input type="text" class="form-control" placeholder="Search..." style="position: relative; left: 50px; top:5px;">
</li>
          <li><a style="position: relative; left: 800px;" href="<?php echo base_url('index.php/user/logout'); ?>">Log out</a></li>
            </ul>
            </div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){

    $('li > a').click(function() {
      $('li').removeClass();
      $(this).parent().addClass('active');
    });

  });
</script>