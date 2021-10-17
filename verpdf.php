<?php
require("./config/db.php");

$id = $_GET["varId"];

$sentenciaSQL = $conexion->prepare("SELECT * FROM documentos WHERE documentos.id=:id");
$sentenciaSQL->bindParam(":id",$id);
$sentenciaSQL->execute();

$pdf = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/pdf.css">
    <title>Document</title>
</head>

<body>
    <div class="complete">

        <div class="formato-pdf">
            <img src="./img/encabezado.png" alt="" srcset="">
            <div class="div-padding">

                <h2><?php echo $pdf['tipo_de_document']?> </h2>
                <p class="fecha-solicitud"><?php echo $pdf['fecha']?></p>
                <p><?php echo $pdf['profesion']?></p>
                <p><?php echo $pdf['destinatario']?></p>
                <P><?php echo $pdf['rol']?></P>
                <p style="margin-top:30px ;"><?php echo $pdf['saludo']?></p>
                <p><?php echo $pdf['cuerpo']?></p>
            </div>

        </div>
    </div>

</body>

</html>