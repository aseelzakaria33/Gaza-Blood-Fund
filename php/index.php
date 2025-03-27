<?php
include('connection.php');

if(!$db){
  echo "فشل الاتصال بقاعدة البيانات";
}
?>

<!DOCTYPE html>
<html class="no-js" lang="ar" dir="rtl">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>بنك الدم - غزة</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/app.css">

<meta name="description" content="بنك الدم في غزة - تبرع بالدم وأنقذ حياة">

<meta property="og:title" content="بنك الدم - غزة">
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
  body {
    font-family: 'Tajawal', sans-serif;
    text-align: right;
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
  
  /* تنسيق القسم الرئيسي */
  .carousel-caption {
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px;
    border-radius: 10px;
  }
  
  .carousel-caption h1 {
    font-weight: 700;
    font-size: 2.5rem;
    color: #fff;
  }
  
  .btn-outline-danger {
    border-width: 2px;
    font-weight: 600;
    padding: 10px 25px;
    transition: all 0.3s ease;
  }
  
  .btn-outline-danger:hover {
    transform: scale(1.05);
  }
  
  /* تنسيق الأقسام */
  .colorh1 {
    color: #d32f2f;
    font-weight: 700;
  }
  
  .colorh2 {
    background-color: #ffebee;
    border-radius: 10px;
    border: 1px solid #ffcdd2;
  }
  
  .card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
  
  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
  }
  
  .card-header {
    background-color: #d32f2f;
    color: white;
    font-weight: 600;
  }
  
  .rounded-circle {
    width: 140px;
    height: 140px;
    object-fit: cover;
    margin: 0 auto 20px;
    border: 3px solid #d32f2f;
    transition: all 0.3s ease;
  }
  
  .rounded-circle:hover {
    transform: scale(1.1);
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
  
  /* تنسيق النوافذ المنبثقة */
  .popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 90%;
    max-width: 400px;
    background-color: white;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    z-index: 1000;
    display: none;
    overflow: hidden;
  }

  .popup-header {
    background-color: #d32f2f;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 20px;
    border-bottom: 2px solid #b71c1c;
  }

  .popup-body {
    padding: 20px;
  }

  .popup-body input {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
  }

  .popup-body input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #d32f2f;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .popup-body input[type="submit"]:hover {
    background-color: #b71c1c;
  }

  .popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: none;
  }

  .back-button {
    background-color: #757575;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
  }

  .back-button:hover {
    background-color: #616161;
  }

  .login-link, .register-link {
    text-align: center;
    margin-top: 15px;
    font-size: 16px;
  }

  .login-link a, .register-link a {
    color: #d32f2f;
    text-decoration: none;
    font-weight: bold;
  }

  .login-link a:hover, .register-link a:hover {
    text-decoration: underline;
  }
  
  /* تأثيرات إضافية */
  .feature-icon {
    color: #d32f2f;
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .step-number {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: #d32f2f;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
  }
  
  .step-container {
    position: relative;
    margin-bottom: 30px;
  }
  
  .blood-type {
    display: inline-block;
    background-color: #ffebee;
    color: #d32f2f;
    padding: 5px 15px;
    border-radius: 20px;
    font-weight: bold;
    margin: 5px;
    border: 1px solid #ffcdd2;
    transition: all 0.3s ease;
  }
  
  .blood-type:hover {
    background-color: #d32f2f;
    color: white;
  }
  
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
  .circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #A11717; /* محيط أحمر */
            box-shadow: 0 0 15px #A11717; /* ظل أحمر */
            background-color: white; /* خلفية بيضاء */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 900; /* خط غامق جدًا */
            color: darkred; /* لون الرقم أحمر غامق */
            margin: 50px auto;
        }
  .two{
    color:red;
    font-size: 20px;
}
.mt-n1 {
  margin-top: -0.37rem !important;
}
.fullscreen-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    /* height: 100%; */
    object-fit: cover;
    margin-left: -0.5rem !important;
    /* margin-right: -1rem !important; */

}

