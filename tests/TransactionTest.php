<?php

namespace Ubivar;

class TransactionTest extends TestCase 
{
    public function __construct()
    {
        self::authorizeFromEnv();
        $tx = array(
            "user_id"         => "test_phahr3Eit3_123"          // your client's id
          , "user_email"      => "test_phahr3Eit3@gmail-123.com"// your client email
          , "gender"          => "M"                            // your client's gender
          , "first_name"      => "John"                         // your client's first name
          , "last_name"       => "Doe"                          // your client's last name
          , "type"            => "sale"                         // the transaction type
          , "status"          => "success"                      // the transaction status 
          , "order_id"        => "test_iiquoozeiroogi_123"      // the shopping cart id
          , "tx_id"           => "client_tx_id_123"             // the transaction id 
          , "tx_timestamp"    => "2015-04-13 13:36:41"          // the timestamp of this transaction
          , "amount"          => "43210"                        // the amount in cents
          , "currency_code"   => "EUR"

          , "payment_method"  => array(
              "bin"           => "123456"                       // the BIN of the card
            , "brand"         => "Mastercard"                   // the brand of the card
            , "funding"       => "credit"                       // the type of card
            , "country"       => "US"                           // the card country code
            , "name"          => "M John Doe"                   // the card holder's name
            , "cvc_check"     => "pass"                         // the cvc check result

          ),"shipping_address"=> array(
              "line1"         => "123 Market Street"            // the shipping address
            , "line2"         => "4th Floor"                       
            , "city"          => "San Francisco"
            , "state"         => "California"
            , "zip"           => "94102"
            , "country"       => "US"

          ),"billing_address" => array(
              "line1"         => "123 Market Street"            // the billing address
            , "line2"         => "4th Floor"                       
            , "city"          => "San Francisco"
            , "state"         => "California"
            , "zip"           => "94102"
            , "country"       => "US"

          ),"ip_address"      => "1.2.3.4"                      // your client ip address
          , "user_agent"      => "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36"// your client's user agent
          , "metadata"        => array("key" => "value")
        );

        // CRUD ________________________________________
        // Create
        $this->created        = Transaction::create($tx);
        // Retrieve
        $this->retrieved      = Transaction::retrieve($this->created->id);
        // Update
        $this->created->amount= "12345";
        $this->saved          = $this->created->save(); 
        // Delete
        $this->deleted        = $this->created->delete(); 
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
        $this->assertInstanceOf("Ubivar\\Transaction", $this->created);
        $this->assertInstanceOf("Ubivar\\Transaction", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Transaction", $this->saved);
        $this->assertInstanceOf("Ubivar\\Transaction", $this->deleted);
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
        $this->assertTrue(isset($this->created->gender));
        $this->assertTrue(isset($this->created->first_name));
        $this->assertTrue(isset($this->created->last_name));
        $this->assertTrue(isset($this->created->type));
        $this->assertTrue(isset($this->created->status));
        $this->assertTrue(isset($this->created->order_id));
        $this->assertTrue(isset($this->created->tx_id));
        $this->assertTrue(isset($this->created->tx_timestamp));
        $this->assertTrue(isset($this->created->amount));
        $this->assertTrue(isset($this->created->currency_code));
        $this->assertTrue(isset($this->created->payment_method));
        $this->assertTrue(isset($this->created->billing_address));
        $this->assertTrue(isset($this->created->shipping_address));
        $this->assertTrue(isset($this->created->ip_address));
        $this->assertTrue(isset($this->created->user_agent));
        $this->assertTrue(isset($this->created->metadata));
    }
}
