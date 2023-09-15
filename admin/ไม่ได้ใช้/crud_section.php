<?php

include_once 'function.php';

/* code for data insert */
    if(isset($_POST['save']))
    {
         $sec_name = $conn->real_escape_string($_POST['sec_name']);
         $sec_code = $conn->real_escape_string($_POST['sec_code']);
         $phone=$conn->real_escape_string($_POST['phone']);
         $fax=$conn->real_escape_string($_POST['fax']);
         $status=$conn->real_escape_string($_POST['status']);
         $local_num=$conn->real_escape_string($_POST['local_num']);
         $type_id=$_POST['province'];
         $dep_id=$_POST['amphur'];
             $SQL = $conn->query("INSERT INTO section(sec_name,sec_code,dep_id,phone,fax,status,local_num)
                                              VALUES('$sec_name','$sec_code','$dep_id','$phone','$fax','$status','$local_num')");
           // echo $SQL;
            echo "<script>swal(\"Good job!\", \"บันทึกข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";
            echo "<meta http-equiv='refresh' content='1;URL=section.php'>";
             if(!$SQL)
             {
                     echo $conn->error;
             } 

    }

/* code for data delete */
if(isset($_GET['del']))
{
	$SQL = $conn->query("DELETE FROM section WHERE sec_id=".$_GET['del']);
        echo "<script>swal(\"Good job!\", \"]ลบข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";
	echo "<meta http-equiv='refresh' content='1;URL=section.php'>";
}
/* code for data delete */





if(isset($_POST['update']))
{
	$SQL = $conn->query("UPDATE section SET
                 sec_name='".$_POST['sec_name']."', 
                 sec_code='".$_POST['sec_code']."',
                 dep_id='".$_POST['dep_id']."',
                 phone='".$_POST['phone']."',
                 fax='".$_POST['fax']."',
                 status='".$_POST['status']."',
                 local_num='".$_POST['local_num']."'
                 WHERE sec_id=".$_GET['edit']);
        
         echo "<script>swal(\"Good job!\", \"บันทึกข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";       
	 echo "<meta http-equiv='refresh' content='1;URL=section.php'>";
}
/* code for data update */

?>