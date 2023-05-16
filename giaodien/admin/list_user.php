
<?php  
include "header.php";


?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Quản lý thành viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php 
        if($_SESSION['current_user']['_status']==1){
        $con=mysqli_connect("localhost","root","123456789","db_doan"); 
        $result = mysqli_query($con, "SELECT * FROM user");
        mysqli_close($con);
        ?>
        <style>
           
            table, th, td {
                border: 1px solid black;
            }
            #user-info{
               
                width: 1000px;
            }
            #user-info table{
                margin: 10px auto 0 auto;
                text-align: center;
            }
            #user-info h1{
                text-align: center;
            }
        </style>
        <div id="user-info">
            <h1>Danh sách tài khoản</h1>
            <a href="./sign_Up.php">Tạo tài khoản mới</a>
            <table id = "user-listing" style="width: 700px;">
                <tr>
                    <td>Username</td>
                    <td>Trạng thái</td>
                    <td>Cập nhật lần cuối</td>
                    <td>Ngày lập</td>
                    <td>Sửa</td>
                    <td>Xóa</td>
                </tr>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?= $row['user_name'] ?></td>
                        <td><?= $row['_status'] == 1 ? "Kích hoạt" : "Block" ?></td>
                        <td><?= date('d/m/Y H:i', $row['last_update']) ?></td>
                        <td><?= date('d/m/Y H:i', $row['create_time']) ?></td>
                        <td><a href="./edit_user.php?user_id=<?= $row['user_id'] ?>">Sửa</a></td>
                        <td><a href="./delete_user.php?user_id=<?= $row['user_id'] ?>">Xóa</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </body>
</html>
<?php } ?>