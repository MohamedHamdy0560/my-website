<?php
// تأكد أن الطلب جاء عبر POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات
    $rating = htmlspecialchars($_POST['rating']);
    $comment = htmlspecialchars($_POST['comment']);
    $date = date("Y-m-d H:i:s");
    
    // التحقق من وجود البيانات
    if(empty($rating) || empty($comment)) {
        header("Location: index.html?error=empty");
        exit;
    }
    
    // إعداد السطر لحفظه (استخدام UTF-8 للعربية)
    $newEntry = "[$date] تقييم: $rating نجوم - تعليق: $comment" . PHP_EOL;
    
    // حفظ في ملف نصّي
    file_put_contents("comments.txt", $newEntry, FILE_APPEND | LOCK_EX);
    
    // إعادة التوجيه لصفحة الشكر أو الصفحة الرئيسية
    header("Location: index.html?success=1");
    exit;
} else {
    // إذا لم يكن POST، إعادة التوجيه للصفحة الرئيسية
    header("Location: index.html");
    exit;
}
?>
