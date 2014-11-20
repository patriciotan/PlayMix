<div style="position:relative; top:200px; padding-left:500px; width:500px;"><ul style="width:500px;"><h1>Available Surveys</h1></ul>


	
		<?php foreach($rec->result() as $row): ?>


		<a href="#"><li><h1><?php echo $row->sur_title;
		?></h1></li></a>



		<?php endforeach;
		?>



</div>