<?php
	$ua = $_SERVER['HTTP_USER_AGENT'];
?>
				</div>
			</div>
			<div class="clear"></div>
			<div id="footer">
				<div class="grid_4">
					<h3>Browser &amp; IP</h3>
					<p><? echo $ua; ?></p>
					<p><? echo $_SERVER['REMOTE_ADDR']; ?></p>
				</div>
				<div class="grid_5">
					<h3>Where you came from</h3>
					<p><? echo $_SERVER['HTTP_REFERER']; ?></p>
				</div>
				<div class="grid_3">
					<h3>Screen Resolution</h3>
					<p><script>document.write(screen.width + ' x ' + screen.height);</script></p>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="js/jquery.shadow/jquery.shadow.js"></script>
		
		<script type="text/javascript">	
			$(document).ready(function() {
				$('.imgSub').on('click', function() {
					$('.imgMain').attr('src', $(this).attr('src'));
				});
			} );
		</script>
	</body>
</html>