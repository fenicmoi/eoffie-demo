<?php

include_once 'function.php';

/* code for data insert */
    if(isset($_POST['save']))
    {
         $speed_name = $conn->real_escape_string($_POST['speed']);
             $SQL = $conn->query("INSERT INTO speed(speed_name) VALUES('$speed_name')");
             echo "<meta http-equiv='refresh' content='1;URL=speed.php'>";
             if(!$SQL)
             {
                     echo $conn->error;
             } 

    }

/* code for data delete */
if(isset($_GET['del']))
{
	$SQL = $conn->query("DELETE FROM speed WHERE speed_id=".$_GET['del']);
	echo "<meta http-equiv='refresh' content='1;URL=speed.php'>";
}
/* code for data delete */



/* code for data update */
if(isset($_GET['edit']))
{
	$SQL = $conn->query("SELECT * FROM speed WHERE speed_id=".$_GET['edit']);
	$getROW = $SQL->fetch_array();
        //echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
}

if(isset($_POST['update']))
{
	$SQL = $conn->query("UPDATE speed SET speed_name='".$_POST['speed']."' WHERE speed_id=".$_GET['edit']);
	echo "<meta http-equiv='refresh' content='1;URL=speed.php'>";
}
/* code for data update */

?>