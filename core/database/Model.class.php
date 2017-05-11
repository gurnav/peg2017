<?php

  namespace Core\Database;

  use Core\Database\BaseSql;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;

  class Model extends BaseSql
  {

    private $table; // The table selected
    private $columns = []; // The colomns that belongs to the table
    protected $qb; // An instance of a QueryBuilder object, needed for Injection of dependencies reasons

    /**
     * The constructor of the Model class
     * Connect to the database and setup the table the columns
     * @return Void
     */
    public function __construct(QueryBuilder $qb = null)
    {
      parent::__construct();

      if($qb === null) {
        $this->qb = new QueryBuilder();
      } else {
        $this->qb = $qb;
      }

      $this->setTable();
      $this->setColumns();
    }

    /**
     * Insert or Update a model in Database
     * TODO REFACTOR
     * @return Void
     */
    public function save()
    {
      try {
        // If not in Database save it
        if ($this->getId() === -1) {
            $sqlCol = null;
            $sqlKey = null;
            $this->unsetColumn('id');
            foreach ($this->getColumns() as $column => $value) {
                $data[$column] = $this->$column;
                $sqlCol .= ','.$column;
                $sqlKey .= ',:'.$column;
            }
            $query = $this->getDb()->prepare('INSERT INTO '. $this->getTable(). '('.
              trim($sqlCol, ','). ') VALUES ( '. trim($sqlKey, ',') . ');');
            $query->execute($data);
        } else {
          // If in the database Update it
            $sqlCol = null;
            foreach ($this->getColumns() as $column => $value) {
              $data[$column] = $this->$column;
              $sqlCol[] .= $column.':='.$column;
            }
            $query = $this->getDb()->prepare('UPDATE '. $this->getTable(). ' SET ('.
              implode(',', $sqlCol). ') WHERE ( id=:id );');
            $query->execute($data);
        }
      } catch (\Exception $e) {
        Helpers::log($e->getMessage());
        throw new \Exception("An error occured, please contact the site's admnistrator.");
      }
    }

    /**
     * Load an empty object with 1 or multiple elements in the array
     * that exist in the database
     * Manage the duplicate with an raised error.
     * @param $array : Array  which represent the data that we will load from the database
     * @param Boolean : $one If we want to retrieve one or multiple Object fron the database
     * @return Object Which reprensent the loaded model from the database
     */
    public function populate($array, $one = true)
    {
        $preparedTab = [];
        $class = Helpers::relativeClassPath($this);

        if (file_exists(ROOT . $class . '.class.php'))
        {
          $request = $this->qb->select('*')->from($this->getTable());
            foreach ($array as $item => $value) {
                $preparedItem = ':'.$item;
                $request->where($item.'='.$preparedItem);
                $preparedTab[$preparedItem] = $value;
            }
            $result = $this->qb->prepare($request, $preparedTab, get_class($this), $one);
        } else {
            Helpers::log("The Object at ". ROOT . DS . $class . ".class.php doesn't exist.");
            throw new \Exception("An error occured, please contact the site's admnistrator.");
        }
        return $result;
    }


    /**
     * Delete an entry from the database that corresponf to the loaded model
     * @param id : Int the id of our data
     * @return void
     */
    public function delete()
    {
        if ($this->getId() !== -1)
        {
          $query = $this->qb->delete()->from($this->getTable())->where('id='.$this->getId());
          $this->qb->query($query, get_class($this), true);
        } else {
            Helpers::log("Impossible to delete the item => ".get_class($this).".");
            throw new \Exception("Impossible to delete the item");
        }
    }

    /**
     * Simple Table Getter
     * @return table_name : String The table selected in the connection
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Dynamically set the Table name from the model name
     * @return void
     */
    private function setTable()
    {
        $arrayName = explode("\\", get_class($this));
        $this->table = DB_PREFIX.strtolower(end($arrayName));
    }

    /**
     * Simple Columns Getter
     * @return columns : Array The list of all column in the chosen table
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Dynamically set the columns name from the model name
     * @return void
     */
    private function setColumns()
    {
         $this->columns = get_class_vars(get_class($this));
         $this->unsetColumn('table');
         $this->unsetColumn('columns');
         $this->unsetColumn('qb');
         $this->unsetColumn('db');
         // $this->columns = array_keys($this->columns);
    }

    /**
     * Unset a column name
     * @return void
     */
    private function unsetColumn($column)
    {
        unset($this->columns[$column]);
    }

  }
