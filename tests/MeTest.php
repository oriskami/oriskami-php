<?php

namespace Ubivar;

class MeTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Create
        // x
        // Retrieve
        $this->retrieved  = Me::retrieve();
        // Update
        $this->retrieved->last_name = "Doe-2";
        $this->saved      = $this->retrieved->save();
        // Delete
        // x
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist");
        $this->assertNotNull($this->retrieved);
        $this->assertNotNull($this->saved);
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Ubivar\\Me", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Me", $this->saved);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->retrieved->id, $this->saved->id);
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $this->assertTrue(isset($this->retrieved->id));
        $this->assertTrue(isset($this->retrieved->email));
        $this->assertTrue(isset($this->retrieved->first_name));
        $this->assertTrue(isset($this->retrieved->last_name));
        $this->assertTrue(isset($this->retrieved->description));
        $this->assertTrue(isset($this->retrieved->company));
        $this->assertTrue(isset($this->retrieved->primary_phone));
        $this->assertTrue(isset($this->retrieved->primary_address));
        $this->assertTrue(isset($this->retrieved->meta));
    }
}
