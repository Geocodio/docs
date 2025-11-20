---
title: Geocodio API Reference

language_tabs:
  - shell: Shell
  - ruby: Ruby
  - python: Python
  - php: PHP
  - javascript: Node

toc_footers:
 - <a href="https://dash.geocod.io">Sign Up for an API Key</a>
 - <a href="https://www.geocod.io/terms-of-use/">Terms of Use</a>
 - <a href="https://github.com/Geocodio/openapi-spec" target="_blank">OpenAPI Spec</a>

search: true

code_clipboard: true
---

# Introduction

Geocodio's RESTful API allows you to perform forward and reverse geocoding lookups as well as simultaneously enrich your address data. Geocodio's API supports individual, batch, and list geocoding.

Data appends (`fields`) include Census geographies and data, electoral districts, timezones, school districts, and more.

The base API url is `https://api.geocod.io/v1.9/`.

All HTTP responses (including errors) are returned with [JSON-formatted](http://www.json.org) output.

We may add additional properties to the output in the future, but existing properties will never be changed or removed without a new API version release.

<aside class="notice">
Note the versioning prefix in the base url, which is required for all requests.
</aside>

# Supported Countries

Geocodio supports geocoding for the United States and Canada only.

## Specifying Country

### Default Behavior
* Individual lookups: Inferred from address format
* Fallback: United States

### Explicit `country` Parameter
```shell
# US address (explicit)
curl "https://api.geocod.io/v1.9/geocode?q=1109+N+Highland+St,+Arlington+VA&country=USA&api_key=YOUR_API_KEY"

# Canadian address (explicit)
curl "https://api.geocod.io/v1.9/geocode?q=525+University+Ave,+Toronto+ON&country=Canada&api_key=YOUR_API_KEY"
```

**Supported Country Values:** USA or Canada

## Address Format Differences

### United States
* State: 2-letter abbreviation (e.g., `VA`, `CA`)
* ZIP Code: 5 or 9 digits (e.g., `22201` or `22201-1234`)

### Canada
* Province: 2-letter abbreviation (e.g., `ON`, `BC`)
* Postal Code FSA: 3 characters with space (e.g., `M5G`)

# Libraries

## Official libraries

These libraries are officially written and maintained by Geocodio. Have an issue? Please email us at support@geocod.io.

GitHub pull requests and issues are also more than welcome.

<table class="table">
  <tbody><tr>
    <th>Platform</th>
    <th>Library</th>
  </tr>
  <tr>
    <td><strong>PHP</strong></td>
    <td><a href="https://github.com/Geocodio/geocodio-library-php" target="_blank">Geocodio/geocodio-library-php</a></td>
  </tr>
  <tr>
    <td><strong>Node.js</strong></td>
    <td><a href="https://github.com/Geocodio/geocodio-library-node" target="_blank">Geocodio/geocodio-library-node</a></td>
  </tr>
    <tr>
    <td><strong>Ruby</strong></td>
    <td><a href="https://github.com/Geocodio/geocodio-gem" target="_blank">Geocodio/geocodio-gem</a></td>
  </tr>
  <tr>
    <td><strong>Python</strong></td>
    <td><a href="https://github.com/Geocodio/geocodio-library-python" target="_blank">Geocodio/geocodio-library-python</a></td>
  </tr>
</tbody></table>

## Third-party libraries

Thanks to the wonderful open-source community, we have language bindings for several additional languages and platforms.

We will do our best to assist via email, but may not be able to help in all cases with these libraries.

Some of the libraries are featured here with basic examples, but please make sure to check out the full documentation for the individual libraries (linked below).

<!--ENTERPRISE
  <aside class="warning">
    Please consult the individual library documentation to ensure that you are using the <strong>api.enterprise.geocod.io</strong> hostname instead of the regular hostname.
  </aside>
ENTERPRISE-->

<table class="table">
  <tbody><tr>
    <th>Platform</th>
    <th>Library</th>
    <th>Featured in documentation</th>
  </tr>
  <tr>
    <td><strong>Ruby</strong></td>
    <td><a href="https://github.com/alexreisner/geocoder" target="_blank">alexreisner/geocoder</a> supports Geocodio thanks to PR by <a href="https://twitter.com/dblockdotorg" target="_blank">@dblockdotorg</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>Ruby</strong></td>
    <td><a href="https://github.com/davidcelis/geocodio" target="_blank">davidcelis/geocodio</a> by <a href="https://twitter.com/davidcelis" target="_blank">@davidcelis</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>Python</strong></td>
    <td><a href="https://github.com/bennylope/pygeocodio" target="_blank">bennylope/pygeocodio</a> by <a href="https://twitter.com/bennylope" target="_blank">@bennylope</a></td>
    <td><i class="fa fa-check"></i></td>
  </tr>
  <tr>
    <td><strong>Clojure</strong></td>
    <td><a href="https://github.com/jboverfelt/rodeo" target="_blank">jboverfelt/rodeo</a> by <a href="https://twitter.com/jboverfelt" target="_blank">@jboverfelt</a></td>
    <td><i class="fa fa-check"></i></td>
  </tr>
  <tr>
    <td><strong>Perl</strong></td>
    <td><a href="https://github.com/mrallen1/WebService-Geocodio" target="_blank">mrallen1/WebService-Geocodio</a> by <a href="https://twitter.com/bytemeorg" target="_blank">@bytemeorg</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>Go</strong></td>
    <td><a href="https://github.com/stevepartridge/geocodio" target="_blank">stevepartridge/geocodio</a> by <a href="https://github.com/stevepartridge" target="_blank">stevepartridge</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>R</strong></td>
    <td><a href="https://github.com/hrbrmstr/rgeocodio" target="_blank">hrbrmstr/rgeocodio</a> by <a href="https://github.com/hrbrmstr" target="_blank">hrbrmstr</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>R</strong></td>
    <td><a href="https://jessecambon.github.io/tidygeocoder" target="_blank">jessecambon/tidygeocoder</a> by <a href="https://github.com/jessecambon" target="_blank">jessecambon</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>C#</strong></td>
    <td><a href="https://github.com/snake-plissken/cSharpGeocodio" target="_blank">snake-plissken/cSharpGeocodio</a> by <a href="https://github.com/snake-plissken" target="_blank">Frank Deasey</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>C#</strong></td>
    <td><a href="https://github.com/arex388/Arex388.Geocodio" target="_blank">arex388/Arex388.Geocodio</a> by <a href="https://github.com/arex388" target="_blank">arex388</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>Rust</strong></td>
    <td><a href="https://github.com/Cosiamo/geocodio_lib_rust" target="_blank">Cosiamo/geocodio_lib_rust</a> by <a href="https://github.com/Cosiamo" target="_blank">Cosiamo</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td><strong>Java</strong></td>
    <td><a href="https://github.com/deansg/jeocodio" target="_blank">deansg/jeocodio</a> by <a href="https://github.com/deansg" target="_blank">Dean Gurvitz</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td colspan="3">Are you the author of a library that you would like to get featured here? Just <a href="mailto:hello@geocod.io">let us know</a> or <a href="https://github.com/geocodio/docs" target="_blank">create a pull request</a>.</td>
  </tr>
</tbody></table>

> Installing the library:

```shell
# Make sure to have `curl` installed to test the API in your terminal
```

```ruby
# Add the following to your Gemfile:
gem 'geocodio-gem'

# And then run:
bundle install
```

```python
pip install geocodio-library-python
```

```php
# Install via Composer
composer require geocodio/geocodio-library-php

<?php
require('vendor/autoload.php');

# Don't fancy Composer? Not a problem!
# Check out our sample code here: https://github.com/Geocodio/php-samples
```

```javascript
# Install via npm
$ npm install --save geocodio-library-node

# Install via Yarn
$ yarn add geocodio-library-node
```


# Authentication

> To set the `API_KEY`:

```shell
# With curl, you can pass the query parameter with each request
curl "https://api.geocod.io/v1.9/api_endpoint_here?api_key=YOUR_API_KEY"

# or use the Authorization header
curl "https://api.geocod.io/v1.9/api_endpoint_here" \
  -H "Authorization: Bearer YOUR_API_KEY"
```

```ruby
require 'geocodio/gem'

geocodio = Geocodio::Gem.new('YOUR_API_KEY')
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")
```

<!--ENTERPRISE
```php
<?php
$geocoder = new Geocodio\Geocodio();
$geocoder->setApiKey('YOUR_API_KEY');
$geocoder->setHostname('api.enterprise.geocod.io');
```
ENTERPRISE-->

<!--DEFAULT
```php
<?php
$geocoder = new Geocodio\Geocodio();
$geocoder->setApiKey('YOUR_API_KEY');
```
DEFAULT-->

<!--DEFAULT
```javascript
const Geocodio = require('geocodio-library-node');
const geocoder = new Geocodio('YOUR_API_KEY');

// You can also leave out the parameter and define the "GEOCODIO_API_KEY" environment variable instead
```
DEFAULT-->

<!--ENTERPRISE
```javascript
const Geocodio = require('geocodio-library-node');
const geocoder = new Geocodio('YOUR_API_KEY', 'api.enterprise.geocod.io');

// You can also leave out the parameters and define the following environment variables instead:
// GEOCODIO_API_KEY=YOUR_API_KEY
// GEOCODIO_HOSTNAME=api.enterprise.geocod.io
```
ENTERPRISE-->


All requests require an API key. You can [register here](https://dash.geocod.io) to get your own API key.

The API key must be included in all requests using the `api_key` query parameter. It is also possible to supply the API key via the `Authorization` header.

Accounts can have multiple API keys. This can be useful if you're working on several projects and want to be able to revoke access using the API key for a single project in the future or if you want to keep track of usage per API key.

You can also download a CSV of usage and fees per API key [on the dashboard](https://dash.geocod.io/usage).

<aside class="warning">
Make sure to replace YOUR_API_KEY with your personal API key found on the <a href="https://dash.geocod.io" target="_blank">Geocodio dashboard</a>.
</aside>

## Using query parameter

The simplest way to authenticate is using the `api_key` query parameter. The API key must be included in all requests using the `&api_key=YOUR_API_KEY` query parameter.

## Using Authorization header

Alternatively, the API key can be supplied via an HTTP request header:

<aside>
  <code>
  Authorization: Bearer YOUR_API_KEY
  </code>
</aside>

<!--ENTERPRISE
<aside class="warning">
When using the List API with Geocodio Enterprise this type of authentication is mandatory.
</aside>
ENTERPRISE-->

# Permissions

> A `403 Forbidden` HTTP status code is returned if the API key is valid, but does not have permission to access the requested endpoint

```json
{
  "error": "This API key does not have permission to access this feature. API key permissions can be changed in the Geocodio dashboard at https:\/\/dash.geocod.io\/apikey"
}
```

Per default, an API key can only access the single and batch geocoding API endpoints. These endpoints are write-only which means that a lost API key can not be used to retrieve geocoded data from your account.

For security reasons, you must specifically enable the [lists API](#geocoding-lists) permissions for your API keys. This can be done on the [Geocodio dashboard](https://dash.geocod.io/apikey). We recommend creating separate API keys for geocoding endpoints and for `GET`/`DELETE` access to lists.

[![List of API key permissions with default values selected](https://www.geocod.io/docs/images/permissions-88aabfa9.png)](https://dash.geocod.io/apikey)

*List of API key permissions with default values selected*

# Overview

The Geocodio API supports three different methods for processing your data. Geocodio is designed to make high-volume geocoding and data enrichment easier, yet we also support real-time single requests. The method you choose will largely depend on your workflow and the amount of addresses or coordinates that you are looking to process.

Single and batch geocoding methods are synchronous, meaning that you have to wait for the data to be fully processed and will receive it directly in your API response. The [list geocoding](#geocoding-lists) method is asynchronous and requires a second request to be made to download the data once it is ready.

Name                                  | Batch size         | Type         | Format           | Supports fields             | Supports forward & reverse geocoding
------------------------------------- | ------------------ | ------------ | ---------------- | --------------------------- | --------------------------------------
[Single geocoding](#geocoding)        | 1                  | Synchronous  | JSON             | <i class="fa fa-check"></i> | <i class="fa fa-check"></i>
[Batch geocoding](#batch-geocoding)   | Up to 10,000       | Synchronous  | JSON             | <i class="fa fa-check"></i> | <i class="fa fa-check"></i>
[List geocoding](#geocoding-lists)    | Up to 10,000,000+  | Asynchronous | CSV/TSV/Excel    | <i class="fa fa-check"></i> | <i class="fa fa-check"></i>

If in doubt, [single geocoding](#geocoding) is the simplest choice for many use cases.

# Geocoding

Geocoding (also known as forward geocoding) allows you to convert one or more addresses into geographic coordinates (i.e. latitude and longitude). Geocoding will also parse the address and append additional information (e.g. if you specify a ZIP code, Geocodio will return the city and state corresponding to the zip code as well)

Geocodio supports geocoding of addresses, cities and ZIP codes in various formats.

<aside class="notice">
Make sure to check the <a href="#address-formats">address formats</a> section for more information on the different address formats supported.
</aside>

Whenever possible, batch requests via the batch or lists endpoints is encouraged since they are significantly faster due to reduced network overhead.

## Single address

Geocodio can geocode a single address by making a `GET` request to the *geocode* endpoint. You can <a href="https://api.geocod.io/v1.9/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a> after creating an API key or via our <a href="https://www.geocod.io/geocode-an-address">demo tool</a>.

<aside class="success">
The <code>results</code> are always ordered with the most accurate locations first. It is therefore always safe to pick the first result in the list.
</aside>

> To geocode a single address:

```shell
# Using q parameter
curl "https://api.geocod.io/v1.9/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY"

# Using individual address components
curl "https://api.geocod.io/v1.9/geocode?street=1109+N+Highland+St&city=Arlington&state=VA&api_key=YOUR_API_KEY"
```

```ruby
require 'geocodio/gem'

geocodio = Geocodio::Gem.new('YOUR_API_KEY')

location = geocodio.geocode(['1109 N Highland St, Arlington VA'])
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

response = client.geocode("1109 N Highland St, Arlington VA")
# Access the first result
print(response.results[0].formatted_address)
print(response.results[0].location.lat)
print(response.results[0].location.lng)
```

```php
<?php
$response = $geocoder->geocode('1109 N Highland St, Arlington VA');
```

```javascript
const Geocodio = require('geocodio-library-node');
const geocoder = new Geocodio('YOUR_API_KEY');

geocoder.geocode('1109 N Highland St, Arlington VA')
  .then(response => {
    console.log(response);
  })
  .catch(err => {
    console.error(err);
  }
);
```


> Example response:

```json
{
  "input": {
    "address_components": {
      "number": "1109",
      "predirectional": "N",
      "street": "Highland",
      "suffix": "St",
      "formatted_street": "N Highland St",
      "city": "Arlington",
      "state": "VA",
      "zip": "22201",
      "country": "US"
    },
    "formatted_address": "1109 N Highland St, Arlington, VA 22201"
  },
  "results": [
    {
      "address_components": {
        "number": "1109",
        "predirectional": "N",
        "street": "Highland",
        "suffix": "St",
        "formatted_street": "N Highland St",
        "city": "Arlington",
        "county": "Arlington County",
        "state": "VA",
        "zip": "22201",
        "country": "US"
      },
      "address_lines": [
        "1109 N Highland St",
        "",
        "Arlington, VA 22201"
      ],
      "formatted_address": "1109 N Highland St, Arlington, VA 22201",
      "location": {
        "lat": 38.886665,
        "lng": -77.094733
      },
      "accuracy": 1,
      "accuracy_type": "rooftop",
      "source": "Virginia GIS Clearinghouse"
    }
  ]
}
```

### HTTP Request

`GET https://api.geocod.io/v1.9/geocode`

### URL Parameters

Parameter | Description
--------- | -----------
`q`       | The query (i.e. address) to geocode
`api_key` | Your Geocodio API key
`country` | Optional parameter. The country to geocode the address in. The default is to infer from the query, with a fallback to USA.
`fields`  | Optional parameter to request [additional data appends](#fields).
`limit`   | Optional parameter. The maximum number of results to return. The default is no limit. If set to 0, no limit will be applied.
`format`  | Optional parameter to change the JSON output format to a different pre-defined structure. Currently, "simple" is the only valid value. If not set, the default full JSON output structure is used.

<!--ENTERPRISE
Parameter | Description
--------- | -----------
`verbose`       | Optional parameter. Available only for enterprise and on-premise customers. Enabling verbose output.
ENTERPRISE-->

***

**Alternative URL Parameters**

Instead of using the *q* parameter, you can use a combination of `street`, `street2`, `city`, `county`, `state`, `postal_code`, and/or `country`.

This is recommended if the address is already parsed into separate fields in your database.

Parameter     | Description
------------- | -----------
`street`      | E.g. 1600 Pennsylvania Ave NW
`street2`     | E.g. Apt 204
`city`        | E.g. Washington
`county`      | E.g. Arlington
`state`       | E.g. DC
`postal_code` | E.g. 20500
`country`     | E.g. Canada (Default to USA)

### The `format` parameter

```ruby
#  To receive a `simple` response, include the string `"simple"`
#  as the fourth argument after any fields or limit parameters
#  you have set.

  require 'geocodio/gem'

  geocodio = Geocodio::Gem.new('YOUR_API_KEY')

  response = geocodio.geocode(["1109 N Highland St, Arlington, VA"], [], nil, "simple")
```

> Example response when `format` is set to `simple`:

```json
{
  "address": "1109 N Highland St, Arlington, VA 22201",
  "lat": 38.886665,
  "lng": -77.094733,
  "accuracy": 1,
  "accuracy_type": "rooftop",
  "source": "Arlington"
}
```

> Example response when `format` is set to `simple` and no results are found:

```json
{
  "address": null,
  "lat": null,
  "lng": null,
  "accuracy": null,
  "accuracy_type": null,
  "source": null
}
```

In most cases, the standard output format would be used. In certain situations, it can however be beneficial to work with a JSON structure that is specifically designed for your use case.

**`simple` format**

When `format` is set to `simple`, a very simple JSON structure is outputted, with only basic information for the best matched results. This makes it much easier to work with the JSON document in situations where extra verbosity is not needed.

The `fields` parameter is still supported when the `simple` output format is selected, but the `limit` parameter has no effect.

<!--ENTERPRISE
### The `verbose` parameter

When including the `verbose` query parameter in your API request, a breakdown of the accuracy score will be returned with each geocoding result. This can be found in the `accuracy_breakdown` JSON key.

This feature is only available for enterprise and on-premises customers.

The accuracy breakdown lists all of the factors used to compute the accuracy score. Each factor has a short description along with a designated category. The following categories are available: `MISC`, `SCORING`, `STATE`, `POSTAL_CODE`, `POSTAL_SERVICE`, `HOUSE_NUMBER`, `ENGINE_CASCADE`, `POINT_GEOCODING_ENGINE`, `RANGE_GEOCODING_ENGINE`, `INTERSECTION_GEOCODING_ENGINE`, `PLACE_GEOCODING_ENGINE`.

Accuracy breakdown descriptions and scores are subject to change and should not be programatically relied upon. Categories can, however, be expected to be consistent.

> Example response with the following query: "1109 Highland St, Arlington, VA 22201" (Directional is missing)


```json
...
"accuracy": 0.9,
"accuracy_type": "rooftop",
"accuracy_breakdown": {
  "Directional was added even though input did not have one": {
    "score": -1,
    "category": "SCORING"
  },
  "Exact USPS match": {
    "score": 0.01,
    "category": "POSTAL_SERVICE"
  }
},
...
```

ENTERPRISE-->

### Geocoding with Unit Numbers

> To geocode an address with a Unit Number

```shell
  curl "https://api.geocod.io/v1.9/geocode?q=2800+Clarendon+Blvd+Suite+R500+Arlington+VA+22201&api_key=YOUR_API_KEY"
```

> Example response with Unit Number

```json
{
  "input": {
    "address_components": {
      "number": "2800",
      "street": "Clarendon",
      "suffix": "Blvd",
      "secondaryunit": "Ste",
      "secondarynumber": "R500",
      "formatted_street": "Clarendon Blvd",
      "city": "Arlington",
      "state": "VA",
      "zip": "22201",
      "country": "US"
    },
    "formatted_address": "2800 Clarendon Blvd, Ste R500, Arlington, VA 22201"
  },
  "results": [
    {
      "address_components": {
        "number": "2800",
        "street": "Clarendon",
        "suffix": "Blvd",
        "secondaryunit": "Ste",
        "secondarynumber": "R500",
        "formatted_street": "Clarendon Blvd",
        "city": "Arlington",
        "county": "Arlington County",
        "state": "VA",
        "zip": "22201",
        "country": "US"
      },
      "address_lines": [
        "2800 Clarendon Blvd",
        "Ste R500",
        "Arlington, VA 22201"
      ],
      "formatted_address": "2800 Clarendon Blvd, Ste R500, Arlington, VA 22201",
      "location": {
        "lat": 38.887455,
        "lng": -77.092018
      },
      "accuracy": 1,
      "accuracy_type": "rooftop",
      "source": "Arlington"
    }
  ]
}
```

If you include an Apartment or Suite number along as a suffix to the street name, we will parse that number and return it as part of your response. It will be broken out into the `secondaryunit` and `secondarynumber` keys within `address_components`.

**For US addresses:** The `secondaryunit` value will be standardized based on USPS records, if the unit number is deemed mailable and valid.

E.g. if the unit number is inputted as `#R500`, the outputted value will be `Ste R500`.

In order to verify that the unit number is valid per USPS, you can request the [`zip4`](#usps-zip-4) field append and check the `exact_match` value. If it is set to `true`, it means that the unit number is recognized by USPS.

### The `input` Object

The `input` object that is returned in the API response is not a one-for-one parsing of the initial address that is provided. In order to ensure that the `address_components` returned in `input` are accurate, we cross-reference them with the `address_components` returned in the `results` object.

As such, if we aren't able to identify the exact address location in `results`, this could impact our ability to return a parsed address in `input`. In the vast majority of cases, the data returned will match the original address provided to the Geocodio API, but there may be some instances where we are not able to parse the exact input - especially in responses with lower `accuracy_type` values like `place` or `street_center`.

## Batch geocoding

> To perform batch geocoding:

```shell
curl -X POST \
  -H "Content-Type: application/json" \
  -d '["1109 N Highland St, Arlington VA", "525 University Ave, Toronto, ON, Canada", "4410 S Highway 17 92, Casselberry FL", "15000 NE 24th Street, Redmond WA", "17015 Walnut Grove Drive, Morgan Hill CA"]' \
  https://api.geocod.io/v1.9/geocode?api_key=YOUR_API_KEY
```

```ruby
require 'geocodio/gem'

geocodio = Geocodio::Gem.new('YOUR_API_KEY')

locations = geocodio.geocode(['1109 N Highland St, Arlington VA', '525 University Ave, Toronto, ON, Canada', '4410 S Highway 17 92, Casselberry FL', '15000 NE 24th Street, Redmond WA', '17015 Walnut Grove Drive, Morgan Hill CA'])

```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

addresses = [
  '1109 N Highland St, Arlington VA',
  '525 University Ave, Toronto, ON, Canada',
  '4410 S Highway 17 92, Casselberry FL',
  '15000 NE 24th Street, Redmond WA',
  '17015 Walnut Grove Drive, Morgan Hill CA'
]

response = client.geocode(addresses)
# Results are returned in the same order as the input
for result in response.results:
    if result.response.results:
        print(result.response.results[0].formatted_address)
```

```php
<?php
$addresses = [
  '1109 N Highland St, Arlington VA',
  '525 University Ave, Toronto, ON, Canada',
  '4410 S Highway 17 92, Casselberry FL',
  '15000 NE 24th Street, Redmond WA',
  '17015 Walnut Grove Drive, Morgan Hill CA'
];
$response = $geocoder->geocode($addresses);
```

```javascript
const Geocodio = require('geocodio-library-node');
const geocoder = new Geocodio('YOUR_API_KEY');

const addresses = [
  '1109 N Highland St, Arlington VA',
  '525 University Ave, Toronto, ON, Canada',
  '4410 S Highway 17 92, Casselberry FL',
  '15000 NE 24th Street, Redmond WA',
  '17015 Walnut Grove Drive, Morgan Hill CA'
];

geocoder.geocode(addresses)
  .then(response => {
    console.log(response);
  })
  .catch(err => {
    console.error(err);
  }
);
```


> Example response:

```json
{
  "results": [
    {
      "query": "1109 N Highland St, Arlington VA",
      "response": {
        "input": {
          "address_components": {
            "number": "1109",
            "predirectional": "N",
            "street": "Highland",
            "suffix": "St",
            "formatted_street": "N Highland St",
            "city": "Arlington",
            "state": "VA",
            "country": "US"
          },
          "formatted_address": "1109 N Highland St, Arlington, VA"
        },
        "results": [
          {
            "address_components": {
              "number": "1109",
              "predirectional": "N",
              "street": "Highland",
              "suffix": "St",
              "formatted_street": "N Highland St",
              "city": "Arlington",
              "county": "Arlington County",
              "state": "VA",
              "zip": "22201",
              "country": "US"
            },
            "address_lines": [
              "1109 N Highland St",
              "",
              "Arlington, VA 22201"
            ],
            "formatted_address": "1109 N Highland St, Arlington, VA 22201",
            "location": {
              "lat": 38.886672,
              "lng": -77.094735
            },
            "accuracy": 1,
            "accuracy_type": "rooftop",
            "source": "Arlington"
          },
          {
            "address_components": {
              "number": "1109",
              "predirectional": "N",
              "street": "Highland",
              "suffix": "St",
              "formatted_street": "N Highland St",
              "city": "Arlington",
              "county": "Arlington County",
              "state": "VA",
              "zip": "22201",
              "country": "US"
            },
            "address_lines": [
              "1109 N Highland St",
              "",
              "Arlington, VA 22201"
            ],
            "formatted_address": "1109 N Highland St, Arlington, VA 22201",
            "location": {
              "lat": 38.886665,
              "lng": -77.094733
            },
            "accuracy": 1,
            "accuracy_type": "rooftop",
            "source": "Virginia Geographic Information Network (VGIN)"
          }
        ]
      }
    },
    {
      "query": "525 University Ave, Toronto, ON, Canada",
      "response": {
        "input": {
          "address_components": {
            "number": "525",
            "street": "University",
            "suffix": "Ave",
            "formatted_street": "University Ave",
            "city": "Toronto",
            "state": "ON",
            "country": "CA"
          },
          "formatted_address": "525 University Ave, Toronto, ON"
        },
        "results": [
          {
            "address_components": {
              "number": "525",
              "street": "University",
              "suffix": "Ave",
              "formatted_street": "University Ave",
              "city": "Toronto",
              "state": "ON",
              "country": "CA"
            },
            "address_lines": [
              "525 University Ave",
              "",
              "Toronto, ON M5G"
            ],
            "formatted_address": "525 University Ave, Toronto, ON",
            "location": {
              "lat": 43.656258,
              "lng": -79.388223
            },
            "accuracy": 1,
            "accuracy_type": "rooftop",
            "source": "City of Toronto Open Data"
          }
        ]
      }
    },
    ...
  ]
}
```

If you have multiple addresses that you need to geocode, we recommend using Geocodio's batch geocoding endpoints. This will save you time as it removes the overhead of having to perform multiple `HTTP` requests.

Batch geocoding requests can be performed by making a `POST` request to the *geocode* endpoint, supplying a `JSON` array, or a `JSON` object in the body with any key of your choosing.

<aside class="warning">
You can process up to 10,000 lookups at a time with the batch endpoint. Field appends count as lookups, so geocoding 5,000 addresses with the `census` field append would be a total of 10,000 lookups. Geocoding 10,000 lookups takes about 600 seconds, so please make sure to adjust your timeout value accordingly. For large lists, consider using the lists API.
</aside>

### Understanding Lookup Counts

Each address counts as one lookup, and each field append counts as an additional lookup per address.

**Lookup Calculation Formula:**
```
Total Lookups = Number of Addresses × (1 + Number of Fields)
```

**Examples within the 10,000 limit:**

* ✅ 10,000 addresses, no fields = 10,000 lookups
* ✅ 5,000 addresses, 1 field = 10,000 lookups (5,000 × 2)
* ✅ 2,500 addresses, 3 fields = 10,000 lookups (2,500 × 4)
* ✅ 2,000 addresses, 4 fields = 10,000 lookups (2,000 × 5)

**Examples exceeding the limit:**

* ❌ 10,000 addresses, 1 field = 20,000 lookups (exceeds limit)
* ❌ 6,000 addresses, 2 fields = 18,000 lookups (exceeds limit)

<aside class="warning">
Plan your batch requests carefully when using field appends. If you need to process more than 10,000 lookups, split your request into multiple batches or use the <a href="#geocoding-lists">lists API</a> instead.
</aside>

### HTTP Request

`POST https://api.geocod.io/v1.9/geocode`

### URL Parameters

Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
`fields`  | Optional parameter to request [additional field appends](#fields).
`limit`   | Optional parameter. The maximum number of results to return. The default is no limit. If set to 0, no limit will be applied.

### JSON array/object
When making a batch geocoding request, you can `POST` queries as either a JSON array or a JSON object. If a JSON object is posted, you can specify a custom key for each element of your choice. This can be useful to match queries up with your existing data after the request is complete.

If using a JSON array, results are **guaranteed** to be returned in the same order as they are requested.

You can also use the alternative parameters with batch geocoding; just pass an associative array instead of a string for each address.

Here's a couple of examples of what the `POST` body can look like:

### JSON array
<pre class="inline">
[
  "1109 N Highland St, Arlington VA",
  "525 University Ave, Toronto, ON, Canada",
  "4410 S Highway 17 92, Casselberry FL",
  "15000 NE 24th Street, Redmond WA",
  "17015 Walnut Grove Drive, Morgan Hill CA"
]
</pre>

> Example response when POST'ing JSON object:

```json
{
  "results": {
    "FID1": {
      "query": "1109 N Highland St, Arlington VA",
      "response": {
        "input": {
          "address_components": {
            "number": "1109",
            "predirectional": "N",
            "street": "Highland",
            "suffix": "St",
            "formatted_street": "N Highland St",
            "city": "Arlington",
            "state": "VA",
            "country": "US"
          },
          "formatted_address": "1109 N Highland St, Arlington, VA"
        },
        "results": [
          {
            "address_components": {
              "number": "1109",
              "predirectional": "N",
              "street": "Highland",
              "suffix": "St",
              "formatted_street": "N Highland St",
              "city": "Arlington",
              "county": "Arlington County",
              "state": "VA",
              "zip": "22201",
              "country": "US"
            },
            "address_lines": [
              "1109 N Highland St",
              "",
              "Arlington, VA 22201"
            ],
            "formatted_address": "1109 N Highland St, Arlington, VA 22201",
            "location": {
              "lat": 38.886672,
              "lng": -77.094735
            },
            "accuracy": 1,
            "accuracy_type": "rooftop",
            "source": "Arlington"
          }
        ]
      }
    },
    "FID2": {
     ...
    },
    "FID3": {
     ...
    },
    "FID4": {
     ...
    },
    "FID5": {
     ...
    }
  }
}
```

### JSON object
<pre class="inline">
{
  "FID1": "1109 N Highland St, Arlington VA",
  "FID2": "525 University Ave, Toronto, ON, Canada",
  "FID3": "4410 S Highway 17 92, Casselberry FL",
  "FID4": "15000 NE 24th Street, Redmond WA",
  "FID5": "17015 Walnut Grove Drive, Morgan Hill CA"
}
</pre>

### JSON object with parameters
<pre class="inline">
{
  "1": {
    "street": "1109 N Highland St",
    "city": "Arlington",
    "state": "VA"
  },
  "2": {
    "city": "Toronto",
    "country": "CA"
  }
}
</pre>

### Accepted Address Components

When supplying an address as individual components (instead of a single string) you can use a combination of `street`, `street2`, `city`, `county`, `state` `postal_code`, and/or `country`.

This is recommended if the address is already stored as separate fields on your end.

Parameter     | Description
------------- | -----------
`street`      | E.g. 1600 Pennsylvania Ave NW
`street2`     | E.g. Apt 204
`city`        | E.g. Washington
`county`      | E.g. Arlington
`state`       | E.g. DC
`postal_code` | E.g. 20500
`country`     | E.g. Canada (Default to USA)

# Reverse Geocoding

Reverse geocoding is the process of converting latitude and longitude into a street address.

Geocodio will find matching street(s) and determine the correct house number based on the location. Note that Geocodio does not guarantee to return a valid house number; it is our closest approximation.

As with forward geocoding, you can either geocode a single set of coordinates at the time or collect multiple coordinates in batches. You can batch reverse geocode up to 10,000 coordinates at a time.

This endpoint can return up to 5 possible matches ranked and ordered by an [accuracy score](#accuracy-score).

<aside class="success">
A geographic coordinate consists of latitude followed by longitude separated by a comma, for example <code>38.9002898,-76.9990361</code>
</aside>

## Reverse geocoding single coordinate

> To reverse geocode a single coordinate:

```shell
curl "https://api.geocod.io/v1.9/reverse?q=38.9002898,-76.9990361&api_key=YOUR_API_KEY"
```

```ruby
require 'geocodio/gem'

geocodio = Geocodio::Gem.new('YOUR_API_KEY')

addresses = geocodio.reverse(['38.9002898,-76.9990361'])
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

response = client.reverse("38.9002898,-76.9990361")
# Or using a tuple
# response = client.reverse((38.9002898, -76.9990361))

# Access the first result
print(response.results[0].formatted_address)
```

```php
<?php
$response = $geocoder->reverse('38.9002898,-76.9990361');
```

```javascript
const Geocodio = require('geocodio-library-node');
const geocoder = new Geocodio('YOUR_API_KEY');

geocoder.reverse('38.9002898,-76.9990361')
  .then(response => {
    console.log(response);
  })
  .catch(err => {
    console.error(err);
  }
);
```


> Example response:

```json
{
  "results": [
    {
      "address_components": {
        "number": "508",
        "street": "H",
        "suffix": "St",
        "postdirectional": "NE",
        "formatted_street": "H St NE",
        "city": "Washington",
        "county": "District of Columbia",
        "state": "DC",
        "zip": "20002",
        "country": "US"
      },
      "address_lines": [
        "508 H St NE",
        "",
        "Washington, DC 20002"
      ],
      "formatted_address": "508 H St NE, Washington, DC 20002",
      "location": {
        "lat": 38.900432,
        "lng": -76.999031
      },
      "accuracy": 1,
      "accuracy_type": "rooftop",
      "source": "City of Washington"
    },
    {
      "address_components": {
        "number": "510",
        "street": "H",
        "suffix": "St",
        "postdirectional": "NE",
        "formatted_street": "H St NE",
        "city": "Washington",
        "county": "District of Columbia",
        "state": "DC",
        "zip": "20002",
        "country": "US"
      },
      "address_lines": [
        "510 H St NE",
        "",
        "Washington, DC 20002"
      ],
      "formatted_address": "510 H St NE, Washington, DC 20002",
      "location": {
        "lat": 38.900429,
        "lng": -76.998965
      },
      "accuracy": 0.9,
      "accuracy_type": "rooftop",
      "source": "City of Washington"
    },
    ...
  ]
}
```

A single coordinate can be reverse geocoded by making a simple `GET` request to the *reverse* endpoint, you can <a href="https://api.geocod.io/v1.9/reverse?q=38.9002898,-76.9990361&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

### HTTP Request

`GET https://api.geocod.io/v1.9/reverse`

### URL Parameters

Parameter | Description
--------- | -----------
`q`       | The query (i.e. latitude/longitude pair) to geocode. The coordinate pair should be comma-separated
`api_key` | Your Geocodio API key
`fields`  | Optional parameter to request [additional field appends](#fields).
`limit`   | Optional parameter. The maximum number of results to return. The default is no limit. If set to 0, no limit will be applied.
`format`  | Optional parameter to change the JSON output format to a different pre-defined structure. Currently, "simple" is the only valid value. If not set, the default full JSON output structure is used.

### The `format` parameter

```ruby
#  To receive a `simple` response, include the string `"simple"`
#  as the fourth argument after any fields or limit parameters
#  you have set.

  require 'geocodio/gem'

  geocodio = Geocodio::Gem.new('YOUR_API_KEY')

  response = geocodio.reverse(["38.9002898,-76.9990361"], [], nil, "simple")
```

> Example response, when `format` is set to `simple`:

```json
{
  "address": "508 H St NE, Washington, DC 20002",
  "lat": 38.900432,
  "lng": -76.999031,
  "accuracy": 1,
  "accuracy_type": "rooftop",
  "source": "Statewide"
}
```

> Example response, when `format` is set to `simple` and no results are found:

```json
{
  "address": null,
  "lat": null,
  "lng": null,
  "accuracy": null,
  "accuracy_type": null,
  "source": null
}
```

In most cases, the standard output format would be used. In certain situations, it can however be beneficial to work with a JSON structure that is specifically designed for your use case.

**`simple` format**

When `format` is set to `simple`, a very simple JSON structure is outputted, with only basic information for the best matched results. This makes it much easier to work with the JSON document in situations where extra verbosity is not needed.

The `fields` parameter is still supported when the `simple` output format is selected, but the `limit` parameter has no effect.


## Batch reverse geocoding

> To perform batch reverse geocoding:

```shell
curl -X POST \
  -H "Content-Type: application/json" \
  -d '["35.9746000,-77.9658000","32.8793700,-96.6303900","33.8337100,-117.8362320","35.4171240,-80.6784760"]' \
  https://api.geocod.io/v1.9/reverse?api_key=YOUR_API_KEY
```

```ruby
require 'geocodio/gem'

geocodio = Geocodio::Gem.new('YOUR_API_KEY')

address_sets = geocodio.reverse(['35.9746000,-77.9658000', '32.8793700,-96.6303900', '33.8337100,-117.8362320', '35.4171240,-80.6784760'])
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

coordinates = [
  "35.9746000,-77.9658000",
  "32.8793700,-96.6303900",
  "33.8337100,-117.8362320",
  "35.4171240,-80.6784760"
]
# Or using tuples
# coordinates = [
#   (35.9746000, -77.9658000),
#   (32.8793700, -96.6303900),
#   (33.8337100, -117.8362320),
#   (35.4171240, -80.6784760),
# ]

response = client.reverse(coordinates)
# Results are returned in the same order as the input
for result in response.results:
    if result.response.results:
        print(result.response.results[0].formatted_address)
```

```php
<?php
$coordinates = [
  '35.9746000,-77.9658000',
  '32.8793700,-96.6303900',
  '33.8337100,-117.8362320',
  '35.4171240,-80.6784760'
];
$results = $geocoder->reverse($coordinates);
```

```javascript
const Geocodio = require('geocodio-library-node');
const geocoder = new Geocodio('YOUR_API_KEY');

const coordinates = [
  '35.9746000,-77.9658000',
  '32.8793700,-96.6303900',
  '33.8337100,-117.8362320',
  '35.4171240,-80.6784760'
];

geocoder.reverse(coordinates)
  .then(response => {
    console.log(response);
  })
  .catch(err => {
    console.error(err);
  }
);
```


> Example response (shortened for brevity):

```json
{
  "results": [
    {
      "query": "35.9746000,-77.9658000",
      "response": {
        "results": [
          {
            "address_components": {
              "number": "101",
              "predirectional": "W",
              "street": "Washington",
              "suffix": "St",
              "formatted_street": "W Washington St",
              "city": "Nashville",
              "county": "Nash County",
              "state": "NC",
              "zip": "27856",
              "country": "US"
            },
            "address_lines": [
              "101 W Washington St",
              "",
              "Nashville, NC 27856"
            ],
            "formatted_address": "101 W Washington St, Nashville, NC 27856",
            "location": {
              "lat": 35.974357,
              "lng": -77.966064
            },
            "accuracy": 1,
            "accuracy_type": "rooftop",
            "source": "NC Geographic Information Coordinating Council"
          }
        ]
      }
    },
    {
      "query": "32.8793700,-96.6303900",
      "response": {
        "results": [
          {
            "address_components": {
              "number": "3034",
              "predirectional": "S",
              "street": "1st",
              "suffix": "St",
              "formatted_street": "S 1st St",
              "city": "Garland",
              "county": "Dallas County",
              "state": "TX",
              "zip": "75041",
              "country": "US"
            },
            "address_lines": [
              "3034 S 1st St",
              "",
              "Garland, TX 75041"
            ],
            "formatted_address": "3034 S 1st St, Garland, TX 75041",
            "location": {
              "lat": 32.879386,
              "lng": -96.630471
            },
            "accuracy": 1,
            "accuracy_type": "rooftop",
            "source": "City of Garland"
          },
          ...
        ]
      }
    },
    ...
  ]
}
```

If you have several coordinates that you need to reverse geocode, batch reverse geocoding is a much faster option since it removes the overhead of having to perform multiple `HTTP` requests.

Batch reverse geocoding requests are performed by making a `POST` request to the *reverse* endpoint, supplying a `JSON` array in the body.

<aside class="warning">
You can batch reverse geocode up to 10,000 coordinates at a time. Field appends count as lookups as well, make sure to keep the overall number of lookups at 10,000 or below.
</aside>

### HTTP Request

`POST https://api.geocod.io/v1.9/reverse`

### URL Parameters

Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
`fields`  | Optional parameter to request [additional field appends](#fields).
`limit`   | Optional parameter. The maximum number of results to return. The default is no limit. If set to 0, no limit will be applied.


# Geocoding lists

Geocodio's lists API lets you geocode CSV, TSV, Excel, and other forms of spreadsheets with addresses or coordinates. Similar to the [spreadsheet geocoding tool](https://www.geocod.io/upload/), the spreadsheet will be processed as a job on Geocodio's infrastructure and can be downloaded later. While a spreadsheet is being, processed it is possible to query the status and progress.

<aside class="warning">
Data for spreadsheets processed through the lists API is automatically deleted 72 hours after processing completes. In addition to a 1GB file size limit, we recommend a maximum of 10M lookups per list batch. Larger batches should be split up into multiple list jobs.
</aside>

<!--ENTERPRISE
<aside class="warning">
When using the List API with Geocodio Enterprise, you must send the API key as a Bearer token in the Authorization header.

<br /><br />
<code>
Authorization: Bearer YOUR_API_KEY
</code>
</aside>
ENTERPRISE-->

## Create a new list

> Create a new list from a file called "[sample_list.csv](https://www.geocod.io/sample_list.csv)"

<!--DEFAULT
```shell
curl "https://api.geocod.io/v1.9/lists?api_key=YOUR_API_KEY" \
  -F "file"="@sample_list.csv" \
  -F "direction"="forward" \
  -F "format"="{{A}} {{B}} {{C}} {{D}}" \
  -F "callback"="https://example.com/my-callback"
```
DEFAULT-->
<!--ENTERPRISE
```shell
curl "https://api.geocod.io/v1.9/lists \
  -H "Authorization: Bearer YOUR_API_KEY" \
  -F "file"="@sample_list.csv" \
  -F "direction"="forward" \
  -F "format"="{{A}} {{B}} {{C}} {{D}}" \
  -F "callback"="https://example.com/my-callback"
```
ENTERPRISE-->

```ruby
  require 'geocodio/gem'

  geocodio = Geocodio::Gem.new('YOUR_API_KEY')

  response = geocodio.createList(File.read("sample_list_test.csv"), "sample_list_test.csv", "forward", "{{A}} {{B}} {{C}} {{D}}")
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

# Create a list from a CSV file
with open('sample_list.csv', 'rb') as file:
    response = client.create_list(
        file=file,
        filename='sample_list.csv',
        direction='forward',
        format='{{A}} {{B}} {{C}} {{D}}',
        callback='https://example.com/my-callback'  # Optional
    )
    list_id = response.id
```

```php
<?php

$response = $geocoder->uploadList(
    file: 'sample_list_test.csv',
    direction: GeocodeDirection::Forward,
    format: '{{B}} {{C}} {{D}} {{E}}',
    callbackWebhook: 'https://example.com/callbacks/list-upload',
);
```


```javascript
  const Geocodio = require('geocodio-library-node');
  const geocoder = new Geocodio('YOUR_API_KEY');

  geocoder.list.create(
  `${__dirname}/stubs/sample_list.csv`,
  "forward",
  "{{A}} {{B}} {{C}} {{D}}",
  "https://example.com/my-callback"
  )
```

> Create a new list from inline data

<!--DEFAULT
```shell
curl "https://api.geocod.io/v1.9/lists?api_key=YOUR_API_KEY" \
  -F "file"=$'Zip\n20003\n20001' \
  -F "filename"="file.csv" \
  -F "direction"="forward" \
  -F "format"="{{A}}" \
  -F "callback"="https://example.com/my-callback"
```
DEFAULT-->
<!--ENTERPRISE
```shell
curl "https://api.geocod.io/v1.9/lists" \
  -H "Authorization: Bearer YOUR_API_KEY" \
  -F "file"=$'Zip\n20003\n20001' \
  -F "filename"="file.csv" \
  -F "direction"="forward" \
  -F "format"="{{A}}" \
  -F "callback"="https://example.com/my-callback"
```
ENTERPRISE-->

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

# Upload a list from inline data
csv_data = """Zip
20003
20001"""

response = client.create_list(
    file=csv_data.encode('utf-8'),
    filename='file.csv',
    direction='forward',
    format='{{A}}',
    callback='https://example.com/my-callback'  # Optional
)
list_id = response.id
```

```php
<?php

// Upload a list from inline data
$csvData = <<<'CSV'
name,street,city,state,zip
"Peregrine Espresso","660 Pennsylvania Ave SE",Washington,DC,20003
"Lot 38 Espresso Bar","1001 2nd St SE",Washington,DC,20003
CSV;

$geocodio->uploadInlineList(
    $csvData,
    'coffee-shops.csv',
    GeocodeDirection::Forward,
    '{{B}} {{C}} {{D}} {{E}}'
);
```

> Example response:

```json
{
    "id": 48,
    "file":
    {
        "headers":
        [
            "address",
            "city",
            "state",
            "zip"
        ],
        "estimated_rows_count": 24,
        "filename": "sample_list.csv"
    }
}
```

Creates a new spreadsheet list job and starts processing the list in the background. The response returns a list id that can be used to retrieve the job progress as well as download the processed list when it has completed.

### HTTP Request

`POST https://api.geocod.io/v1.9/lists`

### URL Parameters

<!--DEFAULT
Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
`fields`  | Optional parameter to request [additional field appends](#fields)
DEFAULT-->
<!--ENTERPRISE
Parameter | Description
--------- | -----------
`fields`  | Optional parameter to request [additional field appends](#fields)
ENTERPRISE-->

### Data Parameters

Parameter   | Description
----------- | -----------
`file`      | The file to geocoded, can be uploaded as a form-data file or sent inline
`filename`  | Only required if file contents are sent inline, file extension is used to determine file format so it can be processed correctly. Valid file formats include csv, tsv, xls, xlsx. A zip file can also be uploaded, it needs to contain exactly one file of the supported extensions
`direction` | Can either be `forward` for address to coordinate geocoding or `reverse` for coordinate to address geocoding
`format`    | A template for how addresses or coordinates should be read from the spreadsheet, see more below
`callback`  | Optional. A valid URL that a webhook should be sent to upon completion of the spreadsheet geocoding job


### `format` syntax

The `format` parameter uses a simple templating syntax that is used to construct a full address or coordinate for geocoding. A column can be referenced by its letter, encapsulated in double curly brackets, e.g. `{{A}}`.

**Examples:***

* The full address can be found in column `A`: `{{A}}`
* The street addresses are in column `A` and the zip codes are in column `D`: `{{A}} {{D}}`
* Street addresses are column `A`. They are all located in Washington D.C: `{{A}} Washington DC`
* The spreadsheet has a list of Canadian addresses with street addreses in column `A`, city name in column `B` and province name in column `C`: `{{A}} {{B}} {{C}} Canada`
* For reverse geocoding, latitude is in column `A` and longitude in column `B`: `{{A}},{{B}}`

### Callback

> Example webhook `POST` data

```json
{
    "id": 49,
    "fields": ["cd"],
    "file": {
        "geocoded_rows_count": 39809,
        "filename": "sample_list.csv"
    },
    "download_url": "https://api.geocod.io/v1.9/lists/49/download"
}
```

The callback url is an optional method to receive a notification when a spreadsheet geocoding job has completed.

The webhook is sent as a `POST` request, it needs to be publicly accessible and the URL is served over HTTPS, the SSL certificate has to be valid and active.
A total of 3 attempts are made to delivery the webhook.

## See list status

> Show status for list id 42

<!--DEFAULT
```shell
curl "https://api.geocod.io/v1.9/lists/42?api_key=YOUR_API_KEY"
```
DEFAULT-->
<!--ENTERPRISE
```shell
curl "https://api.geocod.io/v1.9/lists/42" \
  -H "Authorization: Bearer YOUR_API_KEY"
```
ENTERPRISE-->

```ruby
  require 'geocodio/gem'
  geocodio = Geocodio::Gem.new('YOUR_API_KEY')

  response = geocodio.getList(42)
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

# Get status of a list
response = client.get_list(42)
print(response.status.state)  # 'PROCESSING' or 'COMPLETED'
print(response.status.progress)  # Progress percentage
```

```php
<?php

$response = $geocoder->listStatus(42);
```


```javascript
  const Geocodio = require('geocodio-library-node');
  const geocoder = new Geocodio('YOUR_API_KEY');

  geocoder.list.status(42)
  .then(response => { ... })
  .catch(err => { ... });
```

> Example response (list that just started processing)

```json
{
    "id": 42,
    "fields": [],
    "file": {
        "estimated_rows_count": 39809,
        "filename": "bigger_list.csv"
    },
    "status": {
        "state": "PROCESSING",
        "progress": 1,
        "message": "Processing",
        "time_left_description": "Estimating time to complete",
        "time_left_seconds": null
    },
    "download_url": null,
    "expires_at": "2021-09-23T18:23:29.000000Z"
}

```

> Example response (list that is currently processing)

```json
{
    "id": 42,
    "fields": [],
    "file": {
        "estimated_rows_count": 39809,
        "filename": "bigger_list.csv"
    },
    "status": {
        "state": "PROCESSING",
        "progress": 12.82,
        "message": "Geocoding",
        "time_left_description": "17 min. left",
        "time_left_seconds": 1072
    },
    "download_url": null,
    "expires_at": "2021-09-23T18:23:29.000000Z"
}

```

> Example response (list that has been fully processed):

```json
{
    "id": 42,
    "fields": [],
    "file": {
        "estimated_rows_count": 39809,
        "filename": "bigger_list.csv"
    },
    "status": {
        "state": "COMPLETED",
        "progress": 100,
        "message": "Completed",
        "time_left_description": null,
        "time_left_seconds": null
    },
    "download_url": "https://api.geocod.io/v1.9/lists/42/download",
    "expires_at": "2021-09-23T18:23:29.000000Z"
}
```

View the metadata and status for a single uploaded list.

### HTTP Request

`GET https://api.geocod.io/v1.9/lists/LIST_ID`

### URL Parameters

<!--DEFAULT
Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
`page`    | The page number to show
DEFAULT-->
<!--ENTERPRISE
Parameter | Description
--------- | -----------
`page`    | The page number to show
ENTERPRISE-->

## Show all lists

> Show all lists

<!--DEFAULT
```shell
curl "https://api.geocod.io/v1.9/lists?api_key=YOUR_API_KEY"
```
DEFAULT-->
<!--ENTERPRISE
```shell
curl "https://api.geocod.io/v1.9/lists" \
  -H "Authorization: Bearer YOUR_API_KEY"
```
ENTERPRISE-->

```ruby
  require 'geocodio/gem'
  geocodio = Geocodio::Gem.new('YOUR_API_KEY')

  response = geocodio.getAllLists
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

# Get all lists
response = client.get_all_lists()
for list_item in response.data:
    print(f"List {list_item.id}: {list_item.file.filename} - {list_item.status.state}")
```

```php
<?php

$response = $geocoder->lists();
```


```javascript
  const Geocodio = require('geocodio-library-node');
  const geocoder = new Geocodio('YOUR_API_KEY');

  geocoder.list.all()
  .then(response => { ... })
  .catch(err => { ... });
```
> Example response:

```json
{
    "current_page": 1,
    "data":
    [
        {
            "id": 48,
            "fields":
            [],
            "file":
            {
                "estimated_rows_count": 24,
                "filename": "sample_list.csv"
            },
            "status":
            {
                "state": "COMPLETED",
                "progress": 100,
                "message": "Completed",
                "time_left_description": null,
                "time_left_seconds": null
            },
            "download_url": "https://api.geocod.io/v1.9/lists/48/download",
            "expires_at": "2021-09-23T12:09:09.000000Z"
        },
        ...
    ],
    "first_page_url": "https://api.geocod.io/v1.9/lists?page=1",
    "from": 1,
    "next_page_url": "https://api.geocod.io/v1.9/lists?page=2",
    "path": "https://api.geocod.io/v1.9/lists",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15
}
```

Show all lists that have been created. The endpoint is paginated, showing 15 lists at a time, ordered by recency.

### HTTP Request

`GET https://api.geocod.io/v1.9/lists`

### URL Parameters

<!--DEFAULT
Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
DEFAULT-->

## Download a list

<!--DEFAULT
```shell
curl -L "https://api.geocod.io/v1.9/lists/LIST_ID/download?api_key=YOUR_API_KEY"
```
DEFAULT-->
<!--ENTERPRISE
```shell
curl -L "https://api.geocod.io/v1.9/lists/LIST_ID/download" \
  -H "Authorization: Bearer YOUR_API_KEY"
```
ENTERPRISE-->

```ruby
  require 'geocodio/gem'
  geocodio = Geocodio::Gem.new('YOUR_API_KEY')

  response = geocodio.downloadList(42)
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

# Download a completed list
csv_content = client.download_list(42)
# Save to file
with open('geocoded_results.csv', 'w') as f:
    f.write(csv_content)
```

```php
<?php

$response = $geocoder->downloadList(42, 'path/to/file.csv');
```


```javascript
  const Geocodio = require('geocodio-library-node');
  const geocoder = new Geocodio('YOUR_API_KEY');

  geocoder.list.download(42, "geocoded_file.csv")
   .then(response => { ...})
   .catch(err => { ... });
```

> Example response:

```csv
address,city,state,zip,Latitude,Longitude,"Accuracy Score","Accuracy Type",Number,Street,"Unit Type","Unit Number",City,State,County,Zip,Country,Source
"660 Pennsylvania Ave SE",Washington,DC,20003,38.885172,-76.996565,1,rooftop,660,"Pennsylvania Ave SE",,,Washington,DC,"District of Columbia",20003,US,Statewide
"1718 14th St NW",Washington,DC,20009,38.913274,-77.032266,1,rooftop,1718,"14th St NW",,,Washington,DC,"District of Columbia",20009,US,Statewide
"1309 5th St NE",,,20002,38.908724,-76.997653,0.9,rooftop,1309,"5th St NE",,,Washington,DC,"District of Columbia",20002,US,Statewide
"2150 P St NW",,,20037,38.90948,-77.048527,1,rooftop,2150,"P St NW",,,Washington,DC,"District of Columbia",20037,US,Statewide
"201 F Street NE",,,20002,38.897139,-77.003286,0.9,rooftop,201,"F St NE",,,Washington,DC,"District of Columbia",20002,US,Statewide
"1001 2nd St SE",,,20003,38.877737,-77.003695,1,rooftop,1001,"2nd St SE",,,Washington,DC,"District of Columbia",20003,US,Statewide
"1645 Wisconsin Avenue NW",Washington,DC,20007,38.911626,-77.065281,1,rooftop,1645,"Wisconsin Ave NW",,,Washington,DC,"District of Columbia",20007,US,Statewide
"820 East Baltimore Street",Baltimore,MD,21202,39.290427,-76.60485,1,rooftop,820,"E Baltimore St",,,Baltimore,MD,"Baltimore City",21202,US,"City of Baltimore"
"800 F St NW",Washington,DC,20001,38.896987,-77.023286,1,rooftop,800,"F St NW",,,Washington,DC,"District of Columbia",20004,US,Statewide
"700 Constitution Avenue NW",Washington,DC,20565,38.892228,-77.0219,0.9,range_interpolation,700,"Constitution Ave NW",,,Washington,DC,"District of Columbia",20002,US,"TIGER/Line® dataset from the US Census Bureau"
"1123 Pennsylvania Ave SE",Washington,DC,20003,38.882097,-76.990714,1,rooftop,1123,"Pennsylvania Ave SE",,,Washington,DC,"District of Columbia",20003,US,Statewide
"621 Pennsylvania Ave SE",Washington,DC,20003,38.884906,-76.997682,1,rooftop,621,"Pennsylvania Ave SE",,,Washington,DC,"District of Columbia",20003,US,Statewide
"1702 G Street NW",Washington,DC,20006,38.89816,-77.039982,1,rooftop,1702,"G St NW",,,Washington,DC,"District of Columbia",20006,US,Statewide
"701 8th St SE",Washington,DC,20003,38.881115,-76.995245,1,rooftop,701,"8th St SE",,,Washington,DC,"District of Columbia",20003,US,Statewide
"12187 Darnestown Rd",Gaithersburg,MD,20878,39.118169,-77.251699,1,rooftop,12187,"Darnestown Rd",,,Gaithersburg,MD,"Montgomery County",20878,US,Montgomery
"4961 Elm Street",Bethesda,MD,,38.982196,-77.098161,1,rooftop,4961,"Elm St",,,Bethesda,MD,"Montgomery County",20814,US,Montgomery
"3064 Mount Pleasant St NW",Washington,DC,,38.92846,-77.037509,1,rooftop,3064,"Mt Pleasant St NW",,,Washington,DC,"District of Columbia",20009,US,Statewide
"1052 Thomas Jefferson Street NW",Washington,DC,,38.903887,-77.060437,1,rooftop,1052,"Thomas Jefferson St NW",,,Washington,DC,"District of Columbia",20007,US,Statewide
"475 H St NW",Washington,DC,,38.900078,-77.018645,1,rooftop,475,"H St NW",,,Washington,DC,"District of Columbia",20001,US,Statewide
"1301 U St NW",Washington,DC,,38.917294,-77.03052,1,rooftop,1301,"U St NW",,,Washington,DC,"District of Columbia",20009,US,Statewide
"1726 20th Street, NW",Washington,DC,,38.913694,-77.045095,1,rooftop,1726,"20th St NW",,,Washington,DC,"District of Columbia",20009,US,Statewide
"1916 I Street, NW",Washington,DC,,38.90115,-77.044172,1,rooftop,1916,"I St NW",,,Washington,DC,"District of Columbia",20006,US,Statewide
"107 Church St NE",Vienna,VA,,38.902565,-77.265693,1,rooftop,107,"Church St NE",,,Vienna,VA,"Fairfax County",22180,US,Fairfax
"4817 Bethesda Ave",Bethesda,MD,20814,38.981067,-77.096506,1,rooftop,4817,"Bethesda Ave",,,Bethesda,MD,"Montgomery County",20814,US,Montgomery
```

> Example response (trying to download a list that is still processing):

```json
{
    "message": "List is still processing",
    "success": false
}

```

Download a fully geocoded list, the returned format will always be a UTF-8 encoded, comma-separated csv file.

The response may be a `Redirect` HTTP header, so it is important to configure your HTTP client to follow redirects.

See our [spreadsheet output guide](/guides/data-matching-overview/) for a reference of the outputted columns.

### HTTP Request

`GET https://api.geocod.io/v1.9/lists/LIST_ID/download`

### URL Parameters

<!--DEFAULT
Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
DEFAULT-->

## Delete a list

<!--DEFAULT
```shell
curl -X DELETE "https://api.geocod.io/v1.9/lists/LIST_ID?api_key=YOUR_API_KEY"
```
DEFAULT-->
<!--ENTERPRISE
```shell
curl -X DELETE "https://api.geocod.io/v1.9/lists/LIST_ID" \
  -H "Authorization: Bearer YOUR_API_KEY"
```
ENTERPRISE-->

```ruby
  require 'geocodio/gem'
  geocodio = Geocodio::Gem.new('YOUR_API_KEY')

  response = geocodio.deleteList(42)
```

```python
from geocodio import Geocodio

client = Geocodio("YOUR_API_KEY")

# Delete a list
response = client.delete_list(42)
print(response.success)  # True if successful
```

```php
<?php

$response = $geocoder->deleteList(42);
```


```javascript
  const Geocodio = require('geocodio-library-node');
  const geocoder = new Geocodio('YOUR_API_KEY');

  geocoder.list.delete(42)
  .then(response => { ... })
  .catch(err => { ... });
```

> Example response:

```json
{
  "success": true
}
```

Delete a previously uploaded list and its underlying spreadsheet data permanently. This can also be used to cancel and delete a spreadsheet that is currently processing.

Geocodio Unlimited customers can cancel a spreadsheet at any time. Pay as You Go customers can only cancel a spreadsheet if it was just recently started.

The spreadsheet data will always be deleted automatically after 72 hours if it is not deleted manually first.

### HTTP Request

`DELETE https://api.geocod.io/v1.9/lists/LIST_ID`

### URL Parameters

<!--DEFAULT
Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
DEFAULT-->

# Data Appends (fields)

<!--FIELD:us:cd,stateleg-->

<aside class="warning">
<strong>Note:</strong> Fields count as an additional lookup each. Please consult our <a href="/pricing/">pricing calculator</a>.
</aside>

Geocodio allows you to request additional data with forward and reverse geocoding requests. We call this additional data *fields*.

To request additional data, just add a `fields` parameter to your query string and set the value according to the table below. You can request multiple data fields at the same time by separating them with a comma. If the `fields` parameter has been specified, a new `fields` key is exposed with each geocoding result containing all necessary data for each field.

Go ahead, <a href="https://api.geocod.io/v1.9/geocode?q=1109+N+Highland+St%2c+Arlington+VA&fields=cd&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

Some fields are specific to the US and cannot be queried for other countries.

| Parameter name                                                                                                                                                                                                                                       | Description                                                | Coverage                    |
|:-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|:-----------------------------------------------------------|:----------------------------|
| [cd, cd113, cd114, cd115, cd116, cd117, cd118, cd119, cd120](#congressional-districts)                                                                                                                                                               | Congressional District & Legislator information            | US-only                     |
| [stateleg, stateleg-next](#state-legislative-districts)                                                                                                                                                                                              | State Legislative District (House & Senate) & Legislator information                | US-only                     |
| [school](#school-districts)                                                                                                                                                                                                                          | School District (elementary/secondary or unified)          | US-only                     |
| [census, census2000, census2010, census2011, census2012, census2013, census2014, census2015, census2016, census2017, census2018, census2019, census2020, census2021, census2022, census2023, census2024](#census-blocktract-fips-codes-msacsa-codes) | Census Block/Tract, FIPS codes & MSA/CSA codes             | US-only                     |
| [acs-demographics](#census-demographics)                                                                                                                                                                                                             | Demographics (Census)                                      | US-only                     |
| [acs-economics](#census-income)                                                                                                                                                                                                                      | Economics: Income Data (Census)                            | US-only                     |
| [acs-families](#census-households)                                                                                                                                                                                                                   | Families (Census)                                          | US-only                     |
| [acs-housing](#census-housing)                                                                                                                                                                                                                       | Housing (Census)                                           | US-only                     |
| [acs-social](#social-education-veteran-status-census)                                                                                                                                                                                                | Social: Education & Veteran Status (Census)                | US-only                     |
| [zip4](#usps-zip-4)                                                                                                                                                                                                                                  | USPS Zip+4 code and delivery information                   | US-only                     |
| [ffiec](#ffiec-fair-lending)                                                                                                                                                                                                                         | (Beta) FFIEC CRA/HMDA Data                                 | US-only                     |
| [riding](#riding-canadian-federal-electoral-district)                                                                                                                                                                                                | Riding: Canadian Federal Electoral District                | Canada-only                 |
| [provriding, provriding-next](#riding-canadian-provincial-electoral-district)                                                                                                                                                                        | Riding: Canadian Provincial/Territorial Electoral District | Canada-only                 |
| [statcan](#canadian-statistical-boundaries-from-statistics-canada)                                                                                                                                                                                   | Canadian statistical boundaries from Statistics Canada     | Canada-only                 |
| [timezone](#timezone)                                                                                                                                                                                                                                | Timezone                                                   | <i class="fa fa-globe"></i> |

<aside class="success">
This feature is available for both single and batch geocoding requests as well as the lists API
</aside>

## Congressional Districts
**Field name: `cd`, `cd113`, `cd114`, `cd115`, `cd116`, `cd117`, `cd118`, `cd119`, `cd120`**

<!--FIELD:us:cd-->

Geocodio can return the Congressional district and Representative/Senator information for an address or coordinate pair via any one of the valid parameter names in the `fields` query parameter. `cd` will always return the Congressional district for the current Congress, while e.g. `cd113` will continue to show the Congressional district for the 113th Congress.

The field returns the full name of the Congressional district, the district number, the Congress number, and the year range. If the current Congress (i.e. `cd` or `cd119`) is specified, Geocodio will also return detailed information about the current legislators.

<aside class="success">
The list of legislators is always ordered with the Representative first then Senators.
</aside>

<aside class="notice">
Per U.S. Census Bureau specifications, the following rules apply:<br />
States with a single Congressional district return a special "district_number" of 0 (i.e. Vermont).<br />
Districts with non-voting delegates return a special "district_number" of 98 (i.e. Washington DC).
</aside>

### OCD Identifiers

[Open Civic Data Division Identifiers](https://github.com/opencivicdata/ocd-division-ids) (OCD-IDs) are returned for each district when using `cd119` or `cd120`.

This ID can be used as a unique identifier for each district. You can see the full list of districts returned by Geocodio and their corresponding OCD-IDs [here.](https://www.geocod.io/guides/ocd-ids/)

When requesting boundaries for other congressional periods, the `ocd_id` property is still present, but set to `null`.

### Look up Congressional districts with ZIP codes

Geocodio can return the most likely Congressional districts given a ZIP code. In cases where there may be multiple possible Congressional districts for a ZIP code, we will return multiple Congressional districts, and rank them each using a `proportion` key. This key is a decimal percentage representation of how much of the district boundary that intersect with the ZIP code boundary (i.e., a bigger number means it's more likely to be the correct district for residents in that ZIP code).

Districts are always sorted by the `proportion` value in descending order (largest first).

<aside class="notice">
  Where possible, we recommend looking up Congressional districts with full addresses rather than ZIP codes. This will result in more accurate results, as ZIP codes are postal routes rather than geographic areas and may not be as accurate.
</aside>

## State Legislative Districts
**Field name: `stateleg` or `stateleg-next`**

<!--FIELD:us:stateleg-->

Geocodio can return the state legislative districts and legislator information for an address or coordinate pair via `stateleg` in the `fields` query parameter.

The `stateleg-next` append can be used to retrieve state legislative districts based on upcoming district changes due to redistricting.

The field will return both the *house* and *senate* state legislative districts (also known as *lower* and *upper*) with the full name and district number for each. For areas with a [unicameral legislature](http://en.wikipedia.org/wiki/Unicameralism), such as Washington DC and Nebraska, the `house` and `senate` keys return the same district.

Geocodio will also return current state legislator names, contact information, and more. For districts or states with at-large legislature (such as Washington DC and Puerto Rico), the at-large legislators are returned for all districts, but they are returned last. See more details on the legislator biographical and contact information Geocodio returns [here.](https://www.geocod.io/guides/state-legislative-districts/)

### Using `stateleg-next`

`stateleg-next` is a preview of upcoming redistricting changes for states that have off-year elections.

Where available, the state legislative district returned will be based on newly redistricted boundaries.

<!--
The following states are affected. Redistricted boundaries will be returned with the `stateleg` data append, after the noted cut-off date. Until then, `stateleg-next` is needed to retrieve districts based on redistricted boundaries.

If new boundaries are not available, the current boundaries are used instead (effectively returning the same data as when the `stateleg` field append is used). The `is_upcoming_state_legislative_district` indicates whether redistricted data is returned.
-->

<!--FIELD:us:stateleg-next-->

### OCD Identifiers

[Open Civic Data Division Identifiers](https://github.com/opencivicdata/ocd-division-ids) (OCD-IDs) are returned for all legislative districts.

This ID can be used as a unique identifier for each district. You can see the full list of districts returned by Geocodio and their corresponding OCD-IDs [here.](https://www.geocod.io/guides/ocd-ids/)

> Example lookup using the `22206` zip code instead of a full address

```json
...
"fields": {
  "state_legislative_districts": {
    "house": [
      {
        "name": "State House District 49",
        "district_number": "49",
        "ocd_id": "ocd-division/country:us/state:va/sldl:49",
        "is_upcoming_state_legislative_district": false,
        "proportion": 0.532
      },
      {
        "name": "State House District 45",
        "district_number": "45",
        "ocd_id": "ocd-division/country:us/state:va/sldl:45",
        "is_upcoming_state_legislative_district": false,
        "proportion": 0.453
      },
      {
        "name": "State House District 46",
        "district_number": "46",
        "ocd_id": "ocd-division/country:us/state:va/sldl:46",
        "is_upcoming_state_legislative_district": false,
        "proportion": 0.015
      }
    ],
    "senate": [
      {
        "name": "State Senate District 30",
        "district_number": "30",
        "ocd_id": "ocd-division/country:us/state:va/sldu:30",
        "is_upcoming_state_legislative_district": false,
        "proportion": 1
      }
    ]
  }
}
...
```

### Look up state legislative districts with ZIP codes

Geocodio can return the most likely state legislative districts given a ZIP code. In cases where there may be multiple possible state legislative districts for a ZIP code, we will return multiple state legislative districts, and rank them each using a `proportion` key. This key is a decimal percentage representation of how much of the district boundary that intersect with the ZIP code boundary (i.e., bigger number = more likely to be the correct district for residents in that ZIP code).

Districts are always sorted by the `proportion` in descending order (largest first).

<aside class="notice">
  Where possible, we recommend looking up state legislative districts with full addresses rather than ZIP codes. This will result in more accurate results, as ZIP codes are postal routes rather than geographic areas and may not be as accurate.
</aside>

## School Districts
**Field name: `school`**

<!--FIELD_SIMPLE:us:school-->

> Unified school district example

```json
...
"fields": {
  "school_districts": {
    "unified": {
      "name": "Desert Sands Unified School District",
      "lea_code": "11110",
      "grade_low": "KG",
      "grade_high": "12"
    }
  },
}
...
```

> Elementary/Secondary school districts example

```json
...
"fields": {
  "school_districts": {
      "elementary": {
        "name": "Topsfield School District",
        "lea_code": "11670",
        "grade_low": "PK",
        "grade_high": "06"
      },
      "secondary": {
        "name": "Masconomet School District",
        "lea_code": "07410",
        "grade_low": "07",
        "grade_high": "12"
      }
    }
  }
}
...
```
Geocodio can return the school district for an address or coordinate using `school` in the `fields` query parameter.

The field will return either a *unified* school district or separate *elementary* and *secondary* fields depending on the area. Each school district is returned with its full name, the LEA (Local Education Agency) code, and the grades supported. Kindergarden is abbreviated as *KG* and pre-kindergarten is abbreviated as *PK*.


## Census Block/Tract, FIPS codes & MSA/CSA codes
**Field name: `census`, `census2000`, `census2010`, `census2011`, `census2012`, `census2013`, `census2014`, `census2015`, `census2016`, `census2017`, `census2018`, `census2019`, `census2020`, `census2021`, `census2022`, `census2023`, `census2024`**

<!--FIELD:us:census2010,census-->

Geocodio can append various US Census-designated geographies to an address or coordinate pair, including Census Tract, Census Block, FIPS codes, MSAs/CSAs, and more. Geographies are available back to 2010 as well as 2000.

<aside class="notice">
Looking for Canadian Census data? See the <a href="#canadian-statistical-boundaries-from-statistics-canada"><code>statcan</code></a> field append.
</aside>

Geocodio can provide vintage Census geographies for every year back to the 2010 Census. You can do this by specifying the year together with the field name, such as `census2015` for 2015 data. It is also possible to request multiple years at the same time, such as `census2010,census` (as shown in the example response).

Geographies for the 2000 Census are available as well using the `census2000` field append. Note that only County, Place, Tract and Block FIPS codes are returned for year 2000.

<aside class="warning">
If no year is specified, the API will default to the most recent Census. Currently, 2024 data is returned when appending the cCnsus field.
</aside>

Field        | Description
------------ | -----------------------------------------------------------
census_year  | The full year that the Census data belongs to (The U.S. Census Bureau might make slight boundary changes from year to year)
state_fips   | The two-digit state FIPS code. A full list is available on [Wikipedia](https://en.wikipedia.org/wiki/Federal_Information_Processing_Standard_state_code)
county_fips  | The five-digit county FIPS code. The two first digits represents the state. A full list of US counties is available on [Wikipedia](https://en.wikipedia.org/wiki/List_of_United_States_counties_and_county_equivalents)
tract_code   | The 6-digit census tract code. This is a subdivision of a county, used for statistical purposes.
block_code   | The full 4-digit block code that the location belongs to. This is the smallest geographical unit that the U.S. Census Bureau provides statistical data for.
block_group  | The single-digit group number for the block
full_fips  | The full 15-digit fips code, consisting of the county fips, tract code and block code

The U.S. Census Bureau also provides a more [detailed guide](https://www.census.gov/geo/reference/gtc/gtc_ct.html) for the above terms.

Using Census tracts and blocks, you can match addresses and latitude/longitude pairs with statistical data from the U.S. Census Bureau. For example, appending Census tracts and blocks enables you to utilize the [American Community Survey (ACS) data](https://www.census.gov/programs-surveys/acs/data.html).

### Place

This field is returned for locations that are within a Census-designated place. If the location is not in a Census-designated place, the API will return `null` instead of the individual fields.

You can read more about [Census-designated places on Wikipedia](https://en.wikipedia.org/wiki/Census-designated_place).

Field        | Description
------------ | -----------------------------------------------------------
name         | The official Census-designated name for the place
fips         | The 7-digit place FIPS code. A place is defined as a city or other census designated area. A full list of ANSI codes is available from the [U.S. Census Bureau](https://www.census.gov/geo/reference/codes/place.html)

### Metropolitan/Micropolitan Statistical Area (MSA)

This field is returned for locations that are within an MSA area. If no MSA area is associated with the location, the API will return `null` instead of the individual fields.

You can read more about [Metropolitan](https://en.wikipedia.org/wiki/Metropolitan_statistical_area) and [Micropolitan](https://en.wikipedia.org/wiki/Micropolitan_statistical_area) areas on Wikipedia.

Field        | Description
------------ | -----------------------------------------------------------
name         | The official Census-designated name for the area
area_code    | Unique code for the area, also known as the CBSA code
type         | Can either be "metropolitan" or "micropolitan"

### Combined Statistical Area (CSA)

This field is returned for locations that are within an CSA area. If no CSA area is associated with the location, the API will return `null` instead of the individual fields.

You can read more about [Combined Statisical Areas on Wikipedia](https://en.wikipedia.org/wiki/Combined_statistical_area).

Field        | Description
------------ | -----------------------------------------------------------
name         | The official Census-designated name for the area
area_code    | Unique census-defined code for the area

### Metropolitan Divisions (METDIV)

This field is returned for locations that are within a Metropolitan Division. If no area is associated with the location, the API will return `null` instead of the individual fields.

Metropolitan Divisions was introduced by the U.S. Census Bureau in 2003 to further split larger MSA's (Metropolitan Statistical Areas) into smaller groups.

You can read more about [Metropolitan divisions on Wikipedia](https://simple.wikipedia.org/wiki/United_States_metropolitan_area).

Field        | Description
------------ | -----------------------------------------------------------
name         | The official Census-designated name for the area
area_code    | Unique census-defined code for the area

### County Subdivisions

Depending on the state, this is either a [MCD (Minor Civil Division)](https://en.wikipedia.org/wiki/Minor_civil_division) or [CCD (Census County Division)](https://en.wikipedia.org/wiki/Census_county_division).

Field        | Description
------------ | -----------------------------------------------------------
name         | The name of the county subdivision. Depending on the state, this could be a city/town/township name or a district number
fips         | Unique census-defined code for the area
fips_class   | The `class_code` and `description` for the given [class code](https://www.census.gov/library/reference/code-lists/class-codes.html)

## Census ACS (American Community Survey)

Geocodio helps you retrieve statistics from the American Community Survey for any US address or coordinate pair.

We've organized the ACS results into 5 helpful categories: [Demographics](/#census-demographics), [Economics (Income Data)](/#census-income), [Families](/#census-households), [Housing](#census-housing) and [Social (Education & Veteran Status)](#social-education-veteran-status-census).

### Pricing

When planning your project, each category counts as an additional lookup for billing purposes. As a bonus, the basic `census` field comes included with any `acs-` field lookups *at no additional cost*.

### Geographies

<!--FIELD:us:acs-demographics-county-->

<!--FIELD:us:acs-demographics-tract-->

Geocodio can return ACS data at several geographic levels:

| Name                                       | API Name             |
|--------------------------------------------|----------------------|
| Census Block Group                         | `block_group`        |
| Census Tract                               | `tract`              |
| Census Place                               | `place`              |
| County Subdivision                         | `county_subdivision` |
| County                                     | `county`             |
| Census Metropolitan Statistical Area (MSA) | `msa`                |
| State                                      | `state`              |

To request ACS data for a specific geography, simply append the ACS field name with the **API Name** for the geography. For example, to get ACS demographic data for an address at the County level, you would request `acs-demographics-county`.

If you request an ACS field without specifying a geography, Geocodio will select the most appropriate geography based on your geocoding result:

| Census Geography   | [Accuracy Type](#accuracy-score)                                                                                      |
|--------------------|-----------------------------------------------------------------------------------------------------------------------|
| Census Block Group | `rooftop`, `range_interpolation`, `nearest_street`, `point`, `nearest_rooftop_match`, `street_center`, `intersection` |
| Census Place       | `nearest_place`, `place`                                                                                              |
| County             | `county`                                                                                                              |
| State              | `state`                                                                                                               |

### Metadata

> ACS overall metadata:

```json
...
"fields": {
  "acs": {
    "meta": {
      "source": "American Community Survey from the US Census Bureau",
      "survey_years": "2019-2023",
      "survey_duration_years": "5"
    },
    ...
  }
}
```

> Individual ACS table result metadata:

```json
...
"Median age": {
  "meta": {
    "table_id": "B01002",
    "universe": "Total population"
   },
   ...
}

> Individual ACS field metadata:

```json
"fields": {
  "acs": {
    "housing": {
      ...
      "meta": {
        "geography": "block_group"
      }
    },
    ...
  }
}
```

A `meta` field with high level data information is returned for all `acs` results in general as well as individual ACS appends and individual ACS values.

This contains information about the exact ACS results Geocodio is returning, including the Census years covered and the corresponding geography level. Geocodio always uses 5-year estimates, and always uses the most recent data that is available.

For each individual result, Geocodio returns the [official ACS table id](https://www.census.gov/programs-surveys/acs/library/handbooks/summary-file.html) as well as the "universe" that the values covers.

The universe can be values such as `Households`, `Population 15 Years and Older`, `Total population`, etc.

## Census: Demographics
**Field name: `acs-demographics`**

<!--FIELD:us:acs-demographics-->

Geocodio provides the data exactly as it is packaged by the Census Bureau in the breakouts it gives. The only change we have made is to add a "percentage" calculation to aid ease of use.

The data returned includes the following data points. For each data point, the data returned includes the value, margin of error, and percentage.

* Total (Table #B01002)
  * total, male, female
* Population by age range (Table #B01001)
  * Broken out by male and female
  * under 5 years, 5-9 years, 10-14 years, 15-17 years, 18-19 years, 20 years, 21 years, 22-24 years, 25-29 years, 30-34 years, 35-39 years, 40-44 years, 45-49 years, 50-54 years, 55-59 years, 60-64 years, 65-69 years, 70-74 years, 75-79 years, 80-84 years, 85 years and over
* Sex (Table $B01001)
  * total, male, female
* Race and ethnicity (Table #B03002)
  * Broken out by not-Hispanic or Latino and Hispanic or Latino
  * Not Hispanic or Latino, white alone, black or African American alone, American Indian and Alaska Native alone, Asian alone, Native Hawaiian and Other Pacific Islander alone; some other race alone; two or more races; two or more races: two races including some other race; two or more races: two races excluding some other race, and three or more races

<aside class="notice">
We recognize that age, sex, gender, race and ethnicity are sensitive subjects. Accordingly, we return the categories exactly as the Census Bureau provides. We recognize that the categories listed may not be all-inclusive or use preferred terminology.
</aside>

## Census: Income
**Field name: `acs-economics`**

<!--FIELD:us:acs-economics-->


We provide the data exactly as it is packaged by the Census Bureau in the breakouts it gives. The only change we have made is to add a "percentage" calculation to aid ease of use.

The data returned includes the following data points. For each data point, the data returned includes the value, margin of error, and percentage.

* Median household income (Table #B19013)
* Household income (Table #B19001)
  * less than $10,000; $10,000-$14,999; $15,000-$19,999; $20,000-$24,999; $25,000-$29,999; $30,000-$34,999; $40,000-$44,999; $45,000-$49,999; $50,000-$59,000; $60,000-$74,999; $75,000-$99,999; $100,000-$124,999; $125,000-$149,000; $150,000-$199,999; $200,000 or more
* Per capita income (Table #B19301)

## Census: Households
**Field name: `acs-families`**

<!--FIELD:us:acs-families-->

We provide the data exactly as it is packaged by the Census Bureau in the breakouts it gives. The only change we have made is to add a "percentage" calculation to aid ease of use.

The data returned includes the following data points. For each data point, the data returned includes the value, margin of error, and percentage.

* Family households (Table #B11001)
  * total; married-couple family; other family; other family: male householder, no wife present; other family: female householder, no husband present; non-family households; non-family households -- householder living alone; non-family households -- householder not living alone
* Household type by population (Table #B11002)
  * total; in family households; in married-couple family; in married-couple family: relatives; in married-couple family: non-relatives; in male householder, no spouse present, family; in male householder, no spouse present, family: relatives; in male householder, no spouse present, family: nonrelatives; in female householder, no spouse present, family; in female householder, no spouse present, family: relatives; in female householder, no spouse present, family: in nonfamily households
* Marital status (Table #B12001)
  * never married; now married; now married: married, spouse present; married, spouse absent; married, spouse absent: separated; married, spouse absent: other; married, spouse absent, widowed; married, spouse absent, divorced; male never married; female never married
* Family Type by Presence and Age of Own Children Under 18 Years (Table #B11003)
  * total; married-couple family; married-couple family: with own children of the householder under 18 years; married-couple family: with own children of the householder under 18 years: under 6 years only; married-couple family: with own children of the householder under 18 years: under 6 years and 6 to 17 years; married-couple family: with own children of the householder under 18 years: 6 to 17 years only; married-couple family: no own children of the householder under 18 years; other family; other family: male householder, no spouse present; other family: male householder, no spouse present: with own children of the householder under 18 years; other family: male householder, no spouse present: with own children of the householder under 18 years: under 6 years only; other family: male householder, no spouse present: with own children of the householder under 18 years: under 6 years and 6 to 17 years; other family: male householder, no spouse present: with own children of the householder under 18 years: 6 to 17 years only; other family: male householder, no spouse present: no own children of the householder under 18 years; other family: female householder, no spouse present; other family: female householder, no spouse present: with own children of the householder under 18 years; other family: female householder, no spouse present: with own children of the householder under 18 years: under 6 years only; other family: female householder, no spouse present: with own children of the householder under 18 years: under 6 years and 6 to 17 years; other family: female householder, no spouse present: with own children of the householder under 18 years: 6 to 17 years only; other family: female householder, no spouse present: no own children of the householder under 18 years
* Average Household Size of Occupied Housing Units by Tenure (Table #B25010)
  * total; owner occupied; renter occupied
* Own Children Under 18 Years by Family Type and Age (Table #B09002)
  * total; in married-couple families; in married-couple families: under 3 years; in married-couple families: 3 and 4 years; in married-couple families: 5 years; in married-couple families: 6 to 11 years; in married-couple families: 12 to 17 years; in other families; in other families: male householder, no spouse present; in other families: male householder, no spouse present: under 3 years; in other families: male householder, no spouse present: 3 and 4 years; in other families: male householder, no spouse present: 5 years; in other families: male householder, no spouse present: 6 to 11 years; in other families: male householder, no spouse present: 12 to 17 years; in other families: female householder, no spouse present; in other families: female householder, no spouse present: under 3 years; in other families: female householder, no spouse present: 3 and 4 years; in other families: female householder, no spouse present: 5 years; in other families: female householder, no spouse present: 6 to 11 years; in other families: female householder, no spouse present: 12 to 17 years


<aside class="notice">
We recognize that household composition is a sensitive subject. Accordingly, we report the categories exactly as the Census Bureau provides. We recognize that the categories listed may not be all-inclusive or use preferred terminology.
</aside>

## Census: Housing
**Field name: `acs-housing`**

<!--FIELD:us:acs-housing-->

We provide the data exactly as it is packaged by the Census Bureau in the breakouts it gives. The only change we have made is to add a "percentage" calculation to aid ease of use.

For each data point, we return the value, margin of error, and percentage.

Data points returned are:

* Occupancy status (Table #B25002)
  * occupied
  * vacant
* Ownership of occupied units (Table #B25003)
  * owner-occupied
  * renter-occupied
* Units in structure (Table #B25024)
  * 1, detached unit; 1, attached unit; 2 units; 3 or 4 units; 5 to 9 units; 10 to 19 units; 20 to 49 units; 50 or more units; mobile home units; boat, RV, van, etc. units
* Median value of owner-occupied housing units (Table #B25077)
* Value of owner-occupied housing units (Table # B25075)
  * less than $10,000; $10,000-$14,999; $15,000-$19,999; $20,000-$29,000; $30,000-$34,999; $40,000-$49,999; $50,000-$59,000; $60,000-$69,999; $70,000-$79,000; $80,000-$89,999; $90,000-$99,999; $100,000-$124,999; $125,000-$149,000; $150,000-$174,999; $175,000-$199,999; $200,000-$249,000; $250,000-$299,000; $300,000-$399,999; $400,000-$499,000; $500,000-$749,000; $750,000-$999,999; $1,000,000-$1,499,999; $1,500,000-$1,999,999; $2,000,000 or more

## Social: Education & Veteran Status (Census)
**Field name: `acs-social`**

<!--FIELD:us:acs-social-->

We provide the data exactly as it is packaged by the Census Bureau in the breakouts it gives. The only change we have made is to add a "percentage" calculation to aid ease of use.

The data returned includes the following data points. For each data point, the data returned includes the value, margin of error, and percentage.

* Population by minimum level of education (Table #B15002)
  * No schooling, nursery to 4th grade, 5th and 6th grade, 7th and 8th grade, 9th grade, 10th grade, 11th grade, 12th grade - no diploma, high school graduate or equivalent, some college (1+ years, no degree), Associate's Degree, Bachelor's Degree, Master's Degree, professional school degree, Doctorate
  * Results broken out by all genders, female, and male
* Veteran status (Table #B21001)
  * Veteran, non-Veteran
  * Results broken out by all genders, female, and male as well as age groups
* Period of military service for veterans (Table #B21002)
  * Wars
    * Gulf War (9/2001 or later), no Gulf War (8/1990 to 8/2001), no Vietnam Era
    * Gulf War (9/2001 or later), Gulf War (8/1990 to 8/2001), no Vietnam Era
    * Gulf War (8/1990 to 8/2001), no Vietnam Era
    * Gulf War (8/1990 to 8/2001) and Vietnam Era
    * Vietnam Era, no Korean War, no World War II
    * Vietnam Era and Korean War, no World War II
    * Vietnam Era and Korean War and World War II
    * Korean War, no Vietnam Era, no World War II
    * Korean War and World War II, no Vietnam Era
    * World War II, no Korean War, no Vietnam Era
    * Between Gulf War and Vietnam Era only
    * Between Korean War and World War II only
    * Pre-World War II only

## USPS ZIP+4
**Field name: `zip4`**

<!--FIELD:us:zip4-->

<aside class="notice">
The <code>zip4</code> data append requires using <code>v1.5</code> of the Geocodio API or newer.
</aside>

> In most cases, only a single ZIP4 code is assigned to a result. If that is the case each array has one item.

```json
...
"plus4": [
  "2890"
],
"zip9": [
  "22201-2890"
],
...
```

> For businesses with a range of ZIP4 codes, an array with 2 items is returned:

```json
...
"plus4": [
  "2890",
  "2900",
],
"zip9": [
  "22201-2890",
  "22201-2900"
],
...
```

> In some rare cases a ZIP4 record is returned but without a ZIP+4 code (e.g. when it is not a valid delivery area)

```json
...
"plus4": [],
"zip9": [],
...
```

> Example of a building or firm name being returned (316 Pennsylvania Ave. SE, Lobby, Washington, DC)

```json
...
"building_or_firm_name": "The Natl Capital Bank Of Washington",
...
```

> Example of a government building result (134 Union Blvd Ste 130 Lakewood, CO)

```json
...
"government_building": {
    "code": "B",
    "description": "Federal Government Building"
},
...
```

Geocodio can return the USPS ZIP+4 code for a given US address or coordinate pair, which lets you retrieve the full 9-digit ZIP Code&trade;, by combining the 5-digit ZIP code with the ZIP+4 code. Additional USPS delivery data is also returned.

Geocodio also returns additional USPS delivery data, including Carrier Route ID and RDI.

### Record Type
The type of ZIP+4 result. Possible values are:

* **F**: Firm
* **G**: General Delivery
* **H**: High-rise
* **P**: PO Box
* **R**: Rural Route/Contract
* **S**: Street


### Residential Delivery Indicator (RDI)

`residential` will be set to `true` for residential addresses and `false` for commercial addresses.

The value can also be `null` if there are no records that indicate the residential status of this property.

### Carrier Route ID
A 4-byte code that determines the type of postal route that that servers the address.
Possible values are:

* **Bxxx**: PO Box
* **Hxxx**: Contract
* **Rxxx**: Rural Route
* **Cxxx**: City Delivery
* **Gxxx**: General Delivery

### Building or Firm Name
A USPS-provided name associated with the address. This is available for businesses that have registered their name with USPS and for most federal and state government buildings including schools and offices.

The building or firm name field takes the secondary address unit into account if available.

If no name is available, the value is set to `null`.

### ZIP+4 and ZIP9
The range of ZIP Codes that are associated with this result as representated by the minimum and maximum number.

The ZIP9 code consists of the ZIP5 code, a dash, and the +4 code.

### Government Building

Type of government building (if applicable).

If no name is available, the value is set to `null`.

* **A**: City Government Building
* **B**: Federal Government Building
* **C**: State Government Building 
* **D**: Firm Only
* **E**: City Government Building and Firm Only
* **F**: Federal Government Building
* **G**: State Government Building and Firm Only

### Facility Code

Facility code associated with the 5-digit ZIP Code

Possible values are:

* **B**: Branch
* **C**: Community post office (CPO)
* **N**: Non-postal community name, former USPS facility, or place name
* **P**: Post Office
* **S**: Station
* **U**: Urbanization

### City Delivery Indicator

Indicates whether or not the local post office has a city delivery carrier route.

### Valid delivery area

In some cases an address exists but it is not a valid delivery point for postal purposes. This could for example be because it is an undeveloped lot.

### <svg height="24" width="24" title="Important!" fill="#faad63" xmlns="http://www.w3.org/2000/svg" stroke-width=".501" stroke-linejoin="bevel" fill-rule="evenodd" overflow="visible" viewBox="0 0 192 192"><path d="M70.272 192l-9.744-34.512-34.8 8.784 8.8-34.752L0 121.712l25.008-25.68L0 70.288l34.512-9.76-8.784-34.816 34.752 8.816L70.288 0l25.696 25.008L121.728 0l9.76 34.496 34.8-8.784-8.816 34.752L192 70.272l-25.008 25.696L192 121.712l-34.496 9.76 8.768 34.8-34.752-8.816L121.712 192l-25.68-25.008L70.272 192zM108 132c0-6.624-5.376-12-12-12s-12 5.376-12 12 5.376 12 12 12 12-5.376 12-12zm-.016-36.464V60.48c0-6.88-5.376-12.464-11.984-12.464h-.016C89.376 48.016 84 53.6 84 60.48v35.056C84 102.416 89.376 108 95.984 108H96c6.608 0 11.984-5.584 11.984-12.464z" fill="#faad63" stroke="none" font-family="Times New Roman" font-size="16"/></svg> Exact match

An exact match means that there was no ambiguity with the lookup and that the given ZIP+4 code is the correct and only match for the given address.

Most often, not-exact matches are due to lookups for an apartment or office building that is missing a unit/apartment number.

In these cases it is not possible to determine an accurate ZIP+4 code without supplying secondary address line information.

<aside class="warning">
If no ZIP+4 data is available for the given query, the `zip4` field is omitted from the JSON output (and the field lookup does not count against your usage)
</aside>

## FFIEC (Fair Lending)
**Field name: `ffiec`**

<!--FIELD:us:ffiec-->

Geocodio's FFIEC field append allows you to get key data points, commonly used by financial institutions, lenders, and organizations that need to comply with Fair Lending regulations like HMDA and CRA. The data returned is for the 2024 data release. (The 2025 data will not be available until later this year.)

You can read more about the individual values in the [FFIEC Documentation](https://www.ffiec.gov/sites/default/files/data/census/cen2024_16JLUY24.pdf).


## Riding: Canadian Federal Electoral District
**Field name: `riding`**

<!--FIELD:ca:riding-->

Geocodio can return Canadian electoral districts ([ridings](https://en.wikipedia.org/wiki/List_of_Canadian_federal_electoral_districts) ) for an address or coordinate pair. The riding code and OCD-ID is returned along with the French and English name for the riding.

The OCD-ID can be used to uniquely identify the district using the [Open Civic Data Division Identifiers](https://github.com/opencivicdata/ocd-division-ids) project.

In some cases, the French and English names will be the same.

## Riding: Canadian Provincial Electoral District
**Field name: `provriding` or `provriding-next`**

<!--FIELD:ca:provriding-->

Geocodio can return the [provincial or territorial electoral district (riding)](https://en.wikipedia.org/wiki/Canadian_provincial_electoral_districts) for the specified address in Canada. The OCD-ID is returned along with the French and English name for the riding.

The OCD-ID can be used to uniquely identify the district using the [Open Civic Data Division Identifiers](https://github.com/opencivicdata/ocd-division-ids) project.

In some cases, the French and English names will be the same.

### Using `provriding-next`

`provriding-next` is a preview of upcoming, redistricted provincial ridings.

<!--FIELD:ca-alt:provriding-next-->

## Canadian statistical boundaries from Statistics Canada
**Field name: `statcan`**

<!--FIELD:ca:statcan-->

Geocodio can return the [Statistics Canada geographies](https://en.wikipedia.org/wiki/Census_geographic_units_of_Canada) for an address or coordinate, such as dissemination areas, tracts, and economic regions. These boundaries can be matched with data from [Statistics Canada](https://www.statcan.gc.ca) to get further Census information, such as demographics.

<aside class="notice">
Looking for US Census data? See the <a href="#census-block-tract-fips-codes-amp-msa-csa-codes"><code>census</code></a> field append.
</aside>

If a given geography does not apply to the query, `null` will be returned instead.

> Example for "26 Johnson Avenue, Teslin, YT Y0A 1B0, Canada"

```json
...
"fields": {
  "statcan": {
    "division": {
      "id": "6001",
      "name": "Yukon",
      "type": "TER",
      "type_description": "Territory / Territoire"
    },
    "consolidated_subdivision": {
      "id": "6001045",
      "name": "Yukon, Unorganized"
    },
    "subdivision": {
      "id": "6001047",
      "name": "Johnsons Crossing",
      "type": "SÉ",
      "type_description": "Not applicable"
    },
    "economic_region": "Yukon",
    "statistical_area": {
      "code": "000",
      "code_description": "Territories, classification is not applicable",
      "type": "8",
      "type_description": "Census subdivision within a territory"
    },
    "cma_ca": null,
    "tract": null,
    "designated_place": null,
    "population_centre": {
      "id": "609960",
      "name": "Yukon Territory Rural Area / Région rurale: Territoire du Yukon",
      "type": "5",
      "type_description": "Rural area outside of a census metropolitan area or census agglomeration",
      "class": "1",
      "class_description": "Rural area"
    },
    "dissemination_area": {
      "id": "60010135"
    },
    "dissemination_block": {
      "id": "60010135008",
      "population": "10"
    },
    "census_year": 2021
  }
}
...
```

The following geographies may be found:

### `division`: Census division
One of the largest Census designated geographies. The `id`, `name` and `type` code for the query is returned. The `type_description` contains values such as "District", "County", "Region", among others.

### `consolidated_subdivision`: Census Consolidated Subdivision
A geographic unit that is in-between divisions and subdivisions in size. It is a combination of adjacent census subdivisions.

The `id` and `name` are returned for consolidated subdivisions

### `subdivison`: Census Subdivision
This generally corresponds to a municipality.

The subdivision `id` is returned along with it's `name` and `type` code. The `type_description` is an explanation of the `type code` and can contain values such as "Town", "Village", "Municipality" or "City" among many others.

### `economic_region`: Economic region name
Economic regions are mostly groupings of complete census divisions, created to allow for analysis of regional economic activity.

### `statistical_area`: Statistical Area
Statistical areas group census subdivisions based on what type of CMA/CA are they are part of.

### `cma_ca`: Census Metropolitan Area or Census Agglomeration

The Census Metropolitan Area or Census Agglomeration that the query is part of. `type_description` can be either of the following: "Census metropolitan area (CMA)", "Census agglomeration (CA) that is not tracted", "Census agglomeration (CA) that is tracted".

### `tract`: Census Tract Code

The full Canadian census tract code that this query is part of.

### `designated_place`: Designated place

A Designated Place (DPL) typically refers to a small community or settlement that doesn't fulfill Statistics Canada's requirements for being a census subdivision (an area with municipal status) or a population centre.

Provinces and territories work with Statistics Canada to establish designated places, which serve as data sources for submunicipal regions.


### `population_centre`: Population centre

Population centres in Canada have a population of at least 1,000 and a population density of 400 persons or more per square kilometre, based on the current census population count. Rural areas are defined as areas outside population centres. All of Canada is covered by either population centres or rural areas.

Population centres are grouped into three categories based on their population size: small, medium, and large. The population count for population centres includes all people living in the cores, secondary cores, and fringes of census metropolitan areas and census agglomerations, as well as those living in population centres outside of these areas.

### `dissemination_area` and `dissemination_block`: Dissemination area and block

The dissemination area is geographically one step lower than census tracts. Dissemination blocks are one step lower than dissemination areas.


> You can read more about the various code names from the [Statistics Canada technical specifications page](https://www150.statcan.gc.ca/n1/pub/92-151-g/92-151-g2021001-eng.htm). Statistics Canada also provides a helpful [hierarchy of geographic areas](https://www12.statcan.gc.ca/census-recensement/2021/ref/dict/fig/index-eng.cfm?ID=f1_1).

## Timezone
**Field name: `timezone`**

<!--FIELD:us:timezone-->

Geocodio can return the timezone for an address or coordinate using `timezone` in the `fields` query parameter.

The field will return the standardized name of the timezone as well as an abbreviation (see table below for examples), the UTC/GMT offset, and whether the location observes Daylight Saving Time (DST).

The standardized name follows the [tzdb](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones) format. E.g. `America/New_York`.

Abbreviation | Description
------------ | -----------------------------------------------------------
AKST         | Alaska Standard Time
AST          | Atlantic Standard Time
ChST         | Chamorro Standard Time
CST          | Central Standard Time
EST          | Eastern Standard Time
HAST         | Hawaii-Aleutian Standard Time
MST          | Mountain Standard Time
PST          | Pacific Standard Time
SST          | Samoa Standard Time

# Address components

Geocodio parses and standardizes all address results, and all results come with an `address_components` dictionary. This is an overview of all of the possible keys that you may find.

The key will not be present if there is no valid value for it. For example, if the address does not have a `predirectional`, this key will not be present.

Name               | Notes
------------------ | ---------------------------
number             | House number, e.g. "2100" or "250 1/2"
predirectional     | Directional that comes before the street name, 1-2 characters, e.g. N or NE
prefix             | Abbreviated street prefix, particularly common in the case of French addresses e.g. Rue, Boulevard, Impasse
street             | Name of the street without number, prefix or suffix, e.g. "Main"
suffix             | Abbreviated street suffix, e.g. St., Ave. Rd.
postdirectional    | Directional that comes after the street name, 1-2 characters, e.g. N or NE
secondaryunit      | Name of the secondary unit, e.g. "Apt" or "Unit". For "input" address components only
secondarynumber    | Secondary unit number. For "input" address components only
city               |
county             |
state              |
zip                | 5-digit zip code for US addresses. The 3-character FSA is returned for Canadian results - the full postal code is not returned
country            |
formatted_street   | Fully formatted street, including all directionals, suffix/prefix but not house number

# Accuracy score
Each geocoded result from Geocodio is returned with an accuracy score, which is a decimal number ranging from 0.00 to 1.00. This score is generated by the internal Geocodio engine based on how accurate the result is believed to be. The higher the score, the better the result. Results are always returned ordered by accuracy score.

For example, if against all odds an address simply can't be found, instead of returning no results, Geocodio will return a geocoded point based on the postal code or city but with a much lower accuracy score and accuracy type set to "place".

Generally, accuracy scores that are larger than or equal to `0.8` are the most accurate, whereas results with lower accuracy scores might be very rough matches.

An accuracy type is also returned with all results. The accuracy types are different for forward and reverse geocoding results.

We recommend using a combination of the accuracy score and accuracy type to evaluate and filter the returned results.

### Forward geocoding

Value                 | Description
--------------------- | -----------
rooftop               | The exact point was found with rooftop level accuracy
point                 | The exact point was found from address range interpolation where the range contained a single point
range_interpolation   | The point was found by performing [address range interpolation](http://en.wikipedia.org/wiki/Geocoding#Address_interpolation)
nearest_rooftop_match | The exact house number was not found, so a close, neighboring house number was used instead
intersection          | The result is an intersection between two streets
street_center         | The result is a geocoded street centroid
place                 | The point is a city/town/place zip code centroid
county                | The point is a county centroid
state                 | The point is a state centroid

![Visual guide to the most common accuracy types](https://www.geocod.io/docs/images/accuracy-types-b0200132.png)

*Visual guide to the most common accuracy types*

### Reverse geocoding

Value               | Description
------------------- | -----------
rooftop             | We found the exact point with rooftop level accuracy
nearest_street      | Nearest match for a specific street with estimated street number
nearest_place       | Closest city/town/place

# Address formats
Geocodio supports geocoding the following address components:

* Streets with or without house numbers (requires a city or a zip in conjuction)
* [Intersections](#intersections)
* Cities
* Zip codes
* Counties
* States
* PO Boxes (coordinates will be returned as a centroid of the zip code)
* Second address lines such as unit and apartment numbers (not used for determining the exact coordinates at this time)

If a city is provided without a state, Geocodio will automatically guess and add the state based on what it is most likely to be. Geocodio also understands shorthands for both streets and cities, for example *NYC*, *SF*, etc., are acceptable city names.

Geocoding queries can be formatted in various ways:

* <a href="https://api.geocod.io/v1.9/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, Arlington VA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=1109+N+Highland+Street%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland Street, Arlington VA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=1109+North+Highland+Street%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 North Highland Street, Arlington VA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, Arlington VA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=1109+N+Highland+St,+22201&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, 22201</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=Arlington%2c+VA&api_key=YOUR_API_KEY" target="_blank">Arlington, VA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=Arlington&api_key=YOUR_API_KEY" target="_blank">Arlington</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=VA&api_key=YOUR_API_KEY" target="_blank">VA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=22201&api_key=YOUR_API_KEY" target="_blank">22201</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=PO+Box+4735,+Tulsa+OK&api_key=YOUR_API_KEY" target="_blank">PO Box 4735, Tulsa OK</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=Santa%20Clara%20County&api_key=YOUR_API_KEY" target="_blank">Santa Clara County</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=Santa%20Clara%20County%2C%20CA&api_key=YOUR_API_KEY" target="_blank">Santa Clara County, CA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=1%20Infinite%20Loop%2C%20Santa%20Clara%20County&api_key=YOUR_API_KEY" target="_blank">1 Infinite Loop, Santa Clara County</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=1%20Infinite%20Loop%2C%20Santa%20Clara%20County%2C%20CA&api_key=YOUR_API_KEY" target="_blank">1 Infinite Loop, Santa Clara County, CA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=1%20Infinite%20Loop%2C%20Santa%20Clara%20County%2C%20Cupertino%20CA&api_key=YOUR_API_KEY" target="_blank">1 Infinite Loop, Santa Clara County, Cupertino CA</a>

If a country is not specified in the query, the Geocodio engine will assume the country to be USA.

Examples of Canadian lookups:

* <a href="https://api.geocod.io/v1.9/geocode?q=525+University+Ave%2C+Toronto%2C+ON%2C+Canada&api_key=YOUR_API_KEY" target="_blank">525 University Ave, Toronto, ON, Canada</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=7515+118+Ave+NW%2C+Edmonton%2C+AB+T5B+0X2%2C+Canada&api_key=YOUR_API_KEY" target="_blank">7515 118 Ave NW, Edmonton, AB T5B 0X2, Canada</a>

## Intersections

You can also geocode intersections. Just specify the two streets that you want to geocode in your query. We support various formats:

* <a href="https://api.geocod.io/v1.9/geocode?q=E+58th+St+and+Madison+Ave%2C+New+York%2C+NY&api_key=YOUR_API_KEY" target="_blank">E 58th St and Madison Ave, New York, NY</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=Market+and+4th%2C+San+Francisco&api_key=YOUR_API_KEY" target="_blank">Market and 4th, San Francisco</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=Commonwealth+Ave+at+Washington+Street%2C+Boston%2C+MA&api_key=YOUR_API_KEY" target="_blank">Commonwealth Ave at Washington Street, Boston, MA</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=Florencia+%26+Perlita%2C+Austin+TX&api_key=YOUR_API_KEY" target="_blank">Florencia & Perlita, Austin TX</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=Quail+Trail+%40+Dinkle+Rd%2C+Edgewood%2C+NM&api_key=YOUR_API_KEY" target="_blank">Quail Trail @ Dinkle Rd, Edgewood, NM</a>
* <a href="https://api.geocod.io/v1.9/geocode?q=8th+St+SE%2FI+St+SE%2C+20003&api_key=YOUR_API_KEY" target="_blank">8th St SE/I St SE, 20003</a>

An extra `address_components_secondary` property will be exposed for intersection results, but otherwise, the schema format is the same.

<pre class="inline">
{
  ...
  "results": [
    {
      "address_components": {
        "street": "4th",
        "suffix": "St",
        "formatted_street": "4th St",
        "city": "San Francisco",
        "county": "San Francisco County",
        "state": "CA",
        "zip": "94103"
      },
      "address_components_secondary": {
        "street": "Market",
        "suffix": "St",
        "formatted_street": "Market St",
        "city": "San Francisco",
        "county": "San Francisco County",
        "state": "CA",
        "zip": "94103"
      },
      [
        "4th St and Market St",
        "",
        "San Francisco, CA 94103"
      ],
      "formatted_address": "4th St and Market St, San Francisco, CA 94103",
      "location": {
        "lat": 37.785725,
        "lng": -122.405807
      },
      "accuracy": 1,
      "accuracy_type": "intersection",
      "source": "TIGER/Line® dataset from the US Census Bureau"
    }
  ]
  ...
}
</pre>

# Errors
> Here is an example of a 422 Unprocessable Entity response:

```json
{
  "error": "Could not geocode address, zip code or city/state are required"
}
```

> This error message is returned with a 403 HTTP status code when you exceed the free tier with no payment method on file:

```json
{
  "error": "You can't make this request as it is above your daily maximum. You can configure billing at https://dash.geocod.io"
}
```

The Geocodio API employs semantic HTTP status codes:

Error Code | Meaning
---------- | -------
200 OK | Hopefully you will see this most of the time. Note that this status code will also be returned even though no geocoding results were available.
403 Forbidden | Invalid API key, or other reason why access is forbidden.
422 Unprocessable Entity | A client error prevented the request from executing successfully (e.g. invalid address provided). A JSON object will be returned with an error key containing a full error message.
429 Too Many Requests | You've reached the Pay as You Go rate limit. Please inspect the following HTTP headers: `X-RateLimit-Remaining`, `X-RateLimit-Limit`, `X-RateLimit-Period` and stop making requests until the end of the `X-RateLimit-Period` value.
500 Server Error | Hopefully you will never see this...it means that something went wrong in our end. Whoops.

If you encounter any unexpected errors, please check [status.geocod.io](https://status.geocod.io) for the latest platform status updates.

# Warnings

The Geocodio API implements the concept of "warnings". This is meant to assist and guide developers when implementing our API.

Warnings are represented with a `_warnings` key, and it can be applied to either an individual geocoding result or an overall geocoding query.

If no warnings have been triggered, the `_warnings` key will not be part of the JSON output at all.

> Here's an example where the query parameter `postalcode` accidentally was used instead of `postal_code`

```json
{
  "input": {
    ...
  },
  "results": [
    ...
  ],
  "_warnings": [
    "Ignoring parameter \"postalcode\" as it was not expected. Did you mean \"postal_code\"? See full list of valid parameters here: https://www.geocod.io/docs/"
  ]
}
```

> Warnings can also be triggered for individual results, such as when an FFIEC field append was specified for a city-level query:

```json
{
  "input": {
    ...
  },
  "results": [
    {
      ...
      "_warnings": [
        "ffiec field was skipped since result is not street-level"
      ]
    }
  ]
}
```

# CORS
> To Geocode an address using the JavaScript `fetch` API:

```html
<script>
const address = '1109 N Highland St, Arlington VA';
const apiKey = 'YOUR_API_KEY';
const url = `https://api.geocod.io/v1.9/geocode?q=${encodeURIComponent(address)}&api_key=${encodeURIComponent(apiKey)}`;

fetch(url)
  .then(response => response.json())
  .then(data => {
    console.log(data.results);
  })
  .catch(error => {
    console.error('Error:', error);
  });
</script>
```

The Geocodio API supports `CORS` using the `Access-Control-Allow-Origin` *HTTP* header.

This means that you will be able to make requests directly to the API using JavaScript in the browser.

(See an example to the right.)

<aside class="notice">
<strong>Note:</strong> This will expose your API Key publicly, make sure that you understand and accept the implications of this approach, and consider setting <a href="https://dash.geocod.io/billing#limits">usage limits</a> on your account if applicable.
</aside>

# Google Maps Compatibility

Geocodio provides a compatibility endpoint that accepts Google Maps Geocoding API-style requests, making it easy to migrate from Google Maps to Geocodio. If you're using the Google Maps JavaScript SDK, you can continue using it by simply changing the API endpoint and key.

This endpoint returns responses in Google Maps' format, allowing you to keep your existing response handling code unchanged. For new integrations or access to Geocodio's full feature set (like data appends and batch geocoding), we recommend using the [native Geocodio API](#geocoding).

> Using Google Maps SDKs with Geocodio:

```shell
# Direct API call
curl "https://api.geocod.io/maps/api/geocode/json?address=1109+N+Highland+St,+Arlington+VA&key=YOUR_API_KEY"

# Reverse geocoding
curl "https://api.geocod.io/maps/api/geocode/json?latlng=38.886665,-77.094733&key=YOUR_API_KEY"
```

```ruby
# Install: gem install google_maps_service
require 'google_maps_service'

# Create client with Geocodio endpoint
gmaps = GoogleMapsService::Client.new(
  key: 'YOUR_GEOCODIO_API_KEY',
  base_url: 'https://api.geocod.io'
)

# Forward geocoding
result = gmaps.geocode('1109 N Highland St, Arlington VA')
location = result.first[:geometry][:location]
puts "Lat: #{location[:lat]}, Lng: #{location[:lng]}"

# Reverse geocoding
reverse_result = gmaps.reverse_geocode([38.886665, -77.094733])
puts reverse_result.first[:formatted_address]
```

```python
# Install: pip install googlemaps
import googlemaps

# Create client with Geocodio endpoint
gmaps = googlemaps.Client(
    key='YOUR_GEOCODIO_API_KEY',
    base_url='https://api.geocod.io'
)

# Forward geocoding
geocode_result = gmaps.geocode('1109 N Highland St, Arlington VA')
location = geocode_result[0]['geometry']['location']
print(f"Lat: {location['lat']}, Lng: {location['lng']}")

# Reverse geocoding
reverse_result = gmaps.reverse_geocode((38.886665, -77.094733))
print(reverse_result[0]['formatted_address'])
```

```php
<?php
// Install: composer require googlemaps/googlemaps-services-php
use GoogleMaps\GoogleMaps;

// Create client with Geocodio endpoint
$gmaps = new GoogleMaps([
    'key' => 'YOUR_GEOCODIO_API_KEY',
    'base_url' => 'https://api.geocod.io'
]);

// Forward geocoding
$response = $gmaps->geocode('1109 N Highland St, Arlington VA');
$location = $response['results'][0]['geometry']['location'];
echo "Lat: {$location['lat']}, Lng: {$location['lng']}\n";
```

```javascript
// Install: npm install @googlemaps/google-maps-services-js
const { Client } = require("@googlemaps/google-maps-services-js");

// Create client with Geocodio endpoint
const client = new Client({
  config: {
    baseURL: "https://api.geocod.io"
  }
});

// Forward geocoding
client.geocode({
  params: {
    address: "1109 N Highland St, Arlington VA",
    key: "YOUR_GEOCODIO_API_KEY"
  }
})
.then(response => {
  const location = response.data.results[0].geometry.location;
  console.log(`Lat: ${location.lat}, Lng: ${location.lng}`);
})
.catch(error => {
  console.error(error);
});
```

### HTTP Request

`GET https://api.geocod.io/maps/api/geocode/json`

### URL Parameters

Parameter | Description | Required
--------- | ----------- | --------
`address` | The address to geocode (for forward geocoding) | Either `address` or `latlng`
`latlng` | Coordinates in `lat,lng` format (for reverse geocoding) | Either `address` or `latlng`
`key` | Your Geocodio API key | Yes
`components` | Address component filters (e.g., `country:US`) | No

## What's Supported

**Request Parameters:**

* ✅ `address` - Forward geocoding
* ✅ `latlng` - Reverse geocoding
* ✅ `key` - API authentication
* ✅ `components` - Address component filtering (see below for details)

**Address Components:**

The endpoint transforms Geocodio's address components into Google Maps format with these component types:

* `street_number` - House/building number
* `route` - Street name (includes predirectional, prefix, street, suffix, postdirectional)
* `locality` - City name
* `administrative_area_level_2` - County
* `administrative_area_level_1` - State/province (with full name expansion, e.g., VA → Virginia, ON → Ontario)
* `country` - Country code and full name
* `postal_code` - ZIP/postal code

**Component Filtering:**

The `components` parameter supports filtering results:

* `country:XX` - Filter by country code (US, CA, MX)
* `postal_code:XXXXX` - Filter by postal code
* Multiple filters can be combined: `components=country:US|postal_code:22201`

**Supported Countries:**

* 🇺🇸 United States (US)
* 🇨🇦 Canada (CA) - with proper province expansion (e.g., ON → Ontario, QC → Quebec)
* 🇲🇽 Mexico (MX)

**Response Format:**

* ✅ `address_components` - Typed address component arrays with proper component types
* ✅ `formatted_address` - Full formatted address string
* ✅ `geometry.location` - Latitude and longitude coordinates
* ✅ `geometry.location_type` - Accuracy indicator (ROOFTOP, RANGE_INTERPOLATED, GEOMETRIC_CENTER, APPROXIMATE)
* ✅ `geometry.viewport` - Bounding box for the result
* ✅ `types` - Result type indicators
* ✅ `status` - Response status (OK, ZERO_RESULTS, REQUEST_DENIED, etc.)
* ✅ `partial_match` - Added when accuracy < 1.0

**Additional Features:**

* **State/Province Expansion** - Short codes expanded to full names (VA → Virginia, ON → Ontario, QC → Quebec)
* **Street Components** - Properly combines predirectional (N, S, E, W), street name, suffix (St, Ave), and postdirectional (NW, SE)
* **Location Type Mapping** - Maps Geocodio accuracy to Google's location types (ROOFTOP, RANGE_INTERPOLATED, GEOMETRIC_CENTER, APPROXIMATE)
* **Partial Match Indicator** - Automatically adds `partial_match: true` flag when accuracy is less than 1.0

## What's Different

**Not Included in Responses:**

* ❌ `place_id` - Google-specific place identifiers are not provided
* ❌ `plus_code` - Google Plus Codes are not provided
* ⚠️ `geometry.viewport` - Provided but approximated (not based on actual address boundaries)

**Parameter Limitations:**

* ❌ `bounds` - Viewport biasing not supported (parameter ignored if provided)
* ❌ `region` - Region biasing not supported (parameter ignored if provided)
* ⚠️ `components` - Only `country` and `postal_code` filtering are supported (other component types are not supported)

**Coverage:**

* ⚠️ **US, Canada, and Mexico** - Geocodio currently supports US, Canadian, and Mexican addresses. Requests for other countries will return `ZERO_RESULTS` status

**Error Responses:**

All responses return HTTP 200 with status information in the response body (matching Google's behavior). Possible status values include:

* `OK` - Request successful
* `ZERO_RESULTS` - No results found
* `REQUEST_DENIED` - Invalid API key
* `INVALID_REQUEST` - Missing or invalid parameters
* `OVER_QUERY_LIMIT` - Rate limit exceeded

<aside class="notice">
For new integrations, we recommend using the <a href="#geocoding">native Geocodio API</a> for access to advanced features like data appends, batch geocoding, and more detailed address parsing.
</aside>

<aside class="warning">
This endpoint supports US and Canada addresses only. Requests for addresses in other countries will return a <code>ZERO_RESULTS</code> status.
</aside>

# Changelog

The Geocodio API is continuously improved. Most updates require no changes for API users, but in some cases we might have to introduce breaking changes.

Breaking changes are introduced with new API versions, allowing you to "upgrade" to the newest version at your own pace. Older API versions are guaranteed to be available for at least 12 months after they have been replaced by a newer version, but may be supported for longer.

Major changes, that are not breaking are also documented here.

<aside class="notice">
Breaking changes are defined as changes that remove or rename properties in the JSON output of any API endpoint. Your API client should be able to gracefully support addition of new JSON properties, as this is not considered a breaking change.
</aside>

## v1.9

*Released on November 19, 2025*

* Added [Google Maps API compatibility endpoint](#google-maps-compatibility) at `/maps/api/geocode/json`. This allows developers to migrate from Google Maps by using existing Google Maps SDKs with Geocodio by simply changing the endpoint and API key

*Released on November 18, 2025*

* The [`cd120`](#congressional-districts) field has been added for the 120th Congress. It remains in preview until finalized. cd119 continues to be the default.


*Released on June 17, 2025*

* **Breaking:** We've done a bit of "spring" cleaning to better standardize state legislative district names and numbers. The changes does not apply to API version below v1.9 and OCD ids are not affected. To compare the differences, you can compare the following URLs: [https://api.geocod.io/v1.8/ocd-ids/stateleg](https://api.geocod.io/v1.8/ocd-ids/stateleg) and [https://api.geocod.io/v1.9/ocd-ids/stateleg](https://api.geocod.io/v1.9/ocd-ids/stateleg)
* The lists API endpoint now includes the updated header names recently introduced to the spreadsheet geocoding tool as well as state legislator data

## v1.8

*Released on June 6, 2025*

* The [state legislative districts](#state-legislative-districts) field append now return the current legislators for the district
* The [congressional districts](#congressional-districts) field append now return a `photo_url` along with each legislator

*Released on June 2, 2025*

* Updated [state legislative districts](#state-legislative-districts) for North Dakota

*Released on May 16, 2025*

* **Breaking:** 2023 data is now returned for all [Census ACS appends](/#census-acs-american-community-survey). Changes include:
  * 2023 Census boundaries and ACS data are returned instead of 2021
  * The [`acs-families`](#census-households) field append has certain table titles renamed ("wife" or "husband" replaced with "spouse") &mdash; no other ACS field appends has renamed tables
  * Support for additional Census Geographies (prior to v1.8 all ACS data was returned at the Census Block Group level). The geography is now automatically selected based on the `accuracy_type` of the result and [can be explicitly specified](/#census-acs-american-community-survey)
* ACS Table #B19301 was added for the [`acs-economics`](#census-income) field append
* ACS Tables #B11003, #B25010, and #B09002 were added for the [`acs-families`](#census-households) field append

  There are no other breaking changes for *v1.8*.

## v1.7

*Released on May 6, 2025*

* Added [`address_lines`](#single-address) along with each geocoding result.

*Released on March 25, 2025*

* Added new [`ffiec`](#ffiec-fair-lending) field append

*Released on March 24, 2025*

* The Canadian elections have been called! [`riding`](#riding-canadian-federal-electoral-district) is now returning the new, redistricted ridings. `riding-next` continues to return the redistricted ridings as well, but is otherwise no longer in use.

*Released on March 10, 2025*

* Added the ability to use the `Authorization` header for [API authentication](#authentication)
* [List geocoding](#geocoding-lists) is now available for Geocodio Enterprise

*Released on February 27, 2025*

* The `current_legislators` data for the `cd` field append now return sorted legislators. The representative is always returned first, senators are then returned sorted by seniority. In addition, a new `seniority` key can be used to determine if a senator is `senior` or `junior`. The value is `null` for representatives.

*Released on January 17, 2025*

* Added support for `street2` and `county` as input address components. Available for both [single geocoding](#single-address) and [batch geocoding](#batch-geocoding)

*Released on January 9, 2025*

* The [`census2024`](#census-blocktract-fips-codes-msacsa-codes) field append is now available (the `census` data append will now default to `census2024`)
* The senate districts for California has been updated with new post-election boundaries

*Released on December 16, 2024*

* The [`cd119`](#congressional-districts) field append has been added, for the 119th congress. This will be the new default congressional district append, starting on January 3rd, 2025

*Released on November 4, 2024*

* The [`zip4`](#usps-zip-4) field append now returns a residential delivery indicator (RDI) with the new `residential` property

*Released on September 27, 2024*

* The `provriding-next` data append is now available. Upcoming provincial ridings for Saskatchewan can be previewed. The `provriding` will be returning these new ridings as of 10/28/2024

*Released on September 20, 2024*

* `provriding`: New district boundaries are now used for British Columbia

*Released on April 29, 2024*

* `stateleg-next`: Upcoming districts boundaries were added for Minnesota House & Senate districts, they will be promoted to `stateleg` on 1/14 2025

*Released on April 24, 2024*

* Added Census County Subdivisions to the [`census`](#census-blocktract-fips-codes-msacsa-codes) field append

*Released on April 16, 2024*

* `cd118`: District boundaries were updated for North Carolina, Louisana and New York
* `stateleg`: Wisconsins and Michigan House district boundaries were updated. New Mexico Senate district boundaries were updated.
* `stateleg-next`: Upcoming districts boundaries were added as follows:
  * New York Assembly districts, will be promoted to `stateleg` on 1/1 2025
  * Ohio House & Senate districts, will be promoted to `stateleg` on 1/1 2025
  * Washington House & Senate districts, will be promoted to `stateleg` on 8/6 2024

*Released on April 8, 2024*

* Introduced the [`riding-next`](#riding-canadian-federal-electoral-district) which allows federal electoral district lookups in Canada, based on redistricting ridings

*Released on January 18, 2024*

* Introduced `census2023` data append (the `census` data append will now default to `census2023`)
* Corrected an issue where census field appends always returned county FIPS codes for most recent census year. This primarily affects census county lookups in Connecticut as this state [switched to a new county-equivalent system](https://www.census.gov/programs-surveys/acs/technical-documentation/user-notes/2023-01.html) as of the 2022 census release.

*Released on November 8, 2023*

* Updated state legislative districts for North Carolina

*Released on August 14, 2023*

* Corrected an issue that caused batch geocoding requests to only return results from the first country when addresses from mixed countries were present in a single batch. The original issue was inadvertently introduced on July 24th.

*Released on April 26, 2023*

* Added upcoming redistricted boundaries for Montana with the `stateleg-next` data append
* Corrected boundaries current senate state legislative districts for California. Districts with odd numbers were incorrectly using upcoming boundaries. Geocodio is now applying special logic required due to partial redistricting. You can read more [here](https://sdmg.senate.ca.gov/Current).
* Updated Statistics Canada data to latest 2021 census release. The following additional values has been added as well:
  * Designated place
  * Population centre
  * Dissemination area
  * Dissemination block

*Released on March 14, 2023*

* Updated Alaska state legislative district boundaries

*Released on February 7, 2023*

* Corrected version of state legislative districts returned for:
  * NM State Senate. New districts will be returned when the next session commences 1/21/2025
  * KS State Senate. New districts will be returned when the next session commences 1/15/2025
  * SC State Senate. New districts will be returned when the next session commences 1/7/2025
* Redistricted state boundaries can still be requested early by using the `stateleg-next` data append

*Released on February 1, 2023*

* ~~Corrected version of state legislative districts returned for New Mexico Senate. New districts will be returned when the next session commences 1/21/2025, or using the `stateleg-next` data append.~~ *(This was rolled back and postponed to February 7th)*
* Corrected the following Massachusetts state legislative district OCD ids:
  * Changed "ocd-division/country:us/state:ma/sldu:berkshire_hampshire_franklin_and_hampden" to "ocd-division/country:us/state:ma/sldu:berkshire_hampden_franklin_and_hampshire"
  * Changed "ocd-division/country:us/state:ma/sldu:1st_hampden_and_hampshire" to "ocd-division/country:us/state:ma/sldu:hampden_and_hampshire"
  * Changed "ocd-division/country:us/state:ma/sldu:1st_middlesex_and_norfolk" to "ocd-division/country:us/state:ma/sldu:middlesex_and_norfolk"
  * Changed "ocd-division/country:us/state:ma/sldu:norfolk_bristol_and_plymouth" to "ocd-division/country:us/state:ma/sldu:norfolk_plymouth_and_bristol"

*Released on January 23, 2023*

* Updated congressional district and state legislative district boundaries for Wisconsin
* Corrected an issue where 4th Middlesex and 5th Middlesex in Massachusetts was returning an incorrect OCD id

*Released on January 17, 2023*

* Census ACS data has been updated to the latest release (2021 ACS data)
* The `ocd_id` value is now set for all `stateleg` district result (previously, it was `null` for pre-redistricting districts)

*Released on January 11, 2023*

* Introduced `census2022` data append (the `census` data append will now default to `census2022`)
* `stateleg` data append now returns redistricted boundaries for all states except MS, NJ, LA, MT and VA. For these states, use `stateleg-next` to get redistricted data instead

*Released on May 19, 2022*

* The `stateleg-next` and `cd118` field appends now return OCD identifiers

*Released on March 7, 2022*

* When using the `stateleg-next` data append, the `is_upcoming_state_legislative_district` property will now return `false` in cases where the state's data has not been updated yet

*Released on February 11, 2022*

* Added the new `provriding` field append for provincial/territorial legislative districts in Canada

*Released on February 10, 2022*

* The `cd118` and `stateleg-next` data appends has been updated with the addition of updated districts for California, Massachusetts and Virginia

*Released on January 17, 2022*

* Introduced `census2021` data append (the `census` data append will now default to `census2021`)

*Released on January 13, 2022*

* Introduced `census2000` data append for 2000 vintage census boundaries
* Updated `cd118` and `stateleg-next` data appends with data for additional redistricted states

*Released on November 12, 2021*

* **Breaking:** The `state_legislative_districts` key from the [`stateleg`](#state-legislative-districts) field append now returns an array of `house` and `senate` districts instead of a single object
* The [`stateleg-next`](#state-legislative-districts) field append is back! Now returning a preview from upcoming state legislative district changes. As with congressional districts, we are updating district data on an ongoing basis as more states complete their redistricting process
* [`stateleg`](#state-legislative-districts) and [`stateleg-next`](#state-legislative-districts) can now return all districts that intersect with a zip code boundary along with the proportion of overlap
* [`cd118`](#congressional-districts) has been added as a field append, returning districts for the upcoming 118th congress. Districts are updated on an ongoing basis as more states complete their redistricting process

## v1.6
*Released on September 15, 2021*

* Introduced the `format` parameter for single [forward](#single-address) and [reverse](#reverse-geocoding) geocoding requests

*Released on June 16, 2021*

* Counties can now be geocoded in the U.S. Either standalone, or as part of an adddress

*Released on March 1, 2021*

* `stateleg` now returns the same data as `stateleg-next`. `stateleg-next` may be used again for future legislative district changes

*Released on February 25, 2021*

* Introduced `census2020` data append (the `census` data append will now default to `census2020`)
* Update all Census ACS data to most recent 5-year release (2015-2019)

*Released on May 28, 2020*

* **Breaking:** This fixes a bug which has backwards-incompatible consequences for `acs-families` and `acs-demographics` field appends
* *Non-breaking:* The `acs-social` table, Population with veteran status (Table B21001) now includes age breakdowns

The following ACS data tables have titles changed and/or values corrected:

**`acs-families`**

* Household type by household (Table B11001)
* Household type by population (Table B11002)
* Marital status (Table B12001)

**`acs-demographics`**

* Race and ethnicity (Table B03002)

<aside class="warning">
  <a href="/docs/acs-diff.html">See a full diff</a> of ACS output changes between API v1.5 and v1.6
</aside>

## v1.5
*Released on May 13, 2020*

* **Breaking:** PO Box and second address lines (e.g. apartment/unit/suite numbers) are now returned as `results` and appear within the `formatted_address` keys
* The [`zip4`](#usps-zip-4) data append is now generally available

## v1.4
*Released on September 18th, 2019*

**`census` appends:**

* **Breaking:** The `census` append now supports vintage years, data is keyed by year instead of just returning a single year

## v1.3
*Released on March 12th, 2018*

**`timezone` appends:**

* **Breaking:** `name` property has been renamed to `abbreviation`
* `name` is now the full timezone name in a [tzdb](https://www.iana.org/time-zones)-compatible format. [Read more](#timezone)

## v1.2
*Released on January 20th, 2018*

**`cd` (Congressional district) appends:**

* **Breaking:** `current_legislator` property has been renamed to `current_legislators` and is now an array instead of an object
* Both house and senate legislators are now returned

## v1.1
*Released on January 8th, 2018*

**`cd` (Congressional district) appends:**

* **Breaking:** `congressional_district` property has been renamed to `congressional_districts`
* **Breaking:** Postal code lookups will now return multiple Congressional districts if the zip code area spans more than one district
* Current legislator information is now returned with Congressional districts

# Contact & Support
Have any questions? Feel free to tweet us [@Geocodio](http://twitter.com/Geocodio) or shoot us an email [support@geocod.io](mailto:support@geocod.io).

If you find an error in the documentation or want something to be clarified, please create a [pull request](https://github.com/Geocodio/docs/pulls) or [issue](https://github.com/Geocodio/docs/issues) so we can correct it.
