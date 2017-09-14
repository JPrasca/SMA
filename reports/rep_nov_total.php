<?php

include '../class/ManejoDatos.php';
$command = new ManejoDatos();

//$con = mysqli_connect("localhost","root","", "matriculas_ai");

$sql=$command->ejecutarConsultaX("select * from ver_total_novedades");
$aux = null;

while($res=$command->comprobarContenido($sql)){
    $aux['SIN_NOVEDAD'] = $res['SIN_NOVEDAD'];
    $aux['SERVICIOS_PUBLICOS'] = $res['SERVICIOS_PUBLICOS'];
     $aux['SEGURIDAD'] = $res['SEGURIDAD'];
      $aux['ECONOMICA'] = $res['ECONOMICA'];
    $aux['ACADEMICA'] = $res['ACADEMICA'];
    
    break;
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Gráfica de novedades</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'REPORTE TOTAL DE NOVEDADES'
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
//            data: [
//                
//		['No hay novedad', 10],
//                ['Algo', 20]
//            ]
            data: [
                ['Situación académica', <?php echo $aux['ACADEMICA']?>],
                ['Situación económica', <?php echo $aux['ECONOMICA']?>],
                ['Seguridad', <?php echo $aux['SEGURIDAD']?>],
                ['Servicios públicos', <?php echo $aux['SERVICIOS_PUBLICOS']?>],
                ['Sin novedad', <?php echo $aux['SIN_NOVEDAD']?>]
            ]
        }]
    });
});


		</script>
	</head>
	<body>
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 600px; max-width: 800px; height: 600px; margin: 0 auto"></div>
<br><br>

	</body>
</html>
