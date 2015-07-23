<?php

namespace Ubivar;

class MeTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        $this->data         = array(
          "email"           => null
        , "company"         => null
        , "description"     => null
        , "primary_address" => null
        , "primary_phone"   => null
        , "meta"            => null
        );
        // CRUD ___________________________________
        // Create
        // Retrieve
        $this->retrieved  = Me::retrieve();
        // Update
        $this->retrieved->last_name = "Doe-2";
        $this->saved      = $this->retrieved->save();
        // Delete
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
        foreach (array_keys($this->data) as $attr) {
            $this->assertTrue($this->retrieved->offsetExists($attr));
        }
    }
}
