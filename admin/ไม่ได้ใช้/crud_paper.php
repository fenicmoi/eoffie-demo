<?php
error_reporting( error_reporting() & ~E_NOTICE );  //ปิดการแจ้งเตือน
include_once 'function.php';
date_default_timezone_set('Asia/Bangkok');
$date=date('Y-m-d');

if(isset($_POST['send'])){        //ตรวจสอบการกดปุ่ม send  จากส่งเอกสารภายใน
    $title=$_POST['title'];
    $detail=$_POST['detail'];
    $fileupload=$_POST['file'];
    $date=date('YmdHis');
    $sec_id=$_POST['sec_id'];
    $insite=1;                    //เอกสารภายใน
    $user_id=$_POST['user_id'];
  
    $dep_id=$_POST['dep_id'];
    $toAll=$_POST['toAll'];
    $toSome=$_POST['toSome'];
    $toSomeUser=$_POST['toSomeUser'];
   
    $fileupload=$_REQUEST['fileupload'];   //การจัดการ fileupload
    $numrand=(mt_rand());  //สุ่มตัวเลข
    $upload=$_FILES['fileupload'];  //เพิ่มไฟล์
    
    if($upload<>''){           //ถ้ามีการ upload เอกสาร
        $part="paper/";
        $type=  strrchr($_FILES['fileupload']['name'],".");    //เอาชื่อเก่าออกให้เหลือแต่นามสกุล
        $newname=$date.$numrand.$type;   //ตั้งชื่อไฟล์ใหม่โดยใช้เวลา
        $part_copy=$part.$newname;
        $part_link="paper/".$newname;
        move_uploaded_file($_FILES['fileupload']['tmp_name'],$part_copy);  //คัดลอกไฟล์ไป Server
    }
    

    
 if($toAll!=''){    //กรณีส่งเอกสารถึงทุกคน
        $sql="INSERT INTO paper(title,detail,file,postdate,u_id,sec_id,insite)
                             VALUE('$title','$detail','$part_link','$date',$user_id,$sec_id,$insite)";
        $result=dbQuery($sql);  
        $lastid=dbInsertId();   //ค้นหารหัสล่าสุด

        $sql="SELECT sec_id,sec_name FROM section WHERE dep_id=$dep_id";
        $result=  dbQuery($sql);
      
        
           while($rowUser=  dbFetchArray($result)){
                $userId=$rowUser[0];
                $tb="paperuser";
                $sql="insert into $tb (pid,sec_id,dep_id) values ($lastid,'$userId',$dep_id)";
                //echo 'คำสั่งคือ'; $sqlPaper;
                $dbquery= dbQuery($sql);
           }
           echo "<script>
           swal({
               title:'ส่งเอกสารเรียบร้อยแล้ว',
               type:'success',
               showConfirmButton:true
               },
               function(isConfirm){
                   if(isConfirm){
                       window.location.href='flow-resive-province.php';
                   }
               }); 
           </script>";
        
 }else{  //ส่งเอกสารให้บางคน
        $sqlSend="INSERT INTO paper(title,detail,file,postdate,u_id,sec_id,insite)
                  VALUE('$title','$detail','$part_link','$date',$user_id,$sec_id,$insite)";
        $chk1=mysqli_query($conn, $sqlSend) ;  
        $lastid=  mysqli_insert_id($conn);     //ค้นหาเลขระเบียนล่าสุด
        //table ตรวจสอบผู้รับในสำนักงาน
        $sqlUser="SELECT sec_id,sec_name FROM section WHERE dep_id=$dep_id ";
        $resUser=  mysqli_query($conn, $sqlUser);
        if(!resUser){
            echo 'SQL Error';
        }else{
            $sendto=$_POST['toSomeUser'];
            $sendto=substr($sendto, 1);
            $c=explode("|", $sendto);
            
                for ($i=0;$i<count($c);$i++){
                    $sendto=$c[$i];
                    $tb="paperuser";
                    $sqlSome="insert into $tb (pid,sec_id,dep_id) values ($lastid,$sendto,$dep_id)";
                    $dbquery=mysqli_query($conn,$sqlSome);
                }

            echo "<script>window.alert(\"ส่งเอกสารเรียบร้อยแล้ว\");</script>";
//            //echo "<script>swal(\"Good job!\", \"ส่งหนังสือแล้ว\", \"success\");</script>"; 
            echo "<meta http-equiv='refresh' content='1;URL=paper.php'>";  
        } 
    }
}

/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
                   // ส่วนการส่งหนังสือภายนอก
