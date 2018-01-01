<?php

namespace Oriskami;

class EventTest extends TestCase
{
    public $data;
    public $datas;

    public function __construct()
    {
        self::authorizeFromEnv();
        $this->data       = array(
            array(
              "id" => "1",
              "parameters"  => array(
                "id"                    => "1",
                "email"                 =>  "abc@gmail.com",
                "names"                 =>  "M Abc",
                "account_creation_time" =>  "2017-05-17 21:50:00",
                "account_id"            =>  "1",
                "account_n_fulfilled"   =>  "1",
                "account_total_since_created" =>  "49.40",
                "account_total_cur"     =>  "EUR",
                "invoice_time"          =>  "2017-05-17 21:55:00",
                "invoice_address_country"=>  "France",
                "invoice_address_place" =>  "75008 Paris",
                "invoice_address_street1"=>  "1 Av. des Champs-Élysées",
                "invoice_name"          =>  "M ABC",
                "invoice_phone1"        =>  "0123456789",
                "invoice_phone2"        =>  null,
                "transport_date"        =>  "2017-05-18 08:00:00",
                "transport_type"        =>  "Delivery",
                "transport_mode"        =>  "TNT",
                "transport_weight"      =>  "9.000",
                "transport_unit"        =>  "kg",
                "transport_cur"         =>  "EUR",
                "delivery_address_country" =>  "France",
                "delivery_address_place"=>  "75008 Paris",
                "delivery_address_street1" =>  "1 Av. des Champs-Élysées",
                "delivery_name"         =>  "M ABC",
                "delivery_phone1"       =>  "0123450689",
                "customer_ip_address"   =>  "1.2.3.4",
                "pmeth_origin"          =>  "FRA",
                "pmeth_validity"        =>  "0121",
                "pmeth_brand"           =>  "MC",
                "pmeth_bin"             =>  "510000",
                "pmeth_3ds"             =>  "-1",
                "cart_products"         => array("Product ref #12345"),
                "cart_details"          => array(
                  array(
                    "name"              =>  "Product ref #12345",
                    "pu"                =>  "10.00",
                    "n"                 =>  "1",
                    "reimbursed"        =>  " 0",
                    "available"         =>  "1",
                    "amount"            =>  "10.00",
                    "cur"               =>  "EUR"
                  )
                ),
                "cart_n"          =>  "15000",
                "order_payment_accepted" =>  "2017-05-17 22:00:00",
                "amount_pmeth"    =>  "ABC Payment Service Provider",
                "amount_discounts"=>  0.00,
                "amount_products" =>  20.00,
                "amount_transport"=>  10.00,
                "amount_total"    =>  30.00,
                "amount_cur"      =>  "EUR"

              )), array(

              "id"                           =>  "2"           
            , "parameters"                   => array(
                "id"                           =>  "2"           
              , "email"                        =>  "def@yahoo.com"
              , "names"                        =>  "M Def"
              , "account_creation_time"        =>  "2017-05-17 22:50:00"
              , "account_id"                   =>  "20"
              , "account_n_fulfilled"          =>  "1"
              , "account_total_since_created"  =>  "59.40"
              , "account_total_cur"            =>  "EUR"
              , "invoice_time"                 =>  "2017-05-17 21:55:00"
              , "invoice_address_country"      =>  "San Francisco, CA 94102"
              , "invoice_address_place"        =>  "75008 Paris"
              , "invoice_address_street1"      =>  "944 Market Street, 8th floor"
              , "invoice_name"                 =>  "M Def"
              , "invoice_phone1"               =>  "+1 111-111-111"
              , "invoice_phone2"               =>  null
              , "transport_date"               =>  "2017-05-18 08:00:00"
              , "transport_type"               =>  "Delivery"
              , "transport_mode"               =>  "TNT"
              , "transport_weight"             =>  "9.000"
              , "transport_unit"               =>  "kg"
              , "transport_cur"                =>  "EUR"
              , "delivery_address_country"     =>  "United States"
              , "delivery_address_place"       =>  "San Francisco, CA 94102"
              , "delivery_address_street1"     =>  "944 Market Street, 8th floor"
              , "delivery_name"                =>  "M DEF"
              , "delivery_phone1"              =>  "+1 111-111-111"
              , "customer_ip_address"          =>  "4.5.6.7"
              , "pmeth_origin"                 =>  "USA"
              , "pmeth_validity"               =>  "0221"
              , "pmeth_brand"                  =>  "MC"
              , "pmeth_bin"                    =>  "510000"
              , "pmeth_3ds"                    =>  "-1"
              , "cart_products"                =>  array("Product ref #12345")
              , "cart_details"                 =>  array(
                array(
                    "name"                     =>  "Product ref #12345"
                  , "pu"                       =>  "10.00"
                  , "n"                        =>  "1"
                  , "amount"                   =>  "10.00"
                  , "cur"                      =>  "EUR" 
                )
              )
            , "cart_n"                       =>  "15000"
            , "order_payment_accepted"       =>  "2017-05-17 22:00:00"
            , "amount_pmeth"                 =>  "DEF Payment Service Provider"
            , "amount_discounts"             =>   "0.00"
            , "amount_products"              =>  "20.00"
            , "amount_transport"             =>  "10.00"
            , "amount_total"                 =>  "30.00"
            , "amount_cur"                   =>  "EUR"

          )), array(

              "id"                           =>  "3"           
            , "parameters"                   =>  array( 
                "id"                           =>  "3"           
              , "email"                        =>  "def@hotmail.com"
              , "names"                        =>  "M Ghi"
              , "account_creation_time"        =>  "2017-05-17 22:50:00"
              , "account_id"                   =>  "20"
              , "account_n_fulfilled"          =>  "1"
              , "account_total_since_created"  =>  "59.40"
              , "account_total_cur"            =>  "EUR"
              , "invoice_time"                 =>  "2017-05-17 21:55:00"
              , "invoice_address_country"      =>  "San Francisco, CA 94102"
              , "invoice_address_place"        =>  "75008 Paris"
              , "invoice_address_street1"      =>  "944 Market Street, 8th floor"
              , "invoice_name"                 =>  "M Def"
              , "invoice_phone1"               =>  "+1 111-111-111"
              , "invoice_phone2"               =>  null
              , "transport_date"               =>  "2017-05-18 08:00:00"
              , "transport_type"               =>  "Delivery"
              , "transport_mode"               =>  "TNT"
              , "transport_weight"             =>  "9.000"
              , "transport_unit"               =>  "kg"
              , "transport_cur"                =>  "EUR"
              , "delivery_address_country"     =>  "United States"
              , "delivery_address_place"       =>  "San Francisco, CA 94102"
              , "delivery_address_street1"     =>  "944 Market Street, 8th floor"
              , "delivery_name"                =>  "M Ghi"
              , "delivery_phone1"              =>  "+1 111-111-111"
              , "customer_ip_address"          =>  "4.5.6.7"
              , "pmeth_origin"                 =>  "USA"
              , "pmeth_validity"               =>  "0221"
              , "pmeth_brand"                  =>  "MC"
              , "pmeth_bin"                    =>  "510000"
              , "pmeth_3ds"                    =>  "-1"
              , "cart_products"                =>  array("Product ref #12345") 
              , "cart_details"                 =>  array(
                array(
                    "name"                     =>  "Product ref #12345"
                  , "pu"                       =>  "10.00"
                  , "n"                        =>  "1"
                  , "amount"                   =>  "10.00"
                  , "cur"                      =>  "EUR" 
                )
              )
            , "cart_n"                       =>  "15000"
            , "order_payment_accepted"       =>  "2017-05-17 22:00:00"
            , "amount_pmeth"                 =>  "GHI Payment Service Provider"
            , "amount_discounts"             =>   "0.00"
            , "amount_products"              =>  "20.00"
            , "amount_transport"             =>  "10.00"
            , "amount_total"                 =>  "30.00"
            , "amount_cur"                   =>  "EUR"
          ))
        );
        $this->datas      = array();
        // CRUD ___________________________________
        // Create
        for ($x = 0; $x <= 2; $x++) {
            $this->datas[]  = Event::create($this->data[$x])[0];
        }
        $this->created    = $this->datas[0];
        // Retrieve
        $this->retrieved  = Event::retrieve($this->created->id)[0];
        // Update
        // Delete
        $this->deleted    = Event::delete($this->created->id)[0];
        // List
        $this->order      = Event::all(array("order" =>  "id"));
        $this->orderInv   = Event::all(array("order" => "-id"));
        $this->limit2     = Event::all(array(
            "limit"       => "5"
          , "order"       => "id"));
        $this->oneId      = Event::all(array("id"   => $this->limit2[1]->id));
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
        $this->assertInstanceOf("Oriskami\\Event", $this->created);
        $this->assertInstanceOf("Oriskami\\Event", $this->retrieved);
        $this->assertInstanceOf("Oriskami\\Event", $this->deleted);
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
        foreach (array_keys($this->data[0]) as $attr) {
            $this->assertTrue($this->retrieved->offsetExists($attr));
        }
    }

    public function testFilters()
    {
        self::log(__METHOD__, "Should filter results properly");
        $this->assertTrue(intval($this->order[1]->id) > intval($this->order[0]->id));
        $this->assertTrue(intval($this->orderInv[0]->id) > intval($this->orderInv[1]->id));
        $this->assertTrue(count($this->limit2) == 2);
    }
}
