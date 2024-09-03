<?php
include('db.php');
include('ch.php'); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_id = $_POST['question_id'];
    $answer = $_POST['answer'];

    // معالجة ملف الصوت
    if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
        $audio = $_FILES['audio']['tmp_name'];
        $audio_name = $question_id . '.wav'; // استخدام ID كاسم للملف الصوتي
        $upload_dir = 'uploads/';
        $audio_path = $upload_dir . $audio_name;

        if (move_uploaded_file($audio, $audio_path)) {
            // ملف الصوت تم رفعه بنجاح
        } else {
            echo 'فشل في رفع ملف الصوت';
            exit;
        }
    } else {
        // إذا لم يتم رفع ملف صوت، قم بتعيين مسار الصوت كـ null أو مسار سابق إذا كان موجودًا
        $audio_path = isset($_POST['audio_path']) ? $_POST['audio_path'] : null;
    }
        $audio_n = 'uploads/'. $question_id . '.wav'; 
    // تحديث البيانات في قاعدة البيانات
    $stmt = $conn->prepare("UPDATE questions SET answer = ?, audio = ?, status = 1 WHERE id = ?");
    $stmt->bind_param("ssi", $answer, $audio_n, $question_id);
    
    if ($stmt->execute()) {
        echo "<script>window.location.href = './'</script>"; 
    } else {
        echo 'فشل في تحديث السؤال: ' . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>