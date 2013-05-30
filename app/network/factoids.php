<table class="table table-striped table-bordered table-hover table-condensed">
    <tr>
        <th>Key</th>
        <th>Value</th>
        <th>User</th>
    </tr>
    <?php
    foreach($rows as $row):
        print "<tr>";
        print "<td>" . $row['word'] . "</td>";
        print "<td>" . $row['data'] . "</td>";
        print "<td>" . $row['nick'] . "</td>";
        print "</tr>";
    endforeach;
    ?>
</table>