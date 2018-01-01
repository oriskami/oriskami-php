# Oriskami PHP bindings

[![Build Status](https://travis-ci.org/oriskami/oriskami-php.svg?branch=master)](https://travis-ci.org/oriskami/oriskami-php)
[![Latest Stable Version](https://poser.pugx.org/oriskami/oriskami-php/v/stable.svg)](https://packagist.org/packages/oriskami/oriskami-php)
[![Total Downloads](https://poser.pugx.org/oriskami/oriskami-php/downloads.svg)](https://packagist.org/packages/oriskami/oriskami-php)
[![License](https://poser.pugx.org/oriskami/oriskami-php/license.svg)](https://packagist.org/packages/oriskami/oriskami-php)
[![Code Coverage](https://coveralls.io/repos/oriskami/oriskami-php/badge.png?branch=master)](https://coveralls.io/r/oriskami/oriskami-php?branch=master)

The Oriskami PHP library provides convenient access to the Oriskami API from
applications written in the PHP language. It includes a pre-defined set of
classes for API resources.

## Documentation

See the [Oriskami API docs](https://www.oriskami.com/docs/php).


## Quick Start

You don't need this source code unless you want to modify the package. If you
want to use the package, there are three options:

1. with [Composer](http://getcomposer.org/), add to your `composer.json` the following and run `composer install`.
```js
{ 
  "require": {
    "oriskami/oriskami-php": "*@dev"
  }
}
```
2. with [autoload](https://getcomposer.org/doc/00-intro.md#autoloading), add
```php
require_once('vendor/autoload.php');
```
3. manually download the [latest release](https://github.com/oriskami/oriskami-php/releases) and include the `init.php`.
```php
require_once('/path/to/oriskami-php/init.php');
```

### Requirements

- Php 5.4, 5.5, 5.6, 7.0, 7.1

### Usage 

The library needs to be configured with your API key which is available in [My
Oriskami](https://my.oriskami.com). 

```php

\Oriskami\Oriskami::setApiKey("9spB-ChM6J8NwMEEG ... WsJShd6lVQH7f6xz=");

\Oriskami\Event::create(array(
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

\Oriskami\Event::retrieve("123")
\Oriskami\Event::retrieve("123", array("amount_transport" => "20.00"))
\Oriskami\Event::delete("123")
\Oriskami\Event::all(array("order" => "-id", "limit" => "10"))

# Create, Retrieve, Update, Delete or List Whitelists

\Oriskami\FilterWhitelist::create(array(
    "description" => "Test"
  , "feature" => "email_domain"
  , "is_active" => "true"
  , "value" => "gmail.com"))
\Oriskami\FilterWhitelist::retrieve("0")
\Oriskami\FilterWhitelist::update("0"
  , array(
      "description" => "Test"
    , "feature" => "email_domain"
    , "is_active" => "true"
    , "value" => "yahoo.com"
    ))
\Oriskami\FilterWhitelist::delete("123")
\Oriskami\FilterWhitelist::all()

```

## Resources, actions, and arguments 

The following matrix lists the resources (rows), the CRUD actions (columns) and
the arguments (cells). The cell links point to the API documentation at
[https://oriskami.com/docs/php](https://oriskami.com/docs/php) or to the functional
tests on github.


|               | Resource                | C | R | U | D | L     | Test Specs |
|--------------:| ----------------------- |:-:|:-:|:-:|:-:|:-----:|:-------:|
| **Settings**  | Auth, Credentials       |   |   |   |   |       | | 
| **Data**      | Event                   | [`{}`](https://oriskami.com/docs/php#create_event)| [`123`](https://oriskami.com/docs/php#retrieve_event) | [`123, {}`](https://oriskami.com/docs/php#update_event) | [`123`](https://oriskami.com/docs/php#delete_event) | [`{}`](https://oriskami.com/docs/php#list_event) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Event/EventTest.php)| 
|               | EventNotification      |  | [`123`](https://oriskami.com/docs/php#retrieve_eventnotification) |  |  | [`{}`](https://oriskami.com/docs/php#list_eventnotification) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Event/EventNotificationTest.php)| 
|               | EventLastId             |  |  |  |  | [`{}`](https://oriskami.com/docs/php#list_eventlastid) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Event/EventLastIdTest.php)| 
|               | EventLabel             | | [`123`](https://oriskami.com/docs/php#retrieve_eventlabel) | [`123, {}`](https://oriskami.com/docs/php#update_eventlabel) | [`123`](https://oriskami.com/docs/php#delete_eventlabel) | [`{}`](https://oriskami.com/docs/php#list_eventlabel) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Event/EventLabelTest.php)| 
|               | EventQueue             | | [`123`](https://oriskami.com/docs/php#retrieve_eventqueue) | [`123, {}`](https://oriskami.com/docs/php#update_eventqueue) | [`123`](https://oriskami.com/docs/php#delete_eventqueue) | [`{}`](https://oriskami.com/docs/php#list_eventqueue) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Event/EventQueueTest.php)| 
|               | EventReview            | | [`123`](https://oriskami.com/docs/php#retrieve_eventreview) | [`123, {}`](https://oriskami.com/docs/php#update_eventreview) | [`123`](https://oriskami.com/docs/php#delete_eventreview) | [`{}`](https://oriskami.com/docs/php#list_eventreview) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Event/EventReviewTest.php)| 
| **Filters** | FilterWhitelist        | [`{}`](https://oriskami.com/docs/php#create_filterwhitelist)| | [`123, {}`](https://oriskami.com/docs/php#update_filterwhitelist) | [`123`](https://oriskami.com/docs/php#delete_filterwhitelist) | [`{}`](https://oriskami.com/docs/php#list_filterwhitelist) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Filter/FilterWhitelistTest.php)| 
|               | FilterBlacklist        |   |  | [`123, {}`](https://oriskami.com/docs/php#update_filterblacklist) |  | [`{}`](https://oriskami.com/docs/php#list_filterblacklist) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Filter/FilterBlacklistTest.php)| 
|               | FilterRulesCustom      | [`{}`](https://oriskami.com/docs/php#create_filterrulescustom)|  |  [`123, {}`](https://oriskami.com/docs/php#update_filterrulescustom)| [`123`](https://oriskami.com/docs/php#delete_filterrulescustom) | [`{}`](https://oriskami.com/docs/php#list_filterrulescustom) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Filter/FilterRulesCustomTest.php)| 
|               | FilterRulesBase         |   |  | [`123, {}`](https://oriskami.com/docs/php#update_filterrulesbase) |  | [`{}`](https://oriskami.com/docs/php#list_filterrulesbase) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Filter/FilterRulesBaseTest.php)| 
|               | FilterRulesAI           |   |  | [`123, {}`](https://oriskami.com/docs/php#update_filterrulesai) | [`123`](https://oriskami.com/docs/php#delete_filterrulesai) | [`{}`](https://oriskami.com/docs/php#list_filterrulesai) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Filter/FilterRulesAITest.php)| 
|               | FilterScoringsDedicated |   |  | [`123, {}`](https://oriskami.com/docs/php#update_filterscoringsdedicated) |  | [`{}`](https://oriskami.com/docs/php#list_filterscoringsdedicated) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Filter/FilterScoringsDedicatedTest.php)| 
| **Notifications** | NotifierEmail      | [`{}`](https://oriskami.com/docs/php#create_notifieremail)|  | [`123, {}`](https://oriskami.com/docs/php#update_notifieremail) | [`123`](https://oriskami.com/docs/php#delete_notifieremail) | [`{}`](https://oriskami.com/docs/php#list_notifieremail) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Notifier/NotifierEmailTest.php)| 
|               | NotifierSms             | [`{}`](https://oriskami.com/docs/php#create_notifiersms)|  | [`123, {}`](https://oriskami.com/docs/php#update_notifiersms) | [`123`](https://oriskami.com/docs/php#delete_notifiersms) | [`{}`](https://oriskami.com/docs/php#list_notifiersms) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Notifier/NotifierSmsTest.php)| 
|               | NotifierSlack             | [`{}`](https://oriskami.com/docs/php#create_notifierslack)|  | [`123, {}`](https://oriskami.com/docs/php#update_notifierslack) | [`123`](https://oriskami.com/docs/php#delete_notifierslack) | [`{}`](https://oriskami.com/docs/php#list_notifierslack) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Notifier/NotifierSlackTest.php)| 
|               | NotifierWebhook         | [`{}`](https://oriskami.com/docs/php#create_notifierwebhook)|  | [`123, {}`](https://oriskami.com/docs/php#update_notifierwebhook) | [`123`](https://oriskami.com/docs/php#delete_notifierwebhook) | [`{}`](https://oriskami.com/docs/php#list_notifierwebhook) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Notifier/NotifierWebhookTest.php)| 
|               | NotifierECommerce       |   |  | [`123, {}`](https://oriskami.com/docs/php#update_notifierecommerce) |  | [`{}`](https://oriskami.com/docs/php#list_notifierecommerce) | [See on github](https://github.com/oriskami/oriskami-php/blob/master/tests/Notifier/NotifierECommerceTest.php)| 

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
cd path/to/oriskami/oriskami-php
composer install 
./vendor/bin/phpunit -v 
```

## Issues and feature requests

They are located [here](https://github.com/oriskami/oriskami-php/issues)

## Author
- Originally inspired from [stripe-php](https://github.com/stripe/stripe-php). 
- Developed and maintained by Fabrice Colas for [Oriskami](https://oriskami.com). 
