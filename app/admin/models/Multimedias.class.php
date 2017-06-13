<?php

  namespace App\Admin\Models;

  use Core\Database\Model;
  use Core\Database\QueryBuilder;
  use Core\Util\Helpers;
  use App\Composite\Traits\Models\UsersIdTrait;
  use App\Composite\Traits\Models\IdTrait;
  use App\Composite\Traits\Models\GetAllDataTrait;

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
    public function __construct($id=-1, $file=null, $name="default", $users_id=-1)
    {
        parent::__construct();

        $this->setId($id);
        $this->setPath($file);
        $this->setName($name);
        $this->setUsers_id($users_id);
    }


    /**
     * Simple setter for the Path
     * Check if the path respect the integrity of the database
     * So if that a string and lesser than 255
     * @param FILE : $file The file to be uploaded
     * @return Void
     */
    public function setPath($file)
    {
        $path = "";
        if ($file !== null) {
            $path = Helpers::safeUploadFile($file, UPLOADS_DIR_CONTENTS);
        }
        $this->path = $path;
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
        if(is_string($name))
        {
            if(strlen($name) <= 128)
            {
                if (ctype_alnum($name)) {
                    $this->name = trim($name);
                } else {
                    Helpers::log("Only alphanumeric character fot the password ". get_class($this)
                      ." have been tried to inserted in the database");
                    throw new \Exception("Not well formed filename ! Only alphanumeric character allowed");
                }
            } else {
                Helpers::log("A string bigger than 128 char for the name in ". get_class($this)
                    ." have been tried to inserted in the database");
                throw new \Exception("Too big Name !");
            }
        } else {
            Helpers::log("A not string variable for the name in ". get_class($this)
                ." have been tried to inserted in the database");
            throw new \Exception("Not well formed Name ! It should be inferior than 128 characters");
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
