<?php
include '../class/ManejoDatos.php';
$command = new ManejoDatos();
$count = 0;
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Matriculados vs No matriculados por municipio</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Total de estudiantes matriculados y no matriculados por municipio'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [ <?php $sql = $command->ejecutarConsultaX("SELECT * FROM no_matriculados_por_mun");
                while($res = $command->comprobarContenido($sql)){ ?>			
                ['<?php echo $res['mun_nombre'] ?>'], <?php } ?>
            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Estudiantes',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Estudiantes'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Matriculados',
            data: [ 
                <?php 
                $sql = $command->ejecutarConsultaX("SELECT * FROM no_matriculados_por_mun"); 
                while($res = $command->comprobarContenido($sql)){ ?>			
		[<?php echo $res['MATRICULADOS'] ?>], <?php 
                    $count+=$res['MATRICULADOS'];
                } ?>			
            ]
        }, {
            name: 'No matriculados',
            data: [ 
                <?php $sql = $command->ejecutarConsultaX("SELECT * FROM no_matriculados_por_mun"); 
                while($res = $command->comprobarContenido($sql)){ ?>			
                [<?php echo $res['NO_MATRICULADOS'] ?>], <?php 
                    $count+=$res['NO_MATRICULADOS'];
                } ?>			
            ]
        }]
    });
});
		</script>
	</head>
	<body>
<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="min-width: 600px; min-height:600px; max-width: 800px; height: 720px; margin: 0 auto;"></div>
<br><br>
	</body>
</html>
