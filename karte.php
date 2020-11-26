<!DOCTYPE html>
<html lang="de">

<style>
    #map {}
</style>

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

    <!-- Mapbox -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
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
                                            <form id="map">
                                                <div id='map' style='width: auto; height: 950px;'></div>
                                                <div id="menu">
                                                    <input id="streets-v11" type="radio" name="rtoggle" value="streets" checked="checked" />
                                                    <label for="streets-v11">streets</label>
                                                    <input id="light-v10" type="radio" name="rtoggle" value="light" />
                                                    <label for="light-v10">light</label>
                                                    <input id="dark-v10" type="radio" name="rtoggle" value="dark" />
                                                    <label for="dark-v10">dark</label>
                                                    <input id="outdoors-v11" type="radio" name="rtoggle" value="outdoors" />
                                                    <label for="outdoors-v11">outdoors</label>
                                                    <input id="satellite-v9" type="radio" name="rtoggle" value="satellite" />
                                                    <label for="satellite-v9">satellite</label>
                                                </div>
                                                <script>
                                                    mapboxgl.accessToken = 'pk.eyJ1IjoiZmVzdGxwbGFuZXJoYWsxIiwiYSI6ImNraHhlbHJxdjBoeWoydm5icnl0cG12dHkifQ.j_lmlCu_KtaqM6J-p15oVQ';
                                                    var map = new mapboxgl.Map({
                                                        container: 'map',
                                                        style: 'mapbox://styles/mapbox/streets-v11',
                                                        center: [-74.5, 40],
                                                        zoom: 13
                                                    });

                                                    var layerList = document.getElementById('menu');
                                                    var inputs = layerList.getElementsByTagName('input');

                                                    function switchLayer(layer) {
                                                        var layerId = layer.target.id;
                                                        map.setStyle('mapbox://styles/mapbox/' + layerId);
                                                    }

                                                    for (var i = 0; i < inputs.length; i++) {
                                                        inputs[i].onclick = switchLayer;
                                                    }
                                                    map.addControl(new mapboxgl.NavigationControl());
                                                </script>
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

        <!-- Sidebar -->
        <div id="sidebar">

            <div class="inner">

                <!-- Search Box -->
                <section id="search" class="alt">
                    <form method="get" action="#">
                        <input type="text" name="search" id="search" placeholder="Search..." />
                    </form>
                </section>

                <!-- Menu -->
                <nav id="menu">
                    <ul>
                        <li><a href="index.php">Homepage</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="shortcodes.php">Shortcodes</a></li>
                        <li><a href="kalender.php">Kalender</a></li>
                        <li><a href="galerie.php">Galerie</a></li>
                        <li><a href="karte.php">Karte</a></li>
                        <li>
                            <span class="opener">Abos</span>
                            <ul>
                                <li><a href="#">Abo 1</a></li>
                                <li><a href="#">Abo 2</a></li>
                                <li><a href="#">Abo 3</a></li>
                            </ul>
                        </li>
                        <li><a target="_blank" href="https://hakmistelbach.ac.at/">externer Link</a></li>
                        <li><a href="ueberuns.php">Über uns</a></li>
                    </ul>
                </nav>

                <!-- Footer -->
                <footer id="footer">
                    <p class="copyright">Copyright &copy; 2021 Festlplaner &amp; Co. KG
                        <br>Erstellt von <a rel="nofollow" href="">Uns</a>
                    </p>
                </footer>

            </div>
        </div>

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
