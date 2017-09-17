<?php
include 'class/ManejoDatos.php';

$command = new ManejoDatos();
$ubicacion = null;
$nombres = null;

?>
<!DOCTYPE HTML>

<html>
    <head>
        <title>Sistema de matrículas</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="js/jquery.min.js"></script>
	<script src="js/jquery.js" type="text/javascript"></script>
        <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
        <script src="js/skel.min.js"></script>
        <script src="js/skel-panels.min.js"></script>
        <script src="js/init.js"></script>
        <script src="reports/Highcharts-4.1.5/js/highcharts.js"></script>
        <script src="reports/Highcharts-4.1.5/js/modules/exporting.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACJapLIVhm-uVWitwICh24232jYdkP1SQ">
        </script>

        <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-wide.css" />
        </noscript>
        <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->

        <script type="text/javascript">
            var lugar = "";
            var nav = null;

            function requestPosition() {
                if (nav === null) {
                    nav = window.navigator;
                }

                var geoloc = nav.geolocation;
                if (geoloc !== null) {
                    geoloc.getCurrentPosition(successCallback, errorCallback);
                }

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

            function initMap() {
                var lat = document.getElementById('latitude').value;
                var lon = document.getElementById('longitude').value;
                var latlng = {lat: parseFloat(lat), lng: parseFloat(lon)};

                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 12,
                    center: latlng
                });
                var geocoder = new google.maps.Geocoder;
                var infowindow = new google.maps.InfoWindow;


                document.getElementById('btn_loc').addEventListener('click', function () {
                    //console.log('Casi se activa el click');
                    geocodeLatLng(geocoder, map, infowindow);
                });

                document.getElementById('btn_abajo').addEventListener('click', function () {
                    //console.log('Casi se activa el click');
                    geocodeLatLng(geocoder, map, infowindow);
                });

                document.getElementById('top-link').addEventListener('click', function () {
                    //console.log('Casi se activa el click');
                    geocodeLatLng(geocoder, map, infowindow);
                });

                document.getElementById('info-link').addEventListener('click', function () {
                    //console.log('Casi se activa el click');
                    geocodeLatLng(geocoder, map, infowindow);
                });

                document.getElementById('registro-link').addEventListener('click', function () {
                    //console.log('Casi se activa el click');
                    geocodeLatLng(geocoder, map, infowindow);
                });
                
                document.getElementById('activar-link').addEventListener('click', function () {
                    geocodeLatLng(geocoder, map, infowindow);
                });

            }

            function geocodeLatLng(geocoder, map, infowindow) {

                var lat = document.getElementById('latitude').value;
                var lon = document.getElementById('longitude').value;


                var latlng = {lat: parseFloat(lat), lng: parseFloat(lon)};

                geocoder.geocode({'location': latlng}, function (results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setZoom(11);
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            infowindow.setContent(results[1].formatted_address);
                            infowindow.open(map, marker);
                            document.getElementById('country').innerHTML = results[2].formatted_address;
                            lugar = results[2].formatted_address;
                            console.log(lugar);
                        } else {
                            console.log('No results found');
                        }
                    } else {
                        console.log('Geocoder failed due to: ' + status);
                    }
                });
            }

            $(document).on('ready', function () {
                //alert("document ready");
                
                $.ajax({
                    type: "POST",
                    url: "formulario.php",
                    data: {"opcion": "buscar"},
                    success: function (data)
                    {
                        //alert(data);
                      
                    }
                });
            });
            
            function reiniciar(){
                $.ajax({
                    type: "POST",
                    url: "formulario.php",
                    data: {
                        opcion: "reiniciar"
                        
                    },
                        success: function (data)
                    {
                        alert(data);
                    }
                });
            }
            
            function buscar() {
                //alert("buscar desde javascript");
                //alert("id: " + $('#id').val());
                lugar = lugar.split(",")[1];
                $.ajax({
                    type: "POST",
                    url: "view_old_student.php",
                    data: {
                        opcion: "buscar", per_id: $('#per_id').val(), per_nombre: $('#per_nombre').val(),
                        per_apellido1: $('#per_apellido1').val(), per_apellido2: $('#per_apellido2').val(),
                        per_estrato: $('#per_estrato').val(), mat_programa: $('#mat_programa').val(),
                        nov_codigo:$('#nov_codigo').val(), nov_detalle: $('#nov_detalle').val(),
                        country: lugar
                    },
                    success: function (data)
                    {
                        //alert(data);
                        open('view_old_student.php?per_id=' + $('#per_id').val() + '&country=' + 
                        lugar.trim(), '', 'width=800px,height=600px');
                    }
                });
            }
            
            function registrar() {
                alert("registrar desde javascript");
                
                //alert("nombre: " + $('#firstname').val() + "\napellido: " + $('#lastname').val());
//                alert($('#per_id').val());
//                alert($('#per_nombre').val());
//                alert($('#per_apellido1').val());
//                alert($('#per_apellido2').val());
//                alert($('#per_estrato').val());
//                alert($('#mat_programa').val());
//                alert($('#nov_codigo').val());
//                alert($('#nov_detalle').val());
//                alert(lugar.split(",")[1]);
                lugar = lugar.split(",")[1];
                $.ajax({
                    type: "POST",
                    url: "formulario.php",
                    data: {
                        opcion: "registrar", per_id: $('#per_id').val(), per_nombre: $('#per_nombre').val(),
                        per_apellido1: $('#per_apellido1').val(), per_apellido2: $('#per_apellido2').val(),
                        per_estrato: $('#per_estrato').val(), mat_programa: $('#mat_programa').val(),
                        nov_codigo: $('#nov_codigo').val(), nov_detalle: $('#nov_detalle').val(),
                        country: lugar
                        
                    },
                        success: function (data)
                    {
                        alert(data);
                    }
                });
            }
        </script>
        <style>
            #map {                
                height: 300px;
                width: 100%;
                allowfullscreen;
            }
        </style>
    </head>
    <body id="todo" onload="requestPosition();">

        <!-- Header -->
        <input type="text" id="latitude" style="display: none;" />
        <input type ="text" id="longitude" style="display: none;"/>

        <div id="status" style="display: none;"> </div><br />
        <div id="header" class="skel-panels-fixed">

            <div class="top">

                <!-- Logo -->
                <div id="logo">
                    <span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
                    <h1 id="title">Usuario N/A</h1>
                    <span class="byline">Usuario predeterminado</span>
                    <label class="byline" type="text" id="country" name="country" value=""></label>
                </div>

                <!-- Nav -->
                <nav id="nav">

                    <ul>
                        <li><a href="#top" id="top-link" class="skel-panels-ignoreHref" onclick="initMap();"><span class="fa fa-home">Inicio</span></a></li>
                        <li><a href="#registro" id="registro-link" class="skel-panels-ignoreHref" onclick="initMap();"><span class="fa fa-user">Registro y matrículas</span></a></li>
                        <li><a href="#information" id="info-link" class="skel-panels-ignoreHref"><span class="fa fa-th" onclick="initMap();">Información</span></a></li>
                        <li><a href="#" id="activar-link" class="skel-panels-ignoreHref" onclick="reiniciar();"><span class="fa fa-calendar-o" onclick="initMap();">Reiniciar matrículas</span></a></li>
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
                        <h2 class="alt">Bienvenid@ al <strong>Sistema</strong>.</h2>
                    </header>

                    <p>Esto es un proyecto para la asignatura de Inteligencia Artificial de la Universidad de Cartagena correspondiente a un breve análisis simulado de matrículas y deserción de estudiantes teniendo a su ubicación.</p>
                    desarrollado por <strong>Jesús David Prasca</strong>, <strong>Inka Luhrs </strong>, <strong> David Garcés</strong>, y <strong>Deimer Romero</strong>
                    <footer>
                        <a id="btn_abajo" href="#registro" class="button scrolly" onclick="initMap();">Mas abajo</a>
                    </footer>

                </div>
            </section>

            <!-- registro -->
            <section id="registro" class="two">
            <div id="map"></div>
                <div class="container">
                    <header>
                        <h2>Nuevo estudiante</h2>
                    </header>

                    <form name="formNew" enctype="multipart/form-data" method="post" action="view_new_student.php">
                        <div class="row half">
                            <div class="3u">
                                <a target="popup" onclick="buscar();" class="button" style="font-size: 11pt;">Verificar si está registrado</a>
                            </div>
                            <div class="4u"><input id="per_id" type="text" class="text" name="per_id" placeholder="Identificación" required="required" /></div>
                            <p class="line">__________________________________________________________________________</p><br>
                            <div class="4u"><input id="per_nombre" type="text" class="text" name="per_nombre" placeholder="Nombre" required="required" /></div>
                            <div class="4u"><input id="per_apellido1" type="text" class="text" name="per_apellido1" placeholder="Primer apellido" required="required"/></div>
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
                                <select id="mat_programa" class="text" name="mat_programa" placeholder="Programa" required="required">
                                    <option value="">Programa</option>
                                    <?php
                                    $res = $command->extraerListas(1);
                                    $i = 0;
                                    while ($i < count($res)) {
                                        echo "<option value='" . $res[$i]["id"] . "'>" . $res[$i]["nombre"] . "</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="2u">
                                <select id="nov_codigo" type="text" class="text" name="nov_codigo" placeholder="Código novedad" required="required">
                                    <option value="">Tipo de novedad</option>
                                    <?php
                                    $res = $command->extraerListas(2);
                                    $i = 0;
                                    while ($i < count($res)) {
                                        echo "<option value='" . $res[$i]["id"] . "'>" . $res[$i]["nombre"] . "</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="3u">
                                <textarea id="nov_detalle" name="nov_detalle" placeholder="Detalles de novedad"></textarea>
                            </div>

                            <p class="line">_______________________________________________________________________________</p><br>

                            <div class="row">
                                <div class="10u" style="height: 96px; width: 240px;">
                                    <!--<a href="#registro" onclick="initMap();" id="getLoc" class="button submit">Continuar</a>-->
                                    <input type="button" onclick="initMap(); registrar();" id="btn_loc" class="button sumit" value="Registrar"/>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </section>


            <section id="information" class="three">
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
                                    text: 'Población estudiantil matriculada'
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
                                        name: 'índice',
                                        data: [
                                            <?php
                                            $j = 0;
                                            $result = $command->ejecutarConsultaX("SELECT * FROM matriculados_por_prog");
                                            while ($row = $command->comprobarContenido($result)) {
                                                ?>['<?php echo $row['prog_nombre'] ?>', <?php echo $row['MATRICULADOS'] ?>],
                                            <?php 
                                                $nombres[$j] = $row['prog_nombre'];
                                                $j++;
                                            } ?>

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
                        $contador = 0;
                        while ($res = $command->comprobarContenido($resultset)) {
                            //echo "Del programa de <strong>" . $res['prog_nombre'] . "</strong>";
                            //echo " hay <strong>" . $res['MATRICULADOS'] . "</strong> estudiantes matriculados y <strong>" . $res['NO_MATRICULADOS'] . "</strong> aún no se matriculan<br>";

                            $acumulador+=$res['MATRICULADOS'];
                            $acumulador2+=$res['NO_MATRICULADOS'];
                            $contador++;
                        }

                        echo "<br> Para un total de <strong>" . $acumulador . "</strong> estudiantes matriculados y <strong>" . $acumulador2 . "</strong> no matriculados";
                        echo "<br> <strong>TOTAL</strong> de estudiantes: " . ($acumulador + $acumulador2);
                        ?>
                    </p>
                    <div class="row">
                        <button type="button" class="button" onclick="window.open('reports/rep_mat_x_mun.php', this.target, 'width=1024px,height=600px');
                                return false;">Matriculados y restantes por municipio</button> 
                        <button type="button" class="button" onclick="window.open('reports/rep_nov_total.php', this.target, 'width=1024px,height=600px');
                                return false;">Novedades registradas</button> 
                        <button type="button" class="button" onclick="window.open('reports/rep_mat_x_pro.php', this.target, 'width=1024px,height=600px');
                                return false;">Matriculados y restantes por programa</button>
                      
                        <button type="button" class="button" onclick="window.open('reports/rep_listado1.php', this.target, 'width=1024px,height=600px');
                                return false;">Listado de matriculados en Civil</button>
                         <button type="button" class="button" onclick="window.open('reports/rep_listado2.php', this.target, 'width=1024px,height=600px');
                                return false;">Listado de matriculados en Sistemas</button>
                         <button type="button" class="button" onclick="window.open('reports/rep_listado3.php', this.target, 'width=1024px,height=600px');
                                return false;">Listado de matriculados en Química</button>
                         <button type="button" class="button" onclick="window.open('reports/rep_listado4.php', this.target, 'width=1024px,height=600px');
                                return false;">Listado de matriculados en Alimentos</button>
                         <button type="button" class="button" onclick="window.open('reports/rep_listado5.php', this.target, 'width=1024px,height=600px');
                                return false;">Listado de matriculados en Electrónica</button>
                         <button type="button" class="button" onclick="window.open('reports/rep_listado6.php', this.target, 'width=1024px,height=600px');
                                return false;">Listado de matriculados en Mecánica</button>
                    </div>
                </div>
            </section>

        </div>
        <!--<div id="map" style="display: none;"></div>-->

    </body>

</html>
