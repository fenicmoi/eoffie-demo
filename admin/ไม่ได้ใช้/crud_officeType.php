<?php

include_once 'function.php';

/* code for data insert */
    if(isset($_POST['save']))
    {
         $type_name = $conn->real_escape_string($_POST['officeType']);
             $SQL = $conn->query("INSERT INTO office_type(type_name) VALUES('$type_name')");
             echo "<meta http-equiv='refresh' content='1;URL=officeType.php'>";
             if(!$SQL)
             {
                     echo $conn->error;
             } 

    }

/* code for data delete */
if(isset($_GET['del']))
{
	$SQL = $conn->query("DELETE FROM office_type WHERE type_id=".$_GET['del']);
	echo "<meta http-equiv='refresh' content='1;URL=officeType.php'>";
}
/* code for data delete */



/* code for data update */
if(isset($_GET['edit']))
{
	$SQL = $conn->query("SELECT * FROM office_type WHERE type_id=".$_GET['edit']);
	$getROW = $SQL->fetch_array();
        //echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
}

if(isset($_POST['update']))
{
	$SQL = $conn->query("UPDATE office_type SET type_name='".$_POST['officeType']."' WHERE type_id=".$_GET['edit']);
	echo "<meta http-equiv='refresh' content='1;URL=officeType.php'>";
}
/* code for data update */

?>