<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طرح سؤال</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a style="color:gold;" href="index.php">إسال</a>
        <a href="answers.php">الإجابات</a>
    </nav>
    <div class="container">
        <p>ادخل سؤالك</p>
        <form id="questionForm" method="post" enctype="multipart/form-data">
            <textarea name="question" id="question" cols="30" rows="10" placeholder="أكتب سؤالك..." required></textarea>
            <div class="add">
                <input type="file" onchange="validateFileSize(this)" hidden id="image" name="image" accept="image/*">
                <label for="image" class="upload-label">إضافة صورة</label>
                <button type="submit">إرسال</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function validateFileSize(input) {
            const file = input.files[0];
            const maxSizeInMB = 5;
            const maxSizeInBytes = maxSizeInMB * 1024 * 1024;

            if (file.size > maxSizeInBytes) {
                Swal.fire({
                    title: 'خطأ',
                    html: 'حجم الصورة لابد ان يكون اقل من 5 ميجابايت',
                    icon:'error'
                });
                input.value = ''; // إفراغ الحقل لإجبار المستخدم على اختيار ملف آخر
            }
        }
        document.getElementById('image').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                // إنشاء شريط التحميل
                /*
                Swal.fire({
                    title: 'جاري تحميل الصورة...',
                    html: 'الرجاء الانتظار حتى يتم تحميل الصورة.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                */
                
                // إنشاء كائن FileReader لقراءة الملف
                var reader = new FileReader();
                
                // إغلاق النافذة المنبثقة بعد تحميل الصورة
                reader.onload = function(e) {
                    Swal.close();
                };
                
                // قراءة الملف (هذا يحاكي عملية التحميل)
                reader.readAsDataURL(this.files[0]);
            }
        });

        document.getElementById('questionForm').addEventListener('submit', function() {
            Swal.fire({
                title: 'جاري إرسال السؤال...',
                html: 'الرجاء الانتظار حتى يتم إرسال السؤال.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    </script>
</body>
</html>
<?php
// إعداد معلومات قاعدة البيانات
include('db.php'); 
// الحصول على البيانات من النموذج
$question = $_POST['question'];
$answer = ''; // يمكنك تعديل هذا حسب احتياجاتك إذا كنت ترغب في إضافة الإجابة أيضًا
$status = 0; // الحالة الافتراضية

// معالجة الصورة
$image = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $imageTmpPath = $_FILES['image']['tmp_name'];
    $imageName = $_FILES['image']['name'];
    $imagePath = 'uploads/image/' . $imageName;
    move_uploaded_file($imageTmpPath, $imagePath);
    $image = $imagePath;
}

// معالجة المقطع الصوتي
$audio = '';


// إعداد استعلام الإدراج
$sql = "INSERT INTO questions (question_text, answer, status, image, audio) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiss", $question, $answer, $status, $image, $audio);

if ($stmt->execute()) {
    echo "<script>";
	echo " Swal.fire({"; 
	echo "title: 'تم الإرسال!',"; 
	echo "text: 'انتظر حتي يتم الرد علي سؤالك وسيظهر في قسم الاجابات ',";
	echo "icon: 'success' });"; 
	echo "</script>";
} else {
    echo "<script>";
	echo " Swal.fire({"; 
	echo "title: 'خطأ ! ',"; 
	echo "text: 'حاول مجددا وان استمر الوضع فانتظر قليلا ثم جرب',";
	echo "icon: 'error' });"; 
	echo "</script>";
}

// إغلاق الاتصال
$stmt->close();
$conn->close();
?>