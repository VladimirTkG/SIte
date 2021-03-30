<?php
  $host = '127.0.0.1';
  $user = 'AdminDBSITE';
  $password = 'PiRaTe08642';
  $database = "kursovaya";
  if(isset($_POST["ADDTovar"])){
    $kat= trim($_POST["Category"]);
    $Nazv= trim($_POST["Nazv"]);
    $kolvo= trim($_POST["kolvo"]);
    $cena= trim($_POST["cena"]);
    $akciya= trim($_POST["akciya"]);
    $errorNaz="";
    $errorKolvo="";
    $errorcena="";
    $errorak="";
    $errorKat="";
    $error = false;
    if($kat ==""){
      $errorKat="Введите категорию";
      $error = true;
    }
    if($Nazv ==""){
      $errorNaz="Введите название";
      $error = true;
    }
    if($kolvo ==""){
      $errorKolvo="Введите количество";
      $error = true;
    }
    if($cena ==""){
      $errorcena="Введите цену";
      $error = true;
    }

$Res_inf = "";
if ($error == false) {
  $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");




  if (empty(mysqli_fetch_assoc(mysqli_query($link, "SELECT  `Nazvanie` FROM `tovar` WHERE `Nazvanie` = '$Nazv'"))))
      {
        $queryKat = "SELECT * FROM `kategoritov` WHERE `NazvanieKat` LIKE '$kat'";
        $resultKat = mysqli_query($link, $queryKat);


        $row = mysqli_fetch_assoc($resultKat);
        $IDKATEGORI = $row[ID];
        print_r($row);

        if ($resultKat){
        $query = "INSERT INTO `tovar`( `IDKategori`, `Nazvanie`, `Kolvo`, `Cena` ) VALUES ('$IDKATEGORI','$Nazv', '$kolvo','$cena')";
        $result = mysqli_query($link, $query);
        if ($result) $Res_inf = "Товар добавлен";
       }
      }
     }
   }

   if(isset($_POST["UPDATE"])){
    $TovUpd = trim($_POST["Tovar"]);
    $katUpd= trim($_POST["CatUpd"]);
    $NazvUpd= trim($_POST["UpdNazv"]);
    $kolvoUpd= trim($_POST["Updkolvo"]);
    $cenaUpd= trim($_POST["Updcena"]);
    $akciyaUpd= trim($_POST["Updakciya"]);
     $errorTov="";
     if($kat ==""){
       $errorTov="Выбирите товар";
       $errorUpd = true;
   }

   $Res_inf = "";
   if ($errorUpd == false) {
     $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");
      $querysellll = "SELECT  * FROM `tovar` WHERE `Nazvanie` = '$NazvUpd'";
      $ressellll = mysqli_query($link, $querysellll);
      $rowTovar = mysqli_fetch_assoc($ressellll)[0];
      $UPDTOVARRR = $rowTovar[ID];

     if (empty(mysqli_fetch_assoc(mysqli_query($link, "SELECT  `Nazvanie` FROM `tovar` WHERE `Nazvanie` = '$NazvUpd'")))){
       if ($katUpd != 0 || $NazvUpd != 0 || $kolvoUpd != 0 || $cenaUpd != 0){
       if ($katUpd != 0) {

         $queryUPD = "UPDATE tovar SET IDKategori = '$katUpd' WHERE ID = $UPDTOVARRR ";
         $resultUPD = mysqli_query($link, $queryUPD);
       }
       if ($NazvUpd != 0) {
         $queryUPDd = "UPDATE tovar SET Nazvanie = '$NazvUpd' WHERE ID = $UPDTOVARRR ";
         $resultUPDd = mysqli_query($link, $queryUPDd);
       }
       if ($kolvoUpd != 0) {
         $queryUPDdd = "UPDATE tovar SET Kolvo = '$kolvoUpd' WHERE ID = '$UPDTOVARRR' ";
         $resultUPDdd = mysqli_query($link, $queryUPDdd);

       }
       if ($cenaUpd != 0) {
         $queryUPDddd = "UPDATE tovar SET Cena = '$cenaUpd 'WHERE ID = '$UPDTOVARRR' ";
         $resultUPDddd = mysqli_query($link, $queryUPDddd);
       }
       if ($akciyaUpd != 0) {
         $queryUPDdddd = "UPDATE tovar SET Akciya = '$akciyaUpd' WHERE ID = '$UPDTOVARRR' ";
         $resultUPDdddd = mysqli_query($link, $queryUPDdddd);
       }
     }else {
       echo "Не введены данные";
     }

     }
   }
}
?>
  <body>
        <?php
        include ('header.php');
        include ('Menu.php');
        ?>


        <div class="">

      <!--    <a style="margin: 15px 2.5px ;width: 29%" class="buttonAdm"  href="Dobavit.php?Admin=1">Работа с заказами</a> -->
          <a style="width: 30%; margin: 0 34%" class="buttonAdm"  href="Dobavit.php?Admin=2">Добавление товара</a>
        <!--  <a style="width: 29.2%" class="buttonAdm"  href="Dobavit.php?Admin=3">Изменение товара</a> -->

        </div>

