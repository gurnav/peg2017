<?php

  class HelpersTest extends \PHPUnit_Framework_TestCase
  {
      public function test_createLogExist()
      {
          Helpers::createLogExist();
          $this->assertDirectoryExists('logs/', 'Erreur le dossier logs n\'à pas été créé.');
          $this->assertFileExists('logs/log.txt', 'Erreur le fichier logs.txt n\'à pas été créé.');
          $this->assertFileIsReadable('logs/log.txt', 'Erreur de droits de lecture.');
          $this->assertFileIsWritable('logs/log.txt', 'Erreur de droits d\'écriture.');
      }

    // Not sure about how to implement it yet
    // public function test_log() {
    //   $msg = '***/!\ This is the log File /!\***';
    //   Helpers::createLogExist($msg);
    // }

    // public function test_purgeLog() {}
  }
