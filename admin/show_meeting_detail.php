
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
<table class="table-bordered table-hover" width=100% >
    <tr>
        <!-- <td colspan="2"><center> <img src="doc/<?php print $row['roomimg'];?>" width="300" hight="300" class="img-thumbnail"></center></td> -->
        <td colspan="2"><center><i class="fas fa-chalkboard-teacher fa-4x"></i></center></td>
    </tr>
    <tr>
         <td width="20%"><label>ชื่อห้อง:</label></td>
         <td><?php print $row['roomname']?></td>
    </tr>
    <tr>
         <td><label>ที่อยู่:</label></td>
         <td><?php print $row['roomplace']?></td>
    </tr>
    <tr>
         <td><label>ความจุผู้เข้าประชุม:</label></td>
         <td><?php print $row['roomcount']?>.คน</td>
    </tr>
    <tr>
         <td><label>ค่าธรรมเนียมเต็มวัน:</label></td>
         <td><?php print $row['money1']?>.บาท</td>
    </tr>
     <tr>
         <td><label>ค่าธรรมเนียมครึ่งวัน:</label></td>
         <td><?php print $row['money2']?>.บาท</td>
    </tr>
     <tr>
         <td><label>อุปกรณ์อำนวยความสะดวก:</label></td>
         <td>
            <?php 
                if($row['sound']==1){?>
                  <input type="checkbox" checked>ระบบเสียง
                <?php }
                if($row['sound']==1){?>
                  <input type="checkbox" checked>ระบบแสดงผล
                <?php }
                if($row['sound']==1){?>
                  <input type="checkbox" checked>ระบบประชุมทางไกลกระทรวงมหาดไทย
                <?php }?>
         </td>
    </tr>
    <tr>
         <td><label>เจ้าของห้อง:</label></td>
         <td><?php print $row['dept']?></td>
    </tr>
    <tr>
         <td><label>เบอร์ติดต่อ:</label></td>
         <td><?php print $row['tel']?></td>
    </tr>

</table>

