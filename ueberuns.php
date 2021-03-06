<?php
session_start();
if (isset($_SESSION['loggedin'])) {

}
else
{
  // header("Location: login.php");
//    die();
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

    <style>
        body {
            margin: 0;
        }

        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .column {
            float: left;
            width: 33.3%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 8px;
        }

        .about-section {
            padding: 50px;
            text-align: center;
            background-color: #474e5d;
            color: white;
        }

        .container {
            padding: 0 16px;
        }

        .container::after,
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .title {
            color: grey;
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
            background-color: #555;
        }

        @media screen and (max-width: 650px) {
            .column {
                width: 100%;
                display: block;
            }
        }

        #social-media {
            text-decoration: none;
            font-size: 25px;
            color: black;
            text-align: center;
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
                <section class="main-banner">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="banner-caption">
                                            <form>
                                                <h2 style="text-align:center">Unser Team</h2>
                                                <div class="row">
                                                    <div class="column">
                                                        <div class="card">
                                                            <img src="assets/images/icon.jpg" alt="Mehmet">
                                                            <div class="container">
                                                                <h2>Mehmet Dönmez</h2>
                                                                <p class="title">Teammitglied</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column">
                                                        <div class="card">
                                                            <img src="assets/images/portraitfinn.jpg" alt="Finn">
                                                            <div class="container">
                                                                <h2>Finnick Homa</h2>
                                                                <p class="title">Projektleiter</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column">
                                                        <div class="card">
                                                            <img src="assets/images/icon.jpg" alt="René">
                                                            <div class="container">
                                                                <h2>René Wolf</h2>
                                                                <p class="title">Teammitglied</p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
                <section class="top-image">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!--<img src="assets/images/top-image.jpg" alt="">-->
                                <div class="down-content">
                                    <h3 id="vorwort">Das Festlplaner-Team:</h3>
                                    <h5 id="vorwort">„Unser grundlegendes Ziel war von Anfang an, das Problem der komplizierten „Festl“-Suche aus der Welt zu schaffen und die fehlende Übersicht über die breit gefächerten Party-Angebote zu garantieren. Durch eine übersichtliche Gestaltung sollte die Suche nach Veranstaltungen möglichst unkompliziert verlaufen und auch die Möglichkeit geboten werden, auf Neues aufmerksam zu werden.
                                    Dank eines wohl durchdachten Konzepts ist für eine vorteilhafte Nutzung durch Veranstaltungsinteressierten, Veranstaltungsanbietern und Administratoren gesorgt.“
                                    </h5>
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

    <style>
        img{
            width: 100%;
            height: auto;
        }
        h5#vorwort
        {
            text-align: center;
        }
        h3#vorwort
        {
            text-align: center;
        }

    </style>
</body>

</html>
