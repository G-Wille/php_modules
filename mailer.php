<?php

/**
* Mailer
*
* @copyright   Copyright (c) 2018 Gert-Jan Wille (http://www.gert-janwille.com)
* @version     v1.0.0
* @author      Gert-Jan Wille <hello@gert-janwille.com>
*
*/

require WWW_ROOT . '/libs/' . DS . 'phpmailer/PHPMailerAutoload.php';
require WWW_ROOT . '/libs/' . DS . 'phpmailer/extras/class.html2text.php';

class mailer {
	public static function sendMail($to,$subject,$htmltext) {
		$mail = new PHPMailer;
		$mail->Priority = null;

		$mail->isSMTP();    					// Set mailer to use SMTP
		$mail->Host = '';  						// Specify main and backup server
		$mail->SMTPAuth = true; 			// Enable SMTP authentication
		$mail->Username = '';   			// SMTP username
		$mail->Password = '';   			// SMTP password
		// $mail->SMTPSecure = 'tls'; // Enable encryption, 'ssl' also accepted

		$mail->CharSet = "UTF-8";
		$mail->From = '';
		$mail->FromName = '';
		$mail->addAddress($to); 			// Name is optional

		// $mail->addReplyTo(EMAIL_DEFAULT_ADDRESS, EMAIL_DEFAULT_NAME);
    // $mail->ReturnPath= EMAIL_DEFAULT_ADDRESS;
    // $mail->Sender= EMAIL_DEFAULT_ADDRESS;

		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		//$mail->addAttachment('/var/tmp/file.tar.gz');       // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');  // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $htmltext;
		$h2t = new html2text($htmltext);
		$mail->AltBody = $h2t->get_text();

		return $mail->send();

	}

	public static function createMail($to,$toName,$subject,$htmltext,$fromName='',$fromEmail='') {
		$mail = new PHPMailer;
		$mail->Priority = null;
		//$mail->isSMTP();                                      // Set mailer to use SMTP
		//$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup server
		//$mail->SMTPAuth = true;                               // Enable SMTP authentication
		//$mail->Username = 'jswan';                            // SMTP username
		//$mail->Password = 'secret';                           // SMTP password
		//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
		$mail->CharSet = "UTF-8";
		$mail->From = EMAIL_DEFAULT_ADDRESS;
		$mail->FromName = EMAIL_DEFAULT_NAME;
		$mail->addAddress($to,$toName); 				              	// Name is optional
		$mail->addReplyTo(EMAIL_DEFAULT_ADDRESS, EMAIL_DEFAULT_NAME);
    $mail->ReturnPath= EMAIL_DEFAULT_ADDRESS;
    $mail->Sender= EMAIL_DEFAULT_ADDRESS;

		$mail->WordWrap = 50;                                 	// Set word wrap to 50 characters
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  	// Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $htmltext;
		$h2t = new html2text($htmltext);
		$mail->AltBody = $h2t->get_text();

		return $mail;
		//if(!$mail->send()) {
		 //  echo 'Message could not be sent.';
		 //  echo 'Mailer Error: ' . $mail->ErrorInfo;
		 //  exit;
		//}
	}
    public static function sendMailFrom($to,$toName,$fromEmail,$fromName,$subject,$htmltext) {
		$mail = new PHPMailer;
		$mail->Priority = null;
		//$mail->isSMTP();                                      // Set mailer to use SMTP
		//$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup server
		//$mail->SMTPAuth = true;                               // Enable SMTP authentication
		//$mail->Username = 'jswan';                            // SMTP username
		//$mail->Password = 'secret';                           // SMTP password
		//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

		$mail->From = EMAIL_DEFAULT_ADDRESS;
		$mail->FromName = EMAIL_DEFAULT_NAME;
		$mail->addAddress($to,$toName); 												// Name is optional
		$mail->addReplyTo($fromEmail, $fromName);
    $mail->ReturnPath= EMAIL_DEFAULT_ADDRESS;
    $mail->Sender= EMAIL_DEFAULT_ADDRESS;

		$mail->WordWrap = 50;                                 	// Set word wrap to 50 characters
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  	// Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $htmltext;
		$h2t = new html2text($htmltext);
		$mail->AltBody = $h2t->get_text();

		return $mail->send();

	}

}
?>
