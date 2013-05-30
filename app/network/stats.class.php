<?php

class Stats {
	
	/**
	 * This instance's channel
	 * @var String channel
	 */
	private $channel;
	
	/**
	 * Holds the name of the
	 * table we use for these stats.
	 * @var String table name
	 */
	private $table = "logs";
	
	/**
	 * Holds a connection to the
	 * database.
	 * @var SQLite3 connection 
	 */
	private $db;
	
	/**
	 * Create a new instance of this class
	 * with this certain channel as the channel
	 * to use for queries.
	 * @param String $channel
	 */
	public function __construct($channel){
		$this->channel = '#' . $channel;
		$this->db = new SQLite3(PERSIST_DIR . NETWORK . ".db");
	}

    /**
     * Execute a query and return an
     * array of results.
     * @param string $query the query to run
     * @return array $return an array of results
     */
	private function query($query){
		$query = sprintf($query, "`".$this->table."`", "'".$this->channel."'");
		$result = $this->db->query($query);
		$return = array();
		$i = 0;
		while($res = $result->fetchArray()){
			foreach($res as $key => $val){
				$return[$i][$key] = $val;
			}
			$i++;
		}
		return $return;
	}

    public function chan_exists(){
        $result = $this->db->query("SELECT EXISTS(SELECT chan FROM ".$this->table." WHERE chan='".$this->channel."' LIMIT 1)")->fetchArray();
        return $result[0];
    }
	
	/**
	 * Get Every singe message sent in that 
	 * channel.
	 * @return array of results
	 */
	public function getAllMessages(){
		return $this->query("SELECT * FROM %s WHERE chan=%s");
	}
	
	/**
	 * Get the top 10 messagers.
	 * @return array() of messagers
	 */
	public function getTopTenMessagers(){
		return $this->getTopMessagers(10);
	}
	
	/**
	 * Get the top $amt messagers
	 * @param int $amt amount of messagers to return
	 * @return array of messagers
	 */
	public function getTopMessagers($amt){
		$names = array();
		foreach($this->query("SELECT DISTINCT name FROM %s WHERE chan=%s GROUP BY name ORDER BY SUM(1) DESC --LIMIT $amt") as $name){
			$names[] = $name['name'];
		}
		return $names;
	}
	
	/**
	 * Get a random quote from a user.
	 * @param String $user user to get a quote from
	 * @return String quote
	 */
	public function getRandomQuote($user){
		$rand = $this->query("SELECT quote FROM %s WHERE chan=%s AND name='$user' ORDER BY RANDOM() LIMIT 1");
		$rand = $rand[0]['quote'];
		return $rand;
	}
	
	/**
	 * Get the most recent host of a user
	 * @param String $user the user to use
	 * @return String the most recent host of the user
	 */
	public function getHost($user){
		$host = $this->query("SELECT REPLACE(host, '@', ' @') FROM %s WHERE chan=%s AND name='$user' ORDER BY time DESC LIMIT 1");
		$host = $host[0]['host'];
		return $host;
	}
	
	/**
	 * Get the text stats sent by a user
	 * @param String $user the user
	 * @return array() ->
	 *    total, words, chars, wpl, cpl
	 *    (total, total words, total characters,
	 *       words per line, chars per line)
	 */
	public function getTextStats($user){
		$stats = $this->query("SELECT SUM(1) as total, 
			SUM(length(quote)-length(replace(quote,' ','')) + 1) as words, 
			SUM(length(quote)-length(replace(quote,' ','')) + 1) / SUM(1) as wpl, 
			SUM(length(quote)) as chars,
			SUM(length(quote)) / SUM(1) as cpl
			FROM %s WHERE chan=%s AND name='$user' GROUP BY name");
		$stats = $stats[0];
		return $stats;
	}
}

?>
