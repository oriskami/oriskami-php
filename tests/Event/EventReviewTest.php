<?php

namespace Oriskami;

class EventReviewTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Created ...
        $created          = EventReview::update("1", array("reviewer_id" => "125", "message" => "another review"));
        $this->created    = $created[count($created) - 1];
        // Retrieve ...
        $this->retrieved  = EventReview::retrieve("1")[0];
        // Update .....
        $this->updated1   = EventReview::update("1", array("review_id" => 0, "reviewer_id" => "124"))[0];
        $this->updated2   = EventReview::update("1", array("review_id" => 0, "reviewer_id" => "123"))[0];
        // List .......
        $this->listed     = EventReview::all(array("order" =>  "id"));
        // Delete .....
        $this->deleted    = EventReview::delete("1", array("review_id" => 2))[0];
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
        $this->assertInstanceOf("Oriskami\\EventReview", $this->retrieved);
        $this->assertInstanceOf("Oriskami\\EventReview", $this->updated1 );
        $this->assertInstanceOf("Oriskami\\EventReview", $this->updated2 );
        $this->assertInstanceOf("Oriskami\\EventReview", $this->deleted  );
        $this->assertInstanceOf("Oriskami\\EventReview", $this->listed[0]);
        $this->assertInstanceOf("Oriskami\\EventReview", $this->listed[1]);
    }

    public function testId()
    {
        self::log(__METHOD__, "Should have the right 'id'");
        $this->assertEquals($this->retrieved->id, "1");
        $this->assertEquals($this->updated1->id , "1");
        $this->assertEquals($this->updated2->id , "1");
        $this->assertEquals($this->deleted->id  , "1");
        $this->assertEquals($this->listed[0]->id, "1");
        $this->assertEquals($this->listed[1]->id, "1");
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $this->assertEquals( $this->created->reviewer["id"]."", "125");
        $this->assertEquals( $this->updated1->reviewer["id"]."", "124");
        $this->assertEquals( $this->updated2->reviewer["id"]."", "123");
        $this->assertEquals( count($this->deleted), 1);
        $this->assertTrue(count($this->listed) > 0);
    }
}
