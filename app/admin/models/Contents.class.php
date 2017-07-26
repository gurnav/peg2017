<?php
namespace App\Admin\Models;
use App\Composite\Models\Content;
use App\Composite\Traits\Models\GetAllDataTrait;
use Core\Database\QueryBuilder;

/**
 *  Contents class for managing contents in the back end
 */
class Contents extends Content
{
    use GetAllDataTrait;
    /**
     * Constructor of the Contents model class
     * @return Void
     */
    public function __construct($id=-1, $title='', $content='', $status='0',
                                $type='page', $categories_id=-1, $thumbnails_id=0, $users_id=-1)
    {
        parent::__construct($id, $title, $content, $status, $type,
            $categories_id, $thumbnails_id, $users_id);
    }
    /**
     * Simple getter of the Category name by id
     * @return string $category_name the name of the linked category
     */
    public function getCategoryNameById() {
        $query = "SELECT name from ".DB_PREFIX."categories WHERE id = '".$this->getCategories_id()."'";
        $category_name = $this->qb->query($query, null, true);
        return $category_name->name;
    }
    /**
     * Simple getter of the Category id by name
     * @param string : $name The name to be searched
     * @return string $category_id the id of the linked category
     */
    public function getCategoryIdByName($name) {
        $query = "SELECT id from ".DB_PREFIX."categories WHERE name = '".$name."'";
        $content_id = $this->qb->query($query, null, true);
        return $content_id->id;
    }

    /**
     * Get all contents with theirs associaeted users
     *
     * @return Array of contents with their associated users
     */
    public static function getAllContentsWithUsersAndContents($limit=null, $offset=null) {
        $qb = new QueryBuilder();
        $query = "SELECT * FROM ".DB_PREFIX."contents"
          ." INNER JOIN (SELECT id AS uid, username FROM ".DB_PREFIX."users) AS users_table
          ON ".DB_PREFIX."contents.users_id = users_table.uid
          WHERE ".DB_PREFIX."contents.deleted = 0
          ORDER BY date_updated, date_inserted";
          if ($limit !== null) $query .= " LIMIT ".$limit;
          if ($offset !== null) $query .= " OFFSET ".$offset;

          echo $query;

        return $qb->query($query, null, false);
    }
}
