<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\{Profesores, Departamentos};
  //Lo primero que necesito es obtener el ID del profesor
  $id = $_GET['id'];
  //Quiero que los campos me los rellene con los valores que tiene el profesor
  $esteProfesor = new Profesores();
  $esteProfesor->setId($id);
  $dbProfesor = $esteProfesor->read();

  $departamentos = new Departamentos();
  $misdepartamentos = $departamentos->devolverTodos();
  // $departamentos=null;

  if (isset($_POST['editar'])) {
    
    if (isset($_POST['nom_prof'])) {
        $nom_prof = $_POST['nom_prof'];
        if (strlen($nom_prof) == 0) {
          $_SESSION['mensaje']="Rellena los campos";
          header("Location:{$_SERVER['PHP_SELF']}?id=$id");
          die();
        }
      }
  
      if (isset($_POST['sueldo'])) {
        $sueldo = $_POST['sueldo'];
        if (strlen($sueldo) == 0) {
          $_SESSION['mensaje']="Rellena los campos";
          header("Location:{$_SERVER['PHP_SELF']}?id=$id");
          die();
        }
      }
  
      if (isset($_POST['fecha_prof'])) {
        $fecha_prof = $_POST['fecha_prof'];
        if (strlen($fecha_prof) == 0) {
          $_SESSION['mensaje']="Rellena los campos";
          header("Location:{$_SERVER['PHP_SELF']}?id=$id");
          die();
        }
      }
  
      if (isset($_POST['dep'])) {
          $dep = $_POST['dep'];
          if (strlen($dep) == 0) {
            $_SESSION['mensaje']="Rellena los campos";
            header("Location:{$_SERVER['PHP_SELF']}?id=$id");
            die();
          }
        }

    $esteProfesor = new Profesores();
    $esteProfesor->setId($id);
    $esteProfesor->setNom_prof(mb_strtoupper($nom_prof, 'UTF-8'));
    $esteProfesor->setSueldo($sueldo);
    $esteProfesor->setFecha_prof($fecha_prof);
    $esteProfesor->setDep($dep);

    $esteProfesor->update();
    $esteProfesor = null;

    $_SESSION['mensaje']="Profesor actualizado";
    header("Location:indiceprofesores.php");
  } else {
?>
<!DOCTYPE html>
<html lang="es">
  <?php
    require 'recursos/head.php';
    head('Editar profesor');
  ?>
<body>
  <?php
    require 'recursos/navbar.php';
  ?>
  <div class="container mt-3">
    <h3 class="text-center">Editar profesor</h3>
  </div>
  <?php
      require 'recursos/mensajes.php';
    ?>
  <div class="container mt-3 w-25">
  <a href="indiceprofesores.php" class="btn btn-dark my-2" style="margin-left: 30%; margin-right: 30%;">Volver a índice</a>
  <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id"; ?>" method="POST">
      <label class="mt-2">Nombre y apellidos</label>
      <input type="text" class="form-control" value="<?php echo $dbProfesor->nom_prof ?>" name="nom_prof">
      <label class="mt-2">Sueldo</label>
      <input type="number" class="form-control" value="<?php echo $dbProfesor->sueldo ?>" step=".01" name="sueldo">
      <label class="mt-2">Fecha alta</label>
      <input type="date" class="form-control" value="<?php echo $dbProfesor->fecha_prof ?>" name="fecha_prof">
      <label class="mt-2">Departamento</label>
        <select name="dep">
        <option value="">Selecciona</option>
        <?php
// Si el contenido de la variable de la tabla profesor coincide con el id de la tabla departamento, añade atributo SELECTED
            while ($fila=$misdepartamentos->fetch(PDO::FETCH_OBJ)) {
              if ($dbProfesor->dep === $fila->id) {
                  echo "<option value='{$dbProfesor->dep}' selected>{$fila->nom_dep}</option>";
              } else {
                echo "<option value='{$fila->id}'>{$fila->nom_dep}</option>";
              }
            }
        ?>
        </select>
    <p>
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