<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['audio']) && $_FILES['audio']['error'] === UPLOAD_ERR_OK) {
        $audio = $_FILES['audio']['tmp_name'];
        $audio_name = $_FILES['audio']['name'];
        $upload_dir = 'uploads/';
        $audio_path = $upload_dir . basename($_FILES['audio']['name']);

        if (move_uploaded_file($audio, $audio_path)) {
            echo 'تم حفظ ملف الصوت بنجاح';
        } else {
            echo 'فشل في رفع ملف الصوت';
        }
    } else {
        echo 'لا يوجد ملف صوت لرفعه';
    }
}
?>