<?php

namespace Ubivar;

class ReviewerQueueBindingTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        $this->data       = array(
          "account_id"    => "1"
        , "queue_id"      => "1"
        , "meta"          => array("some" => "meta information")
        );

        // CRUD ___________________________________
        // Create
        $this->datas      = array();
        for ($x = 0; $x <= 2; $x++) {
            $this->datas[]  = ReviewerQueueBinding::create($this->data);
        }
        $this->created    = $this->datas[0];
        // Retrieve
        $this->retrieved  = ReviewerQueueBinding::retrieve($this->created->id);
        // Update
        $this->created->meta = array("some2" => "meta2 information2");
        $this->saved      = $this->created->save();
        // Delete
        $this->deleted    = $this->created->delete();
        // List
        $this->order      = ReviewerQueueBinding::all(array("order" =>  "id"));
        $this->orderInv   = ReviewerQueueBinding::all(array("order" => "-id"));
        $this->limit5     = ReviewerQueueBinding::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->limit1     = ReviewerQueueBinding::all(array(
            "start_after" => $this->limit5[1]->id
          , "end_before"  => $this->limit5[3]->id
        ));
        $this->oneId      = ReviewerQueueBinding::all(array("id" => $this->limit5[1]->id));
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
        $this->assertInstanceOf("Ubivar\\ReviewerQueueBinding", $this->created);
        $this->assertInstanceOf("Ubivar\\ReviewerQueueBinding", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\ReviewerQueueBinding", $this->saved);
        $this->assertInstanceOf("Ubivar\\ReviewerQueueBinding", $this->deleted);
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
        foreach (array_keys($this->data) as $attr) {
            $this->assertTrue($this->retrieved->offsetExists($attr));
        }
    }

    public function testFilters()
    {
        self::log(__METHOD__, "Should filter results properly");
        $this->assertTrue(intval($this->order[1]->id) > intval($this->order[0]->id));
        $this->assertTrue(intval($this->orderInv[0]->id) > intval($this->order[1]->id));
        $this->assertTrue(count($this->limit5) == 5);
        $this->assertTrue(count($this->limit1) == 1);
        $this->assertTrue($this->oneId[0]->id == $this->limit5[1]->id);
    }
}
