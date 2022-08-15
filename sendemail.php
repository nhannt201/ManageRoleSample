<?php
require_once("config.php");
$mail = new Email();
$mail->sendEmail("account@trungnhan.name.vn","Trung Tâm Tài Khoản",
				"trungnhan21.12@gmail.com", "Trung Nhẫn Nguyễn",
				"Yêu cầu đặt lại mật khẩu tài khoản - Trung Nhẫn Nguyễn", 
				"Xin chào Trung Nhẫn Nguyễn,<br>Bạn đã yêu cầu đặt lại mật khẩu của mình. Vui lòng click vào link bên dưới để đặt lại mật khẩu của bạn:<br>"
				."<a target='_blank' href='https://abc.xyz/sdsđsf/sdfdsf/sdfdsf'>ĐẶT LẠI MẬT KHẨU</a>"
				."<br><b><i>TRUNG TÂM QUẢN LÍ TÀI KHOẢN</i></b>"
				,
				"");
?>