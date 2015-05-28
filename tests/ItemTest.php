<?php

namespace Ubivar;

class ItemTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();

        $item             = array(
          "session_id"    => "loo9achu4yiz9ohKio2Jiz2eep5ahShethai"
        , "user_id"       => "de3acauQui"
        , "item"          => array("a", "b", "c")
        , "metadata"      => array("key" => "value"));

        // CRUD ___________________________________
        // Create
        $this->created    = Item::create($item);
        // Retrieve
        $this->retrieved  = Item::retrieve($this->created->id);
        // Update
        $this->created->item = array("a", "b", "c", "d");
        $this->saved      = $this->created->save();
        // Delete
        $this->deleted    = $this->created->delete();
        // List
        $this->order      = Item::all(array("order" =>  "id"));
        $this->orderInv   = Item::all(array("order" => "-id"));
        $this->limit5     = Item::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->limit1     = Item::all(array(
            "start_after" => $this->limit5[1]->id
          , "end_before"  => $this->limit5[3]->id
        ));
        $this->oneId      = Item::all(array("id"   => $this->limit5[1]->id));
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist");
        $this->assertNotNull($this->created);
        $this->assertNotNull($this->retrieved);
        $this->assertNotNull($this->saved);
        $this->assertNotNull($this->deleted);
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Ubivar\\Item", $this->created);
        $this->assertInstanceOf("Ubivar\\Item", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Item", $this->saved);
        $this->assertInstanceOf("Ubivar\\Item", $this->deleted);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->created->id, $this->retrieved->id);
        $this->assertEquals($this->created->id, $this->saved->id);
        $this->assertEquals($this->created->id, $this->deleted->id);
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $this->assertTrue(isset($this->created->id));
        $this->assertTrue(isset($this->created->session_id));
        $this->assertTrue(isset($this->created->user_id));
        $this->assertTrue(isset($this->created->item));
        $this->assertTrue(isset($this->created->metadata));
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
