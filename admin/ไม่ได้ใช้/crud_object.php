<?php

include_once 'function.php';

/* code for data insert */
    if(isset($_POST['save']))
    {
         $obj_name = $conn->real_escape_string($_POST['obj_name']);
             $SQL = $conn->query("INSERT INTO object(obj_name) VALUES('$obj_name')");
             echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
             if(!$SQL)
             {
                     echo $conn->error;
             } 

    }

/* code for data delete */
if(isset($_GET['del']))
{
	$SQL = $conn->query("DELETE FROM object WHERE obj_id=".$_GET['del']);
	echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
}
/* code for data delete */



/* code for data update */
if(isset($_GET['edit']))
{
	$SQL = $conn->query("SELECT * FROM object WHERE obj_id=".$_GET['edit']);
	$getROW = $SQL->fetch_array();
        //echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
}

if(isset($_POST['update']))
{
	$SQL = $conn->query("UPDATE object SET obj_name='".$_POST['obj_name']."' WHERE obj_id=".$_GET['edit']);
	echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
}
/* code for data update */

?>