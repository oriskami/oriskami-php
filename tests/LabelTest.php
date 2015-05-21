<?php

namespace Ubivar;

class LabelTest extends TestCase 
{

    public function testCreate()
    {
        self::authorizeFromEnv();
        $tx               = Transaction::create($this->tx);
        $review           = array(
            "tx_id"       => $tx->id
          , "reviewer_id" => 1
          , "session_id"  => "ABC"
          , "user_id"     => "DEF"
          , "status"      => "is_fraud"
        );
        $label            = Label::create($review);

        // CLASS INSTANCE 
        $this->assertInstanceOf("Ubivar\\Label", $label);

        // EXPECTED TO EXISTS  
        $this->assertNotNull($label);

        // EXPECT SAME ID
        $this->assertEquals($label->tx_id, $tx->id);

        // PROPERTIES
        $this->assertTrue(isset($label->id));
        $this->assertTrue(isset($label->session_id));
        $this->assertTrue(isset($label->user_id));
        $this->assertTrue(isset($label->tx_id));
        $this->assertTrue(isset($label->reviewer_id));
        $this->assertTrue(isset($label->status));
        $this->assertTrue(isset($label->insert_timestamp));
        $this->assertTrue(isset($label->update_timestamp));
    }
}
