<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Tạo form đăng ký, đăng nhập hệ thống</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="style_F2.css">
        <style>
            .box-content{
                margin: 100px auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #user_login form{
                width: 200px;
                margin: 40px auto;
            }
            #user_login form input{
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
    <div class="logo">
            <a href="index.php"><img src="image/2.png" alt=""></a>
        </div>
        <?php if (session_id()=='') {
          session_start();
        }
        $con=mysqli_connect("localhost","root","123456789","db_doan");   
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($con, "Select * from `user` WHERE (`user_name` ='" . $_POST['username'] . "' AND `pass_word` = md5('" . $_POST['password'] . "'))");
            if (!$result) {
                $error = mysqli_error($con);
            } else {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['current_user'] = $user;
                // var_dump($_SESSION['current_user']);exit();
            }
            mysqli_close($con);
            if ($error !== false || $result->num_rows == 0) {
                ?>
                <div id="login-notify" class="box-content">
                    <h1>Thông báo</h1>
                    <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                    <a href="./login.php">Quay lại</a>
                </div>
                <?php
                exit;
            }
            ?>
        <?php } ?>
        <?php if (empty($_SESSION['current_user'])) { ?>
            <div id="user_login" class="box-content">
                <h1>Đăng nhập tài khoản</h1>
                <form action="./login.php" method="Post" autocomplete="off">
                    <label>Username</label></br>
                    <input type="text" name="username" value="" /><br/>
                    <label>Password</label></br>
                    <input type="password" name="password" value="" /></br>
                    <br>
                  <div class="user_login_or_cre"></div>
                    <input type="submit" value="Đăng nhập" />
                    <p>bạn chưa có tài khoản ?</p>
                    <a href="./register.php">tạo tài khoản mới</a>
                </div>
                </form>
            </div>
            <?php
        } else {
            // $currentUser = $_SESSION['current_user'];
            header("location:index.php");
            ?>
            <div id="login-notify" class="box-content">
              
                
                
                
                <!-- <a style="color: #33CCFF;" href="index.php">Trang chủ</a><br> -->
            </div>
        <?php } ?>
    </body>
</html>
<?php include "footerF.php"; ?>