<?php
if ($_GET['Admin'] == "1") :
  $host = '127.0.0.1';
  $user = 'AdminDBSITE';
  $password = 'PiRaTe08642';
  $database = "kursovaya";
  $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");

  function getNames(){
   global $link;
   $queryss = "SELECT ID, Name FROM polzovatel";
   $resss = mysqli_query($link, $queryss);
   return mysqli_fetch_all($resss, MYSQLI_ASSOC);

  }

  function getZakaz(){
   global $link;
   $code = mysqli_real_escape_string($link, $_POST['code']);
   $queryee = "SELECT DISTINCT Nomer FROM zakaz WHERE IDPolzov = '$code'";
   $resee = mysqli_query($link, $queryee);
   $data = '';
   while($rowee = mysqli_fetch_assoc($resee)){
    $data .= "<option value='{$rowee['Nomer']}'>{$rowee['Nomer']}</option>";
   }
   return $data;
  }

  if(!empty($_POST['code'])){
   echo getZakaz();
   exit;
  }

  $namess = getNames();
 ?>

        <div class="formar">
          <form class="form" action="" method="post">
          <label style="margin: 0 12%;">Пользователь:</label> </br>
          <select name="polzovatel" id="polzovatel">
                <?php foreach($namess as $name): ?>
                  <option value="<?=$name['ID']?>"><?=$name['Name']?></option>
                <?php endforeach; ?>



          <label style="margin: 0 8%;">Выбрать заказ:</label> <br>
            <select class="form-group zakSelect" name="Zakaz" id="Zakaz">
            </select>


          <br/><label style="margin: 0 8%;">Изменить состояние:</label> <br>
          <select name="status">
          <option value="0" style=" text-align: center; display:none;">Выберите из списка</option>
          <option value="1" style=" text-align: center;">Ожидает подтверждения</option>
          <option value="2" style=" text-align: center;">Подтвержден</option>
          <option value="3" style=" text-align: center;">Ожидает исполнения</option>
          <option value="4" style=" text-align: center;">Исполнен</option></select>
          <span style=" color:#640002"><?=$errorak?> </span><br>
          <input style="margin: 7px 2%;" class="superbutton" type="submit" name="Updat" value="Обновить статус"><br>
          <label style="color:#640002; font-size:22px; margin: 0 0;"><?=$Res_inf?></label>
          </form>

        </div>
<?php
elseif ($_GET['Admin'] == "2"):
 ?>
         <div class="formar">
           <form class="form" action="" method="post">
           <label style="margin: 0 14%;">Категория:</label> </br>
           <select name="Category"><br />
                            <option value="0" style=" text-align: center;display:none;">Выберите из списка</option>
                            <?php
                            $host = '127.0.0.1';
                            $user = 'AdminDBSITE';
                            $password = 'PiRaTe08642';
                            $database = "kursovaya";
                            $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");
                            $query_sp = "SELECT DISTINCT NazvanieKat FROM kategoritov";
                            $result_sp = mysqli_query($link, $query_sp);
                            if (mysqli_num_rows($result_sp) > 0)
                            {
                                while ( $row = mysqli_fetch_assoc( $result_sp ) )
                                {
                                    echo "<option value=".$row[ 'NazvanieKat' ].">".$row[ 'NazvanieKat' ]."</option>";
                                }
                                echo "</select><br>";
                            }
                            mysqli_close($link);
                            ?>
           <span style=" color:#640002"><?=$errorKat?></span> </br>
           <label style="margin: 0 14%;">Название:</label> </br>
           <input type="text" name="Nazv"/> </br>
           <span style=" color:#640002"><?=$errorNaz?></span> </br>
           <label style="margin: 0 17%;">Кол-во:</label> </br>
           <input type="integer" maxlength="11" name='kolvo'/> </br>
           <span style=" color:#640002"><?=$errorKolvo?></span> </br>
           <label style="margin: 0 18%;">Цена:</label> </br>
           <input type="integer" name='cena'/> </br>
           <span style=" color:#640002"><?=$errorcena?></span> </br>
        <!--     <label style="margin: 0 17%;">Акция:</label> </br>
           <select name="akciya"></br>
           <option value="Yes" style=" text-align: center;">Есть</option>
           <option value="No" style=" text-align: center;">Нет</option>
         </select>--></br>
           </br><span style=" color:#640002"><?=$errorak?> </span>
           <input style="margin: 7px -3%;" class="superbutton"  type="submit" name="ADDTovar" value="Занести новый товар"></br>
           <label style="color:#640002; font-size:22px; margin: 0 0;"><?=$Res_inf?></label>
           </form>

         </div>
