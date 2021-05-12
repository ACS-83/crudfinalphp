<?php
namespace Clases;
use Clases\Conexion;
use PDO;
class Profesores extends Conexion {
  private $id;
  private $nom_prof;
  private $sueldo;
  private $fecha_prof;
  private $dep;
  public function __construct() {
    parent::__construct();
  }
  //-------------CRUD--------------
  public function create(){
    //Insertamos datos en profesores con parámetros
    $i="insert into profesores(nom_prof, sueldo, fecha_prof, dep) values(:np, :s, :fp, :d)";
    $stmt=parent::$conexion->prepare($i);
    try {
        $stmt->execute([
          //Paso los parámetros
          ':np'=>$this->nom_prof,
          ':s'=>$this->sueldo,
          ':fp'=>$this->fecha_prof,
          ':d'=>$this->dep
        ]);
    } catch (PDOException $ex) {
        die("Error al insertar un articulo: ".$ex->getMessage());
    }
  }
  //Leer
  public function read() {
    $c="select * from profesores where id=:i";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
          ':i'=>$this->id
        ]);
    } catch (PDOException $ex) {
        die("Error al devolver un profesor:".$ex->getMessage());
    }
    $fila=$stmt->fetch(PDO::FETCH_OBJ);
    // Hago que devuelva la fila
    return $fila;
  }
  //Actualizar
  public function update() {
    //Seteo nombre y resto de columnas
    $u="update profesores set nom_prof=:np, sueldo=:s, fecha_prof=:fp, dep=:d where id=:i";
    $stmt=parent::$conexion->prepare($u);
    try {
        $stmt->execute([
          ':i'=>$this->id,
          ':np'=>$this->nom_prof,
          ':s'=>$this->sueldo,
          ':fp'=>$this->fecha_prof,
          ':d'=>$this->dep
        ]);
    } catch (PDOException $ex) {
        die("Error al editar profesor:".$ex->getMessage());
    }
  }
  // Borrar
  public function delete() {
    $c="delete from profesores where id=:i";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
          ':i'=>$this->id
        ]);
    } catch (PDOException $ex) {
        die("Error al borrar un profesor:".$ex->getMessage());
    }
  }
  // El que usaré para que se vea todo al abrir desde el índice
  public function devolverTodos() {
    $c = "select * from profesores";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die("Error al devolver todos los profesores".$ex->getMessage());
    }
    return $stmt;
  }

  public function borrarTodo() {
    $c="delete from profesores";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute();
    } catch (PDOException $ex) {
        die("Error al borrar todos los profesores:".$ex->getMessage());
    }
  }

  // Método para ver si un profesor existe
  public function existeProfesor($nom_prof) {
    $c="select * from profesores where nom_prof=:n";
    $stmt=parent::$conexion->prepare($c);
    try {
        $stmt->execute([
            ':n'=>$nom_prof
        ]);
    } catch (PDOException $ex) {
        die("Error al comprobar existencia profesor:".$ex->getMessage());
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
   * Get the value of nom_prof
   */ 
  public function getNom_prof()
  {
    return $this->nom_prof;
  }

  /**
   * Set the value of nom_prof
   *
   * @return  self
   */ 
  public function setNom_prof($nom_prof)
  {
    $this->nom_prof = $nom_prof;

    return $this;
  }

  /**
   * Get the value of sueldo
   */ 
  public function getSueldo()
  {
    return $this->sueldo;
  }

  /**
   * Set the value of sueldo
   *
   * @return  self
   */ 
  public function setSueldo($sueldo)
  {
    $this->sueldo = $sueldo;

    return $this;
  }

  /**
   * Get the value of fecha_prof
   */ 
  public function getFecha_prof()
  {
    return $this->fecha_prof;
  }

  /**
   * Set the value of fecha_prof
   *
   * @return  self
   */ 
  public function setFecha_prof($fecha_prof)
  {
    $this->fecha_prof = $fecha_prof;

    return $this;
  }

  /**
   * Get the value of dep
   */ 
  public function getDep()
  {
    return $this->dep;
  }

  /**
   * Set the value of dep
   *
   * @return  self
   */ 
  public function setDep($dep)
  {
    $this->dep = $dep;

    return $this;
  }
}