<?php
class Admin extends Init
{
	function deleteAccount($userId)
	{
		$query = "DELETE FROM account WHERE user_id='$userId'";
		$rs = $this->db->query($query);
		
		$query_info = "DELETE FROM information WHERE user_id='$userId'";
		$rs_info = $this->db->query($query_info);
		
			echo '<script type="text/javascript">';
			echo 'toastr.success(\'Đã xóa tài khoản thành công!\')';
			echo '</script>';
	}
	
	function updateAccount($userId, $fullname, $email, $username, $password)
	{
		// Need check validate before.
		
		// Update account.
		
		// Change password.
		if(strlen(trim($password)) > 1)
		{
			$passwordMd5 = md5($password);
			$query = "UPDATE account SET password='$passwordMd5' WHERE user_id='$userId'";
			$rs = $this->db->query($query);
			
			echo '<script type="text/javascript">';
			echo 'toastr.success(\'Đã thay đổi mật khẩu mới!\')';
			echo '</script>';
		}
		
		if( ($username != $_SESSION['username']))
		{
			$passwordMd5 = md5($password);
			$query = "UPDATE account SET username='$username' WHERE user_id='$userId'";
			$rs = $this->db->query($query);
			
			$_SESSION['username'] = $username;

			echo '<script type="text/javascript">';
			echo 'toastr.success(\'Thay đổi tên tài khoản thành công!\')';
			echo '</script>';
		}
		
		// Update information.
		// Change information.
		if(($email != $_SESSION['email']) || ($fullname != $_SESSION['fullname'])) 
		{
			$name =  addslashes($fullname);
			$query_info = "UPDATE information SET fullname='$name', email='$email' WHERE user_id='$userId'";	
		
			$rs_info = $this->db->query($query_info);
			
			$_SESSION['email'] = $email;
			$_SESSION['fullname'] = $fullname;
		
		}
		
			echo '<script type="text/javascript">';
			echo 'toastr.success(\'Cập nhật thông tin tài khoản thành công!\')';
			echo '</script>';
			
			// echo "<meta http-equiv='refresh' content='1'>";

		
	}
	
	function insertAccount($fullname, $email, $username, $password, $role)
	{
		// Insert account
		$passwordMd5 = md5($password);
		$query = "INSERT INTO account (username, password) VALUES ('$username','$passwordMd5')";
		if ($this->db->query($query) === TRUE) {
			$user_id = $this->db->insert_id;
			$name = addslashes($fullname);
			$query_info = "INSERT INTO information (user_id, fullname, email, status, role) VALUES ('$user_id','$name', '$email', 0, '$role')";
			if ($this->db->query($query_info) === TRUE) {
				echo '<script type="text/javascript">';
				echo 'toastr.success(\'Thêm tài khoản mới thành công!\')';
				echo '</script>';
			}
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Có lỗi xảy ra trong quá trình thêm tài khoản. Vui lòng thử lại sao!\')';
				echo '</script>';
		}
		
	}
	
	function changeStatusAccount($user_id, $status)
	{
		$query_info = "UPDATE information SET status='$status' WHERE user_id='$user_id'";	
			$check = $this->db->query($query_info);
	}
	
	function checkValidate($user_select, $email, $username)
	{
		// Get current email and username.
		$bool = true;
		
		// Find username and email if it exists.
		$query = "select * from account where username='$username' ";
		$check = $this->db->query($query);
		
		// Check account exists.
			if($check->num_rows == 1)
			{
				$row = $check->fetch_assoc();
				// My username not change.
				if(isset($_SESSION['username'])) {
					if($_SESSION['username'] == $username || $row['user_id'] == $user_select)
					{
						// This is my username.
						$bool = true;		
						
					}
					else
					{
						// username exists.
						echo '<script type="text/javascript">';
						echo 'toastr.error(\'Tên tài khoản đã tồn tại, vui lòng chọn một tên tài khoản khác!!\')';
						echo '</script>';
						$bool = false;
					}
				}

			}
			
		$query_info = "select * from information where email='$email' ";
		$checkmail = $this->db->query($query_info);
		
		// Check email exists.
			if($checkmail->num_rows == 1)
			{
				$rowmail = $checkmail->fetch_assoc();
				// My email not change.
				if(isset($_SESSION['email'])) {
					if($_SESSION['email'] == $email || $rowmail['user_id'] == $user_select)
					{
						// This is my email.
						$bool = true;
					}
					else
					{
						// Email exists.
						echo '<script type="text/javascript">';
						echo 'toastr.error(\'Địa chỉ email đã tồn tại, vui lòng chọn một địa chỉ email khác!!\')';
						echo '</script>';
						$bool = false;
					}
				}
				
			}
			
			// Validate.
			return $bool;
	}
	
	function checkValidateInsert($email, $username)
	{
		// Get current email and username.
		$bool = true;
		
		// Find username and email if it exists.
		$query = "select username from account where username='$username' ";
		$check = $this->db->query($query);
		
		// Check account exists.
			if($check->num_rows == 1)
			{
				// My username not change.
				if(isset($_SESSION['username'])) {
					
						// username exists.
						echo '<script type="text/javascript">';
						echo 'toastr.error(\'Tên tài khoản đã tồn tại, vui lòng chọn một tên tài khoản khác!!\')';
						echo '</script>';
						$bool = false;
					
				}

			}
			
		$query_info = "select * from information where email='$email' ";
		$checkmail = $this->db->query($query_info);
		
		// Check email exists.
			if($checkmail->num_rows == 1)
			{
				// My email not change.
				if(isset($_SESSION['email'])) {
					
						// Email exists.
						echo '<script type="text/javascript">';
						echo 'toastr.error(\'Địa chỉ email đã tồn tại, vui lòng chọn một địa chỉ email khác!!\')';
						echo '</script>';
						$bool = false;
					
				}
				
			}
			
			// Validate.
			return $bool;
	}
}
?>