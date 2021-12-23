<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/signin.css">
    <title>Kayıt Ol</title>
</head>
<body>

<?php
    require('../php/baglanti.php');
    // Form gönderildiğinde, değerleri veritabanına ekleyin.
    if (isset($_REQUEST['email'])) {
        // ters eğik çizgileri kaldırır
        $username = stripslashes($_REQUEST['email']);
        //bir dizedeki özel karakterlerden kaçar
        $username = mysqli_real_escape_string($con, $username);
       
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        
        $query    = "INSERT into `users` (email, password)
                     VALUES ('".$username."', '".md5($password)."')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Başarıyla Bağlantı Sağladın.</h3><br/>
                  <p class='link'>Buraya Tıkla<a href='signin_1.php'>Oturum Aç</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Gerekli Alanlar Eksik Tekar Dene.</h3><br/>
                  <p class='link'>Buraya Tıkla <a href='signup_1.php'>Kayıt Olmayı</a> Tekrar Dene.</p>
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
    
    <form action="" method="post" id="survey-form" >
        <div class="kayit_ol">
            <p class="kayit_ol_text">Kayıt Ol</p>
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
          <button  id="submit" class="submit-button" type="submit" name="submit" value="Register">
          Kayıt Ol
       </div>
       
    </form>
  </div>
<?php
    }
?>

</body>
</html>
