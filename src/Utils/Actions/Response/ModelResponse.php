<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.04.
 * Time: 20:59
 */

namespace Utils\Actions\Response;

use Utils\Actions\Response;

class ModelResponse implements Response {
	
	private $model;
	
	/**
	 * ModelResponse constructor.
	 *
	 * @param $model
	 */
	public function __construct($model) {
		$this->model = $model;
	}
	
	/**
	 * @return mixed
	 */
	public function getModel() {
		return $this->model;
	}
	
}