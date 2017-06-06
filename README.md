# Ubivar PHP bindings

[![Build Status](https://travis-ci.org/ubivar/ubivar-php.svg?branch=master)](https://travis-ci.org/ubivar/ubivar-php)
[![Latest Stable Version](https://poser.pugx.org/ubivar/ubivar-php/v/stable.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![Total Downloads](https://poser.pugx.org/ubivar/ubivar-php/downloads.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![License](https://poser.pugx.org/ubivar/ubivar-php/license.svg)](https://packagist.org/packages/ubivar/ubivar-php)
[![Code Coverage](https://coveralls.io/repos/ubivar/ubivar-php/badge.png?branch=master)](https://coveralls.io/r/ubivar/ubivar-php?branch=master)

The Ubivar PHP library provides convenient access to the Ubivar API from
applications written in the PHP language. It includes a pre-defined set of
classes for API resources.

## Documentation

See the [Ubivar API docs](https://www.ubivar.com/docs/php).


## Quick Start

You don't need this source code unless you want to modify the package. If you
want to use the package, there are three options:

1. with [Composer](http://getcomposer.org/), add to your `composer.json` the following and run `composer install`.
```js
{ 
  "require": {
    "ubivar/ubivar-php": "*@dev"
  }
}
```
2. with [autoload](https://getcomposer.org/doc/00-intro.md#autoloading), add
```php
require_once('vendor/autoload.php');
```
3. manually download the [latest release](https://github.com/ubivar/ubivar-php/releases) and include the `init.php`.
```php
require_once('/path/to/ubivar-php/init.php');
```

### Requirements

- Php 5.4, 5.5, 5.6, 7.0, 7.1

### Usage 

The library needs to be configured with your API key which is available in [My
Ubivar](https://my.ubivar.com). 

```php

\Ubivar\Ubivar::setApiKey("9spB-ChM6J8NwMEEG ... WsJShd6lVQH7f6xz=");

\Ubivar\Event::create(array(
  "id" => "1",
  "parameters"  => array(
    "id"                    => "1",
    "email"                 =>  "abc@gmail.com",
    "names"                 =>  "M Abc",
    "account_creation_time" =>  "2017-05-17 21:50:00",
    "account_id"            =>  "1",
    "account_n_fulfilled"   =>  "1",
    "account_total_since_created" =>  "49.40",
    "account_total_cur"     =>  "EUR",
    "invoice_time"          =>  "2017-05-17 21:55:00",
    "invoice_address_country"=>  "France",
    "invoice_address_place" =>  "75008 Paris",
    "invoice_address_street1"=>  "1 Av. des Champs-Élysées",
    "invoice_name"          =>  "M ABC",
    "invoice_phone1"        =>  "0123456789",
    "invoice_phone2"        =>  null,
    "transport_date"        =>  "2017-05-18 08:00:00",
    "transport_type"        =>  "Delivery",
    "transport_mode"        =>  "TNT",
    "transport_weight"      =>  "9.000",
    "transport_unit"        =>  "kg",
    "transport_cur"         =>  "EUR",
    "delivery_address_country" =>  "France",
    "delivery_address_place"=>  "75008 Paris",
    "delivery_address_street1" =>  "1 Av. des Champs-Élysées",
    "delivery_name"         =>  "M ABC",
    "delivery_phone1"       =>  "0123450689",
    "customer_ip_address"   =>  "1.2.3.4",
    "pmeth_origin"          =>  "FRA",
    "pmeth_validity"        =>  "0121",
    "pmeth_brand"           =>  "MC",
    "pmeth_bin"             =>  "510000",
    "pmeth_3ds"             =>  "-1",
    "cart_products"         => array("Product ref #12345"),
    "cart_details"          => array(
      array(
        "name"              =>  "Product ref #12345",
        "pu"                =>  "10.00",
        "n"                 =>  "1",
        "reimbursed"        =>  " 0",
        "available"         =>  "1",
        "amount"            =>  "10.00",
        "cur"               =>  "EUR"
      )
    ),
    "cart_n"          =>  "15000",
    "order_payment_accepted" =>  "2017-05-17 22:00:00",
    "amount_pmeth"    =>  "ABC Payment Service Provider",
    "amount_discounts"=>  0.00,
    "amount_products" =>  20.00,
    "amount_transport"=>  10.00,
    "amount_total"    =>  30.00,
    "amount_cur"      =>  "EUR"
));


# Retrieve, Update, Delete, or List Events 

\Ubivar\Event::retrieve("123")
\Ubivar\Event::retrieve("123", array("amount_transport" => "20.00"))
\Ubivar\Event::delete("123")
\Ubivar\Event::all(array("order" => "-id", "limit" => "10"))

# Create, Retrieve, Update, Delete or List Whitelists

\Ubivar\FilterWhitelist::create(array(
    "description" => "Test"
  , "feature" => "email_domain"
  , "is_active" => "true"
  , "value" => "gmail.com"))
\Ubivar\FilterWhitelist::retrieve("0")
\Ubivar\FilterWhitelist::update("0"
  , array(
      "description" => "Test"
    , "feature" => "email_domain"
    , "is_active" => "true"
    , "value" => "yahoo.com"
    ))
\Ubivar\FilterWhitelist::delete("123")
\Ubivar\FilterWhitelist::all()

```

## Resources, actions, and arguments 

The following matrix lists the resources (rows), the CRUD actions (columns) and
the arguments (cells). The cell links point to the API documentation at
[https://ubivar.com/docs/php](https://ubivar.com/docs/php) or to the functional
tests on github.


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
|               | FilterRulesAI           |   |  | [`123, {}`](https://ubivar.com/docs/php#update_filterrulesai) | [`123`](https://ubivar.com/docs/php#delete_filterrulesai) | [`{}`](https://ubivar.com/docs/php#list_filterrulesai) | [See on github](https://github.com/ubivar/ubivar-php/blob/master/tests/Filter/FilterRulesAITest.php)| 
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
+ `123`: resource id
+ `{}`: JSON with query parameters

## Filter parameters

| Filter        | Default | Example             | Description                   |
| ------------- |:-------:|:--------------------|:------------------------------|
| `order`       | `id`    | `array("order"=>"-id")`         | Sort by decreasing id |
| `limit`       | `10`    | `array("limit"=>10)`            | At most `10` returned results |
| `gt`          |         | `array("id"=>array("gt"=>10))`  | `id` greater than 10          |
| `gte`         |         | `array("id"=>array("gte"=>10))` | `id` greater than or equal    |
| `lt`          |         | `array("id"=>array("lt"=>10))`  | `id` less than                |
| `lte`         |         | `array("id"=>array("lte"=>10))` | `id` less than or equal       |

## Development

To run the test suite:
```
cd path/to/ubivar/ubivar-php
composer install 
./vendor/bin/phpunit -v 
```

## Issues and feature requests

They are located [here](https://github.com/ubivar/ubivar-php/issues)

## Author
- Originally inspired from [stripe-php](https://github.com/stripe/stripe-php). 
- Developed and maintained by Fabrice Colas for [Ubivar](https://ubivar.com). 
