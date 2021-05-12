<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\Profesores;
  use Clases\Departamentos;
  $profesores = new Profesores();
  $misprofesores = $profesores->devolverTodos();
  $esteDepartamento = new Departamentos();

  // $misdepartamentos = $departamentos->devolverTodos();
?>

<?php
  require 'recursos/head.php';
  head('Índice profesores');
?>

<body>

  <?php
      require 'recursos/navbar.php';
  ?>
  <div class="container mt-3 text-center">
    <a href='crearProfesor.php' class='btn btn-primary my-3'>Nuevo profesor</a>
    <?php
      require 'recursos/mensajes.php';
    ?>
    <h3 class="text-center mt-3">Listado de profesores</h3>
  </div>


<table class="table table-secondary w-75 mx-auto table-striped text-center">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Sueldo</th>
          <th scope="col">Fecha incorporación</th>
          <th scope="col">Departamento</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($fila=$misprofesores->fetch(PDO::FETCH_OBJ)) {
            echo "<tr>";
            echo "<th scope='row'>{$fila->id}</th>";
            echo "<td>{$fila->nom_prof}</td>";
            echo "<td>{$fila->sueldo}</td>";
            echo "<td>{$fila->fecha_prof}</td>";
            $esteDepartamento->setId($fila->dep);
            $dbDepartamento = $esteDepartamento->read();
            echo "<td>{$dbDepartamento->nom_dep}</a></td>";
            echo "<td>";
            echo "<a href='editarprofesor.php?id={$fila->id}' class='btn btn-warning'>Editar</a>&nbsp;\n";
            echo "<a href='borrarprofesor.php?id={$fila->id}' class='btn btn-danger'>Eliminar</a>&nbsp;\n";
            echo "</td>\n";
            echo "</tr>\n";
          }
        ?>
      </tbody>
    </table>



</body>
</html>