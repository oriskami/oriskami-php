<?php

namespace Ubivar;

class LoginTest extends TestCase 
{
    protected $created    = null;
    protected $retrieved  = null;
    protected $deleted    = null;

    public function __construct()
    {
        self::authorizeFromEnv();
        $login            = array(
            "session_id"  => "abc"
          , "user_id"     => "def"
          , "metadata"    => array("key" => "value")
        );
        // CRUD ___________________________________
        // Create
        $this->created          = Login::create($login); 
        // Retrieve
        $this->retrieved        = Login::retrieve($this->created->id);
        // Update
        // x
        // Delete
        $this->deleted          = $this->created->delete();
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist");
        $this->assertNotNull($this->created);
        $this->assertNotNull($this->retrieved);
        $this->assertNotNull($this->deleted);
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Ubivar\\Login", $this->created);
        $this->assertInstanceOf("Ubivar\\Login", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Login", $this->deleted);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->created->id, $this->retrieved->id);
        $this->assertEquals($this->created->id, $this->deleted->id);
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $this->assertTrue(isset($this->retrieved->id));
        $this->assertTrue(isset($this->retrieved->session_id));
        $this->assertTrue(isset($this->retrieved->user_id));
        $this->assertTrue(isset($this->retrieved->metadata));
    }
}
