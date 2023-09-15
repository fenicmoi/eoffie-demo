
<?php
date_default_timezone_set('Asia/Bangkok');
include "header.php"; 
$u_id=$_SESSION['ses_u_id'];
@$book_id=$_GET['book_id'];   //รับ id เพื่อตรวจสอบ
if($book_id){
    $sql="SELECT d.title,d.file_upload FROM book_detail d
          INNER JOIN book_master m ON  m.book_id=d.book_id
          WHERE d.book_id=$book_id";
    $result=dbQuery($sql);
    $row=dbFetchAssoc($result);
    $title=$row['title'];
    $link_file=$row['file_upload'];
}

?>

        <div class="col-md-2" >
            <?php
                $menu=  checkMenu($level_id);
                //echo $menu;
                include $menu;
            ?>
        </div>
        <div class="col-md-10">
            <div class="panel panel-default" style="margin: 20">
                <div class="panel-heading"><i class="fa fa-envelope-open-o fa-2x" aria-hidden="true"></i>  <strong>ส่งไฟล์เอกสาร</strong></div>
                <div class="panel-body">
                    <div class="form-group form-inlinet">
                        <form name="form" method="POST">
                            <a href="index_admin.php" class="fa fa-home btn btn-primary text-left"> หน้าหลัก</a>
                        </form>
                    </div>
                </div>
<script language="JavaScript">
<!--
function setEnabledTo(obj) {
	if (obj.value=="2") {                       //ถ้ามีค่า 2
		obj.form.toSomeUser.disabled = false;   //texbox  Enabled
		obj.form.toAll.checked = false;         //toAll ไม่เช็ค
	} else {                                    //ถ้าไม่ใช่ค่า่ 2
		obj.form.toSomeUser.disabled = true;    //texbox Disabled
		obj.form.toSomeUser.value = "";         // เคลียร์ค่าใน text
		obj.form.toSome.checked = false;        //ยกเลิกเช็ค toSome
        obj.form.toAll.checked=true;
	}
}

function setEnabledTo2(obj) {
	if (obj.value=="2") {                   //กรณีเลือกตามประเภทแยกตามประเภท
		obj.form.toAll.checked = false;     //ทั้งหมด
        obj.form.toSomeOne.checked=false;   //เลือกเอก
        obj.form.toSomeUser.disabled=false;  //textbox 
        obj.form.toSomeOneUser.disabled=true;
	} else if(obj.value=="3") {             //กรณีเลือกเอง
        obj.form.toAll.checked=false;       //ทั้งหมด
		obj.form.toSome.checked = false;    //แยกตามประเภท
        obj.form.toSomeUser.disabled=true;  //textbox 
        obj.form.toSomeOneUser.disabled=false;
	}else{
        obj.form.toSome.checked = false;    //แยกตามประเภท
        obj.form.toSomeOne.checked=false;   //เลือกเอก

        obj.form.toSomeUser.disabled=true;  //textbox 
        obj.form.toSomeUser.value="";
        obj.form.toSomeOneUser.disabled=true;
        obj.form.toSomeOneUser.value="";

        
    }
}
//-->
</script>

<script type="text/javascript">
    function listOne(a,b,c) {
        m=document.fileIn.toSomeUser.value;
        
        if (a.checked) {
            if (m.indexOf(b)<0) m+='|'+b;
        
        } else {
        m=document.fileIn.toSomeUser.value.replace('|'+b,'');
        }
        z="|";
        if (m.substring(2) == c) m=m.substring(2);
        document.fileIn.toSomeUser.value=m;
    }
</script>	
<script type="text/javascript">     
    function listType(a,b,c) {     //ฟังค์ชั่นกรณีเลือกเป็นประเภท
        m=document.fileout.toSomeUser.value;
        
        if (a.checked) {
            if (m.indexOf(b)<0) m+='|'+b;
        
        } else {
        m=document.fileout.toSomeUser.value.replace('|'+b,'');
        }
        z="|";
        if (m.substring(2) == c) m=m.substring(2);
        document.fileout.toSomeUser.value=m;
    }
</script>	
<script type="text/javascript">     
    function listSome(a,b,c) {     //ฟังค์ชั่นกรณีเลือกส่วนราชการเอง
        m=document.fileout.toSomeOneUser.value;
        
        if (a.checked) {
            if (m.indexOf(b)<0) m+='|'+b;
        
        } else {
        m=document.fileout.toSomeOneUser.value.replace('|'+b,'');
        }
        z="|";
        if (m.substring(2) == c) m=m.substring(2);
        document.fileout.toSomeOneUser.value=m;
    }
