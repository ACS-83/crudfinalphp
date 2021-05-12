<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\Departamentos;
  //Lo primero que necesito es obtener el ID del profesor
  $id = $_GET['id'];
  //Quiero que los campos me los rellene con los valores que tiene el profesor
  $esteDepartamento = new Departamentos();
  $esteDepartamento->setId($id);
  $dbDepartamento = $esteDepartamento->read();

  if (isset($_POST['editar'])) {
    
    if (isset($_POST['nom_dep'])) {
        $nom_dep = $_POST['nom_dep'];
        if (strlen($nom_dep) == 0) {
          $_SESSION['mensaje']="Rellena el campo";
          header("Location:{$_SERVER['PHP_SELF']}?id=$id");
          die();
        }
      }
  
    $esteDepartamento = new Departamentos();
    $esteDepartamento->setId($id);
    $esteDepartamento->setNom_dep(mb_strtoupper($nom_dep, 'UTF-8'));
    $esteDepartamento->update();
    $esteDepartamento = null;

    $_SESSION['mensaje']="Departamento actualizado";
    header("Location:indicedepartamentos.php");
  } else {
?>
<!DOCTYPE html>
<html lang="es">
  <?php
    require 'recursos/head.php';
    head('Editar departamento');
  ?>
<body>
  <?php
    require 'recursos/navbar.php';
  ?>
  <div class="container mt-3">
    <h3 class="text-center">Editar departamento</h3>
  </div>
  <?php
      require 'recursos/mensajes.php';
    ?>
    <div class="container mt-3 w-25">
  <a href="indicedepartamentos.php" class="btn btn-dark my-2" style="margin-left: 30%; margin-right: 30%;">Volver a índice</a>
    <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method="POST">
      <label class="mt-2">Nombre departamento</label>
      <input type="text" class="form-control" value="<?php echo $dbDepartamento->nom_dep ?>" name="nom_dep">
      <div style="float: right;">
      <input type="submit" name="editar" class="btn btn-success mt-2" value="Actualizar">
      <input type="reset" value="Restaurar" class="btn btn-danger mt-2">
      </div>
    </form>
  </div>
  </body>
</html>
<?php
  }
?>