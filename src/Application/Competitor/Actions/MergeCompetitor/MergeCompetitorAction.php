<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.04.
 * Time: 21:09
 */

namespace Application\Competitor\Actions\MergeCompetitor;

use Application\Competitor\Gateway\CompetitorCriteria;
use Application\Competitor\Model\Competitor;
use Utils\Actions\AbstractAction;
use Utils\Actions\Request;
use Utils\Actions\Response\ModelResponse;
use Utils\Crud\CompositeUpdaterGateway;
use Utils\Crud\TypeCheckedFinderGateway;
use Utils\Exceptions\InvalidRequest;
use Utils\Exceptions\UnexpectedType;
use Utils\Gateway\UpdaterGateway;

class MergeCompetitorAction extends AbstractAction {
	
	/**
	 * @var UpdaterGateway
	 */
	private $competitorGateway;
	
	public function run(Request $request) {
		$request = $this->validateRequest($request);
		
		$competitor = $this->competitorGateway->find($this->createCompetitorCriteria($request));
		
		if (null === $competitor) {
			$competitor = new Competitor();
		}
		
		$competitor->setName($request->name);
		
		$this->competitorGateway->persist($competitor);
		$this->responder->setResponse(new ModelResponse($competitor));
	}
	
	/**
	 * @return AddCompetitorRequest
	 */
	private function validateRequest($request) {
		if (!$request instanceof AddCompetitorRequest) {
			throw new UnexpectedType();
		}
		
		if (!$request->isValid()) {
			throw new InvalidRequest();
		}
		
		return $request;
	}
	
	private function createCompetitorCriteria(AddCompetitorRequest $request) {
		$criteria = new CompetitorCriteria();
		$criteria->setName($request->name);
		
		return $criteria;
	}
	
	function setCompetitorGateway(UpdaterGateway $competitorGateway) {
		$gateway = new TypeCheckedFinderGateway($competitorGateway, Competitor::class);
		
		$this->competitorGateway = new CompositeUpdaterGateway($gateway, $competitorGateway);
	}
	
}