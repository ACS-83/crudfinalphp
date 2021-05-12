<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\Departamentos;


  if (isset($_POST['crear'])) {

    if (isset($_POST['nom_dep'])) {
      $nom_dep = $_POST['nom_dep'];
      if (strlen($nom_dep) == 0) {
        $_SESSION['mensaje']="Rellena los campos";
        header("Location: creardepartamento.php");
        die();
      }
    }
    
    $esteDepartamento = new Departamentos();
    $esteDepartamento->setNom_dep(mb_strtoupper($nom_dep, 'UTF-8')); /* Conversión variable a mayúscula */
    if (!$esteDepartamento->existeDepartamento($nom_dep)) {
      $esteDepartamento->create();
      $esteDepartamento = null;
      $_SESSION['mensaje']="Departamento creado";
      header("Location:indicedepartamentos.php");
    } else {
      $_SESSION['mensaje']="El departamento existe!!";
      $esteDepartamento=null;
      header("Location: creardepartamento.php");
      die();
    }
  } else {
?>
  <?php
    require 'recursos/head.php';
    head('Crear departamento');
  ?>
<body>
  <?php
    require 'recursos/navbar.php';
  ?>
  <div class="container mt-3 text-center">
    <h3 class="text-center mt-3">Formulario alta nuevo departamento</h3>
  </div>
  <div class="container mt-3">
    <?php
      require 'recursos/mensajes.php';
    ?>
  </div>
  <div class="container mt-3 w-25">
  <a href="indicedepartamentos.php" class="btn btn-dark my-2" style="margin-left: 30%; margin-right: 30%;">Volver a índice</a>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <label class="mt-2">Nombre departamento</label>
      <input type="text" class="form-control" name="nom_dep">
      <div style="float: right;">
      <input type="submit" name="crear" class="btn btn-success mt-2" value="Crear departamento">
      <input type="reset" value="Limpiar" class="btn btn-danger mt-2">
      </div>
    </form>
  </div>
</body>
</html>
<?php
  }
?>