<?php
elseif ($_GET['Admin'] == "3") :
 ?>
           <div class="formar">
             <form class="form" action="" method="post">
               <label style="margin: 0 14%;">Товар:</label> </br>
               <select name="Tovar"><br />
                                <option value="0" style=" text-align: center;display:none;">Выберите из списка</option>
                                <?php
                                $host = '127.0.0.1';
                                $user = 'AdminDBSITE';
                                $password = 'PiRaTe08642';
                                $database = "kursovaya";
                                $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");
                                $query_sp = "SELECT DISTINCT Nazvanie FROM tovar";
                                $result_sp = mysqli_query($link, $query_sp);
                                if (mysqli_num_rows($result_sp) > 0)
                                {
                                    while ( $row = mysqli_fetch_assoc( $result_sp ) )
                                    {
                                        echo "<option value=".$row[ 'Nazvanie' ].">".$row[ 'Nazvanie' ]."</option>";
                                    }
                                    echo "</select><br>";
                                }
                                mysqli_close($link);
                                ?>
              <b> <label style="font-size: 30px; margin: 0 -34px;">Изменить в нем</label></b> </br>
               <label style="margin: 0 14%;">Категория:</label> </br>

               <select name="CatUpd"><br />
                                <option value="0" style=" text-align: center;display:none;">Выберите из списка</option>
                                <?php
                                $host = '127.0.0.1';
                                $user = 'AdminDBSITE';
                                $password = 'PiRaTe08642';
                                $database = "kursovaya";
                                $link = mysqli_connect($host, $user, $password, $database) or die ("Невозможно подключение к MySQL");
                                $query_sp = "SELECT DISTINCT NazvanieKat, ID FROM kategoritov";
                                $result_sp = mysqli_query($link, $query_sp);
                                if (mysqli_num_rows($result_sp) > 0)
                                {
                                    while ( $row = mysqli_fetch_assoc( $result_sp ) )
                                    {
                                        echo "<option value=".$row[ 'ID' ].">".$row[ 'NazvanieKat' ]."</option>";
                                    }
                                    echo "</select><br>";
                                }
                                mysqli_close($link);
                                ?>
             <span style=" color:#640002"><?=$errorKat?></span> </br>
             <label style="margin: 0 14%;">Название:</label> </br>
             <input type="text" name="UpdNazv"/> </br>
             <span style=" color:#640002"><?=$errorNaz?></span> </br>
             <label style="margin: 0 17%;">Кол-во:</label> </br>
             <input type="integer" maxlength="11" name='Updkolvo'/> </br>
             <span style=" color:#640002"><?=$errorKolvo?></span> </br>
             <label style="margin: 0 18%;">Цена:</label> </br>
             <input type="integer" name='Updcena'/> </br>
             <span style=" color:#640002"><?=$errorcena?></span> </br>
             <label style="margin: 0 17%;">Акция:</label> </br>
             <select name="Updakciya"></br>
             <option value="Yes" style=" text-align: center;">Есть</option>
             <option value="No" style=" text-align: center;">Нет</option>
           </select></br>
             <input style="margin: 7px -2%;" class="superbutton" type="submit" name="UPDATE" value="Занести новый товар"></br>
             <label style="color:#640002; font-size:22px; margin: 0 0;"><?=$Res_inf?></label>
             </form>

           </div>

        <?php
      endif;
        include ('footer.php');

         ?>
        </body>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>

<script>
$(function(){

$('#polzovatel').change(function(){
var code = $(this).val();
$('#Zakaz').load('Dobavit.php', {code: ID}, function(){
$('.zakSelect').fadeIn('slow');
});

});

});
</script>
