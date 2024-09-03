<?php

// فتح الجلسه لاستدعاء قيمتها
session_start();

// داله للتحقق من وجود قيمه فى جلسة username
if(!isset($_SESSION['pass'])){
	// اذا كانت القيمه فارغه يتم الانتقال الى صفحة تسجيل الدخول
	header("Location: admin.php");
	exit();
}


?>