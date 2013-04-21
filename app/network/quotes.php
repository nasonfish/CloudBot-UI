	
	<body>
		<?php
			function parseArray($array){
				$list = "[";
				while($val = $array->fetchArray()){
					$list .= $val['nick'] . ",";
				}
				$list = substr($list, 0, strlen($list) - 1); // Remove the last ",".
				$list .= "]";
				return $list;
			}
		$db = new SQLite3("../../".NETWORK.".db");
		$users = $db->query('SELECT DISTINCT nick FROM quote LIMIT 8');
		$allUsers = $db->query('SELECT DISTINCT nick FROM quote LIMIT 100');
		?>
		<div class="row-fluid">
			<div class="span8 offset2 alert alert-success">
				<h4>Filter a user? </h4> 
				<form>
					<input style="padding:5px" autocomplete="off" type="text" data-provide="typeahead" data-souce="<?= parseArray($allUsers) ?>" name="whereuser">
					<?php 
					$i = 0;
					while($row = $users->fetchArray()):
						print '<a href="?whereuser='.$row['nick'].'"><input type="button" name="whereuser" value="'.$row['nick'].'"></input></a>';
					endwhile;
					?>
				</form>
				<table class="table table-striped table-bordered table-hover table-condensed">
					<tr>
						<th>Channel</th>
						<th>Nick</th>
						<th>Adder</th>
						<th>Message</th>
					</tr>
					<?php
					$query = "SELECT * FROM quote";
					$query .= isset($_REQUEST['whereuser']) ? " WHERE nick LIKE \"%".(str_replace("\"", "\\\"",  $_REQUEST['whereuser']))."%\"" : "";
					$result = $db->query($query) or die("An error occurred with your query. Please edit your filters and try again.");
					while($row = $result->fetchArray()):
						foreach($row as $key => $val){
							$row[$key] = htmlspecialchars($val);
						}
						print "<tr>";
							print "<td>" . $row['chan'] . "</td>";
							print "<td>" . $row['nick'] . "</td>";
							print "<td>" . $row['add_nick'] . "</td>";
							print "<td>" . htmlspecialchars("<") . $row['nick'] . htmlspecialchars("> ") . $row['msg'] . "</td>";
						print "</tr>";
					endwhile;
					?>
				
				</table>
			</div>
		</div>
	</body>
</html>