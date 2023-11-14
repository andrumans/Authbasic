<?php

use PHPUnit\Framework\TestCase;

class DataBaseConnTest extends TestCase
{
    private $dataBaseConn;

    protected function setUp(): void
    {
        $this->dataBaseConn = $this->getMockBuilder(DataBaseConn::class)
            ->setConstructorArgs(["localhost", "root", "", "Phpunittest_db"])
            ->getMock();
    }

    public function testPut()
    {
        $table = "test_table";
        $columns = ["column1", "column2"];
        $values = ["value4", 1234];

        $this->dataBaseConn->expects($this->once())
            ->method('put')
            ->with($table, $columns, $values);

        $this->dataBaseConn->put($table, $columns, $values);
    }

    public function testGet()
    {
        $table = "test_table";
        $columns = ["column1", "column2"];
        $options = ["condition" => "column1='value1'"];

        $this->dataBaseConn->expects($this->once())
            ->method('get')
            ->with($table, $columns, $options);

        $this->dataBaseConn->get($table, $columns, $options);
    }

    public function testDelete()
    {
        $table = "test_table";
        $options = ["condition" => "column1='value1'"];

        $this->dataBaseConn->expects($this->once())
            ->method('delete')
            ->with($table, $options);

        $this->dataBaseConn->delete($table, $options);
    }

    protected function tearDown(): void
    {

    }
}
