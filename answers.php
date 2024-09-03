<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الأسئلة</title>
    <link rel="stylesheet" href="style.css">
    <style type="text/css">
        body {
            background-color: #222;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        nav {
            position: relative;
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
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .box {
            background-color: #333;
            border: 2px solid gold;
            border-radius: 5px;
            width: 60%;
            padding: 20px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .box:hover {
            background-color: #444;
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
            border-radius: 10px;
            font-size: 1rem;
            max-height: 100px !important; /* حد أقصى للارتفاع */
    		min-height: 30px;
    		overflow:auto;/* إضافة التمرير العمودي عند الحاجة */

        }

        .answer-container {
            display: none;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out;
            max-height: 0;
            opacity: 0;
        }

        .box.active .answer-container {
            display: block;
            max-height: 1000px; 
            width:100%;/* قيمة كبيرة للسماح بالتوسع الكامل */
            opacity: 1;
            
        }

        .answer {
            background:#333;
            color: gold;
            padding: 15px;
            text-align: center;
            border-radius: 10px;
            font-size: 1rem;
                        max-height: 500px; /* حد أقصى للارتفاع */
    		min-height: 30px;
    		overflow:auto;/* إضافة التمرير العمودي عند الحاجة */

        }

        .audio-answer {
            width: 100%;
            margin-top: 10px;
        }
        
        .text-answer {
            color: gold;
            padding: 10px;
            text-align: center;
        }

        .modal {
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

        .close {
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

        /* تخصيص شريط التشغيل */
        .audio-answer::-webkit-media-controls-panel {
            background-color: gold;
        }

        .audio-answer::-webkit-media-controls-play-button,
        .audio-answer::-webkit-media-controls-volume-slider,
        .audio-answer::-webkit-media-controls-mute-button {
            background-color: #fff;
            color: white;
            border-radius: 50%;
        }

        .audio-answer::-webkit-media-controls-play-button {
            background-color: white;
            color: #333;
            width: 30px;
            height: 30px;
        }

        .audio-answer::-webkit-media-controls-current-time,
        .audio-answer::-webkit-media-controls-time-remaining-display {
            color: white;
        }

        .audio-answer::-webkit-slider-runnable-track {
            background: gold;
            height: 4px;
        }

        .audio-answer::-webkit-slider-thumb {
            background: white;
            border: 2px solid gold;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            margin-top: -6px; /* لتحسين موضع الـ thumb بالنسبة للشريط */
        }

        /* Firefox-specific styling */
        .audio-answer::-moz-range-track {
            background-color: gold;
        }

        .audio-answer::-moz-range-thumb {
            background-color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
        }

        /* General input styling for other browsers */
        .audio-answer::-ms-fill-lower {
            background-color: gold;
        }

        .audio-answer::-ms-fill-upper {
            background-color: gold;
        }

        .audio-answer::-ms-thumb {
            background-color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
        }
        .actived{
            color:gold; 
        } 

        /* Spinner CSS */
        .spinner {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid gold;
            width: 60px;
            height: 60px;
            animation: spin 2s linear infinite;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
    </style>
</head>
<body>
    <nav>
        <a href="index.php">إسال</a>
        <a class="actived" href="answers.php">الإجابات</a>
    </nav>
    <div class="container">
        <?php
        include('db.php'); 

        $sql = "SELECT * FROM questions WHERE status = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="box">';
                echo '<div class="question" onclick="toggleAnswer(this)">' . htmlspecialchars($row['question_text']) . '</div>';
                echo '<div class="answer-container">';
                if (!empty($row['image']) && file_exists($row['image'])) {
                    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Image" class="modal-trigger">';
                }
                echo '<div class="answer">';
                echo '<p class="text-answer">' . htmlspecialchars($row['answer']) . '</p>';
                if (!empty($row['audio']) && file_exists($row['audio'])) {
                    echo '<audio controls class="audio-answer">';
                    echo '<source src="' . htmlspecialchars($row['audio']) . '" type="audio/mpeg">';
                    echo 'متصفحك لا يدعم تشغيل الملفات الصوتية.';
                    echo '</audio>';
                }
                echo '</div>'; // End of .answer
                echo '</div>'; // End of .answer-container
                echo '</div>'; // End of .box
            }
        } else {
            echo '<p>لا توجد أسئلة لعرضها.</p>';
        }

        $conn->close();
        ?>
    </div>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <div class="spinner" id="spinner"></div> <!-- Spinner added -->
        <img class="modal-content" id="img01">
    </div>
<script>
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("img01");
        var spinner = document.getElementById("spinner");
        var images = document.querySelectorAll(".modal-trigger");

        images.forEach(function(img) {
            img.onclick = function() {
                modal.style.display = "block";
                spinner.style.display = "block";  // عرض الـ spinner أثناء تحميل الصورة
                modalImg.style.display = "none";  // إخفاء الصورة مؤقتاً حتى يتم تحميلها

                modalImg.onload = function() {
                    spinner.style.display = "none"; // إخفاء الـ spinner عند اكتمال تحميل الصورة
                    modalImg.style.display = "block"; // عرض الصورة بعد تحميلها
                };

                modalImg.src = this.src;  // تحميل الصورة
            }
        });

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        };

        function toggleAnswer(element) {
            var box = element.parentElement;
            box.classList.toggle("active");
        }
        
        document.addEventListener("DOMContentLoaded", function() {
            var audioElements = document.querySelectorAll(".audio-answer");
            
            audioElements.forEach(function(audioElement) {
                var audioSource = audioElement.querySelector("source");

                // التحقق مما إذا كان مسار الصوت غير موجود أو غير صحيح
                var audio = new Audio(audioSource.src);
                audio.onerror = function() {
                    audioElement.style.display = "none";
                };

                audio.oncanplaythrough = function() {
                    audioElement.style.display = "block";
                };

                // محاولة تحميل الصوت للتحقق من وجود أخطاء
                audio.load();
            });
        });
    </script>
</body>
</html>