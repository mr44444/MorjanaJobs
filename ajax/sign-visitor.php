<?php

require_once '../FileConnection/Data_connection.php';
require_once '../Classes/Achieve.php';
require_once '../FileConnection/Extra_functions.php';
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
    //  =========================================================
    $name = filter_var($_POST['your-name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['your-email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['your-phone'], FILTER_SANITIZE_NUMBER_INT);
    $Membership = filter_var($_POST['your-Membership'], FILTER_SANITIZE_NUMBER_INT);
    $Identity = filter_var($_POST['your-Identity'], FILTER_SANITIZE_NUMBER_INT);
    $Start = filter_var($_POST['your-Start'], FILTER_SANITIZE_STRING);
    $End = filter_var($_POST['your-End'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['card-number'], FILTER_SANITIZE_NUMBER_INT);
    $Membership_ = filter_var($_POST['Membership'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['your-message'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $di = data_mysql($Start);
    $do = data_mysql($End);
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
    if (!$a->empty_filed($name)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;
        $book[] = "The message content is empty";
    endif;
    if (!$a->empty_filed($email)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الايميل فارغ/div>";
        $true = FALSE;
    endif;
    if (!$a->empty_filed($phone)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي بيانات الاتصال فارغ</div>";
        $true = FALSE;
    endif;
    if (!$a->empty_filed($Membership)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي رقم العضوية فارغ</div>";
        $true = FALSE;
    endif;
    if (!$a->empty_filed($Identity)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي رقم الهوية فارغ</div>";
        $true = FALSE;
    endif;
    if (!$a->empty_filed($number)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي رقم الهوية فارغ</div>";
        $true = FALSE;
    endif;
    if (!$a->empty_filed($message)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الرسالة فارغ</div>";
        $true = FALSE;
        $book[] = "لاتترك اي حقول فارغة";
    elseif (strlen($message) < 10) :
        $msgerr .= "<div class='alert alert-danger'>محتوي الرسالة يجب ان يحتوي علي عشرة احرف </div>";
        $true = FALSE;
    endif;
    if (!file_exists($file_tmp)) {
        $msgerr .= "<div class='alert alert-danger alert-autocloseable-danger'>من فضلك قم بأختيار ملف</div>";
        $true = FALSE;
    }
 if (!in_array($ext, $extensions)) {
    $msgerr .= "<div class='alert alert-danger alert-autocloseable-danger'>Upload valiid images. Only PNG and JPEG are allowed</div>";
    $true = FALSE;
}
endif;
echo $msgerr;
if ($true):
  require_once './Mail_visitor.php';
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $target_pathss = './UP/' . time() . rand(100, 100) . "." . $extension;
    if (move_uploaded_file($file_tmp, $target_pathss)) {
        $target_path = time() . rand(100, 100) . "." . $extension;
    }
    $sql = "INSERT INTO `visits` (`id`, `Name`, `Email`, `Contact_Data`, `Membership_No`, `ID_Number`, `Membership_start`, `Membership_expiration`, `Entry_card`, `Type_Membership`, `Membership_status`, `picture`, `Suggestion`,`Membership_start_`,`Membership_expiration_`) VALUES "
            . "(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $array = array($name, $email, $phone, $Membership, $Identity, $Start, $End, $number, $Membership_, $status, $target_path, $message,$di,$do);
    echo $msgerr .= "<div class='alert alert-success'>Successfully registered as a visitor</div>";
    $a->sql($Data_communication, $sql, $array);
endif;
?>