<?php

  namespace Tests\Core\Util;

  use PHPUnit\Framework\TestCase;
  use Core\Util\Helpers;


  class HelpersTest extends TestCase
  {

      public function testCreateLogExist()
      {
          Helpers::createLogExist();
          $this->assertDirectoryExists(ROOT . 'logs/', 'Error the log directory hasen\'t been created !');
          $this->assertFileExists(ROOT . 'logs/log.txt', 'Error the files log/logs.txt hasen\'t been created !');
          $this->assertFileIsReadable(ROOT . 'logs/log.txt', 'Error in reading rights for the file !');
          $this->assertFileIsWritable(ROOT . 'logs/log.txt', 'Erreur in wrigthing right for the file !');
      }

      public function testLog()
      {
        $msg = '!!! THIS IS A TEST !!!';
        Helpers::createLogExist($msg);
        $this->assertStringEqualsFile(ROOT . 'log/logs.txt', $msg, 'The test string is not in the file !');
      }

      public function testRelativeClassPath()
      {
        $test = Helpers::relativeClassPath($this);
        $this->assertSame($test, "test/Core/Util/Helpers", "Relative class path aren't equal");
      }
  }
