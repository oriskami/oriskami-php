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
        $tx               = Transaction::create($this->tx);
        $this->tx_id      = $tx->id;
        $review           = array(
            "tx_id"       => $tx->id
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
        $this->assertEquals($this->label->tx_id, $this->tx_id);
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
}
