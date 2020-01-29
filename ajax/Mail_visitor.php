<?php

try {
    $file = "Mail_form_visitor.php";
    $body = file_get_contents($file);
    $body = str_replace("{{col1}}", "الاسم", $body);
    $body = str_replace("{{col2}}", "الايميل", $body);
    $body = str_replace("{{col3}}", "بيانات الاتصال", $body);
    $body = str_replace("{{col4}}", "رقم العضوية ", $body);
    $body = str_replace("{{col5}}", "رقم الهوية", $body);
    $body = str_replace("{{col6}}", "تاريخ بداء العضوية ", $body);
    $body = str_replace("{{col7}}", "تاريخ انتهاء العضوية", $body);
    $body = str_replace("{{col8}}", "رقم كارت الدخول ", $body);
    $body = str_replace("{{col9}}", "نوع العضوية ", $body);
    $body = str_replace("{{col10}}", "حالة العضوية ", $body);
    $body = str_replace("{{col11}}", "الاقتراح او الشكوي", $body);
    //==================================================================  
    $body = str_replace("{{name1}}", $name, $body);
    $body = str_replace("{{name2}}", $email, $body);
    $body = str_replace("{{name3}}", $phone, $body);
    $body = str_replace("{{name4}}", $Membership, $body);
    $body = str_replace("{{name5}}", $Identity, $body);
    $body = str_replace("{{name6}}", $Start, $body);
    $body = str_replace("{{name7}}", $End, $body);
    $body = str_replace("{{name8}}", $number, $body);
    $body = str_replace("{{name9}}", $Membership_, $body);
    $body = str_replace("{{name10}}", $status, $body);
    $body = str_replace("{{name11}}", $message, $body);
    $to = "mr.bean.mg22@gmail.com";
    $addAddress = "Visitor registration by e-mail : $email";
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