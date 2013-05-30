
<?php
	$pages = simplexml_load_file("network/pages.xml");
	foreach($pages->page as $page){
		print '<li><a href="/'.NETWORK.'/'.$page->file.'/">'.$page->title.'</a> - '.$page->desc . ($page->api == "true" ? '<small>(<a href="/api/'.NETWORK.'/'.$page->apifile.'">api</a>)</small>' : '').'</li>';
	}
?>