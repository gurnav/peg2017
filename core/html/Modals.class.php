<?php

  namespace Core\HTML;

  /**
   * Class Modal for
   * Easy html generating
   */
  class Modals
  {

      /**
       * Method for generating a form from an array
       * @param Array : $form The form as an Array
       * @return String : $html The HTML of the generated array
       */
      public static function generateForm($form)
      {
            $html = "<form method=".$form["options"]["method"].' '.
              "action=".$form["options"]["action"].' ';

            if(array_key_exists('enctype', $form['options'])) {
              $html .= "enctype=".$form['options']['enctype'].' ';
            }

            if(array_key_exists('class', $form['options'])) {
              $html .= "class=".$form['options']['class'].' ';
            }

            if(array_key_exists('id', $form['options'])) {
              $html .= "id=".$form['options']['id'].' ';
            }

            $html .= ">\n";

            foreach ($form['struct'] as $struct => $input) {
                $html .= "<div>";

                /*if(array_key_exists('label', $input)) {
                    $html .= "<label> ".$input['label'].' ';
                }*/

                if(array_key_exists('i', $input)) {
                    $html .= "<i ";
                    foreach ($input['i'] as $key => $value) {
                      $html .= $key.'="'.$value.'" ';
                    }
                    $html .= "></i>\n";
                }

                $html .= "<input type=".$input['type']." name=".$struct.' ';

                if(array_key_exists('class', $input)) {
                    $html .= "class=".$input['class'].' ';
                }

                if(array_key_exists('id', $input)) {
                    $html .= "id=".$input['id'].' ';
                }

                if(array_key_exists('placeholder', $input)) {
                    $html .= "placeholder=".$input['placeholder'].' ';
                }

                if(array_key_exists('value', $input)) {
                    $html .= "value=".$input['value'].' ';
                }

                if(array_key_exists('required', $input)) {
                    $html .= "required=".$input['required'].' ';
                }

                $html .= "></div>";

            }

            $html .= "<input type=submit value=".$form['options']['submit']." >\n";
            $html .= "\n</form>";

            return $html;
      }

    }
