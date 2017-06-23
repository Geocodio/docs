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
 - <a href="http://geocod.io/terms-of-use/">Terms of Use</a>
---

# Introduction

> <i class="fa fa-chevron-circle-up"></i> Pick your favorite programming language

Geocodio's RESTful API allows you to perform forward and reverse geocoding lookups. We support both batch requests as well as individual lookups.

You can also optionally ask for data appends such as timezone, congressional districts or similar things of that nature.

The base API url is `https://api.geocod.io/v1/`.

You can also use Geocodio over plain HTTP, but it's not recommended.

All HTTP responses (including errors) are returned with [JSON-formatted](http://www.json.org) output.

We may add additional properties to the output in the future, but existing properties will never be changed or removed without a new API version release.

<aside class="notice">
Note the versioning prefix in the base url, which is required for all requests.
</aside>

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
    <td><strong>Python</strong></td>
    <td><a href="https://github.com/davidstanley01/Geocodio.py" target="_blank">davidstanley01/Geocodio.py</a> by <a href="https://twitter.com/davidstanley01" target="_blank">@davidstanley01</a></td>
    <td><i class="fa fa-minus"></i></td>
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
    <td colspan="3">Are you the author of an awesome library that you would like to get featured here? Just <a href="mailto:hello@geocod.io">let us know</a> or <a href="https://github.com/geocodio/docs" target="_blank">create a pull request</a>.</td>
  </tr>
</tbody></table>

# Authentication

> To set the `API_KEY`:

```shell
# With curl, you can just pass the query parameter with each request
curl "https://api.geocod.io/v1/api_endpoint_here?api_key=YOUR_API_KEY"
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
require_once 'vendor/autoload.php'
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
}

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

A single address can be geocoded by making a simple `GET` request to the *geocode* endpoint, you can <a href="https://api.geocod.io/v1/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

> To geocode a single address:

```shell
# Using q parameter
curl "https://api.geocod.io/v1/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY"

# Using individual address components
curl "https://api.geocod.io/v1/geocode?street=1109+N+Highland+St&city=Arlington&state=VA&api_key=YOUR_API_KEY"
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
require_once 'vendor/autoload.php'
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$location = $client->get('1109 N Highland St, Arlington VA');
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
}

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

`GET https://api.geocod.io/v1/geocode`

### URL Parameters

Parameter | Description
--------- | -----------
q | The query (i.e. address) to geocode
api_key | Your Geocodio API key

***

**Alternative URL Parameters**

Instead of using the *q* parameter, you can use a combination of `street`, `city`, `state` `postal_code`, and/or `country`. This might be useful if the address is already stored as separate fields in your end.

Parameter | Description
--------- | -----------
street | E.g. 1600 Pennsylvania Ave NW
city | E.g. Washington
state | E.g. DC
postal_code | E.g. 20500
country | E.g. Canada (Default to USA)
api_key | Your Geocodio API key

<aside>
<strong>Note:</strong> Even if the fields are supplied separately, Geocodio might in rare circumstances try to parse e.g. the street as part of the city if more relevant results can be found.
</aside>

## Batch geocoding

> To perform batch geocoding:

```shell
curl -X POST \
  -H "Content-Type: application/json" \
  -d '["1109 N Highland St, Arlington VA", "525 University Ave, Toronto, ON, Canada", "4410 S Highway 17 92, Casselberry FL", "15000 NE 24th Street, Redmond WA", "17015 Walnut Grove Drive, Morgan Hill CA"]' \
  https://api.geocod.io/v1/geocode?api_key=YOUR_API_KEY
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
require_once 'vendor/autoload.php'
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$data = array(
  '1109 N Highland St, Arlington VA',
  '525 University Ave, Toronto, ON, Canada',
  '4410 S Highway 17 92, Casselberry FL',
  '15000 NE 24th Street, Redmond WA',
  '17015 Walnut Grove Drive, Morgan Hill CA'
);
$locations = $client->post($data);
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
}

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

`POST https://api.geocod.io/v1/geocode`

### URL Parameters

Parameter | Description
--------- | -----------
api_key | Your Geocodio API key

