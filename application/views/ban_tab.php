<style type="text/css">
	h3 {
		text-align: center;
	}
</style>

<div class="span8" style="margin-left: 95px; overflow:hidden">
	<div class="row">

	<?php echo form_open("user/ban"); ?>
	<form>
		<div class="span3"><br />
			<h3>Banning List</h3><br />
			<div class="admin_container">
				<table class="feed_table" style="width:250px;">
					<?php if(!is_null($banlist)) { if(is_array($banlist->result())) { foreach($banlist->result() as $row): ?>
						<tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
							<td><?=$row->user_username;?></td>
						</tr>
					<?php endforeach; } } ?>
				</table>
			</div><br/>
			<div class="btn-group">
				<button type="submit" class="btn" style="width:135px;">Ban</button>
	<?php echo form_close();?>
	<?php echo form_open("user/ban_reset"); ?>
				<button type="submit" class="btn" style="width:135px;">Reset</button>
			</div>
		</div>
	</form>
	<?php echo form_close();?>

	<?php echo form_open("user/add_ban"); ?>
	<form>
		<div class="offset1 span3">
			<h3>PlayMix Users</h3><br/>
			<div>
				<!-- <table class="feed_table" style="width:250px;"> -->
					<select name="users[]" style="width:270px; height:292px;" multiple>
					<?php foreach($users->result() as $row): ?>
						<option value="<?=$row->user_id;?>"><?=$row->user_username;?></option>
						<!-- <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
							<td><input name="users[]" type="option" value="<?=$row->user_id;?>" /><?=$row->user_username;?></td>
						</tr> -->
					<?php endforeach;?>
					</select>
				<!-- </table> -->
			</div>
			<div class="btn-group" style="margin-top:10px;">
				<button type="submit" class="btn" style="width:135px;">Add</button>
			</div>
		</div>
	</form>
	<?php echo form_close();?>

	</div>
<br />
</div>