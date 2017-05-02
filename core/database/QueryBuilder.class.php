<?php

  namespace Core\Database;

  use \PDO;
  use Core\Database\BaseSql;
  use Core\Util\Helpers;

  /**
   * Class for building Query
   * With a fluent Pattern
   */
  class QueryBuilder extends BaseSql
  {
      private $mode; // selection or delete or update mode
      private $fields = []; // The selected fields
      private $conditions = []; // The conditions of the Query
      private $order = []; // The orderBy conditions of the Query
      private $from = []; // The Table called with is optionnal alias


      /**
       * Constructor of the QueryBuilder
       * Setup the connetion of the database
       * @return Void
       */
      public function __construct()
      {
        parent::__construct();
        $this->setMode('select');
      }


      /**
       * Setup the fields to be selected
       * @param Multiple String which refer to the fileds selected in the database
       * @return Object QueryBuilder
       */
      public function select()
      {
          $this->fields = func_get_args();
          $this->setMode('select');
          return $this;
      }

      /**
       * Setup the fields to be deleted
       * @param Multiple String which refer to the fileds selected in the database
       * @return Object QueryBuilder
       */
      public function delete()
      {
          $this->fields = func_get_args();
          $this->setMode('delete');
          return $this;
      }

      /**
       * Setup the fields to be updated
       * @param Multiple String which refer to the fileds selected in the database
       * @return Object QueryBuilder
       */
      public function update()
      {
          $this->fields = func_get_args();
          $this->setMode('update');
          return $this;
      }


      /**
       * Setup the conditions of the fields to be selected
       * @param Array : String which refer to the condition(s) to execute
       * @return Object QueryBuilder
       */
      public function where()
      {
          foreach (func_get_args() as $arg) {
              $this->conditions[] = $arg;
          }
          return $this;
      }

      /**
       * Setup the conditions of the fields to be ordered
       * @param Array : String which refer to the condition(s) to execute
       * @return Object QueryBuilder
       */
      public function orderBy()
      {
          foreach (func_get_args() as $arg) {
              $this->order[] = $arg;
          }
          return $this;
      }


      /**
       * Setup the table to be selected and his optional alias
       * @param $table : String The table selected
       * @param $alias : String The optional alias of the table
       * @return Object QueryBuilder
       */
      public function from($table, $alias = null)
      {
          if (is_null($alias)) {
              $this->from[] = $table;
          } else {
              $this->from[] = "$table AS $alias";
          }
          return $this;
      }


      /**
       * Easier Query method who can fetch one or multiple models of the same class
       * @param $statement : String The Query to execute
       * @param $class_name : Class The fully qualified class name of the model to be retrieve
       * @param $one : Boolean which allow one or multiple retievement
       * @return Object : Model The Object which represent the data
       */
      public function query($statement, $class_name = null, $one = false)
      {
        try {
          $req = $this->db->query($statement);
          if (
              strpos($statement, 'UPDATE') === 0 ||
              strpos($statement, 'INSERT') === 0 ||
              strpos($statement, 'DELETE') === 0
          ) {
              return $req;
          }
          if ($class_name === null) {
              $req->setFetchMode(PDO::FETCH_OBJ);
          } else {
              $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $class_name);
          }
          if ($one === true) {
            /*if ($req->rowCount() > 1) {
              Helpers::log('There is more than one result for the request : '.$statement);
              throw new \Exception("An error occured !");
            }*/
              $datas = $req->fetch();
          } else {
              $datas = $req->fetchAll(PDO::FETCH_ASSOC);
          }
          return $datas;
        } catch (\Exception $e) {
          Helpers::log($e->getMessage());
          die("An error occured, please contact the site's admnistrator.");
        }
      }

      /**
       * Easier prepare method who can insert one or multiple models of the same class
       * @param $statement : String The Query to execute
       * @param $attributes : Array The attributes to be save or updated
       * @param $class_name : String The fully qualified class name of the model to be retrieve
       * @param $one : Boolean which allow one or multiple retievement
       * @return Object : Model The Object which represent the data
       */
      public function prepare($statement, $attributes, $class_name = null, $one = false)
      {
        try {
          $req = $this->db->prepare($statement);
          $res = $req->execute($attributes);
          if (
              strpos($statement, 'UPDATE') === 0 ||
              strpos($statement, 'INSERT') === 0 ||
              strpos($statement, 'DELETE') === 0
          ) {
              return $res;
          }
          if ($class_name === null) {
              $req->setFetchMode(PDO::FETCH_OBJ);
          } else {
              $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $class_name);
          }
          if ($one) {
            /*if ($req->rowCount() > 1) {
              Helpers::log('There is more than one result for the request : '.$statement);
              throw new \Exception("An error occured !");
            }*/
              $datas = $req->fetch();
          } else {
              $datas = $req->fetchAll();
          }
          return $datas;
        } catch (\Exception $e) {
          Helpers::log($e->getMessage());
          die("An error occured, please contact the site's admnistrator.");
        }
      }


      /**
       * Set the mode of the query
       * @param $mode : String The called mode (Insert or Delete)
       * @return Void
       */
      private function setMode($mode)
      {
          $this->mode = strtoupper($mode);
      }

      /**
       * Get the mode of the query
       * @return $mode : String The mode of the Query
       */
      private function getMode()
      {
          return $this->mode;
      }

    /**
     * Convert our Query as a String
     * depending of the method called
     * @return $query : String The created query as a String
     */
    public function __toString()
    {
        $query = "";
        if(!empty($this->fields) && $this->getMode() === 'SELECT') {
          $query .= 'SELECT '. implode(', ', $this->fields);
          unset($this->fields);
        }
        else if(!empty($this->fields) && $this->getMode() === 'UPDATE')
        {
          $query .= 'UPDATE '. implode(', ', $this->fields);
          unset($this->fields);
        }
        else if(!empty($this->fields) && $this->getMode() === 'DELETE')
        {
          $query .= 'DELETE '. implode(', ', $this->fields);
          unset($this->fields);
        }
        if(!empty($this->from)) {
          $query .= ' FROM ' . implode(', ', $this->from);
          unset($this->from);
        }
        if(!empty($this->conditions)) {
          $query .= ' WHERE ' . implode(' AND ', $this->conditions);
          unset($this->conditions);
        }
        if(!empty($this->order)) {
          $query .= ' ORDER BY ' . implode(' , ', $this->order);
          unset($this->order);
        }
        return $query;
    }
  }
