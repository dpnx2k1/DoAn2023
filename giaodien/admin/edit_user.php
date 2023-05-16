<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Đổi thông tin thành viên</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .box-content{
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #edit_user form{
                width: 200px;
                margin: 40px auto;
            }
            #edit_user form input{
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php 
  
       $con=mysqli_connect("localhost","root","123456789","db_doan"); 
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            if (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['pass_word']) && !empty($_POST['pass_word'])) {
                $result = mysqli_query($con, "UPDATE `user` SET `pass_word` = MD5('" . $_POST['pass_word'] . "'), `_status` = " . $_POST['_status'] . ", `last_update`=" . time() . " WHERE `user`.`user_id` = " . $_POST['user_id'] . ";");
                if (!$result) {
                    $error = "Không thể cập nhật tài khoản";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="./list_user.php">Danh sách tài khoản</a>
                    </div>
                <?php } else { ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
                        <a href="./list_user.php">Danh sách tài khoản</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="edit-notify" class="box-content">
                    <h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
                    <a href="./edit_user.php?user_id=<?= $_POST['user_id'] ?>">Quay lại sửa tài khoản</a>
                </div>
            <?php
            }
        } else {
            $result = mysqli_query($con, "SELECT * FROM user where `user_id`=" . $_GET['user_id']);
            $user = $result->fetch_assoc();
            mysqli_close($con);
            if (!empty($user)) {
                ?>
                <div id="edit_user" class="box-content">
                    <h1>Sửa tài khoản "<?= $user['user_name'] ?>"</h1>
                    <form action="./edit_user.php?action=edit" method="Post" autocomplete="off">
                        <label>Password</label></br>
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>" />
                        <input type="pass_word" name="pass_word" value="" />
                        <select name="_status">
                            <option <?php if (!empty($user['_status'])) { ?> selected <?php } ?> value="1">Kích hoạt</option>
                            <option <?php if (empty($user['_status'])) { ?> selected <?php } ?>  value="0">Block</option>
                        </select>
                        <br><br>
                        <input type="submit" value="Edit" />
                    </form>
                </div>
            <?php
            }
        }
        ?>
    </body>
</html>
