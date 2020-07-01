<?php

/*
 * |--------------------------------------------------------------------------
 * | CodeIgniterCORS Config
 * |--------------------------------------------------------------------------
 * |
 * | The allowed_methods and allowed_headers options are case-insensitive.
 * |
 */

return [
	// You can enable CORS for one or multiple or all (*) paths.
	'*' => [
		'allowed_origins' => ['*'], // Matches the request origin. `['*']` allows all origins.
		'allowed_methods' => ['*'], // Matches the request method. `['*']` allows all methods.
		'allowed_headers' => ['*'], // Sets the Access-Control-Allow-Headers response header. `['*']` allows all headers.
		'exposed_headers' => [], // Sets the Access-Control-Expose-Headers response header with these headers.
		'max_age' => 0, // Sets the Access-Control-Max-Age response header when > 0.
		'supports_credentials' => false // Sets the Access-Control-Allow-Credentials header.
	],
	// Examples
	/*'api' => [
		'allowed_methods' => ['GET'],
		'allowed_origins' => ['*'],
		'allowed_headers' => ['*'],
		'exposed_headers' => [],
		'max_age' => 0,
		'supports_credentials' => false
	],
	'api/members' => [
		'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],
		'allowed_origins' => ['http://localhost:8080'],
		'allowed_headers' => ['*'],
		'exposed_headers' => [],
		'max_age' => 0,
		'supports_credentials' => false
	]*/
];
