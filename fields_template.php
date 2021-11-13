<?php
function template($fields) {
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
	curl "https://api.geocod.io/v1.7/geocode?q=1109+N+Highland+St%2c+Arlington+VA&fields=$commaSeparated&api_key=YOUR_API_KEY"
	curl "https://api.geocod.io/v1.7/reverse?q=38.886672,-77.094735&fields=$commaSeparated&api_key=YOUR_API_KEY"
	```

	```ruby
	require 'geocodio'

	geocodio = Geocodio::Client.new('YOUR_API_KEY')

	location = geocodio.geocode(['1109 N Highland St, Arlington VA'], :fields %w[$spaceSeparated])
	location = geocodio.reverse_geocode(['38.886672,-77.094735'], :fields %w[$spaceSeparated])
	```

	```python
	from geocodio import GeocodioClient

	client = GeocodioClient(YOUR_API_KEY)

	location = client.geocode("1109 N Highland St, Arlington VA", fields=[$doubleQuotedCommaSeparated])
	location = client.reverse((38.886672, -77.094735), fields=[$doubleQuotedCommaSeparated])
	```

	```php
	<?php
	\$response = \$geocoder->geocode('1109 N Highland St, Arlington VA', [$singleQuotedCommaSeparated]);
	\$response = \$geocoder->reverse('38.886672,-77.094735', [$singleQuotedCommaSeparated]);
	```

	```javascript
	const Geocodio = require('geocodio-library-node');
	const geocodio = new Geocodio('YOUR_API_KEY');

	geocoder.geocode('1109 N Highland St, Arlington VA', [$singleQuotedCommaSeparated])
	  .then(response => {
	    console.log(response);
	  })
	  .catch(err => {
	    console.error(err);
	  }
	);

	geocoder.reverse('38.886672,-77.094735', [$singleQuotedCommaSeparated])
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
	 
	(single "1109 N Highland St, Arlington VA" :api_key "YOUR_API_KEY" :fields [$doubleQuotedSpaceSeparated])
	(single-reverse "38.886672,-77.094735" :api_key "YOUR_API_KEY" :fields [$doubleQuotedSpaceSeparated])
	```
	TEMPLATE;
}

echo preg_replace_callback('/<!--FIELD:([A-Z,]+)-->/i', function($match) {
	$fields = explode(',', $match[1]);
	return template($fields);
}, file_get_contents('source.html.md'));