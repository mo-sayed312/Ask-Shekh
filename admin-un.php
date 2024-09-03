<?php include('ch.php');?> 
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدارة</title>
    <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #222;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            position: fixed;
            width: 100%;
            top: 0;
            background-color: #333;
            padding: 15px 10%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            margin: 0 15px;
        }

        nav a:hover {
            color: gold;
        }

        .container {
            margin-top: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .box {
            background-color: #333;
            border: 2px solid gold;
            border-radius: 15px;
            width: 80%;
            max-width: 800px;
            padding: 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            position: relative;
        }

        .box img {
            width: 100%;
            height: auto;
            border-radius: 15px 15px 0 0;
            border-bottom: 2px solid gold;
        }

        .question {
            background-color: gold;
            padding: 15px;
            color: #222;
            text-align: center;
            border-radius: 0 0 5px 5px;
            font-size: 1rem;
        }

        .answer {
            background-color: #333;
            color: gold;
        }

        .answer p {
            padding: 10px;
            text-align: center;
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .modal-content img {
            width: 100%;
            height: auto;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.8);
        }

        .close {
            position: absolute;
            top: 20px;
            right: 25px;
            z-index: 999;
            color: #f1f1f1;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .action-buttons {
            
            bottom: 20px;
            right: 20px;
        }

        .action-buttons button {
            background-color: gold;
            color: #222;
            border: none;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .action-buttons button:hover {
            background-color: #fff;
            color: #222;
        }
        /* تنسيق نموذج (Modal) */
.modal {
    display: none; /* مخفي بشكل افتراضي */
    position: fixed;
    z-index: 1; /* تأكد من أن النموذج في مقدمة العناصر الأخرى */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6); /* خلفية مظللة */
    padding-top: 60px; /* تباعد العلوي من الأعلى */
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px; /* أقصى عرض للنموذج */
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* ظل خفيف للنموذج */
}

.close {
    color: #aaa;
    float: right;
    z-index: 999;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
}

#modalImage {
    width: 100%;
    max-height: 300px; /* أقصى ارتفاع للصورة */
    object-fit: cover; /* لضبط الصورة بشكل جيد */
    border-radius: 10px;
    margin-bottom: 15px;
}

textarea {
    width: calc(100% - 22px); /* لضبط المساحة الداخلية */
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    margin-bottom: 15px;
    resize: vertical; /* السماح بتغيير الحجم عموديًا فقط */
}

input[type="file"] {
    margin-bottom: 15px;
}

button {
    background-color: gold;
    border: none;
    color: #222;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 5px;
    cursor: pointer;
    border-radius: 5px;
}

button:hover {
    background-color: #f2c200; /* لون أغمق عند التمرير */
}
.modalv,.modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.8);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .modal-content img {
            width: 100%;
            height: auto;
        }

        .clos {
            position: absolute;
            top: 20px;
            right: 25px;
            color: #f1f1f1;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        } 
        .active{color:gold;} 
    </style>
</head>
<body>
    <nav>
        <a class="active" href="./admin.php">غير مجابة</a>
        <a href="./admin-done.php">مجابة</a>
        
    </nav>
    <div class="container">
        <?php
        // إعداد معلومات قاعدة البيانات
        include('db.php');

        // معالجة طلبات الحذف
        if (isset($_GET['delete'])) {
            $question_id = $_GET['delete'];
            $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
            $stmt->bind_param("i", $question_id);
            if ($stmt->execute()) {
                echo " <script>
      Swal.fire({
      title: 'تم الحذف!',
      text: '',
      icon: 'success'
    });
    </script>";
            } else {
                echo '<p>فشل في حذف السؤال: ' . $conn->error . '</p>';
            }
            $stmt->close();
        }

        // استعلام لجلب الأسئلة ذات الحالة 0
        $sql = "SELECT * FROM questions WHERE status = 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="box">';
                if (!empty($row['image']) && file_exists($row['image'])) {
                    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Image" class="modal-trigger">';
                }
                echo '<div class="question">' . htmlspecialchars($row['question_text']) . '</div>';
                echo '<div class="action-buttons">';
          		echo "<script>
          		function d(id){
          		Swal.fire({
  title: '',
  text: 'هل انت متأكد من انك تريد حذف السؤال؟ ',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'نعم, احذف الان', 
  cancelButtonText: 'إلغاء'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = './admin-un.php?delete=' + id
  }
});
} 
</script>
          		";
                echo '<a><button id='. $row['id'] .' onclick="return d(this.id)">حذف</button></a>';
                echo '<button class="reply-btn" data-id="' . $row['id'] . '">رد</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>لا توجد أسئلة لعرضها.</p>';
        }

        // إغلاق الاتصال
        $conn->close();
        ?>
    </div>

    <!-- Modal لعرض السؤال والرد -->
    <div id="replyModal" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content">
            <p id="questionText"></p>
            <img id="modalImage" src="" style="display: none;">
            <form id="replyForm" method="POST" enctype="multipart/form-data">
                <textarea required name="answer" cols="30" rows="5" placeholder="اكتب إجابتك هنا..."></textarea>
                <input type="file" hidden name="audio" accept="audio/*">
                <input type="hidden" name="question_id" id="modalQuestionId">
                <button type="submit" id="sub" name="submit">إرسال الرد</button>
                <button type="button" id="recordButton">تسجيل الصوت</button>
            </form>
        </div>
    </div>
 <!-- Modal لعرض الصورة بحجم كامل -->
    <div id="myModal" class="modalv">
        <span class="close closev">&times;</span>
        <img class="modal-content" id="img01">
    </div>
    <script>
        var modalv = document.getElementById("myModal");
        var modalImgv = document.getElementById("img01");
        var images = document.querySelectorAll(".modal-trigger");

        images.forEach(function(img) {
            img.onclick = function() {
                modalv.style.display = "block";
                modalImgv.src = this.src;
            }
        });

        var span = document.getElementsByClassName("closev")[0];
        span.onclick = function() {
            modalv.style.display = "none";
        };
        var span2 = document.getElementsByClassName("close")[0];
        span2.onclick = function() {
            modal.style.display = "none";
        };
        var modal = document.getElementById("replyModal");
        var modalImg = document.getElementById("modalImage");
        var questionText = document.getElementById("questionText");
        var modalQuestionId = document.getElementById("modalQuestionId");
        var recordButton = document.getElementById("recordButton");

        var mediaRecorder;
        var audioChunks = [];

        function openModal(questionId) {
            fetch('get_question.php?id=' + questionId)
                .then(response => response.json())
                .then(data => {
                    questionText.textContent = data.question_text;
                    if (data.image) {
                        modalImg.src = data.image;
                        modalImg.style.display = "block";
                    } else {
                        modalImg.style.display = "none";
                    }
                    modalQuestionId.value = questionId;
                    modal.style.display = "block";
                });
        }
