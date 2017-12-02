<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 17:52
 */

namespace Utils\Actions;

interface ActionFactory {
	
	/**
	 * @param Responder $responder
	 * @return Action
	 */
	public function create(Responder $responder);
}