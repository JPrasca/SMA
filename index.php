<?php
include 'class/ManejoDatos.php';
$command = new ManejoDatos();
?>
<!DOCTYPE HTML>
<!--
        Prologue 1.2 by HTML5 UP
        html5up.net | @n33co
        Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>Sistema de matrículas</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-panels.min.js"></script>
        <script src="js/init.js"></script>
        <script src="reports/Highcharts-4.1.5/js/highcharts.js"></script>
        <script src="reports/Highcharts-4.1.5/js/modules/exporting.js"></script>

        <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-wide.css" />
        </noscript>
        <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->

        <script type="text/javascript">
            function popup()
            {
                parametro = window.open('/SMA/view_old_student.php?ID=' + document.getElementById('per_id').value, '', 'top=300,left=300,width=300,height=300');
                parametro.document.getElementById('formSearch').value = "nombres";

            }
        </script>

        <script type="text/javascript">
            var nav = null;

            function requestPosition() {
                if (nav == null) {
                    nav = window.navigator;
                }

                var geoloc = nav.geolocation;
                if (geoloc != null) {
                    geoloc.getCurrentPosition(successCallback, errorCallback);
                }

                initMap();
            }

            function successCallback(position) {
                document.getElementById("latitude").value =
                        position.coords.latitude;
                document.getElementById("longitude").value =
                        position.coords.longitude;

            }

            function errorCallback(error) {
                var strMessage = "";

                // Check for known errors
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        strMessage = "Access to your location is turned off. " +
                                "Change your settings to turn it back on.";
                        break;
                    case error.POSITION_UNAVAILABLE:
                        strMessage = "Data from location services is " +
                                "currently unavailable.";
                        break;
                    case error.TIMEOUT:
                        strMessage = "Location could not be determined " +
                                "within a specified timeout period.";
                        break;
                    default:
                        break;
                }

                document.getElementById("status").innerHTML = strMessage;
            }
        </script>
        <script type='text/javascript'>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: {lat: 40.731, lng: -73.997}
                });
                var geocoder = new google.maps.Geocoder;
                var infowindow = new google.maps.InfoWindow;

                document.getElementById('submit').addEventListener('click', function () {
                    geocodeLatLng(geocoder, map, infowindow);
                });
            }

            function geocodeLatLng(geocoder, map, infowindow) {

                var lat = document.getElementById('latitude').value;
                var lon = document.getElementById('longitude').value;


                var latlng = {lat: parseFloat(lat), lng: parseFloat(lon)};
                alert(latlng.toString());
                geocoder.geocode({'location': latlng}, function (results, status) {
                    if (status === 'OK') {
                        if (results[1]) {
                            map.setZoom(11);
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            infowindow.setContent(results[1].formatted_address);
                            infowindow.open(map, marker);
                            alert("Estas en " + results[3].formatted_address);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            }

        </script>
    </head>
    <body onload="requestPosition();">

        <!-- Header -->
        <input type="text" id="latitude" style="display: none;" />
        <input type ="text" id="longitude" style="display: none;"/>
        <div id="status" style="display: none;"> </div><br />
        <div id="header" class="skel-panels-fixed">

            <div class="top">

                <!-- Logo -->
                <div id="logo">
                    <span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
                    <h1 id="title">Usiario N/A</h1>
                    <span class="byline">Usuario predeterminado</span>
                </div>

                <!-- Nav -->
                <nav id="nav">

                    <ul>
                        <li><a href="#top" id="top-link" class="skel-panels-ignoreHref"><span class="fa fa-home">Inicio</span></a></li>
                        <li><a href="#registro" id="registro-link" class="skel-panels-ignoreHref"><span class="fa fa-user">Registro y matrículas</span></a></li>
                        <li><a href="#about" id="about-link" class="skel-panels-ignoreHref"><span class="fa fa-th">Información</span></a></li>
<!--                        <li><a href="#contact" id="contact-link" class="skel-panels-ignoreHref"><span class="fa fa-envelope">Contact</span></a></li>-->
                    </ul>
                </nav>

            </div>


        </div>

        <!-- Main -->
        <div id="main">

            <!-- Intro -->
            <section id="top" class="one">
                <div class="container">

                    <a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>

                    <header>
                        <h2 class="alt">Bienvenid@ al <strong>Sistema</strong></a>.</h2>
                    </header>

                    <p>Esto es un proyecto para la asignatura de Inteligencia Artificial de la Universidad de Cartagena correspondiente a un breve análisis simulado de matrículas y deserción de estudiantes teniendo a su ubicación.</p>
                    desarrollado por <strong>Jesús David Prasca</strong>, <strong>Inka Luhrs </strong>, <strong> David Garcés</strong>, y <strong>Deimer Romero</strong>
                    <footer>
                        <a href="#registro" class="button scrolly">Mas abajo</a>
                    </footer>

                </div>
            </section>

            <!-- registro -->
            <section id="registro" class="two">
                <div class="container">
                    <header>
                        <h2>Nuevo estudiante</h2>
                    </header>

                    <form name="fromNew" enctype="multipart/form-data" method="post" action="#">
                        <div class="row half">
                            <div class="3u">
                                <a target="popup" onclick="popup();" class="button" style="font-size: 11pt;">Verificar si está registrado</a>
                            </div>
                            <div class="4u"><input id="per_id" type="text" class="text" name="per_id" placeholder="Identificación" /></div>
                            <p class="line">__________________________________________________________________________</p><br>
                            <div class="4u"><input id="per_nombre" type="text" class="text" name="per_nombre" placeholder="Nombre" /></div>
                            <div class="4u"><input id="per_apellido1" type="text" class="text" name="per_apellido1" placeholder="Primer apellido" /></div>
                            <div class="4u"><input id="per_apellido2" type="text" class="text" name="per_apellido2" placeholder="Segundo apellido" /></div>
                            <p class="line">__________________________________________________________________________</p><br>

                            <div class="3u">
                                <select id="per_estrato" class="text" name="per_estrato" placeholder="Primer apellido">
                                    <option value="">Estrato</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="3u">
                                <select id="mat_programa" class="text" name="mat_programa" placeholder="Programa">
                                    <option value="">Programa</option>
                                    <?php
                                    $res = $command->extraerListas(1);
                                    while ($row = $command->comprobarContenido($res)) {
                                        echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="2u">
                                <select id="nov_codigo" type="text" class="text" name="nov_codigo" placeholder="Código novedad">
                                    <option value="">Tipo de novedad</option>
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="3u">
                                <textarea id="nov_detalle" name="nov_detalle" placeholder="Detalles de novedad"></textarea>
                            </div>

                            <p class="line">_______________________________________________________________________________</p><br>

                            <div class="row">
                                <div class="10u" style="height: 96px; width: 240px;">
                                    <a href="#" onclick="initMap();" id="submit" class="button submit">Continuar</a>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </section>


            <section id="about" class="three">
                <div class="container">

                    <header>
                        <h2>Información</h2>
                    </header>
                    <script type="text/javascript">
                        $(function () {
                            $('#container').highcharts({
                                chart: {
                                    plotBackgroundColor: null,
                                    plotBorderWidth: null,
                                    plotShadow: false
                                },
                                title: {
                                    text: 'Población de estudiantes'
                                },
                                tooltip: {
                                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                },
                                plotOptions: {
                                    pie: {
                                        allowPointSelect: true,
                                        cursor: 'pointer',
                                        dataLabels: {
                                            enabled: true,
                                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                            style: {
                                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                            }
                                        }
                                    }
                                },
                                series: [{
                                        type: 'pie',
                                        name: 'Indices',

                                        data: [
                                        <?php
                                        $result = $command->ejecutarConsultaX("SELECT * FROM matriculados_por_prog");
                                        while ($row = $command->comprobarContenido($result)) {
                                            ?>['<?php echo $row['prog_nombre'] ?>', <?php echo $row['MATRICULADOS'] ?>],
                                        <?php } ?>

                                        ]
                                    }]
                            });
                        });


                    </script>
                    <div id="container" style="min-width: 60%; max-width: 80%; height: 40%; margin: 0 auto"></div>
                    <p>
                        <?php
                        $resultset = $command->ejecutarConsultaX("SELECT * FROM matriculados_por_prog");
                        $acumulador = 0;
                        $acumulador2 = 0;

                        while ($res = $command->comprobarContenido($resultset)) {
                            echo "Del programa de <strong>" . $res['prog_nombre'] . "</strong>";
                            echo " hay <strong>" . $res['MATRICULADOS'] . "</strong> estudiantes matriculados y <strong>" . $res['NO_MATRICULADOS'] . "</strong> aún no se matriculan<br>";

                            $acumulador+=$res['MATRICULADOS'];
                            $acumulador2+=$res['NO_MATRICULADOS'];
                        }

                        echo "<br> Para un total de <strong>" . $acumulador . "</strong> estudiantes matriculados y <strong>" . $acumulador2 . "</strong> no matriculados";
                        echo "<br> <strong>TOTAL</strong> de estudiantes: " . ($acumulador + $acumulador2);
                        ?>
                    </p>
                    <div class="row">
                        <button type="button" class="button" onclick="window.open('../SMA/reports/rep_mat_x_mun.php', this.target, 'width=1024px,height=600px');
                                return false;">Posibles deserciones por municipio</button> 
                        <button type="button" class="button" onclick="window.open('../SMA/reports/rep_nov_total.php', this.target, 'width=1024px,height=600px');
                                return false;">Novedades registradas</button> 
                        <button type="button" class="button" onclick="window.open('../SMA/reports/rep_mat_x_pro.php', this.target, 'width=1024px,height=600px');
                                return false;">Programas con posible deserción</button>
                    </div>
                </div>
            </section>

        </div>
        <div id="map" style="display: none;"></div>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACJapLIVhm-uVWitwICh24232jYdkP1SQ&callback=initMap">
        </script>
    </body>

</html>