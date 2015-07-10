<?php

// Ubivar singleton
require(dirname(__FILE__) . '/lib/Ubivar.php');

// Utilities
require(dirname(__FILE__) . '/lib/Util/RequestOptions.php');
require(dirname(__FILE__) . '/lib/Util/Set.php');
require(dirname(__FILE__) . '/lib/Util/Util.php');

// Errors
require(dirname(__FILE__) . '/lib/Error/Base.php');
require(dirname(__FILE__) . '/lib/Error/Api.php');
require(dirname(__FILE__) . '/lib/Error/ApiConnection.php');
require(dirname(__FILE__) . '/lib/Error/Authentication.php');
require(dirname(__FILE__) . '/lib/Error/InvalidRequest.php');
require(dirname(__FILE__) . '/lib/Error/RateLimit.php');

// Plumbing
require(dirname(__FILE__) . '/lib/Object.php');
require(dirname(__FILE__) . '/lib/ApiRequestor.php');
require(dirname(__FILE__) . '/lib/ApiResource.php');
require(dirname(__FILE__) . '/lib/SingletonApiResource.php');
require(dirname(__FILE__) . '/lib/AttachedObject.php');

// Ubivar API Resources
require(dirname(__FILE__) . '/lib/Account.php');
require(dirname(__FILE__) . '/lib/Address.php');
require(dirname(__FILE__) . '/lib/Login.php');
require(dirname(__FILE__) . '/lib/Logout.php');
require(dirname(__FILE__) . '/lib/Order.php');
require(dirname(__FILE__) . '/lib/Transaction.php');
require(dirname(__FILE__) . '/lib/Routing.php');
require(dirname(__FILE__) . '/lib/Label.php');
require(dirname(__FILE__) . '/lib/Item.php');
require(dirname(__FILE__) . '/lib/Me.php');
