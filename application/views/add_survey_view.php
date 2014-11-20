<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
	 <link rel="icon" href="<?php echo base_url(); ?>assets/forward.ico" type="image/x-icon"/>
	<title>Add a survey</title>
	<style type="text/css">
	body{
		margin:0px;
		font-size:0.8em;
		font-family:Trebuchet MS
	}
	#mainContainer{
		width:840px;	
		margin:5px;
	}
	table,tr,td{
		vertical-align:top;
	}
	.textInput{
		width:400px;
	}
	html{
		margin:0px;
	}
	.formButton{
		width:75px;
	}
	textarea,input,select{
		font-family:Trebuchet MS;
	}
	i{
		font-size:0.9em;
	}
	</style>
	<link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/general.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
</head>
<body background="<?php echo base_url(); ?>assets/bluemin.jpg" style="background-size: 200%; position:absolute; top:12.5px;left:10px;height:200px;width:100px">

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
          <a class="brand" href="#">Taking You Forward Inc.</a>
          </div>
          <div style="height: 0px;" class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="<?php echo base_url(); ?>index.php/admin/admin_panel">Home</a></li>
              <li class="active"><a href="<?php echo base_url(); ?>index.php/admin/add_survey">Add a survey</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/admin/about_log">About Us</a></li>
              <li ><a href="<?php echo base_url(); ?>index.php/admin/logout">Sign out</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
</div>


<div style="position:relative; top:250px; padding-left:350px; width:700px;">
	<fieldset>
		<legend><h2>Add a survey</h2></legend>
	 <?php echo form_open("admin/reg_survey"); ?>
	
		<table>
			<tr>
				<td><label for="sur_title">Survey Title:</label></td>
				<td id="sur_title"></td>
				<td><input type="text" class="textInput" name="sur_title" id="sur_title"></td>
			</tr>
			<tr>
				<td><label for="sur_purpose">Survey Purpose:</label></td>
				<td id="sur_purpose"></td>
				<td><textarea type="textInput" class="textInput" name="sur_purpose" id="sur_purpose" style="height:100px;"></textarea></td>
			</tr>
			<tr>
				<td><label for="sur_source">Source:</label></td>
				<td id="sur_source"></td>
				<td><input type="text" class="textInput" name="sur_source"></textarea></td>
			</tr>
			<td>
			<input class="btn" type="submit" value="Submit">
			<input class="btn" type="reset" class="formButton" value="Reset">
			</td>
			
		</table>	
	<?php echo form_close(); ?>
</div>







