<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 17:53
 */

namespace Utils\Actions;

class Responder {
	
	/**
	 * @var Response
	 */
	private $response;
	
	/**
	 * @return Response
	 * @throws MissingResponse
	 */
	public function getResponse(): Response {
		if ( null === $this->response ) {
			throw new MissingResponse();
		}
		
		return $this->response;
	}
	
	/**
	 * @param Response $response
	 */
	public function setResponse(Response $response) {
		$this->response = $response;
	}
	
}