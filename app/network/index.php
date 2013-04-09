<!DOCTYPE html>
<html>
	<body>
		<div class="row-fluid">
			<div class="span8 offset2 alert alert-success">
<?php
	$pages = simplexml_load_file("pages.xml");
	var_dump($pages);
	var_dump($pages->page);
	var_dump($pages->pages);
	foreach($pages->pages->page as $page){
		print '<a href="/'.NETWORK.'/'.$page->file.'/">'.$page->title.'</a> - '.$page->desc;
	}
?>
			</div>
		</div>
	</body>
</html>