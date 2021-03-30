<?php
$host = '127.0.0.1';
$user = 'AdminDBSITE';
$password = 'PiRaTe08642';
$database = "kursovaya";


$link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");

$CookID = $_COOKIE['cookie_log'];


$query = "SELECT SUM(cena) FROM (SELECT korzina.ID, IDpokup, IDTovar, cena FROM korzina, tovar WHERE IDTovar = tovar.ID) AS korz WHERE IDpokup = '$CookID'";
$result= mysqli_query($link, $query);
$cnt = mysqli_fetch_row($result)[0];





settype($cnt,"integer");

date_default_timezone_set('Europe/Moscow');
$today = date("Y-m-d");
$Nomer1 =  (string) date("Ymdhms");
$Nomer2 = (string) $CookID;
$Nomer = "$Nomer1$Nomer2";
//echo $Nomer;
//echo " ";

if($cnt != 0){
  $query_id = "SELECT ID FROM korzina WHERE IDpokup = $_COOKIE[cookie_log]";
  $result_id = mysqli_query($link,$query_id);

  while ($IDkorzTov = mysqli_fetch_assoc($result_id))
      {
        $IDDkorz = $IDkorzTov['ID'];

      $query_order = "INSERT INTO zakaz (ID,	Nomer,	DataSozd,	IDKorzin,	IDPolzov,	Summa,	Sostoyan, Name_Tovar, Count) VALUES (
      NULL,
      '$Nomer',
      CURRENT_DATE(),
      '$IDDkorz',
      '$_COOKIE[cookie_log]',
      (SELECT DISTINCT tovar.Cena*korzina.KolvoVKorz AS summa
        FROM tovar INNER JOIN korzina ON korzina.IDpokup = '$CookID'
        && korzina.IDTovar = tovar.ID &&  korzina.ID = '$IDDkorz'),
        'Ожидает подтверждения',
      (SELECT `Nazvanie` FROM `korzina`,`tovar` WHERE korzina.ID = '$IDkorzTov[ID]' AND IDTovar = tovar.ID),
      (SELECT `KolvoVKorz` FROM `korzina` WHERE ID = '$IDkorzTov[ID]'))";
      $result_order = mysqli_query($link,$query_order);
    /*  $result_order= ($link, "INSERT INTO orders (id, id_tovar_cart,id_user, fio,nomer_order, index_mail, location_delivery, status_order, summa,name_tovar,count, date) VALUES (
      NULL,
      '$id_tovar_cart[id]',
      '$_COOKIE[name]',
      (SELECT name FROM users_regisrt WHERE id='$_COOKIE[name]'),
      '$_COOKIE[name]$my_date',
      (SELECT index_mail FROM users_regisrt WHERE id='$_COOKIE[name]'),
      (SELECT location_delivery FROM users_regisrt WHERE id='$_COOKIE[name]'),
      'Не исполнено',
      (SELECT DISTINCT tovar.price*tovar_cart.count AS summa FROM tovar INNER JOIN tovar_cart ON tovar_cart.id_users_regisrt= $_COOKIE[name] && tovar_cart.id_tovar=tovar.id &&  tovar_cart.id = '$id_tovar_cart[id]'),
      (SELECT name FROM tovar_cart WHERE id='$id_tovar_cart[id]'),
      (SELECT count FROM tovar_cart WHERE id='$id_tovar_cart[id]'),
      CURRENT_DATE());");
    */
    //  if($result_order)
    //  {
    //  $query_status ="UPDATE tovar_cart SET status='В заказе' WHERE id='$id_tovar_cart[id]'";
    //  $result_status= mysqli_query($link, $query_status);
    //  }
  }




  // echo "$Nomer $today $CookID $cnt";
//  $quaryInsert = "INSERT INTO zakaz ( ID, Nomer, DataSozd, IDKorz, Summa, Sostoyan) VALUES (Null, '$Nomer', '$today',  '$CookID', '$cnt', 'Ожидает подтверждения')";
//  $resultInsert= mysqli_query($link, $quaryInsert);
//


$quaryClear = "DELETE FROM `korzina` WHERE IDpokup = '$CookID'";
$resultClear = mysqli_query($link, $quaryClear);

if ($resultClear){
header("Location: zakazi.php?zakazOf=1");}
};
?>
<body style="flex: 0 0 auto;">
<?php
include ('header.php');
include ('Menu.php');
 ?>

<div class="">


</div>




 <?php
 include ('footer.php');
 ?>
 </body>
