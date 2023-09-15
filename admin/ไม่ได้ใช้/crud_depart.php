<?php
include_once 'function.php';
/*
$officeType=$_POST['officeType'];
$dep_name=$_POST['dep_name'];
$address=$_POST['address'];
$tel=$_POST['tel'];
$fax=$_POST['fax'];
$social=$_POST['facebook'];
 */



if(isset($_GET['edit'])){  //เปลี่ยนปุ่ม
	$SQL = $conn->query("SELECT * FROM depart WHERE dep_id=".$_GET['edit']);
        
	$getROW = $SQL->fetch_array();
        //echo "<meta http-equiv='refresh' content='1;URL=object.php'>";
}

if(isset($_POST['update'])){
        $sql="UPDATE depart
                         SET type_id=".$_POST['officeType'].",
                             dep_name='".$_POST['dep_name']."',
                             address='".$_POST['address']."',
                             phone='".$_POST['tel']."',
                             fax='".$_POST['fax']."',
                             social='".$_POST['website']."',
                             status=".$_POST['status'].",
                             local_num=".$_POST['local_num']."
                        WHERE dep_id=".$_GET['edit']."
                            ";
        //echo $sql;
	$SQL = $conn->query($sql);
        echo "<script>swal(\"Good job!\", \"แก้ไขข้อมูลแล้ว!\", \"success\")</script>";                 
        
	echo "<meta http-equiv='refresh' content='1;URL=depart.php'>";
}
?>