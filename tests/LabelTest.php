<?php

namespace Ubivar;

class LabelTest extends TestCase 
{
    protected $label      = null;
    protected $retrieved  = null;
    protected $saved      = null;
    protected $deleted    = null;
    protected $tx_id      = null;

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
        );

        $this->tx         = Transaction::create($tx);
        $review           = array(
            "tx_id"       => $this->tx->id
          , "reviewer_id" => 1
          , "session_id"  => "ABC"
          , "user_id"     => "DEF"
          , "status"      => "is_fraud"
        );

        // CRUD ___________________________________
        // Create
        $this->label      = Label::create($review);
        // Retrieve
        $this->retrieved  = Label::retrieve($this->label->id);
        // Update 
        $this->label->status = "is_ok";
        $this->saved      = $this->label->save();
        // Delete
        $this->deleted    = $this->label->delete();
        // List 
        $this->order      = Label::all(array("order" =>  "id"));
        $this->orderInv   = Label::all(array("order" => "-id"));
        $this->limit5     = Label::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->limit1     = Label::all(array(
            "start_after" => $this->limit5[1]->id
          , "end_before"  => $this->limit5[3]->id
        ));
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist");
        $this->assertNotNull($this->label);
        $this->assertNotNull($this->retrieved);
        $this->assertNotNull($this->saved);
        $this->assertNotNull($this->deleted);
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Ubivar\\Label", $this->label);
        $this->assertInstanceOf("Ubivar\\Label", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\Label", $this->saved);
        $this->assertInstanceOf("Ubivar\\Label", $this->deleted);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->label->tx_id, $this->tx->id);
        $this->assertEquals($this->label->id, $this->retrieved->id);
        $this->assertEquals($this->label->id, $this->saved->id);
        $this->assertEquals($this->label->id, $this->deleted->id);
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $this->assertTrue(isset($this->label->id));
        $this->assertTrue(isset($this->label->session_id));
        $this->assertTrue(isset($this->label->user_id));
        $this->assertTrue(isset($this->label->tx_id));
        $this->assertTrue(isset($this->label->reviewer_id));
        $this->assertTrue(isset($this->label->status));
        $this->assertTrue(isset($this->label->insert_timestamp));
        $this->assertTrue(isset($this->label->update_timestamp));
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
