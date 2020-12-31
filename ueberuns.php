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
                                                            <img src="assets/images/mehmet_foto.jpg" alt="Mehmet" style="width:100%">
                                                            <div class="container">
                                                                <h2>Mehmet Dönmez</h2>
                                                                <p class="title">Projektleiter</p>
                                                                <p>Zu viel Salz</p>
                                                                <p>Doenmezme@gmail.com</p>
                                                                <div style="margin: 24px 0;">
                                                                    <a id="social-media" href="#"><i class="fa fa-twitter"></i></a>
                                                                    <a id="social-media" href="https://www.facebook.com/mehmetali.donmez.75436"><i class="fa fa-facebook"></i></a>
                                                                    <a id="social-media" href="https://www.instagram.com/mehmetaliderbabo/"><i class="fa fa-instagram"></i></a>
                                                                </div>
                                                                <p><button class="button">Contact</button></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column">
                                                        <div class="card">
                                                            <img src="assets/images/finn_bild.jpeg" alt="Finn" style="width:100%">
                                                            <div class="container">
                                                                <h2>Finn Homa</h2>
                                                                <p class="title">Teammitglied</p>
                                                                <p>Zu viel Roblox, zu wenig Among us</p>
                                                                <p>finnhoma@gmail.com</p>

                                                                <div style="margin: 24px 0;">
                                                                    <a id="social-media" href="#"><i class="fa fa-twitter"></i></a>
                                                                    <a id="social-media" href="#"><i class="fa fa-facebook"></i></a>
                                                                    <a id="social-media" href="https://www.instagram.com/itsfinn_/"><i class="fa fa-instagram"></i></a>
                                                                </div>
                                                                <p><button class="button">Contact</button></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="column">
                                                        <div class="card">
                                                            <img src="assets/images/ren%C3%A9_foto.jpg" alt="René" style="width:100%">
                                                            <div class="container">
                                                                <h2>René Wolf</h2>
                                                                <p class="title">Teammitglied</p>
                                                                <p>Zu viel driften, zu wenig blinken</p>
                                                                <p>renéwolf@gmail.com</p>
                                                                <div style="margin: 24px 0;">
                                                                    <a id="social-media" href="#"><i class="fa fa-twitter"></i></a>
                                                                    <a id="social-media" href="https://www.facebook.com/rene3107"><i class="fa fa-facebook"></i></a>
                                                                    <a id="social-media" href="https://www.instagram.com/3107rene/"><i class="fa fa-instagram"></i></a>
                                                                </div>
                                                                <p><button class="button">Contact</button></p>
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
