<?php
	$db = new SQLite3("../../".NETWORK.".db");
	$result = $db->query('SELECT * FROM mem');
	$row = array();
	$row['success'] = true;
	$i = 0; 
	while($res = $result->fetchArray()){
		if(!isset($res['word'])) continue; 
			$row[$i]['word'] = $res['word']; 
			$row[$i]['data'] = $res['data']; 
			$row[$i]['nick'] = $res['nick']; 
			$i++; 
	}
	
	print(json_encode($row));
?>
