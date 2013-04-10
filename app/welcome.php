<!DOCTYPE html>
<html>
	<body>
		<div class="row-fluid">
			<div class="span8 offset2 alert alert-success">
				<?php 
				foreach($config['bot']['networks'] as $network){
					print('<li><a href=/'.$network.'>Network '.$network.'</a></li>');
				}
				?>
			</div>
		</div>
	</body>
</html>