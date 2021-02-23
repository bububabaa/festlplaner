<?php

session_start();

/*$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";*/

$username = "digbizm_1";
$password = "2021##Fireme";
$dsn = "mysql:host=sql349.your-server.de;dbname=festlpage;charset=utf8";


$db = new PDO($dsn,$username,$password);

$timestamp=time();

$dtNow = new DateTime();
// Set a non-default timezone if needed
$dtNow->setTimezone(new DateTimeZone('Europe/Vienna'));
$dtNow->setTimestamp($timestamp);

$beginOfDay = clone $dtNow;
$beginOfDay->modify('today');

/* $endOfDay = clone $beginOfDay;
$endOfDay->modify('tomorrow');

$endOfDateTimestamp = $endOfDay->getTimestamp();
$endOfDay->setTimestamp($endOfDateTimestamp - 1);*/

$heutedatum = $beginOfDay->format('Y-m-d H:i:s');

$sql = "SELECT * FROM festl Where Datum>='".$heutedatum."'";
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

$rdm_1 = $_SESSION["rdm1"];
$rdm_2 = $_SESSION["rdm2"];
$rdm_3 = $_SESSION["rdm3"];


/*$id_ = $_SESSION["id"];
$id1_ = $_SESSION["id1"];
$id2_ = $_SESSION["id2"];
$id3_ = $_SESSION["id3"];*/
//echo $rdm_1;
}
else
{
    header("Location: login.php");
    die();
}
$date = DateTime::createFromFormat('Y-m-d', $arrdatum[$rdm_1]);
$converted_date = $date->format('d.m.Y');

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
//echo $weblink[0];
?>

<!DOCTYPE html>
<html lang="de">
<link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
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
                                            <div class="row">
                                                <div class="col-11">
                                                    <h1><?php echo $arrbezeichnung[$rdm_1]?></h1>
                                                </div>
                                                <div class="col-1">
                                                    <a href="index.php" class="btn"><img src="assets/images/baseline_close_black_18dp.png"></a>
                                                </div>
                                            </div>
                                                <br>
                                            <?php
                                            }
                                            else
                                            {?>
                                            <div class="row">
                                                <div class="col-11">
                                               <h1><?php echo $arrbezeichnung[$rdm_1]?></h1> <h5>Klicken Sie <a href="webpage.php">hier</a> um mehr über unsere Veranstaltungen zu erfahren.</h5>
                                                </div>
                                                <div class="col-1">
                                                    <a href="index.php" class="btn"><img src="assets/images/baseline_close_black_18dp.png"></a>
                                                </div>
                                            </div>
                                            <?php
                                            }?>


                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4>Veranstalter:</h4>
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
                                                    <h4><?php echo $veranstalter[0]?></h4>
                                                    <h4><?php echo $converted_date?></h4>
                                                    <h4><?php echo $arrstrasse[$rdm_1]; echo " "; echo $arrhausnummer[$rdm_1]?></h4>
                                                    <h4><?php echo $arrplz[$rdm_1]; echo " "; echo $arrort[$rdm_1]?></h4>
                                                    <h4><?php echo $arreintritt[$rdm_1]; echo " €"?></h4>
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
                                                        <?php echo $arrbeschreibung[$rdm_1]?>
                                                    </h4>

                                                </div>

                                                <div class="col-md-4">

                                                    <?php
                                                    if(empty($arrfoto[0]))
                                                    {

                                                    }
                                                    else
                                                    {
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($arrfoto[0]) . '">';
                                                    }
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
