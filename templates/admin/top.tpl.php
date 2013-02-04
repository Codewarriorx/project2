<div class="grid_6">
	<h2 class="tallHeader">Admin</h2>
</div>
<div class="grid_6">
	
</div>
<div class="clear"></div>

<div class="grid_8">
	<div class="adminControlLeft">
		<h3>Choose an item to edit:</h3>
		<form method="POST" action="admin/edit">
			<select name="itemID">
				<?php echo $itemOptions; ?>
			</select>
			<input class="button purchase" type="submit" value="Select" name="edit">
		</form>
	</div>
</div>
<div class="grid_4">
	<div class="adminControlRight">
		<form method="POST" action="admin">
			<input class="button purchase" type="submit" value="Add a New Item" name="new">
		</form>
	</div>
</div>
<div class="clear"></div>