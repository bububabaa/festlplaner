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
$arraid = array();
while($row = $result->fetch()){
    $arrfid[$i]= $row['FID'];
    $arrbezeichnung[$i] = $row['Bezeichnung'];
    $arrdatum[$i] = $row['Datum'];
    $arrplz[$i]= $row['PLZ'];
    $arrort[$i]= $row['Ort'];
    $arrstrasse[$i]= $row['Strasse'];
    $arrhausnummer[$i]= $row['Hausnummer'];
    $arrbeschreibung[$i]= $row['Beschreibung'];
    $arreintritt[$i]= $row['Eintritt'];
    $arreinlass[$i]= $row['EinlassAb'];
    $arrbeginn[$i]= $row['Beginn'];
    $arraid[$i]= $row['AID'];

    $i++;
}

if (isset($_SESSION['loggedin'])) {

$rdm_1 = $_SESSION["rdm1"];
$rdm_2 = $_SESSION["rdm2"];
$rdm_3 = $_SESSION["rdm3"];
//echo $rdm_1;
}

else
{
    header("Location: login.php");
    die();
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
                <!--<h1>Zahl 1: <?php echo $rdm_1?></h1>
                <h1>Zahl 2: <?php echo $rdm_2?></h1>
                <h1>Zahl 3: <?php echo $rdm_3?></h1>-->

                <!--ab hier Code einfügen-->
                <section class="main-banner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="banner-caption">
                                            <h1>Sauffestl</h1>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4>Datum:</h4>
                                                    <h4>Straße/Hausnummer:</h4>
                                                    <h4>PLZ/Ort:</h4>
                                                    <h4>Eintritt:</h4>
                                                    <h4>Einlass: ab</h4>
                                                    <h4>Beginn:</h4>
                                                    <br><br>

                                                    <h4>Beschreibung:</h4>
                                                </div>

                                                <div class="col-md-5">
                                                    <h4>31.12.2020</h4>
                                                    <h4>Straße 01</h4>
                                                    <h4>2130 Mistelbach</h4>
                                                    <h4>15€</h4>
                                                    <h4>20:00</h4>
                                                    <h4>20:30</h4>
                                                    <br><br>

                                                    <h4>Eintritt ab 18 Jahren
                                                        <br> Alkhohol für jeden
                                                        <br> Musik für jeden
                                                        <br> Knochen MC und Raf Camaro LIVE</h4>
                                                </div>

                                                <div class="col-md-4">
                                                    <img src="assets/images/featured_post_01.jpg">
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
