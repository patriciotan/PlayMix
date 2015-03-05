<div id="wrapper">
  <div class="container" > <!-- This is the div that contains the most-played songs according to the database -->
    <div class="centered span12" style="top:100px; left:45px;">
      <span id="open_tab" style="display:none"><?=$tab?></span>
      <div class="tabbable tabs-left" id="adminTab">
        <ul class="nav nav-tabs" style="margin-right:-21px">
          <li><a href="#ban" data-toggle="tab" id="banTab">Ban Users</a></li>
          <li><a href="#banned" data-toggle="tab" id="bannedTab">Banned Users</a></li>
          <li><a href="#delete" data-toggle="tab" id="deleteTab">Delete Songs</a></li>
        </ul>
        <div class="tab-content box_container span9" style="overflow:hidden">
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

    var tab = $('#open_tab').html();
    $('.tab-pane').removeClass("active");
    $('#'+tab).addClass('active');

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