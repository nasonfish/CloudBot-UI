<h4>Filter a user? </h4>
<form>
    <input style="padding:5px" autocomplete="off" type="text" data-provide="typeahead" data-souce="<?=$users?>" name="whereuser">
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