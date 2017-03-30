<?php

  namespace Core\Database;

  use Core\Database\BaseSql;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;

  class Model extends BaseSql
  {

    private $table; // The table selected
    private $columns = []; // The colomns that belongs to the table


    /**
     * The constructor of the Model class
     * Connect to the database and setup the table the columns
     * @return Void
     */
    public function __construct()
    {
      parent::__construct();
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
      } catch (Exception $e) {
        Helpers::log($e->getMessage());
        die("An error occured, please contact the site's admnistrator.");
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
        $qb = new QueryBuilder();
        $preparedTab = [];
        $class = Helpers::relativeClassPath($this);

        if (file_exists(ROOT . $class . '.class.php'))
        {
          $request = $qb->select('*')->from($this->getTable());
            foreach ($array as $item => $value) {
                $preparedItem = ':'.$item;
                $request->where($item.'='.$preparedItem);
                $preparedTab[$preparedItem] = $value;
            }
            $result = $qb->prepare($request, $preparedTab, get_class($this), $one);
        } else {
            Helpers::log("The Object at ". ROOT . DS . $class . ".class.php doesn't exist.");
            die("An error occured, please contact the site's admnistrator.");
        }
        return $result;
    }


    /**
     * Delete an entry from the databse that corresponf to the loaded model
     * @param id : Int the id of our data
     * @return void
     */
    public function delete()
    {
      $qb = new QueryBuilder();

        if ($this->getId() !== -1)
        {
          $query = $qb->delete('*')->from($this->getTable())->where('id='.$this->getId());
          $qb->query($query, get_class($this), true);
        } else {
            Helpers::log("Impossible to delete the item => ".get_class($this).".");
            die("Impossible to delete the item");
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
        $this->columns = array_diff_key(get_class_vars(get_class($this)),
        get_class_vars(get_parent_class($this)));
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
