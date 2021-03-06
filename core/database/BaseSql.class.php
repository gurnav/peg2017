<?php

  namespace Core\Database;

  use \PDO;
  use Core\Util\Helpers;
  use Core\Database\QueryBuilder;

  /**
   * Class that is the base of all our models
   * Allow CRUD operation on models
   */
  class BaseSql
  {

    protected $db; // The PDO connection to the database

    /**
     * The constructor of the BaseSQL class
     * Connect to the database
     * @return Void
     */
    public function __construct()
    {
        try {
            $this->setDb();
        } catch (\Exception $e) {
            die("FATAL ERROR : ".$e->getMessage());
        }
    }

    /**
     * Set the connection of the database with the given properties
     * properties are defined by constant
     * which are DB_DRIVER, DB_HOST, DB_PORT, DB_NAME,
     * DB_USER, DB_PWD
     * @return void
     */
    private function setDb()
    {
        $this->db = new PDO(DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PWD);
        if (DEBUG_MODE === true) $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->exec("SET NAMES 'utf8';");
    }

    /**
     * Simple Database Getter
     * @return PDO Object representing the database connection
     */
    protected function getDb()
    {
        return $this->db;
    }

  }
