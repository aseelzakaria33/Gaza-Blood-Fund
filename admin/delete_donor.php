<?php
include('connection.php');
session_start();

// التأكد من أن المستخدم مسجل الدخول
if (!isset($_SESSION['un'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'غير مصرح لك بالوصول']);
    exit();
}

// التحقق من وجود معرف المتبرع
if (!isset($_POST['id']) || empty($_POST['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'معرف المتبرع غير موجود']);
    exit();
}

$id = mysqli_real_escape_string($db, $_POST['id']);

// حذف المتبرع من قاعدة البيانات
$query = "DELETE FROM `regb` WHERE id = '$id'";
$result = mysqli_query($db, $query);

if ($result) {
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'تم حذف المتبرع بنجاح']);
} else {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'فشل في حذف المتبرع: ' . mysqli_error($db)]);
}
?>

