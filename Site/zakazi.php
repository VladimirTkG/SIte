<?php
  $host = '127.0.0.1';
  $user = 'AdminDBSITE';
  $password = 'PiRaTe08642';
  $database = "kursovaya";

  $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");


$IDpolzovatel = $_COOKIE['cookie_log'];
$queryot = "SELECT * FROM zakaz  WHERE IDPolzov = $IDpolzovatel";
$resultSEL = mysqli_query($link, $queryot);

$queryotC = "SELECT DISTINCT Nomer, Sostoyan, DataSozd FROM zakaz  WHERE IDPolzov = $IDpolzovatel ORDER BY ID DESC";
$resultSELC = mysqli_query($link, $queryotC);

$query1="SELECT COUNT(*) FROM (SELECT DISTINCT `Nomer` FROM zakaz WHERE IDPolzov = $IDpolzovatel) AS dt";
$result1 = mysqli_query($link, $query1);
$cnt = mysqli_fetch_row($result1)[0];

?>


<body>
<?php

include ('header.php');
include ('Menu.php');
?>
<?php



if (mysqli_num_rows($resultSELC) > 0)
{

echo "<div class =
border_inf>"."<h2>"."Количество заказов:
".$cnt."</h2>"."</div>";
while ($roww =
mysqli_fetch_assoc($resultSELC))
{
if (mysqli_num_rows($resultSEL) > 0)
{

  $query = "SELECT SUM(summa) FROM zakaz WHERE Nomer = $roww[Nomer]";
  $result= mysqli_query($link, $query);
  $cnt11 = mysqli_fetch_row($result)[0];
  }
echo "<div class =
borderTovar><h2>".'<b>'.Номер.' '.заказа.': '.'</b>'.$roww['Nomer']."</h2>".Состояние.' '.заказа.': '.'</b>'.$roww['Sostoyan'].'<br />'.
'<b>'.Дата.' '.создания.': '.$roww[DataSozd].'</b></br>'; echo "<b>Состав:</br></b>";
$queryzakaz = "SELECT Name_Tovar, Count, Summa FROM zakaz WHERE IDPolzov = $IDpolzovatel AND Nomer = $roww[Nomer]";
$reszakaz = mysqli_query($link, $queryzakaz);



while ($rowzakaz =
mysqli_fetch_assoc($reszakaz)) {

  echo "<b style = \" color:#572c43bc;\">Товар:";echo $rowzakaz[Name_Tovar]; echo "</br> КОЛИЧЕСТВО: "; echo $rowzakaz[Count]; echo " </br>Сумма товара в заказе: "; echo $rowzakaz[Summa]; echo "</br></br></br></b>";

}
echo '<b style = \'font-size: 25px\'>'.Сумма.' '.заказа.': '.$cnt11.'</b> <br /> <b>';
echo  "</div>";
}


}
?>
<?php
include ('footer.php');
?>
</body>
