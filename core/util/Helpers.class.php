<?php

  namespace Core\Util;

  /**
   * Class which provide usefull methods
   */
  class Helpers
  {

    /**
    * Function that help to debug
    * @param $var Var the var to be debugged.
    * @return void
    */
    public static function debugVar($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }

    /**
     * Verify if the log directory exist and if the log file exist
     * To launch Before any Script execution
     * @return void
     */
    public static function createLogExist()
    {
        if (!file_exists(ROOT.'logs')) {
            mkdir(ROOT.'logs');
        }
        if (!file_exists(ROOT.'logs'.DS.'log.txt')) {
            self::log("***/!\\ This is the log File /!\\***");
        }
    }

    /**
     * Safe log Writting
     * @return void
     */
    public static function log($msg)
    {
      $logFile = fopen(ROOT.'logs'.DS.'log.txt', 'a');
      // Locking file to be the only one to write in it
      if (flock($logFile, LOCK_EX) !== false) {
          try {
              // Writing, unlocking and closing file
              fwrite($logFile, 'At '.date("d-m-Y h:i:s a", time()).' : ');
              fwrite($logFile, $msg);
              fwrite($logFile, "\n");
              flock($logFile, LOCK_UN);
              fclose($logFile);
          } catch (\Exception $e) {
              die('Error : '.$e->getMessage());
          }
      }
    }

    /**
     * CRON function who zip logfile for storage purpose
     * Limit File Size : 5Mb
     * @return void
     */
    public static function purgeLog()
    {
        if (filesize(ROOT.'logs'.DS.'log.txt') > 5242880) {
            $zip = new ZipArchive();
            $zip->open(ROOT.'logs'.DS."log_".date("d-m-Y"), ZipArchive::CREATE);
            $zip->close();
        }
    }


    /**
     * Helpers to getting a clean relative path to a class
     * Whathever the system is
     * @param $class : Object The object's class path that sould be resolved
     * @return $class_path : String Relative class path
     */
    public static function relativeClassPath($class)
    {
      $class = get_class($class);
      $class = str_replace(__NAMESPACE__ . '\\', '', $class);
      $class = explode("\\", $class);
      for($i = 0; $i < count($class) - 1; $i += 1) {
        $class[$i] = lcfirst($class[$i]);
      }
      $class = implode(DS, $class);
      return $class;
    }


    /**
     * Clean the string to prevent any hacks
     * @param $string : String The string to be cleaned
     * @return $string : String The cleaned String
     */
    public static function cleanString($string)
    {
      $string = htmlspecialchars($string);
      $string = htmlentities($string);
      $string = strip_tags($string);
      return $string;
    }

    /**
     * Function for uploading a file safely to the server
     * @param $file : FILE The file to be uploaded
     * @param $dir : String The dir where the file should be uploaded
     * @return $$cryptedFN: The path of the crypted filename on the server
     */
    public static function safeUploadFile($file, $dir)
    {
        $cryptedFN = null;

        try {


            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($file['error']) ||
                is_array($file['error'])
            ) {
                Helpers::log('Invalid parameters in an inputed files');
                throw new \Exception('Invalid parameters.');
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    Helpers::log('No file sent.');
                    throw new \Exception('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    Helpers::log('Exceeded filesize limit.');
                    throw new \Exception('Exceeded filesize limit.');
                default:
                    Helpers::log('Unknown errors.');
                    throw new \Exception('Unknown errors.');
            }

            // You should also check filesize here.
            if ($file['size'] > 1000000) {
                Helpers::log('Exceeded filesize limit.');
                throw new \Exception('Exceeded filesize limit. It should be inferior to 5Mb');
            }

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($file['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                Helpers::log('Invalid file format.');
                throw new \Exception('Invalid file format.');
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
            $cryptedFN = sprintf($dir.'%s.%s', sha1_file($file['tmp_name']), $ext);

            if (!move_uploaded_file($file['tmp_name'], $cryptedFN)) {
                Helpers::log('Failed to move uploaded file.');
                throw new \Exception('Failed to move uploaded file.');
            }


            return basename($cryptedFN);

        } catch (\Exception $e) {
            Helpers::log($e->getMessage());
        }
    }

  }