</style>
</head>

<body>
<header class="py-3 ">
  <div class="container d-flex flex-wrap justify-content-center">
    <ul class="nav nav-pills">
      <li class="nav-item"><a href="index.php" class="nav-link active" aria-current="page">الرئيسية</a></li>
      <li class="nav-item"><a href="about_us.php" class="nav-link"> المؤسسة</a></li>
      <li class="nav-item"><a href="blog.php" class="nav-link">المدونة</a></li>
      <li class="nav-item"><a href="contact.php" class="nav-link">تسجيل التبرع</a></li>
      <li class="nav-item"><a href="donte.php" class="nav-link"> المتبرعين</a></li>
    </ul>
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img src="../logo.png" alt="شعار بنك الدم" class="logo"/>
    </a>
  </div>
</header>
<div class="container">
</div>

<div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
  <div class="carousel-inner mt-n1" >
    <div class="carousel-item active" >
      <img src="../main-background.png" class="bd-placeholder-img fullscreen-img" alt="صورة بنك الدم"/>
      <div class="container">
        <div class="carousel-caption mb-5">
          <h1 class="mb-5">تبرع بالدم وأنقذ حياة</h1>
          <p class="mb-5 fs-4">تبرعك بالدم يمكن أن ينقذ حياة ثلاثة أشخاص<br>
            لا تتردد في مساعدة الأشخاص الذين يحتاجون إليك!</p>
          <p class="mb-5"><a class="btn btn-outline-danger text-light" href="#" onclick="showRegisterPopup()">سجل الآن</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container marketing">
  <section class="row featurette mb-5">
    <div class="col-md-7">
      <h2 class="fw-normal lh-1 mb-4 colorh1">لماذا تتبرع مع مؤسستنا؟</h2>
      <p>يوجد لدينا فريق طبي متخصص ومدرب على أعلى مستوى لضمان سلامة المتبرعين وجودة الدم المتبرع به
         و أيضا نستخدم أحدث التقنيات والمعدات الطبية لضمان عملية تبرع آمنة وفعالة لذلك  تبرعك بالدم يساهم في إنقاذ حياة المرضى والمصابين في غزة، خاصة في ظل الظروف الصعبة الحالية حيث انه كل يوم، يجد عشرات الملايين من الناس أنفسهم في وضع صعب بسبب الجوع والمرض الناجم عن الحرب العدوانية , وايضا هناك الكثير من الأطفال والكبار الذين فقدوا الدم بكميات كبيرة
      . يمكنك التبرع بالدم في جميع المستشفيات المتاحة.</p>
    </div>
    <div class="col-md-5">
      <img class="w-100 rounded shadow" src="../whygpf.jpeg" alt="صورة توضيحية">
    </div>
  </section>

    <section>
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal colorh1">نصائح للمتبرعين</h1>
      <p class="fs-5 text-body-secondary">إليك بعض النصائح الهامة التي يجب مراعاتها قبل وأثناء وبعد التبرع</p>
    </div>
    
        <div class="container text-center mt-5">
       
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-3">
                    <h5 class="card-title">اليوم السابق للتبرع</h5>
                    <hr style="border: 1px solid #8B0000;">
                    <ul class="text-end">
                        <li>اتباع نظام غذائي غني بالحديد مثل الفول والسبانخ أو اللحوم والدواجن.</li>
                        <li>الحصول على نوم مناسب لا يقل عن 8 ساعات.</li>
                        <li>إدخال المزيد من السوائل في نظامك الغذائي.</li>
                        <li>الابتعاد عن تناول الأدوية المميعة للدم.</li>
                        <li>الابتعاد عن تناول الأطعمة الدسمة.</li>
                        <li>إجراء فحص نسبة الهيموغلوبين في الدم.</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <h5 class="card-title">يوم التبرع</h5>
                    <hr style="border: 1px solid #8B0000;">
                    <ul class="text-end">
                        <li>تجنب الأنشطة الرياضية الشديدة قبل التبرع.</li>
                        <li>ارتداء ملابس مريحة بأكمام واسعة.</li>
                        <li>تناول وجبة صحية، وتجنب الأطعمة الدهنية.</li>
                        <li>الإكثار من شرب الماء قبل الذهاب للمركز.</li>
                        <li>احصل على دعم نفسي إن كنت متوترًا اثناء التبرغ</li>
                        <li>الاسترخاء ومحاولة تثبيت الانتباه أثناء التبرع.</li>
                       

                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-3">
                    <h5 class="card-title">بعد التبرع</h5>
                    <hr style="border: 1px solid #8B0000;" >
                    <ul class="text-end">
                        <li>الاحتفاظ بالضمادة الشريطية لعدة ساعات.</li>
                        <li>تجنب النشاط البدني الشاق أو رفع الأحمال الثقيلة.</li>
                        <li>الاستلقاء على الظهر عند الشعور بـ "الدوخة".</li>
                        <li>الإكثار من شرب السوائل</li>
                        <li>إذا بدأ موقع الإبرة بالنزيف،
                           ضع ضغطًا على الذراع ورفعها للأعلى.</li>
                           <li>الاحتفاظ بالضمادة الشريطية لعدة ساعات.</li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    
  </section>
  <section class="mb-5">
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal colorh1">خطوات التبرع</h1>
      <p class="fs-5 text-body-secondary">عملية بسيطة وسريعة لإنقاذ حياة الآخرين</p>
    </div>
    
    <div class="row">
      <div class="col-lg-4">
        <div class="step-container text-center">
          <div class="circle">1</div>

          <h4 class="fw-normal">تسجيل معلوماتك وتحديد موعد</h4>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="step-container text-center">
          <div class="circle">2</div>

          <h4 class="fw-normal">استلام رسالة تأكيد الموعد</h4>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="step-container text-center">
          <div class="circle">3</div>

          <h4 class="fw-normal">إجراء المقابلة الطبية</h4>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="step-container text-center">
          <div class="circle">4</div>

          <h4 class="fw-normal">الفحص السريري</h4>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="step-container text-center">
          <div class="circle">5</div>

          <h4 class="fw-normal">مرحلة سحب الدم</h4>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="step-container text-center">
          <div class="circle">6</div>

          <h4 class="fw-normal">الرعاية بعد التبرع والتثقيف الصحي</h4>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-5">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h2 class="colorh1 mb-4">حقائق عن التبرع بالدم</h2>
        <div class="mb-3 d-flex">
          <div class="me-3 text-danger">
            <i class=" ms-3 mt-2 fas fa-heartbeat fa-2x"></i>
          </div>
          <div>
            <h5>تبرع واحد ينقذ ثلاث أرواح</h5>
            <p>يمكن فصل وحدة الدم الواحدة إلى مكونات مختلفة تساعد ثلاثة أشخاص مختلفين.</p>
          </div>
        </div>
        <div class="mb-3 d-flex">
          <div class="me-3 text-danger">
            <i class="ms-3  mt-2 fas fa-sync-alt fa-2x"></i>
          </div>
          <div>
            <h5>يتجدد الدم بسرعة</h5>
            <p>يستعيد جسمك خلايا الدم الحمراء المفقودة خلال 4-6 أسابيع بعد التبرع.</p>
          </div>
        </div>
        <div class="mb-3 d-flex">
          <div class="me-3 text-danger">
            <i class=" ms-3  mt-2 fas fa-clock fa-2x"></i>
          </div>
          <div>
            <h5>عملية سريعة</h5>
            <p>تستغرق عملية التبرع بالدم حوالي 10-15 دقيقة فقط، بينما تستغرق الزيارة كاملة حوالي ساعة.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header bg-danger text-white py-3">
            <h4 class="m-0">إحصائيات مهمة</h4>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span>عدد المتبرعين هذا الشهر</span>
              <span class="badge bg-danger rounded-pill">1,245</span>
            </div>
            <div class="progress mb-4" style="height: 10px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span>الفصائل الأكثر احتياجاً</span>
              <span class="badge bg-danger rounded-pill">O- و A+</span>
            </div>
            <div class="progress mb-4" style="height: 10px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mb-3">
              <span>الحالات المستفيدة</span>
              <span class="badge bg-danger rounded-pill">3,720</span>
            </div>
            <div class="progress mb-4" style="height: 10px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<footer class="mb-0 mt-5 pt-5 text-white">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-1 mb-3">
        <form method="post" name="email">
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
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0"><span style='font-size:22px'></span><span class='two'> اتصل بنا </span>
          </a></li>
            <li class="nav-item mb-2"><a href="tel:+970599999999"  target="_blank" class="nav-link p-0">+970599999999</a></li>
            <li class="nav-item mb-2"><a href="mailto:GazaBF@gmail.com"  target="_blank" class="nav-link p-0">GazaBF@gmail.com</a></li>
          </ul>
        </div>
      </div>
      <div class="col-6 col-md-2 mb-3">
        <div class="d-flex">
          <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0"><span style='font-size:22px'></span><span class='two'> تابعنا</span>
          </a></li>
            <li class="nav-item mb-2"><i class="fab fa-facebook me-2"></i><a href="https://www.facebook.com/YourPage" target="_blank" class="nav-link p-0">فيسبوك</a></li>
            <li class="nav-item mb-2"><i class="fab fa-twitter me-2"></i><a href="https://www.twitter.com/YourProfile"  target="_blank" class="nav-link p-0">تويتر</a></li>
            <li class="nav-item mb-2"><i class="fab fa-instagram me-2"></i><a href="https://www.instagram.com/YourProfile" target="_blank"  class="nav-link p-0">انستغرام</a></li>
          </ul>
        </div>
      </div>
      <div class="d-flex flex-column flex-sm-row justify-content-between mx-5 mt-5">
        <p class="m-0">© صندوق دم غزة. جميع الحقوق محفوظة، 2025.</p>
      </div>
    </div>
  </div>
