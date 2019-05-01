<?php
e_e();
include "class.phpmailer.php";
include "../w/mailsetvar.php";
$mail = new PHPMailer();
$mail->IsSMTP();                  	// send via SMTP
$mail->SetLanguage($Mlanguage,"../mail/support/"); 		// set the default language
$mail->Host = $MHost;   						// SMTP servers
$mail->Port = $MPort;   						// SMTP port
$mail->SMTPAuth = $MSendNeedAcount; // turn on SMTP authentication
$mail->Username = $MAcount;     	// SMTP username  注意：普通邮件认证不需要加 @域名
$mail->Password = $MPass; 				// SMTP password
$mail->From = $MsuperMailAdd;		// 发件人邮箱
$mail->FromName =  $MsuperName;					// 发件人
$mail->CharSet = $MCharSet;					// 这里指定字符集
$mail->Encoding = "base64";
//$mail->WordWrap = 50; // set word wrap 换行字数
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment 附件
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");

function sendmail($tomail,$toname,$subject,$body,$remail,$rename,$isHTML=false){
global $mail;
$mail->AddAddress($tomail,$toname);		// 收件人邮箱和姓名
$mail->AddReplyTo($remail,$rename);
$mail->IsHTML($isHTML);  								// send as HTML
$mail->Subject = $subject;
$mail->Body=$isHTML?"
<html><head>
<meta http-equiv=\"Content-Language\" content=\"zh-cn\">
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$mail->CharSet\">
</head>
<body><pre>$body</pre></body>
</html>
":$body;       
$mail->Send();                                                                    
return $mail->ErrorInfo;
}     
?>