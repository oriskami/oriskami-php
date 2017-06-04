<?php

namespace Ubivar;

class EventQueueTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Retrieve ...
        $this->retrieved  = EventQueue::retrieve("1")[0];
        // Update .....
        $this->updated1   = EventQueue::update("1", array(active => "rules_custom"))[0];
        $this->updated2   = EventQueue::update("1", array(active => "rules_base"))[0];
        // List .......
        $this->listed     = EventQueue::all(array("order" =>  "id"));
        // Delete .....
        $this->deleted    = EventQueue::delete("1")[0];
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
        $this->assertInstanceOf("Ubivar\\EventQueue", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\EventQueue", $this->updated1 );
        $this->assertInstanceOf("Ubivar\\EventQueue", $this->updated2 );
        $this->assertInstanceOf("Ubivar\\EventQueue", $this->deleted  );
        $this->assertInstanceOf("Ubivar\\EventQueue", $this->listed[0]);
        $this->assertInstanceOf("Ubivar\\EventQueue", $this->listed[1]);
        $this->assertInstanceOf("Ubivar\\EventQueue", $this->listed[2]);
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
        $this->assertTrue( array_key_exists("active", $this->updated1->queues));
        $this->assertFalse(array_key_exists("active", $this->deleted->queues));
        $this->assertEquals( $this->updated1->queues["active"], "rules_custom");
        $this->assertEquals( $this->updated2->queues["active"], "rules_base");
        $this->assertEquals( $this->listed[0]->queues["active"],"rules_base");
        $this->assertEquals( $this->listed[1]->queues["active"],"peer_review");
        $this->assertNull($this->listed[2]->queues);
    }
}
