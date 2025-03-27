<?php
include('validation.php');
include('connection.php');
session_start();

// التأكد من أن المستخدم مسجل الدخول
if (!isset($_SESSION['un'])) {
    header("location:loginadmin.php");
    exit();
}

// التحقق من وجود معرف المتبرع
$id = $_GET['id'];
$db = mysqli_connect('localhost', 'root', '', 'boold');

// استرجاع بيانات المتبرع من قاعدة البيانات
$Record = mysqli_query($db, "SELECT * FROM `regb` WHERE `id`='$id'");
$data = mysqli_fetch_array($Record);

// تحويل تنسيق التاريخ إذا كان مخزنًا بتنسيق مختلف
$birthdate_formatted = '';
if (!empty($data['age'])) {
    // تحقق مما إذا كان العمر مخزنًا كرقم أو كتاريخ
    if (is_numeric($data['age'])) {
        // إذا كان مخزنًا كعمر (رقم)، قم بحساب تاريخ الميلاد التقريبي
        $birthdate_formatted = date('Y-m-d', strtotime('-' . $data['age'] . ' years'));
    } else {
        // حاول تحويل التاريخ المخزن إلى التنسيق المطلوب
        $timestamp = strtotime($data['age']);
        if ($timestamp !== false) {
            $birthdate_formatted = date('Y-m-d', $timestamp);
        }
    }
}

//success_message: يخزن رسالة النجاح إذا تم التسجيل بنجاح.
//error_message: يخزن رسالة الخطأ إذا حدثت مشكلة.
// معالجة النموذج عند الإرسال
$success_message = '';
$error_message = '';

