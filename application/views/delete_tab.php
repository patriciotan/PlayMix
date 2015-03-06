<style type="text/css">
	h3 {
		text-align: center;
	}
</style>

<div class="span8" style="margin-left: 50px;">
	<div class="row">

	<?php echo form_open("user/delete"); ?>
	<form>
		<div class="span3"><br />
			<h3>Deletion List</h3><br />
			<div class="admin_container" style="width:268px">
				<table class="feed_table" style="width:250px;">
					<?php if(!is_null($deletelist)) { if(is_array($deletelist->result())) { foreach($deletelist->result() as $row): ?>
						<tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
							<td><?=$row->audio_title;?></td>
						</tr>
					<?php endforeach; } } ?>
				</table>
			</div><br/>
			<div class="btn-group">
				<button type="submit" class="btn" style="width:100px; margin-right:20px">Delete</button>
	<?php echo form_close();?>
	<?php echo form_open("user/delete_reset"); ?>
				<button type="submit" class="btn" style="width:100px;">Reset</button>
			</div>
		</div>
	</form>
	<?php echo form_close();?>

	<?php echo form_open("user/add_delete"); ?>
	<form>
		<div class="offset1 span3">
			<h3>PlayMix Songs</h3><br/>
			<div>
				<!-- <table class="feed_table" style="width:250px;"> -->
					<select name="songs[]" style="width:270px; height:292px;" multiple required>
					<?php 
						if(!empty($songs))
							foreach($songs->result() as $row): 
					?>
						<option value="<?=$row->audio_id;?>"><?=$row->audio_title;?></option>
						<!-- <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
							<td><input name="songs[]" type="checkbox" value="<?=$row->audio_id;?>" /><?=$row->audio_title;?></td>
						</tr> -->
					<?php endforeach;?>
					</select>
				<!-- </table> -->
			</div>
			<div class="btn-group" style="margin-top:10px;">
				<button type="submit" class="btn" style="width:100px;">Add</button>
			</div>
		</div>
	</form>
	<?php echo form_close();?>

	</div>
<br />
</div>