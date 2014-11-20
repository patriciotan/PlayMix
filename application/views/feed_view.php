<div id="wrapper">

 <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div style="position:relative; left:-120px;">
          <div style="position:relative; padding-top:8px; top:5px;left:30px;"><img src="<?php echo base_url(); ?>assets/forward.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></div>
          <div style="padding-left:50px;">
          <a class="brand" href="#">PlayMix</a>
          </div>
          <div style="height: 0px;" class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Profile</a></li>
              <li><a href="#">Upload</a></li>
            &nbsp; 
              <li><div class="input-group">

  <input type="text" class="form-control" placeholder="Search..." style="position: relative; left: 50px;">
</div></li>
          <li><a style="position: relative; left: 50px;" href="<?php echo base_url('index.php/user/logout'); ?>">Sign out</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
</div>


<div class="container" > <!-- This is the div that contains the most-played songs according to the database -->

<div style="position:relative; top:220px; padding-left:-20px; width:500px;"><ul style="width:500px;"><h1>FEED</h1></ul>


  
    <?php foreach($rec->result() as $row): ?>


    <a href="#"><li><p><img src="<?php echo base_url(); ?>assets/control_play.ico" style="float:left;margin-top:5px;z-index:5" alt="logo"/></a> 
    &nbsp;<?php echo $row->audio_title; ?> 
    &nbsp;<?php echo $row->audio_play_count; ?> plays</p></li>



    <?php endforeach;
    ?>



</div>

</div>