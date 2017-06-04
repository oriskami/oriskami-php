<?php

namespace Ubivar;

class EventReviewTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Created ...
        $this->created    = EventReview::update("1", array("reviewer_id" => "125", "message" => "another review"))[0];
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
        $this->assertInstanceOf("Ubivar\\EventReview", $this->retrieved);
        $this->assertInstanceOf("Ubivar\\EventReview", $this->updated1 );
        $this->assertInstanceOf("Ubivar\\EventReview", $this->updated2 );
        $this->assertInstanceOf("Ubivar\\EventReview", $this->deleted  );
        $this->assertInstanceOf("Ubivar\\EventReview", $this->listed[0]);
        $this->assertInstanceOf("Ubivar\\EventReview", $this->listed[1]);
        $this->assertInstanceOf("Ubivar\\EventReview", $this->listed[2]);
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
        $this->assertEquals( $this->created->reviews[1][ "reviewer_id"]."", "125");
        $this->assertEquals( $this->updated1->reviews[0]["reviewer_id"]."", "124");
        $this->assertEquals( $this->updated2->reviews[0]["reviewer_id"]."", "123");
        $this->assertEquals( count($this->deleted->reviews), 2);
        $this->assertNull($this->listed[2]->reviews);
    }
}
