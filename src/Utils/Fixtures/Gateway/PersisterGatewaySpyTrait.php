<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 23:23
 */

namespace Utils\Fixtures\Gateway;

trait PersisterGatewaySpyTrait {
	
	private $objects = [];
	
	public function persist($object) {
		$this->objects[] = $object;
	}
	
	public function getPersistingTimes() {
		return count($this->objects);
	}
	
	public function getLastPersistedObject() {
		return end($this->objects);
	}
	
	public function getPersistedObjects() {
		return $this->objects;
	}
}