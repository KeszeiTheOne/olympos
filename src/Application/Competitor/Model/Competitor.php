<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.04.
 * Time: 21:02
 */

namespace Application\Competitor\Model;

class Competitor {
	
	private $name;
	
	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
}