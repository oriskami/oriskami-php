# Ubivar PHP bindings

[![Build Status](https://travis-ci.org/ubivar/ubivar-php.svg?branch=master)](https://travis-ci.org/ubivar/ubivar-php)
[![Latest Stable Version](https://poser.pugx.org/ubivar/ubivar-php/v/stable.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![Total Downloads](https://poser.pugx.org/ubivar/ubivar-php/downloads.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![License](https://poser.pugx.org/ubivar/ubivar-php/license.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![Code Coverage](https://coveralls.io/repos/ubivar/ubivar-php/badge.png?branch=master)](https://coveralls.io/r/ubivar/ubivar-php?branch=master)

You can sign up for a Ubivar account at https://my.ubivar.com.

## Requirements

PHP 5.3.3 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Add this to your `composer.json`:

```js
{
  "require": {
    "ubivar/ubivar-php": "2.*"
  }
}
```

Then install via:

```
composer install
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Manual Installation

If you do not wish to use Composer, you can download the [latest release](https://github.com/ubivar/ubivar-php/releases). Then, to use the bindings, include the `init.php` file.

```php
require_once('/path/to/ubivar-php/init.php');
```

## Getting Started

Simple usage looks like:

```php
\Ubivar\Ubivar::setApiKey('d8e8fca2dc0f896fd7cb4cb0031ba249');
$charge = \Ubivar\Charge::create(array(
  "user_id"         => "test_phahr3Eit3_123"          // your client's id
, "user_email"      => "test_phahr3Eit3@gmail-123.com"// your client email
, "gender"          => "M"                            // your client's gender
, "first_name"      => "John"                         // your client's first name
, "last_name"       => "Doe"                          // your client's last name
, "type"            => "sale"                         // the transaction type
, "status"          => "success"                      // the transaction status 
, "order_id"        => "test_iiquoozeiroogi_123"      // the shopping cart id
, "tx_id"           => "client_tx_id_123"             // the transaction id 
, "tx_timestamp"    => "2015-04-13 13:36:41"          // the timestamp of this transaction
, "amount"          => "43210"                        // the amount in cents
, "payment_method"  => array(
    "bin"           => "123456"                       // the BIN of the card
  , "brand"         => "Mastercard"                   // the brand of the card
  , "funding"       => "credit"                       // the type of card
  , "country"       => "US"                           // the card country code
  , "name"          => "M John Doe"                   // the card holder's name
  , "cvc_check"     => "pass"                         // the cvc check result
),"billing_address" => array(
    "line1"         => "123 Market Street"            // the billing address
  , "line2"         => "4th Floor"                       
  , "city"          => "San Francisco"
  , "state"         => "California"
  , "zip"           => "94102"
  , "country"       => "US"
),"ip_address"      => "1.2.3.4"                      // your client ip address
, "user_agent"      => "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36"// your client's user agent
));
echo $charge;
```

## Documentation

Please see https://ubivar.com/docs/php for up-to-date documentation.

## Legacy Version Support

If you are using PHP 5.2, you can download v1.18.0 ([zip](https://github.com/ubivar/ubivar-php/archive/v1.18.0.zip), [tar.gz](https://github.com/ubivar/ubivar-php/archive/v1.18.0.tar.gz)) from our [releases page](https://github.com/ubivar/ubivar-php/releases). This version will continue to work with new versions of the Ubivar API for all common uses.

This legacy version may be included via `require_once("/path/to/ubivar-php/lib/Ubivar.php");`, and used like:

```php
Ubivar::setApiKey('d8e8fca2dc0f896fd7cb4cb0031ba249');
$myCard = array('number' => '4242424242424242', 'exp_month' => 5, 'exp_year' => 2015);
$charge = Ubivar_Charge::create(array('card' => $myCard, 'amount' => 2000, 'currency' => 'usd'));
echo $charge;
```

## Tests

In order to run tests first install [PHPUnit](http://packagist.org/packages/phpunit/phpunit) via [Composer](http://getcomposer.org/):

```
composer update --dev
```

To run the test suite:

```php
./vendor/bin/phpunit
```

