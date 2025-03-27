<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'boold');
if(!$db){
  echo "فشل الاتصال بقاعدة البيانات";
}
?>
<!DOCTYPE html>
<html class="no-js" lang="ar" dir="rtl">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>فصيلة الدم B- - بنك الدم غزة</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/app.css">

<meta name="description" content="بنك الدم في غزة - تبرع بالدم وأنقذ حياة">

<meta property="og:title" content="فصيلة الدم B- - بنك الدم غزة">
<meta property="og:type" content="website">
<meta property="og:url" content="">
<meta property="og:image" content="">
<meta property="og:image:alt" content="بنك الدم في غزة">

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/icon.svg" type="image/svg+xml">
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
  
  /* تنسيق البانر */
  .blood-banner {
    background-color: #ffebee;
    border-radius: 10px;
    padding: 30px;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }
  
  .blood-banner h2 {
    color: #d32f2f;
    font-weight: 700;
    margin-bottom: 10px;
  }
  
  .blood-banner p {
    font-size: 1.1rem;
    margin-bottom: 0;
  }
  
  /* تنسيق الجدول */
  .table-container {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 30px;
  }
  
  .table-title {
    color: #d32f2f;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
  }
  
  .table {
    width: 100%;
  }
  
  .table th {
    background-color: #d32f2f;
    color: white;
    font-weight: 600;
    text-align: center;
    padding: 12px;
  }
  
  .table td {
    text-align: center;
    padding: 12px;
  }
  
  .table tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  .table tr:hover {
    background-color: #f5f5f5;
  }
  
  /* تنسيق التذييل */
  footer {
    background-color: #263238;
    color: white;
    padding-top: 30px;
    margin-top: 50px;
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
  
  .back-btn {
    background-color: #d32f2f;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
    transition: all 0.3s ease;
  }
  
  .back-btn:hover {
    background-color: #b71c1c;
    color: white;
    transform: translateY(-2px);
  }
  
  .back-btn i {
    margin-left: 5px;
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
</style>
</head>
<body>

<header class="py-3 ">
  <div class="container d-flex flex-wrap justify-content-center">
    <!-- <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img src="logo.png" alt="شعار بنك الدم" class="logo"/>
      <span class="fs-4 me-3 text-danger fw-bold">بنك الدم - غزة</span>
    </a> -->

    <ul class="nav nav-pills">
      <li class="nav-item"><a href="../php/index.php" class="nav-link active" aria-current="page">الرئيسية</a></li>
      <li class="nav-item"><a href="../php/about_us.php" class="nav-link"> المؤسسة</a></li>
      <li class="nav-item"><a href="../php/blog.php" class="nav-link">المدونة</a></li>
      <li class="nav-item"><a href="../php/contact.php" class="nav-link">تسجيل التبرع</a></li>
      <li class="nav-item"><a href="../php/donte.php" class="nav-link"> المتبرعين</a></li>
      <!-- <li class="nav-item"><a href="admin/loginadmin.php" class="nav-link active">  الإدارة</a></li> -->
    </ul>
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
    <img src="../logo.png" alt="شعار بنك الدم" class="logo"/>
    </a>
  </div>
</header>

<div class="container">
  <!-- <div class="emergency-banner">
    <i class="fas fa-exclamation-circle fa-lg"></i>
    <span>حالة طارئة: نحتاج متبرعين من فصيلة O- و A+ بشكل عاجل</span>
  </div> -->


  <a href="../php/blog.php" class="back-btn">
    <i class="fas fa-arrow-right"></i>
    العودة إلى المدونة
  </a>

  <div class="blood-banner">
    <h2>فصيلة الدم B-</h2>
    <p>يمكن لأصحاب فصيلة B- التبرع لفصائل B+، B-، AB+ و AB-، ويمكنهم استقبال الدم من فصائل B- و O- فقط</p>
  </div>

  <div class="table-container">
    <h3 class="table-title">قائمة المتبرعين من فصيلة B-</h3>
    
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>العمر</th>
          <th>فصيلة الدم</th>
          <th>مركز التبرع</th>
          <th>الفصيلة</th>
          <th>التاريخ</th>
          <th>الوقت</th>
          <th>رقم الاتصال</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $BS = $_GET['BS'] ?? null;
        $q = "SELECT * FROM `regb`";
        $result = mysqli_query($db, $q);

        $found = false;
        while ($row = mysqli_fetch_assoc($result)) {
          if ($row['Fgroup'] == $BS) {
            $found = true;
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['age']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bgroup']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Cgroup']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Fgroup']) . "</td>";
            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['time']) . "</td>";
            echo "<td>" . htmlspecialchars($row['con']) . "</td>";
            echo "</tr>";
          }
        }
        
        if (!$found) {
          echo "<tr><td colspan='7' class='text-center'>لا يوجد متبرعين متاحين حالياً من هذه الفصيلة</td></tr>";
        }
        ?>
      </tbody>
    </table>
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
            <input id="newsletter1" type="text" class="form-control" placeholder="البريد الإلكتروني">
            <button class="btn btn-danger" type="button">اشترك</button>
          </div>
        </form>
      </div>
      <div class="col-6 col-md-2 mb-3">
        <div class="d-flex">
          <span class="vertical-text">اتصل بنا</span>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0">+970599999999</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0">GazaBF@gmail.com</a></li>
          </ul>
        </div>
      </div>
      <div class="col-6 col-md-2 mb-3">
        <div class="d-flex">
          <span class="vertical-text">تابعنا</span>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><i class="fab fa-facebook me-2"></i><a href="#" class="nav-link p-0">فيسبوك</a></li>
            <li class="nav-item mb-2"><i class="fab fa-twitter me-2"></i><a href="#" class="nav-link p-0">تويتر</a></li>
            <li class="nav-item mb-2"><i class="fab fa-instagram me-2"></i><a href="#" class="nav-link p-0">انستغرام</a></li>
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
