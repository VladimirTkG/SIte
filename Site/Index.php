

<body style="flex: 0 0 auto;">


<?php
$a = $_SESSION['User_id'];
include ('header.php');

include ('Menu.php');
 ?>


 <div style="border: solid;
 border-radius: 15px;
 flex: 1 0 auto;">


  <form class="form_search" aсtion=""
  method="post">
  Ищем по:<br>
  <select name="searchtype">
  <option value="Nazvanie"
  selected>Название
  <option
  value="cena">Цена
  </select> <br>
  Строка поиска:<br> <input
  name="searchterm"> <br>
  <input type= "submit" name= "send"
  value="Поиск">
  </form>
 </div>


  <?php
  $host = '127.0.0.1';
  $user = 'AdminDBSITE';
  $password = 'PiRaTe08642';
  $database = "kursovaya";
  $searchterm = trim ( $_POST['searchterm']
  );
  if (isset($_POST["send"]))
  {
  if (!$searchterm) die ("<div class =
  result_output>Не все данные введены.</div>");
  $searchterm = addslashes
  ($searchterm);

  $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");

  $query = "SELECT * FROM tovar,kategoritov
  WHERE kategoritov.ID = IDKategori AND ".$_POST['searchtype']." like '%".$searchterm."%'";

  $result = mysqli_query($link, $query);
  $query1= "SELECT COUNT(*) FROM tovar WHERE ".$_POST['searchtype']." like
  '%".$searchterm."%'";

  $result1= mysqli_query($link, $query1);
  $cnt=mysqli_fetch_row($result1)[0];

  if (mysqli_num_rows($result) > 0)
  {
  echo "<div class =
  border_inf>"."<h2>"."Количество продуктов:
  ".$cnt."</h2>"."</div>";
  while ($row =
  mysqli_fetch_assoc($result))

  {
    $cnt1 = mysqli_fetch_row($result1)[$row['ID']];

    if ($cnt1 = mysqli_fetch_row($result1)[$row['ID']] != '0')
    {
      if ($row['kolvo'] != '0')
    {  echo "<div class =
      borderTovar><h2>".$row['Nazvanie']."</h2>".
      '<b>'.Осталось.': '.'</b>'.$row['Kolvo'].'<br />'.
      '<b>'.Цена.' '.товара.': '.'</b>'.$row['Cena'].'<br />'.
      '<b>'.Вид.' '.товара.': '.'</b>'.$row['NazvanieKat'].'<br />'?>
      <?php
      if($_COOKIE['cookie_log'] != '')
      {
       echo "<a style = \" background-color: #f44336;
         color: white;
         padding: 14px 25px;
         text-align: center;
         text-decoration: none;
         display: inline-block;\"  href=\"korzina.php?tovar_id="; echo $row['ID']; echo " \"> Купить</a>";  echo "</div>" ;
     }
       else
       {
       echo "<a> Войдите или зарегестрируйтесь!!</a> </div>";
      }
  }
  else
  {
    echo "<div class =
      borderTovar><h2>".$row['Nazvanie']."</h2>".
      '<b>'.Осталось.': '.'</b>'.$row['Kolvo'].'<br />'.
      '<b>'.Цена.' '.товара.': '.'</b>'.$row['Cena'].'<br />'.
      '<b>'.Вид.' '.товара.': '.'</b>'.$row['NazvanieKat'].'<br />';
      echo "<a style=\"color:#640002; font-size:22px;\"> Товар отсутствует. </a> </div>";
  }
}
}


}
  if (mysqli_num_rows($result) == 0)
  echo "<div class = result_output>Ничего не можем предложить.
  Извините</div>";
  mysqli_close ( $link );
  }

  if ($_COOKIE['cookie_log'] == ""):
    if($_GET['zakazOf'] == '1'):?>
    <h1 style="font-size: 15px;"> Спасибо за заказ</h1>
  <?php endif;
endif; ?>

<p style="font-size: 20px; color:#FFF; text-align:center;">Вы можете найти нас по данному адресу.</p>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1873.2550396794395!2d40.08700660834474!3d47.418325999760285!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40e2494be40c1515%3A0xa72a858de1c17863!2z0JvQsNCx0L7RgNCw0YLQvtGA0L3Ri9C5INC60L7RgNC_0YPRgSDQrtCg0JPQn9CjKNCd0J_QmCk!5e0!3m2!1sru!2sru!4v1610374695578!5m2!1sru!2sru" width=100% height=200px frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

</div>
<?php
include ('footer.php');
?>
</body>
</html>
