<?php

namespace Ubivar;

/**
 * Base class for Ubivar test cases, provides some utility methods for creating
 * objects.
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    protected static function authorizeFromEnv()
    {
        $apiKey = getenv('UBIVAR_TEST_TOKEN');
        Ubivar::setApiKey($apiKey);
        Ubivar::setApiVersion('0.8.0-beta');
    }

    /**
     * Genereate a semi-random string
     */
    protected static function generateRandomString($length = 24)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTU';
        $charactersLength = strlen($characters);
        $randomString     = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function log($context, $message)
    {
        fwrite(STDOUT, "\n".$context."\t| ".$message);
    }
}
