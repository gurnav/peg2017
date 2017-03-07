<?php

  /**
   * Class that is the base of all our models
   * Allow CRUD operation on models
   */

  namespace Core\Database;
  use \PDO;

  class BaseSql {

    private $db; // The database which we are connected
    private $table; // The table selected
    private $columns = []; // The colomns tht belongs to the table


    /**
     * The constructor of the BaseSQL class
     * Connect to the database and setup the table the columns
     */
    public function __construct() {
      try {
        $this->setDb();
      } catch (Exception $e) {
        die("Erreur SQL : ".$e->getMessage());
      }
      $this->setTable();
      $this->setColumns();
    }

    /**
     * Insert or Update a model in Database
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

    /**
     * Load an empty object with 1 or multiple elements in the array
     * that exist in the database
     * Manage the duplicate with an raised error.
     * @param $array : Array  which represent the data that we will load from the database
     * @return Object Which reprensent the loaded model from the database
     */
    public function populate($array) {
      $class = get_class($this);
      $class = str_replace(__NAMESPACE__ . '\\', '', $class);
      $class = str_replace('\\', '/', $class);

      if(file_exists(__DIR__ . '/' . $class . '.class.php')) {
        foreach( $array as $item => $value ) {
          $subQuery .= " WHERE ".$item."=".$value." AND";
        }
        // Delete the last " AND"
        $subQuery = substr($subQuery, 0, -4);
        $query = $this->getDb()->prepare( "SELECT * FROM ".DB_PREFIX.lcfirst($class)
          .$subQuery );
        try {
          $query->execute();
          $rowCount = $query->rowCount();
          if( $rowCount === 1 ) {
            $result = $query->fetch(PDO::FETCH_CLASS, $class);
          } elseif( $rowCount === 0 ) {
            // if the object doesn't exist int the database
            $result = $this->self;
          } else {
            // Manages duplicatas
            Helpers::log("Il existe : ".$rowCount." lignes dans la bases,
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


    /**
     * Delete an entry from the databse that corresponf to the loaded model
     * @param id : Int the id of our data
     */
    public function delete() {
      if ($this->id !== -1) {
        try {
          $this->getDb()->prepare( "DELETE FROM ". DB_PREFIX."_".lcfirst(get_class($this))." WHERE id="."$this->id".';');
        } catch(Exception $e) {
          Helpers::log($e);
          die($e);
        }
      } else {
        Helpers::log("Impossible de l'item ce dernier n'etant pas inscrit dans la base.");
        die("Impossible to delete the item");
      }

    }

    /**
     * Set the connection of the database with the given properties
     * properties are defined by constant
     * which are DB_DRIVER, DB_HOST, DB_PORT, DB_NAME,
     * DB_USER, DB_PWD
     */
    protected function setDb() {
      $this->db = new PDO( DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PWD );
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Simple Database Getter
     */
    protected function getDb() {
      return $this->db;
    }

    /**
     * Simple Table Getter
     */
    protected function getTable() {
      return $this->table;
    }

    /**
     * Dynamically set the Table name from the model name
     */
    protected function setTable() {
      $arrayName = explode("\\", get_class($this));
      $this->table = DB_PREFIX.strtolower(end($arrayName));
    }

    /**
     * Simple Columns Getter
     */
    protected function getColumns() {
      return $this->columns;
    }

    /**
     * Dynamically set the columns name from the model name
     */
    protected function setColumns() {
      // Récupérer le nom des colonnes de la table dynamiquement
      $this->columns = array_diff_key(get_class_vars(get_class($this)),
        get_class_vars(get_parent_class($this)));
    }

    /**
     * Unset a column name
     */
    private function unsetColumn($column) {
      unset($this->columns[$column]);
    }

  }
