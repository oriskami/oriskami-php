# Ubivar PHP bindings

[![Build Status](https://travis-ci.org/ubivar/ubivar-php.svg?branch=master)](https://travis-ci.org/ubivar/ubivar-php)
[![Latest Stable Version](https://poser.pugx.org/ubivar/ubivar-php/v/stable.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![Total Downloads](https://poser.pugx.org/ubivar/ubivar-php/downloads.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![License](https://poser.pugx.org/ubivar/ubivar-php/license.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![Code Coverage](https://coveralls.io/repos/ubivar/ubivar-php/badge.png?branch=master)](https://coveralls.io/r/ubivar/ubivar-php?branch=master)


Ubivar is an API that takes over the hassle of screening e-payment for
frauds. 

Ubivar routes e-commerce transactions given their risk. By default the three
`routing` outcomes are rejection, manual verification and acceptance. And the two
elementary resources are the `transactions` and the `labels`.  `Transactions`
are online sales pushed to your payment gateway and `labels` define the *a
posteriori* truth about each `transaction`, i.e. {`fraud`, `non-fraud`}. 

Using Ubivar simply requires an access `token`. Then the bindings provide the
hooks to send and receive resources to the API. For each `transaction` that
Ubivar receives, it calculates a `routing`. Later, as you review manually some of
the `transactions` or as you receive fraud notifications, you `label` 
those `transactions` as `fraud`. 

## Quick Start

Via [Composer](http://getcomposer.org/):

* add to your `composer.json`
```js
{
  "require": {
    "ubivar/ubivar-php": "2.*"
  }
}
```
* run the install script
```
composer install
```
* use [autoload](https://getcomposer.org/doc/00-intro.md#autoloading)
```php
require_once('vendor/autoload.php');
```

Manually:

* download the [latest release](https://github.com/ubivar/ubivar-php/releases) 
* include the `init.php`.
```php
require_once('/path/to/ubivar-php/init.php');
```
### A. Send transactions

```php
\Ubivar\Ubivar::setApiKey('d8e8fca2dc0f896fd7cb4cb0031ba249');
$tx = \Ubivar\Charge::create(array(
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
echo $tx;
```

### B. Retrieve routing 

### C. Label as fraud

## Resources, actions, and arguments 

Every resource is accessed via your `ubivar` instance and accepts an optional
callback as the last argument. In the matrix below we list the resources
(rows), the actions (columns) and the arguments (cells). The full documentation
is available at [https://ubivar.com/docs/php](https://ubivar.com/docs/php). 

| Resource      | C | R | U | D | L | Summary | Test Specs |
| ------------- |:-:|:-:|:-:|:-:|:----:|:-------:|:----------:|
| Accounts      |<a href="https://ubivar.com/docs/php#create_an_account">`{}`</a>|<a href="https://ubivar.com/docs/php#retrieve_an_account">id</a>  |<a href="https://ubivar.com/docs/php#update_an_account">`{}`</a>|<a href="https://ubivar.com/docs/php#delete_an_account">id</a>|<a href="https://ubivar.com/docs/php#list_accounts">`{}`</a>| | [![](https://status.ubivar.com/ubivar-php/resources/accounts.svg)](https://github.com/ubivar/ubivar-php/blob/master/test/Resources/Accounts/spec.js)|
| Items         |<a href="https://ubivar.com/docs/php#create_item">`{}`</a>|<a href="https://ubivar.com/docs/php#retrieve_item">id</a>  |<a href="https://ubivar.com/docs/php#update_item">`{}`</a>|<a href="https://ubivar.com/docs/php#delete_item">id</a>|<a href="https://ubivar.com/docs/php#list_items">`{}`</a>| | [![](https://status.ubivar.com/ubivar-php/resources/items.svg)](https://github.com/ubivar/ubivar-php/blob/master/test/Resources/Items/spec.js)| 
| Labels        |<a href="https://ubivar.com/docs/php#create_label">`{}`</a>|<a href="https://ubivar.com/docs/php#retrieve_label">id</a>  |<a href="https://ubivar.com/docs/php#update_label">`{}`</a>|<a href="https://ubivar.com/docs/php#delete_label">id</a>|<a href="https://ubivar.com/docs/php#list_labels">`{}`</a>| | [![](https://status.ubivar.com/ubivar-php/resources/labels.svg)](https://github.com/ubivar/ubivar-php/blob/master/test/Resources/Labels/spec.js) | 
| Login         |<a href="https://ubivar.com/docs/php#create_login_event">`{}`</a>|<a href="https://ubivar.com/docs/php#retrieve_login_event">id</a>  |        |<a href="https://ubivar.com/docs/php#delete_login_event">id</a>|<a href="https://ubivar.com/docs/php#list_login_events">`{}`</a>| | [![](https://status.ubivar.com/ubivar-php/resources/login.svg)](https://github.com/ubivar/ubivar-php/blob/master/test/Resources/Login/spec.js)| 
| Logout        |<a href="https://ubivar.com/docs/php#create_logout_event">`{}`</a>|<a href="https://ubivar.com/docs/php#retrieve_logout_event">id</a>  |        |<a href="https://ubivar.com/docs/php#delete_logout_event">id</a>|<a href="https://ubivar.com/docs/php#list_logout_events">`{}`</a>| |  [![](https://status.ubivar.com/ubivar-php/resources/logout.svg)](https://github.com/ubivar/ubivar-php/blob/master/test/Resources/Logout/spec.js)| 
| Me            |        |<a href="https://ubivar.com/docs/php#retrieve_your_information">_</a>  |<a href="https://ubivar.com/docs/php#retrieve_your_information">`{}`</a>|        |        | | [![](https://status.ubivar.com/ubivar-php/resources/me.svg)](https://github.com/ubivar/ubivar-php/blob/master/test/Resources/Me/spec.js) |
| Routing | | <a href="https://ubivar.com/docs/php#retrieve_a_routing">id</a>  |<a href="https://ubivar.com/docs/php#update_a_routing">`{}`</a>| |<a href="https://ubivar.com/docs/php#list_routing">`{}`</a>| | [![](https://status.ubivar.com/ubivar-php/resources/routing.svg)](https://github.com/ubivar/ubivar-php/blob/master/test/Resources/Routing/spec.js)| 
| Transactions  |<a href="https://ubivar.com/docs/php#create_a_transaction">`{}`</a>| <a href="https://ubivar.com/docs/php#retrieve_a_transaction">id</a>  |<a href="https://ubivar.com/docs/php#update_a_transaction">`{}`</a>|<a href="https://ubivar.com/docs/php#delete_a_transaction">id</a>|<a href="https://ubivar.com/docs/php#list_transactions">`{}`</a>| | [![](https://status.ubivar.com/ubivar-php/resources/transactions.svg)](https://github.com/ubivar/ubivar-php/blob/master/test/Resources/Transactions/spec.js)| 

+ *C*: Create
+ *R*: Retrieve
+ *U*: Update
+ *D*: Delete
+ *L*: List
+ `{}`: JSON with query parameters

## Filter parameters

| Filter        | Default | Example             | Description                   |
| ------------- |:-------:|:--------------------|:------------------------------|
| `start_after` |         | `array("start_after"=>10)`| `id` after the one specified  |
| `end_before`  |         | `array("end_before"=>10)` | `id` before the one specified |
| `limit`       | `10`    | `array("limit"=>10)`      | At most `10` returned results |
| `gt`          |         | `array("id"=>array("gt"=>10))`  | `id` greater than 10          |
| `gte`         |         | `array("id"=>array("gte"=>10))` | `id` greater than or equal    |
| `lt`          |         | `array("id"=>array("lt"=>10))`  | `id` less than                |
| `lte`         |         | `array("id"=>array("lte"=>10))` | `id` less than or equal       |

## Configuration

- Require PHP 5.3.3 and later.
- Sign up for an account and get an API key at [https://my.ubivar.com](https://my.ubivar.com).
- Set the API access token:
```php
Ubivar::setApiKey('d8e8fca2dc0f896fd7cb4cb0031ba249');
```

## Development

To run the test suite:
```php
./vendor/bin/phpunit
```

To report issues: [issues and feature requests](https://github.com/ubivar/ubivar-php/issues)

## Author

Originally inspired from [stripe-php](https://github.com/stripe/stripe-php). Developed and maintained by [Fabrice Colas](https://fabricecolas.me) ([fabrice.colas@gmail.com](mailto:fabrice.colas@gmail.com)) for [Ubivar](https://ubivar.com). 
