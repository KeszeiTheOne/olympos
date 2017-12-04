<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.04.
 * Time: 20:40
 */

namespace Utils\Crud;

use Utils\Gateway\FinderGateway;
use Utils\Gateway\PersisterGateway;
use Utils\Gateway\UpdaterGateway;

class CompositeUpdaterGateway implements UpdaterGateway {
	
	/**
	 * @var FinderGateway
	 */
	private $finder;
	
	/**
	 * @var PersisterGateway
	 */
	private $persister;
	
	public function __construct(FinderGateway $finder, PersisterGateway $persister) {
		$this->finder = $finder;
		$this->persister = $persister;
	}
	
	public function find($id) {
		return $this->finder->find($id);
	}
	
	public function persist($object) {
		$this->persister->persist($object);
	}
	
}