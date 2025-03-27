<?php include('connection.php'); session_start(); ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة بنك الدم</title>
    <style>
        /* تنسيق عام */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 350px;
        }

        .container h2 {
            color: #c4161c;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="password"] {
            font-family: Verdana;
        }

        input:focus {
            border-color: #c4161c;
            outline: none;
        }

        .btn {
            background: #c4161c;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
            transition: 0.3s;
        }

        .btn:hover {
            background: #a31218;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>تسجيل الدخول</h2>
        <form action="" method="post">
            <input type="text" name="un" placeholder="أدخل اسم المستخدم" required>
            <input type="password" name="ps" placeholder="أدخل كلمة المرور" required>
            <button type="submit" name="sub" class="btn">دخول</button>
        </form>

        <?php
        if(isset($_POST['sub'])){
            $un = $_POST['un'];
            $ps = $_POST['ps'];
            $q = "SELECT * FROM admin WHERE uname='$un' AND pass='$ps'";
            $result = mysqli_query($db, $q);
            if(mysqli_num_rows($result) > 0){
                $_SESSION['un'] = $un;
                header("location:dashboard.php");
            } else {
                echo "<script>alert('اسم المستخدم أو كلمة المرور غير صحيحة');</script>";
               
            }
        }
        ?>
        <div class="footer">&copy; مشروع بنك الدم <?php echo date('Y'); ?></div>
    </div>
</body>
</html>
