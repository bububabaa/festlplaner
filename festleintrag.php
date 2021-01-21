<?php
$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";


$db = new PDO($dsn,$username,$password);

//Festldetails
$sql = "Select * FROM festl ORDER BY Datum ASC";
$result = $db->query($sql);

$festln = $result->fetchAll();

//Veranstalter
$sql1="select * from festl order by Datum ASC";
$result1 = $db->query($sql1);
$i=0;
$arraid = array();
$arrfoto=array();
$arrweblink=array();
while($row = $result1->fetch()){
    $arraid[$i]= $row['AID'];
    $arrfoto[$i]=$row['Titelbild'];
    $arrweblink[$i]=$row['Webadresse'];
    $i++;
}
$anzahl = count ($arraid);
$a=0;
$veranstalter = array();
for ($x = 0; $x < $anzahl; $x++ )
{
    //echo " Eintrag von $x ist $arraid[$x]";
    $sql2 ="SELECT * FROM anbieter WHERE AID='".$arraid[$x]."'";
    $result2 = $db->query($sql2);
    while($row2 = $result2->fetch()){;
    $veranstalter[$a]= $row2['Name'];

    $a++;
    }
}

//Weblink


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

                                           <div class="row">

                                               <div class="col-md-3">
                                            <?php
                                            foreach ($festln as $festl) {
                                                    echo '<div class="festl-content">';
                                                    echo '<h1>Titel:</h1>';
                                                    echo '<br>';
                                                    echo '<h3>Veranstalter:</h3>';
                                                    echo '<h4>Datum:</h4>';
                                                    echo '<h4>Straße/Hausnummer:</h4>';
                                                    echo '<h4>PLZ/Ort:</h4>';
                                                    echo '<h4>Eintritt:</h4>';
                                                    echo '<h4>Einlass ab:</h4>';
                                                    echo '<h4>Beginn:</h4>';
                                                    echo '<h4>Ende:</h4>';
                                                    echo '<br>';



                                                    echo'<h4>Beschreibung:</h4></div>';
                                                 echo '<div class="line"></div>';

                                            }?>
                                                </div>


                                               <div class="col-md-9">

                                                <?php
                                                $count=0;
                                            foreach ($festln as $festl) {
                                            echo '<section class="festl-banner">'; ?><?php
                                            echo '<h1>'.$festl['Bezeichnung'] . '</h1>';
                                            if($arrweblink[$count]==null)
                                             {
                                                  echo '<br>';
                                             }
                                             else
                                             {
                                                echo '<h5>Klicken Sie <a href="webpage.php">hier</a> um mehr über unsere Veranstaltungen zu erfahren.</h5>';
                                             }
                                            //echo '<h3>'.$arrweblink[$count].'</h3>';
                                            echo '<h3>'.$veranstalter[$count].'</h3>';
                                            //echo '<img src="data:image/jpeg;base64,' . base64_encode($arrfoto[$count]) . '">';
                                            $count++;
                                            echo '<h4>'.$festl['Datum'] . '</h4>';
                                            echo '<h4>'.$festl['Strasse'];echo " "; echo $festl['Hausnummer'] . '</h4>';
                                            echo '<h4>'.$festl['PLZ'];echo " "; echo $festl['Ort'] . '</h4>';
                                            echo '<h4>'.$festl['Eintritt'] . ' €</h4>';
                                            echo '<h4>'.$festl['EinlassAb'] . ' Uhr</h4>';
                                            echo '<h4>'.$festl['Beginn'] . ' Uhr</h4>';
                                            echo '<h4>'.$festl['Ende'] . ' Uhr</h4>';
                                            echo '<br>';
                                            echo '<div class="festl-scroll">'.nl2br($festl['Beschreibung']).'</div></section>';


                                            echo '<div class="line"></div>';

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

<style>
    section.festl-banner {
		margin-top: 30px;
        border-bottom: none;
        padding-bottom: 100px;
        height: 600px;
	}
    div.festl-content{
        margin-top: 30px;

        padding-bottom: 100px;
        height: 600px;
    }
    div.festl-scroll {
                margin:4px, 4px;
                padding:4px;
                width: 500px;
                height: 200px;
                overflow-x: hidden;
                overflow-y: auto;
                text-align:justify;
                font-size: 19px;
	font-weight: 700;
	color: #292929;
	letter-spacing: 0.25px;
            }
    div.line {
        border-bottom: 3px solid #eee;
    }

    </style>
</body>
</html>
