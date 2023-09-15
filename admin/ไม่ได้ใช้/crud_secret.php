<?php

include_once 'function.php';

/* code for data insert */
    if(isset($_POST['save']))
    {
         $sec_name = $conn->real_escape_string($_POST['secret']);
             $SQL = $conn->query("INSERT INTO secret(sec_name) VALUES('$sec_name')");
             echo "<meta http-equiv='refresh' content='1;URL=secret.php'>";
             if(!$SQL)
             {
                     echo $conn->error;
             } 

    }

/* code for data delete */
if(isset($_GET['del']))
{
	$SQL = $conn->query("DELETE FROM secret WHERE sec_id=".$_GET['del']);
	echo "<meta http-equiv='refresh' content='1;URL=secret.php'>";
}
/* code for data delete */



/* code for data update */
if(isset($_GET['edit']))
{
	$SQL = $conn->query("SELECT * FROM secret WHERE sec_id=".$_GET['edit']);
	$getROW = $SQL->fetch_array();
        //echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
}

if(isset($_POST['update']))
{
	$SQL = $conn->query("UPDATE secret SET sec_name='".$_POST['secret']."' WHERE sec_id=".$_GET['edit']);
	echo "<meta http-equiv='refresh' content='1;URL=secret.php'>";
}
/* code for data update */

?>