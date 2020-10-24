---
title: Geocodio API Reference

language_tabs:
  - shell: Shell
  - ruby: Ruby
  - python: Python
  - php: PHP
  - javascript: Node
  - clojure: Clojure

toc_footers:
 - <a href="https://dash.geocod.io">Sign Up for an API Key</a>
 - <a href="https://www.geocod.io/terms-of-use/">Terms of Use</a>
 - <a href="https://github.com/Geocodio/openapi-spec" target="_blank">OpenAPI Spec</a>
---

# Introduction

Geocodio's RESTful API allows you to perform forward and reverse geocoding lookups. We support both batch requests as well as individual lookups.

You can also optionally ask for data appends such as timezone, Congressional districts or similar things of that nature.

The base API url is `https://api.geocod.io/v1.6/`.

All HTTP responses (including errors) are returned with [JSON-formatted](http://www.json.org) output.

We may add additional properties to the output in the future, but existing properties will never be changed or removed without a new API version release.

<aside class="notice">
Note the versioning prefix in the base url, which is required for all requests.
</aside>

# Changelog

The Geocodio API is continuously improved. Most updates require no changes for API users, but in some cases we might have to introduce breaking changes.

Breaking changes are introduced with new API versions, allowing you to "upgrade" to the newest version at your own pace. Older API versions are guaranteed to be available for at least 12 months after they have been replaced by a newer version, but may be supported for longer.

<aside class="notice">
Breaking changes are defined as changes that remove or rename properties in the JSON output of any API endpoint. Your API client should be able to gracefully support addition of new JSON properties, as this is not considered a breaking change.
</aside>

## v1.6
*Released on May 28, 2020*

* **Breaking:** This fixes a bug which has backwards-incompatible consequences for `acs-families` and `acs-demographics` field appends.
* *Non-breaking:* The `acs-social` table, Population with veteran status (Table B21001) now includes age breakdowns.

The following ACS data tables have titles changed and/or values corrected:

**`acs-families`**

* Household type by household (Table B11001)
* Household type by population (Table B11002)
* Marital status (Table B12001)

**`acs-demographics`**

* Race and ethnicity (Table B03002)

<aside class="warning">
  <a href="acs-diff.html">See a full diff</a> of ACS output changes between API v1.5 and v1.6
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

# Libraries

## Official libraries

These libraries are officially written and maintained by Geocodio. Have an issue? We will in most cases be able to help via online chat or email.

GitHub pull requests and issues are also more than welcome!

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
</tbody></table>

## Third-party libraries

Thanks to the wonderful open-source community, we have language bindings for several additional languages and platforms.

We will do our best to assist in online chat or email, but may not be able to help in all cases with these libraries.

Some of the libraries are featured here with basic examples, but please make sure to check out the full documentation for the individual libraries (linked below).

<!--HIPAA
  <aside class="warning">
    Please consult the individual library documentation to ensure that you are using the <strong>api-hipaa.geocod.io</strong> hostname instead of the regular <strong>api.geocod.io</strong> hostname.
  </aside>
HIPAA-->

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
    <td><i class="fa fa-check"></i></td>
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
    <td colspan="3">Are you the author of an awesome library that you would like to get featured here? Just <a href="mailto:hello@geocod.io">let us know</a> or <a href="https://github.com/geocodio/docs" target="_blank">create a pull request</a>.</td>
  </tr>
</tbody></table>

> Installing the library:

```shell
# Make sure to have `curl` installed to test the API in your terminal
```

```ruby
# Add thge following to your Gemfile:
gem 'geocodio'

# And then run:
bundle install
```

```python
pip install pygeocodio
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

```clojure
# Leiningen
[rodeo "2.0.1"]

# Maven
<dependency>
  <groupId>rodeo</groupId>
  <artifactId>rodeo</artifactId>
  <version>2.0.1</version>
</dependency>

# Gradle
compile "rodeo:rodeo:2.0.1"
```

# Authentication

> To set the `API_KEY`:

```shell
# With curl, you can just pass the query parameter with each request
curl "https://api.geocod.io/v1.6/api_endpoint_here?api_key=YOUR_API_KEY"
```

```ruby
require 'geocodio'

geocodio = Geocodio::Client.new('YOUR_API_KEY')
```

```python
from geocodio import GeocodioClient

client = GeocodioClient(YOUR_API_KEY)
```

<!--HIPAA
```php
<?php
$geocoder = new Geocodio\Geocodio();
$geocoder->setApiKey('YOUR_API_KEY');
$geocoder->setHostname('api-hipaa.geocod.io');
```
HIPAA-->

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

<!--HIPAA
```javascript
const Geocodio = require('geocodio-library-node');
const geocoder = new Geocodio('YOUR_API_KEY', 'api-hipaa.geocod.io');

// You can also leave out the parameters and define the following environment variables instead:
// GEOCODIO_API_KEY=YOUR_API_KEY
// GEOCODIO_HOSTNAME=api-hipaa.geocod.io
```
HIPAA-->

```clojure
(ns my.ns
  (:require [rodeo.core :refer :all]))

;; You can set the API key in the GEOCODIO_API_KEY environment variable
;; or with each request using the :api_key parameter
```

All requests require an API key. You can [register here](https://dash.geocod.io) to get your own API key.

The API key must be included in all requests using the `?api_key=YOUR_API_KEY` query parameter.

Accounts can have multiple API keys. This can be useful if you're working on several projects and want to be able to revoke access using the API key for a single project in the future or if you want to keep track of usage per API key.

You can also download a CSV of usage and fees per API key.

<aside class="warning">
Make sure to replace YOUR_API_KEY with your personal API key found on the <a href="https://dash.geocod.io" target="_blank">Geocodio dashboard</a>.
</aside>

# Geocoding

Geocoding (also known as forward geocoding) allows you to convert one or more addresses into geographic coordinates (i.e. latitude and longitude). Geocoding will also parse the address and append additional information (e.g. if you specify a zip code, Geocodio will return the city and state corresponding the zip code as well)

Geocodio supports geocoding of addresses, cities and zip codes in various formats.

<aside class="notice">
Make sure to check the <a href="#address-formats">address formats</a> section for more information on the different address formats supported.
</aside>

You can either geocode a single address at a time or collect multiple addresses in batches in order to geocode up to 10,000 addresses at the time.

Whenever possible, batch requests are recommended since they are significantly faster due to reduced network overhead.

## Single address

A single address can be geocoded by making a simple `GET` request to the *geocode* endpoint, you can <a href="https://api.geocod.io/v1.6/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

<aside class="success">
The `results` are always ordered with the most accurate locations first. It is therefore always safe to pick the first result in the list.
</aside>

> To geocode a single address:

```shell
# Using q parameter
curl "https://api.geocod.io/v1.6/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY"

# Using individual address components
curl "https://api.geocod.io/v1.6/geocode?street=1109+N+Highland+St&city=Arlington&state=VA&api_key=YOUR_API_KEY"
```

```ruby
require 'geocodio'

geocodio = Geocodio::Client.new('YOUR_API_KEY')

location = geocodio.geocode(['1109 N Highland St, Arlington VA'])
```

```python
from geocodio import GeocodioClient

client = GeocodioClient(YOUR_API_KEY)

location = client.geocode("1109 N Highland St, Arlington VA")
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

```clojure
(ns my.ns
  (:require [rodeo.core :refer :all]))

(single "1109 N Highland St, Arlington VA" :api_key "YOUR_API_KEY")
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

`GET https://api.geocod.io/v1.6/geocode`

### URL Parameters

Parameter | Description
--------- | -----------
`q`       | The query (i.e. address) to geocode
`api_key` | Your Geocodio API key
`limit`   | Optional parameter. The maximum number of results to return. The default is no limit.

***

**Alternative URL Parameters**

Instead of using the *q* parameter, you can use a combination of `street`, `city`, `state` `postal_code`, and/or `country`. This can be useful if the address is already stored as separate fields on your end.

Parameter     | Description
------------- | -----------
`street`      | E.g. 1600 Pennsylvania Ave NW
`city`        | E.g. Washington
`state`       | E.g. DC
`postal_code` | E.g. 20500
`country`     | E.g. Canada (Default to USA)
`api_key`     | Your Geocodio API key
`limit`       | Optional parameter. The maximum number of results to return. The default is no limit.

<aside>
<strong>Note:</strong> Even if the fields are supplied separately, Geocodio might in rare circumstances try to parse the street, for example, as part of the city if more relevant results can be found.
</aside>

## Batch geocoding

> To perform batch geocoding:

```shell
curl -X POST \
  -H "Content-Type: application/json" \
  -d '["1109 N Highland St, Arlington VA", "525 University Ave, Toronto, ON, Canada", "4410 S Highway 17 92, Casselberry FL", "15000 NE 24th Street, Redmond WA", "17015 Walnut Grove Drive, Morgan Hill CA"]' \
  https://api.geocod.io/v1.6/geocode?api_key=YOUR_API_KEY
```

```ruby
require 'geocodio'

geocodio = Geocodio::Client.new('YOUR_API_KEY')

locations = geocodio.geocode(['1109 N Highland St, Arlington VA', '525 University Ave, Toronto, ON, Canada', '4410 S Highway 17 92, Casselberry FL', '15000 NE 24th Street, Redmond WA', '17015 Walnut Grove Drive, Morgan Hill CA'])

```

```python
from geocodio import GeocodioClient

client = GeocodioClient(YOUR_API_KEY)

locations = client.geocode([
  '1109 N Highland St, Arlington VA',
  '525 University Ave, Toronto, ON, Canada',
  '4410 S Highway 17 92, Casselberry FL',
  '15000 NE 24th Street, Redmond WA',
  '17015 Walnut Grove Drive, Morgan Hill CA'
])
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

```clojure
(ns my.ns
  (:require [rodeo.core :refer :all]))

;; You can set the API key in the GEOCODIO_API_KEY environment variable

(batch ["1109 N Highland St, Arlington VA" "525 University Ave, Toronto, ON, Canada" "4410 S Highway 17 92, Casselberry FL" "15000 NE 24th Street, Redmond WA" "17015 Walnut Grove Drive, Morgan Hill CA"] :api_key "YOUR_API_KEY")
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

If you have several addresses that you need to geocode, batch geocoding is a much faster option since it removes the overhead of having to perform multiple `HTTP` requests.

Batch geocoding requests are performed by making a `POST` request to the *geocode* endpoint, suppliying a `JSON` array or `JSON` object in the body with any key of your choosing.

<aside class="warning">
You can batch geocode up to 10,000 addresses at the time. Geocoding 10,000 addresses takes about 600 seconds, so please make sure to adjust your timeout value accordingly.
</aside>

### HTTP Request

`POST https://api.geocod.io/v1.6/geocode`

### URL Parameters

Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
`limit`   | Optional parameter. The maximum number of results to return. The default is no limit.

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

### JSON object
<pre class="inline">
{
  "1": "1109 N Highland St, Arlington VA",
  "2": "525 University Ave, Toronto, ON, Canada",
  "3": "4410 S Highway 17 92, Casselberry FL",
  "4": "15000 NE 24th Street, Redmond WA",
  "5": "17015 Walnut Grove Drive, Morgan Hill CA"
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
curl "https://api.geocod.io/v1.6/reverse?q=38.9002898,-76.9990361&api_key=YOUR_API_KEY"
```

```ruby
require 'geocodio'

geocodio = Geocodio::Client.new('YOUR_API_KEY')

addresses = geocodio.reverse_geocode(['38.9002898,-76.9990361'])
```

```python
from geocodio import GeocodioClient

client = GeocodioClient(YOUR_API_KEY)

addresses = client.reverse((38.9002898, -76.9990361))
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

```clojure
(ns my.ns
  (:require [rodeo.core :refer :all]))

(single-reverse "38.9002898,-76.9990361" :api_key "YOUR_API_KEY")
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

A single coordinate can be reverse geocoded by making a simple `GET` request to the *reverse* endpoint, you can <a href="https://api.geocod.io/v1.6/reverse?q=38.9002898,-76.9990361&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

### HTTP Request

`GET https://api.geocod.io/v1.6/reverse`

### URL Parameters

Parameter | Description
--------- | -----------
`q`       | The query (i.e. latitude/longitude pair) to geocode. The coordinate pair should be comma-separated
`api_key` | Your Geocodio API key
`limit`   | Optional parameter. The maximum number of results to return. The default is no limit.

## Batch reverse geocoding

> To perform batch reverse geocoding:

```shell
curl -X POST \
  -H "Content-Type: application/json" \
  -d '["35.9746000,-77.9658000","32.8793700,-96.6303900","33.8337100,-117.8362320","35.4171240,-80.6784760"]' \
  https://api.geocod.io/v1.6/reverse?api_key=YOUR_API_KEY
```

```ruby
require 'geocodio'

geocodio = Geocodio::Client.new('YOUR_API_KEY')

address_sets = geocodio.reverse_geocode(['35.9746000,-77.9658000', '32.8793700,-96.6303900', '33.8337100,-117.8362320', '35.4171240,-80.6784760'])
```

```python
from geocodio import GeocodioClient

client = GeocodioClient(YOUR_API_KEY)

address_sets = client.reverse([
  (35.9746000, -77.9658000),
  (32.8793700, -96.6303900),
  (33.8337100, -117.8362320),
  (35.4171240, -80.6784760),
])
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
  '32.8793700,96.6303900',
  '33.8337100,117.8362320',
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

```clojure
(ns my.ns
  (:require [rodeo.core :refer :all]))

(batch-reverse ["35.9746000,-77.9658000" "32.8793700,-96.6303900" "33.8337100,-117.8362320" "35.4171240,-80.6784760"] :api-key "YOUR_API_KEY")
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
            "formatted_address": "101 W Washington St, Nashville, NC 27856",
            "location": {
              "lat": 35.974357,
              "lng": -77.966064
            },
            "accuracy": 1,
            "accuracy_type": "rooftop",
            "source": "NC Geographic Information Coordinating Council"
          },
          {
            "address_components": {
              "number": "100",
              "predirectional": "E",
              "street": "Washington",
              "suffix": "St",
              "formatted_street": "E Washington St",
              "city": "Nashville",
              "county": "Nash County",
              "state": "NC",
              "zip": "27856",
              "country": "US"
            },
            "formatted_address": "100 E Washington St, Nashville, NC 27856",
            "location": {
              "lat": 35.974786,
              "lng": -77.965387
            },
            "accuracy": 0.9,
            "accuracy_type": "rooftop",
            "source": "NC Geographic Information Coordinating Council"
          },
          ...
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

Batch reverse geocoding requests are performed by making a `POST` request to the *reverse* endpoint, suppliying a `JSON` array in the body.

<aside class="warning">
You can batch reverse geocode up to 10,000 coordinates at a time.
</aside>

### HTTP Request

`POST https://api.geocod.io/v1.6/reverse`

### URL Parameters

Parameter | Description
--------- | -----------
`api_key` | Your Geocodio API key
`limit`   | Optional parameter. The maximum number of results to return. The default is no limit.

# Fields

> To get e.g. the Congressional and state legislative districts for an address:

```shell
curl "https://api.geocod.io/v1.6/geocode?q=1109+N+Highland+St%2c+Arlington+VA&fields=cd,stateleg&api_key=YOUR_API_KEY"
```

```ruby
require 'geocodio'

geocodio = Geocodio::Client.new('YOUR_API_KEY')

location = geocodio.geocode(['1109 N Highland St, Arlington VA'], :fields %w[cd stateleg])
```

```python
from geocodio import GeocodioClient

client = GeocodioClient(YOUR_API_KEY)

location = client.geocode("1109 N Highland St, Arlington VA", fields=["cd", "stateleg"])
```

```php
<?php
$response = $geocoder->geocode('1109 N Highland St, Arlington VA', ['cd', 'stateleg']);
```

```javascript
const Geocodio = require('geocodio-library-node');
const geocodio = new Geocodio('YOUR_API_KEY');

geocoder.geocode('1109 N Highland St, Arlington VA', ['cd', 'stateleg'])
  .then(response => {
    console.log(response);
  })
  .catch(err => {
    console.error(err);
  }
);
```

```clojure
(ns my.ns
  (:require [rodeo.core :refer :all]))

(single "1109 N Highland St, Arlington VA" :api_key "YOUR_API_KEY" :fields ["cd" "stateleg"])
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
      "formatted_address": "1109 N Highland St, Arlington, VA 22201",
      "location": {
        "lat": 38.886672,
        "lng": -77.094735
      },
      "accuracy": 1,
      "accuracy_type": "rooftop",
      "source": "Arlington",
      "fields": {
        "congressional_districts": [
          {
            "name": "Congressional District 8",
            "district_number": 8,
            "congress_number": "116th",
            "congress_years": "2019-2021",
            "proportion": 1,
            "current_legislators": [
              {
                "type": "representative",
                "bio": {
                  "last_name": "Beyer",
                  "first_name": "Donald",
                  "birthday": "1950-06-20",
                  "gender": "M",
                  "party": "Democrat"
                },
                "contact": {
                  "url": "https://beyer.house.gov",
                  "address": "1119 Longworth House Office Building Washington DC 20515-4608",
                  "phone": "(202) 225-4376",
                  "contact_form": null
                },
                "social": {
                  "rss_url": null,
                  "twitter": "RepDonBeyer",
                  "facebook": "RepDonBeyer",
                  "youtube": null,
                  "youtube_id": "UCPJGVbOVcAVGiBwq8qr_T9w"
                },
                "references": {
                  "bioguide_id": "B001292",
                  "thomas_id": "02272",
                  "opensecrets_id": "N00036018",
                  "lis_id": null,
                  "cspan_id": "21141",
                  "govtrack_id": "412657",
                  "votesmart_id": "1707",
                  "ballotpedia_id": null,
                  "washington_post_id": null,
                  "icpsr_id": "21554",
                  "wikipedia_id": "Don Beyer"
                },
                "source": "Legislator data is originally collected and aggregated by https://github.com/unitedstates/"
              },
              {
                "type": "senator",
                "bio": {
                  "last_name": "Warner",
                  "first_name": "Mark",
                  "birthday": "1954-12-15",
                  "gender": "M",
                  "party": "Democrat"
                },
                "contact": {
                  "url": "https://www.warner.senate.gov",
                  "address": "703 Hart Senate Office Building Washington DC 20510",
                  "phone": "202-224-2023",
                  "contact_form": "http://www.warner.senate.gov/public/index.cfm?p=Contact"
                },
                "social": {
                  "rss_url": "http://www.warner.senate.gov/public/?a=rss.feed",
                  "twitter": "MarkWarner",
                  "facebook": "MarkRWarner",
                  "youtube": "SenatorMarkWarner",
                  "youtube_id": "UCwyivNlEGf4sGd1oDLfY5jw"
                },
                "references": {
                  "bioguide_id": "W000805",
                  "thomas_id": "01897",
                  "opensecrets_id": "N00002097",
                  "lis_id": "S327",
                  "cspan_id": "7630",
                  "govtrack_id": "412321",
                  "votesmart_id": "535",
                  "ballotpedia_id": "Mark Warner",
                  "washington_post_id": null,
                  "icpsr_id": "40909",
                  "wikipedia_id": "Mark Warner"
                },
                "source": "Legislator data is originally collected and aggregated by https://github.com/unitedstates/"
              },
              {
                "type": "senator",
                "bio": {
                  "last_name": "Kaine",
                  "first_name": "Timothy",
                  "birthday": "1958-02-26",
                  "gender": "M",
                  "party": "Democrat"
                },
                "contact": {
                  "url": "https://www.kaine.senate.gov",
                  "address": null,
                  "phone": null,
                  "contact_form": null
                },
                "social": {
                  "rss_url": "http://www.kaine.senate.gov/rss/feeds/?type=all",
                  "twitter": null,
                  "facebook": "SenatorKaine",
                  "youtube": "SenatorTimKaine",
                  "youtube_id": "UC27LgTZlUnBQoNEQFZdn9LA"
                },
                "references": {
                  "bioguide_id": "K000384",
                  "thomas_id": "02176",
                  "opensecrets_id": "N00033177",
                  "lis_id": "S362",
                  "cspan_id": "49219",
                  "govtrack_id": "412582",
                  "votesmart_id": "50772",
                  "ballotpedia_id": "Tim Kaine",
                  "washington_post_id": null,
                  "icpsr_id": "41305",
                  "wikipedia_id": "Tim Kaine"
                },
                "source": "Legislator data is originally collected and aggregated by https://github.com/unitedstates/"
              }
            ]
          }
        ],
        "state_legislative_districts": {
          "house": {
            "name": "State House District 47",
            "district_number": "47",
            "is_upcoming_state_legislative_district": false
          },
          "senate": {
            "name": "State Senate District 31",
            "district_number": "31",
            "is_upcoming_state_legislative_district": false
          }
        }
      }
    }
  ]
}
```

<aside class="warning">
<strong>Note:</strong> Fields count as an additional lookup each. Please consult our <a href="/pricing/">pricing calculator</a>.
</aside>

Geocodio allows you to request additional data with forward and reverse geocoding requests. We call this additional data *fields*.

To request additional data, just add a `fields` parameter to your query string and set the value according to the table below. You can request multiple data fields at the same time by separating them with a comma. If the `fields` parameter has been specified, a new `fields` key is exposed with each geocoding result containing all necessary data for each field.

Go ahead, <a href="https://api.geocod.io/v1.6/geocode?q=1109+N+Highland+St%2c+Arlington+VA&fields=cd&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

Some fields are specific to the US and cannot be queried for other countries.

Parameter name                                                                                                                 | Description                                            | Coverage                    |
-------------------------------------------------------------------------------------------------------------------------------| ------------------------------------------------------ | --------------------------- |
[cd, cd113, cd114, cd115, cd116, *or* cd117](#congressional-districts)                                                                                            | Congressional District & Legislator information        | US-only                     |
[stateleg *or* stateleg-next](#state-legislative-districts)                                                                                                                       | State Legislative District (House & Senate)            | US-only                     |
[school](#school-districts)                                                                                                                         | School District (elementary/secondary or unified)      | US-only                     |
[census, census2010, census2011, census2012, census2013, census2014, census2015, census2016, census2017, census2018, census2019](#census-block-tract-fips-codes-amp-msa-csa-codes) | Census Block/Tract, FIPS codes & MSA/CSA codes         | US-only                     |
[acs-demographics](#demographics-census)                                                                                                               | Demographics (Census)                                  | US-only                     |
[acs-economics](#economics-income-data-census)                                                                                                                  | Economics: Income Data (Census)                        | US-only                     |
[acs-families](#families-census)                                                                                                                   | Families (Census)                                      | US-only                     |
[acs-housing](#housing-census)                                                                                                                    | Housing (Census)                                       | US-only                     |
[acs-social](#social-education-amp-veteran-status-census)                                                                                                                     | Social: Education & Veteran Status (Census)            | US-only                     |
[zip4](#usps-zip-4)                                                                                                                     | USPS Zip+4 code and delivery information            | US-only                     |
[riding](#riding-canadian-federal-electoral-district)                                                                                                                         | Riding: Canadian Federal Electoral District            | Canada-only                 |
[statcan](#canadian-statistical-boundaries-from-statistics-canada)                                                                                                                        | Canadian statistical boundaries from Statistics Canada | Canada-only                 |
[timezone](#timezone)                                                                                                                       | Timezone                                               | <i class="fa fa-globe"></i> |

<aside class="success">
This feature is available for both single and batch geocoding requests.
</aside>

## Congressional Districts
**Field name: `cd`, `cd113`, `cd114`, `cd115`, `cd116`, *or* `cd117`**

```json
...
"fields": {
  "congressional_districts": [
    {
      "name": "Congressional District 8",
      "district_number": 8,
      "congress_number": "116th",
      "congress_years": "2019-2021",
      "proportion": 1,
      "current_legislators": [
        {
          "type": "representative",
          "bio": {
            "last_name": "Beyer",
            "first_name": "Donald",
            "birthday": "1950-06-20",
            "gender": "M",
            "party": "Democrat"
          },
          "contact": {
            "url": "https://beyer.house.gov",
            "address": "1119 Longworth House Office Building Washington DC 20515-4608",
            "phone": "(202) 225-4376",
            "contact_form": null
          },
          "social": {
            "rss_url": null,
            "twitter": "RepDonBeyer",
            "facebook": "RepDonBeyer",
            "youtube": null,
            "youtube_id": "UCPJGVbOVcAVGiBwq8qr_T9w"
          },
          "references": {
            "bioguide_id": "B001292",
            "thomas_id": "02272",
            "opensecrets_id": "N00036018",
            "lis_id": null,
            "cspan_id": "21141",
            "govtrack_id": "412657",
            "votesmart_id": "1707",
            "ballotpedia_id": null,
            "washington_post_id": null,
            "icpsr_id": "21554",
            "wikipedia_id": "Don Beyer"
          },
          "source": "Legislator data is originally collected and aggregated by https://github.com/unitedstates/"
        },
        {
          "type": "senator",
          "bio": {
            "last_name": "Warner",
            "first_name": "Mark",
            "birthday": "1954-12-15",
            "gender": "M",
            "party": "Democrat"
          },
          "contact": {
            "url": "https://www.warner.senate.gov",
            "address": "703 Hart Senate Office Building Washington DC 20510",
            "phone": "202-224-2023",
            "contact_form": "http://www.warner.senate.gov/public/index.cfm?p=Contact"
          },
          "social": {
            "rss_url": "http://www.warner.senate.gov/public/?a=rss.feed",
            "twitter": "MarkWarner",
            "facebook": "MarkRWarner",
            "youtube": "SenatorMarkWarner",
            "youtube_id": "UCwyivNlEGf4sGd1oDLfY5jw"
          },
          "references": {
            "bioguide_id": "W000805",
            "thomas_id": "01897",
            "opensecrets_id": "N00002097",
            "lis_id": "S327",
            "cspan_id": "7630",
            "govtrack_id": "412321",
            "votesmart_id": "535",
            "ballotpedia_id": "Mark Warner",
            "washington_post_id": null,
            "icpsr_id": "40909",
            "wikipedia_id": "Mark Warner"
          },
          "source": "Legislator data is originally collected and aggregated by https://github.com/unitedstates/"
        },
        {
          "type": "senator",
          "bio": {
            "last_name": "Kaine",
            "first_name": "Timothy",
            "birthday": "1958-02-26",
            "gender": "M",
            "party": "Democrat"
          },
          "contact": {
            "url": "https://www.kaine.senate.gov",
            "address": null,
            "phone": null,
            "contact_form": null
          },
          "social": {
            "rss_url": "http://www.kaine.senate.gov/rss/feeds/?type=all",
            "twitter": null,
            "facebook": "SenatorKaine",
            "youtube": "SenatorTimKaine",
            "youtube_id": "UC27LgTZlUnBQoNEQFZdn9LA"
          },
          "references": {
            "bioguide_id": "K000384",
            "thomas_id": "02176",
            "opensecrets_id": "N00033177",
            "lis_id": "S362",
            "cspan_id": "49219",
            "govtrack_id": "412582",
            "votesmart_id": "50772",
            "ballotpedia_id": "Tim Kaine",
            "washington_post_id": null,
            "icpsr_id": "41305",
            "wikipedia_id": "Tim Kaine"
          },
          "source": "Legislator data is originally collected and aggregated by https://github.com/unitedstates/"
        }
      ]
    }
  ]
},
...
```
You can retrieve the Congressional district for an address or coordinate pair using any one of the valid parameter names in the `fields` query parameter. `cd` will always return the Congressional district for the current Congress while e.g. `cd113` will continue to show the Congressional district for the 113th Congress.

<aside class="notice">
The current congress is the 116th congress. The 117th congress will be active as of January 3, 2021. We are already providing the option to return district information for the 117th congress, which include upcoming boundary changes in <a href="https://www.ncleg.gov/BillLookup/2019/H1029" target="_blank">North Carolina</a>. Others will be added as they become available. All other states will return the same district information as given for the 116th congress.
</aside>

The field returns the full name of the Congressional district, the district number, the Congress number, and the year range. If the current congress (i.e. `cd` or `cd116`) is specified, we will also return detailed information about the current legislators.

<aside class="success">
The list of legislators is always ordered with Representative first then Senators.
</aside>

### Appending Congressional districts for ZIP codes

Geocodio can return the most likely Congressional districts given a ZIP code. In cases where there may be multiple possible Congressional districts for a postal code, we will return multiple Congressional districts, and rank them each using a `proportion` key. This key is a decimal percentage representation of how much of the district boundary that intersect with the zip code boundary (i.e. bigger number = more likely to be the correct district for citizens in that zip code).

Districts are always sorted by the `proportion` in descending order (largest first).

<aside class="notice">
  Where possible, we recommend looking up Congressional districts with full addresses rather than ZIP codes. This will result in more accurate results, as ZIP codes are postal routes rather than geographic areas.
</aside>

## State Legislative Districts
**Field name: `stateleg` or `stateleg-next`**

```json
...
"fields": {
  "state_legislative_districts": {
    "house": {
      "name": "Assembly District 42",
      "district_number": 42,
      "is_upcoming_state_legislative_district": false
    },
    "senate": {
      "name": "State Senate District 28",
      "district_number": 28,
      "is_upcoming_state_legislative_district": false
    }
  }
}
...
```
You can retrieve the state legislative districts for an address or coordinate using `stateleg` or `stateleg-next` in the `fields` query parameter.

If `stateleg-next` is requested, matches will be returned for upcoming district changes that may apply to current elections, but are not active for currently elected officials yet.

The currently updated districts that apply to `stateleg-next` are as follows:

* North Carolina House <a href="https://www.ncleg.gov/BillLookup/2019/H1020" target="_blank">HB 1020</a>
* North Carolina Senate <a href="https://www.ncleg.gov/BillLookup/2019/S692" target="_blank">SB 692</a>

For all other states, `stateleg-next` will return the same results as `stateleg`. Boundary changes in `stateleg-next` will be promoted to `stateleg` when they become active for currently elected officials.

The field will return both the *house* and *senate* state legislative district (also known as *lower* and *upper*) with the full name and district number for each. For areas with a [unicameral legislature](http://en.wikipedia.org/wiki/Unicameralism) (such as Washington, DC or Nebraska), only the `senate` key is returned.

## School Districts
**Field name: `school`**

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
You can retrieve the school district for an address or coordinate using `school` in the `fields` query parameter.

The field will return either a *unified* school district or separate *elementary* and *secondary* fields depending on the area. Each school district is returned with its full name, the LEA (Local Education Agency) code, as well as the grades supported. Kindergarden is abbreviated as *KG* and pre-kindergarten is abbreviated as *PK*.

## Census Block/Tract, FIPS codes & MSA/CSA codes
**Field name: `census`, `census2010`, `census2011`, `census2012`, `census2013`, `census2014`, `census2015`, `census2016`, `census2017`, `census2018`, `census2019`**

```json
...
"fields": {
  "census": {
    "2010": {
      "census_year": 2010,
      "state_fips": "51",
      "county_fips": "51013",
      "tract_code": "101801",
      "block_code": "1004",
      "block_group": "1",
      "full_fips": "510131018011004",
      "place": {
        "name": "Arlington",
        "fips": "5103000"
      },
      "metro_micro_statistical_area": {
        "name": "Washington-Arlington-Alexandria, DC-VA-MD-WV",
        "area_code": "47900",
        "type": "metropolitan"
      },
      "combined_statistical_area": {
        "name": "Washington-Baltimore-Northern Virginia, DC-MD-VA-WV",
        "area_code": "51548"
      },
      "metropolitan_division": {
        "name": "Washington-Arlington-Alexandria, DC-VA-MD-WV",
        "area_code": "47894"
      },
      "source": "US Census Bureau"
    },
    "2019": {
      "census_year": 2019,
      "state_fips": "51",
      "county_fips": "51013",
      "tract_code": "101801",
      "block_code": "1004",
      "block_group": "1",
      "full_fips": "510131018011004",
      "place": {
        "name": "Arlington",
        "fips": "5103000"
      },
      "metro_micro_statistical_area": {
        "name": "Washington-Arlington-Alexandria, DC-VA-MD-WV",
        "area_code": "47900",
        "type": "metropolitan"
      },
      "combined_statistical_area": {
        "name": "Washington-Baltimore-Arlington, DC-MD-VA-WV-PA",
        "area_code": "548"
      },
      "metropolitan_division": {
        "name": "Washington-Arlington-Alexandria, DC-VA-MD-WV",
        "area_code": "47894"
      },
      "source": "US Census Bureau"
    }
  }
},
...
```
This will append various US Census-designated codes to your address.

<aside class="notice">
Looking for Canadian Census data? See the <a href="#canadian-statistical-boundaries-from-statistics-canada"><code>statcan</code></a> field append.
</aside>

You can request vintage data for every year back to the 2010 Census. This is done by specifying the year together with the field name, e.g. `census2015` for 2015 data. It is also possible to request multiple years at the same time, e.g. `census2010,census2019` (as shown in the example response).

<aside class="warning">
If no year is specified, the API will default to the most recent census. I.e. currently, 2019 data is returned when appending the census field.
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

Using Census tracts and blocks, you can match addresses and latitude/longitude pairs with statistical data from the U.S. Census Bureau. For example, appending Census tracts and blocks to addresses enables you to utilize the [American Community Survey (ACS) data](https://www.census.gov/programs-surveys/acs/data.html).

### Place

This field is returned for locations that are within a census designated place. If the location is not in a census designated place, the API will return `null` instead of the individual fields.

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

## Census ACS (American Community Survey)

Geocodio can return results from the American Community Survey, for any given address in the US. This is performed by looking up 5-year estimates for the *census block group* associated with the address.

Please note that a single census block group can cover hundreds of households. As such, the returned data is not specific to the given location only.

We have divided ACS results into 5 categories: Demographics, Economics (Income Data), Families, Housing and Social (Education & Veteran Status).

### Pricing

For billing purposes, each category counts as an additional lookup. Do however note that the `census` field is always included with any `acs-` field lookups *at no additional cost*.


### Address formats

ACS field results are only returned for the following [accuracy types](#accuracy-score):

* `rooftop`
* `range_interpolation`
* `nearest_street`
* `point`
* `nearest_rooftop_match`
* `street_center`

As such, it is not possible to get ACS results for city or zip code results. Lookups are not counted towards account usage when ACS field appends are requested for these less accurate results.

### Metadata

> ACS overall metadata:

```json
...
"fields": {
  "acs": {
    "meta": {
      "source": "American Community Survey from the US Census Bureau",
      "survey_years": "2014-2018",
      "survey_duration_years": "5"
    }
    ...
  }
}
```

> Individual ACS result metadata:

```json
...
"Median age": {
  "meta": {
    "table_id": "B01002",
    "universe": "Total population"
   },
   ...
}
```

A `meta` field with high level data information is returned for all `acs` results in general as well as individual ACS values.

This contains information about the exact ACS results we are using, including the years they are covering. We always use 5-year estimates, and always use the most recent data that is available.

When our ACS results are updated to a newer version, it is not considering a breaking change. This is done as soon as newer Census data is fully available and verified.

For each individual result, we return the [official ACS table id](https://www.census.gov/programs-surveys/acs/technical-documentation/summary-file-documentation.2016.html) as well as the "universe" that the values covers.

The universe can be values such as `Households`, `Population 15 Years and Older`, `Total population`, etc.

## Demographics (Census)
**Field name: `acs-demographics`**

```json
...
"fields": {
  "census": {...},
  "acs": {
    "meta": {
      "source": "American Community Survey from the US Census Bureau",
      "survey_years": "2014-2018",
      "survey_duration_years": "5"
    },
    "demographics": {
      "Median age": {
        "meta": {
          "table_id": "B01002",
          "universe": "Total population"
        },
        "Total": {
          "value": 32.8,
          "margin_of_error": 0.6
        },
        "Male": {
          "value": 34.6,
          "margin_of_error": 1.8
        },
        "Female": {
          "value": 31.8,
          "margin_of_error": 0.9
        }
      },
      "Population by age range": {
        "meta": {
          "table_id": "B01001",
          "universe": "Total population"
        },
        "Total": {
          "value": 3366,
          "margin_of_error": 268
        },
        "Male": {
          "value": 1603,
          "margin_of_error": 174,
          "percentage": 0.476
        },
        "Male: Under 5 years": {
          "value": 94,
          "margin_of_error": 57,
          "percentage": 0.059
        },
        "Male: 5 to 9 years": {
          "value": 43,
          "margin_of_error": 31,
          "percentage": 0.027
        },
        "Male: 10 to 14 years": {
          "value": 15,
          "margin_of_error": 27,
          "percentage": 0.009
        },
        "Male: 15 to 17 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 18 and 19 years": {
          "value": 11,
          "margin_of_error": 18,
          "percentage": 0.007
        },
        "Male: 20 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 21 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 22 to 24 years": {
          "value": 72,
          "margin_of_error": 42,
          "percentage": 0.045
        },
        "Male: 25 to 29 years": {
          "value": 262,
          "margin_of_error": 83,
          "percentage": 0.163
        },
        "Male: 30 to 34 years": {
          "value": 327,
          "margin_of_error": 94,
          "percentage": 0.204
        },
        "Male: 35 to 39 years": {
          "value": 176,
          "margin_of_error": 59,
          "percentage": 0.11
        },
        "Male: 40 to 44 years": {
          "value": 188,
          "margin_of_error": 61,
          "percentage": 0.117
        },
        "Male: 45 to 49 years": {
          "value": 64,
          "margin_of_error": 40,
          "percentage": 0.04
        },
        "Male: 50 to 54 years": {
          "value": 181,
          "margin_of_error": 92,
          "percentage": 0.113
        },
        "Male: 55 to 59 years": {
          "value": 92,
          "margin_of_error": 63,
          "percentage": 0.057
        },
        "Male: 60 and 61 years": {
          "value": 8,
          "margin_of_error": 15,
          "percentage": 0.005
        },
        "Male: 62 to 64 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 65 and 66 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 67 to 69 years": {
          "value": 31,
          "margin_of_error": 29,
          "percentage": 0.019
        },
        "Male: 70 to 74 years": {
          "value": 27,
          "margin_of_error": 19,
          "percentage": 0.017
        },
        "Male: 75 to 79 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 80 to 84 years": {
          "value": 12,
          "margin_of_error": 19,
          "percentage": 0.007
        },
        "Male: 85 years and over": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female": {
          "value": 1763,
          "margin_of_error": 202,
          "percentage": 0.524
        },
        "Female: Under 5 years": {
          "value": 113,
          "margin_of_error": 60,
          "percentage": 0.064
        },
        "Female: 5 to 9 years": {
          "value": 82,
          "margin_of_error": 71,
          "percentage": 0.047
        },
        "Female: 10 to 14 years": {
          "value": 25,
          "margin_of_error": 40,
          "percentage": 0.014
        },
        "Female: 15 to 17 years": {
          "value": 24,
          "margin_of_error": 33,
          "percentage": 0.014
        },
        "Female: 18 and 19 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 20 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 21 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 22 to 24 years": {
          "value": 44,
          "margin_of_error": 27,
          "percentage": 0.025
        },
        "Female: 25 to 29 years": {
          "value": 399,
          "margin_of_error": 99,
          "percentage": 0.226
        },
        "Female: 30 to 34 years": {
          "value": 466,
          "margin_of_error": 142,
          "percentage": 0.264
        },
        "Female: 35 to 39 years": {
          "value": 173,
          "margin_of_error": 63,
          "percentage": 0.098
        },
        "Female: 40 to 44 years": {
          "value": 119,
          "margin_of_error": 47,
          "percentage": 0.067
        },
        "Female: 45 to 49 years": {
          "value": 116,
          "margin_of_error": 65,
          "percentage": 0.066
        },
        "Female: 50 to 54 years": {
          "value": 43,
          "margin_of_error": 32,
          "percentage": 0.024
        },
        "Female: 55 to 59 years": {
          "value": 13,
          "margin_of_error": 20,
          "percentage": 0.007
        },
        "Female: 60 and 61 years": {
          "value": 30,
          "margin_of_error": 28,
          "percentage": 0.017
        },
        "Female: 62 to 64 years": {
          "value": 63,
          "margin_of_error": 39,
          "percentage": 0.036
        },
        "Female: 65 and 66 years": {
          "value": 9,
          "margin_of_error": 12,
          "percentage": 0.005
        },
        "Female: 67 to 69 years": {
          "value": 12,
          "margin_of_error": 15,
          "percentage": 0.007
        },
        "Female: 70 to 74 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 75 to 79 years": {
          "value": 32,
          "margin_of_error": 35,
          "percentage": 0.018
        },
        "Female: 80 to 84 years": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 85 years and over": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        }
      },
      "Sex": {
        "meta": {
          "table_id": "B01001",
          "universe": "Total population"
        },
        "Total": {
          "value": 3366,
          "margin_of_error": 268
        },
        "Male": {
          "value": 1603,
          "margin_of_error": 174,
          "percentage": 0.476
        },
        "Female": {
          "value": 1763,
          "margin_of_error": 202,
          "percentage": 0.524
        }
      },
      "Race and ethnicity": {
        "meta": {
          "table_id": "B03002",
          "universe": "Total population"
        },
        "Total": {
          "value": 3366,
          "margin_of_error": 268
        },
        "Not Hispanic or Latino": {
          "value": 3169,
          "margin_of_error": 282,
          "percentage": 0.941
        },
        "Not Hispanic or Latino: White alone": {
          "value": 2386,
          "margin_of_error": 303,
          "percentage": 0.753
        },
        "Not Hispanic or Latino: Black or African American alone": {
          "value": 83,
          "margin_of_error": 68,
          "percentage": 0.026
        },
        "Not Hispanic or Latino: American Indian and Alaska Native alone": {
          "value": 12,
          "margin_of_error": 19,
          "percentage": 0.004
        },
        "Not Hispanic or Latino: Asian alone": {
          "value": 528,
          "margin_of_error": 176,
          "percentage": 0.167
        },
        "Not Hispanic or Latino: Native Hawaiian and Other Pacific Islander alone": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Not Hispanic or Latino: Some other race alone": {
          "value": 8,
          "margin_of_error": 12,
          "percentage": 0.003
        },
        "Not Hispanic or Latino: Two or more races": {
          "value": 152,
          "margin_of_error": 86,
          "percentage": 0.048
        },
        "Not Hispanic or Latino: Two or more races: Two races including Some other race": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Not Hispanic or Latino: Two or more races: Two races excluding Some other race, and three or more races": {
          "value": 152,
          "margin_of_error": 86,
          "percentage": 1
        },
        "Hispanic or Latino": {
          "value": 197,
          "margin_of_error": 109,
          "percentage": 0.059
        },
        "Hispanic or Latino: White alone": {
          "value": 189,
          "margin_of_error": 107,
          "percentage": 0.959
        },
        "Hispanic or Latino: Black or African American alone": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Hispanic or Latino: American Indian and Alaska Native alone": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Hispanic or Latino: Asian alone": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Hispanic or Latino: Native Hawaiian and Other Pacific Islander alone": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Hispanic or Latino: Some other race alone": {
          "value": 8,
          "margin_of_error": 12,
          "percentage": 0.041
        },
        "Hispanic or Latino: Two or more races": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Hispanic or Latino: Two or more races: Two races including Some other race": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Hispanic or Latino: Two or more races: Two races excluding Some other race, and three or more races": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        }
      }
    }
  }
}
...
```

We provide the data exactly as it is packaged by the Census Bureau in the breakouts it gives. The only change we have made is to add a "percentage" calculation to aid ease of use.

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

## Economics: Income Data (Census)
**Field name: `acs-economics`**

```json
...
"fields": {
  "census": {...},
  "acs": {
    "meta": {
      "source": "American Community Survey from the US Census Bureau",
      "survey_years": "2014-2018",
      "survey_duration_years": "5"
    },
    "economics": {
      "Number of households": {
        "meta": {
          "table_id": "B19001",
          "universe": "Households"
        },
        "Total": {
          "value": 1904,
          "margin_of_error": 99
        }
      },
      "Median household income": {
        "meta": {
          "table_id": "B19013",
          "universe": "Households"
        },
        "Total": {
          "value": 152643,
          "margin_of_error": 15674
        }
      },
      "Household income": {
        "meta": {
          "table_id": "B19001",
          "universe": "Households"
        },
        "Less than $10,000": {
          "value": 23,
          "margin_of_error": 25,
          "percentage": 0.012
        },
        "$10,000 to $14,999": {
          "value": 17,
          "margin_of_error": 20,
          "percentage": 0.009
        },
        "$15,000 to $19,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$20,000 to $24,999": {
          "value": 24,
          "margin_of_error": 29,
          "percentage": 0.013
        },
        "$25,000 to $29,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$30,000 to $34,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$35,000 to $39,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$40,000 to $44,999": {
          "value": 8,
          "margin_of_error": 13,
          "percentage": 0.004
        },
        "$45,000 to $49,999": {
          "value": 45,
          "margin_of_error": 50,
          "percentage": 0.024
        },
        "$50,000 to $59,999": {
          "value": 17,
          "margin_of_error": 18,
          "percentage": 0.009
        },
        "$60,000 to $74,999": {
          "value": 69,
          "margin_of_error": 44,
          "percentage": 0.036
        },
        "$75,000 to $99,999": {
          "value": 208,
          "margin_of_error": 78,
          "percentage": 0.109
        },
        "$100,000 to $124,999": {
          "value": 247,
          "margin_of_error": 82,
          "percentage": 0.13
        },
        "$125,000 to $149,999": {
          "value": 268,
          "margin_of_error": 95,
          "percentage": 0.141
        },
        "$150,000 to $199,999": {
          "value": 357,
          "margin_of_error": 102,
          "percentage": 0.188
        },
        "$200,000 or more": {
          "value": 621,
          "margin_of_error": 131,
          "percentage": 0.326
        }
      }
    }
  }
}
...
```

We provide the data exactly as it is packaged by the Census Bureau in the breakouts it gives. The only change we have made is to add a "percentage" calculation to aid ease of use.

The data returned includes the following data points. For each data point, the data returned includes the value, margin of error, and percentage.

* Median household income (Table #B19013)
* Household income (Table #B19001)
  * less than $10,000; $10,000-$14,999; $15,000-$19,999; $20,000-$24,999; $25,000-$29,999; $30,000-$34,999; $40,000-$44,999; $45,000-$49,999; $50,000-$59,000; $60,000-$74,999; $75,000-$99,999; $100,000-$124,999; $125,000-$149,000; $150,000-$199,999; $200,000 or more

## Families (Census)
**Field name: `acs-families`**

```json
...
"fields": {
  "census": {...},
  "acs": {
    "meta": {
      "source": "American Community Survey from the US Census Bureau",
      "survey_years": "2014-2018",
      "survey_duration_years": "5"
    },
    "families": {
      "Household type by household": {
        "meta": {
          "table_id": "B11001",
          "universe": "Households"
        },
        "Total": {
          "value": 1904,
          "margin_of_error": 99
        },
        "Family households": {
          "value": 608,
          "margin_of_error": 126,
          "percentage": 0.319
        },
        "Family households: Married-couple family": {
          "value": 518,
          "margin_of_error": 111,
          "percentage": 0.852
        },
        "Family households: Other family": {
          "value": 90,
          "margin_of_error": 63,
          "percentage": 0.148
        },
        "Family households: Other family: Male householder, no wife present": {
          "value": 48,
          "margin_of_error": 57,
          "percentage": 0.533
        },
        "Family households: Other family: Female householder, no husband present": {
          "value": 42,
          "margin_of_error": 28,
          "percentage": 0.467
        },
        "Nonfamily households": {
          "value": 1296,
          "margin_of_error": 126,
          "percentage": 0.681
        },
        "Nonfamily households: Householder living alone": {
          "value": 911,
          "margin_of_error": 127,
          "percentage": 0.703
        },
        "Nonfamily households: Householder not living alone": {
          "value": 385,
          "margin_of_error": 91,
          "percentage": 0.297
        }
      },
      "Household type by population": {
        "meta": {
          "table_id": "B11002",
          "universe": "Population in Households"
        },
        "Total": {
          "value": 3366,
          "margin_of_error": 268
        },
        "In family households": {
          "value": 1624,
          "margin_of_error": 309,
          "percentage": 0.482
        },
        "In family households: In married-couple family": {
          "value": 1398,
          "margin_of_error": 277,
          "percentage": 0.861
        },
        "In family households: In married-couple family: Relatives": {
          "value": 1398,
          "margin_of_error": 277,
          "percentage": 1
        },
        "In family households: In married-couple family: Nonrelatives": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "In family households: In male householder, no wife present, family": {
          "value": 116,
          "margin_of_error": 138,
          "percentage": 0.071
        },
        "In family households: In male householder, no wife present, family: Relatives": {
          "value": 116,
          "margin_of_error": 138,
          "percentage": 1
        },
        "In family households: In male householder, no wife present, family: Nonrelatives": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "In family households: In female householder, no husband present, family": {
          "value": 110,
          "margin_of_error": 73,
          "percentage": 0.068
        },
        "In family households: In female householder, no husband present, family: Relatives": {
          "value": 110,
          "margin_of_error": 73,
          "percentage": 1
        },
        "In family households: In female householder, no husband present, family: Nonrelatives": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "In nonfamily households": {
          "value": 1742,
          "margin_of_error": 200,
          "percentage": 0.518
        }
      },
      "Marital status": {
        "meta": {
          "table_id": "B12001",
          "universe": "Population 15 Years And Older"
        },
        "Male": {
          "value": 1451,
          "margin_of_error": 160,
          "percentage": 0.485
        },
        "Male: Never married": {
          "value": 727,
          "margin_of_error": 159,
          "percentage": 0.501
        },
        "Male: Now married": {
          "value": 585,
          "margin_of_error": 134,
          "percentage": 0.403
        },
        "Male: Now married: Married, spouse present": {
          "value": 528,
          "margin_of_error": 115,
          "percentage": 0.903
        },
        "Male: Now married: Married, spouse absent": {
          "value": 57,
          "margin_of_error": 58,
          "percentage": 0.097
        },
        "Male: Now married: Married, spouse absent: Separated": {
          "value": 6,
          "margin_of_error": 10,
          "percentage": 0.105
        },
        "Male: Now married: Married, spouse absent: Other": {
          "value": 51,
          "margin_of_error": 57,
          "percentage": 0.895
        },
        "Male: Widowed": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: Divorced": {
          "value": 139,
          "margin_of_error": 74,
          "percentage": 0.096
        },
        "Female": {
          "value": 1543,
          "margin_of_error": 177,
          "percentage": 0.515
        },
        "Female: Never married": {
          "value": 858,
          "margin_of_error": 170,
          "percentage": 0.556
        },
        "Female: Now married": {
          "value": 496,
          "margin_of_error": 96,
          "percentage": 0.321
        },
        "Female: Now married: Married, spouse present": {
          "value": 484,
          "margin_of_error": 101,
          "percentage": 0.976
        },
        "Female: Now married: Married, spouse absent": {
          "value": 12,
          "margin_of_error": 15,
          "percentage": 0.024
        },
        "Female: Now married: Married, spouse absent: Separated": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: Now married: Married, spouse absent: Other": {
          "value": 12,
          "margin_of_error": 15,
          "percentage": 1
        },
        "Female: Widowed": {
          "value": 24,
          "margin_of_error": 28,
          "percentage": 0.016
        },
        "Female: Divorced": {
          "value": 165,
          "margin_of_error": 62,
          "percentage": 0.107
        }
      }
    }
  }
}
...
```

We provide the data exactly as it is packaged by the Census Bureau in the breakouts it gives. The only change we have made is to add a "percentage" calculation to aid ease of use.

The data returned includes the following data points. For each data point, the data returned includes the value, margin of error, and percentage.

* Family households (Table #B11001)
  * total; married-couple family; other family; other family: male householder, no wife present; other family: female householder, no husband present; non-family households; non-family households -- householder living alone; non-family households -- householder not living alone
* Household type by population (Table #B11002)
  * total; in family households; in married-couple family; in married-couple family: relatives; in married-couple family: non-relatives; in male householder, no wife present, family; in male householder, no wife present, family: relatives; in male householder, no wife present, family: nonrelatives; in female householder, no husband present, family; in female householder, no husband present, family: relatives; in female householder, no husband present, family: in nonfamily households
* Marital status (Table #B12001)
  * never married; now married; now married: married, spouse present; married, spouse absent; married, spouse absent: separated; married, spouse absent: other; married, spouse absent, widowed; married, spouse absent, divorced; male never married; female never married

<aside class="notice">
We recognize that household composition is a sensitive subject. Accordingly, we report the categories exactly as the Census Bureau provides. We recognize that the categories listed may not be all-inclusive or use preferred terminology.
</aside>

## Housing (Census)
**Field name: `acs-housing`**

```json
...
"fields": {
  "census": {...},
  "acs": {
    "meta": {
      "source": "American Community Survey from the US Census Bureau",
      "survey_years": "2014-2018",
      "survey_duration_years": "5"
    },
    "housing": {
      "Number of housing units": {
        "meta": {
          "table_id": "B25002",
          "universe": "Housing Units"
        },
        "Total": {
          "value": 2070,
          "margin_of_error": 49
        }
      },
      "Occupancy status": {
        "meta": {
          "table_id": "B25002",
          "universe": "Housing Units"
        },
        "Occupied": {
          "value": 1904,
          "margin_of_error": 99,
          "percentage": 0.92
        },
        "Vacant": {
          "value": 166,
          "margin_of_error": 87,
          "percentage": 0.08
        }
      },
      "Ownership of occupied units": {
        "meta": {
          "table_id": "B25003",
          "universe": "Occupied Housing Units"
        },
        "Owner occupied": {
          "value": 635,
          "margin_of_error": 118,
          "percentage": 0.334
        },
        "Renter occupied": {
          "value": 1269,
          "margin_of_error": 127,
          "percentage": 0.666
        }
      },
      "Units in structure": {
        "meta": {
          "table_id": "B25024",
          "universe": "Housing Units"
        },
        "1, detached unit": {
          "value": 163,
          "margin_of_error": 74,
          "percentage": 0.079
        },
        "1, attached unit": {
          "value": 94,
          "margin_of_error": 34,
          "percentage": 0.045
        },
        "2 units": {
          "value": 22,
          "margin_of_error": 35,
          "percentage": 0.011
        },
        "3 or 4 units": {
          "value": 44,
          "margin_of_error": 51,
          "percentage": 0.021
        },
        "5 to 9 units": {
          "value": 17,
          "margin_of_error": 20,
          "percentage": 0.008
        },
        "10 to 19 unit": {
          "value": 12,
          "margin_of_error": 19,
          "percentage": 0.006
        },
        "20 to 49 units": {
          "value": 83,
          "margin_of_error": 66,
          "percentage": 0.04
        },
        "50 or more units": {
          "value": 1635,
          "margin_of_error": 108,
          "percentage": 0.79
        },
        "Mobile home units": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Boat, RV, van, etc. units": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        }
      },
      "Median value of owner-occupied housing units": {
        "meta": {
          "table_id": "B25077",
          "universe": "Owner-Occupied Housing Units"
        },
        "Total": {
          "value": 584700,
          "margin_of_error": 83312
        }
      },
      "Value of owner-occupied housing units": {
        "meta": {
          "table_id": "B25075",
          "universe": "Owner-Occupied Housing Units"
        },
        "Less than $10,000": {
          "value": 12,
          "margin_of_error": 18,
          "percentage": 0.019
        },
        "$10,000 to $14,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$15,000 to $19,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$20,000 to $24,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$25,000 to $29,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$30,000 to $34,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$35,000 to $39,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$40,000 to $49,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$50,000 to $59,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$60,000 to $69,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$70,000 to $79,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$80,000 to $89,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$90,000 to $99,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$100,000 to $124,999": {
          "value": 14,
          "margin_of_error": 13,
          "percentage": 0.022
        },
        "$125,000 to $149,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$150,000 to $174,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$175,000 to $199,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$200,000 to $249,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$250,000 to $299,999": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "$300,000 to $399,999": {
          "value": 8,
          "margin_of_error": 14,
          "percentage": 0.013
        },
        "$400,000 to $499,999": {
          "value": 212,
          "margin_of_error": 116,
          "percentage": 0.334
        },
        "$500,000 to $749,999": {
          "value": 211,
          "margin_of_error": 72,
          "percentage": 0.332
        },
        "$750,000 to $999,999": {
          "value": 83,
          "margin_of_error": 38,
          "percentage": 0.131
        },
        "$1,000,000 to $1,499,999": {
          "value": 54,
          "margin_of_error": 33,
          "percentage": 0.085
        },
        "$1,500,000 to $1,999,999": {
          "value": 41,
          "margin_of_error": 24,
          "percentage": 0.065
        },
        "$2,000,000 or more": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        }
      }
    }
  }
}
...
```

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

```json
...
"fields": {
  "census": {...},
  "acs": {
    "meta": {
      "source": "American Community Survey from the US Census Bureau",
      "survey_years": "2014-2018",
      "survey_duration_years": "5"
    },
    "social": {
      "Population by minimum level of education": {
        "meta": {
          "table_id": "B15002",
          "universe": "Population 25 Years And Over"
        },
        "Total": {
          "value": 2843,
          "margin_of_error": 208
        },
        "Male": {
          "value": 1368,
          "margin_of_error": 148,
          "percentage": 0.481
        },
        "Male: No schooling completed": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: Nursery to 4th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 5th and 6th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 7th and 8th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 9th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 10th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 11th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: 12th grade, no diploma": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Male: High school graduate (includes equivalency)": {
          "value": 26,
          "margin_of_error": 20,
          "percentage": 0.019
        },
        "Male: Some college, less than 1 year": {
          "value": 6,
          "margin_of_error": 10,
          "percentage": 0.004
        },
        "Male: Some college, 1 or more years, no degree": {
          "value": 39,
          "margin_of_error": 27,
          "percentage": 0.029
        },
        "Male: Associate's degree": {
          "value": 28,
          "margin_of_error": 27,
          "percentage": 0.02
        },
        "Male: Bachelor's degree": {
          "value": 529,
          "margin_of_error": 150,
          "percentage": 0.387
        },
        "Male: Master's degree": {
          "value": 374,
          "margin_of_error": 96,
          "percentage": 0.273
        },
        "Male: Professional school degree": {
          "value": 308,
          "margin_of_error": 76,
          "percentage": 0.225
        },
        "Male: Doctorate degree": {
          "value": 58,
          "margin_of_error": 36,
          "percentage": 0.042
        },
        "Female": {
          "value": 1475,
          "margin_of_error": 164,
          "percentage": 0.519
        },
        "Female: No schooling completed": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: Nursery to 4th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 5th and 6th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 7th and 8th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 9th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 10th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 11th grade": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 12th grade, no diploma": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: High school graduate (includes equivalency)": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: Some college, less than 1 year": {
          "value": 9,
          "margin_of_error": 14,
          "percentage": 0.006
        },
        "Female: Some college, 1 or more years, no degree": {
          "value": 48,
          "margin_of_error": 34,
          "percentage": 0.033
        },
        "Female: Associate's degree": {
          "value": 30,
          "margin_of_error": 48,
          "percentage": 0.02
        },
        "Female: Bachelor's degree": {
          "value": 686,
          "margin_of_error": 159,
          "percentage": 0.465
        },
        "Female: Master's degree": {
          "value": 399,
          "margin_of_error": 94,
          "percentage": 0.271
        },
        "Female: Professional school degree": {
          "value": 218,
          "margin_of_error": 63,
          "percentage": 0.148
        },
        "Female: Doctorate degree": {
          "value": 85,
          "margin_of_error": 44,
          "percentage": 0.058
        }
      },
      "Population with veteran status": {
        "meta": {
          "table_id": "B21001",
          "universe": "Civilian Population 18 Years And Over"
        },
        "Total": {
          "value": 2953,
          "margin_of_error": 207
        },
        "Veteran": {
          "value": 165,
          "margin_of_error": 99
        },
        "Nonveteran": {
          "value": 1274,
          "margin_of_error": 162
        },
        "Male": {
          "value": 1439,
          "margin_of_error": 160,
          "percentage": 0.487
        },
        "Male: 18 to 34 years": {
          "value": 666,
          "margin_of_error": 137,
          "percentage": 0.463
        },
        "Male: 18 to 34 years: Veteran": {
          "value": 26,
          "margin_of_error": 39,
          "percentage": 0.039
        },
        "Male: 18 to 34 years: Nonveteran": {
          "value": 640,
          "margin_of_error": 141,
          "percentage": 0.961
        },
        "Male: 35 to 54 years": {
          "value": 603,
          "margin_of_error": 129,
          "percentage": 0.419
        },
        "Male: 35 to 54 years: Veteran": {
          "value": 107,
          "margin_of_error": 90,
          "percentage": 0.177
        },
        "Male: 35 to 54 years: Nonveteran": {
          "value": 496,
          "margin_of_error": 97,
          "percentage": 0.823
        },
        "Male: 55 to 64 years": {
          "value": 100,
          "margin_of_error": 64,
          "percentage": 0.069
        },
        "Male: 55 to 64 years: Veteran": {
          "value": 11,
          "margin_of_error": 17,
          "percentage": 0.11
        },
        "Male: 55 to 64 years: Nonveteran": {
          "value": 89,
          "margin_of_error": 63,
          "percentage": 0.89
        },
        "Male: 65 to 74 years": {
          "value": 58,
          "margin_of_error": 40,
          "percentage": 0.04
        },
        "Male: 65 to 74 years: Veteran": {
          "value": 9,
          "margin_of_error": 13,
          "percentage": 0.155
        },
        "Male: 65 to 74 years: Nonveteran": {
          "value": 49,
          "margin_of_error": 39,
          "percentage": 0.845
        },
        "Male: 75 years and over": {
          "value": 12,
          "margin_of_error": 19,
          "percentage": 0.008
        },
        "Male: 75 years and over: Veteran": {
          "value": 30,
          "margin_of_error": 29,
          "percentage": 2.5
        },
        "Male: 75 years and over: Nonveteran": {
          "value": 1484,
          "margin_of_error": 164,
          "percentage": 123.667
        },
        "Female": {
          "value": 1514,
          "margin_of_error": 165,
          "percentage": 0.513
        },
        "Female: 18 to 34 years": {
          "value": 904,
          "margin_of_error": 154,
          "percentage": 0.597
        },
        "Female: 18 to 34 years: Veteran": {
          "value": 20,
          "margin_of_error": 23,
          "percentage": 0.022
        },
        "Female: 18 to 34 years: Nonveteran": {
          "value": 884,
          "margin_of_error": 153,
          "percentage": 0.978
        },
        "Female: 35 to 54 years": {
          "value": 451,
          "margin_of_error": 111,
          "percentage": 0.298
        },
        "Female: 35 to 54 years: Veteran": {
          "value": 10,
          "margin_of_error": 16,
          "percentage": 0.022
        },
        "Female: 35 to 54 years: Nonveteran": {
          "value": 441,
          "margin_of_error": 107,
          "percentage": 0.978
        },
        "Female: 55 to 64 years": {
          "value": 106,
          "margin_of_error": 55,
          "percentage": 0.07
        },
        "Female: 55 to 64 years: Veteran": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 55 to 64 years: Nonveteran": {
          "value": 106,
          "margin_of_error": 55,
          "percentage": 1
        },
        "Female: 65 to 74 years": {
          "value": 21,
          "margin_of_error": 27,
          "percentage": 0.014
        },
        "Female: 65 to 74 years: Veteran": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 65 to 74 years: Nonveteran": {
          "value": 21,
          "margin_of_error": 27,
          "percentage": 1
        },
        "Female: 75 years and over": {
          "value": 32,
          "margin_of_error": 35,
          "percentage": 0.021
        },
        "Female: 75 years and over: Veteran": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Female: 75 years and over: Nonveteran": {
          "value": 32,
          "margin_of_error": 35,
          "percentage": 1
        }
      },
      "Period of military service for veterans": {
        "meta": {
          "table_id": "B21002",
          "universe": "Civilian Veterans 18 Years And Over"
        },
        "Total": {
          "value": 195,
          "margin_of_error": 104
        },
        "Gulf War (9/2001 or later), no Gulf War (8/1990 to 8/2001), no Vietnam Era": {
          "value": 80,
          "margin_of_error": 53,
          "percentage": 0.41
        },
        "Gulf War (9/2001 or later) and Gulf War (8/1990 to 8/2001), no Vietnam Era": {
          "value": 14,
          "margin_of_error": 16,
          "percentage": 0.072
        },
        "Gulf War (9/2001 or later), and Gulf War (8/1990 to 8/2001), and Vietnam Era": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Gulf War (8/1990 to 8/2001), no Vietnam Era": {
          "value": 8,
          "margin_of_error": 12,
          "percentage": 0.041
        },
        "Gulf War (8/1990 to 8/2001) and Vietnam Era": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Vietnam Era, no Korean War, no World War II": {
          "value": 12,
          "margin_of_error": 19,
          "percentage": 0.062
        },
        "Vietnam Era and Korean War, no World War II": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Vietnam Era and Korean War and World War II": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Korean War, no Vietnam Era, no World War II": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Korean War and World War II, no Vietnam Era": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "World War II, no Korean War, no Vietnam Era": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Between Gulf War and Vietnam Era only": {
          "value": 72,
          "margin_of_error": 85,
          "percentage": 0.369
        },
        "Between Vietnam Era and Korean War only": {
          "value": 9,
          "margin_of_error": 13,
          "percentage": 0.046
        },
        "Between Korean War and World War II only": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        },
        "Pre-World War II only": {
          "value": 0,
          "margin_of_error": 12,
          "percentage": 0
        }
      }
    }
  }
}
...
```

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

```json
...
"fields": {
  "zip4": {
    "record_type": {
      "code": "S",
      "description": "Street"
    },
    "carrier_route": {
      "id": "C007",
      "description": "City Delivery"
    },
    "building_or_firm_name": null,
    "plus4": [
      "2890"
    ],
    "zip9": [
      "22201-2890"
    ],
    "government_building": null,
    "facility_code": {
      "code": "P",
      "description": "Post Office"
    },
    "city_delivery": true,
    "valid_delivery_area": true,
    "exact_match": true
  }
}
...
```
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

This performs a lookup to determine the USPS ZIP+4 code for a given US location, this lets you retrieve the full 9-digit ZIP Code&trade;, by combining the 5-digit ZIP code with the ZIP+4 code.

Additional USPS delivery data is also returned.

### Record Type
The type of ZIP+4 result. Possible values are:

* **F**: Firm
* **G**: General Delivery
* **H**: High-rise
* **P**: PO Box
* **R**: Rural Route/Contract
* **S**: Street

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

Indicates whether our not the local post office has a city delivery carrier route.


### Valid delivery area

In some cases an address exists but it is not a valid delivery point for postal purposes. This could for example be because it is an undeveloped lot.

### <svg height="24" width="24" title="Important!" fill="#faad63" xmlns="http://www.w3.org/2000/svg" stroke-width=".501" stroke-linejoin="bevel" fill-rule="evenodd" overflow="visible" viewBox="0 0 192 192"><path d="M70.272 192l-9.744-34.512-34.8 8.784 8.8-34.752L0 121.712l25.008-25.68L0 70.288l34.512-9.76-8.784-34.816 34.752 8.816L70.288 0l25.696 25.008L121.728 0l9.76 34.496 34.8-8.784-8.816 34.752L192 70.272l-25.008 25.696L192 121.712l-34.496 9.76 8.768 34.8-34.752-8.816L121.712 192l-25.68-25.008L70.272 192zM108 132c0-6.624-5.376-12-12-12s-12 5.376-12 12 5.376 12 12 12 12-5.376 12-12zm-.016-36.464V60.48c0-6.88-5.376-12.464-11.984-12.464h-.016C89.376 48.016 84 53.6 84 60.48v35.056C84 102.416 89.376 108 95.984 108H96c6.608 0 11.984-5.584 11.984-12.464z" fill="#faad63" stroke="none" font-family="Times New Roman" font-size="16"/></svg> Exact match

An exact match means that there was no ambiguity with the lookup and that the given ZIP+4 code is the correct and only match for the given address.

Most often, not-exact matches are due to lookups for an apartment or office building that is missing a unit/apartment number.

In these cases it is not possible to determine an accurate ZIP+4 code without supplying secondary address line information.

<aside class="warning">
If no ZIP+4 data is available for the given query, the `zip4` field is omitted from the JSON output (and the field lookup does not count against your usage)
</aside>

## Riding: Canadian Federal Electoral District
**Field name: `riding`**

> Example for "2546 Rue Bourgoin, Saint-Laurent, QC Canada"

```json
...
"fields": {
  "riding": {
    "code": "24068",
    "name_french": "Saint-Laurent",
    "name_english": "Saint-Laurent"
   },
}
...
```
Look up the [riding](https://en.wikipedia.org/wiki/List_of_Canadian_federal_electoral_districts) for the specified address in Canada. The riding code is returned along with the French and English name for the riding.

In some cases the French and English names will be the same.

## Canadian statistical boundaries from Statistics Canada
**Field name: `statcan`**


> Example for "2546 Rue Bourgoin, Saint-Laurent, QC Canada"

```json
...
"fields": {
  "statcan": {
    "division": {
      "id": "2466",
      "name": "Montréal",
      "type": "TÉ",
      "type_description": "Territoire équivalent"
    },
    "consolidated_subdivision": {
      "id": "2466023",
      "name": "Montréal"
    },
    "subdivision": {
      "id": "2466023",
      "name": "Montréal",
      "type": "V",
      "type_description": "Ville"
    },
    "economic_region": "Montréal",
    "statistical_area": {
      "code": "462",
      "code_description": "CMA or CA",
      "type": "1",
      "type_description": "Census subdivision within census metropolitan area"
    },
    "cma_ca": {
      "id": "462",
      "name": "Montréal",
      "type": "B",
      "type_description": "Census metropolitan area (CMA)"
    },
    "tract": "4620415.04",
    "census_year": 2016
  }
}
...
```
Retrieve the [Statistics Canada boundaries](https://en.wikipedia.org/wiki/Census_geographic_units_of_Canada) that the given query is within.
These boundaries can be matched with data from [Statistics Canada](https://www.statcan.gc.ca) to get demographic information about the area the query is within.

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
      "id": "6001006",
      "name": "Teslin",
      "type": "VL",
      "type_description": "Village"
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
    "census_year": 2016
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

> You can read more about the various code names from the [Statistics Canada technical specifications page](https://www150.statcan.gc.ca/n1/pub/92-151-g/2011001/tech-eng.htm).

## Timezone
**Field name: `timezone`**

```json
...
"fields": {
  "timezone": {
    "name": "America/New_York",
    "utc_offset": -5,
    "observes_dst": true,
    "abbreviation": "EST",
    "source": "© OpenStreetMap contributors"
  }
}
...
```
You can retrieve the timezone for an address or coordinate using `timezone` in the `fields` query parameter.

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

# Address parsing

<aside class="warning">
<strong>DEPRECATED</strong>

As of June 2015, address parsing and correction is included by default with all Geocodio results. The parse endpoint has been deprecated in favor of the regular geocode endpoint that is greatly improved and also provides address parsing. The parse endpoint is unsupported and will be completely removed in the future.
</aside>

> To parse an address:

```shell
curl "https://api.geocod.io/v1.6/parse?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY"
```

```ruby
require 'geocodio'

geocodio = Geocodio::Client.new('YOUR_API_KEY')

address = geocodio.parse('1109 N Highland St, Arlington VA')
```

```python
from geocodio import GeocodioClient

client = GeocodioClient(YOUR_API_KEY)

address = client.parse('1109 N Highland St, Arlington VA')
```

```php
<?php
// Not available in the PHP library
```

```javascript
// Not available in the Node library
```

```clojure
(ns my.ns
  (:require [rodeo.core :refer :all]))

(components "1109 N Highland St, Arlington VA" :api_key "YOUR_API_KEY")
```

> Example response:

```json
{
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
}
```

### HTTP Request

`GET https://api.geocod.io/v1.6/parse`

### URL Parameters

Parameter | Description
--------- | -----------
`q`       | The query (i.e. address) to parse
`api_key` | Your Geocodio API key

<aside class="notice">
Make sure to check the <a href="#address-formats">address formats</a> section for more information on the different address formats that are supported.
</aside>

# Address components

All results come with an `address_components` dictionary. This is an overview of all of the possible keys that you may find.

The key will not be present if there is no valid value for it. E.g. if the address does not have a `predirectional`, this key will not be present.

Name               | Notes
------------------ | ---------------------------
number             | House number, e.g. "2100" or "250 1/2"
predirectional     | Directional that comes before the street name, 1-2 characters, e.g. N or NE
prefix             | Abbreviated street prefix, particularily common in the case of French addresse e.g. Rue, Boulevard, Impasse
street             | Name of the street without number, prefix or suffix, e.g. "Main"
suffix             | Abbreviated street suffix, e.g. St., Ave. Rd.
postdirectional    | Directional that comes after the street name, 1-2 characters, e.g. N or NE
secondaryunit      | Name of the secondary unit, e.g. "Apt" or "Unit". For "input" address components only
secondarynumber    | Secondary unit number. For "input" address components only
city               |
county             |
state              |
zip                | 5-digit zip code. Not returned for Canadian results.
country            |
formatted_street   | Fully formatted street, including all directionals, suffix/prefix but not house number

# Accuracy score
Each geocoded result is returned with an accuracy score, which is a decimal number ranging from 0.00 to 1.00. This score is generated by the internal Geocodio engine based on how accurate the result is believed to be. The higher the score, the better the result. Results are always returned ordered by accuracy score.

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
place                 | The point is a city/town/place
state                 | The point is a state

![Visual guide to the most common accuracy types](https://www.geocod.io/docs/images/accuracy-types.png)

*Visual guide to the most common accuracy types*

### Reverse geocoding

Value               | Description
------------------- | -----------
rooftop             | We found the exact point with rooftop level accuracy
nearest_street      | Nearest match for a specific street with estimated street number
nearest_place       | Closest city/town/place

# Address formats
Geocodio supports geocoding the following entities:

* Streets with or without house numbers (requires a city or a zip in conjuction)
* [Intersections](#intersections)
* Cities
* Zip codes
* States
* PO Boxes (coordinates will be returned as a centroid of the zip code)
* Second address lines such as unit and apartment numbers (not used for determining the exact coordinates at this time)

If a city is provided without a state, Geocodio will automatically guess and add the state based on what it is most likely to be. Geocodio also understands shorthands for both streets and cities, for example *NYC*, *SF*, etc., are acceptable city names.

Geocoding queries can be formatted in various ways:

* <a href="https://api.geocod.io/v1.6/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, Arlington VA</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=1109+N+Highland+Street%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland Street, Arlington VA</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=1109+North+Highland+Street%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 North Highland Street, Arlington VA</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, Arlington VA</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=1109+N+Highland+St,+22201&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, 22201</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=Arlington%2c+VA&api_key=YOUR_API_KEY" target="_blank">Arlington, VA</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=Arlington&api_key=YOUR_API_KEY" target="_blank">Arlington</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=VA&api_key=YOUR_API_KEY" target="_blank">VA</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=22201&api_key=YOUR_API_KEY" target="_blank">22201</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=PO+Box+4735,+Tulsa+OK&api_key=YOUR_API_KEY" target="_blank">PO Box 4735, Tulsa OK</a>

If a country is not specified in the query, the Geocodio engine will assume the country to be USA.

Examples of Canadian lookups:

* <a href="https://api.geocod.io/v1.6/geocode?q=525+University+Ave%2C+Toronto%2C+ON%2C+Canada&api_key=YOUR_API_KEY" target="_blank">525 University Ave, Toronto, ON, Canada</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=7515+118+Ave+NW%2C+Edmonton%2C+AB+T5B+0X2%2C+Canada&api_key=YOUR_API_KEY" target="_blank">7515 118 Ave NW, Edmonton, AB T5B 0X2, Canada</a>

## Intersections

You can also geocode intersections. Just specify the two streets that you want to geocode in your query. We support various formats:

* <a href="https://api.geocod.io/v1.6/geocode?q=E+58th+St+and+Madison+Ave%2C+New+York%2C+NY&api_key=YOUR_API_KEY" target="_blank">E 58th St and Madison Ave, New York, NY</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=Market+and+4th%2C+San+Francisco&api_key=YOUR_API_KEY" target="_blank">Market and 4th, San Francisco</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=Commonwealth+Ave+at+Washington+Street%2C+Boston%2C+MA&api_key=YOUR_API_KEY" target="_blank">Commonwealth Ave at Washington Street, Boston, MA</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=Florencia+%26+Perlita%2C+Austin+TX&api_key=YOUR_API_KEY" target="_blank">Florencia & Perlita, Austin TX</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=Quail+Trail+%40+Dinkle+Rd%2C+Edgewood%2C+NM&api_key=YOUR_API_KEY" target="_blank">Quail Trail @ Dinkle Rd, Edgewood, NM</a>
* <a href="https://api.geocod.io/v1.6/geocode?q=8th+St+SE%2FI+St+SE%2C+20003&api_key=YOUR_API_KEY" target="_blank">8th St SE/I St SE, 20003</a>

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
422 Unprocessable Entity | A client error prevented the request from executing successfully (e.g. invalid address provided). A JSON object will be returned with an error key containing a full error message
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

> Warnings can also be triggered for individual results, such as when an ACS field append was specified for a city-level query:

```json
{
  "input": {
    ...
  },
  "results": [
    {
      ...
      "_warnings": [
        "acs-demographics was skipped since result is not street-level"
      ]
    }
  ]
}
```

# Client-side access
> To Geocode an address using a jQuery AJAX call.

```html
<script>
var address = '1109 N Highland St, Arlington VA',
    apiKey = 'YOUR_API_KEY';

$.get('https://api.geocod.io/v1.6/geocode?q='+ encodeURIComponent(address) +'&api_key=' + encodeURIComponent(apiKey), function (response) {
  console.log(response.results);
});
</script>
```

The Geocodio API supports `CORS` using the `Access-Control-Allow-Origin` *HTTP* header. This means that you will be able to make requests directly to the API using JavaScript.

(See an example to the right.)

<aside class="notice">
<strong>Note:</strong> This will expose your API Key publicly, make sure that you understand and accept the implications of this approach.
</aside>

# Contact & Support
Have any questions? Feel free to tweet us [@Geocodio](http://twitter.com/Geocodio) or shoot us an email [support@geocod.io](mailto:support@geocod.io).

If you find an error in the documentation or want something to be clarified, please create a [pull request](https://github.com/Geocodio/docs/pulls) or [issue](https://github.com/Geocodio/docs/issues) so we can correct it.
