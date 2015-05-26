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
}