### JSON array/object
When making a batch geocoding request, you can `POST` queries as either a JSON array or a JSON object. If a JSON object is posted, you can specify a custom key for each element of your choice, this can be useful to match queries up with your existing data, after the request is complete.

If using a JSON array, results are **guaranteed** to be returned in the same order as they are requested.

You can also use the alternative parameters with batch geocoding, just pass an associative array instead of a string for each address.

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

Reverse geocoding is the process of turning geographic coordinates (i.e. latitude and longitude) into a human-readable address.

Geocodio will find matching street(s) and determine the correct house number based on the location. Note that Geocodio does not guarantee to return a valid house number; it is our closest approximation.

As with forward geocoding, you can either geocode a single set of coordinates at the time or collect multiple coordinates in batches and reverse geocode up to 10,000 coordinates at the time.

This endpoint can return up to 5 possible matches ranked and ordered by an [accuracy score](#accuracy-score).

<aside class="success">
A geographic coordinate consists of latitude followed by longitude separated by a comma, e.g. `38.9002898,-76.9990361`
</aside>

## Reverse geocoding single coordinate

> To reverse geocode a single coordinate:

```shell
curl "https://api.geocod.io/v1/reverse?q=38.9002898,-76.9990361&api_key=YOUR_API_KEY"
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
require_once 'vendor/autoload.php'
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$addresses = $client->reverse('38.9002898,-76.9990361');
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
}

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
        "number": "500",
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
      "formatted_address": "500 H St NE, Washington, DC 20002",
      "location": {
        "lat": 38.900203,
        "lng": -76.999507
      },
      "accuracy": 1,
      "accuracy_type": "nearest_street",
      "source": "TIGER/Line® dataset from the US Census Bureau"
    },
    {
      "address_components": {
        "number": "800",
        "street": "5th",
        "suffix": "St",
        "postdirectional": "NE",
        "formatted_street": "5th St NE",
        "city": "Washington",
        "county": "District of Columbia",
        "state": "DC",
        "zip": "20002",
        "country": "US"
      },
      "formatted_address": "800 5th St NE, Washington, DC 20002",
      "location": {
        "lat": 38.900203,
        "lng": -76.999507
      },
      "accuracy": 0.18,
      "accuracy_type": "nearest_street",
      "source": "TIGER/Line® dataset from the US Census Bureau"
    },
    {
      "address_components": {
        "number": "474",
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
      "formatted_address": "474 H St NE, Washington, DC 20002",
      "location": {
        "lat": 38.900205,
        "lng": -76.99994
      },
      "accuracy": 0.18,
      "accuracy_type": "nearest_street",
      "source": "TIGER/Line® dataset from the US Census Bureau"
    }
  ]
}
```

A single coordinate can be reverse geocoded by making a simple `GET` request to the *reverse* endpoint, you can <a href="https://api.geocod.io/v1/reverse?q=38.9002898,-76.9990361&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

### HTTP Request

`GET https://api.geocod.io/v1/reverse`

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
  https://api.geocod.io/v1/reverse?api_key=YOUR_API_KEY
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
require_once 'vendor/autoload.php'
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$address_sets = $client->reverse(array('35.9746000,-77.9658000', '32.8793700,-96.6303900', '33.8337100,-117.8362320', '35.4171240,-80.6784760'));
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
}

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

