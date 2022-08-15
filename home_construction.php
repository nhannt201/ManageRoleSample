<?php
require_once("config.php");
$account = new Account();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Danh sách công trình</title>
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
			$user_report = $_SESSION['user_id'];
			$inputJobName = (isset($_POST['inputJobName'])) ? $_POST['inputJobName'] : 1;
			$inputDate = (isset($_POST['inputDate'])) ? $_POST['inputDate'] : 1;

			
			if(strlen($_POST['inputJobName'])  < 1)
			{
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Vui lòng nhập tên công trình!\')';
				echo '</script>';
			} else {
				// Check add new account.
				if($inputJobName != 1 && $inputDate !=1) 
				{
					// hop le.
					$construction = new Construction();
					$construction->Insert($inputJobName, $inputDate);

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
			$inputConstructionId = $_POST['inputConstructionId'];
			
			if ($inputConstructionId == -1)
			{
					echo '<script type="text/javascript">';
					echo 'toastr.error(\'Không thể xóa công trình không tồn tại!\')';
					echo '</script>';
			}
			else
			{
				// delete account.
				$construction = new Construction();
				$construction->Delete($inputConstructionId);
			}
					
			
		}
		
		
		// update.
		if(isset($_POST['submit_update']))
		{
			$inputConstructionId = $_POST['inputConstructionId'];
			$inputJobName = (isset($_POST['inputJobName'])) ? $_POST['inputJobName'] : 1;
			$inputDate = (isset($_POST['inputDate'])) ? $_POST['inputDate'] : 1;
						
			if($inputConstructionId > 0)
			{
				// Update admin account.
				if($inputJobName != 1 && $inputDate !=1) 
				{
					// hop le.
					$construction = new Construction();
					$construction->Update($inputConstructionId, $inputJobName, $inputDate);

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
					echo 'toastr.error(\'Không thể cập nhật thông tin. Công trình không tồn tại!!\')';
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
				<legend>Danh sách công trình</legend>

				<!-- Temp Id-->
				<input type="text" class="form-control" id="inputConstructionId" name="inputConstructionId" value="-1" hidden />
				
				<div class="form-group row mt-2">
				  <label for="inputJobName" class="col-sm-2 col-form-label">Tên công trình</label>
				   <div class="col-sm-10">
						<input type="text" class="form-control" id="inputJobName" name="inputJobName" required placeholder="Công trình A">
				   </div>
				  
				</div>

				<div class="form-group row mt-2">
				  <label for="inputDate" class="col-sm-2 col-form-label">Ngày tạo</label>
				  <div class="col-sm-10">
					<input type="date" class="form-control" id="inputDate" name="inputDate" required placeholder="05/06/2022">
				  </div>
				</div>
			
				<div class="pt-3 text-end">
					<?php if(!$account->isAdmin()) { ?>
					<input type="submit" class="btn btn-primary" name="submit_insert" value="INSERT"/>
					<?php } ?>
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
						  <th>Tên công trình</th>
						  <th>Link Google Sheet</th>
						  <th>Người tạo</th>
						</tr>
					  </thead>
					  <tbody id="data-table">
						<tr>
						  <td>1</td>
						  <td>Nixon</td>
						  <td>System Architect</td>
						  <td>Edinburgh</td>
						
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
			document.getElementById("inputJobName").value = "";
			document.getElementById("inputDate").value = "";
		}
		
			
		
		function getConstrcution(id)
		{
				document.getElementById("inputConstructionId").value = id;
				// Get accountInfo
				var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							
							const myArray = this.responseText.split("|");
							
							document.getElementById("inputJobName").value = myArray[0];
							document.getElementById("inputDate").value = myArray[1];
									
						}
					};
					xhttp.open("GET", "interface.php?action=constructionInfo&consId=" + id, true);
					xhttp.send();
	
		}	
		
		loadTableList();
		function loadTableList()
		{
			clearAction();

				var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							
							document.getElementById("data-table").innerHTML = this.responseText;
									
						}
					};
					xhttp.open("GET", "interface.php?action=constructionList", true);
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
