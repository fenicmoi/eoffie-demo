<!-- หนังสือรับถึงจังหวัด -->
<script type="text/javascript" src="datePicket.js"></script>
<?php
include "header.php"; 
$u_id=$_SESSION['ses_u_id'];

?>
<?php    
//ตรวจสอบปีเอกสาร
    list($yid,$yname,$ystatus)=chkYear();  
    $yid=$yid;
    $yname=$yname;
    $ystatus=$ystatus;
?>
        <div class="col-md-2" >
           <?php
                $menu=  checkMenu($level_id);
                include $menu;
           ?>
        </div>
        
        <div  class="col-md-10">
            <div class="alert alert-info pull-right"><h4><i class="fa fa-info-circle fa-2xs"></i> หนังสือรับ(หนังสือถึงจังหวัด)</h4></div>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home"><h4>ทะเบียนรวมหนังสือรับ</h4></a></li>
                <li><a data-toggle="tab" href="#menu1"><h4>ลงทะเบียนหนังสือรับ</h4></a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                     <table class="table table-bordered table-hover" id="tbRecive">
                        <thead class="bg-info">
                            <tr>
                                <th>ท/บ กลาง</th> 
                                <th>ท/บ รับ</th>
                                <th>เลขที่เอกสาร</th>
                                <th>เรื่อง</th>
                                <th>จาก</th>
                                <th>วันที่รับ</th>
                                <th>ส่งเอกสาร</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count=1;
                              // $sql="SELECT * FROM  book_master WHERE dep_id=$dep_id  ORDER BY rec_id DESC";
                                $sql="SELECT m.book_id,m.rec_id,d.book_no,d.title,d.sendfrom,d.sendto,d.date_in,s.sec_code
                                      FROM book_master m
                                      INNER JOIN book_detail d ON d.book_id = m.book_id
                                      INNER JOIN section s ON s.sec_id = m.sec_id
                                      WHERE m.dep_id=$dep_id
                                      ORDER BY m.book_id DESC";
                               // echo $sql;
                                $result=dbQuery($sql);
                                while($row=  dbFetchArray($result)){?>
                                    <?php $rec_id=$row['rec_id']; ?>    <!-- กำหนดตัวแปรเพื่อส่งไปกับลิงค์ -->
                                    <?php $book_id=$row['book_id']; ?>  <!-- กำหนดตัวแปรเพื่อส่งไปกับลิงค์ -->
                                    <tr>
                                    <td><?php echo $row['book_id']; ?></td> 
                                    <td><?php echo $row['sec_code'];?>/<?php echo $row['rec_id']; ?></td>
                                    <td><?php echo $row['book_no']; ?></td>
                                    <td>
                                        <a href="#" 
                                                onclick="load_leave_data('<? print $u_id;?>','<? print $rec_id; ?>','<? print $book_id; ?>');" data-toggle="modal" data-target=".bs-example-modal-table">
                                                <?php echo $row['title'];?> 
                                        </a>
                                    </td>
                                    <td><?php echo $row['sendto']; ?></td>
                                    <td><?php echo $row['date_in']; ?></td>
                                    <td><a class="btn btn-primary" href="paper.php"><i  class="fa fa-paper-plane"></i> ส่งเอกสาร</a></td>
                                    </tr>
                                    <?php $count++; }?>
                                    
                        </tbody>
                    </table>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <br>
                        
                   <i class="badge"> ข้อกำหนดทั้่วไป </i>                   
                    <div class="well">
                     <form name="form" method="post" enctype="multipart/form-data">
                        <table width="800">
                            <tr>
                                <td> 
                                    <div class="form-group form-inline">
                                        <label for="typeDoc">ประเภทหนังสือ :</label>
                                        <input class="form-control" name="typeDoc" type="radio" value="1" checked=""> ปกติ
                                        <input class="form-control" name="typeDoc" type="radio" value="2" > เวียน
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="yearDoc">ปีเอกสาร : </label>
                                        <input class="form-control"  name="yearDoc" type="text" value="<?php print $yname; ?>" disabled="">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                     <div class="form-group form-inline">
                                        <label for="date_in">วันที่ลงรับ:</label>
                                        <input class="form-control" type="text" name="date_in" id="date_in" value="<?php print DateThai();?>" >
                                    </div>
                                </td>
                                <?php
                                //วัตถุประสงค์
                                $sql="SELECT * FROM object ORDER BY obj_id";
                                $result = dbQuery($sql)
                                ?>
                                <td>
                                    <div class="form-group form-inline"> 
                                        <label for="obj_id">วัตถุประสงค์ : </label>
                                        <select name="obj_id" class="form-control" required>
                                            <?php 
                                                while ($row= dbFetchArray($result)){
                                                echo "<option  value=".$row['obj_id'].">".$row['obj_name']."</option>";
                                            }?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="book_no">เลขที่เอกสาร : </label>
                                        <input type="text" class="form-control" name="book_no" id="book_no"  >
                                    </div>    
                                </td>
                                <td>
                                 <div class="form-group form-inline">
                                     <label>เลขทะเบียนรับ : <kbd>ออกโดยระบบ</kbd></label>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                //ชั้นความเร็ว
                                $sql="SELECT * FROM speed ORDER BY speed_id";
                                $result=  dbQuery($sql);
                            ?>
                            <tr>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="speed_id">ชั้นความเร็ว : </label>
                                        <select name="speed_id" id="speed_id" class="form-control">
                                                <?php 
                                                    while ($rowSpeed= dbFetchArray($result)){
                                                        echo "<option  value=".$rowSpeed['speed_id'].">".$rowSpeed['speed_name']."</option>";
                                                    }?>
                                        </select>
                                    </div>
                                </td>
                                <?php
                                //ชั้นความลับ
                                $sql="SELECT * FROM priority ORDER BY pri_id";
                                $result=  dbQuery($sql);
                                ?>
                                <td>
                                    <div class="form-group form-inline">
                                        <label for="sec_id">ชั้นความลับ :</label>
                                        <select name="pri_id" id="pri_id" class="form-control">
                                                <?php
                                                    while($rowSecret= dbFetchArray($result)){
                                                        echo "<option value=".$rowSecret['pri_id'].">".$rowSecret['pri_name']."</option>";
                                                    }?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        </div>
                        <i class="badge">รายละเอียด</i>
                        <div class="well">  
                            <table width="800">
                                <tr>
                                    <td>
                                        <div class="form-group form-inline">
                                            <label for="sendfrom">จาก : </label>
                                            <input class="form-control" type="text"  name="sendfrom" id="sendfrom" size="50" require placeholder="ระบุผู้ส่ง" required >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group form-inline">
                                            <label for="sendto">ถึง : </label>
                                            <input class="form-control" type="text"  name="sendto" id="sendto"  size="50"  placeholder="ระบุผู้รับหนังสือ" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group form-inline">
                                            <label for="title">เรื่อง : </label>
                                            <input class="form-control" type="text"  name="title" id="title" size="50" placeholder="เรื่องหนังสือ" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group form-inline">
                                            <label for="datepicker">เอกสารลงวันที่ :</label><input class="form-control" type="text" name="datepicker"  id="datepicker" required >
                                       </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group form-inline">
                                            <label for="refer">อ้างถึง</label>
                                            <input class="form-control" type="text"  size="50" name="refer" id="refer" value="-" ><br>
                                        </div>    
                                     </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group form-inline">
                                            <label for="attachment">สิ่งที่ส่งมาด้วย</label>
                                            <input class="form-control" type="text" size="40" name="attachment" value="-" >
                                        </div>
                                    </td>
                                    <td>
                                         <div class="form-group form-inline">
                                            <label for="practice">หน่วยดำเนินการ</label>
                                            <input class="form-control" type="text" size="30"  name="practice" placeholder="ระบุหน่วยงานรับผิดชอบ" required>
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- <div class="form-group form-inline">
                                             <label for="file_location">ที่เก็บเอกสาร</label>
                                             <input class="form-control" type="text" size="30"  name="file_location" placeholder="ระบุที่เก็บเอกสาร" disabled>
                                        </div> -->
                                    </td>
                                </tr>
                            </table>
                          
                          <div class="form-group form-inline">
                              <label>อื่นๆ :</label>
                              <input type="checkbox" name="follow" id="follow" value="1" checked> ติดตามผลการดำเนินงาน
                              <input type="checkbox" name="open" id="open" value="1" checked> เปิดเผยแก่บุคคลทั่วไป
                          </div>
                         </div> <!-- class well -->    
                      
                               <center>
                                    <button class="btn btn-primary btn-lg" type="submit" name="save">
                                    <i class="fa fa-database fa-2x"></i> บันทึก
                                    <input id="u_id" name="u_id" type="hidden" value="<?php echo $u_id; ?>"> 
                                    <input id="sec_id" name="u_id" type="hidden" value="<?php echo $sec_id; ?>"> 
                                    <input id="dep_id" name="u_id" type="hidden" value="<?php echo $dep_id; ?>"> 
                                    <input id="yid" name="yid" type="hidden" value="<?php echo $yid; ?>"> 
                                    </button>
                                    
                               </center>    
                     </form>
                   
                </div>
            </div>
        </div>  <!-- col-md-10 -->
    </div>  <!-- container -->
    <!-- Modal -->
        <div  class="modal fade bs-example-modal-table" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><i class="fa fa-info"></i> รายละเอียด</h4>
            </div>
            <div class="modal-body no-padding">
                <div id="divDataview">
                       <!-- สวนสำหรับแสดงผลรายละเอียด   อ้างอิงกับไฟล์  show_command_detail.php -->                             
                </div>     
            </div> <!-- modal-body -->
            <div class="modal-footer bg-info">
            <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
            </div>
        </div>
        </div>
    </div>
    </div>
