---
title: Geocodio API Reference

language_tabs:
  - shell
  - ruby
  - python
  - php
  - javascript: Node.js
  - clojure

toc_footers:
 - <a href="https://dash.geocod.io">Sign Up for an API Key</a>
 - <a href="https://www.geocod.io/terms-of-use/">Terms of Use</a>
---

<aside class="warning">
<strong>Note:</strong> This documentation is for pre-release software that is still undergoing significant development. Anything mentioned in this document is subject to change without notice.
</aside>

# Introduction

Geocodio's RESTful API allows you to perform forward and reverse geocoding lookups. We support both batch requests as well as individual lookups.

You can also optionally ask for data appends such as timezone, Congressional districts or similar things of that nature.

The base API url is `https://api-beta.geocod.io/v2/`.

You can also use Geocodio over plain HTTP, but it is not recommended.

All HTTP responses (including errors) are returned as [JSON-formatted](http://www.json.org) output.

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

## v2.0 *(Release date TBA)*

**General format:**

The `input` and `results` keys have been removed, in favor of a simple list of individual results.

**New parameters:**

* The [`output_address_format` parameter was added](#single-address)


## v1.3 *(Released on March 12th, 2018)*

**`timezone` appends:**

* **Breaking:** `name` property has been renamed to `abbreviation`
* `name` is now the full timezone name in a [tzdb](https://www.iana.org/time-zones)-compatible format. [Read more](#timezone)

## v1.2 *(Released on January 20th, 2018)*

**`cd` (Congressional district) appends:**

* **Breaking:** `current_legislator` property has been renamed to `current_legislators` and is now an array instead of an object
* Both house and senate legislators are now returned

## v1.1 *(Released on January 8th, 2018)*

**`cd` (Congressional district) appends:**

* **Breaking:** `congressional_district` property has been renamed to `congressional_districts`
* **Breaking:** Postal code lookups will now return multiple Congressional districts if the zip code area spans more than one district
* Current legislator information is now returned with Congressional districts

# Libraries

Thanks to the wonderful open-source community, we have language bindings for several languages and platforms.

Basic examples for various languages are provided here. Please make sure to check out the full documentation for the individual libraries (linked below).

<table class="table">
  <tbody><tr>
    <th>Platform</th>
    <th>Library</th>
    <th>Featured in documentation</th>
  </tr>
  <tr>
    <td><strong>PHP</strong></td>
    <td><a href="https://github.com/Geocodio/geocodio-php" target="_blank">Geocodio/geocodio-php</a> originally by <a href="https://twitter.com/davidstanley01" target="_blank">@davidstanley01</a></td>
    <td><i class="fa fa-check"></i></td>
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
    <td><strong>Node.js</strong></td>
    <td><a href="https://github.com/desmondmorris/node-geocodio" target="_blank">desmondmorris/node-geocodio</a> by <a href="https://twitter.com/desmondmorris" target="_blank">@desmondmorris</a></td>
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
    <td><strong>C#</strong></td>
    <td><a href="https://github.com/snake-plissken/cSharpGeocodio" target="_blank">snake-plissken/cSharpGeocodio</a> by <a href="https://github.com/snake-plissken" target="_blank">Frank Deasey</a></td>
    <td><i class="fa fa-minus"></i></td>
  </tr>
  <tr>
    <td colspan="3">Are you the author of an awesome library that you would like to get featured here? Just <a href="mailto:hello@geocod.io">let us know</a> or <a href="https://github.com/geocodio/docs" target="_blank">create a pull request</a>.</td>
  </tr>
</tbody></table>

# Authentication

> To set the `API_KEY`:

```shell
# With curl, you can just pass the query parameter with each request
curl "https://api-beta.geocod.io/v2/api_endpoint_here?api_key=YOUR_API_KEY"
```

```ruby
require 'geocodio'

geocodio = Geocodio::Client.new('YOUR_API_KEY')
```

```python
from geocodio import GeocodioClient

client = GeocodioClient(YOUR_API_KEY)
```

```php
<?php
require('vendor/autoload.php');
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
};

var geocodio = new Geocodio(config);
```

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

A single address can be geocoded by making a simple `GET` request to the *geocode* endpoint, you can <a href="https://api-beta.geocod.io/v2/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

> To geocode a single address:

```shell
# Using q parameter
curl "https://api-beta.geocod.io/v2/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY"

# Using individual address components
curl "https://api-beta.geocod.io/v2/geocode?street=1109+N+Highland+St&city=Arlington&state=VA&api_key=YOUR_API_KEY"
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
require('vendor/autoload.php');
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$location = $client->geocode('1109 N Highland St, Arlington VA');
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
};

var geocodio = new Geocodio(config);

geocodio.geocode('1109 N Highland St, Arlington VA', function(err, location) {
    if (err) throw err;

    console.log(location);
});
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

`GET https://api-beta.geocod.io/v2/geocode`

### URL Parameters

Parameter             | Description
--------------------- | ----------------------------------------------------------------------------------
q                     | The query (i.e. address) to geocode
api_key               | Your Geocodio API key
output_address_format | Optional, specifies the language for the output. Can either be `local` or `english`

***

**Alternative URL Parameters**

Instead of using the *q* parameter, you can use a combination of `street`, `city`, `state` `postal_code`, and/or `country`. This can be useful if the address is already stored as separate fields on your end.

Parameter | Description
--------- | -----------
street | E.g. 1600 Pennsylvania Ave NW
city | E.g. Washington
state | E.g. DC
postal_code | E.g. 20500
country | E.g. Canada (Default to USA)
api_key | Your Geocodio API key

<aside>
<strong>Note:</strong> Even if the fields are supplied separately, Geocodio might in rare circumstances try to parse the street, for example, as part of the city if more relevant results can be found.
</aside>

## Batch geocoding

> To perform batch geocoding:

```shell
curl -X POST \
  -H "Content-Type: application/json" \
  -d '["1109 N Highland St, Arlington VA", "525 University Ave, Toronto, ON, Canada", "4410 S Highway 17 92, Casselberry FL", "15000 NE 24th Street, Redmond WA", "17015 Walnut Grove Drive, Morgan Hill CA"]' \
  https://api-beta.geocod.io/v2/geocode?api_key=YOUR_API_KEY
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
require('vendor/autoload.php');
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$data = [
  '1109 N Highland St, Arlington VA',
  '525 University Ave, Toronto, ON, Canada',
  '4410 S Highway 17 92, Casselberry FL',
  '15000 NE 24th Street, Redmond WA',
  '17015 Walnut Grove Drive, Morgan Hill CA'
];
$locations = $client->geocode($data);
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
};

var geocodio = new Geocodio(config);

var addresses = [
  '1109 N Highland St, Arlington VA',
  '525 University Ave, Toronto, ON, Canada',
  '4410 S Highway 17 92, Casselberry FL',
  '15000 NE 24th Street, Redmond WA',
  '17015 Walnut Grove Drive, Morgan Hill CA'
];

geocodio.post('geocode', addresses, function(err, locations) {
    if (err) throw err;

    console.log(locations);
});
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
    },
    ...
  ]
}
```

If you have several addresses that you need to geocode, batch geocoding is a much faster option since it removes the overhead of having to perform multiple `HTTP` requests.

Batch geocoding requests are performed by making a `POST` request to the *geocode* endpoint, suppliying a `JSON` array or `JSON` object in the body with any key of your choosing.

<aside class="warning">
You can batch geocode up to 10,000 addresses at the time. Geocoding 10,000 addresses takes about 300 seconds, so please make sure to adjust your timeout value accordingly.
</aside>

### HTTP Request

`POST https://api-beta.geocod.io/v2/geocode`

### URL Parameters

Parameter | Description
--------- | -----------
api_key | Your Geocodio API key

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
A geographic coordinate consists of latitude followed by longitude separated by a comma, for example `38.9002898,-76.9990361`
</aside>

## Reverse geocoding single coordinate

> To reverse geocode a single coordinate:

```shell
curl "https://api-beta.geocod.io/v2/reverse?q=38.9002898,-76.9990361&api_key=YOUR_API_KEY"
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
require('vendor/autoload.php');
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$addresses = $client->reverse('38.9002898,-76.9990361');
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
};

var geocodio = new Geocodio(config);

geocodio.reverse('38.9002898,-76.9990361', function(err, addresses) {
    if (err) throw err;

    console.log(addresses);
});

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

A single coordinate can be reverse geocoded by making a simple `GET` request to the *reverse* endpoint, you can <a href="https://api-beta.geocod.io/v2/reverse?q=38.9002898,-76.9990361&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

### HTTP Request

`GET https://api-beta.geocod.io/v2/reverse`

### URL Parameters

Parameter | Description
--------- | -----------
q | The query (i.e. latitude/longitude pair) to geocode
api_key | Your Geocodio API key

## Batch reverse geocoding

> To perform batch reverse geocoding:

```shell
curl -X POST \
  -H "Content-Type: application/json" \
  -d '["35.9746000,-77.9658000","32.8793700,-96.6303900","33.8337100,-117.8362320","35.4171240,-80.6784760"]' \
  https://api-beta.geocod.io/v2/reverse?api_key=YOUR_API_KEY
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
require('vendor/autoload.php');
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$address_sets = $client->reverse(['35.9746000,-77.9658000', '32.8793700,-96.6303900', '33.8337100,-117.8362320', '35.4171240,-80.6784760']);
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
};

var geocodio = new Geocodio(config);

var coordinates = [
  '35.9746000,-77.9658000',
  '32.8793700,96.6303900',
  '33.8337100,117.8362320',
  '35.4171240,-80.6784760'
];

geocodio.reverse(coordinates, function(err, address_sets){
    if (err) throw err;

    console.log(address_sets);
});
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

`POST https://api-beta.geocod.io/v2/reverse`

### URL Parameters

Parameter | Description
--------- | -----------
api_key | Your Geocodio API key

# Fields

> To get the Congressional and state legislative districts for an address:

```shell
curl "https://api-beta.geocod.io/v2/geocode?q=1109+N+Highland+St%2c+Arlington+VA&fields=cd,stateleg&api_key=YOUR_API_KEY"
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
require('vendor/autoload.php');
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$location = $client->geocode('1109 N Highland St, Arlington VA', ['cd', 'stateleg']);
```

```javascript
// There is no Node.js support for fields yet. We invite you to contribute
// by creating a pull request on GitHub

/*
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
}

var geocodio = new Geocodio(config);

geocodio.geocode('1109 N Highland St, Arlington VA', ['cd', 'stateleg'], function(err, location) {
    if (err) throw err;

    console.log(location);
});
*/
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
            "congress_number": "115th",
            "congress_years": "2017-2019",
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
                  "address": "1119 Longworth HOB; Washington DC 20515-4608",
                  "phone": "202-225-4376",
                  "contact_form": null
                },
                "social": {
                  "rss_url": null,
                  "twitter": "repdonbeyer",
                  "facebook": "repdonbeyer",
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
                  "address": "231 Russell Senate Office Building Washington DC 20510",
                  "phone": "202-224-4024",
                  "contact_form": "https://www.kaine.senate.gov/contact"
                },
                "social": {
                  "rss_url": "http://www.kaine.senate.gov/rss/feeds/?type=all",
                  "twitter": "SenKaineOffice",
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
          "senate": {
            "name": "State Senate District 31",
            "district_number": "31"
          },
          "house": {
            "name": "State House District 47",
            "district_number": "47"
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

Geocodio allows you to request additional information with forward and reverse geocoding requests. We call this additional data *fields*.

Requesting additional data fields is easy. Just add a `fields` parameter to your query string and set the value according to the table below. You can request multiple data fields at the same time by separating them with a comma. If the `fields` parameter has been specified, a new `fields` key is exposed with each geocoding result containing all necessary data for each field.

Go ahead, <a href="https://api-beta.geocod.io/v2/geocode?q=1109+N+Highland+St%2c+Arlington+VA&fields=cd&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

Some fields are specific to the US and cannot be queried for other countries.

Parameter name                | Description                                       | Coverage                    |
----------------------------- | ------------------------------------------------- | --------------------------- |
cd, cd113, cd114, *or* cd115  | Congressional District & Legislator information   | US-only                     |
stateleg                      | State Legislative District (House & Senate)       | US-only                     |
school                        | School District (elementary/secondary or unified) | US-only                     |
census                        | Census Block/Tract, FIPS codes & MSA/CSA codes    | US-only                     |
timezone                      | Timezone                                          | <i class="fa fa-globe"></i> |



<aside class="notice">
Additional data fields are available with both single and batch geocoding.
</aside>

## Congressional Districts
```json
...
"fields": {
  "congressional_districts": [
    {
      "name": "Congressional District 8",
      "district_number": 8,
      "congress_number": "115th",
      "congress_years": "2017-2019",
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
            "address": "1119 Longworth HOB; Washington DC 20515-4608",
            "phone": "202-225-4376",
            "contact_form": null
          },
          "social": {
            "rss_url": null,
            "twitter": "repdonbeyer",
            "facebook": "repdonbeyer",
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
            "address": "231 Russell Senate Office Building Washington DC 20510",
            "phone": "202-224-4024",
            "contact_form": "https://www.kaine.senate.gov/contact"
          },
          "social": {
            "rss_url": "http://www.kaine.senate.gov/rss/feeds/?type=all",
            "twitter": "SenKaineOffice",
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
You can retrieve the Congressional district for an address or coordinate using `cd`, `cd113`, `cd114`, or `cd115` in the `fields` query parameter. `cd` will always return the Congressional district for the current Congress while e.g. `cd113` will continue to show the Congressional district for the 113th Congress.

The field returns the full name of the Congressional district, the district number, the Congress number, and the year range. If the current congress (i.e. `cd` or `cd115`) is specified, we will also return detailed information about the current legislators.

<aside class="success">
The list of legislators is always ordered as house representative, followed by senators.
</aside>

### Appending Congressional districts for postal codes

It can be tricky to look up Congressional districts by postal code. Postal codes are postal routes, rather than geographic areas, which can cause imprecise results.

In some cases there may also be multiple possible Congressional district for a postal code, in that case we will return multiple Congressional districts, and rank them each using a `proportion` key.

This key is a decimal percentage representation of how much of the district boundary that intersect with the zip code boundary (i.e. bigger number = more likely to be the correct district for citizens in that zip code).

Districts are always sorted by the `proportion` in descending order (largest first).

## State Legislative Districts
```json
...
"fields": {
  "state_legislative_districts": {
    "house": {
      "name": "Assembly District 42",
      "district_number": 42
    },
    "senate": {
      "name": "State Senate District 28",
      "district_number": 28
    }
  }
}
...
```
You can retrieve the state legislative districts for an address or coordinate using `stateleg` in the `fields` query parameter.

The field will return both the *house* and *senate* state legislative district (also known as *lower* and *upper*) with the full name and district number for each. For areas with a [unicameral legislature](http://en.wikipedia.org/wiki/Unicameralism) (such as Washington, DC or Nebraska), only the `senate` key is returned.

## School Districts
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
```json
...
"fields": {
  "census": {
    "census_year": 2015,
    "state_fips": "51",
    "county_fips": "51013",
    "place_fips": "5103000",
    "tract_code": "101801",
    "block_code": "1004",
    "block_group": "1",
    "full_fips": "510131018011004",
    "metro_micro_statistical_area": {
      "name": "Washington-Arlington-Alexandria, DC-VA-MD-WV",
      "area_code": "47900",
      "type": "metropolitan"
    },
    "combined_statistical_area": {
      "name": "Washington-Baltimore-Arlington, DC-MD-VA-WV-PA",
      "area_code": "548"
    }
  }
}
...
```
This will append various Census-designated codes to your address:

Field        | Description
------------ | -----------------------------------------------------------
census_year  | The full year that the Census data belongs to (The U.S. Census Bureau might make slight boundary changes from year to year)
state_fips   | The two-digit state FIPS code. A full list is available on [Wikipedia](https://en.wikipedia.org/wiki/Federal_Information_Processing_Standard_state_code)
county_fips  | The five-digit county FIPS code. The two first digits represents the state. A full list of US counties is available on [Wikipedia](https://en.wikipedia.org/wiki/List_of_United_States_counties_and_county_equivalents)
place_fips   | The 7-digit place FIPS code. A place is defined as a city or other census designated area. A full list of ANSI codes is available from the [U.S. Census Bureau](https://www.census.gov/geo/reference/codes/place.html)
tract_code   | The 6-digit census tract code. This is a subdivision of a county, used for statistical purposes.
block_code   | The full 4-digit block code that the location belongs to. This is the smallest geographical unit that the U.S. Census Bureau provides statistical data for.
block_group  | The single-digit group number for the block
full_fips  | The full 15-digit fips code, consisting of the county fips, tract code and block code

The U.S. Census Bureau also provides a more [detailed guide](https://www.census.gov/geo/reference/gtc/gtc_ct.html) for the above terms.

Using Census tracts and blocks, you can match addresses and latitude/longitude pairs with statistical data from the U.S. Census Bureau. For example, appending Census tracts and blocks to addresses enables you to utilize the [American Community Survey (ACS) data](https://www.census.gov/programs-surveys/acs/data.html).

Note: When using our spreadsheet upload tool instead of the API, "Full FIPS (block)" is equivalent to full_fips in our API response. Similarly, "Full FIPS (track)" is equivalent to full_fips with the last 4 characters removed. 

### Metropolitan/Micropolitan Statistical Area (MSA)

This field is return for locations that are within an MSA area. If no MSA area is associated with the location, the API will return `null` instead of the individual fields.

You can read more about [Metropolitan](https://en.wikipedia.org/wiki/Metropolitan_statistical_area) and [Micropolitan](https://en.wikipedia.org/wiki/Micropolitan_statistical_area) areas on Wikipedia.

Field        | Description
------------ | -----------------------------------------------------------
name         | The official Census-designated name for the area
area_code    | Unique code for the area, also known as the CBSA code
type         | Can either be "metropolitan" or "micropolitan"

### Combined Statistical Area (CSA)

This field is return for locations that are within an CSA area. If no CSA area is associated with the location, the API will return `null` instead of the individual fields.

You can read more about [Combined Statisical Areas on Wikipedia](https://en.wikipedia.org/wiki/Combined_statistical_area).

Field        | Description
------------ | -----------------------------------------------------------
name         | The official Census-designated name for the area
area_code    | Unique census-defined code for the area

## Timezone
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
curl "https://api-beta.geocod.io/v2/parse?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY"
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
require('vendor/autoload.php');
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$address = $client->parse('1109 N Highland St, Arlington VA');
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
};

var geocodio = new Geocodio(config);

geocodio.parse('1109 N Highland St, Arlington VA', function(err, address) {
    if (err) throw err;

    console.log(address);
});
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

`GET https://api-beta.geocod.io/v2/parse`

### URL Parameters

Parameter | Description
--------- | -----------
q | The query (i.e. address) to parse
api_key | Your Geocodio API key

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

Value               | Description
------------------- | -----------
rooftop             | We found the exact point with rooftop level accuracy
point               | We found the exact point from address range interpolation where the range contained a single point
range_interpolation | We found the exact point by performing [address range interpolation](http://en.wikipedia.org/wiki/Geocoding#Address_interpolation)
street_center       | The result is a geocoded street centroid
place               | The point is a city/town/place
state               | The point is a state

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

If a city is provided without a state, Geocodio will automatically guess and add the state based on what it is most likely to be. Geocodio also understands shorthands for both streets and cities, for example *NYC*, *SF*, etc., are acceptable city names.

Geocoding queries can be formatted in various ways:

* <a href="https://api-beta.geocod.io/v2/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, Arlington VA</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=1109+N+Highland+Street%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland Street, Arlington VA</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=1109+North+Highland+Street%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 North Highland Street, Arlington VA</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, Arlington VA</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=1109+N+Highland+St,+22201&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, 22201</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=Arlington%2c+VA&api_key=YOUR_API_KEY" target="_blank">Arlington, VA</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=Arlington&api_key=YOUR_API_KEY" target="_blank">Arlington</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=VA&api_key=YOUR_API_KEY" target="_blank">VA</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=22201&api_key=YOUR_API_KEY" target="_blank">22201</a>

If a country is not specified in the query, the Geocodio engine will assume the country to be USA.

Examples of Canadian lookups:

* <a href="https://api-beta.geocod.io/v2/geocode?q=525+University+Ave%2C+Toronto%2C+ON%2C+Canada&api_key=YOUR_API_KEY" target="_blank">525 University Ave, Toronto, ON, Canada</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=7515+118+Ave+NW%2C+Edmonton%2C+AB+T5B+0X2%2C+Canada&api_key=YOUR_API_KEY" target="_blank">7515 118 Ave NW, Edmonton, AB T5B 0X2, Canada</a>

## Intersections

You can also geocode intersections. Just specify the two streets that you want to geocode in your query. We support various formats:

* <a href="https://api-beta.geocod.io/v2/geocode?q=E+58th+St+and+Madison+Ave%2C+New+York%2C+NY&api_key=YOUR_API_KEY" target="_blank">E 58th St and Madison Ave, New York, NY</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=Market+and+4th%2C+San+Francisco&api_key=YOUR_API_KEY" target="_blank">Market and 4th, San Francisco</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=Commonwealth+Ave+at+Washington+Street%2C+Boston%2C+MA&api_key=YOUR_API_KEY" target="_blank">Commonwealth Ave at Washington Street, Boston, MA</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=Florencia+%26+Perlita%2C+Austin+TX&api_key=YOUR_API_KEY" target="_blank">Florencia & Perlita, Austin TX</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=Quail+Trail+%40+Dinkle+Rd%2C+Edgewood%2C+NM&api_key=YOUR_API_KEY" target="_blank">Quail Trail @ Dinkle Rd, Edgewood, NM</a>
* <a href="https://api-beta.geocod.io/v2/geocode?q=8th+St+SE%2FI+St+SE%2C+20003&api_key=YOUR_API_KEY" target="_blank">8th St SE/I St SE, 20003</a>

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

The Geocodio API employs semantic HTTP status codes:

Error Code | Meaning
---------- | -------
200 OK | Hopefully you will see this most of the time. Note that this status code will also be returned even though no geocoding results were available.
403 Forbidden | Invalid API key, or other reason why access is forbidden.
422 Unprocessable Entity | A client error prevented the request from executing successfully (e.g. invalid address provided). A JSON object will be returned with an error key containing a full error message
500 Server Error | Hopefully you will never see this...it means that something went wrong in our end. Whoops.

If you encounter any unexpected errors, please check [status.geocod.io](https://status.geocod.io) for the latest platform status updates.

# Client-side access
> To Geocode an address using a jQuery AJAX call.

```html
<script>
var address = '1109 N Highland St, Arlington VA',
    apiKey = 'YOUR_API_KEY';

$.get('https://api-beta.geocod.io/v2/geocode?q='+ encodeURIComponent(address) +'&api_key=' + encodeURIComponent(apiKey), function (response) {
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
