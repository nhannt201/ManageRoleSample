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
			
		<div class="row pt-3" id="send-request">
				<h1>Khôi phục tài khoản</h1>
			<form class="pt-3"  method="post">
				  <!-- Email input -->
				  <div class="form-outline mb-4">
					<label class="form-label">Nhập email khôi phục</label>
					<input type="email" name="emailAddress" required placeholder="Vd: admin@gmail.com" class="form-control" />
				  </div>


				  <!-- 2 column grid layout for inline styling -->
				  <div class="row mb-4">
					<div class="col d-flex justify-content-center">
					
					</div>

					<!--<div class="col-12">
					  <a href="#!">Quên mật khẩu?</a>
					</div>-->
				  </div>

				  <!-- Submit button -->
				  <div class="d-grid gap-2">
				  	<input type="submit" class="btn btn-primary btn-block" value="Gửi yêu cầu"/>
				  </div>

				</form>
					
				</div>
				
				<div class="row pt-4 text-center" id="send-success" style="display: none;">
				<h1>Đã gửi yêu cầu khôi phục tài khoản</h1>
				<h2>Vui lòng kiểm tra email của bạn!</h2>
				</div>
		
	</main>
	</div>

	<footer class="footer text-muted bg-primary">
		<div class="container">
			&copy; 2022 - Demo
		</div>
	</footer>
		<script src="/lib/jquery/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="/js/site.js?v=BxFAw9RUJ1E4NycpKEjCNDeoSvr4RPHixdBq5wDnkeY"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/n94ifuzvl80pchikopiwgz2esrw8n28dwcywvpejlqrregfp/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	
	<?php
		if(isset($_POST['emailAddress']))
		{
			$mail = $_POST['emailAddress'];
			$acc = new Account();
			$acc->createResetPassLink($mail);
		}
	?>

</html>
