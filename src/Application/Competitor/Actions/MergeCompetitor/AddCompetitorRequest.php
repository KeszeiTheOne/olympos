<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.04.
 * Time: 21:05
 */

namespace Application\Competitor\Actions\MergeCompetitor;

use Utils\Actions\Request;

class AddCompetitorRequest implements Request {
	
	public $name;
	
	public function isValid() {
		return null !== $this->name;
	}
	
}