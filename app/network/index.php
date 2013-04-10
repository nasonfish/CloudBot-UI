<!DOCTYPE html>
<html>
	<body>
		<div class="row-fluid">
			<div class="span8 offset2 alert alert-success">
<?php
	$pages = simplexml_load_file("network/pages.xml");
	foreach($pages->page as $page){
		print '<li><a href="/'.NETWORK.'/'.$page->file.'/">'.$page->title.'</a> - '.$page->desc . '</li>';
	}
?>
			</div>
		</div>
	</body>
</html>