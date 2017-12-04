<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.04.
 * Time: 21:00
 */

namespace Utils\Actions;

abstract class AbstractAction implements Action {
	
	/**
	 * @var Responder
	 */
	protected $responder;
	
	public function __construct(Responder $responder) {
		
		$this->responder = $responder;
	}
	
	public function getResponder() {
		return $this->responder;
	}
	
}