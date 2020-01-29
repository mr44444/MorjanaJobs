<?php
try {
    $file = "Mail_form_employe.php";
    $body = file_get_contents($file);
    $body = str_replace("{{col1}}", "الاسم", $body);
    $body = str_replace("{{col2}}", "الايميل", $body);
    $body = str_replace("{{col3}}", "بيانات الاتصال", $body);
    $body = str_replace("{{col4}}", "رقم الموظف", $body);
    $body = str_replace("{{col5}}", "القسم", $body);
    $body = str_replace("{{col6}}", "الوظيفة", $body);
    $body = str_replace("{{col7}}", "الاقتراح او الشكوي", $body);
    //==================================================================  
    $body = str_replace("{{name1}}", $Name, $body);
    $body = str_replace("{{name2}}", $Email, $body);
    $body = str_replace("{{name3}}", $phone, $body);
    $body = str_replace("{{name4}}", $Employee_number, $body);
    $body = str_replace("{{name5}}", $Section, $body);
    $body = str_replace("{{name6}}", $Function, $body);
    $body = str_replace("{{name7}}", $yourmessage, $body);
    $to = "mr.bean.mg22@gmail.com";
    $addAddress = "employee registration by e-mail : $Email";
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'a2plcpnl0890.prod.iad2.secureserver.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'test@digi-gates.com';
    $mail->Password = 'test@digi-gates.com';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('test@digi-gates.com', 'test@digi-gates.com');
    $mail->addAddress($Email);
    $mail->isHTML(true);
    $mail->Subject = $addAddress;
    $mail->MsgHTML($body);
    $mail->send();
} catch (Exception $exc) {
    echo $exc->getMessage();
}
?>