</footer>

<!-- الخلفية المنبثقة -->
<div class="popup-overlay" id="popupOverlay" onclick="hidePopup()"></div>

<!-- نافذة إنشاء الحساب -->
<div class="popup" id="registerPopup">
  <div class="popup-header">إنشاء حساب</div>
  <div class="popup-body">
    <form action="" method="post" id="registerForm">
      <input type="text" name="username" placeholder="اسم المستخدم" required>
      <input type="email" name="email" placeholder="البريد الإلكتروني" required>
      <input type="password" name="password" placeholder="كلمة المرور" required>
      <input type="password" name="confirm_password" placeholder="تأكيد كلمة المرور" required>
      <input type="submit" value="إنشاء حساب" name="sub">
    </form>
    <div class="login-link">
      <p>هل لديك حساب بالفعل؟ <a href="#" onclick="showLoginPopup()">تسجيل الدخول</a></p>
    </div>
    <a href="#" class="back-button" onclick="hidePopup()">رجوع</a>
  </div>
</div>

<!-- نافذة تسجيل الدخول -->
<div class="popup" id="loginPopup">
  <div class="popup-header">تسجيل الدخول</div>
  <div class="popup-body">
    <form action="" method="post">
      <input type="text" name="username" placeholder="اسم المستخدم" required>
      <input type="password" name="password" placeholder="كلمة المرور" required>
      <input type="submit" value="تسجيل الدخول" name="sub2">
    </form>
    <div class="register-link">
      <p>ليس لديك حساب؟ <a href="#" onclick="showRegisterPopup()">إنشاء حساب</a></p>
    </div>
    <a href="#" class="back-button" onclick="hidePopup()">رجوع</a>
  </div>
