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

    $i++;
}

if (isset($_SESSION['loggedin'])) {

//$rdm_1 = $_SESSION["rdm1"];
//$rdm_2 = $_SESSION["rdm2"];
$rdm_3 = $_SESSION["rdm3"];

}

else
{
    header("Location: login.php");
    die();
}
$date = DateTime::createFromFormat('Y-m-d', $arrdatum[$rdm_3]);
$converted_date = $date->format('D d.m.Y');

$time1 =DateTime::createFromFormat('G:i:s', $arreinlass[$rdm_3]);
$time2 =DateTime::createFromFormat('G:i:s', $arrbeginn[$rdm_3]);
$time3 =DateTime::createFromFormat('G:i:s', $arrende[$rdm_3]);
$converted_time1 = $time1->format('H:i');
$converted_time2 = $time2->format('H:i');
$converted_time3 = $time3->format('H:i');

$anbieterid=$arraid[$rdm_3];

$sql2 ="SELECT Name FROM anbieter WHERE AID='".$anbieterid."'";
$result = $db->query($sql2);
$a=0;
while($row = $result->fetch()){
    $veranstalter[$a]= $row['Name'];

    $a++;
}
$clicked_festl=$arrfid[$rdm_3];
$_SESSION["clicked_festl"]=$clicked_festl;

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
?>

<!DOCTYPE html>
<html lang="de">

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
                                           <?php
                                            if($weblink[0]==null)
                                            {?>
                                                <h1><?php echo $arrbezeichnung[$rdm_3]?></h1>
                                                <br>
                                            <?php
                                            }
                                            else
                                            {?>
                                               <h1><?php echo $arrbezeichnung[$rdm_3]?></h1> <h5>Klicken Sie <a href="webpage.php">hier</a> um mehr über unsere Veranstaltungen zu erfahren.</h5>
                                            <?php
                                            }?>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h3>Veranstalter:</h3>
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
                                                    <h3><?php echo $veranstalter[0]?></h3>
                                                    <h4><?php echo $converted_date?></h4>
                                                    <h4><?php echo $arrstrasse[$rdm_3]; echo " "; echo $arrhausnummer[$rdm_3]?></h4>
                                                    <h4><?php echo $arrplz[$rdm_3]; echo " "; echo $arrort[$rdm_3]?></h4>
                                                    <h4><?php echo $arreintritt[$rdm_3]; echo " €"?></h4>
                                                    <h4><?php echo $converted_time1; echo " Uhr"?></h4>
                                                    <h4><?php echo $converted_time2; echo " Uhr"?></h4>
                                                    <h4><?php echo $converted_time3; echo " Uhr"?></h4>
                                                    <br><br>

                                                    <!--<h4>Eintritt ab 18 Jahren
                                                        <br> Alkhohol für jeden
                                                        <br> Musik für jeden
                                                        <br> Knochen MC und Raf Camaro LIVE
                                                    </h4>-->

                                                    <h4>
                                                        <?php echo $arrbeschreibung[$rdm_3]?>
                                                    </h4>
                                                </div>

                                                <div class="col-md-4">
                                                    <!--<img src="assets/images/featured_post_01.jpg">-->
                                                    <?php
                                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($arrfoto[0]) . '">';
                                                    ?>
                                                </div>
                                            </div>
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
