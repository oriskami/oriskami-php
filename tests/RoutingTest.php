<?php

namespace Ubivar;

class RoutingTest extends TestCase 
{
    public function testRetrieve()
    {
        self::authorizeFromEnv();
        $tx               = Transaction::create($this->tx);
        $routing          = Routing::retrieve($tx->id);

        // CLASS
        $this->assertInstanceOf("Ubivar\\Routing", $routing);

        // EXPECT SAME ID
        $this->assertSame($tx->id, $routing->id);

        // TEST PROPERTIES
        $this->assertTrue(isset($routing->id));
        $this->assertTrue(isset($routing->tx_id));
        $this->assertTrue(isset($routing->status));
        $this->assertTrue(isset($routing->insert_timestamp));
        $this->assertTrue(isset($routing->update_timestamp));
    }
}
