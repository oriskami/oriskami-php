<?php

namespace Ubivar;

/**
 * Base class for Ubivar test cases, provides some utility methods for creating
 * objects.
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    public $login = array("session_id" => "abc", "user_id" => "def");
    public $logout = array("user_id"=> "def");

    protected static function authorizeFromEnv()
    {
        $apiKey = getenv('UBIVAR_TEST_TOKEN');
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