</div>

<script>
  function showLoginPopup() {
    document.getElementById('popupOverlay').style.display = 'block';
    document.getElementById('loginPopup').style.display = 'block';
    document.getElementById('registerPopup').style.display = 'none';
  }

  function showRegisterPopup() {
    document.getElementById('popupOverlay').style.display = 'block';
    document.getElementById('registerPopup').style.display = 'block';
    document.getElementById('loginPopup').style.display = 'none';
  }

  function hidePopup() {
    document.getElementById('popupOverlay').style.display = 'none';
    document.getElementById('loginPopup').style.display = 'none';
    document.getElementById('registerPopup').style.display = 'none';
  }

  function switchToLogin(event) {
    event.preventDefault();
    hidePopup();
    showLoginPopup();
  }
</script>

<script src="../js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset($_POST['sub'])) {
  // التحقق من تعبئة جميع الحقول
  if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      // التحقق من تطابق كلمات المرور
      if ($password !== $confirm_password) {
          echo "<script>alert('❌ كلمات المرور غير متطابقة');</script>";
      } else {
          $q = "INSERT INTO `reg`(`username`, `email`, `password`, `confirm_password`) 
              VALUES ('$username', '$email', '$password', '$confirm_password')";

          $result = mysqli_query($db, $q);

          if ($result) {
              echo "<script>
                      alert('✅ تم التسجيل بنجاح! سيتم تحويلك إلى تسجيل الدخول.');
                      document.addEventListener('DOMContentLoaded', function() {
                          showLoginPopup();
                      });
                    </script>";
          } else {
              echo "<script>alert('❌ فشل في التسجيل: " . mysqli_error($db) . "');</script>";
          }
      }
  } else {
      echo "<script>alert('❌ من فضلك تأكد من تعبئة كافة الحقول.');</script>";
  }
}