</script>	

                <div class="container">
                    <div class="well">
                        
                            <ul class="nav nav-tabs">
                                <li class="active"  ><a class="fa fa-yelp" data-toggle="tab" href="#home"> เอกสารใหม่[ภายนอก]</a></li>
                                <li><a class="fa fa-folder" data-toggle="tab" href="#menu1"> เอกสารรับแล้ว</a></li>
                                <li><a class="fa fa-history"data-toggle="tab" href="#menu2"> ประวัติการส่ง</a></li>
                                <li><a class="fa fa-paper-plane"data-toggle="tab" href="#menu3"> ส่งเอกสาร(ภายใน)</a></li>
                                <li><a class="fa fa-paper-plane-o" data-toggle="tab" href="#menu4"> ส่งเอกสาร (ภายนอก)</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                   <?php include 'newpaper.php'; ?>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                   <?php include 'folder.php'; ?>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                   <?php include 'history.php'; ?>
                                </div>
                                <div id="menu3" class="tab-pane fade">
                                    <?php include 'inside_all.php'; ?>
                                </div>
                                <div id="menu4" class="tab-pane fade">
                                    <?php include 'outside_all.php'; ?>
                                </div>
                                
                            </div>
                    </div>
                </div>
              
             </div>
        </div>  
<!-- form send  -->

<!-- process -->
<?php
/*error_reporting( error_reporting() & ~E_NOTICE );  //ปิดการแจ้งเตือน
include_once 'function.php';
date_default_timezone_set('Asia/Bangkok');*/
$date=date('Y-m-d');

