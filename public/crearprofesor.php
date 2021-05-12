<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\Profesores;
  use Clases\Departamentos;

  $departamentos = new Departamentos();
  $misdepartamentos = $departamentos->devolverTodos();
  $departamentos=null;

  if (isset($_POST['crear'])) {

    if (isset($_POST['nom_prof'])) {
      $nom_prof = $_POST['nom_prof'];
      if (strlen($nom_prof) == 0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location: crearprofesor.php");
        die();
      }
    }

    if (isset($_POST['sueldo'])) {
      $sueldo = $_POST['sueldo'];
      if (strlen($sueldo) == 0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location: crearprofesor.php");
        die();
      }
    }

    if (isset($_POST['fecha_prof'])) {
      $fecha_prof = $_POST['fecha_prof'];
      if (strlen($fecha_prof) == 0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location: crearprofesor.php");
        die();
      }
    }

    if (isset($_POST['dep'])) {
        $dep = $_POST['dep'];
        if (strlen($dep) == 0) {
          $_SESSION['mensaje']="Rellena los campos";
          header("Location: crearprofesor.php");
          die();
        }
      }
    $esteProfesor = new Profesores();
    $esteProfesor->setNom_prof(mb_strtoupper($nom_prof, 'UTF-8')); /* Conversión a mayúscula */
    $esteProfesor->setSueldo($sueldo);
    $esteProfesor->setFecha_prof($fecha_prof);
    $esteProfesor->setDep($dep);
    if (!$esteProfesor->existeProfesor($nom_prof)) {
      $esteProfesor->create();
      $esteProfesor = null;
      $_SESSION['mensaje']="Profesor creado";
      header("Location:indiceprofesores.php");
    } else {
      $_SESSION['mensaje']="El profesor existe!!";
      $esteProfesor=null;
      header("Location: crearprofesor.php");
      die();
    }
  } else {
?>
  <?php
    require 'recursos/head.php';
    head('Crear profesor');
  ?>
<body>
  <?php
    require 'recursos/navbar.php';
  ?>
  <div class="container mt-3 text-center">
    <h3 class="text-center mt-3">Formulario alta nuevo profesor</h3>
  </div>
  <div class="container mt-3">
    <?php
      require 'recursos/mensajes.php';
    ?>
  </div>
  <div class="container mt-3 w-25">
  <a href="indiceprofesores.php" class="btn btn-dark my-2" style="margin-left: 30%; margin-right: 30%;">Volver a índice</a>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <label class="mt-2">Nombre y apellidos</label>
      <input type="text" class="form-control" name="nom_prof">
      <label class="mt-2">Sueldo</label>
      <input type="number" class="form-control" step=".01" name="sueldo">
      <label class="mt-2">Fecha alta</label>
      <input type="date" class="form-control" name="fecha_prof">
      <label class="mt-2">Departamento</label>
<!-- Select dinámico: muestra los departamentos disponibles en BDD -->

      <select name="dep">
        <option value="" selected>Selecciona</option>
        <?php
        while($fila=$misdepartamentos->fetch(PDO::FETCH_OBJ)) {
            echo "<option value={$fila->id}>{$fila->nom_dep}</option>";
          }
        ?>
        </select>
    <p>
    <div style="float: right;">
      <input type="submit" name="crear" class="btn btn-success mt-2" value="Crear profesor">
      <input type="reset" value="Limpiar" class="btn btn-danger mt-2">
    </div>
    </form>
  </div>
</body>
</html>
<?php
  }
?>