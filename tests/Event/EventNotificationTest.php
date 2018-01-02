<?php

namespace Oriskami;

class EventNotificationTest extends TestCase
{
    public $data;
    public $datas;

    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Retrieve
        $this->retrieved  = EventNotification::retrieve("2")[0];
        // List
        $this->listed     = EventNotification::all(array("order" =>  "id"));
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist");
        $this->assertNotNull($this->retrieved);
        $this->assertNotNull($this->listed);
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Oriskami\\EventNotification", $this->retrieved);
        $this->assertInstanceOf("Oriskami\\EventNotification", $this->listed[0]);
        $this->assertInstanceOf("Oriskami\\EventNotification", $this->listed[1]);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->retrieved->id, "2");
        $this->assertEquals($this->listed[0]->id, "1");
        $this->assertEquals($this->listed[1]->id, "2");
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $this->assertTrue(array_key_exists("notifier_sms", $this->retrieved->notifications));
    }
}
