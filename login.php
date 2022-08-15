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
	<script src="https://cdn.tiny.cloud/1/n94ifuzvl80pchikopiwgz2esrw8n28dwcywvpejlqrregfp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
			


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
			
		<div class="row pt-3">
				<h1>Trang đăng nhập</h1>
			<form class="pt-3" method="post" >
				  <!-- Email input -->
				  <div class="form-outline mb-4">
					<label class="form-label">Tên người dùng</label>
					<input type="text" name="userName" placeholder="Vd: admin, quantri, v.v." class="form-control" />
				  </div>

				  <!-- Password input -->
				  <div class="form-outline mb-4">
					<label class="form-label">Mật khẩu</label>
					<input type="password" name="passWord"   placeholder="Nhập mật khẩu" class="form-control" />
				  </div>

				  <!-- 2 column grid layout for inline styling -->
				  <div class="row mb-4">
					<div class="col d-flex ">
					  <!-- Checkbox -->
						  <div class="form-check">
							<input class="form-check-input" name="remeberCheck" type="checkbox" value="remember_true" id="form2Example31" />
							<label class="form-check-label" for="form2Example31"> Ghi nhớ đăng nhập </label>
						  </div>
					</div>

					<!--<div class="col-12">
					  <a href="#!">Quên mật khẩu?</a>
					</div>-->
				  </div>

	
					
					
					
				  <!-- Submit button -->
				  <div class="d-grid gap-2">
				  	<input type="submit" class="btn btn-primary btn-block" name="submitLogin" value="Đăng nhập"/>
					  <a href="forget.php" class="btn btn-dark btn-block">Quên mật khẩu?</a>
				  </div>

				</form>
				
				
				</div>
		
	</main>
	</div>
	
	<footer class="footer text-muted bg-primary">
		<div class="container">
			&copy; 2022 - Demo
		</div>
	</footer>
	
	<?php
	if(isset($_POST['submitLogin']))
	{
		if(isset($_POST['userName']) && isset($_POST['passWord']))
		{
			$user = trim($_POST['userName']);
			$pass = trim($_POST['passWord']);
			$remember = isset($_POST['remeberCheck']);
			
			$account = new Account();
			$account->Login($user, $pass, $remember);
			
			
		}
	}
	?>
	

</html>
