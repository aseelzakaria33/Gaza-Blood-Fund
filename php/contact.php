<?php 
include('../admin/validation.php');
session_start();
include('connection.php');
if(!$db){
    echo "فشل الاتصال بقاعدة البيانات";
}
// التأكد من أن المستخدم مسجل الدخول

//success_message: يخزن رسالة النجاح إذا تم التسجيل بنجاح.
//error_message: يخزن رسالة الخطأ إذا حدثت مشكلة.
// معالجة النموذج عند الإرسال
$success_message = '';
$error_message = '';

if (isset($_POST['sub0'])) {
    // استلام البيانات من النموذج
    $username = $_POST['username'];
    $birthdate =  $_POST['birthdate']; 
    $bgroup =  $_POST['bgroup'];
    $Cgroup =  $_POST['Cgroup'];
    $Fgroup =$_POST['Fgroup'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $con =  $_POST['con'];
//يتم إنشاء مصفوفة لتخزين الأخطاء
    // التحقق من صحة البيانات
    $errors = [];
//إذا كان غير صالح، يتم تخزين رسالة الخطأ.
    // التحقق من تاريخ الميلاد والعمر
    $birthdateValidation = validateBirthdate($birthdate);
    if (!$birthdateValidation['valid']) {
        $errors[] = $birthdateValidation['message'];
    } else {
        $age = $birthdateValidation['age'];
    }

    // التحقق من رقم الهاتف
    if (!validatePhone($con)) {
        $errors[] = 'رقم الهاتف غير صحيح، يجب أن يبدأ بـ 05 ويتكون من 10 أرقام';
    }
//يتم التحقق من صلاحية تاريخ التبرع (قد يكون هناك حد زمني بين كل تبرع وآخر).

    // التحقق من فصيلة الدم
    if (!validateBloodType($Fgroup)) {
        $errors[] = 'فصيلة الدم غير صحيحة';
    }

    // التحقق من تاريخ التبرع
    $donationDateValidation = validateDonationDate($date);
    if (!$donationDateValidation['valid']) {
        $errors[] = $donationDateValidation['message'];
    }
//إذا كانت هناك أخطاء، يتم تجميعها في رسالة واحدة وفصلها بـ <br>.

    // إذا كانت هناك أخطاء
    if (!empty($errors)) {
        $error_message = implode('<br>', $errors);
    } else {
        // إدخال البيانات إلى قاعدة البيانات
        $sql = "INSERT INTO regb (username, bgroup, Cgroup, Fgroup, date, time, con, age) 
                VALUES ('$username', '$bgroup', '$Cgroup', '$Fgroup', '$date', '$time', '$con', '$age')";

        if (mysqli_query($db, $sql)) {
            $success_message = 'تم تسجيل المتبرع بنجاح';
        } else {
            $error_message = 'فشل في تسجيل المتبرع: ' . mysqli_error($db);
        }
    }
}
?>



<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تسجيل التبرع - بنك الدم غزة</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/app.css">

  <meta name="description" content="بنك الدم في غزة - تبرع بالدم وأنقذ حياة">

  <meta property="og:title" content="تسجيل التبرع - بنك الدم غزة">
  <meta property="og:type" content="website">
  <meta property="og:url" content="">
  <meta property="og:image" content="">
  <meta property="og:image:alt" content="بنك الدم في غزة">

  <link rel="icon" href="../favicon.ico" sizes="any">
  <link rel="icon" href="../icon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="../icon.png">

  <link rel="manifest" href="../site.webmanifest">
  <meta name="theme-color" content="#fafafa">
  <!-- ملفات بوتستراب -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../css/carousel.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- الخطوط العربية -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">

  <style>
    /* تنسيقات عامة */
    @media (max-width: 400px) {
      .donation-container {
        padding: 15px;
      }
      
      .form-control, .form-select {
        font-size: 0.9rem;
      }
      
      .btn-danger {
        padding: 8px;
      }
    }
    
    
    
    
    body {
      font-family: 'Tajawal', sans-serif;
      text-align: right;
      background-color: #FFFFFF;
    }
    
    .logo {
      max-height: 60px;
    }
    
    .nav-pills .nav-link.active {
      background-color: #d32f2f;
    }
    
    .nav-pills .nav-link {
      color: #333;
      margin: 0 5px;
      font-weight: 500;
    }
    
    /* تنسيق نموذج التبرع */
    .donation-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      padding: 25px;
      margin: 20px auto;
      max-width: 700px;
    }
    
    .blood-image {
      max-width: 200px;
      margin-bottom: 20px;
    }
    
    .btn-danger {
      background-color: #d32f2f;
      border-color: #d32f2f;
      font-weight: bold;
      padding: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    
    .btn-danger:hover {
      background-color: #b71c1c;
      border-color: #b71c1c;
      transform: translateY(-2px);
      box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }
    
    .form-control, .form-select {
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: #d32f2f;
      box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25);
    }
    
    /* تنسيق التذييل */
    footer {
      background-color: #263238;
      color: white;
      padding-top: 30px;
    }
    
    .vertical-text {
      writing-mode: vertical-lr;
      transform: rotate(180deg);
      color: #ff5252;
      font-weight: bold;
      margin-left: 10px;
    }
    
    footer .nav-link {
      color: #b0bec5 !important;
      transition: color 0.3s ease;
    }
    
    footer .nav-link:hover {
      color: #fff !important;
    }
    
    /* تأثيرات إضافية */
    .emergency-banner {
      background-color: #d32f2f;
      color: white;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .emergency-banner i {
      margin-left: 10px;
    }
    .two{
    color:red;
    font-size: 20px;
}
    /* تحسين استجابة الهيدر للشاشات المختلفة */
    @media (max-width: 768px) {
      .nav-pills {
        margin-top: 15px;
        justify-content: center;
      }
    
      .nav-pills .nav-link {
        font-size: 0.9rem;
        padding: 0.4rem 0.6rem;
      }
    
      .logo {
        max-height: 50px;
      }
    }
    
    @media (max-width: 576px) {
      .nav-pills .nav-link {
        font-size: 0.8rem;
        padding: 0.3rem 0.5rem;
        margin: 0 2px;
      }
    }
    /*masssssssssssssssssssssssssssssssssg */ 
    .message-box {
    padding: 15px;
    border-radius: 5px;
    margin: 10px auto;
    width: 50%;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    border: 2px solid;
}

.success {
    background-color: #d4edda; /* أخضر فاتح */
    color: #155724;
    border-color: #155724;
}

.error {
    background-color: #f8d7da; /* أحمر فاتح */
    color: #721c24;
    border-color: #721c24;
}

  </style>
</head>
<body>

<header class="py-3">
  <div class="container d-flex flex-wrap justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a href="index.php" class="nav-link">الرئيسية</a></li>
      <li class="nav-item"><a href="about_us.php" class="nav-link"> المؤسسة</a></li>
      <li class="nav-item"><a href="blog.php" class="nav-link">المدونة</a></li>
      <li class="nav-item"><a href="contact.php" class="nav-link active" aria-current="page">تسجيل التبرع</a></li>
      <li class="nav-item"><a href="donte.php" class="nav-link " > المتبرعين</a></li>
    </ul>
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img src="../logo.png" alt="شعار بنك الدم" class="logo"/>
    </a>
  </div>
</header>

<div class="container">
<div class="container">
</div>
    
 <?php if ($success_message || $error_message) : ?>
    <div id="message-box" class="message-box <?php echo $success_message ? 'success' : 'error'; ?>">
        <?php echo $success_message ? $success_message : $error_message; ?>
    </div>

    <script>
        setTimeout(function() {
            var messageBox = document.getElementById('message-box');
            if (messageBox) {
                messageBox.style.display = 'none';
            }
        }, 5000); // تختفي الرسالة بعد 5 ثوانٍ
    </script>
<?php endif; ?>


    <!-- معلومات التبرع -->
    <div class="container text-center py-4">
      <img src="../blog.png" alt="كيس الدم" class="blood-image">
      <h5 class="mb-4">املأ الاستبيان لتلقي رسالة بموعد التبرع</h5>
    </div>

    <div class="donation-container">
      <h4 class="text-center mb-4 text-danger fw-bold">تبرع الآن وأنقذ حياة</h4>
      <form action="" method="POST">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="username" class="form-label">الاسم الكامل</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="أدخل اسمك الكامل" required>
          </div>
          <div class="col-md-6">
            <label for="age" class="form-label">تاريخ الميلاد</label>
            <input type="date" class="form-control" id="age" name="birthdate" placeholder="أدخل عمرك" min="18" max="65" required>
          </div>
          <div class="col-md-6">
            <label for="bgroup" class="form-label">الجنس</label>
            <select id="bgroup" name="bgroup" class="form-select" required>
              <option value="" disabled selected>اختر الجنس</option>
              <option value="male">ذكر</option>
              <option value="female">أنثى</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="con" class="form-label">رقم الهاتف</label>
            <input type="text" id="con" name="con" class="form-control" placeholder="05xxxxxxxx" required>
          </div>
          <div class="col-md-6">
            <label for="Cgroup" class="form-label">مركز التبرع</label>
            <select id="Cgroup" name="Cgroup" class="form-select" required>
              <option value="" disabled selected>اختر مركز التبرع</option>
              <option value="مستشفى الشفاء">مستشفى الشفاء</option>
              <option value="مستشفى الأوروبي">مستشفى الأوروبي</option>
              <option value="مستشفى ناصر">مستشفى ناصر</option>
              <option value="مركز الدم المركزي">مركز الدم المركزي</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="Fgroup" class="form-label">فصيلة الدم</label>
            <select id="Fgroup" name="Fgroup" class="form-select" required>
              <option value="" disabled selected>اختر فصيلة الدم</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="date" class="form-label">تاريخ التبرع</label>
            <input type="date" id="date" name="date" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="time" class="form-label">وقت التبرع</label>
            <input type="time" id="time" name="time" class="form-control" required>
          </div>
          <div class="col-12 mt-4">
            <button type="submit" class="btn btn-danger w-100 py-2 fw-bold" name="sub0">تبرع الآن</button>
          </div>
        </div>
      </form>
    </div>

    <div class="text-center mt-4 mb-5">
      <img src="../Group 355.png" alt="قطرة دم" width="50">
      <p class="text-danger fw-bold mt-2">قطرة دم = حياة</p>
    </div>
  </div>
</div>

<footer class="mb-0 mt-5 pt-5 text-white">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-1 mb-3">
        <form>
          <h5 class="mb-2">انضم إلينا</h5>
          <p>كن أول من يتلقى أحدث التحديثات والتطورات المتعلقة بالتبرع بالدم.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">البريد الإلكتروني</label>
            <input id="newsletter1" name="email" type="email" class="form-control" placeholder="البريد الإلكتروني" required>
            <button class="btn btn-danger" type="submit" name="subk" >اشترك</button>
          </div>
        </form>
      </div>
      <div class="col-6 col-md-2 mb-3">
        <div class="d-flex">
        <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0"><span style='font-size:22px'></span><span class='two'> اتصل بنا </span></a></li>
            <li class="nav-item mb-2"><a href="tel:+970599999999" target="_blank" class="nav-link p-0">+970599999999</a></li>
            <li class="nav-item mb-2"><a href="mailto:GazaBF@gmail.com" target="_blank" class="nav-link p-0">GazaBF@gmail.com</a></li>
          </ul>
        </div>
      </div>
      <div class="col-6 col-md-2 mb-3">
        <div class="d-flex">
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0"><span style='font-size:22px'></span><span class='two'> تابعنا</span></a></li>
            <li class="nav-item mb-2"><i class="fab fa-facebook me-2"></i><a href="https://www.facebook.com/YourPage" target="_blank" class="nav-link p-0">فيسبوك</a></li>
            <li class="nav-item mb-2"><i class="fab fa-twitter me-2"></i><a href="https://www.twitter.com/YourProfile" target="_blank" class="nav-link p-0">تويتر</a></li>
            <li class="nav-item mb-2"><i class="fab fa-instagram me-2"></i><a href="https://www.instagram.com/YourProfile" target="_blank" class="nav-link p-0">انستغرام</a></li>
          </ul>
        </div>
      </div>
      <div class="d-flex flex-column flex-sm-row justify-content-between mx-5 mt-5">
        <p class="m-0">© صندوق دم غزة. جميع الحقوق محفوظة، 2025.</p>
      </div>
    </div>
  </div>
</footer>
<script src="../js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>

