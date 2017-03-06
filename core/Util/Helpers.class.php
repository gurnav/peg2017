<?php

  namespace Core\Util;

  class Helpers {

    /**
    * Function that help to debug
    * @param $var Var the var to be debugged.
    * @return printed output of the debug of the variable
    */
    public static function debugVar($var) {
      echo "<pre>";
        print_r($var);
      echo "</pre>";
    }

    /**
     * Verify if the log directory exist and if the log file exist
     * To launch Before any Script execution
     */
    public static function createLogExist() {
      if(!file_exists(ROOT.'logs'))
        mkdir(ROOT.'logs');
      if(!file_exists(ROOT.'logs'.DS.'log.txt'))
        log("***/!\\ This is the log File /!\\***");
    }

    // Safe logging writing
    public static function log($msg) {
      $logFile = fopen(ROOT.'logs'.DS.'log.txt', 'a');
      // Locking file to be the only one to write in it
      if( flock($logFile, LOCK_EX) !== false ) {
        try {
          // Writing, unlocking and closing file
          fwrite($logFile, 'At '.date("d-m-Y").' : ');
          fwrite($logFile, $msg);
          fwrite($logFile, "\n");
          flock($logFile, LOCK_UN);
          fclose($logFile);
        } catch (Exception $e) {
          die('Erreur : '.$e->getMessage());
        }
      }
    }

    // CRON function who zip logfile for storage purpose
    // Limit Size : 5Mb
    public static function purgeLog() {
      if( filesize(ROOT.'logs'.DS.'log.txt') > 5242880 ) {
        $zip = new ZipArchive();
        $zip->open(ROOT.'logs'.DS."log_".date("d-m-Y"), ZipArchive::CREATE);
        $zip->close();
      }
    }

  }
