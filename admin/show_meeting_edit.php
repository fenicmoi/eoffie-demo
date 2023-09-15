
<?php
date_default_timezone_set('Asia/Bangkok');
include 'function.php';
include '../library/database.php';

$room_id=$_POST['room_id'];
$u_id=$_POST['u_id'];

$sql="SELECT *
      FROM meeting_room
      WHERE room_id=$room_id";
//print $sql;
$result=dbQuery($sql);
$row=dbFetchAssoc($result);
?>  
 <form method="post" action="meet_room.php"  enctype="multipart/form-data">
<table class="table-bordered table-hover" width=100% >
    <tr>
        <td colspan="2"><center> <img src="doc/<?php print $row['roomimg'];?>" width="300" hight="300" class="img-thumbnail"></center></td>
    </tr>
    <tr>
         <td width="20%"><label>ชื่อห้อง:</label></td>
         <td><input name="roomname" type="text" value="<?php print $row['roomname']?>" size="80"></td>
    </tr>
    <tr>
         <td><label>ที่อยู่:</label></td>
         <td><input name="roomplace" type="text" value="<?php print $row['roomplace']?>" size="80"></td>
    </tr>
    <tr>
         <td><label>ความจุผู้เข้าประชุม:</label></td>
         <td><input name="roomcount" type="text" value="<?php print $row['roomcount']?>" size="80"></td>
    </tr>
    <tr>
         <td><label>ค่าธรรมเนียมเต็มวัน:</label></td>
         <td><input name="money1" type="text" value="<?php print $row['money1']?>" size="80"></td>
    </tr>
     <tr>
         <td><label>ค่าธรรมเนียมครึ่งวัน:</label></td>
         <td><input name="money2" type="text" value="<?php print $row['money2']?>" size="80"></td>
    </tr>
     <tr>
         <td><label>อุปกรณ์อำนวยความสะดวก:</label></td>
         <td>
              <?php
              if($row['sound']==1){?>
                  <input name="t1" type="checkbox" value="0"checked >ระบบเสียง
              <?php }else{?>
                  <input name="t1" type="checkbox" value="1" checked>ระบบเสียง
              <?php }?>

              <?php
              if($row['vga']==1){?>
                  <input name="t2" type="checkbox" value="0" checked >ระบบแสดงผล
              <?php }else{?>
                  <input name="t2" type="checkbox" value="1" checked>ระบบแสดงผล
              <?php }?>

              <?php
              if($row['vcs']==1){?>
                  <input name="t3" type="checkbox" value="0" checked>ระบบประชุมทางไกล
              <?php }else{?>
                  <input name="t3" type="checkbox" value="1" checked>ระบบประชุมทางไกล
              <?php }?>
         </td>
    </tr>
    <tr>
         <td><label>เจ้าของห้อง:</label></td>
           <td><input name="dept" type="text" value="<?php print $row['dept']?>" size="80"></td>
    </tr>
    <tr>
         <td><label>เบอร์ติดต่อ:</label></td>
         <td><input name="tel" type="text" value="<?php print $row['tel']?>" size="80"></td>
    </tr>
     <tr>
         <td>
            <label>สถานะการใช้งาน:</label>
        </td>
         <td>
              <?php
                if($row['room_status']==1){
                    echo "<input name='room_status' type='radio' value='1' checked>ใช้งานปกติ";
                    echo "<input name='room_status' type='radio' value='0'>งดใช้งาน";
                }else{
                    echo "<input name='room_status' type='radio' value='1'>ใช้งานปกติ";
                    echo "<input name='room_status' type='radio' value='0' checked>งดใช้งาน";
                }
            ?>
         </td>
    </tr>
    <tr>
         <td><label>รูปห้องประชุม:</label></td>
         <td><input  type="file" name="fileUpload"></td>
    </tr>
</table>

 <center>
    <input type="hidden" name="room_id" value="<?=$room_id?>">
    <button class="btn btn-success btn-lg" type="submit" name="edit" id="edit">
        <i class="fas fa-save"></i> บันทึก
    </button>
</center>  
</form>

