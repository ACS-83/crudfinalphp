<?php
namespace Clases;
use Clases\Conexion;
use PDO;
class Departamentos extends Conexion {
  private $id;
  private $nom_dep;

  public function __construct() {
    parent::__construct();
  }
  //-------------CRUD--------------
  public function create(){
    //Insertamos datos en profesores con parámetros
    $i="insert into departamentos(nom_dep) values(:nd)";
    $stmt=parent::$conexion->prepare($i);
    try {
        $stmt->execute([
          //Paso los parámetros
          ':nd'=>$this->nom_dep,
        ]);
    } catch (PDOException $ex) {
        die("Error al insertar un departamentos: ".$ex->getMessage());
    }
  }
  //Leer
  public function read() {
    $c="select * from departamentos where id=:i";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
          ':i'=>$this->id
        ]);
    } catch (PDOException $ex) {
        die("Error al devolver un departamento:".$ex->getMessage());
    }
    $fila=$stmt->fetch(PDO::FETCH_OBJ);
    // Hago que devuelva la fila
    return $fila;
  }
  //Actualizar
  public function update() {
    //Seteo nombre y resto de columnas
    $u="update departamentos set nom_dep=:nd where id=:i";
    $stmt=parent::$conexion->prepare($u);
    try {
        $stmt->execute([
          ':i'=>$this->id,
          ':nd'=>$this->nom_dep,
        ]);
    } catch (PDOException $ex) {
        die("Error al editar departamento:".$ex->getMessage());
    }
  }
  // Borrar
  public function delete() {
    $c="delete from departamentos where id=:i";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
          ':i'=>$this->id
        ]);
    } catch (PDOException $ex) {
        die("Error al borrar un departamento:".$ex->getMessage());
    }
  }
  // El que usaré para que se vea todo al abrir desde el índice
  public function devolverTodos() {
    $c = "select * from departamentos";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die("Error al devolver todos los departamentos".$ex->getMessage());
    }
    return $stmt;
  }
  
  public function borrarTodo() {
    $c="delete from departamentos";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die("Error al borrar todos los departamentos:".$ex->getMessage());
    }
  }

  // Método para ver si un profesor existe
  public function existeDepartamento($nom_dep) {
    $c="select * from departamentos where nom_dep=:nd";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
            ':nd'=>$nom_dep
        ]);
    } catch (PDOException $ex) {
        die("Error al comprobar existencia departamento:".$ex->getMessage());
    }
    $fila=$stmt->fetch(PDO::FETCH_OBJ);
    return ($fila==null) ? false : true;
  }
  // Getters y setters hechos a raíz de la extensión de VS Code
  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of nom_dep
   */ 
  public function getNom_dep()
  {
    return $this->nom_dep;
  }

  /**
   * Set the value of nom_dep
   *
   * @return  self
   */ 
  public function setNom_dep($nom_dep)
  {
    $this->nom_dep = $nom_dep;

    return $this;
  }
}