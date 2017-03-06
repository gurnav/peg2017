<?php

  namespace Core\Database;
  use \PDO;

  class BaseSql {

    private $db;
    private $table;
    private $columns = [];

    public function __construct() {
      try {
        $this->setDb();
      } catch( Exception $e ) {
        die("Erreur SQL : ".$e->getMessage());
      }

      $this->setTable();
      $this->setColumns();
    }

    /**
     * Insert or Update in Database
     */
    public function save() {
      if($this->getId() === -1) {
        $sqlCol = null;
        $sqlKey = null;
        $this->unsetColumn('id');
        foreach ($this->getColumns() as $column => $value) {
          $data[$column] = $this->$column;
          $sqlCol .= ','.$column;
          $sqlKey .= ',:'.$column;
        }
        $query = $this->getDb()->prepare( 'INSERT INTO '. $this->getTable(). '('.
        trim($sqlCol, ','). ') VALUES ( '. trim($sqlKey, ',') . ');');
        $query->execute($data);
      } else {
        $sqlCol = null;
        foreach ($this->getColumns() as $column => $value) {
          $data[$column] = $this->$column;
          $sqlCol[] .= $column.':='.$column;
        }
        $query = $this->getDb()->prepare( 'UPDATE '. $this->getTable(). ' SET ('.
        implode(',', $sqlCol). ') WHERE ( id=:id );');
        $query->execute($data);
      }
    }

    public function populate($array) {
      // Charge un objet vide a partir d'un élément du tableau
      // Penser au Duplicata dans la BDD
      $class = get_class($this);
      $class = str_replace(__NAMESPACE__ . '\\', '', $class);
      $class = str_replace('\\', '/', $class);

      if(file_exists(__DIR__ . '/' . $class . '.class.php')) {
        foreach( $array as $item => $value ) {
          $subQuery .= " WHERE ".$item."=".$value." AND";
        }
        $subQuery = substr($subQuery, 0, -4);
        $query = $this->getDb()->prepare( "SELECT * FROM ".DB_PREFIX.lcfirst($class)
          .$subQuery );
        try {
          $query->execute();
          $rowCount = $query->rowCount();
          if( $rowCount === 1 ) {
            $result = $query->fectchObject($class);
          } elseif( $rowCount === 0 ) {
            // Si l'objet n'existe pas dans la base
            $result = $this;
          } else {
            // Gestion des duplicatas
            Helpers::log("Il existe : ".$rowCount." ligness dans la bases,
              impossible de charger l'objet du aux duplicatas.");
            die("Une erreur est survenue veuillez contacter l'administrateur du site.");
          }
        } catch(Exception $e) {
          Helpers::log($e->getMessage());
          die("Une erreur est survenue veuillez contacter l'administrateur du site.");
        }
      } else {
        Helpers::log("L'objet demandé ". __DIR__ . '/' . $class . ".class.php n'existe pas.");
        die("Une erreur est survenue veuillez contacter l'administrateur du site.");
      }
      return $result;
    }

    public function delete() {
      if ($this->id !== -1) {
        try {
          $this->getDb()->prepare( "DELETE FROM ". DB_PREFIX."_".get_class($this) ." WHERE id="."$this->id"."; ");
        } catch(Exception $e) {
          Helpers::log($e);
          die($e);
        }
      } else {
        Helpers::log("Impossible de l'item ce dernier n'etant pas inscrit dans la base.");
        die("Impossible to delete the item");
      }

    }

    protected function setDb() {
      $this->db = new PDO( DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PWD );
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function getDb() {
      return $this->db;
    }

    protected function getTable() {
      return $this->table;
    }

    protected function setTable() {
      // Récupérer le nom de la table dynamiquement
      $arrayName = explode("\\", get_class($this));
      $this->table = DB_PREFIX.strtolower(end($arrayName));
    }

    protected function getColumns() {
      return $this->columns;
    }

    protected function setColumns() {
      // Récupérer le nom des colonnes de la table dynamiquement
      $this->columns = array_diff_key(get_class_vars(get_class($this)),
        get_class_vars(get_parent_class($this)));
    }

    protected function unsetColumn($column) {
      unset($this->columns[$column]);
    }

  }
