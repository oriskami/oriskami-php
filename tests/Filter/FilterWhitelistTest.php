<?php

namespace Ubivar;

class FilterWhitelistTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Created ...
        $this->created    = FilterWhitelist::create(array(
            "value" => "some pattern"
          , "feature" => "email_domain"
          , "is_active" => "false"
          , "description" => "a description"
        ));
        // Update .....
        $this->updated1   = FilterWhitelist::update("1", array("is_active" => "true"));
        $this->updated2   = FilterWhitelist::update("1", array("is_active" => "false"));
        // List .....
        $this->listed1    = FilterWhitelist::all();
        // Delete .....
        $this->deleted    = FilterWhitelist::delete(count($this->listed1) - 1);
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
        $this->assertInstanceOf("Ubivar\\FilterWhitelist", $this->updated1[0]);
        $this->assertInstanceOf("Ubivar\\FilterWhitelist", $this->updated1[0]);
        $this->assertInstanceOf("Ubivar\\FilterWhitelist", $this->updated2[0]);
        $this->assertInstanceOf("Ubivar\\FilterWhitelist", $this->deleted[0]);
        $this->assertInstanceOf("Ubivar\\FilterWhitelist", $this->listed1[0]);
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $lastId = count($this->created) - 1;
        $createdWhitelist = $this->created[$lastId];
        $this->assertEquals( $createdWhitelist["is_active"]."", "false");
        $this->assertEquals( $createdWhitelist["feature"]    , "email_domain");
        $this->assertEquals( $createdWhitelist["value"]      , "some pattern");
        $this->assertEquals( $createdWhitelist["description"], "a description");
        $this->assertEquals( $this->updated1[1]["is_active"]."", "true");
        $this->assertEquals( $this->updated2[1]["is_active"]."", "false");
        $this->assertEquals( count($this->listed1) - 1, count($this->deleted));
    }
}
