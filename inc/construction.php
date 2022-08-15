<?php
class Construction extends Init
{
	function Insert($name, $date_report)
	{
		// Insert Construction
		$user_report = $_SESSION['user_id'];
		$query = "INSERT INTO construction (name, date_report, user_report) VALUES ('$name','$date_report', '$user_report')";
		if ($this->db->query($query) === TRUE) {
				echo '<script type="text/javascript">';
				echo 'toastr.success(\'Thêm công trình mới thành công!\')';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Có lỗi xảy ra trong quá trình thêm công trình mới. Vui lòng thử lại sao!\')';
				echo '</script>';
		}
	}
	
	function insertContent($cons_id, $date_send_content, $stage_desc, $hard_desc, $suggest, $comment)
	{
		// Insert Construction Content
		$user_report_content = $_SESSION['user_id'];
		$query = "INSERT INTO construction_content (cons_id, date_send_content, stage_desc, hard_desc, suggest, comment, user_report_content) VALUES ('$cons_id','$date_send_content', '$stage_desc', '$hard_desc', '$suggest', '$comment', '$user_report_content')";
		if ($this->db->query($query) === TRUE) {
				echo '<script type="text/javascript">';
				echo 'toastr.success(\'Thêm nội dung công trình mới thành công!\')';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Có lỗi xảy ra trong quá trình thêm nội dung công trình. Vui lòng thử lại sao!\')';
				echo '</script>';
		}
	}
	
	
	function Update($cons_id , $name, $date_report)
	{
		$query = "UPDATE construction SET name='$name', date_report='$date_report' WHERE cons_id ='$cons_id'";
		$rs = $this->db->query($query);
			
		echo '<script type="text/javascript">';
		echo 'toastr.success(\'Đã cập nhật thành công!\')';
		echo '</script>';
	}
	
	function updateContent($content_id, $date_send_content, $stage_desc, $hard_desc, $suggest, $comment)
	{
		// Update Construction Content
		$query = "UPDATE construction_content SET  date_send_content = '$date_send_content', stage_desc = '$stage_desc', hard_desc = '$hard_desc', suggest = '$suggest', comment = '$comment' WHERE content_id  = '$content_id ' ";
		if ($this->db->query($query) === TRUE) {
				echo '<script type="text/javascript">';
				echo 'toastr.success(\'Cập nhật nội dung công trình thành công!\')';
				echo '</script>';
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Có lỗi xảy ra trong quá trình cập nhật nội dung. Vui lòng thử lại sao!\')';
				echo '</script>';
		}
	}
	
	function Delete($cons_id)
	{
		$query = "DELETE FROM construction WHERE cons_id='$cons_id'";
		$rs = $this->db->query($query);
		
		$query_content = "DELETE FROM construction_content WHERE cons_id='$cons_id'";
		$rs_content = $this->db->query($query_content);
		
		echo '<script type="text/javascript">';
		echo 'toastr.success(\'Đã xóa công trình thành công!\')';
		echo '</script>';
	}
	
	function deleteContent($content_id)
	{
		$query = "DELETE FROM construction_content WHERE content_id ='$content_id'";
		$rs = $this->db->query($query);
		
		echo '<script type="text/javascript">';
		echo 'toastr.success(\'Đã xóa nội dung công trình thành công!\')';
		echo '</script>';
	}
	
	function getInfo($cons_id)
	{
		$query = "SELECT * FROM construction  WHERE cons_id = '$cons_id';";
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			$row = $check->fetch_assoc();
			echo $row['name'].'|'.$row['date_report'];
		}
	}
	
	function getInfoContent($content_id)
	{
		$query = "SELECT * FROM construction_content  WHERE content_id = '$content_id';";
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			$row = $check->fetch_assoc();
			echo $row['cons_id'].'|'.$row['date_send_content'].'|'.$row['stage_desc'].'|'.$row['hard_desc'].'|'.$row['suggest'].'|'.$row['comment'];
		}
	}
	
	function getTableInfo($current_user)
	{
		$account = new Account();
		$query = ";";
		if (!$account->isAdmin())
		{
			$query = "SELECT construction.name, construction.user_report, construction.cons_id, account.username
								FROM account						
								INNER JOIN construction ON account.user_id=construction.user_report WHERE construction.user_report = '$current_user';";
		}
		else
		{
			$query = "SELECT construction.name, construction.user_report, construction.cons_id, account.username
								FROM account						
								INNER JOIN construction ON account.user_id=construction.user_report;";
		}
		
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			$int = 0;
			while ($row = $check->fetch_assoc()) {
				
						$int++;
				
							echo '<tr onclick="getConstrcution('.$row['cons_id'].');">
									  <td>'.$int.'</td>
									  <td>'.$row['name'].'</td>
									  <td>Link  Sheet</td>
									  <td>'.$row['username'].'</td>
									</tr>';
					
				
			}
		}
	}
	
	function getTableContentInfo($current_user, $cons_id)
	{
		$query = "";
		if($cons_id == 0)
		{
			$query = "SELECT *
								FROM account						
								INNER JOIN construction
								ON account.user_id=construction.user_report
								INNER JOIN construction_content
								ON construction.user_report = construction_content.user_report_content
								AND construction.cons_id = construction_content.cons_id
								WHERE construction_content.user_report_content = '$current_user';";
		}
		else
		{
			$query = "SELECT *
								FROM account						
								INNER JOIN construction
								ON account.user_id=construction.user_report
								INNER JOIN construction_content
								ON construction.user_report = construction_content.user_report_content
								AND construction.cons_id = construction_content.cons_id
								WHERE construction_content.user_report_content = '$current_user'
								AND construction_content.cons_id = '$cons_id'
								;";
		}

			
		

		
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			$int = 0;
			while ($row = $check->fetch_assoc()) {
				
						$int++;
				
							echo '<tr onclick="getConstrcutionContent('.$row['content_id'].');">
									  <td>'.$int.'</td>
									  <td>'.$row['username'].'</td>
									  <td>'.$row['date_send_content'].'</td>
									  <td>'.$row['name'].'</td>
									  <td>'.$row['stage_desc'].'</td>
									  <td>'.$row['hard_desc'].'</td>
									  <td>'.$row['suggest'].'</td>
									  <td>'.$row['comment'].'</td>
									</tr>';
					
				
			}
		}
	}
	
	function getConstrcutionList()
	{
		$user_report_content = $_SESSION['user_id'];
		
		$query = "select * from construction where user_report = '$user_report_content'";
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			echo '<option value="0">Vui lòng chọn tên công trình</option>';
			while ($row = $check->fetch_assoc()) {
				echo '<option value="'.$row['cons_id'].'">'.$row['name'].'</option>';
			}
		}
	}
}
?>