<?php

namespace Ubivar;

class LogoutTest extends TestCase
{
    protected $created    = null;
    protected $retrieved  = null;
    protected $deleted    = null;

    public function __construct()
    {
        self::authorizeFromEnv();
        $logout           = array(
            "session_id"  => "abc"
          , "user_id"     => "def"
          , "metadata"    => array("key" => "value")
        );
        // CRUD ___________________________________
        // Create
        $this->created    = Logout::create($logout);
        // Retrieve
        $this->retrieved  = Logout::retrieve($this->created->id);
        // Update
        // x
        // Delete
        $this->deleted    = $this->created->delete();
        // List
        $this->order      = Logout::all(array("order" =>  "id"));
        $this->orderInv   = Logout::all(array("order" => "-id"));
        $this->limit5     = Logout::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->limit1     = Logout::all(array(
            "start_after" => $this->limit5[1]->id
          , "end_before"  => $this->limit5[3]->id
        ));
        $this->oneId      = Logout::all(array("id"   => $this->limit5[1]->id));
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
        $this->assertInstanceOf("Ubivar\\Logout", $this->created);
        $this->assertInstanceOf("Ubivar\\Logout", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Logout", $this->deleted);
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

    public function testFilters()
    {
        self::log(__METHOD__, "Should filter results properly");
        $this->assertTrue(intval($this->order[1]->id) > intval($this->order[0]->id));
        $this->assertTrue(intval($this->orderInv[0]->id) > intval($this->order[1]->id));
        $this->assertTrue(count($this->limit5) == 5);
        $this->assertTrue(count($this->limit1) == 1);
    }
}
