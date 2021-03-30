<?php

  session_start();
  $host = '127.0.0.1';
  $user = 'AdminDBSITE';
  $password = 'PiRaTe08642';
  $database = "kursovaya";
  if(isset($_POST["EXIT"])){
    setcookie("cookie_log", $IDpolzovatel, time() - 60*60);
    header("Location: login.php");
  };

  if(isset($_POST["send"])){

    $usemail= trim($_POST["usemail"]);
    $uspass= trim($_POST["uspass"]);
    $errorEmail="";
    $errorPass="";
    $error = false;

    if($usemail ==""){
      $errorEmail="Введите email";
      $error = true;
    }
    if($uspass ==""){
      $errorPass="Введите пароль";
      $error = true;
    }

$Res_inf = "";
if ($error == false) {

    $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");

          $QUARYY = "SELECT `ID`, `Admin` FROM polzovatel WHERE Email ='$usemail' AND Password = '$uspass'";
          $result = mysqli_query($link,$QUARYY);
           $IDpolzovatel = mysqli_fetch_assoc($result);

if (!empty(mysqli_fetch_assoc(mysqli_query($link,$QUARYY)))){
  //setcookie("cookie_log", '');
                setcookie("cookie_log", $IDpolzovatel[ID], time() + 60*60);
                setcookie("cookie_log_prava", $IDpolzovatel[Admin], time() + 60*60);

                //setcookie("cookie_log", $row[ID], time()+60*60);


                  $Res_inf = "Вход прошел успешно.";
                  header("Refresh: 0.5");
                  mysqli_close($link);
                  if ( !$link ) $Res_inf = "";

        }
          else
        {
                $Res_inf = "Не обнаружен пользователь в базе данных";
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

  <?php if($_COOKIE['cookie_log'] == ''): ?>

<form class="form" action="" method="post">
<label>E-Mail:</label> </br>
<input type="email" name='usemail'/> </br>
<span style=" color:#640002"><?=$errorEmail?></span> </br>
<label>Пароль:</label> </br>
<input type="password" name="uspass"/> </br>
<span style=" color:#640002"><?=$errorPass?></span> </br>
<input class="superbutton" type="submit" name="send" value="Вход"></br>
<label style="color:#640002; font-size:22px;"><?=$Res_inf ?></label>

<?php else : ?>
<div style="margin: 30px, 55%;">

<a style="padding: 10% 40%; margin-top: 10%;font-size:22px; color:#640002">ВЫЙТИ!?</a>
<form class="form" action="" method="post">
<input class="superbutton" type="submit" name="EXIT" value="ВЫХОД"></br>
<label style="color:#640002; font-size:22px;"><?=$Res_inf ?></label>
</div>
<?php endif; ?>

</div>
<?php
include ('footer.php');
 ?>
</body>
