<?php
function template($country, $fields, $includeResponse) {
	switch ($country) {
		case 'us':
			$address = '1109 N Highland St, Arlington VA';
			$coordinate = '38.886672,-77.094735';
			break;

		case 'ca':
			$address = '300 King St, Sturgeon Falls, ON P2B 3A1, Canada';
			$coordinate = '46.225866,-79.36316';
			break;

		case 'ca-alt':
			$address = '203 Laycoe Crescent, Saskatoon, SK, Canada';
			$coordinate = '52.155106,-106.589896';
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


	$responseSnippet = $includeResponse
		? getApiResponse($address, $fields)
		: '';

	$template = <<<TEMPLATE
	> To get $fieldAppendsDescription field appends for an address or a coordinate:

	```shell
	curl "https://api.geocod.io/v1.9/geocode?q=$addressUrlEncoded&fields=$commaSeparated&api_key=YOUR_API_KEY"
	curl "https://api.geocod.io/v1.9/reverse?q=$coordinate&fields=$commaSeparated&api_key=YOUR_API_KEY"
	```

	```ruby
	require 'geocodio/gem'

	geocodio = Geocodio::Gem.new('YOUR_API_KEY')

	location = geocodio.geocode(['$address'], [$singleQuotedCommaSeparated])
	location = geocodio.reverse(['$coordinate'], [$singleQuotedCommaSeparated])
	```

	```python
	from geocodio import Geocodio

	client = Geocodio("YOUR_API_KEY")

	response = client.geocode("$address", fields=[$doubleQuotedCommaSeparated])
	response = client.reverse("$coordinate", fields=[$doubleQuotedCommaSeparated])
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

	TEMPLATE;

	return $template . PHP_EOL . $responseSnippet;
}

function getApiResponse(string $address, array $fields) {
	// Get API key from environment if available
	$apiKey = getenv('GEOCODIO_API_KEY') ?: 'DEMO';

	$stubFile = 'stubs/' . hash('xxh32', $address) . '_' . implode('-', $fields) . '.json';

	if (getenv('DISABLE_API')) {
		$apiContent = file_get_contents($stubFile);
	} else {	
		$url = "https://api.geocod.io/v1.9/geocode?q=". urlencode($address) ."&fields=". implode(',', $fields) ."&api_key=$apiKey";

		$sslVerify = !str_contains($url, 'dev');
		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $sslVerify);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $sslVerify ? 2 : 0);
		
		$apiContent = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$error = curl_error($ch);
		$errorNo = curl_errno($ch);
		
		curl_close($ch);
		
		if ($apiContent === false || $errorNo !== 0) {
			fwrite(STDERR, "ERROR: Failed to fetch API data from $url" . PHP_EOL);
			fwrite(STDERR, "CURL Error ($errorNo): $error" . PHP_EOL);
			exit(1);
		}
		
		if ($httpCode >= 400) {
			fwrite(STDERR, "ERROR: HTTP status $httpCode when fetching $url" . PHP_EOL);
			fwrite(STDERR, "Response body: $apiContent" . PHP_EOL);
			exit(1);
		}
	}
	
	$json = json_decode($apiContent);
	if ($json === null) {
		fwrite(STDERR, "ERROR: Failed to parse API response as JSON" . PHP_EOL);
		exit(1);
	}
	
	if (empty($json->results)) {
		fwrite(STDERR, "ERROR: API response did not contain any results" . PHP_EOL);
		fwrite(STDERR, "Response: " . json_encode($json) . PHP_EOL);
		exit(1);
	}
	
	$firstResult = $json->results[0];
	if (!isset($firstResult->fields)) {
		fwrite(STDERR, "ERROR: API response did not contain fields data" . PHP_EOL);
		fwrite(STDERR, "First result: " . json_encode($firstResult) . PHP_EOL);
		exit(1);
	}

	file_put_contents($stubFile, json_encode($json, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));

	$jsonSnippet = json_encode([
		'fields' => $firstResult->fields
	], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

	// Indent with 2 spaces instead of 4
	$formattedJsonSnippet = preg_replace('/^(  +?)\\1(?=[^ ])/m', '$1', $jsonSnippet);
	$formattedJsonSnippet = trim(trim($formattedJsonSnippet, '{}'));

	return <<<TEMPLATE
	> Example for "$address":

	```json
	...
	  $formattedJsonSnippet
	...
	```
	TEMPLATE;
}

$source = file_get_contents('source.html.md');

$source = preg_replace_callback('/<!--FIELD:([A-Z-]+):([A-Z0-9-,]+)-->/i', function($match) {
	list(,$country, $fields) = $match;

	$fields = explode(',', $fields);
	return template($country, $fields, true);
}, $source);

$source = preg_replace_callback('/<!--FIELD_SIMPLE:([A-Z-]+):([A-Z0-9-,]+)-->/i', function($match) {
	list(,$country, $fields) = $match;

	$fields = explode(',', $fields);
	return template($country, $fields, false);
}, $source);

echo $source;
