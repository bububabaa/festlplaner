<!DOCTYPE html>
<html lang="de">

<style>
    #mapmenu {
    position: absolute;
    background: #fff;
    padding: 10px;
    font-family: 'Open Sans', sans-serif;
    max-height: 1000px;
    height: 75%;
    }
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

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
    <link
        rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
        type="text/css"
    />
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css" rel="stylesheet" />
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
                                                <div id='map' style='width: auto;'></div>

                                                <div id="mapmenu">
                                                    <input
                                                        id="streets-v11"
                                                        type="radio"
                                                        name="rtoggle"
                                                        value="streets"
                                                        checked="checked"
                                                        />

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
                                                        center: [12.550343, 55.665957],
                                                        zoom: 13
                                                    });


                                                </script>

                                                <script>
                                                    mapboxgl.accessToken = 'pk.eyJ1IjoiZmVzdGxwbGFuZXJoYWsxIiwiYSI6ImNraHhlbHJxdjBoeWoydm5icnl0cG12dHkifQ.j_lmlCu_KtaqM6J-p15oVQ';

                                                    map.addControl(
                                                    new MapboxGeocoder({
                                                    accessToken: mapboxgl.accessToken,
                                                    mapboxgl: mapboxgl
                                                    })
                                                    );
                                                </script>

                                                <script>
                                                var coordinatesGeocoder = function (query) {
                                                    var matches = query.match(
                                                    /^[ ]*(?:Lat: )?(-?\d+\.?\d*)[, ]+(?:Lng: )?(-?\d+\.?\d*)[ ]*$/i
                                                    );
                                                    if (!matches) {
                                                    return null;
                                                    }

                                                    function coordinateFeature(lng, lat) {
                                                    return {
                                                    center: [lng, lat],
                                                    geometry: {
                                                    type: 'Point',
                                                    coordinates: [lng, lat]
                                                    },
                                                    place_name: 'Lat: ' + lat + ' Lng: ' + lng,
                                                    place_type: ['coordinate'],
                                                    properties: {},
                                                    type: 'Feature'
                                                    };
                                                    }

                                                    var coord1 = Number(matches[1]);
                                                    var coord2 = Number(matches[2]);
                                                    var geocodes = [];

                                                    if (coord1 < -90 || coord1 > 90) {
                                                    // must be lng, lat
                                                    geocodes.push(coordinateFeature(coord1, coord2));
                                                    }

                                                    if (coord2 < -90 || coord2 > 90) {
                                                    // must be lat, lng
                                                    geocodes.push(coordinateFeature(coord2, coord1));
                                                    }

                                                    if (geocodes.length === 0) {
                                                    // else could be either lng, lat or lat, lng
                                                    geocodes.push(coordinateFeature(coord1, coord2));
                                                    geocodes.push(coordinateFeature(coord2, coord1));
                                                    }

                                                    return geocodes;
                                                    };

                                                    map.addControl(
                                                    new MapboxGeocoder({
                                                    accessToken: mapboxgl.accessToken,
                                                    localGeocoder: coordinatesGeocoder,
                                                    zoom: 4,
                                                    placeholder: 'Try: -40, 170',
                                                    mapboxgl: mapboxgl
                                                    })
                                                    );
                                                </script>

                                                <script>
                                                    mapboxgl.accessToken = 'pk.eyJ1IjoiZmVzdGxwbGFuZXJoYWsxIiwiYSI6ImNraHhlbHJxdjBoeWoydm5icnl0cG12dHkifQ.j_lmlCu_KtaqM6J-p15oVQ';

                                                    map.addControl(new mapboxgl.NavigationControl());
                                                </script>

                                                <script>
                                                    mapboxgl.accessToken = 'pk.eyJ1IjoiZmVzdGxwbGFuZXJoYWsxIiwiYSI6ImNraHhlbHJxdjBoeWoydm5icnl0cG12dHkifQ.j_lmlCu_KtaqM6J-p15oVQ';

                                                    var layerList = document.getElementById('menu');
                                                    var inputs = layerList.getElementsByTagName('input');

                                                    function switchLayer(layer) {
                                                        var layerId = layer.target.id;
                                                        map.setStyle('mapbox://styles/mapbox/' + layerId);
                                                    }

                                                    for (var i = 0; i < inputs.length; i++) {
                                                        inputs[i].onclick = switchLayer;
                                                    }
                                                </script>

                                                <script>
                                                    var marker = new mapboxgl.Marker()
                                                    .setLngLat([12.550343, 55.665957])
                                                    .addTo(map);
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
