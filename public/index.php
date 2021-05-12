<?php
    require 'recursos/head.php';
    head('Inicio');
?>

<style>
    .container {
        display: flex;
        justify-content: center;
        height: 90vh;
    }
    body {
        background-color: whitesmoke;
    }
    .vertical-center {
      margin: 0;
      position: absolute;
      top: 40%;
    }
    </style>
<body>
<?php
    require 'recursos/navbar.php';
?>

    <div class="container">
  <div class="vertical-center">
        <a href="indiceprofesores.php" class="btn btn-dark my-2">Profesores</a>
        <a href="indicedepartamentos.php" class="btn btn-dark my-2">Departamentos</a>
  </div>
</div>

</body>
</html>