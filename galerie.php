<?php
session_start();
if (isset($_SESSION['loggedin'])) {

}
else
{
    header("Location: login.php");
    die();
}

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

$sql= "SELECT * FROM festl order by Datum ASC";
$result = $db->query($sql);

$festln = $result->fetchAll();

$sql1="select * from festl order by Datum ASC";
$result1 = $db->query($sql1);
$i=0;
$arrfoto=array();
while($row = $result1->fetch()){
    $arrfoto[$i]=$row['Titelbild'];

    $i++;
}

$count =0;
?>
<?php foreach ($festln as $festl) {



//echo '<h1>'.$festl['Bezeichnung'] . '</h1>';

                                                  // echo '<img src="data:image/jpeg;base64,' . base64_encode($festl['Titelbild']) . '">';
}

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
                                               /* foreach ($festln as $festl) {
                                                    if($arrfoto[$count]==null)
                                                    {

                                                    }
                                                    else
                                                    {
                                                         echo '<h1>'.$festl['Bezeichnung'] . '</h1>';
                                                       echo '<img src="data:image/jpeg;base64,' . base64_encode($festl['Titelbild']) . '">';

                                                    }
                                                    $count++;

                                                } */
                                            ?>

                                            <!-- ### start of the gallery definition ### -->
                                            <div id="galerie" data-nanogallery2='{
                                                "thumbnailHeight": 200,
                                                "thumbnailWidth": 200,
                                                "itemsBaseURL": "",
                                                "thumbnailDisplayTransition": "scaleDown",
                                                "thumbnailHoverEffect2": "imageGrayOn|scale120",
                                                "galleryDisplayTransition": "slideDown"
                                                }'>

                                                <!-- gallery content -->
                                                <a href="assets/images/house_of_pain.jpg" "assets/images/house_of_pain.jpg" data-ngThumb="assets/images/house_of_pain.jpg"> House of Pain 12.10.19</a>
                                                <a href="assets/images/meterparty.jpg" data-ngThumb="assets/images/meterparty.jpg"> Meterparty 28.12.19</a>
                                                <a href="assets/images/u25.jpg" data-ngThumb="assets/images/u25.jpg"> Ü25 9.11.19 </a>
                                                        <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>
                                                <a href="" data-ngThumb=""> Festl Beispiel</a>

                                            </div>
                                            <!-- ### end of the gallery definition ### -->

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

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js" type="text/javascript"></script>

    <!-- nanogallery2 -->
    <link href="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/css/nanogallery2.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/nanogallery2@3/dist/jquery.nanogallery2.min.js"></script>


    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
