<?php
include 'header.php';
include_once 'function.php';

if(isset($_POST['save'])){
    if($level_id<=2){  //กรณีเป็นผู้ดูแลระบบ
        $type_id=$conn->real_escape_string($_POST['province']);
        $dep_id=$conn->real_escape_string($_POST['amphur']);
        $sec_id=$conn->real_escape_string($_POST['district']);
        
    }/*else{   //กรณีเป็นผู้ใช้งานทั่วไป
    $level_id=$_POST['level'];
    //$sec_id=$conn->real_escape_string($_POST['sec_id']);   //ผูุ้ใช้งานทั่วไปยังไม่สามารถใใช้งานได้้
    } */
    $level_id=$_POST['level'];
    $u_name=$conn->real_escape_string($_POST['u_name']);
    $u_pass=$conn->real_escape_string($_POST['u_pass']);
    $firstname=$conn->real_escape_string($_POST['firstname']);
    $lastname=$conn->real_escape_string($_POST['lastname']);
    $position=$conn->real_escape_string($_POST['position']);
    $date_create=$conn->real_escape_string($_POST['date_user']);
    $status=$conn->real_escape_string($_POST['status']);
    $email=$conn->real_escape_string($_POST['email']);
    $sql="INSERT INTO user(sec_id,dep_id,level_id,u_name,u_pass,firstname,lastname,position,date_create,status,email)
                   VALUE ($sec_id,$dep_id,$level_id,'$u_name','$u_pass','$firstname','$lastname','$position','$date_create',$status,'$email')";
   // print $sql;
    $sqlCheck="select * from user where u_name='".$u_name."'";
    $result=  mysqli_query($conn, $sqlCheck);
    $numrow=  mysqli_num_rows($result);
    if($numrow>=1){
        echo "<script>swal(\"ชื่อผู้ใช้ซ้ำ!\") </script>";
        echo "<meta http-equiv='refresh' content='1;URL=user.php'>";
    }elseif($numrow<1){
         $SQL=$conn->query($sql);
         $level_id=$_SESSION['level'];  
    echo "<script>swal(\"Good job!\", \"บันทึกข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";
    echo "<meta http-equiv='refresh' content='1;URL=user.php'>";
    if(!$SQL){
        echo $conn->error;
    } // error 
  } // user duplicate
} //send

if(isset($_GET['del'])){
	$SQL = $conn->query("DELETE FROM user WHERE u_id=".$_GET['del']);
        echo "<script>swal(\"Good job!\", \"ลบข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";
	echo "<meta http-equiv='refresh' content='1;URL=user.php'>";
}

if(isset($_GET['edit'])){
	$SQL = $conn->query("SELECT * FROM  user WHERE u_id=".$_GET['edit']);
        echo $sql;
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
        
	echo "<meta http-equiv='refresh' content='1;URL=user.php'>";
}
?>