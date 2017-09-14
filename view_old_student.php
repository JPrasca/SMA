<?php
include 'class/ManejoDatos.php';

$command = new ManejoDatos();

echo "recibió: " . $_REQUEST['ID'];

$registro = $command->ejecutarConsultaX("SELECT per_nombres FROM personas WHERE per_id = ".$_REQUEST['ID']);
$nombre = "";
while ($row = $command->comprobarContenido($registro)){
    $nombre = $row['per_nombres'];
}
?>

<html>
    
    <head>
        <title></title>
        <script type="text/javascript">
    function envia(nombres)
    {   
            
           opener.document.formNew. = nombres;
           close();
    }
</script>
    </head>
    <body>
        <form name="formSearch" enctype="multipart/form-data"
              <a href="#" onclick="envia(<?php echo $row["per_nombres"]; ?>);" /> enviar<a></a>
    </body>
</html>


