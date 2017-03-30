<?php

  namespace Core\Middleware;

  use Core\Util\Helpers;

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
     * Same as Helpers::cleanString()
     */
    public function cleanString($string)
    {
      return Helpers::cleanString($string);
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
