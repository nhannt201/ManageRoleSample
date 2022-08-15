<?php
require_once("config.php");
$account = new Account();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Nhập nội dung</title>
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
			$inputConstructId = (isset($_POST['select_construct'])) ? $_POST['select_construct'] : -1;
			$inputDateSend = (isset($_POST['inputDateSend'])) ? $_POST['inputDateSend'] : 1;
			$inputStage = (isset($_POST['inputStage'])) ? $_POST['inputStage'] : 1;
			$inputHard = (isset($_POST['inputHard'])) ? $_POST['inputHard'] : 1;
			$inputSuggest = (isset($_POST['inputSuggest'])) ? $_POST['inputSuggest'] : 1;
			$inputComment = (isset($_POST['inputComment'])) ? $_POST['inputComment'] : 1;

			
			if(strlen($inputStage)  < 1 || strlen($inputHard)  < 1 || strlen($inputSuggest)  < 1 || strlen($inputComment)  < 1 || $inputConstructId  < 1)
			{
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Vui lòng nhập đầy đủ các nội dung yêu cầu!\')';
				echo '</script>';
			} else {
				// Check add new.
				if($inputDateSend != 1 && $inputStage !=1 && $inputHard !=1 && $inputSuggest !=1 && $inputComment !=1) 
				{
					// hop le.
					$construction = new Construction();
					$construction->insertContent($inputConstructId, $inputDateSend, $inputStage, $inputHard, $inputSuggest, $inputComment);

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
			$inputConstructionContentId = $_POST['inputConstructionContentId'];
			
			if ($inputConstructionContentId == -1)
			{
					echo '<script type="text/javascript">';
					echo 'toastr.error(\'Không thể xóa công trình không tồn tại!\')';
					echo '</script>';
			}
			else
			{
				// delete account.
				$construction = new Construction();
				$construction->deleteContent($inputConstructionContentId);
			}
					
			
		}
		
		
		// update.
		if(isset($_POST['submit_update']))
		{
			$inputConstructionContentId = (isset($_POST['inputConstructionContentId'])) ? $_POST['inputConstructionContentId'] : -1;
			$inputDateSend = (isset($_POST['inputDateSend'])) ? $_POST['inputDateSend'] : 1;
			$inputStage = (isset($_POST['inputStage'])) ? $_POST['inputStage'] : 1;
			$inputHard = (isset($_POST['inputHard'])) ? $_POST['inputHard'] : 1;
			$inputSuggest = (isset($_POST['inputSuggest'])) ? $_POST['inputSuggest'] : 1;
			$inputComment = (isset($_POST['inputComment'])) ? $_POST['inputComment'] : 1;
						
			if($inputConstructionContentId > 0)
			{
				// Update.
				if($inputDateSend != 1 && $inputStage !=1 && $inputHard !=1 && $inputSuggest !=1 && $inputComment !=1) 
				{
					// hop le.
					$construction = new Construction();
					$construction->updateContent($inputConstructionContentId, $inputDateSend, $inputStage, $inputHard, $inputSuggest, $inputComment);

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
					echo 'toastr.error(\'Không thể cập nhật thông tin. Nội dung công trình không tồn tại!!\')';
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
				<legend>Nhập nội dung</legend>

				<div class="form-group row">
				  <label for="select_construct" class="col-sm-2 col-form-label">Chọn công trình</label>
				  <div class="col-sm-10">
					  <select class="form-select" id="select_construct" name="select_construct" onchange="loadTableList();">
						<option value="0">Chọn công trình</option>
						<option value="1">Công trình A</option>	
					  </select>
				  </div>
				</div>
				
				<!-- Temp Id-->
				<input type="text" class="form-control" id="inputConstructionContentId" name="inputConstructionContentId" value="-1" hidden />
				
				<div class="form-group row mt-2">
				  <label for="inputDateSend" class="col-sm-2 col-form-label">Ngày gửi</label>
				  <div class="col-sm-10">
					<input type="date" class="form-control" id="inputDateSend" name="inputDateSend" required placeholder="05/06/2022" >
				  </div>
				</div>
				
				<div class="form-group row mt-2">
				  <label for="inputStage" class="col-sm-2 col-form-label">Tiến độ thực hiện</label>
				   <div class="col-sm-10">
						<textarea  class="form-control" rows="3" id="inputStage" name="inputStage" required></textarea>
				   </div>	  
				</div>
				
				<div class="form-group row mt-2">
				  <label for="inputHard" class="col-sm-2 col-form-label">Khó khăn vướng mắc</label>
				   <div class="col-sm-10">
						<textarea  class="form-control" rows="3" id="inputHard" name="inputHard" required></textarea>
				   </div>	  
				</div>
				
				<div class="form-group row mt-2">
				  <label for="inputSuggest" class="col-sm-2 col-form-label">Ý khiến chỉ đạo</label>
				   <div class="col-sm-10">
						<textarea  class="form-control" rows="3" id="inputSuggest" name="inputSuggest" required></textarea>
				   </div>	  
				</div>
				
				<div class="form-group row mt-2">
				  <label for="inputComment" class="col-sm-2 col-form-label">Ghi chú</label>
				   <div class="col-sm-10">
						<textarea  class="form-control" rows="3" id="inputComment" name="inputComment" ></textarea>
				   </div>	  
				</div>
				
				

			
				<div class="pt-3 text-end">
					<input type="submit" class="btn btn-primary" name="submit_insert" id="submit_insert" value="INSERT"/>
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
						  <th>Người báo cáo</th>
						  <th>Ngày gửi</th>
						  <th>Tên công trình</th>
						  <th>Tiến độ thực hiện	</th>
						  <th>Khó khăn vướng mắc	</th>
						  <th>Ý khiến chỉ đạo</th>
						  <th>Ghi chú</th>
						</tr>
					  </thead>
					  <tbody id="data-table">
						<tr>
						  <td>1</td>
						  <td>Nixon</td>
						  <td>System Architect</td>
						  <td>Edinburgh</td>
						  <td>Edinburgh</td>
						  <td>Edinburgh</td>
						  <td>Edinburgh</td>
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
			document.getElementById("inputDateSend").value = "";
			document.getElementById("inputStage").value = "";
			document.getElementById("inputHard").value = "";
			document.getElementById("inputSuggest").value = "";
			document.getElementById("inputComment").value = "";
			loadDateToday();
		}
		
			loadConstructList();
		
			function loadConstructList()
			{
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("select_construct").innerHTML = this.responseText;
						
					}
				};
				xhttp.open("GET", "interface.php?action=constructList", true);
				xhttp.send();
			}
			
		
		function getConstrcutionContent(id)
		{
				document.getElementById("inputConstructionContentId").value = id;
				document.getElementById("submit_insert").style.display = "none";
				document.getElementById("select_construct").readOnly = true;
				
				// Get accountInfo
				var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							
							const myArray = this.responseText.split("|");
							
			
							var options = document.getElementById("select_construct").options;
							for (var i = 0; i < options.length; i++) {
							  if (options[i].value == myArray[0]) {
								options[i].selected = true;
								break;
							  }
							}

							document.getElementById("inputDateSend").value = myArray[1];
							document.getElementById("inputStage").value = myArray[2];
							document.getElementById("inputHard").value = myArray[3];
							document.getElementById("inputSuggest").value = myArray[4];
							document.getElementById("inputComment").value = myArray[5];

									
						}
					};
					xhttp.open("GET", "interface.php?action=constructionContentInfo&contentId=" + id, true);
					xhttp.send();
	
		}	
		
		loadTableList();
		function loadTableList()
		{
			clearAction();
			document.getElementById("inputConstructionContentId").value = -1;
			var e = document.getElementById("select_construct");
			var text=e.options[e.selectedIndex].text;	
			var consId=e.options[e.selectedIndex].value;
			
				var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							
							document.getElementById("data-table").innerHTML = this.responseText;
									
						}
					};
					xhttp.open("GET", "interface.php?action=constructionContentList&consId=" + consId, true);
					xhttp.send();
		}

		loadDateToday();
		function loadDateToday()
		{
			var today = new Date();
			var dd = String(today.getDate()).padStart(2, '0');
			var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			var yyyy = today.getFullYear();
			
			today = yyyy + '-' + mm + '-' + dd ;

			document.getElementById("inputDateSend").value = today;
		}
	</script>
	
	<?php include_once("./part/common.javascript.php") ?>
	
	<footer class="footer text-muted bg-primary">
		<div class="container">
			&copy; 2022 - Demo
		</div>
	</footer>

</html>
