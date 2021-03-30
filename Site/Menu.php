<?php
           $host = '127.0.0.1';
     $user = 'AdminDBSITE';
   $password = 'PiRaTe08642';
   $database = "kursovaya";

   $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");

          $IDPolz = $_COOKIE['cookie_log'];
          $Prava = $_COOKIE['cookie_log_prava'];

?>
<nav style="flex: 0 0 auto;">
          <ul>
              <li><a href="index.php">Главная</a></li>
              <li><a href="product.php">Продукты</a></li>
              <li><a href="productWater.php">Напитки</a></li>

              <li><a href="aboutUS.php">О нас</a></li>
              <li><a href="Kontacts.php">Контакты</a></li>
              <?php if($_COOKIE['cookie_log'] == ''):?>

              <li><a href="choice.php"> <img style= "margin:4px 2px; padding: 0;" class= "login">Вход</a>

              <?php else:?>
                <li><a href="LogIn.php"> <img style= "margin:4px 2px; padding: 0;" class= "login">Пользователь</a>
                  <ul>


               <li><a href="korzina.php">Корзина</a></li>
               <li><a href="zakazi.php">История заказов</a></li>

             </li>
<?php
              if ($Prava == "Admin") :  ?>
              <li><a href="Dobavit.php?Admin=2">Панель администратора</a></li>
            <?php endif; ?>




              <?php
            endif; ?>



            </ul>
          </ul>

    </nav>



    <div class="">
      <?php
      echo "$admin";
      ?>



    </div>
