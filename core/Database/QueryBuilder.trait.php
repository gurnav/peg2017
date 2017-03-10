<?php

  namespace Core\Database;

  /**
   * Traits for building Query
   */
  trait QueryBuilder
  {

    private $fields = [];
    private $conditions = [];
    private $from = [];


    public function select()
    {
      $this->fields = func_get_args();
      return $this;
    }


    public function where()
    {
      foreach(func_get_args() as $arg) {
        $this->conditions[] = $arg;
      }
      return $this;
    }

    public function from ($table, $alias = null)
    {
      if(is_null($alias)) {
        $this->from[] = $table;
      } else {
        $this->from[] = "$table AS $alias";
      }
      return $this;
    }

    /**
     * Easier Query method who can fetch one or multiple models of the same class
     * @param $statement : String The Query to execute
     * @param $class_name : Class The class name of the model to be retrieve
     * @param $one : Boolean which allow one or multiple retievement
     * @return Object : Model The Object which represent the data
     */
    public function query ($statement, $class_name = null, $one = false)
    {
        $req = $this->getDb()->query($statement);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $req;
        }
        if ($class_name === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one === true) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    /**
     * Easier Query method who can fetch one or multiple models of the same class
     * @param $statement : String The Query to execute
     * @param $attributes : ???
     * @param $class_name : String The class name of the model to be retrieve
     * @param $one : Boolean which allow one or multiple retievement
     * @return Object : Model The Object which represent the data
     */
    public function prepare ($statement, $attributes, $class_name = null, $one = false)
    {
        $req = $this->getDb()->prepare($statement);
        $res = $req->execute($attributes);
        if(
            strpos($statement, 'UPDATE') === 0 ||
            strpos($statement, 'INSERT') === 0 ||
            strpos($statement, 'DELETE') === 0
        ) {
            return $res;
        }
        if($class_name === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

    public function __toString()
    {
      return 'SELECT '. implode(', ', $this->fields)
        . ' FROM ' . implode(', ', $this->from)
        . ' WHERE ' . implode(' AND ', $this->conditions);
    }

  }
