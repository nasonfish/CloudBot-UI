<?php
/**
 * App file for all Network pages.
 * Inspired by botskonet's Aspen-Framework
 * http://github.com/botskonet/Aspen-Framework/
 * @package nasonfish.CloudBot-UI
 */

include 'Module.php';

/**
 * Class Network_App A class containing
 * all of the page's backend statements
 * that are passed to the template file.
 *
 *
 */
class Network_App extends Module{
    /**
     * Factoids page handler.
     * @param bool $api Are we using the api?
     */
    public function factoids($api = false){
        $db = new SQLite3(PERSIST_DIR.DS.NETWORK.".db");
        $result = $db->query('SELECT * FROM mem ' . (!empty($_GET['key']) ? 'WHERE word LIKE "' . implode('" OR word LIKE "', explode(',', $_GET['key'])) . '"' : ''));
        $row = array();
        $row['success'] = true;
        $i = 0;
        if($api){
            while($res = $result->fetchArray()){
                if(!isset($res['word'])) continue;
                $row['data'][$i]['word'] = $res['word'];
                $row['data'][$i]['data'] = $res['data'];
                $row['data'][$i]['nick'] = $res['nick'];
                $i++;
            }
            print(json_encode($row));
        } else {
            $row = array();
            $i = 0;
            while($res = $result->fetchArray()){
                foreach($res as $key => $val){
                    $res[$key] = htmlspecialchars($val);
                }
                $res['data'] = $this->formatIfLink($res['key'], $res['data']);

                if(!isset($res['word'])) continue;
                $row[$i]['word'] = $res['word'];
                $row[$i]['data'] = $res['data'];
                $row[$i]['nick'] = $res['nick'];
                $i++;
            }
            $this->template_display(array('rows' => $row));
        }
    }

    private function formatIfLink($key, $str){
        if (substr($str, 0, 4) === "http"){
            return "<a href=" . $str . ">".$str."</a>";
        } else if(substr($str, 0, 10) === "&lt;py&gt;") {
            if(isset($_REQUEST[$key])){
                $str = htmlspecialchars_decode($str);
                $python = 'input="""'.$_REQUEST[$key].'""";nick="Username";chan="#Interface";bot_nick="Refract";'.substr($str, 4);
                return "<strong>Result: </strong>" . exec("python -c '$python'"); // TODO python2.7 instead of python
            } else {
                return "Python: <code>" . substr($str, 11) . "</code>. <br> Enter Input: <form><input style=\"padding:5px\" type=\"text\" name=\"".$key."\"></form>";
            }
        } else {
            return $str;
        }
    }

    public function quotes($api = false){
        $db = new SQLite3("../../".NETWORK.".db");
        $users = $db->query('SELECT DISTINCT nick FROM quote LIMIT 8');
        $allUsers = $db->query('SELECT DISTINCT nick FROM quote LIMIT 100');
        $users = parseArray($allUsers);
        $query = "SELECT * FROM quote";
        $query .= isset($_REQUEST['whereuser']) ? " WHERE nick LIKE \"%".(str_replace("\"", "\\\"",  $_REQUEST['whereuser']))."%\"" : "";
        $result = $db->query($query) or die("An error occurred with your query. Please edit your filters and try again.");

    }

    private function parseArray($array){
        $list = "[";
        while($val = $array->fetchArray()){
            $list .= $val['nick'] . ",";
        }
        $list = substr($list, 0, strlen($list) - 1); // Remove the last ",".
        $list .= "]";
        return $list;
    }

    public function index($api = false){
        $this->template_display();
    }


}

?>