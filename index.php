<!DOCTYPE html>
<html>
	<head>
		<?php error_reporting(E_ALL); ?>
		<?php ini_set("error_reporting", 1); ?>
		<title>Welcome&nbsp;&ndash;&nbsp;Aspen Framework</title>
		<script>
			var INTERFACE_URL = "http://refract.nasonfish.com";
		</script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<?php include 'libs/gradient.php';?> 
		<style type="text/css">
			body<?=Background::getBackground("#33CC33", "#D6F5D6", "#33CC33", Direction::Bottom_Right);?>
			a{}
		</style>
		<link href="./css/bootstrap.css" rel="stylesheet">
		<link href="./css/bootstrap-responsive.css" rel="stylesheet">
		<link href="./css/refract.css" rel="stylesheet">
		<?php
			function formatIfLink($key, $str){
				if (substr($str, 0, 4) === "http"){
					return "<a href=" . $str . ">".$str."</a>";
				} else if(substr($str, 0, 10) === "&lt;py&gt;") {
//					if(isset($_REQUEST[$key])){
//						$python = 'input="""'.$_REQUEST[$key].'""";nick="Username";chan="#Interface";bot_nick="Refract";'.substr($str, 11);
//						print exec("python2.7 -c \\'$python\\'");
//						print "exec('" . "python2.7 -c \\'$python\\'" . "');";
//						print exec('python2.7 -c \'input="""nasonfish""";nick="Username";chan="#Interface";bot_nick="Refract";print("http://dhmc.us/players/view/" + input + "/");\'');
//						return exec("python2.7 -c \\'$python\\'");
//					} else {
						return "Python: <code>" . substr($str, 11) . "</code>. <!--Enter Input: <form><input style=\"padding:5px\" type=\"text\" name=\"".$key."\"></form>-->";
//					}
				} else {
					return $str;
				}
			}
		?>
	</head>
	<body>
		<div class="row-fluid">
	<!--		<div class="span6 offset3 alert alert-info navbar-static-top">
				<div class="pull-left">
					<h2>Refract Web Interface</h2>
				</div>
				<div class="pull-right">
					<p>This is the bot Refract's web interface with interacting with the bot outside of IRC.</p>
					<p>Currently we only have a list of Factoids, but come back soon for more stuff!</p>
				</div>
			</div>-->
			<div class="span8 offset2 alert alert-success">
				<table class="table table-striped table-bordered table-hover table-condensed">
					<tr>
						<th>Key</th>
						<th>Value</th>
						<th>User</th>
					</tr>
					<?php
					$db = new SQLite3("../EsperNet.db");
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