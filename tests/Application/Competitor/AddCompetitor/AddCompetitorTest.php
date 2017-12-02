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

namespace Tests\Application\Competitor\AddCompetitor;

use Exception;
use PHPUnit\Framework\TestCase;
use Utils\Actions\Action;
use Utils\Actions\Request;
use Utils\Actions\Responder;
use Utils\Exceptions\UnexpectedType;
use Utils\Fixtures\RequestDummy;

class AddCompetitorTest extends TestCase {
	
	/**
	 * @test
	 */
	public function givenUnknownRequest_whenRun_thenThrowsUnexpectedType() {
		$this->assertRunThrows(new RequestDummy(), UnexpectedType::class);
	}
	
	private function assertRunThrows($request, $expectedException) {
		try {
			$this->runAction($request);
		} catch (Exception $exc) {
			$this->assertInstanceOf($expectedException, $exc, $exc->getMessage());
			
			return $exc;
		}
		
		$this->fail("$expectedException should be thrown.");
	}
	
	private function runAction($request) {
		$action = new AddCompetitor(new Responder());
		
		$action->run($request);
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
		if ( !$request instanceof AddCompetitorRequest ) {
			throw new UnexpectedType();
		}
	}
}

class AddCompetitorRequest implements Request {

}