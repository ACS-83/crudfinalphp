<?php
  session_start();
  if(!isset($_GET['id'])) {
    header("Location: indicedepartamentos.php");
    die();
  }
  require '../vendor/autoload.php';
  use Clases\Departamentos;
  $departamento=new Departamentos();
  $departamento->setId($_GET['id']);
  $departamento->delete();
  $departamento=null;
  $_SESSION['mensaje'] = "Departamento borrado correctamente";
  header("Location:indicedepartamentos.php");