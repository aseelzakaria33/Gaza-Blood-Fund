<!doctype html>
<html class="no-js" lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>المدونة - بنك الدم غزة</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/app.css">

  <meta name="description" content="بنك الدم في غزة - تبرع بالدم وأنقذ حياة">

  <meta property="og:title" content="المدونة - بنك الدم غزة">
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
  .info-item {
    padding: 10px;
  }
  
  .info-item p {
    font-size: 0.9rem;
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
    
    /* تنسيق البانر */
    .blog-banner {
      position: relative;
      border-radius: 10px;
      overflow: hidden;
      margin-bottom: 40px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .blog-banner img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }
    
    .blog-banner-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    
    .blog-banner-overlay h2 {
      color: white;
      font-weight: 700;
      font-size: 2rem;
      text-align: center;
    }
    
    /* تنسيق قسم المعلومات */
    .section-information {
      margin-bottom: 50px;
    }
    
    .info-item {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      /* background-color: #ffebee; */
      padding: 15px;
      /* border-radius: 10px; */
      transition: all 0.3s ease;
    }
    
    .info-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .info-item img {
      width: 40px;
      height: 40px;
      margin-left: 15px;
    }
    
    .info-item p {
      margin: 0;
      font-size: 1.1rem;
    }
    
    /* تنسيق أقسام المحتوى */
    .content-section {
      margin-bottom: 60px;
    }
    
    .section-title {
      color: #d32f2f;
      font-weight: 700;
      margin-bottom: 30px;
      text-align: center;
      position: relative;
    }
    
    /* .section-title::after {
      content: "";
      position: absolute;
      bottom: -10px;
      right: 50%;
      transform: translateX(50%);
      width: 80px;
      height: 3px;
      background-color: #d32f2f;
    } */
    
    .content-list {
      padding-right: 20px;
    }
    
    .content-list li {
      margin-bottom: 15px;
      font-size: 1.1rem;
      position: relative;
    }
    
    .content-list li::before {
      content: "\f058";
      font-family: "Font Awesome 5 Free";
      font-weight: 900;
      color: #d32f2f;
      position: absolute;
      right: -25px;
    }
    
    .content-image {
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    
    .content-image:hover {
      transform: scale(1.02);
    }
    
    /* تنسيق فصائل الدم */
    .blood-types-section {
      margin-bottom: 60px;
    }
    
    .blood-type-card {
      transition: all 0.3s ease;
      margin-bottom: 20px;
    }
    
    .blood-type-card:hover {
      transform: translateY(-10px);
    }
    
    .blood-type-card img {
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
    .two{
    color:red;
    font-size: 20px;
}
.mr-n1 {
  margin-right: 4rem !important;
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

  <header class="py-3">
    <div class="container d-flex flex-wrap justify-content-center">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="index.php" class="nav-link">الرئيسية</a></li>
        <li class="nav-item"><a href="about_us.php" class="nav-link"> المؤسسة</a></li>
        <li class="nav-item"><a href="blog.php" class="nav-link active" aria-current="page">المدونة</a></li>
        <li class="nav-item"><a href="contact.php" class="nav-link">تسجيل التبرع</a></li>
        <li class="nav-item"><a href="donte.php" class="nav-link">المتبرعين </a></li>
      </ul>
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img src="../logo.png" alt="شعار بنك الدم" class="logo"/>
    </a>
    </div>
  </header>
  <div class="container">
</div>

<div class="container">
</div>

<!-- صورة بعرض كامل الشاشة -->
<div class="full-width-container">
   <div class="blog-banner">
     <img src="../bg-blod.png" alt="صورة التبرع بالدم">
     <div class="blog-banner-overlay">
       <h2>التبرع بالدم يساعد ضحايا الحرب على البقاء على قيد الحياة</h2>
     </div>
   </div>
</div>

<div class="container">
<section class="section-information  ">
      <h3 class="section-title mb-4">فوائد التبرع بالدم</h3>
      
      <div class="row justify-content-center" >
        <div class="col-md-8">
          <div class="info-item">
            <img src="../Group 52.png" alt="أيقونة">
            <p>يقلل من خطر الإصابة بالسرطان</p>
          </div>
          
          <div class="info-item">
            <img src="../Group 355.png" alt="أيقونة">
            <p>يساعد في تجديد خلايا الدم وتنشيط الدورة الدموية</p>
          </div>
          
          <div class="info-item">
            <img src="../Group 356.png" alt="أيقونة">
            <p>يقلل من خطر الإصابة بأمراض القلب والأوعية الدموية</p>
          </div>
          
          <div class="info-item">
            <img src="../Group 357.png" alt="أيقونة">
            <p>يساعد في الكشف المبكر عن بعض الأمراض من خلال الفحوصات الروتينية</p>
          </div>
        </div>
      </div>
    </section>

   <section class="content-section ">
     <h3 class="section-title">شروط التبرع </h3>
     <div class="row align-items-center mr-n1">
       <div class="col-md-7">
         <ul class="content-list list-unstyled">
           <li>أن تكون بصحة جيدة بشكل عام</li>
           <li>أن يتراوح عمرك بين 17 و 65 عامًا</li>
           <li>أن يتراوح وزنك بين 50 كجم و 158 كجم</li>
           <li>ألا تكون قد أصبت بالحمى خلال الأسابيع الأربعة الماضية</li>
           <li>ألا تكون قد تبرعت بالدم خلال الـ 56 يومًا الماضية</li>
           <li>ألا تكون قد تناولت أدوية معينة خلال فترة محددة قبل التبرع</li>
         </ul>
       </div>
       <div class="col-md-5">
         <img class="content-image img-fluid" src="../blogImg2.png" alt="من يمكنه التبرع بالدم">
       </div>
     </div>
   </section>

   <section class="content-section ">
     <h3 class="section-title">موانع التبرع </h3>
     <div class="row align-items-center mr-n1">
       <div class="col-md-7">
         <ul class="content-list list-unstyled">
           <li>الإصابة بأمراض معدية مثل الإيدز أو التهاب الكبد الوبائي</li>
           <li>انخفاض نسبة الهيموجلوبين في الدم</li>
           <li>ارتفاع أو انخفاض ضغط الدم بشكل كبير</li>
           <li>الإصابة بأمراض القلب الخطيرة</li>
           <li>الحمل أو الرضاعة الطبيعية</li>
           <li>إجراء عمليات جراحية كبرى خلال الستة أشهر الماضية</li>
         </ul>
       </div>
       <div class="col-md-5">
         <img class="content-image img-fluid" src="../blogImg3.png" alt="موانع التبرع بالدم">
       </div>
     </div>
   </section>

   <section class="blood-types-section ">
     <h3 class="section-title mb-5">فصائل الدم</h3>
     <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 justify-content-center">
       <div class="col">
         <div class="blood-type-card text-center">
           <a href="../list_F/a+.php?A=<?php echo urlencode('A+'); ?>">
             <img class="img-fluid" src="../images/a+.png" alt="فصيلة A+">
           </a>
         </div>
       </div>
       
       <div class="col">
         <div class="blood-type-card text-center">
           <a href="../list_F/a-.php?AS=<?php echo urlencode('A-'); ?>">
             <img class="img-fluid" src="../images/a-.png" alt="فصيلة A-">
           </a>
         </div>
       </div>

       <div class="col">
         <div class="blood-type-card text-center">
           <a href="../list_F/b+.php?B=<?php echo urlencode('B+'); ?>">
             <img class="img-fluid" src="../images/b+.png" alt="فصيلة B+">
           </a>
         </div>
       </div>

       <div class="col">
         <div class="blood-type-card text-center">
           <a href="../list_F/b-.php?BS=<?php echo urlencode('B-'); ?>">
             <img class="img-fluid" src="../images/b-.png" alt="فصيلة B-">
           </a>
         </div>
       </div>
       
       <div class="col">
         <div class="blood-type-card text-center">
           <a href="../list_F/ab+.php?AB=<?php echo urlencode('AB+'); ?>">
             <img class="img-fluid" src="../images/ab+.png" alt="فصيلة AB+">
           </a>
         </div>
       </div>

       <div class="col">
         <div class="blood-type-card text-center">
           <a href="../list_F/ab-.php?ABS=<?php echo urlencode('AB-'); ?>">
             <img class="img-fluid" src="../images/ab-.png" alt="فصيلة AB-">
           </a>
         </div>
       </div>

       <div class="col">
         <div class="blood-type-card text-center">
           <a href="../list_F/o+.php?O=<?php echo urlencode('O+'); ?>">
             <img class="img-fluid" src="../images/o+.png" alt="فصيلة O+">
           </a>
         </div>
       </div>
       
       <div class="col">
         <div class="blood-type-card text-center">
           <a href="../list_F/o-.php?O=<?php echo urlencode('O-'); ?>">
             <img class="img-fluid" src="../images/o-.png" alt="فصيلة O-">
           </a>
         </div>
       </div>
     </div>
   </section>

   <section class="content-section">
     <h3 class="section-title">معلومات هامة عن التبرع بالدم</h3>
     
     <div class="row mb-4">
       <div class="col-md-6">
         <div class="card h-100 shadow-sm">
           <div class="card-header bg-danger text-white">
             <h5 class="m-0">كمية الدم المتبرع بها</h5>
           </div>
           <div class="card-body">
             <p>يتم سحب حوالي 450 مل من الدم خلال عملية التبرع العادية، وهي كمية آمنة لا تؤثر على صحة المتبرع. يستعيد الجسم السوائل المفقودة خلال ساعات، بينما يستغرق تجديد خلايا الدم الحمراء حوالي 4-6 أسابيع.</p>
           </div>
         </div>
       </div>
       
       <div class="col-md-6">
         <div class="card h-100 shadow-sm">
           <div class="card-header bg-danger text-white">
             <h5 class="m-0">مدة عملية التبرع</h5>
           </div>
           <div class="card-body">
             <p>تستغرق عملية التبرع بالدم حوالي 10-15 دقيقة فقط، بينما تستغرق الزيارة كاملة بما في ذلك التسجيل والفحص الطبي والراحة بعد التبرع حوالي ساعة واحدة.</p>
           </div>
         </div>
       </div>
     </div>
     
     <div class="row">
       <div class="col-md-6">
         <div class="card h-100 shadow-sm">
           <div class="card-header bg-danger text-white">
             <h5 class="m-0">الفترة بين التبرعات</h5>
           </div>
           <div class="card-body">
             <p>يمكن للشخص السليم التبرع بالدم كل 56 يومًا (حوالي شهرين). هذه الفترة ضرورية للسماح للجسم باستعادة خلايا الدم الحمراء المفقودة بشكل كامل.</p>
           </div>
         </div>
       </div>
       
       <div class="col-md-6">
         <div class="card h-100 shadow-sm">
           <div class="card-header bg-danger text-white">
             <h5 class="m-0">الاستخدامات الطبية للدم</h5>
           </div>
           <div class="card-body">
             <p>يستخدم الدم المتبرع به في العديد من الحالات الطبية مثل: عمليات الجراحة الكبرى، حالات النزيف الشديد، علاج مرضى السرطان، علاج أمراض الدم المزمنة، حالات الولادة المعقدة، وعلاج الإصابات الناتجة عن الحوادث.</p>
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

