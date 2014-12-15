<div id="wrapper">
  <div class="container" > <!-- This is the div that contains the most-played songs according to the database -->
    <div class="centered" style="position:relative; top:150px; width:870px;">
      <div class="tabbable tabs-left" id="adminTab">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#ban" data-toggle="tab" id="banTab">Ban Users</a></li>
          <li><a href="#banned" data-toggle="tab" id="bannedTab">Banned Users</a></li>
          <li><a href="#delete" data-toggle="tab" id="deleteTab">Delete Songs</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="ban">
            <?php echo $ban; ?>
          </div>
          <div class="tab-pane" id="banned">
            <?php echo $banned; ?>
          </div>
          <div class="tab-pane" id="delete">
            <?php echo $delete; ?>
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

    $('#banTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#ban").addClass("active");
    });
    $('#bannedTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#banned").addClass("active");
    });
    $('#deleteTab').click(function(){
      $('.tab-pane').removeClass("active");
      $("#delete").addClass("active");
    });

  });
</script>