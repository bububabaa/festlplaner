<?php
$username = "root";
$password = "";
$dsn = "mysql:host=localhost;dbname=festlplaner;charset=utf8";

$db = new PDO($dsn,$username,$password);

$sql = "SELECT * FROM festl";
$result = $db->query($sql);
$i=0;
$orte = array();

while($row = $result->fetch()){
    $orte[$i] = array($row['PLZ'], $row['Ort'], $row['Strasse'], $row['Hausnummer']);
    $i++;
}
?>

<!DOCTYPE html>
<html lang="de">

<style>
    body {
        overflow: hidden;
    }

    #map{
        position: relative;
    }
</style>

<head>

<?php
error_reporting(-1);
ini_set('display_errors','On');
require __DIR__.'/templates/templateHead.php'?>

    <!-- Mapbox -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css' rel='stylesheet' />

    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css" type="text/css" />

    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css" rel="stylesheet" />

    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-language/v0.10.1/mapbox-gl-language.js'></script>

    <script src="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css" rel="stylesheet" />

    <script src="https://unpkg.com/es6-promise@4.2.4/dist/es6-promise.auto.min.js"></script>
    <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>
    <!-- Mapbox ende -->
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
                                                <div id='map' style='width: auto; height: 1010px;'></div>
                                                <script>
                                                    //Map
                                                    mapboxgl.accessToken = 'pk.eyJ1IjoiZmVzdGxwbGFuZXJoYWsxIiwiYSI6ImNraHhlbHJxdjBoeWoydm5icnl0cG12dHkifQ.j_lmlCu_KtaqM6J-p15oVQ';
                                                    var mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });

                                                    var orte_js =<?php echo json_encode($orte );?>;
                                                     var map = new mapboxgl.Map({
                                                                    container: 'map',
                                                                    style: 'mapbox://styles/mapbox/streets-v11',
                                                                    center: [16.5722, 48.56743],
                                                                    zoom: 10
                                                                });

                                                    console.log(orte_js);
                                                    for (i = 0; i < orte_js.length; i++) {
                                                    mapboxClient.geocoding
                                                        .forwardGeocode({
                                                                query: orte_js[i]+"",
                                                                autocomplete: false,
                                                                limit: orte_js.length
                                                        })

                                                        .send()
                                                        .then(function(response) {
                                                            if (
                                                                response &&
                                                                response.body &&
                                                                response.body.features &&
                                                                response.body.features.length
                                                            ) {
                                                                var feature = response.body.features[0];
                                                                new mapboxgl.Marker().setLngLat(feature.center).addTo(map);
                                                            }
                                                        });
                                                    }

                                                </script>

                                                <script>
                                                    //Controls
                                                    map.addControl(
                                                        new MapboxGeocoder({
                                                            accessToken: mapboxgl.accessToken,
                                                            mapboxgl: mapboxgl
                                                        })
                                                    );
                                                </script>

                                                <script>
                                                    //Geocoder
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

                                                <!--<script>
                                                    //Geocoder
                                                    var coordinatesGeocoder = function(query) {
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

                                                </script>-->

                                                <script>
                                                    //Navigation
                                                    map.addControl(new mapboxgl.NavigationControl());
                                                </script>

                                                <!--<script>
                                                    //Layer
                                                    var layerList = document.getElementById('menu');
                                                    var inputs = layerList.getElementsByTagName('input');

                                                    function switchLayer(layer) {
                                                        var layerId = layer.target.id;
                                                        map.setStyle('mapbox://styles/mapbox/' + layerId);
                                                    }

                                                    for (var i = 0; i < inputs.length; i++) {
                                                        inputs[i].onclick = switchLayer;
                                                    }
                                                </script>-->

                                                <!--<script>
                                                    //Marker
                                                    var marker = new mapboxgl.Marker()
                                                        .setLngLat([12.550343, 55.665957])
                                                        .addTo(map);
                                                </script>-->

                                                <script>
                                                    for()
                                                    //Cluster
                                                    map.on('load', function() {
                                                        // Add a new source from our GeoJSON data and
                                                        // set the 'cluster' option to true. GL-JS will
                                                        // add the point_count property to your source data.
                                                        map.addSource('festl', {
                                                            type: 'geojson',
                                                            // Point to GeoJSON data. This example visualizes all M1.0+ earthquakes
                                                            // from 12/22/15 to 1/21/16 as logged by USGS' Earthquake hazards program.
                                                            data: 'https://geocode.at/list?state=3',
                                                            cluster: true,
                                                            clusterMaxZoom: 14, // Max zoom to cluster points on
                                                            clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
                                                        });

                                                        map.addLayer({
                                                            id: 'clusters',
                                                            type: 'circle',
                                                            source: 'festl',
                                                            filter: ['has', 'point_count'],
                                                            paint: {
                                                                // Use step expressions (https://docs.mapbox.com/mapbox-gl-js/style-spec/#expressions-step)
                                                                // with three steps to implement three types of circles:
                                                                //   * Blue, 20px circles when point count is less than 100
                                                                //   * Yellow, 30px circles when point count is between 100 and 750
                                                                //   * Pink, 40px circles when point count is greater than or equal to 750
                                                                'circle-color': [
                                                                    'step',
                                                                    ['get', 'point_count'],
                                                                    '#51bbd6',
                                                                    100,
                                                                    '#f1f075',
                                                                    750,
                                                                    '#f28cb1'
                                                                ],
                                                                'circle-radius': [
                                                                    'step',
                                                                    ['get', 'point_count'],
                                                                    20,
                                                                    100,
                                                                    30,
                                                                    750,
                                                                    40
                                                                ]
                                                            }
                                                        });

                                                        map.addLayer({
                                                            id: 'cluster-count',
                                                            type: 'symbol',
                                                            source: 'festl',
                                                            filter: ['has', 'point_count'],
                                                            layout: {
                                                                'text-field': '{point_count_abbreviated}',
                                                                'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                                                                'text-size': 12
                                                            }
                                                        });

                                                        map.addLayer({
                                                            id: 'unclustered-point',
                                                            type: 'circle',
                                                            source: 'festl',
                                                            filter: ['!', ['has', 'point_count']],
                                                            paint: {
                                                                'circle-color': '#11b4da',
                                                                'circle-radius': 4,
                                                                'circle-stroke-width': 1,
                                                                'circle-stroke-color': '#fff'
                                                            }
                                                        });

                                                        // inspect a cluster on click
                                                        map.on('click', 'clusters', function(e) {
                                                            var features = map.queryRenderedFeatures(e.point, {
                                                                layers: ['clusters']
                                                            });
                                                            var clusterId = features[0].properties.cluster_id;
                                                            map.getSource('festl').getClusterExpansionZoom(
                                                                clusterId,
                                                                function(err, zoom) {
                                                                    if (err) return;

                                                                    map.easeTo({
                                                                        center: features[0].geometry.coordinates,
                                                                        zoom: zoom
                                                                    });
                                                                }
                                                            );
                                                        });

                                                        // When a click event occurs on a feature in
                                                        // the unclustered-point layer, open a popup at
                                                        // the location of the feature, with
                                                        // description HTML from its properties.
                                                        map.on('click', 'unclustered-point', function(e) {
                                                            var coordinates = e.features[0].geometry.coordinates.slice();
                                                            var mag = e.features[0].properties.mag;
                                                            var tsunami;

                                                            if (e.features[0].properties.tsunami === 1) {
                                                                tsunami = 'yes';
                                                            } else {
                                                                tsunami = 'no';
                                                            }

                                                            // Ensure that if the map is zoomed out such that
                                                            // multiple copies of the feature are visible, the
                                                            // popup appears over the copy being pointed to.
                                                            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                                                                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                                                            }

                                                            new mapboxgl.Popup()
                                                                .setLngLat(coordinates)
                                                                .setHTML(
                                                                    'magnitude: ' + mag + '<br>Was there a tsunami?: ' + tsunami
                                                                )
                                                                .addTo(map);
                                                        });

                                                        map.on('mouseenter', 'clusters', function() {
                                                            map.getCanvas().style.cursor = 'pointer';
                                                        });
                                                        map.on('mouseleave', 'clusters', function() {
                                                            map.getCanvas().style.cursor = '';
                                                        });
                                                    });
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
