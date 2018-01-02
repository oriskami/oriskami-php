<?php

namespace Oriskami;

/**
 * Base class for Oriskami test cases, provides some utility methods for creating
 * objects.
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    protected static function authorizeFromEnv()
    {
        $apiKey = getenv('ORISKAMI_TEST_TOKEN_PHP_1');
        Oriskami::setApiKey($apiKey);
        Oriskami::setApiVersion('1.0.0');
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
