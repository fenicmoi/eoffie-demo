<?php
//include "function.php";
include "../library/database.php";

$sql="SELECT  dep_id,dep_name FROM depart";
$data= records($sql);   //เรียกฟังค์ชั่น
echo json_encode($data);
?>
