<div id="wrapper">
  <div class="container" > <!-- This is the div that contains the most-played songs according to the database -->
    <div class="centered" style="position:relative; top:150px; width:870px;">
      <div class="tabbable" id="profileTab">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#ban" data-toggle="tab" id="personal_infoTab">Personal Info</a></li>
          <li><a href="#banned" data-toggle="tab" id="uploadedTab">Uploaded Songs</a></li>
          <li><a href="#delete" data-toggle="tab" id="playlistsTab">Playlists</a></li>
          <li><a href="#delete" data-toggle="tab" id="accountTab">Account</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="personal_info">
            <?php echo $personal_info; ?>
          </div>
          <div class="tab-pane" id="uploaded">
            <?php echo $uploaded; ?>
          </div>
          <div class="tab-pane" id="playlists">
            <?php echo $playlists; ?>
          </div>
          <div class="tab-pane" id="account">
            <?php echo $account; ?>
          </div>          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){

    $('li > a').click(function() {
      $('li').removeClass();
      $(this).parent().addClass('active');
    });

    $('#personal_infoTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#personal_info").addClass("active");
    });
    $('#uploadedTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#uploaded").addClass("active");
    });
    $('#playlistsTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#playlists").addClass("active");
    });
    $('#accountTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#account").addClass("active");
    });

  });
</script>