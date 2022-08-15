<?php
require_once("config.php");
$account = new Account();
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
	<?php	
		$account->getLoginSession();
	?>
	<?php include_once("./part/header.php"); ?>
	<div class="container">
		<main class="pt-3">
			
		<div class="row pt-3 pb-3">
		
			<div class="row pt-3 text-center">
				<h1 class="border p-3">WELCOME TO HOME PAGE!</h1>
			
			</div>
				
		</div>
		
		
	</main>
	</div>

	<footer class="footer text-muted bg-primary">
		<div class="container">
			&copy; 2022 - Demo
		</div>
	</footer>

<?php include_once("./part/common.javascript.php") ?>
</html>
