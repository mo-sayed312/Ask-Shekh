<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>إدخال كلمة المرور للمسؤول</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #222;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .container {
    width: 300px;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
  }

  label {
    display: block;
    margin-bottom: 10px;
    color: #333;
  }

  input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    margin:10px 0;
  }

  input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: gold;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container">
  <h2>كلمة المرور للمسؤول</h2>
  <form method="post" >
    <label for="password">كلمة المرور:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" name="enter" value="تسجيل الدخول">
  </form>
</div>
<?php
session_start();

// دالة الشرط للتحقق من ضغط زر login
if(isset($_POST['enter'])){
if($_POST['password'] == "F740"){
		$_SESSION['pass'] = "sph";
		header("Location: admin-un.php");
	} else {
		echo "<script>
		Swal.fire({
      title: 'كلمة المرور خطأ',
      text: 'حاول مرة اخري',
      icon: 'error'
    });</script>";

	}
	
	
}
?> 
</body>
</html>
