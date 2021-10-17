<?php
require("./config/db.php");

$accion = (isset($_POST['action']))?$_POST['action']:"";
$id = (isset($_POST['ID']))?$_POST['ID']:"";

switch($accion){
    case "editar":
        header("location:index.php?varId=$id");
        break;
    case "eliminar":
        $sentenciaSQL = $conexion->prepare("DELETE FROM `documentos` WHERE `documentos`.`id` = :id");
        $sentenciaSQL->bindParam(':id',$id);
        $sentenciaSQL->execute();
        header('table.php');
        break;
    case "imprimir":
        header("location:pdf.php?varId=$id");
        break;
    case "ver":
        header("location:verpdf.php?varId=$id");
        break;
}

 $sentenciaSQL= $conexion->prepare("SELECT * FROM documentos ");
 $sentenciaSQL->execute();
 $dulce = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
 
include("./template/encabezado.php");
?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                        <th>id</th>
                            <th>Destinatario</th>
                            <th>fecha de envio</th>
                            <th>tipo de documento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <?php foreach($dulce as $lista) {?>
                        <tr>
                            
                            <td> <?php echo $lista['id']?> </td>
                            <td class="row"> <?php echo $lista['destinatario']?> </td>
                            <td> <?php echo $lista['fecha']?> </td>
                            <td> <?php echo $lista['tipo_de_document']?> </td>
                            <td >
                                <form method="post">
                                    <input name="ID" class="btn btn-guardar" type="hidden" value="<?php echo $lista['id'] ?>">
                                    <input name="action" class="btn btn-editar" type="submit" value="editar">
                                    <input name="action" class="btn btn-danger" type="submit" value="eliminar">
                                    <input name="action" type="submit" class="btn btn-primary" value="ver">
                                    <input name="action" type="submit" class="btn btn-primary" value="imprimir">
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                     

                    </tbody>
                </table>
                
            </div>

        </div>
    

    </div>
   

</body>
</html>