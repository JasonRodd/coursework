<?php 
#Jason Rodd
#written 9-14-17

#Database object to hold all db info
class Database {
	
	var $servername;
	var $username;
	var $password;
	var $dbname;
	
	function __construct($server, $user, $pass, $db) {
		$this->servername = $server;
		$this->username = $user;
		$this->password = $pass;
		$this->dbname = $db;
	}
	
	function set_servername($server) {
		$this->servername = $server;
	}
	
	function get_servername() {
		return $this->servername;
	}
	
	function set_username($user) {
		$this->username = $user;
	}
	
	function get_username() {
		return $this->username;
	}
	
	function set_password($pass) {
		$this->password = $pass;
	}
	
	function get_password() {
		return $this->password;
	}
	
	function set_dbname($db) {
		$this->dbname = $db;
	}
	
	function get_dbname() {
		return $this->dbname;
	}

}

?>