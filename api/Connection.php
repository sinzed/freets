<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Connection {
	private $servername = "localhost";
	private $database = "darajeh1_app";
// 	private $username = "musiceri_bot";
		private $username = "darajeh1_app";
	private $password= 'darajeh1app123!';
	// 	private $password= '';
	public   $connection;
	function __construct(){
		if(false && $_SERVER['SERVER_NAME']=="localhost"){
			$this->username = "root";
			$this->password = "";
		}
		$this->connect();
		
	}
	public function  connect(){
		$this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
		if ($this->connection->connect_error) {
			die("Connection failed: " . $this->connection->connect_error);
		}
	
	}	
	public function disconnect(){
		mysql_close($this->connection);
	}
	
	
}


?>