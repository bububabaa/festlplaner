<?php
session_start();

if (isset($_SESSION['loggedin'])) {
}
else
{
    header("Location: login.php");
    die();
}

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
$arreinlass=array();
$arrbeginn=array();
$arrende=array();
$arrdatum=array();
while($row = $result1->fetch()){
    $arraid[$i]= $row['AID'];
    $arrfoto[$i]=$row['Titelbild'];
    $arrweblink[$i]=$row['Webadresse'];
    $arreinlass[$i]=$row['EinlassAb'];
    $arrbeginn[$i]=$row['Beginn'];
    $arrende[$i]=$row['Ende'];
    $arrdatum[$i]=$row['Datum'];

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
                        <div class="wrap" id="searchbar">
                            <div class="search">
                                <input placeholder="Suchen nach..." type="text" id="search" class="searchTerm">
                                <input type="button" id="#searchbtn" value="Suchen" onclick="search(document.getElementById('search').value)" class="searchButton">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="banner-caption">

                                           <div class="row">

                                               <div class="col-md-3">
                                            <?php
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

                                                   $heutedatum = $beginOfDay->format('Y-m-d H:i:s e');
                                                   $heutetimestamp= strtotime($heutedatum);


                                                   $count1=0;
                                            foreach ($festln as $festl) {
                                                if(strtotime($arrdatum[$count1])>=$heutetimestamp)
                                                {
                                                echo '<div class="line"></div>';
                                                    echo '<div class="festl-content">';
                                                    if($arrfoto[$count1]==null)
                                                    {
                                                        echo '<h1><br></h1>';
                                                        echo '<h5><br></h5>';
                                                    }
                                                    else
                                                    {
                                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($arrfoto[$count1]) . '">';
                                                    }
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
                                               // echo '<img src="data:image/jpeg;base64,' . base64_encode($arrfoto[$count1]) . '">';
                                               //  echo '<div class="line"></div>';
                                                $count1++;
                                                }
                                                else
                                                {
                                                    $count1++;
                                                }
                                            }?>
                                                </div>

                                               <div class="col-md-9">

                                                <?php

                                                $count=0;

                                            foreach ($festln as $festl) {

                                                if(strtotime($arrdatum[$count])>=$heutetimestamp)
                                                {
                                                    echo '<div class="line"></div>';
                                                    echo '<section class="festl-banner">'; ?><?php
                                                    echo '<h1>'.$festl['Bezeichnung'] . '</h1>';
                                                    if($arrweblink[$count]==null)
                                                    {
                                                        echo '<h5><br><br></h5>';
                                                    }
                                                    else
                                                    {

                                                        // echo '<h5>Klicken Sie <a href="webpage.php">hier</a> um mehr über unsere Veranstaltungen zu erfahren.</h5>';
                                                        echo '<h5>Klicken Sie <a href="'.$arrweblink[$count].'" target="_blank" >hier</a> um mehr über unsere Veranstaltungen zu erfahren.</h5>';
                                                        echo '<br>';
                                                    }

                                                    echo '<h3>'.$veranstalter[$count].'</h3>';

                                                    $date = DateTime::createFromFormat('Y-m-d', $arrdatum[$count]);
                                                    $converted_date = $date->format('d.m.Y');

                                                    $time1 =DateTime::createFromFormat('G:i:s', $arreinlass[$count]);
                                                    $time2 =DateTime::createFromFormat('G:i:s', $arrbeginn[$count]);
                                                    $time3 =DateTime::createFromFormat('G:i:s', $arrende[$count]);
                                                    $converted_time1 = $time1->format('H:i');
                                                    $converted_time2 = $time2->format('H:i');
                                                    $converted_time3 = $time3->format('H:i');

                                                    echo '<h4>'.$converted_date . '</h4>';
                                                    echo '<h4>'.$festl['Strasse'];echo " "; echo $festl['Hausnummer'] . '</h4>';
                                                    echo '<h4>'.$festl['PLZ'];echo " "; echo $festl['Ort'] . '</h4>';
                                                    echo '<h4>'.$festl['Eintritt'] . ' €</h4>';
                                                    echo '<h4>'.$converted_time1 . ' Uhr</h4>';
                                                    echo '<h4>'.$converted_time2 . ' Uhr</h4>';
                                                    echo '<h4>'.$converted_time3 . ' Uhr</h4>';
                                                    echo '<br>';
                                                    echo '<div class="festl-scroll">'.nl2br($festl['Beschreibung']).'</div></section>';
                                                    $count++;
                                                    // echo '<div class="line"></div>';

                                                }
                                                else
                                                {
                                                    $count++;
                                                }
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
        border-bottom: none;
        padding-bottom: 100px;
        height: 600px;
    }
    div.festl-scroll {
                margin:4px, 4px;
                padding:4px;
                width: 700px;
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

    img {
        height: 110px;
    }
/*Searchbar*/
    .search {
  width: 100%;
  position: relative;
  display: flex;

}

.searchTerm {
  width: 100%;
  border: 3px solid #191919;
  border-right: none;
  padding: 5px;
  height: 20px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #191919;
     height: 36px;
    background: #fff;
}



.searchButton {
  width: 85px;
  height: 36px;
  border: 1px solid #191919;
  background: #292929;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}
    .searchbar {

  background: #fff;
}
    .sticky {
    position: fixed;
   position: sticky;   /* The magic */
    z-index: 1;         /* Ensure it stays on top of other player divs */
    top: 0px;           /* Where it should stick to */
}

    </style>

    <script>
    function search(string)
        {
            {
                window.find(string);
            }
        }

  window.onscroll = function() {myFunction1()};

var searchbar = document.getElementById("searchbar");
var sticky = searchbar.offsetTop;

function myFunction1() {
  if (window.pageYOffset >= sticky) {
    searchbar.classList.add("sticky")
  } else {
    searchbar.classList.remove("sticky");
  }
}

</script>
</body>

</html>
