<?php
$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";


$db = new PDO($dsn,$username,$password);

$sql = "SELECT * FROM festl";
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

//echo $_SESSION["rdm1"];


/*echo $rdm1;
echo " ";
echo $rdm2;
echo " ";
echo $rdm3;*/
$card_item=0;
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
                <!-- Banner -->
                <section class="main-banner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="banner-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="banner-caption">
                                                <h4>Wilkkommen auf unserer Seite <em>Festlplaner</em></h4>
                                                <span>Super Website &amp; Mit den besten Websitedesignern</span>
                                                <div class="primary-button">
                                                    <a href="festleintrag.php">Mehr anzeigen</a>
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
                                     <div class="icon"></div>
                                     <div class="card-body">
                                        <h4><?php echo $arrbezeichnung[$rdm1] ?></h4><br>
                                         <p><?php echo $converted_date1 ?><br>
                                         <?php echo $arrstrasse[$rdm1]; echo" "; echo $arrhausnummer[$rdm1] ?><br>
                                         <?php echo $arrplz[$rdm1]; echo" "; echo $arrort[$rdm1] ?><br>
                                         <a href="details1.php">Details</a></p>

                                     </div>
                                </div>
                                <div class="card">
                                     <div class="icon"></div>
                                     <div class="card-body">
                                        <h4><?php echo $arrbezeichnung[$rdm2] ?></h4><br>
                                         <p><?php echo $converted_date2 ?><br>
                                         <?php echo $arrstrasse[$rdm2]; echo" "; echo $arrhausnummer[$rdm2] ?><br>
                                         <?php echo $arrplz[$rdm2]; echo" "; echo $arrort[$rdm2] ?><br>
                                         <a href="details2.php">Details</a></p>

                                     </div>
                                </div>
                                <div class="card">
                                     <div class="icon"></div>
                                     <div class="card-body">
                                        <h4><?php echo $arrbezeichnung[$rdm3] ?></h4><br>
                                         <p><?php echo $converted_date3 ?><br>
                                         <?php echo $arrstrasse[$rdm3]; echo" "; echo $arrhausnummer[$rdm3] ?><br>
                                         <?php echo $arrplz[$rdm3]; echo" "; echo $arrort[$rdm3] ?><br>
                                         <a href="details3.php">Details</a></p>

                                     </div>
                                </div>
                            </div>
                    </section>
                <!-- Services -->
                <section class="services">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="service-item first-item">
                                    <div class="icon"></div>
                                    <h4><?php echo $arrbezeichnung[$rdm1] ?></h4>
                                    <div class="inhalt">
                                    <p><?php echo $converted_date1 ?></p>
                                    <p><?php echo $arrstrasse[$rdm1]; echo" "; echo $arrhausnummer[$rdm1] ?></p>
                                    <p><?php echo $arrplz[$rdm1]; echo" "; echo $arrort[$rdm1] ?></p>
                                    <p><a href="details1.php">Details</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-item second-item">
                                    <div class="icon"></div>
                                    <div class="inhalt">
                                    <h4><?php echo $arrbezeichnung[$rdm2] ?></h4>
                                    <p><?php echo $converted_date2 ?></p>
                                    <p><?php echo $arrstrasse[$rdm2]; echo" "; echo $arrhausnummer[$rdm2] ?></p>
                                    <p><?php echo $arrplz[$rdm2]; echo" "; echo $arrort[$rdm2] ?></p>
                                    <p><a href="details2.php">Details</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-item third-item">
                                    <div class="icon"></div>
                                    <div class="inhalt">
                                    <h4><?php echo $arrbezeichnung[$rdm3] ?></h4>
                                    <p><?php echo $converted_date3 ?></p>
                                    <p><?php echo $arrstrasse[$rdm3]; echo" "; echo $arrhausnummer[$rdm3] ?></p>
                                    <p><?php echo $arrplz[$rdm3]; echo" "; echo $arrort[$rdm3] ?></p>
                                    <p><a href="details3.php">Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- The Modal -->
               <!-- <h1><?php echo $converted_date1; echo " "; echo $converted_date2; echo" "; echo $converted_date3?></h1>-->

                <!-- Top Image -->
                <section class="top-image">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!--<img src="assets/images/top-image.jpg" alt="">-->
                                <div class="down-content">
                                    <h4>Ante Interdum Chambray</h4>
                                    <p>Lorem ipsum dolor amet raclette chambray bitters, hammock celiac slow-carb flexitarian four dollar toast food truck health goth. Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put a bird on it brooklyn forage.</p>
                                    <div class="primary-button">
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Left Image -->
                <section class="left-image">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <!--<img src="assets/images/left-image.jpg" alt="">-->
                            </div>
                            <div class="col-md-6">
                                <div class="right-content">
                                    <h4>Ante Interdum Raclette</h4>
                                    <p>Lorem ipsum dolor amet raclette chambray bitters, hammock celiac slow-carb flexitarian four dollar toast food truck health goth. Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put a bird on it brooklyn forage.<br><br>Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put bird brooklyn</p>
                                    <div class="primary-button">
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Right Image -->
                <section class="right-image">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="left-content">
                                    <h4>Ante Interdum Raclette</h4>
                                    <p>Lorem ipsum dolor amet raclette chambray bitters, hammock celiac slow-carb flexitarian four dollar toast food truck health goth. Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put a bird on it brooklyn forage.<br><br>Air plant brunch food truck vegan scenester organic crucifix irony pour-over pop-up austin hexagon kitsch swag. Godard literally humblebrag cloud bread vice master cleanse chambray typewriter put bird brooklyn</p>
                                    <div class="primary-button">
                                        <a href="#">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--<img src="assets/images/right-image.jpg" alt="">-->
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


<style>
    .card{
        margin-top: 100px;
        margin-bottom: 3px;
        background-color: #eaebef;
        padding: 50px;
        text-align: center;
        transition: all 0.5s;
    }
    .card:hover{
        background-color: #292929;
    }
    .card:hover h4,
    .card:hover p {
	   color: #fff;
    }

</style>
</body>

</html>