if(isset($_POST['sendOut'])){            //ตรวจสอบปุ่ม sendOut
    $title=$_POST['title'];              //ชื่อเอกสาร
    $detail=$_POST['detail'];            //รายละเอียด
    $date=date('YmdHis');           //วันเวลาปัจจุบัน
    $sec_id=$_POST['sec_id'];            //รหัสแผนกที่ส่ง
    $outsite=1;                          //กำหนดค่าเอกสาร insite=ภายใน   outsite = ภายนอก
    $user_id=$_POST['user_id'];          //รหัสผู้ใช้
    $dep_id=$_POST['dep_id'];            //รหัสหน่วยงาน

    $toAll=$_POST['toAll'];              //ส่งเอกสารถึงทุกคน
    $toSome=$_POST['toSome'];            //ส่งตามประเภท
    $toSomeOne=$_POST['toSomeOne'];       //ส่งแบบเลือกเอง
    
    $toSomeUser=$_POST['toSomeUser'];      //ช่องส่งแยกประเภทตามหน่วยงาน
    $toSomeOneUser=$_POST['toSomeOneUser'];  //ช่องรับรหัสแบบเลือกเอง
    
    $fileupload=$_POST['file'];          //ไฟล์เอกสาร
    $numrand=(mt_rand());  //สุ่มตัวเลข
    $upload=$_FILES['fileupload'];  //เพิ่มไฟล์
    $dateSend=date('Y-m-d');   //วันที่ส่งเอกสาร  (มีปัญหายังแก้ไม่ได้)
    echo "date(YmdHis=".$date."<br>";
    echo "dateSend(Y-m-d)=".$dateSend."<br>";
    if($upload<>''){
        $part="paper/";
        $type=  strrchr($_FILES['fileupload']['name'],".");    //เอาชื่อเก่าออกให้เหลือแต่นามสกุล
        $newname=$date.$numrand.$type;   //ตั้งชื่อไฟล์ใหม่โดยใช้เวลา 
        $part_copy=$part.$newname;
        $part_link="paper/".$newname;
        move_uploaded_file($_FILES['fileupload']['tmp_name'],$part_copy);  //คัดลอกไฟล์ไป Server
    }
  
    if($toAll!=''){    //ส่งเอกสารถึงทุกส่วนราชการ
        $sql="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                              VALUE('$title','$detail','$part_link','$date',$user_id,$outsite,$sec_id,$dep_id)";
        $result=dbQuery($sql);  
        if(!chk1){
            echo mysqli_report;
            echo "<meta http-equiv='refresh' content='1;URL=paper.php'>";  
        }

        $lastid=  dbInsertId();    //เลข ID จากตาราง paper ล่าสุด
        
        $sql="SELECT dep_id,dep_name FROM depart ORDER BY dep_id";    //เลือกส่วนราชการทั้งหมด
        $result= dbQuery($sql);
        if(!$result){
            echo "โปรแกรมทำงานผิดพลาด  โปรดแจ้งเจ้าหน้าที่ผู้ดูแล";
            //echo "<meta http-equiv='refresh' content='1;URL=paper.php'>";  
        }
        
        while($rowDepart=  mysqli_fetch_array($resDepart)){
            $dep_id=$rowDepart[0];
            $tb="paperuser";
            $sqlPaper="INSERT INTO $tb (pid,dep_id) values ($lastid,$dep_id)";
            //print $sqlPaper;
            $dbquery=  mysqli_query($conn, $sqlPaper);
	    }
        //echo "<script>window.alert(\"ส่งเอกสารเรียบร้อยแล้ว\");</script>";
         echo "<script>swal(\"Good job!\", \"ส่งหนังสือแล้ว\", \"success\");</script>"; 
	 echo "<meta http-equiv='refresh' content='1;URL=paper.php'>";  
             
    }
    
    
    if($toSome!=''){  //ส่งเอกสารแยกตามประเภทหน่วยงาน
        $sqlSend="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                  VALUE('$title','$detail','$part_link','$dateSend',$user_id,$outsite,$sec_id,$dep_id)";
        //print "คำสั่งส่งข้อมูลให้บางหน่วยงาน". $sqlSend;
        $chk1=mysqli_query($conn, $sqlSend) ;  
        
        $lastid=  mysqli_insert_id($conn);     //ค้นหาเลขระเบียนล่าสุด
        $sendto=$_POST['toSomeUser'];  //ส่งมาจาก textbox 
        $sendto=substr($sendto, 1);
        $c=explode("|", $sendto);      //เก็บค่าเป็นอาเรย์  โดย c หมายถึงรหัสประเภทหน่วยงาน
                for ($i=0;$i<count($c);$i++){
                    $sendto=$c[$i];
                    $sqlUser="SELECT dep_id FROM depart WHERE type_id=$sendto";  //เลือกรหัสหน่วยงานมาจากตารางหน่วยงาน
                    $resUser=  mysqli_query($conn, $sqlUser);
                    //$rowCount=  mysqli_num_rows($resUser);  //นับจำนวนแถว
                    while($rowUser=mysqli_fetch_array($resUser)){
                        $dep_id=$rowUser[0];
                        //echo $dep_id."<br>";
                        $sqlInsert="INSERT INTO paperuser(pid,dep_id) VALUE ('$lastid','$dep_id')";
                       /* print $sqlInsert;
                        break;*/
                        mysqli_query($conn, $sqlInsert);
                    }
                }

            echo "<script>window.alert(\"ส่งเอกสารเรียบร้อยแล้ว\");</script>";
            //echo "<script>swal(\"Good job!\", \"ส่งหนังสือแล้ว\", \"success\");</script>"; 
            echo "<meta http-equiv='refresh' content='1;URL=paper.php'>";    
        
    }
    
    
    if($toSomeOne!=''){  //ส่งเอกสารแบบเลือกเอง
        
        $sqlSend="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                  VALUE('$title','$detail','$part_link','$dateSend',$user_id,$outsite,$sec_id,$dep_id)";
        
        $chk1=mysqli_query($conn, $sqlSend) ;  
        
        $lastid=  mysqli_insert_id($conn);     //ค้นหาเลขระเบียนล่าสุด
        $sendto=$toSomeOneUser;
        $sendto=  substr($sendto,1);
        $c=  explode("|",$sendto);
                for ($i=0;$i<count($c);$i++){
                    $sendto=$c[$i];
                    $sqlSome="INSERT INTO paperuser(pid,dep_id) VALUE ('$lastid','$sendto')";
                    $dbquery=mysqli_query($conn,$sqlSome);
                }

            echo "<script>window.alert(\"ส่งเอกสารเรียบร้อยแล้ว\");</script>";
//            //echo "<script>swal(\"Good job!\", \"ส่งหนังสือแล้ว\", \"success\");</script>"; 
            echo "<meta http-equiv='refresh' content='1;URL=paper.php'>";  
    }
}
       
?>