> Example response:

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
              "street": "State Hwy 58",
              "formatted_street": "State Hwy 58",
              "city": "Nashville",
              "county": "Nash County",
              "state": "NC",
              "zip": "27856",
              "country": "US"
            },
            "formatted_address": "101 State Hwy 58, Nashville, NC 27856",
            "location": {
              "lat": 35.974536,
              "lng": -77.965716
            },
            "accuracy": 1,
            "accuracy_type": "nearest_street",
            "source": "TIGER/Line® dataset from the US Census Bureau"
          },
          {
            "address_components": {
              "number": "100",
              "predirectional": "N",
              "street": "Alston",
              "suffix": "St",
              "formatted_street": "N Alston St",
              "city": "Nashville",
              "county": "Nash County",
              "state": "NC",
              "zip": "27856",
              "country": "US"
            },
            "formatted_address": "100 N Alston St, Nashville, NC 27856",
            "location": {
              "lat": 35.974536,
              "lng": -77.965716
            },
            "accuracy": 0.37,
            "accuracy_type": "nearest_street",
            "source": "TIGER/Line® dataset from the US Census Bureau"
          },
          {
            "address_components": {
              "number": "125",
              "predirectional": "S",
              "street": "Alston",
              "suffix": "St",
              "formatted_street": "S Alston St",
              "city": "Nashville",
              "county": "Nash County",
              "state": "NC",
              "zip": "27856",
              "country": "US"
            },
            "formatted_address": "125 S Alston St, Nashville, NC 27856",
            "location": {
              "lat": 35.974263,
              "lng": -77.965823
            },
            "accuracy": 0.36,
            "accuracy_type": "nearest_street",
            "source": "TIGER/Line® dataset from the US Census Bureau"
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
              "number": "100",
              "predirectional": "E",
              "street": "Kingsley",
              "suffix": "Rd",
              "formatted_street": "E Kingsley Rd",
              "city": "Garland",
              "county": "Dallas County",
              "state": "TX",
              "zip": "75041",
              "country": "US"
            },
            "formatted_address": "100 E Kingsley Rd, Garland, TX 75041",
            "location": {
              "lat": 32.878693,
              "lng": -96.630918
            },
            "accuracy": 1,
            "accuracy_type": "nearest_street",
            "source": "TIGER/Line® dataset from the US Census Bureau"
          },
          {
            "address_components": {
              "number": "2961",
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
            "formatted_address": "2961 S 1st St, Garland, TX 75041",
            "location": {
              "lat": 32.881541,
              "lng": -96.630962
            },
            "accuracy": 0.92,
            "accuracy_type": "nearest_street",
            "source": "TIGER/Line® dataset from the US Census Bureau"
          },
          {
            "address_components": {
              "number": "3084",
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
            "formatted_address": "3084 S 1st St, Garland, TX 75041",
            "location": {
              "lat": 32.878897,
              "lng": -96.630992
            },
            "accuracy": 0.87,
            "accuracy_type": "nearest_street",
            "source": "TIGER/Line® dataset from the US Census Bureau"
          }
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
You can batch reverse geocode up to 10,000 coordinates at the time.
</aside>

### HTTP Request

`POST https://api.geocod.io/v1/reverse`

### URL Parameters

Parameter | Description
--------- | -----------
api_key | Your Geocodio API key

# Fields

> To get the congressional district and stage legislative districts for an address:

```shell
curl "https://api.geocod.io/v1/geocode?q=1109+N+Highland+St%2c+Arlington+VA&fields=cd,stateleg&api_key=YOUR_API_KEY"
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
require_once 'vendor/autoload.php'
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$location = $client->get('1109 N Highland St, Arlington VA', ['cd', 'stateleg']);
```

```javascript
// There is no Node.js support for fields yet. Feel free to contribute
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
        "lat": 38.886665,
        "lng": -77.094733
      },
      "accuracy": 1,
      "accuracy_type": "rooftop",
      "source": "Virginia GIS Clearinghouse",
      "fields": {
        "congressional_district": {
          "name": "Congressional District 8",
          "district_number": 8,
          "congress_number": "114th",
          "congress_years": "2015-2017"
        },
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
<strong>Note:</strong> Fields count as an additional lookup each. Please consult the <a href="/pricing">pricing page</a>.
</aside>

Geocodio allows you to request additional information with forward and reverse geocoding requests, we call these *fields*.

Requesting fields are easy, just add a `fields` parameter to your query string and set the value according to the table below. If you want multiple fields, just separate them with a comma. If the `fields` parameter has been specified, a new `fields` key is exposed with each geocoding result containing all necessary data for each field.

Go ahead, <a href="https://api.geocod.io/v1/geocode?q=1109+N+Highland+St%2c+Arlington+VA&fields=cd&api_key=YOUR_API_KEY" target="_blank">try this in your browser right now</a>.

Some fields are specific to the US and can not be queried for other countries.

Parameter name                | Description                                       | Coverage                    |
----------------------------- | ------------------------------------------------- | --------------------------- |
cd, cd113, cd114, *or* cd115  | Congressional District                            | US-only                     |
stateleg                      | State Legislative District (House & Senate)       | US-only                     |
school                        | School District (elementary/secondary or unified) | US-only                     |
census                        | Census Block/Tract & FIPS codes                   | US-only                     |
timezone                      | Timezone                                          | <i class="fa fa-globe"></i> |



<aside class="notice">
Fields works with both single and batch geocoding.
</aside>

## Congressional Districts
```json
...
"fields": {
  "congressional_district": {
    "name": "Congressional District 36",
    "district_number": 36,
    "congress_number": "115th",
    "congress_years": "2017-2019"
  }
}
...
```
You can retrieve the congressional district for an address or coordinate using `cd`, `cd113`, `cd114`, or `cd115` in the `fields` query parameter. `cd` will always return the congressional district for the current progress while e.g. `cd113` will continue to show the congressional district for the 113th congress.

The field returns the full name of the congressional district, the district number the congress number and the range of years the congress are covering.

<aside class="warning">
It might be tempting to look congressional districts up by zip code, but this is discouraged &mdash; primarily because zip codes are postal routes and not areas which can cause imprecise results. Also note that some zip codes span over multiple congressional districts and Geocodio will only return one district per result.
</aside>

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

The field will return both the *house* and *senate* state legislative district (also known as *lower* and *upper*) with the full name and district numbe for each. For areas with a [unicameral legislature](http://en.wikipedia.org/wiki/Unicameralism) (such as Washington DC or Nebraska), only the `senate` key is returned.

<aside class="success">
State Legislative District boundary data were last updated on: <em>Februrary 28th, 2016</em>
</aside>

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
You can retrieve the school districts for an address or coordinate using `school` in the `fields` query parameter.

The field will return either a *unified* school district or separate *elementary* and *secondary* fields depending on the area. Each school district is returned with its full name, the LEA (Local Education Agency) code as well as the grades supported. Kindergarden is abbreviated as *KG* and Pre-kindergarten is abbreviated as *PK*.

## Census Block/Tract & FIPS codes
```json
...
"fields": {
  "census": {
    "state_fips": "11",
    "county_fips": "11001",
    "place_fips": "1150000",
    "tract_code": "007000",
    "block_group": "2",
    "block_code": "2014",
    "census_year": 2015
  }
}
...
```
This will append various census-designated codes to your address. Here is a description of each field.

Field        | Description
------------ | -----------------------------------------------------------
census_year  | The full year that the Census data belongs to (The U.S. Census Bureau might make slight boundary changes from year to year)
state_fips   | The two-digit state FIPS code. A full list is available on [Wikipedia](https://en.wikipedia.org/wiki/Federal_Information_Processing_Standard_state_code)
county_fips  | The five-digit county FIPS code. The two first digits represents the state. A full list of US counties is available on [Wikipedia](https://en.wikipedia.org/wiki/List_of_United_States_counties_and_county_equivalents)
place_fips   | The 7-digit place FIPS code. A place is defined as a city or other census designated area. A full list of ANSI codes is available from the [U.S. Census Bureau](https://www.census.gov/geo/reference/codes/place.html)
tract_code   | The 6-digit census tract code. This is a subdivision of a county, used for statistical purposes.
block_code   | The full 4-digit block code that the location belongs to. This is the smallest geographical unit that the U.S. Census Bureau provides statistical data for.
block_group  | The single-digit group number for the block

The U.S. Census Bureau also provides a more [detailed guide](https://www.census.gov/geo/reference/gtc/gtc_ct.html) for the above terms.

Using census tracts and blocks, you will be able to match locations up with statistical data from the U.S. Census Bureau. You can for example utilize the [American Community Survey (ACS) data](https://www.census.gov/programs-surveys/acs/data.html).

## Timezone
```json
...
"fields": {
  "timezone": {
    "name": "EST",
    "utc_offset": -5,
    "observes_dst": true
  }
}
...
```
You can retrieve the timezone for an address or coordinate using `timezone` in the `fields` query parameter.

The field will return the name of the timezone as a three letter abbreviation (see table below), the UTC/GMT offset and whether the location observes daylight savings time (DST). Lookups in countries outside the US will return the timezone name following the ["tz database" format](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones). E.g. `America/Toronto`

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

As of June 2015 the parse endpoint has been deprecated in favor of the regular geocode endpoint that is greatly improved and also provides address parsing. The parse endpoint is unsupported and will be completely removed in the future.
</aside>

If you just need to an address into individual components, Geocodio can help you too. The parse endpoint is however very simple and does not provide intelligent address correction and address completion.

If you need these features we recommend that you use the regular geocoding endpoint and retrieve the parsed components from there.

<aside class="notice">
<strong>Note:</strong> Address parsing is free of charge and does not count towards your API usage. (You still need an API key, though.)
</aside>

> To parse an address:

```shell
curl "https://api.geocod.io/v1/parse?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY"
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
require_once 'vendor/autoload.php'
use Stanley\Geocodio\Client;

// Create the new Client object by passing in your api key
$client = new Client('YOUR_API_KEY');

$address = $client->parse('1109 N Highland St, Arlington VA');
```

```javascript
var Geocodio = require('geocodio');

var config = {
    api_key: 'YOUR_API_KEY'
}

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

`GET https://api.geocod.io/v1/parse`

### URL Parameters

Parameter | Description
--------- | -----------
q | The query (i.e. address) to parse
api_key | Your Geocodio API key

<aside class="notice">
Make sure to check the <a href="#address-formats">address formats</a> section for more information on the different address formats supported.
</aside>

# Accuracy score
Each geocoded result is returned with an accuracy score, which is a decimal number ranging from 0.00 to 1.00. This score is generated by the internal Geocodio engine based on how accurate the result is believed to be. The higher the score the better the result. Results are always returned ordered by accuracy score.

For example, if against all odds an address simply can't be found — instead of returning no results, Geocodio will return a geocoded point based on the zip code or city but with a much lower accuracy score and accuracy type set to "place".

Generally, accuracy scores that are larger than or equal to `0.8` are usually helpful, whereas results with lower accuracy scores might be very rough matches.

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
nearest_street      | Nearest match for a specific street with estimated street number
nearest_place       | Closest city/town/place

# Address formats
Geocodio supports geocoding the following entities:

* Streets with or without house numbers (requires a city or a zip in conjuction)
* [Intersections](#intersections)
* Cities
* Zip codes
* States

If a city is provided without a state, Geocodio will automatically guess and add the state based on what it most likely might be. Geocodio also understands shorthands for both streets and cities, e.g. *NYC*, *SF*, etc. are acceptable city names.

Geocoding queries can be formatted in various ways. Here are some examples of valid queries:

* <a href="https://api.geocod.io/v1/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, Arlington VA</a>
* <a href="https://api.geocod.io/v1/geocode?q=1109+N+Highland+Street%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland Street, Arlington VA</a>
* <a href="https://api.geocod.io/v1/geocode?q=1109+North+Highland+Street%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 North Highland Street, Arlington VA</a>
* <a href="https://api.geocod.io/v1/geocode?q=1109+N+Highland+St%2c+Arlington+VA&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, Arlington VA</a>
* <a href="https://api.geocod.io/v1/geocode?q=1109+N+Highland+St,+22201&api_key=YOUR_API_KEY" target="_blank">1109 N Highland St, 22201</a>
* <a href="https://api.geocod.io/v1/geocode?q=Arlington%2c+VA&api_key=YOUR_API_KEY" target="_blank">Arlington, VA</a>
* <a href="https://api.geocod.io/v1/geocode?q=Arlington&api_key=YOUR_API_KEY" target="_blank">Arlington</a>
* <a href="https://api.geocod.io/v1/geocode?q=VA&api_key=YOUR_API_KEY" target="_blank">VA</a>
* <a href="https://api.geocod.io/v1/geocode?q=22201&api_key=YOUR_API_KEY" target="_blank">22201</a>

If a country is not specified in the query, the Geocoding engine will implicitly assume the country to be USA.

Examples of Canadian lookups:

* <a href="https://api.geocod.io/v1/geocode?q=525+University+Ave%2C+Toronto%2C+ON%2C+Canada&api_key=YOUR_API_KEY" target="_blank">525 University Ave, Toronto, ON, Canada</a>
* <a href="https://api.geocod.io/v1/geocode?q=7515+118+Ave+NW%2C+Edmonton%2C+AB+T5B+0X2%2C+Canada&api_key=YOUR_API_KEY" target="_blank">7515 118 Ave NW, Edmonton, AB T5B 0X2, Canada</a>

## Intersections

You can also geocode intersections, just specify the two streets that you want to geocode in your query. We support various formats, here's a few examples:

* <a href="https://api.geocod.io/v1/geocode?q=E+58th+St+and+Madison+Ave%2C+New+York%2C+NY&api_key=YOUR_API_KEY" target="_blank">E 58th St and Madison Ave, New York, NY</a>
* <a href="https://api.geocod.io/v1/geocode?q=Market+and+4th%2C+San+Francisco&api_key=YOUR_API_KEY" target="_blank">Market and 4th, San Francisco</a>
* <a href="https://api.geocod.io/v1/geocode?q=Commonwealth+Ave+at+Washington+Street%2C+Boston%2C+MA&api_key=YOUR_API_KEY" target="_blank">Commonwealth Ave at Washington Street, Boston, MA</a>
* <a href="https://api.geocod.io/v1/geocode?q=Florencia+%26+Perlita%2C+Austin+TX&api_key=YOUR_API_KEY" target="_blank">Florencia & Perlita, Austin TX</a>
* <a href="https://api.geocod.io/v1/geocode?q=Quail+Trail+%40+Dinkle+Rd%2C+Edgewood%2C+NM&api_key=YOUR_API_KEY" target="_blank">Quail Trail @ Dinkle Rd, Edgewood, NM</a>
* <a href="https://api.geocod.io/v1/geocode?q=8th+St+SE%2FI+St+SE%2C+20003&api_key=YOUR_API_KEY" target="_blank">8th St SE/I St SE, 20003</a>

An extra `address_components_secondary` property will be exposed for intersection results, but otherwise the schema format is the same.

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

The Geocodio API employs semantic HTTP status codes. This is some of the status codes you can expect to see:

Error Code | Meaning
---------- | -------
200 OK | Hopefully you will see this most of the time. Note that this status code will also be returned even though no geocoding results were available
403 Forbidden | Invalid API key or other reason why access is forbidden
422 Unprocessable Entity | A client error prevented the request from executing succesfully (e.g. invalid address provided). A JSON object will be returned with an error key containing a full error message
500 Server Error | Hopefully you will never see this...it means that something went wrong in our end. Whoops.

Please check [status.geocod.io](http://status.geocod.io) for latest platform status updates, if encounter see any unexpected errors.

# Client-side access
> To Geocode an address using a jQuery AJAX call.

```html
<script>
var address = '1109 N Highland St, Arlington VA',
    apiKey = 'YOUR_API_KEY';

$.get('https://api.geocod.io/v1/geocode?q='+ encodeURIComponent(address) +'&api_key=' + encodeURIComponent(apiKey), function (response) {
  console.log(response.results);
});
</script>
```

The Geocodio API supports `CORS` using the `Access-Control-Allow-Origin` *HTTP* header. This means that you will be able to make requests directly to the API using JavaScript.

See an example to the right.

<aside class="notice">
<strong>Note:</strong> This will expose your API Key publicly, make sure that you understand and accept the implications of this approach.
</aside>

# Contact & Support
Have any questions? Feel free to tweet us [@Geocodio](http://twitter.com/Geocodio) or shoot us an email [support@geocod.io](mailto:support@geocod.io).

If you find an error in the documentation or want something to be clarified, please create a [pull request](https://github.com/Geocodio/docs/pulls) or [issue](https://github.com/Geocodio/docs/issues) so we can correct it.

