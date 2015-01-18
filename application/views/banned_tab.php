<style type="text/css">
	h3 {
		text-align: center;
	}
</style>

<div class="span8" style="margin-left: 95px;">
	<div class="row">

		<?php echo form_open("user/unban"); ?>
		<form>
			<div class="span3"><br/>
				<h3>Banned Users</h3><br/>
				<div>
					<!-- <table class="feed_table" style="width:250px;"> -->
					<select name="users[]" style="width:270px; height:292px;" multiple>
						<?php if(!is_null($bannedlist)) { if(is_array($bannedlist->result())) { foreach($bannedlist->result() as $row): ?>
							<option value="<?=$row->user_id;?>"><?=$row->user_username;?></option>
							<!-- <tr class="<?php echo alternator('background:#cfc','background:#ffc'); ?>">
								<td><input name="users[]" type="checkbox" value="<?=$row->user_id;?>" /><?=$row->user_username;?></td>
							</tr> -->
						<?php endforeach; } } ?>
					</select>
					<!-- </table> -->
				</div>
				<div class="btn-group">
					<button type="submit" class="btn" style="width:135px;">Unban</button>
				</div>
			</div>
		</form>
		<?php echo form_close();?>

	</div>
<br />
</div>