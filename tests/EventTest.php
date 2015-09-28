<?php

namespace Ubivar;

class EventTest extends TestCase
{
    public $data;
    public $datas;

    public function __construct()
    {
        self::authorizeFromEnv();
        $this->data       = array(
            'parameters'  => array("key" => "value")
        );
        $this->datas      = array();
        // CRUD ___________________________________
        // Create
        for ($x = 0; $x <= 2; $x++) {
            $this->datas[]  = Event::create($this->data);
        }
        $this->created    = $this->datas[0];
        // Retrieve
        $this->retrieved  = Event::retrieve($this->created->id);
        // Update
        // Delete
        $this->deleted    = $this->created->delete();
        // List
        $this->order      = Event::all(array("order" =>  "id"));
        $this->orderInv   = Event::all(array("order" => "-id"));
        $this->limit5     = Event::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->limit1     = Event::all(array(
            "start_after" => $this->limit5[1]->id
          , "end_before"  => $this->limit5[3]->id
        ));
        $this->oneId      = Event::all(array("id"   => $this->limit5[1]->id));
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
        $this->assertInstanceOf("Ubivar\\Event", $this->created);
        $this->assertInstanceOf("Ubivar\\Event", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Event", $this->deleted);
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
        foreach (array_keys($this->data) as $attr) {
            $this->assertTrue($this->retrieved->offsetExists($attr));
        }
    }

    public function testFilters()
    {
        self::log(__METHOD__, "Should filter results properly");
        $this->assertTrue(intval($this->order[1]->id) > intval($this->order[0]->id));
        $this->assertTrue(intval($this->orderInv[0]->id) > intval($this->orderInv[1]->id));
        $this->assertTrue(count($this->limit5) == 5);
        $this->assertTrue(count($this->limit1) == 1);
    }
}