if(isset($_POST['send'])){        //ตรวจสอบการกดปุ่ม send  จากส่งเอกสารภายใน
    $title=$_POST['title'];
    $detail=$_POST['detail'];
    @$fileupload=$_POST['file'];
    $date=date('YmdHis');
    $sec_id=$_POST['sec_id'];
    $insite=1;                    //เอกสารภายใน
    $user_id=$_POST['user_id'];
  
    $dep_id=$_POST['dep_id'];
    @$toAll=$_POST['toAll'];
    @$toSome=$_POST['toSome'];
    @$toSomeUser=$_POST['toSomeUser'];
   
    @$fileupload=$_REQUEST['fileupload'];   //การจัดการ fileupload
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
    

 /*++++++++++++++++++++++ส่วนการส่งเอกสานภายใน++++++++++++++++++++++++++++++++++*/

 if($toAll!=''){    //กรณีส่งเอกสารถึงทุกคน
        if($book_id && $link_file<>null){   //ถ้ามีการส่ง book_id มา
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,sec_id,insite,dep_id)
                            VALUE('$title','$detail','$link_file','$date',$user_id,$sec_id,$insite,$dep_id)";
        }else{
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,sec_id,insite,dep_id)
            VALUE('$title','$detail','$part_link','$date',$user_id,$sec_id,$insite,$dep_id)";
        }

        
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
                       window.location.href='paper.php';
                   }
               }); 
           </script>";
        
 }else{  //ส่งเอกสารให้บางคน
        if($book_id && $link_file<>null){
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,sec_id,insite,dep_id)
            VALUES('$title','$detail','$link_file','$date',$user_id,$sec_id,$insite,$dep_id)";
        }else{
        $sql="INSERT INTO paper(title,detail,file,postdate,u_id,sec_id,insite,dep_id)
                  VALUES('$title','$detail','$part_link','$date',$user_id,$sec_id,$insite,$dep_id)";
        }
        $result=dbQuery($sql);  
        $lastid=  dbInsertId();     //ค้นหาเลขระเบียนล่าสุด
        //table ตรวจสอบผู้รับในสำนักงาน
        $sql="SELECT sec_id,sec_name FROM section WHERE dep_id=$dep_id ";
        $result=  dbQuery($sql);
        if(!$result){
            echo 'SQL Error';
        }else{
            $sendto=$_POST['toSomeUser'];
            $sendto=substr($sendto, 1);
            $c=explode("|", $sendto);
            
                for ($i=0;$i<count($c);$i++){
                    $sendto=$c[$i];
                    $tb="paperuser";
                    $sql="insert into $tb (pid,sec_id,dep_id) values ($lastid,$sendto,$dep_id)";
                    $dbquery=dbQuery($sql);
                }
                echo "<script>
                swal({
                    title:'ส่งเอกสารเรียบร้อยแล้ว',
                    type:'success',
                    showConfirmButton:true
                    },
                    function(isConfirm){
                        if(isConfirm){
                            window.location.href='paper.php';
                        }
                    }); 
                </script>";
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

    @$toAll=$_POST['toAll'];              //ส่งเอกสารถึงทุกคน
    @$toSome=$_POST['toSome'];            //ส่งตามประเภท
    @$toSomeOne=$_POST['toSomeOne'];       //ส่งแบบเลือกเอง
    
    @$toSomeUser=$_POST['toSomeUser'];      //ช่องส่งแยกประเภทตามหน่วยงาน
    @$toSomeOneUser=$_POST['toSomeOneUser'];  //ช่องรับรหัสแบบเลือกเอง
    
    @$fileupload=$_POST['file'];          //ไฟล์เอกสาร
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
        if($book_id && $link_file<>null){
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                       VALUES('$title','$detail','$link_file','$date',$user_id,$outsite,$sec_id,$dep_id)";
        }else{
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                       VALUES('$title','$detail','$part_link','$date',$user_id,$outsite,$sec_id,$dep_id)";
        }
        
        $result=dbQuery($sql);  
        if(!$result){
            echo "<script>
            swal({
                title:'มีบางอย่างผิดพลาด !',
                type:'error',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        window.location.href='paper.php';
                    }
                }); 
            </script>"; 
        }

        $lastid=  dbInsertId();    //เลข ID จากตาราง paper ล่าสุด
        /*$sql="SHOW TABLE STATUS LIKE 'paper'";     //ส่วนหา ID ล่าสุด
        $result=dbQuery($sql);
        $row=dbFetchAssoc($result);
        $lastid=(int)$row['Auto_increment'];*/
        
        $sql="SELECT dep_id,dep_name FROM depart ORDER BY dep_id";    //เลือกส่วนราชการทั้งหมด
        $result= dbQuery($sql);
        if(!$result){
            echo "<script>
            swal({
                title:'มีบางอย่างผิดพลาด !',
                type:'error',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        window.location.href='paper.php';
                    }
                }); 
            </script>"; 
        }
        
        while($rowDepart=  dbFetchArray($result)){
            $dep_id=$rowDepart[0];
            $tb="paperuser";
            $sql="INSERT INTO $tb (pid,dep_id) values ($lastid,$dep_id)";
            //print $sqlPaper;
            $dbquery=  dbQuery($sql);
	    }
        echo "<script>
        swal({
            title:'เรียบร้อย',
            type:'success',
            showConfirmButton:true
            },
            function(isConfirm){
                if(isConfirm){
                    window.location.href='paper.php';
                }
            }); 
        </script>"; 
             
    }
    
    
    if($toSome!=''){  //ส่งเอกสารแยกตามประเภทหน่วยงาน
        if($book_id && $link_file<>null){
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                        VALUES('$title','$detail','$link_file','$dateSend',$user_id,$outsite,$sec_id,$dep_id)";

        }else{
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                  VALUES('$title','$detail','$part_link','$dateSend',$user_id,$outsite,$sec_id,$dep_id)";
        }
        
        //print "คำสั่งส่งข้อมูลให้บางหน่วยงาน". $sqlSend;
        $result=dbQuery($sql);  
        
        $lastid=  dbInsertId();     //ค้นหาเลขระเบียนล่าสุด
        $sendto=$_POST['toSomeUser'];  //ส่งมาจาก textbox 
        $sendto=substr($sendto, 1);
        $c=explode("|", $sendto);      //เก็บค่าเป็นอาเรย์  โดย c หมายถึงรหัสประเภทหน่วยงาน
                for ($i=0;$i<count($c);$i++){
                    $sendto=$c[$i];
                    $sql="SELECT dep_id FROM depart WHERE type_id=$sendto";  //เลือกรหัสหน่วยงานมาจากตารางหน่วยงาน
                    $result=  dbQuery($sql);
                    while($rowUser = dbFetchArray($result)){
                        $dep_id=$rowUser[0];
                        $sql="INSERT INTO paperuser(pid,dep_id) VALUE ('$lastid','$dep_id')";
                        dbQuery($sql);
                    }
                }

                echo "<script>
                swal({
                    title:'เรียบร้อย',
                    type:'success',
                    showConfirmButton:true
                    },
                    function(isConfirm){
                        if(isConfirm){
                            window.location.href='paper.php';
                        }
                    }); 
                </script>";   
        
    }
    
    
    if($toSomeOne!=''){  //ส่งเอกสารแบบเลือกเอง
        if($book_id && $link_file<>null){
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                       VALUES('$title','$detail','$link_file,'$dateSend',$user_id,$outsite,$sec_id,$dep_id)";
        }else{
            $sql="INSERT INTO paper(title,detail,file,postdate,u_id,outsite,sec_id,dep_id)
                       VALUES('$title','$detail','$part_link','$dateSend',$user_id,$outsite,$sec_id,$dep_id)";
        }
        
        
        $result=dbQuery($sql);  
        
        $lastid=  dbInsertId();     //ค้นหาเลขระเบียนล่าสุด
        $sendto=$toSomeOneUser;
        $sendto=  substr($sendto,1);
        $c=  explode("|",$sendto);
                for ($i=0;$i<count($c);$i++){
                    $sendto=$c[$i];
                    $sql="INSERT INTO paperuser(pid,dep_id) VALUE ('$lastid','$sendto')";
                    dbQuery($sql);
                }
                echo "<script>
                swal({
                    title:'เรียบร้อย',
                    type:'success',
                    showConfirmButton:true
                    },
                    function(isConfirm){
                        if(isConfirm){
                            window.location.href='paper.php';
                        }
                    }); 
                </script>";       
 
    }
}
       
?>
<!-- end process -->