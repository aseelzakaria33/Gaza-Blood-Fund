<?php 
include('connection.php');
session_start();

// التأكد من أن المستخدم مسجل الدخول
if (!isset($_SESSION['un'])) {
    header("location:loginadmin.php");
    exit();
}

// تحديد عدد السجلات في كل صفحة
$limit = 10; // عدد الصفوف في كل صفحة
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// البحث
$search = isset($_GET['search']) ? $_GET['search'] : '';
$blood_filter = isset($_GET['blood_filter']) ? $_GET['blood_filter'] : '';

// بناء استعلام البحث
$query = "SELECT * FROM `regb` WHERE 1=1";
if (!empty($search)) {
    $query .= " AND (username LIKE '%$search%' OR con LIKE '%$search%')";
}
if (!empty($blood_filter)) {
    $query .= " AND Fgroup = '$blood_filter'";
}

// استعلام العدد الإجمالي للسجلات
$total_query = $query;
$total_result = mysqli_query($db, $total_query);
$total_rows = mysqli_num_rows($total_result);
$total_pages = ceil($total_rows / $limit);

// استعلام البيانات مع الحد
$query .= " LIMIT $start, $limit";
$result = mysqli_query($db, $query);

// دالة لحساب العمر من تاريخ الميلاد
function calculateAge($birthdate) {
    // التحقق مما إذا كان التاريخ رقمًا (العمر مباشرة)
    if (is_numeric($birthdate)) {
        return $birthdate;
    }
    
    // محاولة تحويل التاريخ إلى كائن DateTime
    $birthDate = date_create($birthdate);
    if (!$birthDate) {
        return "غير معروف";
    }
    
    $today = date_create('today');
    $age = date_diff($birthDate, $today)->y;
    return $age;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المتبرعين - نظام إدارة بنك الدم</title>
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

        .search-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-form .form-group {
            flex: 1;
            min-width: 200px;
        }

        .search-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        .search-form input, .search-form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Tajawal', sans-serif;
        }

        .search-form button {
            padding: 10px 20px;
            background-color: #d32f2f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            font-weight: 500;
            transition: background-color 0.3s ease;
            margin-top: 24px;
        }

        .search-form button:hover {
            background-color: #b71c1c;
        }

        .table-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .action-buttons .add-button {
            padding: 10px 20px;
            background-color: #d32f2f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .action-buttons .add-button i {
            margin-left: 5px;
        }

        .action-buttons .add-button:hover {
            background-color: #b71c1c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: right;
            border-bottom: 1px solid #eee;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: 700;
            color: #333;
        }

        table tr:hover {
            background-color: #f8f9fa;
        }

        .action-buttons-cell {
            display: flex;
            gap: 5px;
        }

        .action-button {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .action-button i {
            margin-left: 5px;
        }

        .edit-button {
            background-color: #2196f3;
            color: white;
        }

        .edit-button:hover {
            background-color: #0d8bf2;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
        }

        .delete-button:hover {
            background-color: #d32f2f;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 5px;
            background-color: #fff;
            color: #333;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .pagination a.active {
            background-color: #d32f2f;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #f1f1f1;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            color: #777;
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

        /* تنسيق مربع الاختيار */
        .donor-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        /* تنسيق الإشعارات */
        .notification {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1100;
            transition: opacity 0.5s ease;
        }

        /* تنسيق نص حالة التبرع */
        .status-text {
            margin-right: 10px;
            font-weight: bold;
            color: #4CAF50;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
        <a href="list_donor.php" class="active"><i class="fas fa-users"></i> إدارة المتبرعين</a>
        <a href="donor-red.php"><i class="fas fa-user-plus"></i> إضافة متبرع</a>
        <a href="../php/index.php"><i class="fas fa-globe"></i> الموقع الرئيسي</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
    </div>

    <!-- محتوى الصفحة -->
    <div id="content">
        <div class="page-title">
            <h3>إدارة المتبرعين</h3>
            <p>عرض وإدارة بيانات المتبرعين في النظام</p>
        </div>
        

        
        <div class="search-container">
            <form class="search-form" method="GET">
                <div class="form-group">
                    <label for="search">بحث</label>
                    <input  type="text" id="search" name="search"  style="width: 350px;" placeholder="اسم المتبرع أو رقم الهاتف" value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <div class="form-group">
                    <label for="blood_filter">فصيلة الدم</label>
                    <select  style="width:375px;" id="blood_filter" name="blood_filter">
                        <option value="">جميع الفصائل</option>
                        <option value="A+" <?php echo $blood_filter == 'A+' ? 'selected' : ''; ?>>A+</option>
                        <option value="A-" <?php echo $blood_filter == 'A-' ? 'selected' : ''; ?>>A-</option>
                        <option value="B+" <?php echo $blood_filter == 'B+' ? 'selected' : ''; ?>>B+</option>
                        <option value="B-" <?php echo $blood_filter == 'B-' ? 'selected' : ''; ?>>B-</option>
                        <option value="AB+" <?php echo $blood_filter == 'AB+' ? 'selected' : ''; ?>>AB+</option>
                        <option value="AB-" <?php echo $blood_filter == 'AB-' ? 'selected' : ''; ?>>AB-</option>
                        <option value="O+" <?php echo $blood_filter == 'O+' ? 'selected' : ''; ?>>O+</option>
                        <option value="O-" <?php echo $blood_filter == 'O-' ? 'selected' : ''; ?>>O-</option>
                    </select>
                </div>
                <button type="submit">بحث</button>
            </form>
        </div>

        <div class="table-container">
            <div class="action-buttons">
                <a href="donor-red.php" class="add-button">
                    <i class="fas fa-plus"></i> إضافة متبرع جديد
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>تم التبرع</th>
                        <th>الاسم</th>
                        <th>العمر</th>
                        <th>الجنس</th>
                        <th>مركز التبرع</th>
                        <th>فصيلة الدم</th>
                        <th>التاريخ</th>
                        <th>الوقت</th>
                        <th>رقم الهاتف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // حساب العمر من تاريخ الميلاد
                            $age = calculateAge($row['age']);
                            
                            echo "<tr id='donor-row-" . $row['id'] . "'>";
                            echo "<td>";
                            echo "
                            <input type='checkbox' class='donor-checkbox' name='check' data-id='" . $row['id'] . "'>";
                           
                            echo "<span id='status-text-" . $row['id'] . "' class='status-text' style='display: none;'>تم التبرع</span>";
                            echo "</td>";
                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td>" . $age . "</td>"; // عرض العمر بدلاً من تاريخ الميلاد
                            echo "<td>" . htmlspecialchars($row['bgroup']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Cgroup']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Fgroup']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['con']) . "</td>";
                            echo "<td class='action-buttons-cell'>";
                            echo "<a href='edit_donor.php?id=" . $row['id'] . "' class='action-button edit-button'><i class='fas fa-edit'></i> تعديل</a>";
                            echo "<a href='delet.php?id=" . $row['id'] . "' class='action-button delete-button' onclick='return confirm(\"هل أنت متأكد من حذف هذا المتبرع؟\")'><i class='fas fa-trash'></i> حذف</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10' class='no-results'>لا توجد نتائج مطابقة</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&blood_filter=<?php echo urlencode($blood_filter); ?>">السابق</a>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&blood_filter=<?php echo urlencode($blood_filter); ?>" <?php echo $page == $i ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
                
                <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&blood_filter=<?php echo urlencode($blood_filter); ?>">التالي</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
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

        // معالجة تغيير حالة المتبرع
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.donor-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const donorId = this.getAttribute('data-id');
                    const isDonated = this.checked;
                    
                    if (isDonated) {
                        // إرسال طلب AJAX لحذف المتبرع من قاعدة البيانات
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'delete_donor.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    // حذف الصف من الجدول
                                    const donorRow = document.getElementById('donor-row-' + donorId);
                                    if (donorRow) {
                                        donorRow.remove();
                                    }
                                    
                                    // عرض إشعار بنجاح العملية
                                    const notification = document.createElement('div');
                                    notification.className = 'notification';
                                    notification.textContent = 'تم تأكيد استلام التبرع   ';
                                    document.body.appendChild(notification);
                                    
                                    // إخفاء الإشعار بعد 3 ثواني
                                    setTimeout(() => {
                                        notification.style.opacity = '0';
                                        setTimeout(() => {
                                            notification.remove();
                                        }, 500);
                                    }, 3000);
                                } else {
                                    alert('حدث خطأ أثناء حذف المتبرع: ' + response.message);
                                }
                            } else {
                                alert('حدث خطأ في الاتصال بالخادم');
                            }
                        };
                        xhr.onerror = function() {
                            alert('حدث خطأ في الاتصال بالخادم');
                        };
                        xhr.send('id=' + donorId);
                    }
                });
            });
        });
    </script>
</body>
</html>

