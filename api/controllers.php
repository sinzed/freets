<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

include "DatabaseHandler.php";

$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);



$db = new DatabaseHandler();
if($request['action']=="loginUser"){
    echo $db->getUser($request);
}

if($request['action']=="createUser"){
   echo $db->createUser($request);
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

