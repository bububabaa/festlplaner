<?php
/*$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";*/

$username = "digbizm_1";
$password = "2021##Fireme";
$dsn = "mysql:host=sql349.your-server.de;dbname=festlpage;charset=utf8";


$db = new PDO($dsn,$username,$password);

$sql = "SELECT * FROM festl WHERE Bezeichnung = " div.mapboxgl-popup-content;
$result = $db->query($sql);
$i=0;

while($row = $result->fetch()){
    $fid[$i]= array($row['FID']);
    $bezeichnung[$i] = array($row['Bezeichnung']);
    $datum[$i] = array($row['Datum']);
    $plz[$i]= array($row['PLZ']);
    $ort[$i]= array($row['Ort']);
    $strasse[$i]= array($row['Strasse']);
    $hausnummer[$i]= array($row['Hausnummer']);
    $beschreibung[$i]= array(($row['Beschreibung']=nl2br($row['Beschreibung'])));
    $eintritt[$i]= array($row['Eintritt']);
    $einlass[$i]= array($row['EinlassAb']);
    $beginn[$i]= array($row['Beginn']);
    $ende[$i]= array($row['Ende']);
    $aid[$i]= array($row['AID']);

    $i++;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>

<?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateHead.php'?>

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
                                                    <h4>Fest</h4>
                                                    <h4>01.01.2021</h4>
                                                    <h4>Straße 01</h4>
                                                    <h4>1000 Ort</h4>
                                                    <h4>ab 18 Jahren</h4>
                                                    <h4>20:00</h4>
                                                    <h4>21:00</h4>
                                                    <h4>02:00</h4>
                                                    <br><br>

                                                    <h4>
                                                        kaldkfjaljsldljskf
                                                    </h4>
                                                </div>

                                                <div class="col-md-4">
                                                    <?php
                                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($foto[0]) . '">';
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

<?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateScripts.php'?>
</body>

</html>
