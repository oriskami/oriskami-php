<?php

namespace Ubivar;

class FilterRulesAITest extends TestCase
{
    public function __construct()
    {
        self::authorizeFromEnv();
        // CRUD ___________________________________
        // Update .....
        $this->updated1   = FilterRulesAI::update("0", array(is_active => "true"));
        $this->updated2   = FilterRulesAI::update("0", array(is_active => "false"));
        // List .....
        $this->listed1    = FilterRulesAI::all();
    }

    public function testExists()
    {
        self::log(__METHOD__, "Should exist"  );
        $this->assertNotNull($this->updated1  );
        $this->assertNotNull($this->updated2  );
        $this->assertNotNull($this->listed1   );
    }

    public function testClass()
    {
        self::log(__METHOD__, "Should have the right class");
        $this->assertInstanceOf("Ubivar\\FilterRulesAI", $this->updated1[0]);
        $this->assertInstanceOf("Ubivar\\FilterRulesAI", $this->updated1[0]);
        $this->assertInstanceOf("Ubivar\\FilterRulesAI", $this->updated2[0]);
        $this->assertInstanceOf("Ubivar\\FilterRulesAI", $this->listed1[0]);
    }

    public function testAttr()
    {
        self::log(__METHOD__, "Should have the expected attributes");
        $this->assertEquals( $this->updated1[0]["is_active"]."", "true");
        $this->assertEquals( $this->updated2[0]["is_active"]."", "false");
    }
}
