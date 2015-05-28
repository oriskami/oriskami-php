<?php

namespace Ubivar;

class AccountTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        $account          = array(
          "user_id"       => "test_user_id_123"
        , "session_id"    => "test_session_id_123"
        , "user_email"    => "abc@email.com"
        , "first_name"    => "John"
        , "last_name"     => "Doe"
        , "primary_phone" => "+234456789-234"
        , "payment_method"=> array(
          "bin"           => "123456"
        , "brand"         => "MasterCard"
        , "funding"       => "credit"
        , "country"       => "US"
        , "name"          => "M Man"
        , "cvc_check"     => "pass"
        ),"billing_address"=> array(
          "line1"         => "169 11th St"
        , "city"          => "San Francisco"
        , "state_region"  => "California"
        , "zip"           => "94103"
        , "country"       => "USA"
        ),"shipping_address"=> array(
          "line1"         => "169 11th St"
        , "city"          => "San Francisco"
        , "state_region"  => "California"
        , "zip"           => "94103"
        , "country"       => "USA"
        ),"social"        => array(
          "twitter"       => "https://twitter.com/ubivarinc"
        , "gplus"         => "https://plus.google.com/+UbivarInc"
        , "linkedin"      => "https://www.linkedin.com/company/ubivarinc/"
        ),"metadata"      => array());

        // CRUD ___________________________________
        // Create
        $this->created    = Account::create($account);
        // Retrieve
        $this->retrieved  = Account::retrieve($this->created->id);
        // Update
        $this->created->amount = "6545321";
        $this->saved      = $this->created->save();
        // Delete
        $this->deleted    = $this->created->delete();
        // List
        $this->order      = Account::all(array("order" =>  "id"));
        $this->orderInv   = Account::all(array("order" => "-id"));
        $this->limit5     = Account::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->limit1     = Account::all(array(
            "start_after" => $this->limit5[1]->id
          , "end_before"  => $this->limit5[3]->id
        ));
        $this->oneId      = Account::all(array("id" => $this->limit5[1]->id));
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
        $this->assertInstanceOf("Ubivar\\Account", $this->created);
        $this->assertInstanceOf("Ubivar\\Account", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Account", $this->saved);
        $this->assertInstanceOf("Ubivar\\Account", $this->deleted);
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
        $this->assertTrue(isset($this->created->user_id));
        $this->assertTrue(isset($this->created->session_id));
        $this->assertTrue(isset($this->created->user_email));
        $this->assertTrue(isset($this->created->first_name));
        $this->assertTrue(isset($this->created->last_name));
        $this->assertTrue(isset($this->created->primary_phone));
        $this->assertTrue(isset($this->created->payment_method));
        $this->assertTrue(isset($this->created->billing_address));
        $this->assertTrue(isset($this->created->shipping_address));
        $this->assertTrue(isset($this->created->social));
        $this->assertTrue(isset($this->created->metadata));
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
