<?php
include('connection.php');
if(!$db){
   echo "فشل الاتصال بقاعدة البيانات";
}
?>
<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>عن مؤسستنا - بنك الدم غزة</title>
 <link rel="stylesheet" href="../css/style.css">
 <link rel="stylesheet" href="../css/app.css">

 <meta name="description" content="بنك الدم في غزة - تبرع بالدم وأنقذ حياة">

 <meta property="og:title" content="عن مؤسستنا - بنك الدم غزة">
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
   /* تنسيقات عامة */4
   @media (max-width: 400px) {
  .card-body {
    padding: 10px;
  }
  
  .card-title {
    font-size: 1rem;
  }
}
   body {
     font-family: 'Tajawal', sans-serif;
     text-align: right;
     background-color: #FFFFFF;
     overflow-x: hidden;
     width: 100%;
     margin: 0;
     padding: 0;
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
   
   /* تنسيق حاوية بعرض كامل الشاشة */
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
   
   /* تنسيق البانر */
   .banner {
     background-color: #ffebee;
     padding: 40px 20px;
     margin-bottom: 40px;
     text-align: center;
     border-bottom: 4px solid #d32f2f;
     box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
     width: 100%;
   }
   
   .banner h5 {
     color: #d32f2f;
     font-weight: 700;
     font-size: 1.5rem;
     line-height: 1.6;
   }
   
   /* تنسيق الأقسام */
   .section-title {
     color: #d32f2f;
     font-weight: 700;
     margin-bottom: 20px;
     position: relative;
     padding-right: 15px;
   }
   
   .section-title::before {
     content: "";
     position: absolute;
     right: 0;
     top: 50%;
     transform: translateY(-50%);
     width: 5px;
     height: 25px;
     background-color: #d32f2f;
     border-radius: 5px;
   }
   
   .section-content {
     line-height: 1.8;
     font-size: 1.1rem;
   }
   
   .section-image {
     border-radius: 10px;
     box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
     transition: transform 0.3s ease;
   }
   
   .section-image:hover {
     transform: scale(1.02);
   }
   
   /* تنسيق نموذج الاتصال */
   .contact-card {
     border: none;
     border-radius: 10px;
     overflow: hidden;
     box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
   }
   
   .contact-card .card-header {
     background-color: #d32f2f;
     color: white;
     font-weight: 600;
     padding: 15px;
     text-align: center;
     font-size: 1.2rem;
   }
   
   .contact-card .card-body {
     padding: 25px;
   }
   
   .contact-card .form-control {
     padding: 12px;
     margin-bottom: 15px;
     border: 1px solid #e0e0e0;
     border-radius: 5px;
   }
   
   .contact-card .form-control:focus {
     border-color: #d32f2f;
     box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25);
   }
   
   .contact-card .btn {
     background-color: #d32f2f;
     border: none;
     padding: 12px;
     font-weight: 600;
     transition: all 0.3s ease;
   }
   
   .contact-card .btn:hover {
     background-color: #b71c1c;
     transform: translateY(-2px);
   }
   
   /* تنسيق معلومات الاتصال */
   .contact-info {
     margin-bottom: 30px;
   }
   
   .contact-info-item {
     display: flex;
     align-items: center;
     margin-bottom: 15px;
   }
   
   .contact-info-item i {
     color: #d32f2f;
     font-size: 1.2rem;
     margin-left: 15px;
     width: 25px;
     text-align: center;
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
   
   /* تأثيرات إضافية */
   .highlight-box {
     background-color: #ffebee;
     border-radius: 10px;
     padding: 30px;
     margin: 30px 0;
     border-right: 4px solid #d32f2f;
   }
   
   .highlight-box h5 {
     color: #d32f2f;
     font-weight: 600;
     margin-bottom: 10px;
   }
   
   .highlight-box p {
     margin-bottom: 0;
   }
   
   .section-divider {
     height: 2px;
     background-color: #f5f5f5;
     margin: 40px 0;
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
   .two{
   color:red;
   font-size: 20px;
}

   /* تحسين استجابة الهيدر للشاشات المختلفة */
   @media (max-width: 992px) {
     .banner h5 {
       font-size: 1.3rem;
     }
     
     .section-title {
       font-size: 1.3rem;
     }
     
     .section-content {
       font-size: 1rem;
     }
   }
   
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
     
     .banner {
       padding: 30px 15px;
     }
     
     .banner h5 {
       font-size: 1.2rem;
     }
   }

   @media (max-width: 576px) {
     .nav-pills .nav-link {
       font-size: 0.8rem;
       padding: 0.3rem 0.5rem;
       margin: 0 2px;
     }
     
     .banner {
       padding: 20px 10px;
     }
     
     .banner h5 {
       font-size: 1.1rem;
     }
     
     .section-content {
       font-size: 0.9rem;
     }
     
     .highlight-box {
       padding: 20px;
     }
     
     .highlight-box h5 {
       font-size: 1rem;
     }
   }
 </style>
</head>
<body>

<header class="py-3">
 <div class="container d-flex flex-wrap justify-content-center">
   <ul class="nav nav-pills">
     <li class="nav-item"><a href="index.php" class="nav-link">الرئيسية</a></li>
     <li class="nav-item"><a href="about_us.php" class="nav-link active" aria-current="page"> المؤسسة</a></li>
     <li class="nav-item"><a href="blog.php" class="nav-link">المدونة</a></li>
     <li class="nav-item"><a href="contact.php" class="nav-link">تسجيل التبرع</a></li>
     <li class="nav-item"><a href="donte.php" class="nav-link"> المتبرعين</a></li>
   </ul>
   <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
     <img src="../logo.png" alt="شعار بنك الدم" class="logo"/>
   </a>
 </div>
</header>

<!-- صورة بعرض كامل الشاشة -->
<div class="full-width-container">
  <div class="banner">
    <h5>نبذل كل ما هو ممكن وغير ممكن<br>
      حتى يتمكن الجميع من الحصول على المساعدة التي يحتاجونها.</h5>
  </div>
</div>

<div class="container">
 <div class="row align-items-center mb-5">
   <!-- النص -->
   <div class="col-md-6">
     <h4 class="section-title">رسالتنا</h4>
     <p class="section-content">
       كل يوم، يجد عشرات الملايين من الناس أنفسهم في وضع صعب بسبب الجوع والمرض
       الناجم عن الحرب العدوانية. نحن نساعد جميع ضحايا الحرب الذين يحتاجون إلى الدم، حيث يوجد العديد من الأطفال والبالغين الذين
       فقدوا الدم بكميات كبيرة. يمكنك التبرع بالدم في جميع المستشفيات المتاحة، ويمكنك أيضًا الاتصال بنا
       وحجز موعد للتبرع.
     </p>
     <div class="highlight-box">
       <h5>حقيقة مهمة</h5>
       <p>تبرع واحد بالدم يمكن أن ينقذ حياة ثلاثة أشخاص مختلفين.</p>
     </div>
   </div>
   <!-- الصورة -->
   <div class="col-md-6">
     <img src="../whygpf.jpeg" class="img-fluid section-image" alt="التبرع بالدم">
   </div>
 </div>

 <div class="section-divider"></div>

 <div class="row align-items-center mb-5">
   <!-- الصورة -->
   <div class="col-md-6">
     <img src="../Untitled.png" class="img-fluid section-image" alt="التبرع بالدم">
   </div>
   <!-- النص -->
   <div class="col-md-6">
     <h4 class="section-title">رؤيتنا</h4>
     <p class="section-content">
       تسعى مؤسسة بنك الدم في غزة دائمًا لمساعدة أكبر عدد ممكن من الناس. من خلال توحيد جهودنا، يمكننا مساعدة ملايين الأشخاص
       من جميع الأعمار الذين يحتاجون إلينا وتوفير الظروف المناسبة التي يمكنهم العيش فيها.
     </p>
     <div class="highlight-box">
       <h5>التزامنا</h5>
       <p>نحن لا نتقاضى أي رسوم مقابل التبرع بالدم. أنقذ الأرواح دون تكلفة.</p>
     </div>
   </div>
 </div>

 <div class="section-divider"></div>

 <div class="row mb-5">
   <!-- معلومات الاتصال -->
   <div class="col-md-6">
     <h4 class="section-title">هل لديك أي استفسارات؟</h4>
     <p class="section-content mb-4">
       لا تتردد في الاتصال بنا إذا كنت بحاجة إلى أي مساعدة. يمكنك إرسال رسالة هنا وسنرد عليك في أقرب وقت ممكن.
       يمكنك الاتصال بالرقم المباشر أو التواصل عبر البريد الإلكتروني:
     </p>
     <div class="contact-info">
       <div class="contact-info-item">
         <i class="fas fa-phone-alt"></i>
         <span class="fw-bold">+970599999999</span>
       </div>
       <div class="contact-info-item">
         <i class="fas fa-envelope"></i>
         <span class="fw-bold">GazaBF@gmail.com</span>
       </div>
       <div class="contact-info-item">
         <i class="fas fa-map-marker-alt"></i>
         <span class="fw-bold">غزة، فلسطين</span>
       </div>
     </div>
     
     <div class="highlight-box">
       <h5>ساعات العمل</h5>
       <p>من السبت إلى الخميس: 8:00 صباحًا - 8:00 مساءً<br>
       الجمعة: 10:00 صباحًا - 6:00 مساءً</p>
     </div>
   </div>

   <!-- نموذج الاتصال -->
   <div class="col-md-6">
     <div class="contact-card card">
       <div class="card-header">
         اتصل بنا
       </div>
       <div class="card-body">
         <form action="" method="POST">
           <input type="text" class="form-control" name="name" placeholder="الاسم" required>
           <input type="text" class="form-control" placeholder="رقم الهاتف" name="phone" required>
           <input type="email" class="form-control" placeholder="البريد الإلكتروني" name="email" required>
           <textarea class="form-control" placeholder="رسالتك" name="message" rows="4" required></textarea>
           <input type="submit" name="sub" class="btn text-white w-100" value="إرسال">
         </form>
       </div>
     </div>
   </div>
 </div>

 <div class="section-divider"></div>

 <div class="row mb-5">
   <div class="col-12 text-center">
     <h4 class="mb-4 colorh1">فريقنا الطبي</h4>
     <p class="mb-5">يتكون فريقنا من أطباء وممرضين متخصصين ذوي خبرة عالية في مجال التبرع بالدم</p>
     
     <div class="row">
       <div class="col-md-4 mb-4">
         <div class="card h-100 shadow-sm">
           <div class="card-body text-center">
             <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
               <i class="fas fa-user-md fa-3x text-danger"></i>
             </div>
             <h5 class="card-title mt-3">د. محمد أحمد</h5>
             <p class="card-text text-muted">مدير طبي</p>
             <p class="card-text">خبرة أكثر من 15 عامًا في مجال أمراض الدم والتبرع بالدم</p>
           </div>
         </div>
       </div>
       
       <div class="col-md-4 mb-4">
         <div class="card h-100 shadow-sm">
           <div class="card-body text-center">
             <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
               <i class="fas fa-user-nurse fa-3x text-danger"></i>
             </div>
             <h5 class="card-title mt-3">أ. سارة خالد</h5>
             <p class="card-text text-muted">رئيسة التمريض</p>
             <p class="card-text">متخصصة في إدارة عمليات التبرع بالدم وتدريب الكوادر الطبية</p>
           </div>
         </div>
       </div>
       
       <div class="col-md-4 mb-4">
         <div class="card h-100 shadow-sm">
           <div class="card-body text-center">
             <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
               <i class="fas fa-microscope fa-3x text-danger"></i>
             </div>
             <h5 class="card-title mt-3">د. أحمد محمود</h5>
             <p class="card-text text-muted">مسؤول المختبر</p>
             <p class="card-text">خبير في تحليل وحفظ عينات الدم وضمان جودتها وسلامتها</p>
           </div>
         </div>
       </div>
     </div>
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
           <input id="newsletter1" type="text" class="form-control" placeholder="البريد الإلكتروني">
           <button class="btn btn-danger" type="button">اشترك</button>
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

<script src="../js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
       integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
       crossorigin="anonymous"></script>
</body>
</html>
<?php
if (isset($_POST['sub'])) {
   $name = mysqli_real_escape_string($db, $_POST['name']);
   $phone = mysqli_real_escape_string($db, $_POST['phone']);
   $email = mysqli_real_escape_string($db, $_POST['email']);
   $message = mysqli_real_escape_string($db, $_POST['message']);

   if (!empty($name) && !empty($phone) && !empty($email) && !empty($message)) {
       $q = "INSERT INTO `about_us` (`name`, `phone`, `email`, `message`) VALUES ('$name', '$phone', '$email', '$message')";
       $result = mysqli_query($db, $q);

       if ($result) {
           echo "<script>alert('✅ تم إرسال رسالتك بنجاح، سنتواصل معك قريباً');</script>";
           
       } else {
           echo "<script>alert('❌ فشل في إرسال الرسالة، يرجى المحاولة مرة أخرى');</script>";
       }
   } else {
       echo "<script>alert('❌ يرجى ملء جميع الحقول المطلوبة');</script>";
   }
}
?>