<?php //include "footer.php"; ?>


  <!-- ส่วนเพิ่มข้อมูล  -->
 <?php
    if(isset($_POST['save'])){   //กดปุ่มบันทึกจากฟอร์มบันทึก

        //#######  ข้อมูลสำหรับตาราง book_master ########################################
        $type_id=1;                    //ชนิดของหนังสือ  1  หนังสือรับ-ถึงจังหวัด
        /*$dep_id=$_SESSION['dep_id'];     //รหัสหน่วยงาน   รับค่ามาจาก session จาก header แล้ว
        $sec_id=$_SESSION['sec_id'];       //รหัสกลุ่มงาน  */
        $uid=$_POST['u_id'];               //รหัสผู้ใช้
        $obj_id=$_POST['obj_id'];          //รหัสวัตถุประสงค์
        $pri_id=$_POST['sec_id'];          //รหัสชั้นความลับ
        $yid=$_POST['yid'];                //รหัสปีปัจจุบัน
        $typeDoc=$_POST['typeDoc'];        //รหัสประเภทหนังสือ   1ปกติ 2 เวียน
        $speed_id=$_POST['speed_id'];


        //(1) เลือกข้อมูลเพื่อรันเลขรับ  โดยมีเงื่อนไขให้ตรงกับหน่วยงานของผู้ใช้ ###########################
        $sql="SELECT rec_id FROM book_master WHERE dep_id=$dep_id ORDER  BY book_id DESC";
        $result=dbQuery($sql);
        $rowRun= dbFetchArray($result);
        $rec_id=$rowRun['rec_id'];
        $rec_id++;
       
        // ##### ตาราง book_master
        /*$sql1="INSERT INTO book_master (rec_id,type_id,dep_id,sec_id,u_id,obj_id,pri_id,yid,typeDoc,speed_id) 
              VALUES ($rec_id,$type_id,$dep_id,$sec_id,$u_id,$obj_id,$pri_id,$yid,$typeDoc,$speed_id)";*/
       //$result1=dbQuery($sql1);

        $sql="SHOW TABLE STATUS LIKE 'book_master'";
        $result=dbQuery($sql);
        $row=dbFetchAssoc($result);
        $book_id=(int)$row['Auto_increment'];

        //#######  ข้อมูลสำหรับตาราง book_detail  #########################################
       // $book_id=dbInsertId($dbConn);  //เลือก ID ล่าสุดจากตาราง book_master
        $book_no=$_POST['book_no'];           // หมายเลขประจำหนังสือ
        $title=$_POST['title'];               // เรื่อง   
        $date_in=$_POST['date_in'];             // วันที่ลงรับ
        $date_book=$_POST['datepicker'];       // เอกสารลงวันที่
        $sendfrom=$_POST['sendfrom'];         // ผู้ส่ง
        $sendto=$_POST['sendto'];             // ผู้รับ
        $refer=$_POST['refer'];               // อ้างถึง
        $practice=$_POST['practice'];         // ผู้ปฏิบัติ
        $follow=$_POST['follow'];             // ติดตามหนังสือ
        $publice_book=$_POST['open'];         // เปิดเผยหนังสือ
        $attachment=$_POST['attachment'];
       
       //$file_location=$_POST['file_location'];
        
        $datelout=date('Y-m-d h:i:s');
        
        $sql2="INSERT INTO book_detail (book_id,book_no,title,sendfrom,sendto,reference,attachment,date_book,date_in,practice,follow,publice_book)
                                VALUES($book_id,'$book_no','$title','$sendfrom','$sendto','$refer','$attachment','$date_book','$date_in','$practice','$follow','$publice_book')";
        //echo $sql;
        //$result2=dbQuery($sql2);

        //transection
        dbQuery('BEGIN');

        $sql="INSERT INTO book_master (rec_id,type_id,dep_id,sec_id,u_id,obj_id,pri_id,yid,typeDoc,speed_id) 
                      VALUES ($rec_id,$type_id,$dep_id,$sec_id,$u_id,$obj_id,$pri_id,$yid,$typeDoc,$speed_id)";
        $result1=dbQuery($sql);

        $sql="INSERT INTO book_detail (book_id,book_no,title,sendfrom,sendto,reference,attachment,date_book,date_in,practice,follow,publice_book)
        VALUES($book_id,'$book_no','$title','$sendfrom','$sendto','$refer','$attachment','$date_book','$date_in','$practice','$follow','$publice_book')";
        $result2=dbQuery($sql);

        if($result1 && $result2){
            dbQuery("COMMIT");
            echo "<script>
            swal({
                title:'เรียบร้อย',
                type:'success',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        window.location.href='flow-resive-province.php';
                    }
                }); 
            </script>";
        }else{
            dbQuery("ROLLBACK");
            echo "<script>
            swal({
                title:'มีบางอย่างผิดพลาด! กรุณาตรวจสอบ',
                type:'error',
                showConfirmButton:true
                },
                function(isConfirm){
                    if(isConfirm){
                        window.location.href='flow-resive-province.php';
                    }
                }); 
            </script>";
        } 
  } 


