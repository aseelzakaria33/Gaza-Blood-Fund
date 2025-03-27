<?php
// الاتصال بقاعدة البيانات
include('connection.php');
if(!$db){
    echo "فشل الاتصال بقاعدة البيانات";
}

// تحديد عدد السجلات في كل صفحة
$limit = 10; // عدد الصفوف في كل صفحة
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// جلب البيانات مع التحديد بناءً على الصفحة
$q = "SELECT * FROM `regb` LIMIT $start, $limit";
$result = mysqli_query($db, $q);

// حساب عدد الصفحات
$total_results = mysqli_query($db, "SELECT COUNT(*) AS total FROM `regb`");
$total_rows = mysqli_fetch_assoc($total_results)['total'];
$total_pages = ceil($total_rows / $limit);
?>

<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>البحث عن متبرعين - بنك الدم غزة</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/app.css">

  <meta name="description" content="بنك الدم في غزة - تبرع بالدم وأنقذ حياة">

  <meta property="og:title" content="البحث عن متبرعين - بنك الدم غزة">
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
  .table th, .table td {
    padding: 5px 3px;
    font-size: 0.7rem;
  }
}
    body {
      font-family: 'Tajawal', sans-serif;
      text-align: right;
      background-color: #f8f9fa;
      overflow-x: hidden;
      width: 100%;
      margin: 0;
      padding: 0;
    }
    
    .logo {
      max-height: 60px;
      width: auto;
      object-fit: contain;
    }
    
    .nav-pills .nav-link.active {
      background-color: #d32f2f;
    }
    
    .nav-pills .nav-link {
      color: #333;
      margin: 0 5px;
      font-weight: 500;
      white-space: nowrap;
    }
    
    /* تنسيق الصفحة الرئيسية - صورة كامل عرض الشاشة */
    .full-width-container {
      width: 100vw;
      position: relative;
      left: 50%;
      right: 50%;
      margin-left: -50vw;
      margin-right: -50vw;
      padding: 0;
      overflow: hidden;
    }
    
    .page-header {
      background-image: url('../whygpf.jpeg');
      background-size: cover;
      background-position: center;
      position: relative;
      padding: 80px 0;
      margin-bottom: 40px;
      color: white;
      text-align: center;
      width: 100%;
      overflow: hidden;
    }
    
    .page-header::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 1;
    }
    
    .page-header-content {
      position: relative;
      z-index: 2;
      padding: 0 15px;
    }
    
    .page-header h1 {
      font-weight: 700;
      margin-bottom: 20px;
      font-size: 2.5rem;
    }
    
    .page-header p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto;
    }
    
    /* تنسيق نموذج البحث */
    .search-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      padding: 25px;
      margin: 0 auto 30px;
      max-width: 700px;
      transition: all 0.3s ease;
    }
    
    .search-container:hover {
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      transform: translateY(-5px);
    }
    
    .search-title {
      color: #d32f2f;
      font-weight: 700;
      margin-bottom: 20px;
      text-align: center;
    }
    
    .btn-danger {
      background-color: #d32f2f;
      border-color: #d32f2f;
      transition: all 0.3s ease;
      font-weight: 600;
    }
    
    .btn-danger:hover {
      background-color: #b71c1c;
      border-color: #b71c1c;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(183, 28, 28, 0.3);
    }
    
    /* تنسيق الجدول */
    .table-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 30px;
      overflow-x: auto;
    }
    
    .table-title {
      color: #d32f2f;
      font-weight: 700;
      margin-bottom: 20px;
      text-align: center;
    }
    
    .table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }
    
    .table th {
      background-color: #d32f2f;
      color: white;
      font-weight: 600;
      text-align: center;
      padding: 12px;
      position: sticky;
      top: 0;
      z-index: 10;
    }
    
    .table td {
      text-align: center;
      padding: 12px;
      vertical-align: middle;
    }
    
    .table tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    
    .table tr {
      transition: all 0.2s ease;
    }
    
    .table tr:hover {
      background-color: #f5f5f5;
      transform: scale(1.01);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    /* تنسيق الترقيم */
    .pagination {
      justify-content: center;
      margin-top: 20px;
      flex-wrap: wrap;
      gap: 5px;
    }
    
    .page-item.active .page-link {
      background-color: #d32f2f;
      border-color: #d32f2f;
    }
    
    .page-link {
      color: #d32f2f;
      transition: all 0.3s ease;
    }
    
    .page-link:hover {
      color: #b71c1c;
      background-color: #ffebee;
      transform: scale(1.05);
    }
    
    /* تنسيق التذييل */
    footer {
      background-color: #263238;
      color: white;
      padding-top: 30px;
      margin-top: 50px;
      width: 100%;
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
    
    .two {
      color: red;
      font-size: 20px;
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
    
    /* تحسين استجابة الهيدر للشاشات المختلفة */
    @media (max-width: 992px) {
      .page-header h1 {
        font-size: 2rem;
      }
      
      .page-header p {
        font-size: 1rem;
      }
      
      .search-container, .table-container {
        width: 95%;
        margin-left: auto;
        margin-right: auto;
      }
    }
    
    @media (max-width: 768px) {
      .nav-pills {
        margin-top: 15px;
        justify-content: center;
        flex-wrap: wrap;
      }
    
      .nav-pills .nav-link {
        font-size: 0.9rem;
        padding: 0.4rem 0.6rem;
        margin-bottom: 5px;
      }
    
      .logo {
        max-height: 50px;
      }
      
      .page-header {
        padding: 50px 0;
      }
      
      .page-header h1 {
        font-size: 1.8rem;
      }
      
      .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
      
      .table th, .table td {
        padding: 10px 8px;
        font-size: 0.9rem;
      }
    }
    
    @media (max-width: 576px) {
      .container {
        padding-left: 10px;
        padding-right: 10px;
      }
      
      .nav-pills .nav-link {
        font-size: 0.8rem;
        padding: 0.3rem 0.5rem;
        margin: 0 2px 5px;
      }
      
      .page-header h1 {
        font-size: 1.5rem;
      }
      
      .page-header p {
        font-size: 0.9rem;
      }
      
      .search-title, .table-title {
        font-size: 1.3rem;
      }
      
      .table th, .table td {
        padding: 8px 5px;
        font-size: 0.8rem;
      }
      
      .btn {
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
      }
    }
    
    /* تحسينات إضافية للتوافق مع الشاشات الصغيرة جدًا */
    @media (max-width: 400px) {
      .nav-pills .nav-link {
        font-size: 0.75rem;
        padding: 0.25rem 0.4rem;
      }
      
      .page-header h1 {
        font-size: 1.3rem;
      }
      
      .search-title, .table-title {
        font-size: 1.1rem;
      }
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
      <li class="nav-item"><a href="contact.php" class="nav-link">تسجيل التبرع</a></li>
      <li class="nav-item"><a href="donte.php" class="nav-link active" aria-current="page"> المتبرعين</a></li>
    </ul>
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img src="../logo.png" alt="شعار بنك الدم" class="logo"/>
    </a>
  </div>
</header>

<!-- صورة بعرض كامل الشاشة -->
<div class="full-width-container">
  <div class="page-header">
    <div class="page-header-content">
      <h1>البحث عن متبرعين</h1>
      <p>يمكنك البحث عن متبرعين حسب فصيلة الدم المطلوبة للمساعدة في إنقاذ الأرواح</p>
    </div>
  </div>
</div>

<div class="container">
  <div class="search-container">
    <h3 class="search-title">البحث عن متبرعين حسب فصيلة الدم</h3>
    <form method="GET">
      <div class="row mb-3">
        <div class="col-md-8 mb-3 mb-md-0">
          <select name="Fgroup" class="form-select">
            <option value="" selected>اختر فصيلة الدم</option>
            <option value="A+" <?php echo (isset($_GET['Fgroup']) && $_GET['Fgroup'] == 'A+') ? 'selected' : ''; ?>>A+</option>
            <option value="A-" <?php echo (isset($_GET['Fgroup']) && $_GET['Fgroup'] == 'A-') ? 'selected' : ''; ?>>A-</option>
            <option value="B+" <?php echo (isset($_GET['Fgroup']) && $_GET['Fgroup'] == 'B+') ? 'selected' : ''; ?>>B+</option>
            <option value="B-" <?php echo (isset($_GET['Fgroup']) && $_GET['Fgroup'] == 'B-') ? 'selected' : ''; ?>>B-</option>
            <option value="O+" <?php echo (isset($_GET['Fgroup']) && $_GET['Fgroup'] == 'O+') ? 'selected' : ''; ?>>O+</option>
            <option value="O-" <?php echo (isset($_GET['Fgroup']) && $_GET['Fgroup'] == 'O-') ? 'selected' : ''; ?>>O-</option>
            <option value="AB+" <?php echo (isset($_GET['Fgroup']) && $_GET['Fgroup'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
            <option value="AB-" <?php echo (isset($_GET['Fgroup']) && $_GET['Fgroup'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
          </select>
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-danger w-100">بحث</button>
        </div>
      </div>
    </form>
  </div>

  <div class="table-container">
    <h3 class="table-title">قائمة المتبرعين المتاحين</h3>
    
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>العمر</th>
            <th>الجنس</th>
            <th>مركز التبرع</th>
            <th>فصيلة الدم</th>
            <th>التاريخ</th>
            <th>الوقت</th>
            <th>رقم الاتصال</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // إعادة الاتصال بقاعدة البيانات للبحث
          include('connection.php');
          $q = "SELECT * FROM `regb`";
          $result = mysqli_query($db, $q);

          // التحقق من وجود مصطلح البحث
          $Fgroup = $_GET['Fgroup'] ?? null;
          $found = false;

          if ($Fgroup) {
            // تصفية النتائج بناءً على اختيار فصيلة الدم
            while ($row = mysqli_fetch_assoc($result)) {
              if ($row['Fgroup'] == $Fgroup) {
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
          } else {
            // عرض جميع الصفوف إذا لم يتم تطبيق عامل تصفية البحث
            $hasRows = false;
            while ($row = mysqli_fetch_assoc($result)) {
              $hasRows = true;
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
            
            if (!$hasRows) {
              echo "<tr><td colspan='7' class='text-center'>لا يوجد متبرعين مسجلين حالياً</td></tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- الترقيم -->
    <?php if (!$Fgroup): ?>
    <nav>
      <ul class="pagination">
        <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= $page - 1 ?>">السابق</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?= ($page == $total_pages) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= $page + 1 ?>">التالي</a>
        </li>
      </ul>
    </nav>
    <?php endif; ?>
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
            <button class="btn btn-danger" type="submit" name="subk">اشترك</button>
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
<?php
if (isset($_POST['subk'])) {
  
  $email = mysqli_real_escape_string($db, $_POST['email']);

  if (!empty($email)) {
      $q = "INSERT INTO `about_us` (`email`) VALUES ('$email')";
      $result = mysqli_query($db, $q);

      if ($result) {
          echo "<script>alert('✅ تم الاشتراك بنجاح! شكراً لك');</script>";
          
      } else {
          echo "<script>alert('❌ فشل في الاشتراك، يرجى المحاولة مرة أخرى');</script>";
      }
  }
}?>
