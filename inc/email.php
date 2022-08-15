<?php
			//Import PHPMailer classes into the global namespace
		//These must be at the top of your script, not inside a function
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;
		//Load Composer's autoloader
		require './vendor/autoload.php';
		
class Email extends Init
{
	
	function sendEmail($fromName, $emailTo, $toName, $subject, $body, $altBody)
	{
	
	 $smtp_host = "smtp.sendgrid.net";
	 $smtp_username = "apikey";
	 $smtp_password = "";
	 $emailFrom = "notify@yourogranize.com";
		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = $smtp_host;                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = $smtp_username;                     //SMTP username
			$mail->Password   = $smtp_password;                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;//ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 587;//465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom($emailFrom, $fromName);
			$mail->addAddress($emailTo, $toName);     //Add a recipient
			//$mail->addAddress('ellen@example.com');               //Name is optional
		   // $mail->addReplyTo('trungnhan21.12@gmail.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//Attachments
			//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			//Content
			$mail->CharSet = 'UTF-8';
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $body;
			$mail->AltBody = $altBody;

			$mail->send();
			//echo 'Message has been sent';
			//return true;
		} catch (Exception $e) {
			//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			//return false;
		}
	}
	

}

?>