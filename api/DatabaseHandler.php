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

		
		$query="SELECT * From users ";
		$result = $this->connection->query($query);
		$outp = "";
		
		if( $rs=$result->fetch_array(MYSQLI_ASSOC)) {
			if ($outp != "") {$outp .= ",";}
			$outp .= '{"u_id":"'  . $rs["id"] . '",';
			$outp .= '"u_email":"'   . $rs["email"]        . '",';
			$outp .= '"u_name":"'   . $rs["name"]        . '",';
			$outp .= '"u_password":"'. $rs["password"]     . '"}';
		}
		$outp ='{"records":['.$outp.']}';
		$this->connection->close();

		echo($outp);
    }
    function getUser($data){
        // To protect MySQL injection for Security purpose
		$email = stripslashes($data['email']);
		$password = stripslashes($data['password']);
//		$username = $conn->real_escape_string($username);
//		$password = $conn->real_escape_string($password);

		
		$query="SELECT name, email, phone, address FROM users  
				where email like '".$email."' and password like '".$password."'";
		$result = $this->connection->query($query);
		$outp = "";
		if( $rs= mysqli_fetch_assoc($result)) {
			if ($outp != "") {$outp .= ",";}
			$outp .= '{"u_name":"'  . $rs["name"] . '",';
			$outp .= '"is_user":"true",';
			$outp .= '"u_phone":"'   . $rs["phone"]        . '",';
			$outp .= '"u_address":"'. $rs["address"]     . '"}';
                 
		}
                else {
                        $outp = '{"is_user":"false"}';
                }
                $outp ='{"records":'.$outp.'}';

		$this->connection->close();

		return $outp;
        
    }
    function isRegistered($data){
        $email  = $data['email'];
        
        $query="SELECT * FROM users where email = '$email' ";
       
        $result = $this->connection->query($query) or die ("we can not check user");
        
        $data = mysqli_fetch_array($result, MYSQLI_NUM);
		
        if($data[0] > 1) {
                $outp='{"result":{"created": "0" , "exists": "1" }}';
        }
        else
            return false;
        
        return $outp;
        
    }
    function createUser($data){
        if($result = $this->isRegistered($data))
                return $result;
        $name  = $data['name'];
        $email  = $data['email'];
        $password  = $data['password'];
        $phone  = $data['phone'];
        $address  = $data['address'];
        $query="INSERT into users (`email`,`password`,`phone`,`address` ,`name`) VALUES ('" 
					. $email."' ,'"
					. $password."' ,'"
					. $phone."' ,'"
					. $address."' ,'"
					. $name."'"
					.");";
        $result = $this->connection->query($query) or die ("error we cant create  user");
        
        if ($outp != "") {$outp .= ",";}
                $outp .= '{"created":"1",';
                $outp .= '"exists":"0"}';
        $outp ='{"result":'.$outp.'}';
        $this->connection->close();

        return $outp;

    }
}
?>