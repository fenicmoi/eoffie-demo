<?php

include_once 'function.php';
error_reporting( error_reporting() & ~E_NOTICE );//ปิดการแจ้งเตือน
date_default_timezone_set('Asia/Bangkok'); //วันที่

   

if(isset($_POST['save'])){   //กดปุ่มบันทึกจากฟอร์มบันทึก
    //$yid=$_POST['yid'];
    $uid=$_POST['u_id'];
    $obj_id=$_POST['obj_id'];
    $typeDoc=$_POST['typeDoc'];
    $prefex=$_POST['prefex'];
    $title=$_POST['title'];
    $speed_id=$_POST['speed_id'];
    $sec_id=$_POST['sec_id'];
    $sendfrom=$_POST['sendfrom'];
    $sendto=$_POST['sendto'];
    $refer=$_POST['refer'];
    $attachment=$_POST['attachment'];
    $practice=$_POST['practice'];
    $file_location=$_POST['file_location'];
    $dateline=$_POST['datepicker'];
    $datelout=date('Y-m-d h:i:s');
    $follow=$_POST['follow'];
    $open=$_POST['open'];
  
    //check year
    $sqlYear="select * from sys_year where status=1";
    $resYear=  mysqli_query($conn, $sqlYear);
    $rowYear= mysqli_num_rows($resYear);
    $rowData=  mysqli_fetch_array($resYear);
    $yid=$rowData[0];
    if($rowYear==0){
        echo "<script>swal(\"ระบบจัดการปีปฏิทินมีปัญหา  ติดต่อ Admin!\") </script>";
        echo "<meta http-equiv='refresh' content='1;URL=flow-normal.php'>";
    }else{
           //ตัวเลขรันอัตโนมัติ
            $sqlRun="SELECT cid,rec_no FROM flowrecive  ORDER  BY cid DESC";
            $resRun=  mysqli_query($conn, $sqlRun);
            $rowRun= mysqli_fetch_array($resRun);
            $rec_no=$rowRun['rec_no'];
            $rec_no++;
            
        $sqlInsert="INSERT INTO flowrecive
                         (rec_no,u_id,obj_id,yid,typeDoc,prefex,title,speed_id,sec_id,sendfrom,sendto,refer,attachment,practice,file_location,dateline,dateout,follow,open,file_upload)    
                    VALUE($rec_no,$u_id,$obj_id,$yid,'$typeDoc','$prefex','$title',$speed_id,$sec_id,'$sendfrom','$sendto','$refer','$attachment','$practice','$file_location','$dateline','$datelout',$follow,$open,'$newname')";
        //echo $sqlInsert;
        $SQL=mysqli_query($conn, $sqlInsert);
   
    
    echo "<meta http-equiv='refresh' content='1;URL=flow-resive.php'>";
    
    echo "<script>swal(\"Good job!\", \"บันทึกข้อมูลเรียบร้อยแล้ว\", \"success\")</script>";
    if(!$SQL){
        echo $conn->error;
    }
  } 
}


if(isset($_POST['update'])){
            $cid=$_POST['cid'];
            $fileupload=$_REQUEST['fileupload'];  //การจัดการ fileupload
            $date=date('Y-m-d');
            $numrand=(mt_rand()); //สุ่มตัวเลข
            $upload=$_FILES['fileupload']; //เพิ่มไฟล์
        if($upload<>''){
            $part="recive/";   //โฟลเดอร์เก็บเอกสาร
            $type=  strrchr($_FILES['fileupload']['name'],".");   //เอาชื่อเก่าออกให้เหลือแต่นามสกุล
            $newname=$date.$numrand.$type;   //ตั้งชื่อไฟล์ใหม่โดยใช้เวลา
            $part_copy=$part.$newname;
            $part_link="recive/".$newname;
            move_uploaded_file($_FILES['fileupload']['tmp_name'],$part_copy);  //คัดลอกไฟล์ไป Server
            
            $sqlUpdate="UPDATE flowrecive SET file_upload='$part_copy' WHERE cid=$cid";
            //print $sqlUpdate;
            $resUpdate=  mysqli_query($conn, $sqlUpdate);
            if(!$resUpdate){
                echo "ระบบมีปัญหา";
                exit;
            }else{
              echo "<script>window.alert(\"ระบบบันทึกข้อมูลเรียบร้อยแล้ว ;)\");</script>";             
              echo "<meta http-equiv='refresh' content='1;URL=flow-resive.php'>";  
            }
        }
}    
?>