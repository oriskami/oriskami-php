<?php

namespace Oriskami;

class EventLabelTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Retrieve
        $this->retrieved  = EventLabel::retrieve("1")[0];
        // Update
        $this->updated1   = EventLabel::update("1", array("label" => "is_loss", "value" => "false"))[0];
        $this->updated2   = EventLabel::update("1", array("label" => "is_loss", "value" => "true" ))[0];
        // List
        $this->listed     = EventLabel::all(array("order" =>  "id"));
        // Delete
        $this->deleted    = EventLabel::delete("1", array("label" => "is_loss"))[0];
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist"  );
        $this->assertNotNull($this->retrieved );
        $this->assertNotNull($this->updated1  );
        $this->assertNotNull($this->updated2  );
        $this->assertNotNull($this->deleted   );
        $this->assertNotNull($this->listed    );
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Oriskami\\EventLabel", $this->retrieved);
        $this->assertInstanceOf("Oriskami\\EventLabel", $this->updated1 );
        $this->assertInstanceOf("Oriskami\\EventLabel", $this->updated2 );
        $this->assertInstanceOf("Oriskami\\EventLabel", $this->deleted  );
        $this->assertInstanceOf("Oriskami\\EventLabel", $this->listed[0]);
        $this->assertInstanceOf("Oriskami\\EventLabel", $this->listed[1]);
        $this->assertInstanceOf("Oriskami\\EventLabel", $this->listed[2]);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->retrieved->id, "1");
        $this->assertEquals($this->updated1->id , "1");
        $this->assertEquals($this->updated2->id , "1");
        $this->assertEquals($this->deleted->id  , "1");
        $this->assertEquals($this->listed[0]->id, "1");
        $this->assertEquals($this->listed[1]->id, "2");
        $this->assertEquals($this->listed[2]->id, "3");
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $this->assertTrue( array_key_exists("is_loss", $this->updated1->labels));
        $this->assertFalse(array_key_exists("is_loss", $this->deleted->labels));
        $this->assertEquals( $this->updated1->labels["is_loss"]."", "false");
        $this->assertEquals( $this->updated2->labels["is_loss"]."", "true");
        $this->assertEquals( $this->listed[0]->labels["is_loss"], "true");
        $this->assertEquals( $this->listed[1]->labels["is_loss"], "false");
        $this->assertNull($this->listed[2]->labels);
    }
}
