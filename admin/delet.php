<?php
include('connection.php');
session_start();

// التأكد من أن المستخدم مسجل الدخول
if (!isset($_SESSION['un'])) {
    header("location:loginadmin.php");
    exit();
}

// التحقق من وجود معرف المتبرع
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("location:list_donor.php");
    exit();
}

$id = $_GET['id'];

// حذف المتبرع من قاعدة البيانات
mysqli_query($db, "DELETE FROM `regb` WHERE id=$id");

// العودة إلى صفحة قائمة المتبرعين
header("location:list_donor.php");
exit();
?>

