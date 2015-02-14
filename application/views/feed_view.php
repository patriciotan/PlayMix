<!--<link href='http://fonts.googleapis.com/css?family=Cuprum&subset=latin' rel='stylesheet' type='text/css'>-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/styles_dialog.css" />-->
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.confirm.css" />-->




<div id="wrapper">


<div class="container" style="padding-bottom: 100px; padding-top: 80px;"> <!-- This is the div that contains the most-played songs according to the database -->
<div class="centered" style="position:relative; width:870px;">

<ul style="width:500px;"><h1>FEED</h1></ul>
  <table class="hover" id="mytable">  
    <thead>
      <th style="display:none"></th>
      <th style="display:none"></th>
      <th style="display:none"></th>
      <th width="5px"></th>
      <th width="5px"></th>
      <th style="display:none"></th>
      <th>TITLE</th>
      <th>ARTIST</th>
      <th width="50px">ADDED</th>
      <th width="50px">PLAYS</th>
    </thead>
    <tbody id="feedBody">
    <?php foreach($rec->result() as $row): ?>
      <tr id="<?=$row->audio_id;?>" class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
        <td style="display:none" value="<?=$row->audio_file;?>"><?=$row->audio_file;?></td>
        <td style="display:none"><?=$row->audio_photo;?></td>
        <td style="display:none"><?=$row->audio_id;?></td>
        <td align="center"><input id="play" onclick="playSong(this)" type="image" src="<?php echo base_url(); ?>assets/controls/play.png" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
        <td align="center"><input onclick="popUp(this)" type="image" src="<?php echo base_url(); ?>assets/controls/plus.ico" style="float:center;margin-top:5px;z-index:5;width:16px;height:16px;" alt="logo"/></td>
        <td style="display:none"><?=$row->user_id;?></td>
        <td align="left"><?=$row->audio_title;?></td>
        <td align="left"><a href="#" onclick="viewProf(this)"><?=$row->user_username;?></a></td>
        <td align="center"><?=$row->audio_date_added;?></td>
        <td align="right"><?=$row->audio_play_count;?></td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table>

  <?php echo form_open("user/artist_profile"); ?>
    <form>
      <input type="hidden" name="uid" id="uid" value="" style="display:none"/>
      <input type="submit" id="view_profile" style="display:none"/>
    </form>
  <?php echo form_close();?>  

</div>
</div>
</div>



<script type="text/javascript">

  $(document).ready(function(){


    $('#mytable').DataTable({
      "order": [[ 9, "desc" ]],
      "scrollCollapse": true,
      "paging":         false,
      "bInfo":          false,
      "scrollY":        "500px",     
      "oLanguage": {
        "sEmptyTable":     "No songs here!"
      },      "aoColumnDefs": [{
        'bSortable': false, 
        'aTargets': [-6,-7]
        }]
    });
  });

  function popUp(node){
    // $("#notificationContainer").fadeToggle(300);
    // $("#notification_count").fadeOut("slow");
    var id = node.parentNode.parentNode.cells[2].textContent;
    $("#confirmOverlay").css("display","inline");
    $("#confirmOverlay").fadeIn("fast");
    $("#confirmOverlay").show();
    // alert(id);
    $("#audio_id").attr("value",id);
    $("#added_from").attr("value","feed");
  
    //$("#popup-dialog").fadeIn("fast");
  }     

  function viewProf(node){

    var id = node.parentNode.parentNode.cells[5].textContent;
    $("#uid").attr("value",id);
    //alert("Value: "+$("#uid").val());
    $("#view_profile").click();
  }

</script>
<!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.confirm.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
<?php echo base_url('index.php/user/artist_profile')?>-->





   
        
