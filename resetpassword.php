<?php
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Trang chủ</title>
	<link rel="stylesheet" href="/css/bootswatchTheme.css" />
	<link rel="stylesheet" href="/css/site.css?v=v23HLpl0AMORR735qBvwk9gBz-QfbBNXpM9vBd_qTtA" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
	<script src="/lib/jquery/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="/js/site.js?v=BxFAw9RUJ1E4NycpKEjCNDeoSvr4RPHixdBq5wDnkeY"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/n94ifuzvl80pchikopiwgz2esrw8n28dwcywvpejlqrregfp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	
	
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">Demo</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarColor02">
					<ul class="navbar-nav me-auto">
						<li class="nav-item">
							<a class="nav-link " href="/">Trang chủ</a>
						</li>
	
					</ul>
					
				</div>
			</div>
		</nav>

	</header>
	<div class="container">
		<main class="pt-3">
			
		<div class="row pt-3" id="valid-link">
				<h1>Đặt lại mật khẩu</h1>
			<form class="pt-3"  method="post">
			<?php 
				$email = "";
				if(isset($_GET['confirm']))
				{			
					$confirm = $_GET['confirm'];
					$acc = new Account();
					$email = $acc->getEmailFromConfirm($confirm);
				}
			?>
				 <input type="email" name="emailAddress"  value="<?=$email?>" placeholder="Vd: admin@gmail.com" class="form-control" hidden />
				  <div class="form-outline mb-4">
					<label class="form-label">Nhập mật khẩu mới</label>
					<input type="password" name="passWord" required placeholder="Nhập mật khẩu" class="form-control" />
				  </div>
				   <div class="form-outline mb-4">
					<label class="form-label">Nhập lại mật khẩu</label>
					<input type="password" name="repassWord" required placeholder="Nhập lại mật khẩu" class="form-control" />
				  </div>

				  <!-- Submit button -->
				  <div class="d-grid gap-2">
				  	<input type="submit" class="btn btn-primary btn-block" value="Đặt mật khẩu"/>
				  </div>

				</form>
				
				
				</div>
				<div class="row pt-3 text-center" id="invalid-link">
				<h1 class="border p-3">Liên kết không hợp lệ</h1>
				 <div class="d-grid gap-2">
				  	<a href="/" class="btn btn-primary btn-block">Quay về trang chủ</a>
					<a href="/forget.php" class="btn btn-dark btn-block">Gửi yêu cầu cấp mới</a>
				  </div>
				</div>
				<div class="row pt-3" id="login-link" style="display: none;">
				 <div class="d-grid gap-2">
				  	<a href="/" class="btn btn-primary btn-block">Đăng nhập</a>
				  </div>
				</div>
		
	</main>
	</div>

	<footer class="footer text-muted bg-primary">
		<div class="container">
			&copy; 2022 - Demo
		</div>
	</footer>

	<?php
		if(isset($_GET['confirm']))
		{
			$confirm = $_GET['confirm'];
			$acc = new Account();
			$acc->checkResetPassword($confirm);
			
			if(isset($_POST['passWord']) && isset($_POST['repassWord']))
			{
				$pass = $_POST['passWord'];
				$repass = $_POST['repassWord'];
				
				// Check equal pass;
				if($pass == $repass)
				{
					$acc->updatePassword($email, $pass);
				}
				else
				{
					echo '<script type="text/javascript">';
					echo 'toastr.error(\'Mật khẩu không khớp. Vui lòng nhập lại!\')';
					echo '</script>';
				}
			}
		}
		
	?>

</html>
