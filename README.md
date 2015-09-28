# Ubivar PHP bindings

[![Build Status](https://travis-ci.org/ubivar/ubivar-php.svg?branch=master)](https://travis-ci.org/ubivar/ubivar-php)
[![Latest Stable Version](https://poser.pugx.org/ubivar/ubivar-php/v/stable.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![Total Downloads](https://poser.pugx.org/ubivar/ubivar-php/downloads.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![License](https://poser.pugx.org/ubivar/ubivar-php/license.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![Code Coverage](https://coveralls.io/repos/ubivar/ubivar-php/badge.png?branch=master)](https://coveralls.io/r/ubivar/ubivar-php?branch=master)


Ubivar prevents the risk of non-payment *at the root* and *on autopilot* for businesses.

## Quick Start

Using [Composer](http://getcomposer.org/), add to your `composer.json` the following, and run `composer install`.
```js
{ 
  "require": {
    "ubivar/ubivar-php": "*@dev"
  }
}
```
Using [autoload](https://getcomposer.org/doc/00-intro.md#autoloading), add:
```php
require_once('vendor/autoload.php');
```
Manually, download the [latest release](https://github.com/ubivar/ubivar-php/releases) and include the `init.php`.
```php
require_once('/path/to/ubivar-php/init.php');
```

### Send transactions

```php
\Ubivar\Ubivar::setApiKey('d8e8fca2dc0f896fd7cb4cb0031ba249');
$event              = \Ubivar\Event::create(array(
, "parameters"      => array(
    "firt_name"     => "John"
  , "last_name"     => "Doe"
));
echo $event;
```

## Resources, actions, and arguments 

Every resource is accessed via your `ubivar` instance and accepts an optional
callback as the last argument. In the matrix below we list the resources
(rows), the actions (columns) and the arguments (cells). The full documentation
is available at [https://ubivar.com/docs/php](https://ubivar.com/docs/php). 

| Resource      | C | R | U | D | L | Test Specs |
| ------------- |:-:|:-:|:-:|:-:|:----:|:-------:|:----------:|
| Me            |        |<a href="https://ubivar.com/docs/php#retrieve_your_information">_</a>  |<a href="https://ubivar.com/docs/php#retrieve_your_information">`{}`</a>|        |        | [![](https://status.ubivar.com/ubivar-php/resources/me.svg)](https://github.com/ubivar/ubivar-php/blob/master/tests/MeTest.php) |
| Events        | <a href="https://ubivar.com/docs/php#create_event">`{}`</a>|<a href="https://ubivar.com/docs/php#retrieve_event">id</a>  |<a href="https://ubivar.com/docs/php#update_event">`{}`</a>|<a href="https://ubivar.com/docs/php#delete_event">id</a>|<a href="https://ubivar.com/docs/php#list_events">`{}`</a>| [![](https://status.ubivar.com/ubivar-php/resources/events.svg)](https://github.com/ubivar/ubivar-php/blob/master/tests/EventTest.php)|

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

- Require PHP 5.4 and later.
- Sign up for an account and get an API key at [https://my.ubivar.com](https://my.ubivar.com).
- Set the API access token:
```php
\Ubivar\Ubivar::setApiKey('d8e8fca2dc0f896fd7cb4cb0031ba249');
```

## Development

To run the test suite:
```
cd path/to/ubivar/ubivar-php
composer install 
./vendor/bin/phpunit -v 
```

To report issues: [issues and feature requests](https://github.com/ubivar/ubivar-php/issues)

## Author

Originally inspired from [stripe-php](https://github.com/stripe/stripe-php). Developed and maintained by [Fabrice Colas](https://fabricecolas.me) ([fabrice.colas@gmail.com](mailto:fabrice.colas@gmail.com)) for [Ubivar](https://ubivar.com). 
