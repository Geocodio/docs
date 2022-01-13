<?php
function template($country, $fields) {
	switch ($country) {
		case 'us':
			$address = '1109 N Highland St, Arlington VA';
			$coordinate = '38.886672,-77.094735';
			break;

		case 'ca':
			$address = '2546 Rue Bourgoin, Saint-Laurent, QC Canada';
			$coordinate = '45.505082,-73.698455';
			break;

		default:
			throw new \Exception('Unsupported country: ' . $country);
	}

	$addressUrlEncoded = urlencode($address);
	$coordinateWithSpace = str_replace(',', ', ', $coordinate);

	$fieldsWithBackTicks = array_map(function ($f) { return '`' . $f . '`'; }, $fields);
	$fieldAppendsDescription = count($fieldsWithBackTicks) === 2
		? implode(' and ', $fieldsWithBackTicks)
		: implode(', ', $fieldsWithBackTicks);

	$commaSeparated = implode(',', $fields);
	$spaceSeparated = implode(' ', $fields);
	$doubleQuotedCommaSeparated = implode(', ', array_map(function ($f) { return '"' . $f . '"'; }, $fields));
	$singleQuotedCommaSeparated = implode(', ', array_map(function ($f) { return "'" . $f . "'"; }, $fields));
	$doubleQuotedSpaceSeparated = implode(' ', array_map(function ($f) { return '"' . $f . '"'; }, $fields));

	return <<<TEMPLATE
	> To get $fieldAppendsDescription field appends for an address or a coordinate:

	```shell
	curl "https://api.geocod.io/v1.7/geocode?q=$addressUrlEncoded&fields=$commaSeparated&api_key=YOUR_API_KEY"
	curl "https://api.geocod.io/v1.7/reverse?q=$coordinate&fields=$commaSeparated&api_key=YOUR_API_KEY"
	```

	```ruby
	require 'geocodio'

	geocodio = Geocodio::Client.new('YOUR_API_KEY')

	location = geocodio.geocode(['$address'], :fields %w[$spaceSeparated])
	location = geocodio.reverse_geocode(['$coordinate'], :fields %w[$spaceSeparated])
	```

	```python
	from geocodio import GeocodioClient

	client = GeocodioClient(YOUR_API_KEY)

	location = client.geocode("$address", fields=[$doubleQuotedCommaSeparated])
	location = client.reverse(($coordinateWithSpace), fields=[$doubleQuotedCommaSeparated])
	```

	```php
	<?php
	\$response = \$geocoder->geocode('$address', [$singleQuotedCommaSeparated]);
	\$response = \$geocoder->reverse('$coordinate', [$singleQuotedCommaSeparated]);
	```

	```javascript
	const Geocodio = require('geocodio-library-node');
	const geocodio = new Geocodio('YOUR_API_KEY');

	geocoder.geocode('$address', [$singleQuotedCommaSeparated])
	  .then(response => {
	    console.log(response);
	  })
	  .catch(err => {
	    console.error(err);
	  }
	);

	geocoder.reverse('$coordinate', [$singleQuotedCommaSeparated])
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
	 
	(single "$address" :api_key "YOUR_API_KEY" :fields [$doubleQuotedSpaceSeparated])
	(single-reverse "$coordinate" :api_key "YOUR_API_KEY" :fields [$doubleQuotedSpaceSeparated])
	```
	TEMPLATE;
}

echo preg_replace_callback('/<!--FIELD:([A-Z]{2}):([A-Z,]+)-->/i', function($match) {
	list(,$country, $fields) = $match;

	$fields = explode(',', $fields);
	return template($country, $fields);
}, file_get_contents('source.html.md'));