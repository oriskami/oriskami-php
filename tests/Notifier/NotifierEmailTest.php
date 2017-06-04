<?php

namespace Ubivar;

class NotifierEmailTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Created ...
        $this->created    = NotifierEmail::create(array(
            "value" => "some pattern"
          , "is_active" => "false"
          , "description" => "a description"
        ));
        // Update .....
        $this->updated1   = NotifierEmail::update("0", array("is_active" => "true"));
        $this->updated2   = NotifierEmail::update("0", array("is_active" => "false"));
        // List .....
        $this->listed1    = NotifierEmail::all();
        // Delete .....
        $this->deleted    = NotifierEmail::delete(count($this->listed1) - 1);
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist"  );
        $this->assertNotNull($this->created   );
        $this->assertNotNull($this->updated1  );
        $this->assertNotNull($this->updated2  );
        $this->assertNotNull($this->deleted   );
        $this->assertNotNull($this->listed1   );
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Ubivar\\NotifierEmail", $this->updated1[0]);
        $this->assertInstanceOf("Ubivar\\NotifierEmail", $this->updated1[0]);
        $this->assertInstanceOf("Ubivar\\NotifierEmail", $this->updated2[0]);
        $this->assertInstanceOf("Ubivar\\NotifierEmail", $this->listed1[0]);
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $lastId = count($this->created) - 1;
        $created = $this->created[$lastId];
        $this->assertEquals( $created["is_active"]."", "false");
        $this->assertEquals( $created["value"]      , "some pattern");
        $this->assertEquals( $created["description"], "a description");
        $this->assertEquals( $this->updated1[0]["is_active"]."", "true");
        $this->assertEquals( $this->updated2[0]["is_active"]."", "false");
        $this->assertEquals( count($this->listed1) - 1, count($this->deleted));
    }
}
