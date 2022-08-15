<?php
require_once("config.php");
$account = new Account();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>My Account</title>
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
			<?php
		if(isset($_POST['submit_update_acc']))
		{
			$user_select = $_POST['select_user'];
			$fullname = (isset($_POST['inputFullName'])) ? $_POST['inputFullName'] : 1;
			$email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : 1;
			$username = (isset($_POST['inputUsername'])) ? $_POST['inputUsername'] : 1;
			$password = (isset($_POST['inputPassword'])) ? $_POST['inputPassword'] : 1;
			
			// Check add new account.
			if($fullname != 1 && $email !=1) 
			{
				// hop le.
				$admin = new Admin();
				if($admin->checkValidate($user_select, $email, $username))
				{
					// update acc.
					$admin->updateAccount($user_select, $fullname, $email, $username, $password);
				}

			}
			else
			{
				// invalidate.
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Các trường đã nhập không hợp lệ, vui lòng nhập đầy đủ và chính xác!\')';
				echo '</script>';
			}
			
			
		}
		
	?>
		<div class="row pt-3 pb-3">
		<!--Nhaplieu-->
			<form method="post"> 
			  <fieldset>
				<legend>Thông tin tài khoản</legend>
				<div class="form-group row">
				  <!--<label for="select_user" class="col-sm-2 col-form-label">Select user</label>-->
				  <div class="col-sm-10">
				  <select class="form-select" id="select_user" hidden readonly name="select_user">
					<option value="<?=$_SESSION['user_id']?>"><?=$_SESSION['username']?></option>	
				  </select>
				  </div>
				</div>

				<div class="form-group row mt-2">
				  <label for="inputFullName" class="col-sm-2 col-form-label">Nhập họ tên</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="inputFullName" name="inputFullName" readonly value="<?=$_SESSION['fullname']?>" placeholder="Nguyễn Văn A">
					</div>
				</div>
				<div class="form-group row mt-2">
				  <label for="inputEmail" class="col-sm-2 col-form-label">Nhập Email</label>
				  <div class="col-sm-10">
					<input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?=$_SESSION['email']?>" required placeholder="avan.nguyen@gmail.com">
					</div>
				</div>
				<div class="form-group row mt-2">
				  <label for="inputUsername" class="col-sm-2 col-form-label">Nhập tài khoản</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="inputUsername"  name="inputUsername" value="<?=$_SESSION['username']?>" required placeholder="vananguyen">
					</div>
				</div>
				<div class="form-group row mt-2">
				  <label for="inputPassword" class="col-sm-2 col-form-label">Nhập mật khẩu</label>
				  <div class="col-sm-10">
					<input type="password" class="form-control" id="inputPassword" name="inputPassword" value=""  placeholder="Nhập mật khẩu">
					</div>
				</div>
				<div class="pt-3 text-end">
					<input type="submit" class="btn btn-primary" name="submit_update_acc" value="UPDATE"/>
					<button type="submit" class="btn btn-primary" id="submit_clear" onClick="clearAction();">CLEAR</button>
				</div>
				
			  </fieldset>
			</form>

				
		</div>
		
		
	</main>
	</div>

	<footer class="footer text-muted bg-primary">
		<div class="container">
			&copy; 2022 - Demo
		</div>
	</footer>
	
	<script>
		function clearAction()
		{
			document.getElementById("inputEmail").value = "";
			document.getElementById("inputUsername").value = "";
			document.getElementById("inputPassword").value = "";
		}
	</script>
<?php include_once("./part/common.javascript.php") ?>
</html>
