<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.04.
 * Time: 20:21
 */

namespace Tests\Utils\Crud;

use PHPUnit\Framework\TestCase;
use Utils\Crud\TypeCheckedFinderGateway;
use Utils\Exceptions\UnexpectedType;
use Utils\Fixtures\Gateway\FinderGatewaySpy;
use Utils\Fixtures\ModelDummy;

class TypeCheckedFinderGatewayTest extends TestCase {
	
	/**
	 * @var FinderGatewaySpy
	 */
	private $finderGateway;
	
	private $className;
	
	protected function setUp() {
		parent::setUp(); // TODO: Change the autogenerated stub
		
		$this->setFindedObject(new ModelDummy());
		$this->className = ModelDummy::class;
	}
	
	private function setFindedObject($object) {
		$this->finderGateway = new FinderGatewaySpy($object);
	}
	
	/**
	 * @test
	 */
	public function givenNotSameObject_whenFind_thenThrowsUnexpectedType() {
		$this->expectException(UnexpectedType::class);
		$this->setFindedObject("notSame");
		$this->className = ModelDummy::class;
		
		$this->find("id");
		
		$this->assertSame(1, $this->finderGateway->getFindingTimes());
		$this->assertSame("id", $this->finderGateway->getLastFindedId());
	}
	
	/**
	 * @test
	 */
	public function givenNullFound_whenFind_thenReturnNull() {
		$this->setFindedObject(null);
		
		$object = $this->find("id");
		
		$this->assertNull($object);
		$this->assertSame(1, $this->finderGateway->getFindingTimes());
		$this->assertSame("id", $this->finderGateway->getLastFindedId());
	}
	
	/**
	 * @test
	 */
	public function givenFoundedExpectedObject_whenFind_thenReturnObject() {
		$this->setFindedObject($object = new ModelDummy());
		
		$findedObject = $this->find("id");
		
		$this->assertSame($object, $findedObject);
		$this->assertSame(1, $this->finderGateway->getFindingTimes());
		$this->assertSame("id", $this->finderGateway->getLastFindedId());
	}
	
	private function find($id) {
		$finderGateway = new TypeCheckedFinderGateway($this->finderGateway, $this->className);
		
		return $finderGateway->find($id);
	}
}

