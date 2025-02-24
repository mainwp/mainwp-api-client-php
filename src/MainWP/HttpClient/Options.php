<?php

/**
 * MainWP REST API HTTP Client Options
 *
 * @category HttpClient
 * @package  MainWP/Dashboard
 */

namespace MainWP\Dashboard\HttpClient;

/**
 * REST API HTTP Client Options class.
 *
 * @package MainWP/Dashboard
 */
class Options {

	/**
	 * Default MainWP REST API version.
	 *
	 * @var string
	 */
	public const VERSION = 'v2';

	/**
	 * Default request timeout.
	 */
	public const TIMEOUT = 30;

	/**
	 * Default WP API prefix.
	 * Including leading and trailing slashes.
	 */
	public const WP_API_PREFIX = '/wp-json/';

	/**
	 * Default User Agent.
	 * No version number.
	 */
	public const USER_AGENT = 'MainWP Dashboard API Client-PHP';

	/**
	 * Options.
	 *
	 * @var array
	 */
	private $options;

	/**
	 * Initialize HTTP client options.
	 *
	 * @param array $options Client options.
	 */
	public function __construct( $options ) {
		$this->options = $options;
	}

	/**
	 * Get API version.
	 *
	 * @return string
	 */
	public function getVersion() {
		return isset( $this->options['version'] ) ? $this->options['version'] : self::VERSION;
	}

	/**
	 * Check if need to verify SSL.
	 *
	 * @return bool
	 */
	public function verifySsl() {
		return isset( $this->options['verify_ssl'] ) ? (bool) $this->options['verify_ssl'] : true;
	}

	/**
	 * Get auth method.
	 *
	 * @return string bearer|basic.
	 */
	public function getAuthMethod() {
		if ( ! empty( $this->options['auth_method'] ) && in_array( $this->options['auth_method'], array( 'basic' ) ) ) {
			return $this->options['auth_method'];
		}
		return 'bearer';
	}

	/**
	 * Get timeout.
	 *
	 * @return int
	 */
	public function getTimeout() {
		return isset( $this->options['timeout'] ) ? (int) $this->options['timeout'] : self::TIMEOUT;
	}

	/**
	 * Basic Authentication as query string.
	 * Some old servers are not able to use CURLOPT_USERPWD.
	 *
	 * @return bool
	 */
	public function isQueryStringAuth() {
		return isset( $this->options['query_string_auth'] ) ? (bool) $this->options['query_string_auth'] : false;
	}

	/**
	 * Custom API Prefix for WP API.
	 *
	 * @return string
	 */
	public function apiPrefix() {
		return self::WP_API_PREFIX;
	}

	/**
	 * Get Extension API.
	 *
	 * @return string
	 */
	public function apiForExtension() {
		$ext_api = isset( $this->options['extension_api'] ) ? $this->options['extension_api'] : '';
		if ( ! empty( $ext_api ) & is_string( $ext_api ) ) {
			$ext_api = \rtrim( $ext_api, '/' );
			return $ext_api . '/';
		}
		return '';
	}

	/**
	 * Custom user agent.
	 *
	 * @return string
	 */
	public function userAgent() {
		return isset( $this->options['user_agent'] ) ? $this->options['user_agent'] : self::USER_AGENT;
	}

	/**
	 * Get follow redirects.
	 *
	 * @return bool
	 */
	public function getFollowRedirects() {
		return isset( $this->options['follow_redirects'] ) ? (bool) $this->options['follow_redirects'] : false;
	}

	/**
	 * Check is it needed to mask all non-GET/POST methods (PUT/DELETE/etc.) by using POST method with added
	 * "X-HTTP-Method-Override: METHOD" HTTP header into request.
	 *
	 * @return bool
	 */
	public function isMethodOverrideHeader() {
		return isset( $this->options['method_override_header'] ) && $this->options['method_override_header'];
	}
}
