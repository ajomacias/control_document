<?php
require("./config/db.php");

if($_GET){
    $id = $_GET["varId"];
    $sentenciaSQL = $conexion->prepare("SELECT * FROM documentos as d WHERE d.id = :id ");
    $sentenciaSQL->bindParam(':id', $id);
    $sentenciaSQL->execute();
    $cargar = $sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
};

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
        $sentenciaSQL = $conexion->prepare("SELECT cuerpo FROM documentos WHERE documentos.cuerpo=:cuerpo");
        $sentenciaSQL->bindParam(':cuerpo',$cuerpo);
        $sentenciaSQL->execute();
        $verificar = $sentenciaSQL->fetch( PDO::FETCH_LAZY);
        if($verificar){
            $mensaje = "Este documento ya existe, otro documento tiene exactamente el mismo cuerpo";
            break;

        }else{
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
            $mensaje = "Se a insertado correctamente";
             header("location:pdf.php?varId=$id");
             break;

        }

    case "Cancelar":
    header("Location:index.php");
    break;

    case "Editar":
        $sentenciaSQL = $conexion->prepare("UPDATE documentos as d SET d.tipo_de_document=:documento, d.fecha=:fecha, d.profesion=:profesion, d.destinatario=:destinatario, d.rol=:rol, d.saludo=:saludo, d.cuerpo=:cuerpo WHERE d.id=:id");
        $sentenciaSQL->bindParam(':documento', $nombre_documento );
        $sentenciaSQL->bindParam(':fecha', $fecha );
        $sentenciaSQL->bindParam(':profesion',$profesion);
        $sentenciaSQL->bindParam(':destinatario', $destinatario );
        $sentenciaSQL->bindParam(':rol', $rol );
        $sentenciaSQL->bindParam(':saludo', $saludo);
        $sentenciaSQL->bindParam(':cuerpo', $cuerpo );
        $sentenciaSQL->bindParam(':id', $id);
        $sentenciaSQL->execute();

        $mensaje = "Se ha editado correctamente";
        header("location:index.php?varId=$id");
        break;
}

include("./template/encabezado.php");
?>
    <div class="div-complete-pdf">
        <?php if(isset($mensaje)){?>    
                <div class="mensaje"> <?php echo $mensaje; ?> </div>
                <?php } ?>
        <div class="form-pdf">
        
            <form method="post" >
                
            <label class="form-label" for="document-name-form">Tipo de documento:</label>
                <input id="document-name-form" name="documento" value="<?php echo  isset($id) ? $cargar['tipo_de_document']:""; ?>" type="text" required >
                <label class="form-label" for="fecha-form">Fecha:</label>
                <input id="fecha-form" name="fecha" value="<?php echo  isset($id) ? $cargar['fecha']:""; ?>"  type="text" required >
                <label class="form-label" for="proesion-form">Profesion:</label>
                <input id="profesion-form" name="profesion" type="text" value="<?php echo  isset($id) ? $cargar['profesion']:""; ?>"  required >
                <label for="nombre-form">Nombre destinatario:</label>
                <input id="nombre-form" name="destinatario" value="<?php echo  isset($id) ? $cargar['destinatario']:""; ?>"  type="text" required >
                <label for="rol-form">Rol:</label>
                <input id="rol-form" name="rol" name="destinatario" value="<?php echo  isset($id) ? $cargar['rol']:""; ?>" type="text" required >
                <label for="cordial-form">Saludo:</label>
                <input id="cordial-form" name="saludo" value="<?php echo  isset($id) ? $cargar['saludo']:""; ?>" type="text" required >
                <label for="cuerpo-form"></label>
                <textarea name="cuerpo" id="cuerpo-form" cols="60" rows="15.8"  required ><?php echo  isset($id) ? $cargar['cuerpo']:""; ?></textarea>
                 <input class="btn-guardar" <?php if(isset($id)) echo "disabled"?:""; ?> name="action" type="submit" value="Guardar y imprimir">
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