
<?php
if (!(isset($_REQUEST['channel'])
    && ((in_array("*", array_map('strtolower', $config['pages']['stats']['channels']))
        || in_array( '#' . $_REQUEST['channel'], array_map('strtolower', $config['pages']['stats']['channels']))
    ))
)
):
    if (isset($_REQUEST['channel'])): ?>
        <div class="alert alert-error" style='text-align: center'>
            <h3>You are not allowed to view that channel's stats.</h3>
            <span>If you are the owner of this interface, you may enable viewing this channel in the config.</span>
        </div>
    <?php endif;
    ?>
    <h3>Select a channel to view the stats of: </h3>
    <ul>
        <?php if (!in_array($config['pages']['stats']['channels'], "*")):
            foreach ($config['pages']['stats']['channels'] as $channel): ?>
                <li><a href="?channel=<?= strtolower(substr($channel, 1)) ?>"><?= $channel ?></a></li>
            <? endforeach;
        else:
            $db = new SQLite3("../../" . NETWORK . ".db");
            $result = $db->query('SELECT DISTINCT chan FROM logs');
            while ($res = $result->fetchArray()):
                $channel = $res['chan'];
                ?>
                <li><a href="?channel=<?= strtolower(substr($channel, 1)) ?>"><?= $channel ?></a></li><?
            endwhile;
        endif; ?>
    </ul>
<? else:
    require(BASE_DIRECTORY . DS . "network" . DS . 'stats.class.php');
    $stats = new Stats($_REQUEST['channel']);
    if (!$stats->chan_exists()): ?>
        <div class="alert alert-error" style="text-align: center">
            <h3>This channel does not exist.</h3>
            <p>There has either been no chat in this channel, or the bot has never been in this channel.</p>
            <span><a href='./stats'>Go back and pick another channel?</a></span>
        </div>
    <?php else: ?>
        <table class="table table-striped table-bordered table-hover table-condensed">
            <?php foreach ($stats->getTopTenMessagers() as $id => $nick):
//                        if($id % 5 === 0):
                if ($id === 0): ?>
                    <tr>
                        <th>ID</th>
                        <th>Nick</th>
                        <!--	<th>Host</th> -->
                        <th>Lines</th>
                        <th>Words sent</th>
                        <th>Characters sent</th>
                        <th>Words per line</th>
                        <th>Characters per line</th>
                        <th>Random quote</th>
                    </tr>
                <?php endif;
                $id++;
                //$host = $stats->getHost($nick);
                $chatstats = $stats->getTextStats($nick);
                $lines = $chatstats['total'];
                $words = $chatstats['words'];
                $chars = $chatstats['chars'];
                $wpl = $chatstats['wpl'];
                $cpl = $chatstats['cpl'];
                $random = $stats->getRandomQuote($nick);
                ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $nick ?></td>
                    <!--	<td><?=''//$host?></td> -->
                    <td><?= $lines ?></td>
                    <td><?= $words ?></td>
                    <td><?= $chars ?></td>
                    <td><?= $wpl ?></td>
                    <td><?= $cpl ?></td>
                    <td><?= $random ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?
endif;
?>
