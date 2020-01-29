<?php
require_once '../FileConnection/Data_connection.php';
require_once '../Classes/Achieve.php';
require_once '../FileConnection/Extra_functions.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'autoload.php';
$mail = new PHPMailer(true);
if ($_SERVER["REQUEST_METHOD"] == "POST"):
    $time = time();
    $a = new Achieve();
    $true = TRUE;
    $msgerr = "";
    $book = array();
    //=====================================================================
    //=======================
    $file_name = $_FILES['uploadFile']['name'];
    $file_size = $_FILES['uploadFile']['size'];
    $file_tmp = $_FILES['uploadFile']['tmp_name'];
    $file_type = $_FILES['uploadFile']['type'];
    $error = $_FILES['uploadFile']['error'];
    $extensions = array("jpeg", "jpg", "png", "gif");
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
//=================================
    //================================================================
    $Name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
    $Email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['Contact_Data'], FILTER_SANITIZE_NUMBER_INT);
    $Employee_number = filter_var($_POST['Employee_number'], FILTER_SANITIZE_NUMBER_INT);
    $Section = filter_var($_POST['Section'], FILTER_SANITIZE_STRING);
    $Function = filter_var($_POST['Function'], FILTER_SANITIZE_STRING);
    $yourmessage = filter_var($_POST['your-message'], FILTER_SANITIZE_STRING);
    if (!$a->empty_filed($Name)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم فارغ</div>";
        $true = FALSE;
    endif;
    if (!$a->empty_filed($Email)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي البريد الالكتروني فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($phone)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي بيانات الاتصال فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($Employee_number)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي رقم الموظف فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($Section)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي القسم فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($Function)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الوظيفة فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($yourmessage)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الرسالة فارغ</div>";
        $true = FALSE;
    endif;
    if (!file_exists($file_tmp)) {
    $msgerr .= "<div class='alert alert-danger alert-autocloseable-danger'>Choose image file to upload</div>";
    $true = FALSE;
} else if (!in_array($ext, $extensions)) {
    $msgerr .= "<div class='alert alert-danger alert-autocloseable-danger'>Upload valiid images. Only PNG and JPEG are allowed</div>";
    $true = FALSE;
}
    echo $msgerr;

    if ($true):
        require_once './Mail_employe.php';
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $target_pathss = './emp/' . time() . rand(100, 100) . "." . $extension;
        $fildb=rand(100, 100) . "." . $extension;
        if (move_uploaded_file($file_tmp, $target_pathss)) {
            $target_path =  time() . rand(100, 100) . "." . $extension;
        }
        $sql = "INSERT INTO `employee` (`id`, `Name`, `Email`, `img`, `Contact_Data`, `Employee_number`, `Section`, `Function`,`content`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?,?);";
        $array = array($Name, $Email, $target_path, $phone, $Employee_number, $Section, $Function, $yourmessage);
        $a->sql($Data_communication, $sql, $array);
            echo $msgerr .= "<div class='alert alert-success'>Successfully registered as an employee</div>";

    endif;
endif;
?>