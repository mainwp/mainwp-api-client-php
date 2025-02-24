<?php

/**
 * MainWP REST API Client
 *
 * @category Client
 * @package  MainWP/Dashboard
 */

namespace MainWP\Dashboard;

use MainWP\Dashboard\HttpClient\HttpClient;

/**
 * REST API Client class.
 *
 * @package MainWP/Dashboard
 */
class Client {

	/**
	 * MainWP REST API Client version.
	 */
	public const VERSION = '1.0.0';

	/**
	 * HttpClient instance.
	 *
	 * @var HttpClient
	 */
	public $http;

	/**
	 * Initialize client.
	 *
	 * @param string $url            Store URL.
	 * @param string $consumerApiKey API key (Bearer token).
	 * @param array  $options        Options (version, timeout, verify_ssl, auth_method).
	 */
	public function __construct( $url, $consumerApiKey = '', $options = array() ) {
		$this->http = new HttpClient( $url, $consumerApiKey, $options );
	}

	/**
	 * POST method.
	 *
	 * @param string $endpoint API endpoint.
	 * @param array  $data     Request data.
	 *
	 * @return \stdClass
	 */
	public function post( $endpoint, $data = array() ) {
		return $this->http->request( $endpoint, 'POST', $data );
	}

	/**
	 * PUT method.
	 *
	 * @param string $endpoint API endpoint.
	 * @param array  $data     Request data.
	 *
	 * @return \stdClass
	 */
	public function put( $endpoint, $data = array() ) {
		return $this->http->request( $endpoint, 'PUT', $data );
	}

	/**
	 * GET method.
	 *
	 * @param string $endpoint   API endpoint.
	 * @param array  $parameters Request parameters.
	 *
	 * @return \stdClass
	 */
	public function get( $endpoint, $parameters = array() ) {
		return $this->http->request( $endpoint, 'GET', array(), $parameters );
	}

	/**
	 * DELETE method.
	 *
	 * @param string $endpoint   API endpoint.
	 * @param array  $parameters Request parameters.
	 *
	 * @return \stdClass
	 */
	public function delete( $endpoint, $parameters = array() ) {
		return $this->http->request( $endpoint, 'DELETE', array(), $parameters );
	}

	/**
	 * OPTIONS method.
	 *
	 * @param string $endpoint API endpoint.
	 *
	 * @return \stdClass
	 */
	public function options( $endpoint ) {
		return $this->http->request( $endpoint, 'OPTIONS', array(), array() );
	}
}
