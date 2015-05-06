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
require(dirname(__FILE__) . '/lib/Resources/Accounts.php');
require(dirname(__FILE__) . '/lib/Resources/Transactions.php');
require(dirname(__FILE__) . '/lib/Resources/Routing.php');
require(dirname(__FILE__) . '/lib/Resources/Labels.php');
require(dirname(__FILE__) . '/lib/Resources/Login.php');
require(dirname(__FILE__) . '/lib/Resources/Logout.php');
require(dirname(__FILE__) . '/lib/Resources/Me.php');
