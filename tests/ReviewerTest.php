<?php

namespace Ubivar;

class ReviewerTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        $this->aReviewerId= 1;
        $this->data       = array(
          "account_id"    => null
        , "first_name"    => null
        , "last_name"     => null
        , "langs"         => null
        );

        // CRUD ___________________________________
        // Create
        // Retrieve
        $this->retrieved  = Reviewer::retrieve($this->aReviewerId);
        // Update
        // Delete
        // List
        $this->order      = Reviewer::all(array("order" =>  "account_id"));
        $this->orderInv   = Reviewer::all(array("order" => "-account_id"));
        $this->limit5     = Reviewer::all(array(
            "limit"       => "5"
          , "order"       => "account_id"));
        $this->limit1     = Reviewer::all(array(
            "limit"       => 1
        //    "start_after" => $this->limit5[1]->account_id
        //  , "end_before"  => $this->limit5[3]->account_id
        ));
        $this->oneId      = Reviewer::all(array("account_id" => $this->limit5[1]->account_id));
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist");
        $this->assertNotNull($this->retrieved);
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Ubivar\\Reviewer", $this->retrieved);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->aReviewerId, $this->retrieved->id);
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
        $this->assertTrue(intval($this->order[1]->account_id) > intval($this->order[0]->account_id));
        $this->assertTrue(intval($this->orderInv[0]->account_id) > intval($this->orderInv[1]->account_id));
        // $this->assertTrue(count($this->limit5) == 5);
        $this->assertTrue(count($this->limit1) == 1);
        $this->assertTrue($this->oneId[0]->account_id == $this->limit5[1]->account_id);
    }
}
