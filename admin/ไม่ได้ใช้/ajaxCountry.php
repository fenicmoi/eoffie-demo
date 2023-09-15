<?php
    $config['db_server'] = "localhost";
    $config['db_username'] = "root";
    $config['db_password'] = "";
    $config['db_name'] = "office2017v2";
  
    $conn = mysql_connect($config['db_server'], $config['db_username'], $config['db_password']) 
    or die("Connect Failed");
    
mysql_select_db($config['db_name'], $conn);
mysql_query("SET NAMES UTF8");
$keyword = $_GET["keyword"];

$sql = " select * from depart where ";
$sql .= " dep_id like '%".mysql_real_escape_string($keyword)."%' ";
$sql .= " or dep_name like '%".mysql_real_escape_string($keyword)."%' ";
$sql .= " order by dep_id asc, dep_name asc ";
$sql .= " limit 0,10 ";

$query = mysql_query($sql);
$num = mysql_num_rows($query);
$resultData = array();
if($num > 0){
    while($rs = mysql_fetch_assoc($query)){
        array_push($resultData,$rs);
    }
}
echo json_encode($resultData);
?>