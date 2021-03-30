<?php
  $host = '127.0.0.1';
  $user = 'AdminDBSITE';
  $password = 'PiRaTe08642';
  $database = "kursovaya";
  if(isset($_POST["send"])){
    $usname= trim($_POST["usname"]);
    $uspass= trim($_POST["uspass"]);
    $usphone= trim($_POST["usphone"]);
    $usemail= trim($_POST["usemail"]);
    $message_text= trim($_POST["message_text"]);
    $errorName="";
    $errorPass="";
    $errorPhone="";
    $errorEmail="";
    $error = false;
    if($usname ==""){
      $errorName="Введите имя";
      $error = true;
    }
    if($uspass ==""){
      $errorPass="Введите пароль";
      $error = true;
    }
    if($usphone ==""){
      $errorPhone="Введите телефон";
      $error = true;
    }
    if($usemail ==""){
      $errorEmail="Введите email";
      $error = true;
    }
$Res_inf = "";
if ($error == false) {


    $mysql = new mysqli($host, $user, $password, $database);
    $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");
    if (empty(mysqli_fetch_assoc(mysqli_query($link,
        "SELECT Email from polzovatel WHERE Email =
        '$usemail'"))))
        {

          $query = "INSERT INTO `polzovatel`(`Name`, `Email`, `Password`, `Adress`, `Telefon`, `Recvisits`, `DopInform`, `Admin`) VALUES('$usname','$usemail', '$uspass','Null','$usphone','Null' , '$message_text', '0')";
          $result = $mysql ->query($query);
          if ($result) $Res_inf = "Регистрация прошла успешно.";
          echo "312";
          mysqli_close($link);
          if ( !$link ) $Res_inf = "";
        }
    else
        {
      $Res_inf = "Такой E-mail уже зарегестрирован";
        }
  }
 }

?>



<body>
<?php
include ('header.php');
include ('Menu.php');
?>

<div class="formar">



  <form class="form" action="" method="post">
  <label style="margin: 0 18%;">E-Mail:</label> </br>
  <input type="email" name='usemail'/> </br>
  <span style=" color:#640002"><?=$errorEmail?></span> </br>
  <label style="margin: 0 19%;">Имя:</label> </br>
  <input type="text" name="usname"/> </br>
  <span style=" color:#640002"><?=$errorName?></span> </br>
  <label style="margin: 0 17%;">Телефон:</label> </br>
  <input type="text" maxlength="11" name='usphone'/> </br>
  <span style=" color:#640002"><?=$errorPhone?></span> </br>
  <label style="margin: 0 16%;">Пароль:</label> </br>
  <input type="password" name='uspass'/> </br>
  <span style=" color:#640002"><?=$errorPass?></span> </br>
  <label style="margin: 0 14%;">Информация:</label> </br>
  <textarea name="message_text"></textarea> </br>
  <input style="margin: 0 13%;" type="submit" name="send" value="Регистрация"></br>
  <label style="color:#640002; font-size:22px; margin: 0 0;"><?=$Res_inf?></label>
  </form>

</div>




<?php
include ('footer.php');
 ?>
</body>
