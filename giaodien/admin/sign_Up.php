
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
        <title>Tạo tài khoản mới</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .box-content{       
                width: 100%;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
                background-color: #ccc;
            }
            #create_user form{
                
                width: 200px;
                margin: 60px auto;
                background-color: #ccc;
            }
            #create_user form label{
                margin-right: 80px;
                background-color: #ccc;
            }
            #create_user form input{
                width: 150px;
                height: 20px;
                margin: 5px 0;

            }
        </style>
    </head>
    <body>

        <?php
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'create') {
            if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
                $con=mysqli_connect("localhost","root","123456789","db_doan");    
               try {       
                $result = mysqli_query($con, "INSERT INTO `user` (`user_id`, `user_name`, `pass_word`, `_status`, `create_time`, `last_update`) VALUES (NULL, '" . $_POST['username'] . "', MD5('" . $_POST['password'] . "'), 1, " . time() . ", '" . time() . "');");
                 } catch (Exception $e) {
                $error=  $e->getMessage();
               }
                    if (strpos($error, "Duplicate entry") !== FALSE) {
                        $error = "Tài khoản đã tồn tại. Bạn vui lòng chọn tài khoản khác.";
                    }
                
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="./sign_Up.php">Tạo tài khoản khác</a>
                    </div>
                <?php } else { ?>
                    <div id="success-notify" class="box-content">
                        <h1>Chúc mừng</h1>
                        <h4>Bạn đã tạo thành công tài khoản <?= $_POST['username'] ?></h4>
                        <a href="./list_user.php">Danh sách tài khoản</a>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <div id="create_user" class="box-content">
                <h1>Tạo tài khoản</h1>
                <form action="./Sign_Up.php?action=create" method="Post" autocomplete="off">
                    <label>Username</label></br>
                    <input type="text" name="username" value="" />
                    <br>
                    <label>Password</label></br>
                    <input type="password" name="password" value="" />
                    <br><br>
                    <input type="submit" value="Create" />
                </form> 
            </div>
        <?php } ?>
    </body>
</html>
