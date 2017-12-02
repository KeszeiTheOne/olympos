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

use Exception;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Utils\Actions\Action;
use Utils\Actions\Request;
use Utils\Actions\Responder;
use Utils\Exceptions\UnexpectedType;
use Utils\Fixtures\Gateway\UpdaterGatewaySpy;
use Utils\Fixtures\RequestDummy;
use Utils\Gateway\UpdaterGateway;

class MergeCompetitorTest extends TestCase {
	
	/**
	 * @var UpdaterGateway
	 */
	private $competitorGateway;
	
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
	
	}
	
	protected function setUp() {
		parent::setUp();
		
		$this->setExistingCompetitor("asd");
	}
	
	private function setExistingCompetitor($model) {
		$this->competitorGateway = new UpdaterGatewaySpy($model);
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
	
	private function runAction($request) {
		$action = new AddCompetitor(new Responder());
		
		$action->run($request);
	}
	
	private function request() {
		$request = new AddCompetitorRequest();
		$request->name = "name";
		
		return $request;
	}
	
}

abstract class AbstractAction implements Action {
	
	/**
	 * @var Responder
	 */
	private $responder;
	
	public function __construct(Responder $responder) {
		
		$this->responder = $responder;
	}
	
	public function getResponder() {
		return $this->responder;
	}
	
}

class AddCompetitor extends AbstractAction {
	
	public function run(Request $request) {
		if (!$request instanceof AddCompetitorRequest) {
			throw new UnexpectedType();
		}
		
		if (!$request->isValid()) {
			throw new InvalidRequest();
		}
	}
}

class AddCompetitorRequest implements Request {
	
	public $name;
	
	public function isValid() {
		return null !== $this->name;
	}
}

class InvalidRequest extends RuntimeException {

}