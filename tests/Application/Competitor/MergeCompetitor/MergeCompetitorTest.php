<?php

/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 18:23
 */

namespace Tests\Application\Competitor\MergeCompetitor;

use Application\Competitor\Actions\MergeCompetitor\AddCompetitorRequest;
use Application\Competitor\Actions\MergeCompetitor\MergeCompetitorAction;
use Application\Competitor\Gateway\CompetitorCriteria;
use Application\Competitor\Model\Competitor;
use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Utils\Actions\ActionRegistryBuilder;
use Utils\Actions\ActionType;
use Utils\Actions\Responder;
use Utils\Actions\Response\ModelResponse;
use Utils\Exceptions\InvalidRequest;
use Utils\Exceptions\UnexpectedType;
use Utils\Fixtures\Gateway\UpdaterGatewaySpy;
use Utils\Fixtures\ModelDummy;
use Utils\Fixtures\RequestDummy;
use Utils\Gateway\UpdaterGateway;

class MergeCompetitorTest extends TestCase {
	
	/**
	 * @var UpdaterGatewaySpy
	 */
	private $competitorGateway;
	
	protected function setUp() {
		parent::setUp();
		
		$this->setExistingCompetitor(new Competitor());
	}
	
	private function setExistingCompetitor($model) {
		$this->competitorGateway = new UpdaterGatewaySpy($model);
	}
	
	/**
	 * @test
	 */
	public function givenUnknownRequest_whenRun_thenThrowsUnexpectedType() {
		$this->assertRunThrows(new RequestDummy(), UnexpectedType::class);
	}
	
	/**
	 * @test
	 */
	public function givenMissingName_whenRun_thenThrowsInvalidRequest() {
		$this->assertRunThrows(new AddCompetitorRequest(), InvalidRequest::class);
	}
	
	/**
	 * @test
	 */
	public function givenUnknownCompetitor_whenRun_thenThrowsUnexpectedType() {
		$this->setExistingCompetitor(new ModelDummy());
		
		$this->assertRunThrows($this->request(), UnexpectedType::class);
		
		$this->assertCompetitorFindedBy("name");
		
	}
	
	/**
	 * @test
	 */
	public function givenNullFindedCompetitor_whenRun_thenCreateAndPersist() {
		$this->setExistingCompetitor(null);
		
		$response = $this->runAction($this->request());
		
		$this->assertInstanceOf(ModelResponse::class, $response);
		$this->assertInstanceOf(Competitor::class, $competitor = $response->getModel());
		$this->assertSame("name", $competitor->getName());
		$this->assertCompetitorFindedBy("name");
		$this->assertSame(1, $this->competitorGateway->getPersistingTimes());
		$this->assertSame($competitor, $this->competitorGateway->getLastPersistedObject());
		
	}
	
	/**
	 * @test
	 */
	public function givenExistCompetitor_whenRun_thenUpdatedData() {
		$competitor = new Competitor();
		$competitor->setName("other name");
		$this->setExistingCompetitor($competitor);
		
		$response = $this->runAction($this->request());
		
		$this->assertInstanceOf(ModelResponse::class, $response);
		$this->assertInstanceOf(Competitor::class, $competitor = $response->getModel());
		$this->assertSame("name", $competitor->getName());
		$this->assertCompetitorFindedBy("name");
		$this->assertSame(1, $this->competitorGateway->getPersistingTimes());
		$this->assertSame($competitor, $this->competitorGateway->getLastPersistedObject());
		
	}
	
	private function runAction($request) {
		$action = new MergeCompetitorAction(new Responder());
		$action->setCompetitorGateway($this->competitorGateway);
		
		$action->run($request);
		
		return $action->getResponder()->getResponse();
	}
	
	private function request() {
		$request = new AddCompetitorRequest();
		$request->name = "name";
		
		return $request;
	}
	
	private function assertCompetitorFindedBy($name) {
		$this->assertSame(1, $this->competitorGateway->getFindingTimes());
		$this->assertInstanceOf(CompetitorCriteria::class, $criteria = $this->competitorGateway->getLastFindedId());
		$this->assertSame($name, $criteria->getName());
	}
	
	private function assertRunThrows($request, $expectedException) {
		try {
			$this->runAction($request);
		}catch (Exception $exc) {
			$this->assertInstanceOf($expectedException, $exc, $exc->getMessage());
			
			return $exc;
		}
		
		$this->fail("$expectedException should be thrown.");
	}
	
}

class MergeCompetitorActionType implements ActionType {
	
	public function buildRegistry(ActionRegistryBuilder $builder, array $options) {
	
	}
	
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefined([
			"competitor_gateway",
		]);
		
		$resolver->setAllowedTypes("competitor_gateway", UpdaterGateway::class);
	}
}








