<?php

namespace Ubivar;

class TransactionTest extends TestCase 
{
    public function testCreate()
    {
        self::authorizeFromEnv();
        $tx               = Transaction::create($this->tx);

        // CLASS INSTANCE 
        $this->assertInstanceOf("Ubivar\\Transaction", $tx);

        // EXPECT SAME ID 
        $this->assertSame($this->tx["user_id"], $tx["user_id"]);

        // PROPERTIES 
        $this->assertTrue(isset($tx->user_id));
        $this->assertTrue(isset($tx->user_email));
        $this->assertTrue(isset($tx->gender));
        $this->assertTrue(isset($tx->first_name));
        $this->assertTrue(isset($tx->last_name));
        $this->assertTrue(isset($tx->type));
        $this->assertTrue(isset($tx->status));
        $this->assertTrue(isset($tx->order_id));
        $this->assertTrue(isset($tx->tx_id));
        $this->assertTrue(isset($tx->tx_timestamp));
        $this->assertTrue(isset($tx->amount));
        $this->assertTrue(isset($tx->user_agent));
        $this->assertTrue(isset($tx->ip_address));
        $this->assertTrue(isset($tx->billing_address));
        $this->assertTrue(isset($tx->payment_method));

        // $this->assertTrue(isset($tx->currency_code));
        // $this->assertTrue(isset($tx->shipping_address));
    }

    public function testRetrieve()
    {
        self::authorizeFromEnv();
        $tx               = Transaction::create($this->tx);
        $tx2              = Transaction::retrieve($tx->id);
        $this->assertSame($this->tx["user_id"], $tx2["user_id"]);
    }

    public function testUpdate()
    {
        self::authorizeFromEnv();
        $tx               = Transaction::create($this->tx);
        $user_id_new      = "ABC";
        $user_id_old      = $tx["user_id"];
        $tx["user_id"]    = $user_id_new;
        $this->assertSame($tx->user_id, $user_id_new);
        $tx->save();
        $tx_saved         = Transaction::retrieve($tx->id);
        $this->assertSame($tx_saved->user_id, $user_id_new);
    }

    public function testDelete()
    {
        self::authorizeFromEnv();
        $tx               = Transaction::create($this->tx);
        $tx               = $tx->delete();
        $tx_deleted       = Transaction::retrieve($tx->id);
        $this->assertNull($tx_deleted);
    }
}
