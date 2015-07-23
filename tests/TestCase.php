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
        print_r("\nUBIVAR_TEST_TOKEN = ".substr($apiKey, 0, 5)."****");
        print_r("\nUBIVAR_TEST_TOKEN = ".substr($_ENV['UBIVAR_TEST_TOKEN'], 0, 5)."****");
        Ubivar::setApiKey($apiKey);
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
