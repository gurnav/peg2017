<?php

    namespace App\Admin\Models;

    use App\Composite\Models\Content;
    use App\Composite\Traits\Models\GetAllDataTrait;


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
        $type='page', $isCommentable='0', $isLikeable='0', $categories_id=-1, $users_id=-1)
        {
          parent::__construct($id, $title, $content, $status, $type, $isCommentable, $isLikeable,
              $categories_id, $users_id);
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

    }
