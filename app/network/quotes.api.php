<?php
	$db = new SQLite3("../../".NETWORK.".db");
	var_dump($db);
	var_dump("../../".NETWORK.".db");
	$query = "SELECT * FROM quote";
	$query .= isset($_REQUEST['whereuser']) ? " WHERE nick LIKE \"%".(str_replace("\"", "\\\"",  $_REQUEST['whereuser']))."%\"" : "";
	$result = $db->query($query) or die(json_encode(array('success'=>false,'error'=>'Error with Database.')));
	$row = array();
	$row['success'] = true;
	$i = 0;
	var_dump($result);
	var_dump($query);
	while($res = $result->fetchArray()):
		if(!isset($res['word'])) continue; 
			$row[$i]['chan'] = $res['chan']; 
			$row[$i]['nick'] = $res['nick']; 
			$row[$i]['add_nick'] = $res['add_nick'];
			$row[$i]['msg'] = $res['msg'];
			$row[$i]['time'] = $res['time'];
			$i++; 
	endwhile;
	
	print(json_encode($row));
?>