?>


<!-- ส่วนนำข้อมูลไปแสดงผลบน Modal -->
<script type="text/javascript">
function load_leave_data(u_id,rec_id,book_id) {
                    var sdata = 
                    {u_id : u_id , 
                    rec_id : rec_id,
                    book_id : book_id
                    };
                    $('#divDataview').load('show_resive_province_detail.php',sdata);
}
</script>


<script type='text/javascript'>
       $('#tbRecive').DataTable( {
        "order": [[ 0, "desc" ]]
    } )
</script>


<script>
$.datepicker.regional['th'] = {
    changeMonth: true,
    changeYear: true,
    //defaultDate: GetFxupdateDate(FxRateDateAndUpdate.d[0].Day),
    yearOffSet: 543,
    showOn: "button",
    buttonImage: '../images/calendar.gif',
    buttonImageOnly: true,
    dateFormat: 'dd M yy',
    dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
    dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
    monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
    monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
    constrainInput: true,

    prevText: 'ก่อนหน้า',
    nextText: 'ถัดไป',
    yearRange: '-20:+0',
    buttonText: 'เลือก',

};
$.datepicker.setDefaults($.datepicker.regional['th']);

$(function() {
    $("#datepicker").datepicker($.datepicker.regional["th"]); // Set ภาษาที่เรานิยามไว้ด้านบน
    $("#datepicker").datepicker("setDate", new Date()); //Set ค่าวันปัจจุบัน
});


