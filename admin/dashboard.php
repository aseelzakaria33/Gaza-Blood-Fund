<?php
include('connection.php');
session_start();

// التأكد من أن المستخدم مسجل الدخول
if (!isset($_SESSION['un'])) {
    header("location:loginadmin.php"); // توجيه المستخدم إلى صفحة تسجيل الدخول إذا لم يكن مسجل الدخول
    exit();
}

// حساب إحصائيات النظام
$donor_query = "SELECT * FROM `regb`";
$donor_result = mysqli_query($db, $donor_query);
$donor_count = mysqli_num_rows($donor_result);

// حساب عدد فصائل الدم المختلفة
$blood_types_query = "SELECT Fgroup, COUNT(*) as count FROM `regb` GROUP BY Fgroup";
$blood_types_result = mysqli_query($db, $blood_types_query);
$blood_types = [];
while ($row = mysqli_fetch_assoc($blood_types_result)) {
    $blood_types[$row['Fgroup']] = $row['count'];
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم مسؤول بنك الدم</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* تنسيق عام */
        body {
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        /* تنسيق رأس الصفحة */
        #header {
            background-color: #d32f2f;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        #header h2 {
            margin: 0;
            font-weight: 700;
        }

        /* تنسيق شريط التنقل الجانبي */
        #sidebar {
            width: 250px;
            height: 100vh;
            background-color: #263238;
            color: #fff;
            position: fixed;
            top: 0;
            right: 0;
            padding-top: 80px;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        }

        #sidebar .user-info {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        #sidebar .user-info .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #d32f2f;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        #sidebar .user-info .user-avatar i {
            font-size: 40px;
            color: white;
        }

        #sidebar .user-info h4 {
            margin: 10px 0 5px;
            color: #fff;
        }

        #sidebar .user-info p {
            margin: 0;
            color: #b0bec5;
            font-size: 14px;
        }

        #sidebar a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #b0bec5;
            font-size: 16px;
            transition: all 0.3s ease;
            border-right: 3px solid transparent;
        }

        #sidebar a i {
            margin-left: 10px;
            width: 20px;
            text-align: center;
        }

        #sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-right-color: #d32f2f;
        }

        #sidebar a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-right-color: #d32f2f;
        }

        /* محتوى الصفحة الرئيسية */
        #content {
            margin-right: 250px;
            margin-top: 80px;
            padding: 20px;
        }

        .welcome-message {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-message h3 {
            color: #d32f2f;
            margin-top: 0;
            font-weight: 700;
            font-size: 24px;
        }

        .welcome-message p {
            color: #555;
            margin-bottom: 0;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .stat-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 15px;
        }

        .stat-card .icon i {
            font-size: 30px;
            color: white;
        }

        .stat-card .info h4 {
            margin: 0 0 5px;
            color: #555;
            font-size: 16px;
        }

        .stat-card .info .count {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .stat-card.donors .icon {
            background-color: #d32f2f;
        }

        .stat-card.blood-bags .icon {
            background-color: #2196f3;
        }

        .stat-card.centers .icon {
            background-color: #4caf50;
        }

        .blood-types-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .blood-types-container h3 {
            color: #d32f2f;
            margin-top: 0;
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .blood-types-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .blood-type-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            border: 1px solid #e9ecef;
        }

        .blood-type-card h4 {
            margin: 0 0 10px;
            color: #d32f2f;
            font-size: 24px;
            font-weight: 700;
        }

        .blood-type-card p {
            margin: 0;
            color: #555;
            font-size: 14px;
        }

        .blood-type-card .count {
            font-size: 20px;
            font-weight: 700;
            color: #333;
        }

        .quick-actions {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .quick-actions h3 {
            color: #d32f2f;
            margin-top: 0;
            font-weight: 700;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .action-card i {
            font-size: 30px;
            color: #d32f2f;
            margin-bottom: 15px;
        }

        .action-card h4 {
            margin: 0 0 10px;
            color: #333;
            font-size: 16px;
        }

        .action-card p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .action-card a {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 15px;
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .action-card a:hover {
            background-color: #b71c1c;
        }

        /* استجابة للموبايل */
        @media (max-width: 992px) {
            #sidebar {
                width: 200px;
            }
            #content {
                margin-right: 200px;
            }
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 0;
                overflow: hidden;
                transition: width 0.3s ease;
            }
            #sidebar.active {
                width: 250px;
            }
            #content {
                margin-right: 0;
            }
            .toggle-sidebar {
                display: block;
            }
        }

        .toggle-sidebar {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #d32f2f;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 5px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1001;
        }

        .toggle-sidebar i {
            font-size: 20px;
        }
    </style>
