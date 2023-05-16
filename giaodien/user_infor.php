<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Account Settings UI Design</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<?php
            session_start();
            $user = $_SESSION['current_user'];
			include "./classF/user_class.php";
			$user2=new user;
			$show=$user2->show_user($user['user_id']);
			if ($show) {
				$kq=$show->fetch_assoc();
			}
          //  var_dump($user);
?>
<body>
    <a href="login.php">login</a>
	<section class="py-5 my-5">
		<div class="container">
			<h1 class="mb-5">Account Settings</h1>
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<img src="./admin/Upload/male.png" alt="Image" class="shadow">
						</div>
						<h4 class="text-center"><?=$user['fullname']?></h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Account
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a>
					</div>
				</div>
				
              
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
			<?php	
				if (!empty($user)) {
					if (!empty($kq)) {
					
               	 ?>
				
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <form action="./edit_pass.php?action=user" method="Post" autocomplete="off">
					<input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
						<h3 class="mb-4">Account Settings</h3>
						<div class="row">
						<div class="col-md-6">
								<div class="form-group">
								  	<label>User Name </label>
								  	<input type="text" name="username" class="form-control" value="<?=$kq['user_name']?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Email</label>
								  	<input type="text" name="email" class="form-control" value="<?=$kq['email']?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>First Name</label>
								  	<input type="text" name="first_name" class="form-control" value="<?=$kq['first_name']?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Last Name</label>
								  	<input type="text" name="last_name" class="form-control" value="<?=$kq['last_name']?>">
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Phone number</label>
								  	<input type="text" name="sdt" class="form-control" value="<?=$kq['sdt']?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Ngày Sinh</label>
								  	<input type="text" name="ngaysinh" class="form-control" value="<?=date("d/m/y H:i",$kq['birthday'])?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Địa chỉ</label>
								  	<input type="text" name="diachi" class="form-control" value="<?=$kq['address']?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Điểm tích lũy:</label>
									<p style="color: red; padding-top: 5px;"><?=$kq['point']?></p>
								</div>
							</div>
							
						</div>
						<div>
							<button type="submit" name="user" class="btn btn-primary">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
					</div>
					</form>
					<?php  }} ?>
                    <?php
              if (!empty($user)) {
				
              ?>
					
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <form action="./edit_pass.php?action=edit" method="Post" autocomplete="off">
                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
						<h3 class="mb-4">Password Settings</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Old password</label>
								  	<input type="password" name="old_password" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>New password</label>
								  	<input type="password" name="new_password" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Confirm new password</label>
								  	<input type="password" name="new_password2" class="form-control">
								</div>
							</div>
						</div>
						<div>
							<button  type="submit"  class="btn btn-primary">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
                    </form>
                   
					</div>
                    <?php } ?>
				</div> 
			</div>
		</div>
	</section>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>