var Holidays;

//On Selected Date
//Have Check Date
function CheckDate(date) {
    var day = date.getDate();
    var selectable = true; //ระบุว่าสามารถเลือกวันที่ได้หรือไม่ True = ได้ False = ไม่ได้
    var CssClass = '';

    if (Holidays != null) {

        for (var i = 0; i < Holidays.length; i++) {
            var value = Holidays[i];
            if (value == day) {

                selectable = false;
                CssClass = 'specialDate';
                break;
            }
        }
    }
    return [selectable, CssClass, ''];
}


//=====================================================================================================
//On Selected Date
function SelectedDate(dateText, inst) {
    //inst.selectedMonth = Index of mounth
    //(inst.selectedMonth+1)  = Current Mounth
    var DateText = inst.selectedDay + '/' + (inst.selectedMonth + 1) + '/' + inst.selectedYear;
    //CallGetUpdateInMonth(ReFxupdateDate(dateText));
    //CallGetUpdateInMonth(DateText);
    return [dateText, inst]
}
//=====================================================================================================
//Call Date in month on click image
function OnBeforShow(input, inst) {
    var month = inst.currentMonth + 1;
    var year = inst.currentYear;
    //currentDay: 10
    //currentMonth: 6
    //currentYear: 2012
    GetDaysShows(month, year);

}
//=====================================================================================================
//On Selected Date
//On Change Drop Down
function ChangMonthAndYear(year, month, inst) {

    GetDaysShows(month, year);
}

//=====================================
function GetDaysShows(month, year) {
    //CallGetDayInMonth(month, year); <<เป็น Function ที่ผมใช้เรียก ajax เพื่อหาวันใน DataBase  แต่นี้เป็นเพียงตัวอย่างจึงใช้ Array ด้านล่างแทนการ Return Json
    //อาจใช้ Ajax Call Data โดยเลือกจากเดือนและปี แล้วจะได้วันที่ต้องการ Set ค่าวันไว้คล้ายด้านล่าง
    Holidays = [1, 4, 6, 11]; // Sample Data
}
//=====================================
</script>