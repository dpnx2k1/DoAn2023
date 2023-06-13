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
				  <a href="./login2.php">Quay lại</a>
			  </div>
			  <?php
			  exit;
		  }
		  ?>
	  <?php } ?>
	  <?php if (empty($_SESSION['current_user'])) { ?>
<!-- partial:index.partial.html -->
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" action="./login2.php" method="Post" autocomplete="off">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" name="username" class="login__input" placeholder="User name / Email">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="password" class="login__input" placeholder="Password">
				</div>
				<button type="submit" class="button login__submit">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>	
				<br><br>
				<a href="./register.php">
					<span>Register</span>
					</a>
				</button>				
			</form>
			<div class="social-login">
				<br>
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
        } else {
            // $currentUser = $_SESSION['current_user'];
            header("location:../index.php");}
            ?>
</body>
</html>