if (isset($_POST['sub0'])) {
    // استلام البيانات من النموذج
    $username = $_POST['username'];
    $birthdate = $_POST['birthdate']; 
    $bgroup = $_POST['bgroup'];
    $Cgroup = $_POST['Cgroup'];
    $Fgroup = $_POST['Fgroup'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $con = $_POST['con'];
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
        $sql = "UPDATE regb SET 
        `username` = '$username', 
        `age` = '$birthdate', 
        `bgroup` = '$bgroup', 
        `Cgroup` = '$Cgroup', 
        `Fgroup` = '$Fgroup', 
        `date` = '$date', 
        `time` = '$time', 
        `con` = '$con' 
        WHERE `id` = '$id'";
        $db = mysqli_connect('localhost', 'root', '', 'boold');
        if (mysqli_query($db, $sql)) {
            $success_message = 'تم تعديل المتبرع بنجاح';
        } else {
            $error_message = 'فشل تعديل المتبرع: ' . mysqli_error($db);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل متبرع - نظام إدارة بنك الدم</title>
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

        /* محتوى الصفحة */
        #content {
            margin-right: 250px;
            margin-top: 80px;
            padding: 20px;
        }

        .page-title {
            margin-bottom: 20px;
        }

        .page-title h3 {
            color: #d32f2f;
            margin: 0 0 10px;
            font-weight: 700;
            font-size: 24px;
        }

        .page-title p {
            color: #555;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Tajawal', sans-serif;
            font-size: 16px;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #d32f2f;
            outline: none;
            box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.25);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .form-col {
            flex: 1;
            padding: 0 10px;
            min-width: 250px;
        }

        .submit-button {
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-family: 'Tajawal', sans-serif;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #b71c1c;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #555;
            text-decoration: none;
        }

        .back-link i {
            margin-left: 5px;
        }

        .back-link:hover {
            color: #d32f2f;
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
            .form-col {
                flex: 100%;
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
        
        .age-display {
            margin-top: 8px;
            font-weight: bold;
            color: #d32f2f;
        }
    </style>
</head>
<body>

    <!-- رأس الصفحة -->
    <div id="header">
        <h2>نظام إدارة بنك الدم</h2>
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
        <a href="dashboard.php"><i class="fas fa-home"></i> الرئيسية</a>
        <a href="list_donor.php"><i class="fas fa-users"></i> إدارة المتبرعين</a>
        <a href="donor-red.php" class="active"><i class="fas fa-user-plus"></i> إضافة متبرع</a>
        <!-- <a href="#"><i class="fas fa-tint"></i> إدارة أكياس الدم</a> -->
        <!-- <a href="#"><i class="fas fa-chart-bar"></i> التقارير والإحصائيات</a> -->
        <!-- <a href="#"><i class="fas fa-cog"></i> الإعدادات</a> -->
        <a href="../php/index.php"><i class="fas fa-globe"></i> الموقع الرئيسي</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
    </div>


    <!-- محتوى الصفحة -->
    <div id="content">
        <div class="page-title">
            <h3>تعديل بيانات المتبرع</h3>
            <p>تعديل بيانات المتبرع في النظام</p>
        </div>

        <div class="form-container">
          
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


            <form method="POST" action="edit_donor.php?id=<?php echo $id; ?>">
                <input type="hidden" name="donor_id" value="<?php echo $id; ?>">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="username">اسم المتبرع</label>
                            <input style="width:350px;" type="text" id="username" name="username" value="<?php echo $data['username']?>" placeholder="أدخل الاسم الكامل" >
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="birthdate">تاريخ الميلاد</label>
                            <input style="width:350px;" type="date" id="birthdate" name="birthdate" value="<?php echo $birthdate_formatted; ?>" required>
                            <div id="age-display" class="age-display"></div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="bgroup">الجنس</label>
                            <select  style="width:375px;" id="bgroup" name="bgroup" required>
                                <option value="" disabled>اختر الجنس</option>
                                <option value="male" <?php echo ($data['bgroup'] == 'male') ? 'selected' : ''; ?>>ذكر</option>
                                <option value="female" <?php echo ($data['bgroup'] == 'female') ? 'selected' : ''; ?>>أنثى</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="con">رقم الهاتف</label>
                            <input style="width:350px;" type="text" id="con" name="con" placeholder="أدخل رقم الهاتف" value="<?php echo $data['con']?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="Cgroup">مركز التبرع</label>
                            <select style="width:375px;" id="Cgroup" name="Cgroup" required>
                                <option value="" disabled>اختر مركز التبرع</option>
                                <option value="مستشفى الشفاء" <?php echo ($data['Cgroup'] == 'مستشفى الشفاء') ? 'selected' : ''; ?>>مستشفى الشفاء</option>
                                <option value="مستشفى الأوروبي" <?php echo ($data['Cgroup'] == 'مستشفى الأوروبي') ? 'selected' : ''; ?>>مستشفى الأوروبي</option>
                                <option value="مستشفى ناصر" <?php echo ($data['Cgroup'] == 'مستشفى ناصر') ? 'selected' : ''; ?>>مستشفى ناصر</option>
                                <option value="مركز الدم المركزي" <?php echo ($data['Cgroup'] == 'مركز الدم المركزي') ? 'selected' : ''; ?>>مركز الدم المركزي</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="Fgroup">فصيلة الدم</label>
                            <select style="width:375px;" id="Fgroup" name="Fgroup" required>
                                <option value="" disabled>اختر فصيلة الدم</option>
                                <option value="A+" <?php echo ($data['Fgroup'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                                <option value="A-" <?php echo ($data['Fgroup'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                                <option value="B+" <?php echo ($data['Fgroup'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                                <option value="B-" <?php echo ($data['Fgroup'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                                <option value="O+" <?php echo ($data['Fgroup'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                                <option value="O-" <?php echo ($data['Fgroup'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                                <option value="AB+" <?php echo ($data['Fgroup'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                <option value="AB-" <?php echo ($data['Fgroup'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="date">تاريخ التبرع</label>
                            <input style="width:350px;"  type="date" id="date" name="date" value="<?php echo $data['date']?>" required>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="time">وقت التبرع</label>
                            <input style="width:350px;" type="time" id="time" name="time" value="<?php echo $data['time']?>" required>
                        </div>
                    </div>
                </div>

                <button type="submit" name="sub0" class="submit-button">حفظ التعديلات</button>
            </form>

            <a href="list_donor.php" class="back-link"><i class="fas fa-arrow-right"></i> العودة إلى قائمة المتبرعين</a>
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
        
        // حساب العمر من تاريخ الميلاد
        function calculateAge(birthdate) {
            const today = new Date();
            const birthDate = new Date(birthdate);
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            return age;
        }
        
        // عرض العمر عند تغيير تاريخ الميلاد
        document.getElementById('birthdate').addEventListener('change', function() {
            const birthdate = this.value;
            if (birthdate) {
                const age = calculateAge(birthdate);
                document.getElementById('age-display').textContent = 'العمر: ' + age + ' سنة';
            } else {
                document.getElementById('age-display').textContent = '';
            }
        });
        
        // حساب العمر عند تحميل الصفحة إذا كان هناك تاريخ ميلاد
        window.addEventListener('load', function() {
            const birthdate = document.getElementById('birthdate').value;
            if (birthdate) {
                const age = calculateAge(birthdate);
                document.getElementById('age-display').textContent = 'العمر: ' + age + ' سنة';
            }
        });
    </script>
</body>
</html>