if (isset($_POST['sub2'])) {
  // التحقق من تعبئة حقول تسجيل الدخول
  if (isset($_POST['username']) && isset($_POST['password'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];

      // أولاً، نتحقق إذا كان المستخدم هو مدير النظام
      $admin_query = "SELECT * FROM `admin` WHERE `uname` = '$username' AND `pass` = '$password'";
      $admin_result = mysqli_query($db, $admin_query);

      if (mysqli_num_rows($admin_result) > 0) {
          // إذا كان المستخدم مدير نظام
          $admin_data = mysqli_fetch_assoc($admin_result);
          $_SESSION['un'] = $admin_data['username'];
          $_SESSION['is_admin'] = true;
          
          echo "<script>
                  alert('✅ تم تسجيل الدخول بنجاح! سيتم تحويلك إلى لوحة التحكم.');
                  window.location.href = '../admin/dashboard.php';
                </script>";
      } else {
          // إذا لم يكن مدير نظام، نتحقق إذا كان مستخدم عادي
          $user_query = "SELECT * FROM `reg` WHERE `username` = '$username' AND `password` = '$password'";
          $user_result = mysqli_query($db, $user_query);

          if (mysqli_num_rows($user_result) > 0) {
              // إذا كان مستخدم عادي
              $user_data = mysqli_fetch_assoc($user_result);
              $_SESSION['un'] = $user_data['username'];
              $_SESSION['user_id'] = $user_data['id'];
              $_SESSION['is_admin'] = false;
              
              echo "<script>
                      alert('✅ تم تسجيل الدخول بنجاح! سيتم تحويلك إلى صفحة التبرع.');
                      window.location.href = 'contact.php';
                    </script>";
          } else {
              echo "<script>alert('❌ اسم المستخدم أو كلمة المرور غير صحيحة.');</script>";
          }
      }
  } else {
      echo "<script>alert('❌ من فضلك تأكد من تعبئة كافة الحقول.');</script>";
  }
}

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
}
?>

