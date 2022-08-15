<?php
class Account extends Init {
	
	function Login($user, $pass, $remember = false)
	{
		if(!empty($user) && !empty($pass))
		{
			$pass_encode = md5($pass);
			$query = "select * from account where username='$user' and password='$pass_encode'";
			$check = $this->db->query($query);
			
			// Check account exists.
			if($check->num_rows == 1)
			{
				$row = $check->fetch_assoc();
				$user_id = $row['user_id'];
				
				// Get account information.
				$queryInfo = "select * from information where user_id='$user_id'";
				$checkInfo = $this->db->query($queryInfo);
				if($checkInfo->num_rows == 1)
				{
					$rows_info = $checkInfo->fetch_assoc();

					if($rows_info['status'] == 0 && $rows_info['role'] == 1)
					{
						echo '<script type="text/javascript">';
						echo 'toastr.error(\'Tài khoản bạn đã bị vô hiệu hóa!!\')';
						echo '</script>';
					} else {
						// Add user to session.
						if (!isset($_SESSION['remember_session']))
						{
							// If don't check remember login.
							if($remember == false)
							{
								// Session in a hour.
								$hour = date('H');
								$_SESSION['remember_session'] = $user_id."|".$hour;
							} 
							else
							{
								// Remember long time.
								$_SESSION['remember_session'] = $user_id."|longtime";
							}
							
						}
						// Add user information to session.
						$_SESSION['info_id'] = $rows_info['info_id'];
						$_SESSION['fullname'] = $rows_info['fullname'];
						$_SESSION['email'] = $rows_info['email'];
						$_SESSION['role'] = $rows_info['role'];
						$_SESSION['status'] = $rows_info['status'];
						$_SESSION['username'] = $user;
						$_SESSION['user_id'] = $user_id;
						
						header('location: /');
						
					}
	
					
					
					
				}
				
				
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'toastr.error(\'Đăng nhập không hợp lệ. Vui lòng thử lại sao!!\')';
				echo '</script>';
			}
		}
		else
		{
				echo '<script type="text/javascript">';
				echo 'toastr.warning(\'Vui lòng nhập đầy đủ các trường yêu cầu.\')';
				echo '</script>';
		}
	}
	
	function getLoginSession()
	{
		if (!isset($_SESSION['remember_session']))
		{
			header('location: /');
		}
		else
		{			
				$getRemeber = explode("|", $_SESSION['remember_session'])[1];
				$hour = date('H');
				// Remeber false ~ 1 hour
				if($getRemeber != $hour)
				{
					header('location: interface.php?action=logout');
				}
				else
				{
					// Remember long time.
					
					if(!isset($_SESSION['login_msg']))
					{
						echo '<script type="text/javascript">';
						echo 'toastr.success(\'Đăng nhập thành công.\')';
						echo '</script>';
						$_SESSION['login_msg'] = true;
					}
					
					// Redict login.
					// Get information.
					if(isset($_SESSION['info_id']) && isset($_SESSION['fullname']) 
						&& isset($_SESSION['email']) && isset($_SESSION['role']) && isset($_SESSION['status']))
						{
							// Full information.

						}
				}
				
			
		}
	}
	
	function Logout() 
	{
		 session_destroy();
		 header('location: /');
	}
	
