<?php

include_once 'function.php';

/* code for data insert */
    if(isset($_POST['save']))
    {
         $level_name = $conn->real_escape_string($_POST['level_name']);
         $status=$conn->real_escape_string($_POST['status']);
             $SQL = $conn->query("INSERT INTO user_level(level_name,status) VALUES('$level_name','$status')");
             echo "<meta http-equiv='refresh' content='1;URL=user_group.php'>";
             echo "<script>swal(\"Good job!\", \"บันทึกข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";
             if(!$SQL)
             {
                     echo $conn->error;
             } 

    }

/* code for data delete */
if(isset($_GET['del']))
{
	$SQL = $conn->query("DELETE FROM  user_level WHERE level_id=".$_GET['del']);
	echo "<meta http-equiv='refresh' content='1;URL=user_group.php'>";
        echo "<script>swal(\"Good job!\", \"ลบข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";
}
/* code for data delete */



/* code for data update */
if(isset($_GET['edit']))
{
	$SQL = $conn->query("SELECT * FROM user_level WHERE level_id=".$_GET['edit']);
	$getROW = $SQL->fetch_array();
        //echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
}

if(isset($_POST['update']))
{
	$SQL = $conn->query("UPDATE user_level SET level_name='".$_POST['level_name']."',status='".$_POST['status']."'
                             WHERE level_id=".$_GET['edit']);
	echo "<meta http-equiv='refresh' content='1;URL=user_group.php'>";
        echo "<script>swal(\"Good job!\", \"แก้ไขข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";
}
/* code for data update */

?>