document.getElementById("replyForm").onsubmit = function(event) {
    event.preventDefault(); // منع إعادة تحميل الصفحة

    var formData = new FormData(this);
    formData.append('audio', document.querySelector('input[name="audio"]').files[0]);

    fetch('update_question.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
      .then(result => {
          console.log(result);
          modal.style.display = "none"; // إغلاق النموذج عند النجاح
          window.location.href = './admin-un.php'
      })
      .catch(error => console.error('Error:', error));
};
        document.querySelectorAll(".reply-btn").forEach(function(btn) {
            btn.onclick = function() {
                var questionId = this.getAttribute("data-id");
                openModal(questionId);
            }
            
        });
        document.querySelector(".close").onclick = function() {
            modal.style.display = "none";
        };

        recordButton.addEventListener('click', function() {
            if (recordButton.textContent === "تسجيل الصوت") {
            Swal.fire({
  title: "انتبه",
  text: "عند الانتهاء من التسجيل اضغط علي ايقاف التسجيل اولاً",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#FFD700",
  cancelButtonColor: "#d33",
  confirmButtonText: "بدأ التسجيل", 
  cancelButtonText: "إلغاء"
}).then((result) => {
  if (result.isConfirmed) {
    startRecording();
    recordButton.textContent = "إيقاف التسجيل";
  }
});
            
             } else {
             Swal.fire({
  title: "تم الحفظ",
  text: "في حالة قمت بالضغط علي زر التسجيل مجددا سيتم حذف التسجيل الاول",
  icon: "warning"
});

                stopRecording();
                recordButton.textContent = "تسجيل الصوت";
            }
        });

function startRecording() {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then(stream => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.ondataavailable = event => {
                        audioChunks.push(event.data);
                    };
                    mediaRecorder.onstop = () => {
                        const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                        const audioUrl = URL.createObjectURL(audioBlob);
                        const audio = new Audio(audioUrl);
                        audioChunks = [];
                        document.querySelector('input[name="audio"]').files = [new File([audioBlob], 'recording.wav')];
                    };
                    mediaRecorder.start();
                });
        }

        function stopRecording() {
    if (mediaRecorder) {
        mediaRecorder.stop();
    }

    // بعد إيقاف التسجيل، إرسال ملف الصوت إلى الخادم
    mediaRecorder.onstop = () => {
        const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
        const formData = new FormData();
        formData.append('audio', audioBlob, modalQuestionId.value + '.wav');
        formData.append('question_id', modalQuestionId.value);
        
        fetch('save_audio.php', {
            method: 'POST',
            body: formData
        }).then(response => response.text())
          .then(result => {
              console.log(result);
              audioChunks = [];
          })
          .catch(error => console.error('Error:', error));
    };
}
        
    </script>
</body>
</html> 