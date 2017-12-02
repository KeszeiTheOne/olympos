<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 23:19
 */

namespace Utils\Fixtures\Gateway;

trait FinderGatewaySpyTrait {
	
	private $model;
	
	private $ids = [];
	
	public function __construct($model) {
		$this->model = $model;
	}
	
	public function find($id) {
		$this->ids[] = $id;
		
		return $this->model;
	}
	
	public function getFindingTimes() {
		return count($this->ids);
	}
	
	public function getLastFindedId() {
		return end($this->ids);
	}
	
	public function getFindedIds() {
		return $this->ids;
	}
	
}