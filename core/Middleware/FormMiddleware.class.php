<?php

  namespace Core\HTML;

  /**
   * Middleware class for cleaning Data from form
   * Never trust user input NEVER
   */
  class FormMiddleware
  {

    /**
     * Constructor of the FormMiddleware class
     * @return Void
     */
    public function __construct() {}


    /**
     * Clean the string to prevent any hacks
     * @param $string : String The string to be cleaned
     * @return $string : String The cleaned String
     */
    public function cleanString($string)
    {
      $string = htmlspecialchars($string);
      $string = htmlentities($string);
      $string = strip_tags($string);
      return $string;
    }


    /**
     * Safelly validate an email
     * @param $email : String The email to be validated
     * @return $email : String The Sanitized and validated email, False instead
     */
    public function validateEmail($email)
    {
      return filter_var($email, FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
    }

  }
