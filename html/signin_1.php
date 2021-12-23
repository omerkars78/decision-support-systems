<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/signin.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <!-- <link rel="stylesheet" type="text/css" href="../php/baglanti.php">
    <link rel="stylesheet" type="text/css" href="../php/ekle.php">
    <link rel="stylesheet" type="text/css" href="../php/index.php"> -->
    <title>Oturum Aç</title>
</head>
<body>
<?php
    require('../php/baglanti.php');
    session_start();
    // Form gönderildiğinde, kontrol edin ve kullanıcı oturumu oluşturun.
    if (isset($_POST['email'])) {
        $username = stripslashes($_REQUEST['email']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `users` WHERE email='$username'
                     AND password='" .md5($password). "' ";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['email'] = $username;
            // Kullanıcı kontrol paneli sayfasına yönlendir
            header("Location: anasayfa.html");
        } else {
            echo "<div class='form'>
                  <h3>Yanlış email veya şifre.</h3><br/>
                  <p class='link'>Buraya <a href='signin_1.php'>Tıkla</a> ve tekrar dene</p>
                  </div>";
        }
    } else {
?>   


<div id="container">
    <header>
    </header>
    <div class="logo">
        <img class="logo_foto" src="../img/avcitekstil.png">

    </div>
    
    <form id="survey-form" method="post" name="login" action="">
        <div class="oturum_ac">
            <p class="oturum_ac_text">Oturum Aç</p>
        </div>
      <div id="form-group">
        <label id="email-label" for="email">Kullanıcı Adı: </label>
      <input class="form-control" type="text" name="email" id="email" required placeholder="Kullanıcı Adınızı Giriniz">
      </div>
      <div id="form-group">
        <label id="password-label" for="password">Şifre: </label>
      <input class="form-control" type="password" name="password" id="password" required placeholder="Şifrenizi Giriniz">
      </div>
     
       <div id="form-group">
          <button type="submit" id="submit" class="submit-button" value="Login">
          Oturum Aç
       </div>
       <div class="uye_ol">
           <p class="uye_yazi">Üye Değilmisin? O halde <a href="signup_1.php">tıkla</a></p>
       </div>
    </form>
  </div>
<?php
    }
?>
</body>
</html>



