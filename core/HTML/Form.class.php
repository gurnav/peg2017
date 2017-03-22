<?php

  namespace Core\HTML;

  /**
   * Class Form
   * Easy form generating
   */
  class Form
  {

      private $data = array(); // Array used by the form, for filling purposes

      /**
       * The constructor of the Form class
       * @return Void
       */
      public function __construct() {}

      /**
      * @param $action : String The action where the form should be sent
      * @param $method : String The method with the form is sent, default is post
      * @return html : String The tag to open a form
      */
      public function openForm($action, $method = 'post')
      {
        return "<form action=\"{$action}\" method=\"{$method}\">";
      }

      /**
       * Fill the form with the data
       * @param $data : Array Representing the data to be filled
       * @return Void
       */
      public function fill($data)
      {
        $this->data = $data;
      }

      /**
       * Surround the HTML with a tag
       * @param $html : String Code HTML to surround
       * @param $tag : String The tag for surrounding
       * @return surrounded : String the surrounded field with the specific tag
       */
      protected function surround($html, $tag)
      {
          return "<{$tag}>{$html}</{$tag}>";
      }

      /**
       * Get a value in the data of the form
       * @param $index : String Id of the value to retrieve
       * @return value : String The value of the index or null instead
       */
      protected function getValue($index)
      {
          if (is_object($this->data)) {
              return $this->data->{$index};
          }
          return isset($this->data[$index]) ? $this->data[$index] : null;
      }

      /**
       * Generate an input field and print it
       * @param $name : String Name of the field
       * @param $type : String Type of the field
       * @param $tag : String the tag for the surrounding
       * @return input : String The input field generated
       */
      public function input($type, $label, $name, $tag, $input)
      {
          $html = "
          <label for=\"{$label}\">{$input} : </label>
          <input type=\"{$type}\" id=\"{$label}\" name=\"{$name}\" value=\"{$this->getValue($name)}\">";

          return $this->surround($html, $tag);
      }

      /**
       * Print Submit the button of the form
       * @return submitButton : String The submit button's field
       */
      public function submit()
      {
          return $this->surround('<button type="submit">Submit</button>', 'p');
      }


      /**
       * Print the close tag of the form
       * @return html : String The tag to close a form
       */
      public function closeForm()
      {
        return '</form>';
      }
  }
