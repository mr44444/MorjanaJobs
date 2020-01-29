<?php
try {
    $file="form_booking.php";
    $body = file_get_contents($file);
    $body = str_replace("{{name1}}", $name, $body);
    $body = str_replace("{{name2}}", $email, $body);
    $body = str_replace("{{name3}}", $Number_nights, $body);
    $body = str_replace("{{name4}}", $Number_individuals, $body);
    $body = str_replace("{{name5}}", $phone, $body);
    $body = str_replace("{{name6}}", $add, $body);
    $body = str_replace("{{name7}}", $check_in_date, $body);
    $body = str_replace("{{name8}}", $check_out_date, $body);
    $to = "mr.bean.mg22@gmail.com";
    $addAddress="New booking account : $email";
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'a2plcpnl0890.prod.iad2.secureserver.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'test@digi-gates.com';
    $mail->Password = 'test@digi-gates.com';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('test@digi-gates.com', 'test@digi-gates.com');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = $addAddress;
    $mail->MsgHTML($body);
    $mail->send();
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>