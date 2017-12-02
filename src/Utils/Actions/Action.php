<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 17:54
 */

namespace Utils\Actions;

interface Action {
	
	public function run(Request $request);
	
	/**
	 * @return Responder
	 */
	public function getResponder();
}