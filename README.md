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

|               | Resource                | C | R | U | D | L     | Test Specs |
|--------------:| ----------------------- |:-:|:-:|:-:|:-:|:-----:|:-------:|
| **Settings**  | Auth, Credentials       |   |   |   |   |       | | 
| **Data**      | Event                   | [`{}`](https://ubivar.com/docs/php#create_event)| [`123`](https://ubivar.com/docs/php#retrieve_event) | [`123, {}`](https://ubivar.com/docs/php#update_event) | [`123`](https://ubivar.com/docs/php#delete_event) | [`{}`](https://ubivar.com/docs/php#list_event) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Event/EventTest.php)| 
|               | EventNotification      |  | [`123`](https://ubivar.com/docs/php#retrieve_eventnotification) |  |  | [`{}`](https://ubivar.com/docs/php#list_eventnotification) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Event/EventNotificationTest.php)| 
|               | EventLastId             |  |  |  |  | [`{}`](https://ubivar.com/docs/php#list_eventlastid) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Event/EventLastIdTest.php)| 
|               | EventLabel             | | [`123`](https://ubivar.com/docs/php#retrieve_eventlabel) | [`123, {}`](https://ubivar.com/docs/php#update_eventlabel) | [`123`](https://ubivar.com/docs/php#delete_eventlabel) | [`{}`](https://ubivar.com/docs/php#list_eventlabel) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Event/EventLabelTest.php)| 
|               | EventQueue             | | [`123`](https://ubivar.com/docs/php#retrieve_eventqueue) | [`123, {}`](https://ubivar.com/docs/php#update_eventqueue) | [`123`](https://ubivar.com/docs/php#delete_eventqueue) | [`{}`](https://ubivar.com/docs/php#list_eventqueue) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Event/EventQueueTest.php)| 
|               | EventReview            | | [`123`](https://ubivar.com/docs/php#retrieve_eventreview) | [`123, {}`](https://ubivar.com/docs/php#update_eventreview) | [`123`](https://ubivar.com/docs/php#delete_eventreview) | [`{}`](https://ubivar.com/docs/php#list_eventreview) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Event/EventReviewTest.php)| 
| **Filters** | FilterWhitelist        | [`{}`](https://ubivar.com/docs/php#create_filterwhitelist)| | [`123, {}`](https://ubivar.com/docs/php#update_filterwhitelist) | [`123`](https://ubivar.com/docs/php#delete_filterwhitelist) | [`{}`](https://ubivar.com/docs/php#list_filterwhitelist) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Filter/FilterWhitelistTest.php)| 
|               | FilterBlacklist        |   |  | [`123, {}`](https://ubivar.com/docs/php#update_filterblacklist) |  | [`{}`](https://ubivar.com/docs/php#list_filterblacklist) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Filter/FilterBlacklistTest.php)| 
|               | FilterRulesCustom      | [`{}`](https://ubivar.com/docs/php#create_filterrulescustom)|  |  [`123, {}`](https://ubivar.com/docs/php#update_filterrulescustom)| [`123`](https://ubivar.com/docs/php#delete_filterrulescustom) | [`{}`](https://ubivar.com/docs/php#list_filterrulescustom) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Filter/FilterRulesCustomTest.php)| 
|               | FilterRulesBase         |   |  | [`123, {}`](https://ubivar.com/docs/php#update_filterrulesbase) |  | [`{}`](https://ubivar.com/docs/php#list_filterrulesbase) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Filter/FilterRulesBaseTest.php)| 
|               | FilterRulesAI           |   |  | [`123, {}`](https://ubivar.com/docs/php#update_filterrulesai) |  | [`{}`](https://ubivar.com/docs/php#list_filterrulesai) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Filter/FilterRulesAITest.php)| 
|               | FilterScoringsDedicated |   |  | [`123, {}`](https://ubivar.com/docs/php#update_filterscoringsdedicated) |  | [`{}`](https://ubivar.com/docs/php#list_filterscoringsdedicated) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Filter/FilterScoringsDedicatedTest.php)| 
| **Notifications** | NotifierEmail      | [`{}`](https://ubivar.com/docs/php#create_notifieremail)|  | [`123, {}`](https://ubivar.com/docs/php#update_notifieremail) | [`123`](https://ubivar.com/docs/php#delete_notifieremail) | [`{}`](https://ubivar.com/docs/php#list_notifieremail) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Notifier/NotifierEmailTest.php)| 
|               | NotifierSms             | [`{}`](https://ubivar.com/docs/php#create_notifiersms)|  | [`123, {}`](https://ubivar.com/docs/php#update_notifiersms) | [`123`](https://ubivar.com/docs/php#delete_notifiersms) | [`{}`](https://ubivar.com/docs/php#list_notifiersms) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Notifier/NotifierSmsTest.php)| 
|               | NotifierSlack             | [`{}`](https://ubivar.com/docs/php#create_notifierslack)|  | [`123, {}`](https://ubivar.com/docs/php#update_notifierslack) | [`123`](https://ubivar.com/docs/php#delete_notifierslack) | [`{}`](https://ubivar.com/docs/php#list_notifierslack) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Notifier/NotifierSlackTest.php)| 
|               | NotifierWebhook         | [`{}`](https://ubivar.com/docs/php#create_notifierwebhook)|  | [`123, {}`](https://ubivar.com/docs/php#update_notifierwebhook) | [`123`](https://ubivar.com/docs/php#delete_notifierwebhook) | [`{}`](https://ubivar.com/docs/php#list_notifierwebhook) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Notifier/NotifierWebhookTest.php)| 
|               | NotifierECommerce       |   |  | [`123, {}`](https://ubivar.com/docs/php#update_notifierecommerce) |  | [`{}`](https://ubivar.com/docs/php#list_notifierecommerce) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Notifier/NotifierECommerceTest.php)| 

+ *C*: Create
+ *R*: Retrieve
+ *U*: Update
+ *D*: Delete
+ *L*: List
+ `{}`: JSON with query parameters

## Filter parameters

| Filter        | Default | Example             | Description                   |
| ------------- |:-------:|:--------------------|:------------------------------|
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
- Originally inspired from [stripe-php](https://github.com/stripe/stripe-php). 
- Developed and maintained by Fabrice Colas for [Ubivar](https://ubivar.com). 
