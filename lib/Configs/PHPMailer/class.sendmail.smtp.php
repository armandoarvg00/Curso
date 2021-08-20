<?php
require 'PHPMailerAutoload.php';
function f_mail($la_dataIn = array(), &$la_dataOut = array(), &$ls_msg){
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = "	mail.impulseits.com";
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Username = 'noreply@impulseits.com';
	$mail->Password = "U7}J~KY)t&@d";
    //    $mail->Password = "8aH2bKlq,ft9";
	$mail->setFrom('noreply@impulseits.com', 'Impulse ITS - Information Technology Solutions');
	$mail->addAddress($la_dataIn['mail_destinatario'], $la_dataIn['nombre_destinatario']);
	$mail->Subject = 'Hemos recibido su mensaje';
	$mail->msgHTML($la_dataIn['mensaje']);
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	if (!$mail->send()) {
		$ls_msg = $mail->ErrorInfo;
		return -1;
	}else{
		$ls_msg = 'Mensaje enviado correctamente';
		return 1;
	}
}

function f_mailV2($la_dataIn = array(), &$la_dataOut = array(), &$ls_msg){
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = "mail.impulseits.com";
	$mail->Port = 465;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Username = 'noresponder@impulseits.com';
	$mail->Password = "PI*radioal2";
    //    $mail->Password = "8aH2bKlq,ft9";
	$mail->setFrom('noresponder@impulseits.com', 'Impulse ITS - Information Technology Solutions');
	$mail->addAddress($la_dataIn['mail_destinatario'], $la_dataIn['nombre_destinatario']);
	$mail->Subject = 'Descarga gratuita';
	$mail->msgHTML($la_dataIn['mensaje']);
	$mail->IsHTML(true);
	$mail->CharSet = "UTF-8";
	if (!$mail->send()) {
		$ls_msg = $mail->ErrorInfo;
		return -1;
	}else{
		$ls_msg = 'Mensaje enviado correctamente';
		return 1;
	}
}
?>