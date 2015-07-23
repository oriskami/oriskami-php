<?php

namespace Ubivar;

class LoginTest extends TestCase
{
    public $data;
    public $datas;

    public function __construct()
    {
        self::authorizeFromEnv();
        $this->data       = array(
            'shop_id'     => null
          , 'user_id'     => "abcdef_user_id"
          , 'session_id'  => "abcdef_session_id"
          , 'is_user_id'  => true
          , 'is_password' => false
          , 'is_valid'    => null
          , 'create_timestamp'=> null
          , 'meta'        => array("key" => "value")
        );
        $this->datas      = array();
        // CRUD ___________________________________
        // Create
        for ($x = 0; $x <= 2; $x++) {
            $this->datas[]  = Login::create($this->data);
        }
        $this->created    = $this->datas[0];
        // Retrieve
        $this->retrieved  = Login::retrieve($this->created->id);
        // Update
        // Delete
        $this->deleted    = $this->created->delete();
        // List
        $this->order      = Login::all(array("order" =>  "id"));
        $this->orderInv   = Login::all(array("order" => "-id"));
        $this->limit5     = Login::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->limit1     = Login::all(array(
            "start_after" => $this->limit5[1]->id
          , "end_before"  => $this->limit5[3]->id
        ));
        $this->oneId      = Login::all(array("id"   => $this->limit5[1]->id));
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
    }
}
