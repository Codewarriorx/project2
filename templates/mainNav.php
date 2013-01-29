<?php
	function activePage($page='Home'){
		global $PAGE;
		
		if($page == $PAGE){
			return "selectedTab";
		}
	}
?>
<a class="tab <?php echo activePage('Requests'); ?>" href="/smecAdmin/requests">
	<img src="/smecAdmin/icons/18-envelope.png" />
	<div class="tabLabel">Requests</div>
</a>
<a class="tab <?php echo activePage('Experts'); ?>" href="/smecAdmin/experts">
	<img src="/smecAdmin/icons/112-group.png" />
	<div class="tabLabel">Experts</div>
</a>
<a class="tab <?php echo activePage('Tags'); ?>" href="/smecAdmin/tags">
	<img src="/smecAdmin/icons/15-tags.png" />
	<div class="tabLabel">Tags</div>
</a>
<a class="tab <?php echo activePage('Admins'); ?>" href="/smecAdmin/gateKeepers">
	<img src="/smecAdmin/icons/20-gear2.png" />
	<div class="tabLabel">Admins</div>
</a>