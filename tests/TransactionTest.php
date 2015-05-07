<?php

namespace Ubivar;

class TransactionTest extends TestCase
{
    public function testDeletion()
    {
        self::authorizeFromEnv();
        $p = Transaction::create(array(
            'amount' => 2000,
            'interval' => 'month',
            'currency' => 'usd',
            'name' => 'Transaction',
            'id' => 'gold-' . self::randomString()
        ));
        $p->delete();
        $this->assertTrue($p->deleted);
    }

    public function testFalseyId()
    {
        try {
            $retrievedTransaction = Transaction::retrieve('0');
        } catch (Error\InvalidRequest $e) {
            // Can either succeed or 404, all other errors are bad
            if ($e->httpStatus !== 404) {
                $this->fail();
            }
        }
    }

    public function testSave()
    {
        self::authorizeFromEnv();
        $transactionID = 'gold-' . self::randomString();
        $p = Transaction::create(array(
            'amount'   => 2000,
            'interval' => 'month',
            'currency' => 'usd',
            'name'     => 'Transaction',
            'id'       => $transactionID
        ));
        $p->name = 'A new transaction name';
        $p->save();
        $this->assertSame($p->name, 'A new transaction name');

        $ubivarTransaction = Transaction::retrieve($transactionID);
        $this->assertSame($p->name, $ubivarTransaction->name);
    }
}
