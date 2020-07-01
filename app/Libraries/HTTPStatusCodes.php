<?php namespace App\Libraries;

/**
 * Class HTTP Status Codes List
 *
 * Source: https://fr.wikipedia.org/wiki/Liste_des_codes_HTTP
 *
 * @author Manuel Piton <manu@redsky.be>
 * @copyright Copyright 2019 Redsky Thirty
 * @version 1.0.0
 *
 * @package App\Libraries
 */
class HTTPStatusCodes
{
	// [Informational 1xx]
	const CONTINUE = 100;
	const SWITCHING_PROTOCOLS = 101;
	const PROCESSING = 102;
	const EARLY_HINTS = 103;
	
	// [Successful 2xx]
	const OK = 200;
	const CREATED = 201;
	const ACCEPTED = 202;
	const NONAUTHORITATIVE_INFORMATION = 203;
	const NO_CONTENT = 204;
	const RESET_CONTENT = 205;
	const PARTIAL_CONTENT = 206;
	const MULTI_STATUS = 207;
	const ALREADY_REPORTED = 208;
	const CONTENT_DIFFERENT = 210;
	const IM_USED = 226;
	
	// [Redirection 3xx]
	const MULTIPLE_CHOICES = 300;
	const MOVED_PERMANENTLY = 301;
	const FOUND = 302;
	const SEE_OTHER = 303;
	const NOT_MODIFIED = 304;
	const USE_PROXY = 305;
	const UNUSED = 306;
	const TEMPORARY_REDIRECT = 307;
	const PERMANENT_REDIRECT = 308;
	const TOO_MANY_REDIRECTS = 310;
	
	// [Client Error 4xx]
	const BAD_REQUEST = 400;
	const UNAUTHORIZED = 401;
	const PAYMENT_REQUIRED = 402;
	const FORBIDDEN = 403;
	const NOT_FOUND = 404;
	const METHOD_NOT_ALLOWED = 405;
	const NOT_ACCEPTABLE = 406;
	const PROXY_AUTHENTICATION_REQUIRED = 407;
	const REQUEST_TIMEOUT = 408;
	const CONFLICT = 409;
	const GONE = 410;
	const LENGTH_REQUIRED = 411;
	const PRECONDITION_FAILED = 412;
	const REQUEST_ENTITY_TOO_LARGE = 413;
	const REQUEST_URI_TOO_LONG = 414;
	const UNSUPPORTED_MEDIA_TYPE = 415;
	const REQUESTED_RANGE_NOT_SATISFIABLE = 416;
	const EXPECTATION_FAILED = 417;
	const I_M_A_TEAPOT = 418;
	const BAD_MAPPING = 421;
	const UNPROCESSABLE_ENTITY = 422;
	const LOCKED = 423;
	const METHOD_FAILURE = 424;
	const UNORDERED_COLLECTION = 425;
	const UPGRADE_REQUIRED = 426;
	const PRECONDITION_REQUIRED = 428;
	const TOO_MANY_REQUESTS = 429;
	const REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
	const RETRY_WITH = 449;
	const BLOCKED_BY_WINDOWS_PARENTAL_CONTROLS = 450;
	const UNAVAILABLE_FOR_LEGAL_REASONS = 451;
	const UNRECOVERABLE_ERROR = 456;
	
	// [Server Error 5xx]
	const INTERNAL_SERVER_ERROR = 500;
	const NOT_IMPLEMENTED = 501;
	const BAD_GATEWAY = 502;
	const SERVICE_UNAVAILABLE = 503;
	const GATEWAY_TIMEOUT = 504;
	const HTTP_VERSION_NOT_SUPPORTED = 505;
	const VARIANT_ALSO_NEGOTIATES = 506;
	const INSUFFICIENT_STORAGE = 507;
	const LOOP_DETECTED = 508;
	const BANDWIDTH_LIMIT_EXCEEDED = 509;
	const NOT_EXTENDED = 510;
	const NETWORK_AUTHENTICATION_REQUIRED = 511;
}
