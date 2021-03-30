
<body>


<?php
include ('header.php');
include ('Menu.php');
 ?>


<div class="product">
  <?php
  $host = '127.0.0.1';
  $user = 'AdminDBSITE';
  $password = 'PiRaTe08642';
  $database = "kursovaya";
  $EmCooK = $_COOKIE['cookie_log'];

  $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");


  $query = "SELECT  Nazvanie, kolvo, cena, NazvanieKat, tovar.ID FROM tovar,kategoritov WHERE kategoritov.ID = IDKategori";
  $result = mysqli_query($link, $query);

  $query123 = "SELECT kolvo FROM tovar";
  $result123 = mysqli_query($link, $query123);



    $query1= "SELECT COUNT(*) FROM tovar";
    $result1= mysqli_query($link, $query1);

    $cnt = mysqli_fetch_row($result1)[0];
    if (mysqli_num_rows($result) > 0)
    {
    echo "<div class =
    border_inf>"."<h2>"."Количество продуктов:
    ".$cnt."</h2>"."</div>";
    while ($row =
    mysqli_fetch_assoc($result))

    {
      $cnt1 = mysqli_fetch_row($result123)[$row['ID']];

      if ($cnt1 = mysqli_fetch_row($result123)[$row['ID']] != '0')
      {
        if ($row['kolvo'] != '0')
      {  echo "<div class =
        borderTovar><h2>".$row['Nazvanie']."</h2>".
        '<b>'.Осталось.': '.'</b>'.$row['kolvo'].'<br />'.
        '<b>'.Цена.' '.товара.': '.'</b>'.$row['cena'].'<br />'.
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
        '<b>'.Осталось.': '.'</b>'.$row['kolvo'].'<br />'.
        '<b>'.Цена.' '.товара.': '.'</b>'.$row['cena'].'<br />'.
        '<b>'.Вид.' '.товара.': '.'</b>'.$row['NazvanieKat'].'<br />';
        echo "<a style=\"color:#640002; font-size:22px;\"> Товар отсутствует. </a> </div>";
    }
  }
}


}
mysqli_close($link);

?>

</div>

<?php
include ('footer.php');
?>
</body>
