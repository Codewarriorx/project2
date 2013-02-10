<div class="grid_12">
	<h4 class="adminHeader">Classmates Feeds to Follow</h4>
</div>
<div class="clear"></div>

<div class="grid_12">
	<form method="POST" action="admin/follow">
		<div class="adminForm">
			<span class="inputLabel">Student RSS Feeds:</span>
			<span class="inputField">
				<select name="follow[]" id="chosen" tabindex="-1" multiple="" data-placeholder="Select a student">
					<?php echo $options; ?>
				</select>
				<input class="button purchase" type="submit" value="Save" name="save">
			</span>
		</div>
	</form>
	<div class="clear"></div>
</div>
<div class="clear"></div>