	function isAdmin()
	{
		if(isset($_SESSION['remember_session']) && isset($_SESSION['role']))
		{
			$int_role = $_SESSION['role'];
			if($int_role == 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
	}
	
	function loadPage()
	{
		if(isset($_SESSION['remember_session']) && isset($_SESSION['role']))
		{
			$int_role = $_SESSION['role'];
			
			// Set page default.
			$this->setPageRedict($int_role);
					
		}
		else
		{
			// Login.
			require_once("login.php");
		}
	}
	
	function setPageRedict($role)
	{

		$role_setPage = isset($_SESSION['session_page']) ? $_SESSION['session_page'] : "home";
					
		switch($role_setPage)
		{
			case "jobPage":
				// Danh sach cong viec.
				require_once("home_construction.php");
				break;
			case "myAccount":
				require_once("home_account.php");
				break;
			case "jobPageContent":
				require_once("home_entercontent.php");
				break;
			case "manageUserPage":
			// Check role page.
				switch($role)
				{
					case 0:
						// Admin.
						require_once("home_manageuser.php");
						break;
					default:
						// Normal.
						require_once("home.php");
						break;
				}
				break;
			default:
				// Normal.
				require_once("home.php");		
				break;
		}
					
	}
	
	function createResetPassLink($email)
	{
		$query = "select * from information where email='$email'";
		$check = $this->db->query($query);
		if($check->num_rows == 1)
		{
			$row = $check->fetch_assoc();
			$user_id = $row['user_id'];
			$name = $row['fullname'];
			// Get password md5.
			$query_acc = "select * from account where user_id='$user_id'";
			$check_acc = $this->db->query($query_acc);
			if($check_acc->num_rows == 1)
			{
				$row_acc = $check_acc->fetch_assoc();
				$link = base64_encode(base64_encode($email."|".md5($row_acc['password'])."|".date('H')).base64_encode("TH-TrueMilk"));
				$current_domain = $_SERVER['HTTP_HOST'];
				$mail = new Email();
				$mail->sendEmail("Trung Tâm Tài Khoản",
				$email, $name,
				"Yêu cầu đặt lại mật khẩu tài khoản - ".$name, 
				"Xin chào <b>".$name."</b>,<br>Bạn đã yêu cầu đặt lại mật khẩu của mình. Vui lòng click vào link bên dưới để đặt lại mật khẩu của bạn:<br>"
				."<a target='_blank' href='".$current_domain."/resetpassword.php?confirm=$link'>ĐẶT LẠI MẬT KHẨU</a>"
				."<br><hr>Liên kết trên có hiệu lực đến đầu giờ tiếp theo."
				."<br><b><i>TRUNG TÂM QUẢN LÍ TÀI KHOẢN</i></b>"
				,
				"");
				
			}
		}
				echo '<script type="text/javascript">';
				echo 'toastr.success(\'Yêu cầu của bạn đã được thực hiện!\')';
				echo '</script>';
				echo '<script type="text/javascript">';
				echo 'toastr.success(\'Bạn sẽ nhận được yêu cầu đặt lại mật khẩu nếu tài khoản tồn tại trên hệ thống.\')';
				echo '</script>';
				
				// hiđen requét component;
				
				echo '<script>';
				echo 'document.getElementById("send-request").style.display = "none";';
				echo 'document.getElementById("send-success").style.display = "block";';
				echo '</script>';
	}
	
	function getEmailFromConfirm($confirm)
	{
		$keylock = base64_encode("TH-TrueMilk");
		$decode = base64_decode(str_replace($keylock, "", base64_decode($confirm)));
		$getvalue = explode("|", $decode);
		// Return email address.
		return $getvalue[0];
	}
	
	function checkResetPassword($confirm)
	{
		
		$keylock = base64_encode("TH-TrueMilk");
		$decode = base64_decode(str_replace($keylock, "", base64_decode($confirm)));
		$getvalue = explode("|", $decode);
		$email = $getvalue[0];
		// Check email.
		$query = "select * from information where email='$email'";
		$check = $this->db->query($query);
		if($check->num_rows == 1)
		{
			$row = $check->fetch_assoc();
			$user_id = $row['user_id'];
			// Get password md5.
			$query_acc = "select * from account where user_id='$user_id'";
			$check_acc = $this->db->query($query_acc);
			if($check_acc->num_rows == 1)
			{
				$row_acc = $check_acc->fetch_assoc();
				$md5pass = md5($row_acc['password']);
				$currentHour = date('H');
				// Check valid url;
				if(count($getvalue) == 3) {
					if($currentHour == $getvalue[2])
					{
						// check password correct.
						if($getvalue[1] == $md5pass)
						{
								echo '<script>';
								echo 'document.getElementById("valid-link").style.display = "block";';
								echo 'document.getElementById("invalid-link").style.display = "none";';
								echo '</script>';
						}
						else
						{
							echo '<script type="text/javascript">';
							echo 'toastr.warning(\'Liên kết không còn hiệu lực!\')';
							echo '</script>';
								echo '<script>';
								echo 'document.getElementById("valid-link").style.display = "none";';
								echo 'document.getElementById("invalid-link").style.display = "block";';
								echo '</script>';
						}
					}
					else
					{
						echo '<script type="text/javascript">';
						echo 'toastr.warning(\'Liên kết không còn hiệu lực!\')';
						echo '</script>';
							echo '<script>';
							echo 'document.getElementById("valid-link").style.display = "none";';
							echo 'document.getElementById("invalid-link").style.display = "block";';
							echo '</script>';
					}
				}
				
				
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'toastr.warning(\'Liên kết không còn hiệu lực!\')';
				echo '</script>';
					echo '<script>';
					echo 'document.getElementById("valid-link").style.display = "none";';
					echo 'document.getElementById("invalid-link").style.display = "block";';
					echo '</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'toastr.error(\'Liên kết không họp lệ!\')';
			echo '</script>';
				echo '<script>';
				echo 'document.getElementById("valid-link").style.display = "none";';
				echo 'document.getElementById("invalid-link").style.display = "block";';
				echo '</script>';
		}
		
	}
	
	function updatePassword($email, $password)
	{
			$query_get_username = "SELECT account.username, information.email
								FROM account
								INNER JOIN information ON account.user_id=information.user_id WHERE information.email='$email';";
			$check = $this->db->query($query_get_username);
			
			// Get user from email.
			if($check->num_rows == 1)
			{
				$row = $check->fetch_assoc();
				$username = $row['username'];
				$encode_pass = md5($password);
				$query = "UPDATE account SET password='$encode_pass' WHERE username='$username'";
				$rs = $this->db->query($query);
			}
			
			echo '<script type="text/javascript">';
			echo 'toastr.success(\'Cập nhật mật khẩu hoàn tất!\')';
			echo '</script>';
			
			echo '<script>';
				echo 'document.getElementById("valid-link").style.display = "none";';
				echo 'document.getElementById("invalid-link").style.display = "none";';
				echo 'document.getElementById("login-link").style.display = "block";';
				echo '</script>';
		
	}
	
	function getAccountList()
	{
		$query = "select * from account";
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			echo '<option value="0">Tạo tài khoản mới</option>';
			while ($row = $check->fetch_assoc()) {
				echo '<option value="'.$row['user_id'].'">'.$row['username'].'</option>';
			}
		}
	}
	
	function getRoletList()
	{
		$query = "select * from role";
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			while ($row = $check->fetch_assoc()) {
				echo '<option value="'.$row['role'].'">'.$row['name'].'</option>';
			}
		}
	}
	
	function getAccountInfo($userid)
	{
		$query = "SELECT account.username, account.user_id, information.fullname, information.email
								FROM account						
								INNER JOIN information ON account.user_id=information.user_id WHERE information.user_id='$userid';";
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			$row = $check->fetch_assoc();
			echo $row['fullname'].'|'.$row['email'].'|'.$row['username'];
		}
	}
	
	function getAccountTableInfo($role)
	{
		$query = "SELECT account.username, account.user_id, information.fullname, information.status, information.role
								FROM account						
								INNER JOIN information ON account.user_id=information.user_id WHERE information.role='$role';";
		$check = $this->db->query($query);
		
		if($check->num_rows > 0)
		{
			$int = 0;
			while ($row = $check->fetch_assoc()) {
				
						$int++;
				
							echo '<tr onclick="getUsername('.$row['user_id'].');">
									  <td>'.$int.'</td>
									  <td>'.$row['fullname'].'</td>
									  <td>'.$row['username'].'</td>
									  <td>xxxx</td>
									  <td>
										<div class="btn-group" role="group" aria-label="Action Status List">';
										
										// Check radio.
										
										if ($row['status'] == 0)
										{
											echo '		  <input type="radio" class="btn-check" name="btnradio_'.$row['user_id'].'" id="btnradio_a_'.$row['user_id'].'"  onclick="changeStatus('.$row['user_id'].', 1);" >';				
											echo '		  <label class="btn btn-outline-primary" for="btnradio_a_'.$row['user_id'].'">Bật</label>';
											echo '		  <input type="radio" class="btn-check" name="btnradio_'.$row['user_id'].'" id="btnradio_b_'.$row['user_id'].'"  onclick="changeStatus('.$row['user_id'].', 0);" checked>';								
											echo '		  <label class="btn btn-outline-primary" for="btnradio_b_'.$row['user_id'].'">Tắt</label>';
										}
										
										else
										{
											echo '		  <input type="radio" class="btn-check" name="btnradio_'.$row['user_id'].'" id="btnradio_a_'.$row['user_id'].'"  onclick="changeStatus('.$row['user_id'].', 1);" checked>';				
											echo '		  <label class="btn btn-outline-primary" for="btnradio_a_'.$row['user_id'].'">Bật</label>';
											echo '		  <input type="radio" class="btn-check" name="btnradio_'.$row['user_id'].'" id="btnradio_b_'.$row['user_id'].'"  onclick="changeStatus('.$row['user_id'].', 0);" >';								
											echo '		  <label class="btn btn-outline-primary" for="btnradio_b_'.$row['user_id'].'">Tắt</label>';
										}
								
								echo '	</div>
									  </td>	
									</tr>';
					
				
			}
		}
	}
}