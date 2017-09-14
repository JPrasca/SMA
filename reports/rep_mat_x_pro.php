<?php

include '../class/ManejoDatos.php';
$command = new ManejoDatos();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Indice de deserción</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Total de estudiantes matriculados y no matriculados por programa'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [ <?php $sql=$command->ejecutarConsultaX("SELECT * FROM matriculados_por_prog");
                while($res=$command->comprobarContenido($sql)){ ?>			
                ['<?php echo $res['prog_nombre'] ?>'], <?php } ?>
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
            valueSuffix: ' estudiantes'
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
            data: [ <?php $sql=$command->ejecutarConsultaX("SELECT * FROM matriculados_por_prog"); 
                        while($res=$command->comprobarContenido($sql)){ ?>			
			[<?php echo $res['MATRICULADOS'] ?>], <?php } ?>			
            ]
        }, {
            name: 'No matriculados',
            data: [ <?php $sql=$command->ejecutarConsultaX("SELECT * FROM matriculados_por_prog"); 
                    while($res=$command->comprobarContenido($sql)){ ?>			
                    [<?php echo $res['NO_MATRICULADOS'] ?>], <?php } ?>			
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
