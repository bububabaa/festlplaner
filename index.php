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


//echo $_SESSION["rdm1"];


/*echo $rdm1;
echo " ";
echo $rdm2;
echo " ";
echo $rdm3;*/

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
                                                    <a href="#">Mehr anzeigen</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                    <p><?php echo $arrdatum[$rdm1] ?></p>
                                    <p><?php echo $arrplz[$rdm1]; echo" "; echo $arrort[$rdm1] ?></p>
                                    <p><?php echo $arrstrasse[$rdm1]; echo" "; echo $arrhausnummer[$rdm1] ?></p>
                                    <p><a href="details.php">Details</a></p>
                                    <!--<p><a href='details.php'><button id="btn1">Details</button></a></p>-->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-item second-item">
                                    <div class="icon"></div>
                                    <h4><?php echo $arrbezeichnung[$rdm2] ?></h4>
                                    <p><?php echo $arrdatum[$rdm2] ?></p>
                                    <p><?php echo $arrplz[$rdm2]; echo" "; echo $arrort[$rdm2] ?></p>
                                    <p><?php echo $arrstrasse[$rdm2]; echo" "; echo $arrhausnummer[$rdm2] ?></p>
                                    <p><a href="details.php">Details</a></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-item third-item">
                                    <div class="icon"></div>
                                    <h4><?php echo $arrbezeichnung[$rdm3] ?></h4>
                                    <p><?php echo $arrdatum[$rdm3] ?></p>
                                    <p><?php echo $arrplz[$rdm3]; echo" "; echo $arrort[$rdm3] ?></p>
                                    <p><?php echo $arrstrasse[$rdm3]; echo" "; echo $arrhausnummer[$rdm3] ?></p>
                                    <p><a href="details.php">Details</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- The Modal -->

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


    <!--    <div id="modal1" class="modal">

  <!-- Modal content
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div>

    <script>
// Get the modal
var modal = document.getElementById("modal1");

// Get the button that opens the modal
var btn = document.getElementById("btn1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>-->
</body>

</html>
