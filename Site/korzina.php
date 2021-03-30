<?php
  $host = '127.0.0.1';
  $user = 'AdminDBSITE';
  $password = 'PiRaTe08642';
  $database = "kursovaya";


  setcookie("summ", $summmm, time() + 15);

  if (isset($_POST["plus"])) header("Refresh:0.00001");
  if (isset($_POST["minus"])) header("Refresh:0.00001");
  if (isset($_POST["DELETEe"])) header("Refresh:0.00001");





  $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");
  if ($_COOKIE['cookie_log'] != ""){

  $IDTovar = $_GET['tovar_id'];
  $IDpolzovatel = $_COOKIE['cookie_log'];
  if ($_GET['tovar_id'] != 0)
  {
      header("Location: korzina.php");
      $query = "SELECT kolvo FROM tovar WHERE ID = '$IDTovar'";
      $result = mysqli_query($link, $query);
      $cnt = mysqli_fetch_row($result)[0];
      $kolvonew = $cnt - 1 ;
      $queryUpd = "UPDATE tovar SET kolvo = '$kolvonew' WHERE ID = '$IDTovar'";
      $result232 = mysqli_query($link, $queryUpd);

      $queryProv = "SELECT * FROM korzina WHERE IDTovar = '$IDTovar' AND IDpokup = '$IDpolzovatel'";
      $resultProv = mysqli_query($link, $queryProv);

      if (!(mysqli_num_rows($resultProv)==0)){
        $queryKolvo = "SELECT KolvoVKorz FROM korzina WHERE IDTovar = '$IDTovar' AND IDpokup = '$IDpolzovatel'";
        $resultKolvo = mysqli_query($link, $queryKolvo);

        $kolvoVKorz = mysqli_fetch_row($resultKolvo)[0] + 1;

        $queryInserUpd = "UPDATE korzina SET KolvoVKorz = $kolvoVKorz WHERE IDTovar = '$IDTovar' AND IDpokup = '$IDpolzovatel'";
        $resultInserUpd = mysqli_query($link, $queryInserUpd);
      }
         else
        {
          $queryInser = "INSERT INTO korzina(ID, IDpokup, IDTovar, KolvoVKorz) VALUES(NULL, '$IDpolzovatel','$IDTovar','1')";
          $resultInser = mysqli_query($link, $queryInser);
        }



  };
  if ($_GET['del_tov'] != 0){
    $TOVDEL = $_GET['del_tov'];
    header("Location: korzina.php");
    $query1udal = "SELECT KolvoVKorz FROM korzina WHERE $IDpolzovatel = IDpokup AND $TOVDEL = IDTovar";
    $result1udal= mysqli_query($link, $query1udal);
    $Udal = mysqli_fetch_row($result1udal)[0] - 1;

    if ($Udal > 0){
    $query1Upd = "UPDATE korzina SET KolvoVKorz = '$Udal' WHERE IDTovar = $TOVDEL AND IDpokup = $IDpolzovatel";
    $result1Upd = mysqli_query($link, $query1Upd);

  }else {
    $query1Upd = "DELETE FROM korzina WHERE IDTovar = $TOVDEL AND IDpokup = $IDpolzovatel";
    $result1Upd = mysqli_query($link, $query1Upd);
  }

  }
  if ($_GET['add_tov'] != 0){
    header("Location: korzina.php");
    $TOVADD = $_GET['add_tov'];
    $query1udal = "SELECT KolvoVKorz FROM korzina WHERE $IDpolzovatel = IDpokup AND $TOVADD = IDTovar";
    $result1udal= mysqli_query($link, $query1udal);
    $Udal = mysqli_fetch_row($result1udal)[0] + 1;
    $query1Upd = "UPDATE korzina SET KolvoVKorz = '$Udal' WHERE IDTovar = $TOVADD AND IDpokup = $IDpolzovatel";
    $result1Upd = mysqli_query($link, $query1Upd);
    $querySEl2 = "SELECT * FROM korzina,tovar WHERE IDTovar = tovar.ID AND IDpokup = $IDpolzovatel";
    $resultSEL2 = mysqli_query($link, $querySEl2);
  }
  if ($_GET['deleteall'] != 0){
    header("Location: korzina.php");
    $deletealll = $_GET['deleteall'];
    echo $deletealll;
    $query1d = "DELETE FROM korzina WHERE IDTovar = $deletealll AND IDpokup = $IDpolzovatel";
    $result1d = mysqli_query($link, $query1d);
  }
}




  $querySEl = "SELECT * FROM korzina,tovar WHERE IDTovar = tovar.ID AND IDpokup = $IDpolzovatel";
  $resultSEL = mysqli_query($link, $querySEl);

  $query1= "SELECT COUNT(*) FROM korzina WHERE '$IDpolzovatel' = IDpokup";
  $result1= mysqli_query($link, $query1);?>
<body>
  <?php
  include ('header.php');
  include ('Menu.php');
   ?>


<?php

$cnt = mysqli_fetch_row($result1)[0];
if (mysqli_num_rows($resultSEL) > 0)
{
echo "<a style = \" background-color: #f573736f;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;\"
  onmouseover=\"this.style.backgroundColor='#555';\"
  onmouseout=\"this.style.backgroundColor='#f573736f';\"
  href=\"OformZakaz.php\">Оформить заказ</a>";
echo "<div class =
border_inf>"."<h2>"."Количество продуктов:
".$cnt."</h2>"."</div>";





while ($row =
mysqli_fetch_assoc($resultSEL))
{

$Umbog = $row['Cena']*$row['KolvoVKorz'];
$summmm = $summmm + $Umbog;

echo "<div class =
borderTovar>
<div style='display:flex; flex-direction: row;'>
<div style=''>
<h2>"; echo $row['Nazvanie']; echo "</h2>
<b>Цена товара: </b>".$row['Cena']; echo "<br />
<a class = \"plusminus\" href=\"korzina.php?del_tov="; echo $row['IDTovar']; echo "\"> -</a><b>"; echo $row['KolvoVKorz'];
 echo "</b><a class = \"plusminus\" href=\"korzina.php?add_tov="; echo $row['IDTovar']; echo "\"> +</a><br />";
   echo  "</div><div style='padding-left:80%; padding-top:30px;'>
   <a style = \" background-color: #f573736f;
   color: white;
   padding: 14px 25px;
   text-align: center;
   text-decoration: none;
   display: inline-block;\"
   onmouseover=\"this.style.backgroundColor='#555';\"
   onmouseout=\"this.style.backgroundColor='#f573736f';\" href=\"korzina.php?deleteall="; echo $row['IDTovar']; echo "\"> X</a></div></div></div>";





}echo "<a class=\"emptykorz\">Сумма =";echo $summmm;echo "<a>";
}
else {
  echo "<a class=\"emptykorz\" > Корзина пуста </a>";
};

?>



<?php
include ('footer.php');

?>
</body>
