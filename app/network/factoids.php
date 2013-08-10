<?php
	function formatIfLink($key, $str){
		if (substr($str, 0, 4) === "http"){
			return "<a href=" . $str . ">".$str."</a>";
		} else if(substr($str, 0, 10) === "&lt;py&gt;") {
			if(isset($_REQUEST[$key])){
				$str = htmlspecialchars_decode($str);
				$python = 'input="""'.$_REQUEST[$key].'""";nick="Username";chan="#Interface";bot_nick="Refract";'.substr($str, 4);
				return "<strong>Result: </strong>" . exec("python -c '$python'"); // TODO python2.7 instead of python
			} else {
				return "Python: <code>" . substr($str, 10) . "</code>. <br> Enter Input: <form><input style=\"padding:5px\" type=\"text\" name=\"".$key."\"></form>";
			}
		} else {
			return $str;
		}
	}
?>
	
	<body>
		<div class="row-fluid">
			<div class="span8 offset2 alert alert-success">
				<table class="table table-striped table-bordered table-hover table-condensed">
					<tr>
						<th>Key</th>
						<th>Value</th>
						<th>User</th>
					</tr>
					<?php
					$db = new SQLite3("../../".NETWORK.".db");
					$result = $db->query('SELECT * FROM mem');
					while($row = $result->fetchArray()):
						foreach($row as $key => $val){
							$row[$key] = htmlspecialchars($val);
						}
						print "<tr>";
							print "<td>" . $row['word'] . "</td>";
							print "<td>" . formatIfLink($row['word'], $row['data']) . "</td>";
							print "<td>" . $row['nick'] . "</td>";
						print "</tr>";
					endwhile;
					?>
				
				</table>
			</div>
		</div>
	</body>
</html>
