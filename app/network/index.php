<!DOCTYPE html>
<html>
	<body>
		<div class="row-fluid">
			<div class="span8 offset2 alert alert-success">
<?php
	$pages = simplexml_load_file("network/pages.xml");
	foreach($pages->page as $page){
		print '<li><a href="/'.NETWORK.'/'.$page->file.'/">'.$page->title.'</a> - '.$page->desc . ($page->api == "true" ? '<small>(<a href="/api/'.NETWORK.'/'.$page->apifile.'">api</a>)</small>' : '').'</li>';
	}
?>
			</div>
		</div>
	</body>
</html>