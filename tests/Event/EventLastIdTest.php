<?php

namespace Ubivar;

class EventLastIdTest extends TestCase
{
    public $data;

    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // List
        $this->listed     = EventLastId::all();
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist");
        $this->assertNotNull($this->listed);
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Ubivar\\EventLastId", $this->listed[0]);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->listed[0]->id, "3");
    }
}
