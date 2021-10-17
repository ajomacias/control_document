<?php
require("./config/db.php");

$nombre_documento = (isset($_POST['documento']))?$_POST['documento']:"";
$fecha =  (isset($_POST['fecha']))?$_POST['fecha']:"";
$profesion = (isset($_POST['profesion']))?$_POST['profesion']:"";
$destinatario = (isset($_POST['destinatario']))?$_POST['destinatario']:"";
$rol = (isset($_POST['rol']))?$_POST['rol']:"";
$saludo = (isset($_POST['saludo']))?$_POST['saludo']:"";
$cuerpo = (isset($_POST['cuerpo']))?$_POST['cuerpo']:"";
$accion = (isset($_POST['action']))?$_POST['action']:"";

switch($accion){
    case "Guardar y imprimir":
    $sentensiaSQL = $conexion->prepare("INSERT INTO documentos (id, tipo_de_document, fecha, profesion, destinatario, rol, saludo, cuerpo) VALUES (NULL, :tipo, :fecha, :profesion, :destinatario, :rol, :saludo, :cuerpo)");
    $sentensiaSQL->bindParam(':tipo', $nombre_documento);
    $sentensiaSQL->bindParam(':fecha', $fecha);
    $sentensiaSQL->bindParam(':profesion', $profesion);
    $sentensiaSQL->bindParam(':destinatario', $destinatario);
    $sentensiaSQL->bindParam(':rol', $rol);
    $sentensiaSQL->bindParam(':saludo', $saludo);
    $sentensiaSQL->bindParam('cuerpo', $cuerpo);
    $sentensiaSQL->execute();
    $id = $conexion->lastInsertId();
    echo $id;

    header("location:pdf.php?varId=$id");
    
    break;

    case "Cancelar":
    header("Location:index.php");
    break;

}

include("./template/encabezado.php");
?>
    <div class="div-complete-pdf">
        <div class="form-pdf">
            <form method="post" >
            <label class="form-label" for="document-name-form">Tipo de documento:</label>
                <input id="document-name-form" name="documento" type="text" required >
                <label class="form-label" for="fecha-form">Fecha:</label>
                <input id="fecha-form" name="fecha" type="text" required >
                <label class="form-label" for="proesion-form">Profesion:</label>
                <input id="profesion-form" name="profesion" type="text" required >
                <label for="nombre-form">Nombre destinatario:</label>
                <input id="nombre-form" name="destinatario" type="text" required >
                <label for="rol-form">Rol:</label>
                <input id="rol-form" name="rol" type="text" required >
                <label for="cordial-form">Saludo:</label>
                <input id="cordial-form" name="saludo" type="text" required >
                <label for="cuerpo-form"></label>
                <textarea name="cuerpo" id="cuerpo-form" cols="60" rows="15.8" required ></textarea>
                 <input class="btn-guardar" name="action" type="submit" value="Guardar y imprimir">
                 <input class="btn-editar" name="action" type="submit" value="Editar">
                 <input class="btn-rojo" name="action" type="submit" value="Cancelar">

               
            </form>
        </div>
        <div id="capture-document" class="complete">


        <div class="formato-pdf">
            <img src="./img/encabezado.png" alt="" srcset="">
            <div class="div-padding">

                <h2 id="document-name"><?php echo $nombre_documento ?></h2>
                <p class="fecha-solicitud" id="fecha"><?php echo $fecha ?></p>
                <p id="profesion"><?php echo $profesion ?></p>
                <p id="nombre"><?php echo $destinatario ?></p>
                <P id="rol"><?php echo $rol ?></P>
                <p id="cordial" style="margin-top:30px ;"><?php echo $saludo ?></p>
                <p id="cuerpo"> <?php echo $cuerpo ?> <p>
            </div>

        </div>
    </div>
</div>




    </div>


    <script src="./styles/js/page.js"></script>
</body>

</html>