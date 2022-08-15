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
	<?php
		// insert.
		if(isset($_POST['submit_insert']))
		{
			$role = $_POST['select_user'];
			$fullname = (isset($_POST['inputFullName'])) ? $_POST['inputFullName'] : 1;
			$email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : 1;
			$username = (isset($_POST['inputUsername'])) ? $_POST['inputUsername'] : 1;
			$password = (isset($_POST['inputPassword'])) ? $_POST['inputPassword'] : 1;
			
			if(strlen($_POST['inputPassword'])  < 1)
			{
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Vui lòng nhập mật khẩu!\')';
				echo '</script>';
			} else {
				// Check add new account.
				if($fullname != 1 && $email !=1 && $username != 1 && $password != 1) 
				{
					// hop le.
					$admin = new Admin();
					if($admin->checkValidateInsert($email, $username))
					{
						// Add acc.
						$admin->insertAccount($fullname, $email, $username, $password, $role);
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
					
			
		}
		
		// delete.
		if(isset($_POST['submit_delete']))
		{
			$user_select = $_POST['inputUserId'];
			
			if ($user_select == -1)
			{
					echo '<script type="text/javascript">';
					echo 'toastr.error(\'Không thể xóa tài khoản không tồn tại!\')';
					echo '</script>';
			}
			else
			{
				// delete account.
				$admin = new Admin();
				$admin->deleteAccount($user_select);
			}
					
			
		}
		
		
		// update.
		if(isset($_POST['submit_update']))
		{
			$user_select = $_POST['inputUserId'];
			$fullname = (isset($_POST['inputFullName'])) ? $_POST['inputFullName'] : 1;
			$email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : 1;
			$username = (isset($_POST['inputUsername'])) ? $_POST['inputUsername'] : 1;
			$password = (isset($_POST['inputPassword'])) ? $_POST['inputPassword'] : 1;
						
			if($user_select > 0)
			{
				// Update admin account.
				if($fullname != 1 && $email !=1 && $username != 1) 
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
			else
			{
				
					echo '<script type="text/javascript">';
					echo 'toastr.error(\'Không thể cập nhật thông tin. Tài khoản không tồn tại!!\')';
					echo '</script>';
			}
			
			
			
		}
	?>
	
	<?php include_once("./part/header.php"); ?>
	<div class="container">
		<main class="pt-3">
		
		
		<div class="row pt-3 pb-3">
		<!--Nhaplieu-->
			<form method="post"> 
			  <fieldset>
				<legend>Danh sách người dùng</legend>
				<div class="form-group row">
				  <label for="select_user" class="col-sm-2 col-form-label">Vai trò</label>
				  <div class="col-sm-10">
					  <select class="form-select" id="select_user" name="select_user" onchange="loadTableList();">
						<option value="0">Tạo tài khoản mới</option>
						<option value="1">User A</option>
						<option value="2">User B</option>
						<option value="3">User C</option>
						<option value="4">User D</option>
						<option value="5">User E</option>		
					  </select>
				  </div>
				</div>
				<!-- Temp Id-->
				<input type="text" class="form-control" id="inputUserId" name="inputUserId" value="-1" hidden />
				
				<div class="form-group row mt-2">
				  <label for="inputFullName" class="col-sm-2 col-form-label">Nhập họ tên</label>
				   <div class="col-sm-10">
						<input type="text" class="form-control" id="inputFullName" name="inputFullName" required placeholder="Nguyễn Văn A">
				   </div>
				  
				</div>
				<div class="form-group row mt-2">
				  <label for="inputEmail" class="col-sm-2 col-form-label">Nhập Email</label>
				  <div class="col-sm-10">
					<input type="email" class="form-control" id="inputEmail" name="inputEmail" required placeholder="avan.nguyen@gmail.com">
				  </div>
				</div>
				<div class="form-group row mt-2">
				  <label for="inputUsername" class="col-sm-2 col-form-label">Nhập tài khoản</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="inputUsername" name="inputUsername" required placeholder="vananguyen">
				  </div>
				</div>
				<div class="form-group row mt-2">
				  <label for="inputPassword" class="col-sm-2 col-form-label">Nhập mật khẩu</label>
				  <div class="col-sm-10">
					<input type="password" class="form-control" id="inputPassword" name="inputPassword"  placeholder="Nhập mật khẩu">
				  </div>
				</div>
				<div class="pt-3 text-end">
					<input type="submit" class="btn btn-primary" name="submit_insert" value="INSERT"/>
					<input type="submit" class="btn btn-primary" name="submit_update" value="UPDATE"/>
					<input type="submit" class="btn btn-danger" name="submit_delete" value="DELETE"/>
					<button type="submit" class="btn btn-primary" id="submit_clear" onClick="clearAction();">CLEAR</button>
				</div>
				
			  </fieldset>
			</form>

				<!--Bangthongtin-->
				 <fieldset>
				<legend>Danh sách hiện có</legend>
				<div  style="overflow-x: auto">
				<table class="table table-hover table-bordered table-sm" cellspacing="0"  width="100%">
				  <thead>
						<tr>
						  <th>STT</th>
						  <th>Name</th>
						  <th>Username</th>
						  <th>Password</th>
						  <th>Status</th>
						</tr>
					  </thead>
					  <tbody id="data-table">
						<tr>
						  <td>1</td>
						  <td>Nixon</td>
						  <td>System Architect</td>
						  <td>Edinburgh</td>
						  <td>
							<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
							  <input type="radio" class="btn-check" name="btnradio_a" id="btnradio_a_1" autocomplete="off" checked="">
							  <label class="btn btn-outline-primary" for="btnradio_a_1">Bật</label>
							  <input type="radio" class="btn-check" name="btnradio_a" id="btnradio_a_2" autocomplete="off" checked="">
							  <label class="btn btn-outline-primary" for="btnradio_a_2">Tắt</label>
							</div>
						  </td>	
						</tr>
						
					  </tbody>
					</table>
					</div>
					</fieldset>
		</div>
		
		
	</main>
	</div>
	
	<script>
		function clearAction()
		{
			document.getElementById("inputFullName").value = "";
			document.getElementById("inputEmail").value = "";
			document.getElementById("inputUsername").value = "";
			document.getElementById("inputPassword").value = "";
		}
		
		loadAccountList();
		
			function loadAccountList()
			{
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("select_user").innerHTML = this.responseText;
						
					}
				};
				xhttp.open("GET", "interface.php?action=roleList", true);
				xhttp.send();
			}
		
			
		
		function getUsername(id)
		{
				document.getElementById("inputUserId").value = id;
				// Get accountInfo
				var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							
							const myArray = this.responseText.split("|");
							
							document.getElementById("inputFullName").value = myArray[0];
							document.getElementById("inputEmail").value = myArray[1];
							document.getElementById("inputUsername").value = myArray[2];
									
						}
					};
					xhttp.open("GET", "interface.php?action=userInfo&userId=" + id, true);
					xhttp.send();
	
		}
		
		loadTableList();
		function loadTableList()
		{
			clearAction();
			document.getElementById("inputUserId").value = -1;
			var e = document.getElementById("select_user");
			var text=e.options[e.selectedIndex].text;	
			var role=e.options[e.selectedIndex].value;
			
				var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							
							document.getElementById("data-table").innerHTML = this.responseText;
									
						}
					};
					xhttp.open("GET", "interface.php?action=accountTableList&role=" + role, true);
					xhttp.send();
		}


		function changeStatus(id, status)
		{
			var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							
							toastr.success('Thay đổi trạng thái tài khoản thành công!')
									
						}
					};
					xhttp.open("GET", "interface.php?action=changeStaus&userId=" + id + "&status=" + status, true);
					xhttp.send();
			
		}
			
	</script>
	<?php include_once("./part/common.javascript.php") ?>
	<footer class="footer text-muted bg-primary">
		<div class="container">
			&copy; 2022 - Demo
		</div>
	</footer>

</html>
