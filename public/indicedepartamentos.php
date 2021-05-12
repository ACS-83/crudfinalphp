<?php
  session_start();
  require '../vendor/autoload.php';
  use Clases\Departamentos;
  $departamentos = new Departamentos();
  $misdepartamentos = $departamentos->devolverTodos();
  $departamentos=null;
?>

<?php
  require 'recursos/head.php';
  head('Índice departamentos');
?>

<body>
  <?php
      require 'recursos/navbar.php';
  ?>
  <div class="container mt-3 text-center">
    <a href='creardepartamento.php' class='btn btn-primary my-3'>Nuevo departamento</a>
    <?php
      require 'recursos/mensajes.php';
  ?>
    <h3 class="text-center mt-3">Listado de departamentos</h3>
  </div>
<table class="table table-secondary w-75 mx-auto table-striped text-center">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nombre departamento</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($fila=$misdepartamentos->fetch(PDO::FETCH_OBJ)) {
            echo "<tr>";
            echo "<th scope='row'>{$fila->id}</th>";
            echo "<td>{$fila->nom_dep}</td>";
            echo "<td>";
            echo "<a href='editardepartamento.php?id={$fila->id}' class='btn btn-warning'>Editar</a>&nbsp;\n";
            echo "<a dep='{$fila->id}' class='btn btn-danger eliminar'>Eliminar</a>&nbsp;\n";
            echo "</td>\n";
            echo "</tr>\n";
          }
        ?>
      </tbody>
    </table>

<script>
  let eliminarBtns = document.querySelectorAll('.eliminar');
  eliminarBtns.forEach( btn => {
    btn.addEventListener('click', function (event) {
      let id = event.target.getAttribute('dep');
      let deleteDep = confirm("Se van a borrar los profesores que pertenecen a este departamento. ¿Está seguro?");
      if (deleteDep) {
        location.href='borrardepartamento.php?id='+id;
      }
      //href='borrardepartamento.php?id={$fila->id}'
    })
  })
</script>
</body>
</html>