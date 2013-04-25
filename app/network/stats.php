<body>
	<div class="row-fluid">
		<div class="span8 offset2 alert alert-success">
			<?php
			if(!isset($_REQUEST['channel'])):
				?>
				<h3>Select a channel to view the stats of: </h3>
				<ul>
					<?php if(!in_array($config['pages']['stats']['channels'], "*")):
						foreach($config['pages']['stats']['channels'] as $channel): ?>
							<li><a href="?channel=<?=$channel?>"><?=$channel?></a></li>
						<? endforeach;
					else:
						$db = new SQLite3("../../".NETWORK.".db");
						$result = $db->query('SELECT DISTINCT * FROM chan');
						while($res = $result->fetchArray()):
							$channel = $res['chan'];
							?><li><a href="?channel=<?=$channel?>"><?=$channel?></a></li><?
						endwhile;
					endif; ?>
				</ul>	
					<?
			else:
				$path = BASE_DIRECTORY . DS . "network" . DS . 'stats.class.php';
				print($path);
				print(is_file($path));
				require($path);
				print "done";
				$stats = new Stats($_REQUEST['channel']); ?>
				hi
				<table class="table table-striped table-bordered table-hover table-condensed">
					<tr>
						<th>ID</th>
						<th>Nick</th>
						<th>Host</th>
						<th>Lines</th>
						<th>Words sent</th>
						<th>Characters sent</th>
						<th>Words per line</th>
						<th>Characters per line</th>
						<th>Random quote</th>
					</tr>
					<?php
					foreach($stats->getTopTenMessagers() as $id => $nick):
						$host = $stats->getHost($nick);
						$chatstats = $stats->getTextStats($nick);
						$lines = $chatstats['total'];
						$words = $chatstats['words'];
						$chars = $chatstats['chars'];
						$wpl = $chatstats['wpl'];
						$cpl = $chatstats['cpl'];
						$random = $stats->getRandomQuote($nick);
						?>
						<tr>
							<td><?=$id?></td>
							<td><?=$nick?></td>
							<td><?=$host?></td>
							<td><?=$lines?></td>
							<td><?=$words?></td>
							<td><?=$chars?></td>
							<td><?=$wpl?></td>
							<td><?=$cpl?></td>
							<td><?=$random?></td>
						</tr>
						<?
						if($id % 5 === 0): ?>
							<tr>
								<th>ID</th>
								<th>Nick</th>
								<th>Host</th>
								<th>Lines</th>
								<th>Words sent</th>
								<th>Characters sent</th>
								<th>Words per line</th>
								<th>Characters per line</th>
								<th>Random quote</th>
							</tr>
						<? endif;
					endforeach;
					?>
				</table>
			<?
			endif;
			?>
			</div>
		</div>
	</body>

