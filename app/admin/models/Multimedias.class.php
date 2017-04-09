<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Helpers\Traits\Models\UsersIdTrait;
  use App\Helpers\Traits\Models\IdTrait;
  use App\Helpers\Traits\Models\GetAllDataTrait;

  class Multimedias extends Model
  {

    use UsersIdTrait;
    use IdTrait;
    use GetAllDataTrait;

    protected $id;
    protected $path;
    protected $name;
    protected $users_id;

    /**
     * Constructor of the Multimedias model class
     * @return Void
     */
    public function __construct($id=-1, $path=null, $name=null, $users_id=-1)
    {
        parent::__construct();

        $this->setId($id);
        $this->setPath($path);
        $this->setName($name);
        $this->setUsers_id($users_id);
    }


    /**
     * Simple setter for the Path
     * Check if the path respect the integrity of the database
     * So if that a string and lesser than 255
     * @param String : $path The Path to be set
     * @return Void
     */
    public function setPath($path)
    {
        if(gettype($path) === 'string')
        {
        if(strlen($path) <= 255 )
        {
        $this->path = trim($path);
        } else {
            Helpers::log("A word count superior to 255 has tried to be created in a new path");
            die("You can't enter a path with a words count superior to 255");
        }
        } else {
            Helpers::log("A non string type has been entered as path in path n° : " . $this->getId());
            die("You can't enter a non strong type as a path !");
        }
    }

    /**
     * Simple path getter
     * @return String $path The Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Simple setter for the Name
     * Check if the name respect the integrity of the database
     * So if that a string and lesser than 128
     * @param String : $name The Name to be set
     * @return Void
     */
    public function setName($name)
    {
        if(gettype($name) === 'string')
        {
            if(strlen($name) <= 128)
            {
                $this->name = trim($name);
            } else {
                Helpers::log("A string bigger than 128 char for the name in ". get_class($this)
                    ." have been tried to inserted in the database");
                die("Too big Name !");
            }
        } else {
            Helpers::log("A not string variable for the name in ". get_class($this)
                ." have been tried to inserted in the database");
            die("Not well formed Name ! It should be inferior than 128 characters");
        }
    }

    /**
     * Simple name getter
     * @return String $name The Name
     */
    public function getName()
    {
        return $this->name;
    }

  }