</head>
<body>

    <!-- رأس الصفحة -->
    <div id="header">
        <h2>لوحة تحكم مسؤول بنك الدم</h2>
    </div>

    <button class="toggle-sidebar" id="toggleSidebar">
        <i class="fas fa-bars"></i>
    </button>

    <!-- الشريط الجانبي -->
    <div id="sidebar">
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h4><?php echo $_SESSION['un']; ?></h4>
            <p>مدير النظام</p>
        </div>
        <a href="dashboard.php" class="active"><i class="fas fa-home"></i> الرئيسية</a>
        <a href="list_donor.php"><i class="fas fa-users"></i> إدارة المتبرعين</a>
        <a href="donor-red.php"><i class="fas fa-user-plus"></i> إضافة متبرع</a>
        <!-- <a href="#"><i class="fas fa-tint"></i> إدارة أكياس الدم</a> -->
        <!-- <a href="#"><i class="fas fa-chart-bar"></i> التقارير والإحصائيات</a> -->
        <!-- <a href="#"><i class="fas fa-cog"></i> الإعدادات</a> -->
        <a href="../php/index.php"><i class="fas fa-globe"></i> الموقع الرئيسي</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
    </div>

    <!-- محتوى الصفحة الرئيسية -->
    <div id="content">
        <div class="welcome-message">
            <h3>مرحباً بك، <?php echo $_SESSION['un']; ?>!</h3>
            <p>مرحباً بك في لوحة تحكم نظام إدارة بنك الدم. يمكنك من هنا إدارة المتبرعين، ومتابعة المخزون، وعرض التقارير.</p>
        </div>

        <div class="stats-container">
            <div class="stat-card donors">
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="info">
                    <h4>إجمالي المتبرعين</h4>
                    <p class="count"><?php echo $donor_count; ?></p>
                </div>
            </div>
            <div class="stat-card blood-bags">
                <div class="icon">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="info">
                    <h4>أكياس الدم المتاحة</h4>
                    <p class="count"><?php echo $donor_count; ?></p>
                </div>
            </div>
            <div class="stat-card centers">
                <div class="icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <div class="info">
                    <h4>مراكز التبرع</h4>
                    <p class="count">4</p>
                </div>
            </div>
        </div>

        <div class="blood-types-container">
            <h3>توزيع فصائل الدم</h3>
            <div class="blood-types-grid">
                <div class="blood-type-card">
                    <h4>A+</h4>
                    <p class="count"><?php echo isset($blood_types['A+']) ? $blood_types['A+'] : 0; ?></p>
                    <p>متبرع</p>
                </div>
                <div class="blood-type-card">
                    <h4>A-</h4>
                    <p class="count"><?php echo isset($blood_types['A-']) ? $blood_types['A-'] : 0; ?></p>
                    <p>متبرع</p>
                </div>
                <div class="blood-type-card">
                    <h4>B+</h4>
                    <p class="count"><?php echo isset($blood_types['B+']) ? $blood_types['B+'] : 0; ?></p>
                    <p>متبرع</p>
                </div>
                <div class="blood-type-card">
                    <h4>B-</h4>
                    <p class="count"><?php echo isset($blood_types['B-']) ? $blood_types['B-'] : 0; ?></p>
                    <p>متبرع</p>
                </div>
                <div class="blood-type-card">
                    <h4>AB+</h4>
                    <p class="count"><?php echo isset($blood_types['AB+']) ? $blood_types['AB+'] : 0; ?></p>
                    <p>متبرع</p>
                </div>
                <div class="blood-type-card">
                    <h4>AB-</h4>
                    <p class="count"><?php echo isset($blood_types['AB-']) ? $blood_types['AB-'] : 0; ?></p>
                    <p>متبرع</p>
                </div>
                <div class="blood-type-card">
                    <h4>O+</h4>
                    <p class="count"><?php echo isset($blood_types['O+']) ? $blood_types['O+'] : 0; ?></p>
                    <p>متبرع</p>
                </div>
                <div class="blood-type-card">
                    <h4>O-</h4>
                    <p class="count"><?php echo isset($blood_types['O-']) ? $blood_types['O-'] : 0; ?></p>
                    <p>متبرع</p>
                </div>
            </div>
        </div>

        <div class="quick-actions">
            <h3>إجراءات سريعة</h3>
            <div class="actions-grid">
                <div class="action-card">
                    <i class="fas fa-user-plus"></i>
                    <h4>إضافة متبرع جديد</h4>
                    <p>تسجيل بيانات متبرع جديد في النظام</p>
                    <a href="donor-red.php">إضافة متبرع</a>
                </div>
                <div class="action-card">
                    <i class="fas fa-search"></i>
                    <h4>البحث عن متبرع</h4>
                    <p>البحث في قاعدة بيانات المتبرعين</p>
                    <a href="list_donor.php">بحث</a>
                </div>
                <div class="action-card">
                    <i class="fas fa-chart-bar"></i>
                    <h4>التقارير</h4>
                    <p>عرض تقارير وإحصائيات النظام</p>
                    <a href="#">عرض التقارير</a>
                </div>
                <div class="action-card">
                    <i class="fas fa-cog"></i>
                    <h4>الإعدادات</h4>
                    <p>تعديل إعدادات النظام</p>
                    <a href="#">الإعدادات</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // تبديل الشريط الجانبي للموبايل
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // إخفاء الشريط الجانبي عند النقر خارجه في وضع الموبايل
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !toggleBtn.contains(event.target) && 
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });

        // تعديل العرض عند تغيير حجم النافذة
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                document.getElementById('sidebar').classList.remove('active');
            }
        });
    </script>
</body>
</html>
