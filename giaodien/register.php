<!DOCTYPE html>
<html>
    <head>
        <title>Tạo form đăng ký, đăng nhập hệ thống</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style_F2.css">
        <style>
            .box-content{
                margin: 0 auto 100px;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
                
            }
            #user_register form{
                width: 200px;
                margin: 40px auto;
            }
            #user_register form input{
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php
        $con=mysqli_connect("localhost","root","123456789","db_doan");   
        include './function.php';
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'reg') {
            if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
                  $fullname = $_POST['fullname'];
                $birthday = $_POST['birthday'];
                $check = validateDateTime($birthday);
                 if ($check) {
                 try {  $birthday = strtotime($birthday);
                
                   $result = mysqli_query($con, "INSERT INTO `user` (`fullname`,`user_name`, `pass_word`, `birthday`, `_status`,`email`,`sdt`,`address`, `create_time`, `last_update`) VALUES ('" . $_POST['fullname'] . "', '" . $_POST['username'] . "', MD5('" . $_POST['password'] . "'), '" . $birthday . "', 1,'" . $_POST['email'] . "','" . $_POST['sdt'] . "','" . $_POST['address'] . "', " . time() . ", '" . time() . "');");
                } catch (Exception $e) {
                      $error=  $e->getMessage();
                    //   echo $error;
                }
                      if (strpos($error, "Duplicate entry") !== FALSE) {
                            $error = "Tài khoản đã tồn tại. Bạn vui lòng chọn tài khoản khác.";
                            }
                          mysqli_close($con);
                } else {
                            $error = "Ngày tháng nhập chưa chính xác";
                            }
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="./register.php">Quay lại</a>
                    </div>
                <?php } else { ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "Đăng ký tài khoản thành công" ?></h1>
                        <a href="./login.php">Mời bạn đăng nhập</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="edit-notify" class="box-content">
                    <h1>Vui lòng nhập đủ thông tin để đăng ký tài khoản</h1>
                    <a href="./register.php">Quay lại đăng ký</a>
                </div>
                <?php
            }
        } else {
            ?>
            <div id="user_register" class="box-content">
                <h1>Đăng ký tài khoản</h1>
                <form action="./register.php?action=reg" method="Post" autocomplete="off">
                    <label>Username</label></br>
                    <input type="text" name="username" value=""><br/>
                    <label>Password</label></br>
                    <input type="password" name="password" value="" /></br>
                    <label>Họ tên</label></br>
                    <input type="text" name="fullname" value="" /><br/>
                    <label>Ngày sinh (DD-MM-YYYY)</label></br>
                    <input type="text" name="birthday" value="" /><br/>
                    <label>Địa chỉ</label></br>
                    <input type="text" name="address" value="" /><br/>
                    <label>Email</label></br>
                    <input type="text" name="email" value="" /><br/>
                    <label>SDT</label></br>
                    <input type="text" name="sdt" value="" /><br/>
                    </br>
                    </br>
                    <input type="submit" value="Đăng ký"/>
                </form>
            </div>
            <?php
        }
        ?>
    </body>
</html>
<?php include "footerF.php"; ?>
