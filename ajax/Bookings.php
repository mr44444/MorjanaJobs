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
    //  =========================================================
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $Number_nights = filter_var($_POST['Number_nights'], FILTER_SANITIZE_NUMBER_INT);
    $Number_individuals = filter_var($_POST['Number_individuals'], FILTER_SANITIZE_NUMBER_INT);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $add = filter_var($_POST['add'], FILTER_SANITIZE_STRING);
     $check_in_date = data_mysql__(filter_var($_POST['check_in_date'], FILTER_SANITIZE_STRING));
    $check_out_date = data_mysql__(filter_var($_POST['check_out_date'], FILTER_SANITIZE_STRING));
    $di = data_mysql($check_in_date);
    $do = data_mysql($check_out_date);
    if (!$a->empty_filed($name)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($email)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($Number_nights)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($Number_individuals)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($phone)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($add)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($check_in_date)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;

    endif;
    if (!$a->empty_filed($check_out_date)):
        $msgerr .= "<div class='alert alert-danger'>من فضلك لاتترك محتوي الاسم  فارغ</div>";
        $true = FALSE;
    endif;
    if ($true):
        require_once './bookings_maile.php';
        $sql = "INSERT INTO `bookings` (`id`, `names`, `email`, `Number_nights`, `Number_individuals`, `phone`, `addres`, `check_in_date`, `check_out_date`,`di`,`do`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?,?,?);";
        $array = array($name, $email, $Number_nights, $Number_individuals, $phone, $add, $check_in_date, $check_out_date, $di, $do);
        $a->sql($Data_communication, $sql, $array);
        echo $msgerr .= "<div class='alert alert-success'>It was confirmed booking</div>";
    endif;   
    
endif;