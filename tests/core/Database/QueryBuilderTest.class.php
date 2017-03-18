<?php

  namespace Tests\Core\Database;

  use PHPUnit\Framework\TestCase;
  use Core\Database\QueryBuilder;
  use Core\Facades\Query;

  class QueryBuilderTest extends TestCase
  {

    public function testToString()
    {
      $testRequest = Query::select('*')->from('test', 'unit')->where('id=1');
      $this->assertSame("SELECT * FROM test AS unit WHERE id=1", $testRequest);
    }

    public function testQuery()
    {

    }

    public function testPrepare()
    {

    }


  }
