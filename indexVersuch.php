<!DOCTYPE html>
<html lang="de">

<?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateHead.php'?>

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
                                    <p><a href="#">Details</a></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-item third-item">
                                    <div class="icon"></div>
                                    <h4><?php echo $arrbezeichnung[$rdm3] ?></h4>
                                    <p><?php echo $arrdatum[$rdm3] ?></p>
                                    <p><?php echo $arrplz[$rdm3]; echo" "; echo $arrort[$rdm3] ?></p>
                                    <p><?php echo $arrstrasse[$rdm3]; echo" "; echo $arrhausnummer[$rdm3] ?></p>
                                    <p><a href="#">Details</a></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-item fourth-item">
                                    <div class="icon"></div>
                                    <h4>Festl 4</h4>
                                    <p>Super Festl</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-item fivth-item">
                                    <div class="icon"></div>
                                    <h4>Festl 5</h4>
                                    <p>Super Festl</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-item sixth-item">
                                    <div class="icon"></div>
                                    <h4>Festl 6</h4>
                                    <p>Super Festl</p>
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

<?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateSidebar.php'?>
