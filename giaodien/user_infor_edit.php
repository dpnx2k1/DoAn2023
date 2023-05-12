<?php $con=mysqli_connect("localhost","root","123456789","db_doan");   
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password2'])) {
            if ($_POST['new_password']!=$_POST['new_password2']){
            $error = "Mật khẩu mới không khớp !.";}
            elseif (isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['old_password']) && !empty($_POST['old_password']) && isset($_POST['new_password']) && !empty($_POST['new_password'])
            ) {
                $userResult = mysqli_query($con, "Select * from `user` WHERE (`user_id` = " . $_POST['user_id'] . " AND `pass_word` = '" . md5($_POST['old_password']) . "')");
                if ($userResult->num_rows > 0) {
                    $result = mysqli_query($con, "UPDATE `user` SET `pass_word` = MD5('" . $_POST['new_password'] . "'), `last_update`=" . time() . " WHERE (`user_id` = " . $_POST['user_id'] . " AND `pass_word` = '" . md5($_POST['old_password']) . "')");

                    if (!$result) {
                        $error = "Không thể cập nhật tài khoản";
                    }
                }
                else{
                    $error = "Mật khẩu cũ không đúng.";
                }
            }
                mysqli_close($con);?>
                    
                      <?php if ($error !== false) {
                             ?>
                               <div id="error-notify" class="box-content">
                                 <h1>Thông báo</h1>
                                 <h4><?= $error ?></h4>
                                 <a href="javascript:history.back()">Đổi lại mật khẩu</a>
                             </div>
         
                         <?php } else { ?>
                             <div id="edit-notify" class="box-content">
                                 <h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
                                 <a href="./login.php">Quay lại tài khoản</a>
                             </div>
                         <?php } 
            }
                             else { ?>
                            <div id="edit-notify" class="box-content">
                            <h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
                            <a href="./user_infor.php">Quay lại sửa tài khoản</a>
                            </div>
                        <?php 
                        }}?>
            
           
          