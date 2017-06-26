<?php
include "Connection.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class DatabaseHandler extends Connection {
	function __construct(){
            parent::__construct();
	}
        function getUsers(){
//            echo "users";
//            $username=$_GET["e"];
//            $password=$_GET["p"];
		
		// To protect MySQL injection for Security purpose
//		$username = stripslashes($username);
//		$password = stripslashes($password);
//		$username = $conn->real_escape_string($username);
//		$password = $conn->real_escape_string($password);

		
		$query="SELECT * From users";
		$result = $this->connection->query($query);
		$outp = "";
		
		if( $rs=$result->fetch_array(MYSQLI_ASSOC)) {
			if ($outp != "") {$outp .= ",";}
			$outp .= '{"u_id":"'  . $rs["id"] . '",';
			$outp .= '"u_email":"'   . $rs["email"]        . '",';
			$outp .= '"u_password":"'. $rs["password"]     . '"}';
		}
		$outp ='{"records":['.$outp.']}';
		$this->connection->close();

		echo($outp);
    }
}
?>