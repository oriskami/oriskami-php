{
  "name"        : "oriskami/oriskami-php"
, "description" : "Oriskami PHP Library"
, "keywords"    : ["oriskami", "risk", "api"]
, "homepage"    : "https://oriskami.com/"
, "license"     : "MIT"
, "authors"     : [{
    "name"      : "Oriskami and contributors"
  , "homepage"  : "https://github.com/oriskami/oriskami-php/contributors"
}],"require"    : {
    "php": ">=5.3.3"
  , "ext-curl"  : "*"
  , "ext-json"  : "*"
  , "ext-mbstring": "*"
},"require-dev" : {
    "phpunit/phpunit"           : "~4.0"
  , "satooshi/php-coveralls"    : "~0.6.1"
  , "squizlabs/php_codesniffer" : "~2.0"
},"autoload"    : {
  "psr-4"       : { "Oriskami\\" : "lib/" }
},"extra"       : {
  "branch-alias": {
    "dev-master": "2.1-dev"
    }
  }
}
