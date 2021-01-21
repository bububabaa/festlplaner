<?php

    session_start();

$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";


$db = new PDO($dsn,$username,$password);

$sql = "SELECT * FROM festl";
$result = $db->query($sql);
$i=0;
$arrfid = array();
$arrbezeichnung = array();
$arrdatum = array();
$arrplz = array();
$arrort = array();
$arrstrasse = array();
$arrhausnummer = array();
$arrbeschreibung = array();
$arreintritt = array();
$arreinlass = array();
$arrbeginn = array();
$arrende=array();
$arraid = array();
$arrfoto=array();
while($row = $result->fetch()){
    $arrfid[$i]= $row['FID'];
    $arrbezeichnung[$i] = $row['Bezeichnung'];
    $arrdatum[$i] = $row['Datum'];
    $arrplz[$i]= $row['PLZ'];
    $arrort[$i]= $row['Ort'];
    $arrstrasse[$i]= $row['Strasse'];
    $arrhausnummer[$i]= $row['Hausnummer'];
    $arrbeschreibung[$i]= ($row['Beschreibung']=nl2br($row['Beschreibung']));
    $arreintritt[$i]= $row['Eintritt'];
    $arreinlass[$i]= $row['EinlassAb'];
    $arrbeginn[$i]= $row['Beginn'];
    $arrende[$i]= $row['Ende'];
    $arraid[$i]= $row['AID'];
    $arrfoto[$i]=$row['Titelbild'];

    $i++;
}

/*
$date = DateTime::createFromFormat('Y-m-d', $arrdatum[$rdm_1]);
$converted_date = $date->format('D d.m.Y');

$time1 =DateTime::createFromFormat('G:i:s', $arreinlass[$rdm_1]);
$time2 =DateTime::createFromFormat('G:i:s', $arrbeginn[$rdm_1]);
$time3 =DateTime::createFromFormat('G:i:s', $arrende[$rdm_1]);
$converted_time1 = $time1->format('H:i');
$converted_time2 = $time2->format('H:i');
$converted_time3 = $time3->format('H:i');

$anbieterid=$arraid[$rdm_1];
//echo $anbieterid;

$sql2 ="SELECT * FROM anbieter WHERE AID='".$anbieterid."'";
$result = $db->query($sql2);
$a=0;
$veranstalter = array();
while($row = $result->fetch()){
    $veranstalter[$a]= $row['Name'];

    $a++;
}
$clicked_festl=$arrfid[$rdm_1];
$_SESSION["clicked_festl"]=$clicked_festl;
//echo $clicked_festl1;
//echo $veranstalter[0];
$sql3 = "SELECT * FROM festl WHERE FID='".$clicked_festl."'";
//echo $sql3;
$result = $db->query($sql3);
$b=0;
$weblink=array();
$arrfoto=array();
while($row = $result->fetch()){
    $weblink[$b]= $row['Webadresse'];
    $arrfoto[$b]=$row['Titelbild'];

    $b++;
}
}*/
?>

<!DOCTYPE html>
<html>

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Festlplaner</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
#more {display: none;}
</style>


</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <div id="main">
            <div class="inner">

                <!-- Header -->
                <header id="header">
                    <div class="logo">
                        <a href="index.php">Festlplaner</a>
                    </div>
                </header>

                <!--ab hier Code einfügen-->
                <section class="main-banner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="banner-caption">
                                            <h1><?php echo $arrbezeichnung[5]?></h1>
                                            <div class="row">
                                                <div class="col-md-3">

                                                    <h4>Datum:</h4>
                                                    <h4>Straße/Hausnummer:</h4>
                                                    <h4>PLZ/Ort:</h4>
                                                    <h4>Eintritt:</h4>
                                                    <h4>Einlass ab:</h4>
                                                    <h4>Beginn:</h4>
                                                    <h4>Ende:</h4>
                                                    <br><br>

                                                    <h4>Beschreibung:</h4>

                                                </div>
                                                <div class="col-md-5">


                                                    <h4><?php echo $arrdatum[5]?></h4>
                                                    <h4><?php echo $arrstrasse[5]; echo " "; echo $arrhausnummer[5]?></h4>
                                                    <h4><?php echo $arrplz[5]; echo " "; echo $arrort[5]?></h4>
                                                    <h4><?php echo $arreintritt[5]; echo " €"?></h4>
                                                    <h4><?php echo $arreinlass[5]; echo " Uhr"?></h4>
                                                    <h4><?php echo $arrbeginn[5]; echo " Uhr"?></h4>
                                                    <h4><?php echo $arrende[5]; echo " Uhr"?></h4>
                                                    <br><br>
                                                    <h4><span id="dots">...</span>
                                                    <span id="more"><?php echo $arrbeschreibung[5]; ?></span></h4>
                                                    <button onclick="myFunction()" id="myBtn">Read more</button>
                                                </div>

                                                 <div class="col-md-4">

                                                    <?php
                                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($arrfoto[5]) . '">';
                                                    ?>
                                                </div>
                                            </div>

<!--<h2>Read More Read Less Button</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas vitae scel<span id="dots">...</span><span id="more">erisque enim ligula venenatis dolor. Maecenas nisl est, ultrices nec congue eget, auctor vitae massa. Fusce luctus vestibulum augue ut aliquet. Nunc sagittis dictum nisi, sed ullamcorper ipsum dignissim ac. In at libero sed nunc venenatis imperdiet sed ornare turpis. Donec vitae dui eget tellus gravida venenatis. Integer fringilla congue eros non fermentum. Sed dapibus pulvinar nibh tempor porta.</span></p>
<button onclick="myFunction()" id="myBtn">Read more</button>-->


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--bis hier Code einfügen-->

            </div>
        </div>
<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more";
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less";
    moreText.style.display = "inline";
  }
}
</script>
        <?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateSidebar.php'?>

    </div>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>

</body>
</html>
