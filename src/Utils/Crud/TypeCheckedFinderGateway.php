<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.04.
 * Time: 20:34
 */

namespace Utils\Crud;

use Utils\Exceptions\UnexpectedType;
use Utils\Gateway\FinderGateway;

class TypeCheckedFinderGateway implements FinderGateway {
	
	/**
	 * @var FinderGateway
	 */
	private $finderGateway;
	
	/**
	 * @var string
	 */
	private $className;
	
	public function __construct($finderGateway, $className) {
		
		$this->finderGateway = $finderGateway;
		$this->className = $className;
	}
	
	public function find($id) {
		$object = $this->finderGateway->find($id);
		
		if (null !== $object && !$object instanceof $this->className) {
			throw new UnexpectedType();
		}
		
		return $object;
	}
}