<?php

namespace Ubivar;

class FilterRulesCustomTest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Created ...
        $this->created    = FilterRulesCustom::create(array(
            "value" => "some pattern"
          , "feature" => "email_domain"
          , "is_active" => "false"
          , "description" => "a description"
        ));
        // Update .....
        $this->updated1   = FilterRulesCustom::update("0", array("is_active" => "true"));
        $this->updated2   = FilterRulesCustom::update("0", array("is_active" => "false"));
        // List .....
        $this->listed1    = FilterRulesCustom::all();
        // Delete .....
        $this->deleted    = FilterRulesCustom::delete(count($this->listed1) - 1);
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
        $this->assertInstanceOf("Ubivar\\FilterRulesCustom", $this->updated1[0]);
        $this->assertInstanceOf("Ubivar\\FilterRulesCustom", $this->updated1[0]);
        $this->assertInstanceOf("Ubivar\\FilterRulesCustom", $this->updated2[0]);
        $this->assertInstanceOf("Ubivar\\FilterRulesCustom", $this->listed1[0]);
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $lastId = count($this->created) - 1;
        $createdRulesCustom = $this->created[$lastId];
        $this->assertEquals( $createdRulesCustom["is_active"]."", "false");
        $this->assertEquals( $createdRulesCustom["feature"]    , "email_domain");
        $this->assertEquals( $createdRulesCustom["value"]      , "some pattern");
        $this->assertEquals( $createdRulesCustom["description"], "a description");
        $this->assertEquals( $this->updated1[0]["is_active"]."", "true");
        $this->assertEquals( $this->updated2[0]["is_active"]."", "false");
        $this->assertEquals( count($this->listed1) - 1, count($this->deleted));
    }
}
