<?php
  session_start();
  if(!isset($_GET['id'])) {
    header("Location: indiceprofesores.php");
    die();
  }
  require '../vendor/autoload.php';
  use Clases\Profesores;
  $profesor=new Profesores();
  $profesor->setId($_GET['id']);
  $profesor->delete();
  $profesor=null;
  $_SESSION['mensaje'] = "Profesor borrado correctamente";
  header("Location:indiceprofesores.php");