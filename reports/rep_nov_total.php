<?php
include '../class/ManejoDatos.php';
$command = new ManejoDatos();

//$con = mysqli_connect("localhost","root","", "matriculas_ai");

$sql = $command->ejecutarConsultaX("select * from ver_total_novedades");
$aux = null;

while ($res = $command->comprobarContenido($sql)) {
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
        <style>

            .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
        </style>
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
                                ['Situación académica', <?php echo $aux['ACADEMICA'] ?>],
                                ['Situación económica', <?php echo $aux['ECONOMICA'] ?>],
                                ['Seguridad', <?php echo $aux['SEGURIDAD'] ?>],
                                ['Servicios públicos', <?php echo $aux['SERVICIOS_PUBLICOS'] ?>],
                                ['Sin novedad', <?php echo $aux['SIN_NOVEDAD'] ?>]
                            ]
                        }]
                });
            });


        </script>
    </head>
    <body>
        <script src="Highcharts-4.1.5/js/highcharts.js"></script>
        <script src="Highcharts-4.1.5/js/modules/exporting.js"></script>

        <div id="container" style="min-width: 60%; max-width: 60%; height: 50%; margin: 0 auto"></div>
        <div class="datagrid" style="min-width: 80%; max-width: 100%; height: 50%; margin: 0 auto">
            <table>
                <thead><tr><th>Situación académica</th><th>Situación económica</th><th>Seguridad</th><th>Servicios públicos</th><th>Sin novedad</th></tr></thead>
                <tfoot><tr><td colspan="6"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>
                <tbody>

                    <tr><td><?php echo $aux['ACADEMICA']; ?></td><td><?php echo $aux['ECONOMICA']; ?></td><td><?php echo $aux['SEGURIDAD']; ?></td><td><?php echo $aux['SERVICIOS_PUBLICOS']; ?></td><td><?php echo $aux['SIN_NOVEDAD']; ?></td></tr>
                    <tr><td colspan="5"></td></tr>
                    <tr><td colspan="2" style="text-align: right"><strong>TOTAL REPORTADO</strong></td><td colspan="3"><?php echo $aux['ACADEMICA'] + $aux['ECONOMICA'] + $aux['SEGURIDAD'] + $aux['SERVICIOS_PUBLICOS'] + $aux['SIN_NOVEDAD']; ?></td></tr>

                </tbody>
            </table></div>
        <br><br>

    </body>
</html>
