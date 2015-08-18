<?php

namespace Ubivar;

class AddressTest extends TestCase
{
    public $data;
    public $datas;

    public function __construct()
    {
        self::authorizeFromEnv();
        $this->data       = array(
          "shop_id"           => null
        , "user_id"           => "a_user_id_sdadasda"
        , "session_id"        => "a_session_id_asdsada"
        , "first_name"        => "Some"
        , "last_name"         => "Name"
        , "company"           => "Ubivar"
        , "line_1"            => "EuraTechnologies / Ubivar" 
        , "line_2"            => "165 av de Bretagne"
        , "city"              => "LILLE"
        , "state_region"      => null
        , "zip"               => "59000"
        , "country"           => "FR"
        , "phone_number"      => "+123456789"
        , "action"            => "create"
        , "create_timestamp"  => "2015-07-23 20:32:01"
        , "meta"              => array());

        // CRUD ___________________________________
        // Create
        $this->datas = array();
        for ($x = 0; $x <= 2; $x++) {
            $this->datas[]  = Address::create($this->data);
        }
        $this->created    = $this->datas[0];
        // Retrieve
        $this->retrieved  = Address::retrieve($this->created->id);
        // Update
        $this->created->amount = "6545321";
        $this->saved      = $this->created->save();
        // Delete
        $this->deleted    = $this->created->delete();
        // List
        $this->order      = Address::all(array("order" =>  "id"));
        $this->orderInv   = Address::all(array("order" => "-id"));
        $this->limit5     = Address::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->limit1     = Address::all(array(
            "start_after" => $this->limit5[1]->id
          , "end_before"  => $this->limit5[3]->id
        ));
        $this->oneId      = Address::all(array("id" => $this->limit5[1]->id));
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
        $this->assertInstanceOf("Ubivar\\Address", $this->created);
        $this->assertInstanceOf("Ubivar\\Address", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Address", $this->saved);
        $this->assertInstanceOf("Ubivar\\Address", $this->deleted);
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
        $this->assertTrue(intval($this->orderInv[0]->id) > intval($this->orderInv[1]->id));
        $this->assertTrue(count($this->limit5) == 5);
        $this->assertTrue(count($this->limit1) == 1);
        $this->assertTrue($this->oneId[0]->id == $this->limit5[1]->id);
    }
}
