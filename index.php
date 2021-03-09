<?php
/*$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";*/

/*$username = "digbizm_1";
$password = "2021##Fireme";
$dsn = "mysql:host=sql349.your-server.de;dbname=festlpage;charset=utf8";*/

$username = "c31festlplaner";
$password = "Festlplaner2020";
$dsn = "mysql:host=projects.hakmistelbach.ac.at;dbname=c31festlplaner;charset=utf8";

$db = new PDO($dsn,$username,$password);

$timestamp=time();

$dtNow = new DateTime();
// Set a non-default timezone if needed
$dtNow->setTimezone(new DateTimeZone('Europe/Vienna'));
$dtNow->setTimestamp($timestamp);

$beginOfDay = clone $dtNow;
$beginOfDay->modify('today');

$heutedatum = $beginOfDay->format('Y-m-d H:i:s');
$heutetimestamp= strtotime($heutedatum);

$sql = "SELECT * FROM festl WHERE Datum >='".$heutedatum."'";
$result = $db->query($sql);
$i=0;
$arrbezeichnung = array();
$arrdatum = array();
$arrplz = array();
$arrort = array();
$arrstrasse = array();
$arrhausnummer = array();
while($row = $result->fetch()){
   $arrbezeichnung[$i] = $row['Bezeichnung'];
    $arrdatum[$i] = $row['Datum'];
    $arrplz[$i]= $row['PLZ'];
    $arrort[$i]= $row['Ort'];
    $arrstrasse[$i]= $row['Strasse'];
    $arrhausnummer[$i]= $row['Hausnummer'];
    $i++;
}
session_start();

$arr_length= count($arrbezeichnung);
//echo $zahl1;

$rdm1 = rand(0,$arr_length-1);
$rdm2 = rand(0,$arr_length-1);
$rdm3 = rand(0,$arr_length-1);

while($rdm1==$rdm2 || $rdm1==$rdm3 || $rdm2==$rdm3)
{
    $rdm2 = rand(0,$arr_length-1);
    $rdm3 = rand(0,$arr_length-1);
}

$_SESSION["rdm1"] = $rdm1;
$_SESSION["rdm2"] = $rdm2;
$_SESSION["rdm3"] = $rdm3;

$date1 = DateTime::createFromFormat('Y-m-d', $arrdatum[$rdm1]);
$converted_date1 = $date1->format('d.m.Y');
$date2 = DateTime::createFromFormat('Y-m-d', $arrdatum[$rdm2]);
$converted_date2 = $date2->format('d.m.Y');
$date3 = DateTime::createFromFormat('Y-m-d', $arrdatum[$rdm3]);
$converted_date3 = $date3->format('d.m.Y');

$card_item=0;
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

    <style>
        /* This is used to "clear" the floated elements */
        .images {
            overflow: hidden;
            width: 100%
        }

        /* float the elements so that white space does not matter */
        .images img {
            float: left;
        }
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
                <!-- Banner -->
                <section class="main-banner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="banner-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="banner-caption">
                                                <h4>Willkommen auf unserer Seite <em>Festlplaner</em></h4>
                                                <br>
                                                <div class="primary-button">
                                                    <a href="festleintrag.php">Zu den Festln</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="cards">
                    <div class="card-deck">

                        <div class="card">


                            <div class="card-body">

                                <div class="icon"> <img src="assets/images/logostraight.png"> </div>
                                <br>
                                <h4><?php echo $arrbezeichnung[$rdm1] ?></h4>
                                <p><?php echo $converted_date1 ?><br>
                                    <?php echo $arrstrasse[$rdm1]; echo" "; echo $arrhausnummer[$rdm1] ?><br>
                                    <?php echo $arrplz[$rdm1]; echo" "; echo $arrort[$rdm1] ?><br>
                                    <a href="details1.php">Details</a>
                                </p>
                            </div>
                        </div>

                        <div class="card">

                            <div class="card-body">
                                <div class="icon"> <img src="assets/images/logostraight.png"> </div>
                                <br>
                                <div class="text">
                                    <h4><?php echo $arrbezeichnung[$rdm2] ?></h4>
                                    <p><?php echo $converted_date2 ?><br>
                                        <?php echo $arrstrasse[$rdm2]; echo" "; echo $arrhausnummer[$rdm2] ?><br>
                                        <?php echo $arrplz[$rdm2]; echo" "; echo $arrort[$rdm2] ?><br>
                                        <a href="details2.php">Details</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                            <div class="card-body">
                                <div class="icon"> <img src="assets/images/logostraight.png"> </div>
                                <br>
                                <div class="text">
                                    <h4><?php echo $arrbezeichnung[$rdm3] ?></h4>
                                    <p><?php echo $converted_date3 ?><br>
                                        <?php echo $arrstrasse[$rdm3]; echo" "; echo $arrhausnummer[$rdm3] ?><br>
                                        <?php echo $arrplz[$rdm3]; echo" "; echo $arrort[$rdm3] ?><br>
                                        <a href="details3.php">Details</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <!-- Left Image -->
                <section class="feature-banner">
                    <h1><b><u>Features:</u></b></h1>
                </section>
                <section class="left-image">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <img src="assets/images/calendar-1559935_960_720.png" alt="" id="feature">
                            </div>
                            <div class="col-md-3">
                                <div class="right-content">
                                    <h2 id="feature">Kalender</h2>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </section>
                <section class="right-image">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3"> </div>
                            <div class="col-md-3">
                                <div class="left-content">
                                    <h2 id="feature">Karte</h2>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <img src="assets/images/map3.png" alt="" id="feature">
                            </div>
                            <div class="col-md-3"> </div>
                        </div>
                    </div>
                </section>
                <section class="left-image">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <img src="assets/images/gallery2.png" alt="" id="feature">
                            </div>
                            <div class="col-md-3">
                                <div class="right-content">
                                    <h2 id="feature">Gallerie</h2>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </section>
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


    <style>
        .card {
            margin-top: 100px;
            margin-bottom: 3px;
            background-color: #eaebef;
            padding: 50px;
            text-align: center;
            transition: all 0.5s ease;
            height: 370px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.24);
            border: 2px solid rgba(7, 7, 7, 0.12);
            align-items: center;

        }

        .card:hover {
            background-color: #292929;
        }

        .card:hover h4,
        .card:hover p {
            color: #fff;
        }

        .card:hover {
            height: 390px;
        }

        .card:hover .info {
            height: 90%;
        }

        .card:hover .text {
            transition: all 0.3s ease;
            opacity: 1;
            max-height: 40px;
        }

        .card:hover .icon {
            background-position: -120px;
            transition: all 0.3s ease;
        }

        .card:hover .icon i {
            background: linear-gradient(90deg, #FF7E7E, #FF4848);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .icon {
            margin: 0 auto;
            width: 100%;
            height: 80px;
            max-width: 80px;
            background: linear-gradient(90deg, #FF7E7E 0%, #FF4848 40%, rgba(0, 0, 0, 0.28) 60%);
            border-radius: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            transition: all 0.8s ease;
            background-position: 0px;
            background-size: 200px;
        }

        img#feature {
            width: 200px;
            height: 200px;
        }

        h2#feature {
            position: center;

        }

        section.feature-banner {
            border-bottom: none;
            padding-bottom: 0px;
        }

        /* Right Image
section.right-image {
	border-bottom: none;
	padding-bottom: 0px;
}*/

        .feature-banner {
            margin-top: 100px;
        }

        .feature-banner .container-fluid {
            padding-left: 0px;
            padding-right: 0px;
        }

        .feature-banner .left-content {
            margin-right: 15px;
        }
    </style>
</body>

</html>
