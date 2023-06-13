<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Css / html Login form </title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
<link rel="stylesheet" href="style2.css">

</head>
<body>
<?php
        $con=mysqli_connect("localhost","root","123456789","db_doan");   
        include '../function.php';
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
                        <a href="./login2.php">Mời bạn đăng nhập</a>
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
<!-- partial:index.partial.html -->
<div class="container">
	<div class="screen2">
		<div class="screen__content">
			<h1>REGISTER</h1>
			<form class="login2" action="./register.php?action=reg" method="Post" autocomplete="off"">
			<div class="row">	
				<div class="login__field">
					<i class="login__icon fas fa-user2"></i>
					<input type="text" name="username" class="login__input2" placeholder="User name">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="password" class="login__input2" placeholder="Password">
				</div>
			</div>
			<div class="row">	
				<div class="login__field">
					<i class="login__icon fas fa-user2"></i>
					<input type="text" name="fullname" class="login__input2" placeholder="Họ tên">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="text" name="birthday" class="login__input2" placeholder="birthday(DD-MM-YYYY)">
				</div>
			</div>
			<div class="row">	
				<div class="login__field">
					<i class="login__icon fas fa-user2"></i>
					<input type="text" name="address" class="login__input2" placeholder="address">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="text" name="email" class="login__input2" placeholder="email">
				</div>
			</div>
			<div class="row">	
				<div class="login__field">
					<i class="login__icon fas fa-user2"></i>
					<input type="text" name="sdt" class="login__input2" placeholder="Phone">
				</div>
				
			</div>
				
				<button type="submit" class="button login__submit">
					<span class="button__text2">Register Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
			<div class="social-login">
				<h3>log in via</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-twitter"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
<!-- partial -->
<?php
        }
        ?>
</body>
</html>
