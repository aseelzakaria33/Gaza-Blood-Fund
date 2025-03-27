<?php
/**
 * ملف للتحقق من صحة البيانات المدخلة
 */

/**
 * التحقق من صحة رقم الهاتف
 * @param string $phone رقم الهاتف
 * @return bool صحيح إذا كان الرقم صحيحاً
 */
function validatePhone($phone) {
    // التحقق من أن رقم الهاتف يتكون من أرقام فقط
    return preg_match('/^\d{10}$/', $phone);
}

/**
 * التحقق من صحة البريد الإلكتروني
 * @param string $email البريد الإلكتروني
 * @return bool صحيح إذا كان البريد صحيحاً
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * التحقق من صحة تاريخ الميلاد
 * @param string $birthdate تاريخ الميلاد
 * @return array ['valid' => bool, 'age' => int, 'message' => string]
 */
function validateBirthdate($birthdate) {
    $result = ['valid' => false, 'age' => 0, 'message' => ''];
    
    // التحقق من صيغة التاريخ
    $date = DateTime::createFromFormat('Y-m-d', $birthdate);
    if (!$date || $date->format('Y-m-d') !== $birthdate) {
        $result['message'] = 'صيغة التاريخ غير صحيحة';
        return $result;
    }
    
    // حساب العمر
    $today = new DateTime();
    $age = $date->diff($today)->y;
    $result['age'] = $age;
    
    // التحقق من أن العمر مناسب للتبرع (18-65 سنة)
    if ($age < 18) {
        $result['message'] = 'يجب أن يكون عمر المتبرع 18 سنة على الأقل';
    } elseif ($age > 65) {
        $result['message'] = 'يجب أن يكون عمر المتبرع أقل من 65 سنة';
    } else {
        $result['valid'] = true;
    }
    
    return $result;
}

/**
 * التحقق من صحة فصيلة الدم
 * @param string $bloodType فصيلة الدم
 * @return bool صحيح إذا كانت فصيلة الدم صحيحة
 */
function validateBloodType($bloodType) {
    $validTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    return in_array($bloodType, $validTypes);
}

/**
 * التحقق من صحة تاريخ التبرع
 * @param string $donationDate تاريخ التبرع
 * @return array ['valid' => bool, 'message' => string]
 */
function validateDonationDate($donationDate) {
    $result = ['valid' => false, 'message' => ''];
    
    // التحقق من صيغة التاريخ
    $date = DateTime::createFromFormat('Y-m-d', $donationDate);
    if (!$date || $date->format('Y-m-d') !== $donationDate) {
        $result['message'] = 'صيغة التاريخ غير صحيحة';
        return $result;
    }
    
    // التحقق من أن التاريخ ليس في الماضي البعيد (أكثر من سنة)
    $today = new DateTime();
    $oneYearAgo = (new DateTime())->modify('-1 year');
    
    if ($date > $today) {
        // تاريخ في المستقبل (مقبول للمواعيد)
        $result['valid'] = true;
    } elseif ($date < $oneYearAgo) {
        $result['message'] = 'تاريخ التبرع قديم جداً';
    } else {
        $result['valid'] = true;
    }
    
    return $result;
}
?>