<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 17:50
 */

namespace Utils\Actions;

class ActionRegistry {
	
	/**
	 * @var ActionFactory[]
	 */
	private $factories = [];
	
	public function __construct(ActionRegistryBuilder $builder) {
		foreach ( $builder->buildActions() as $name => $action ) {
			$this->add($name, $action);
		}
	}
	
	private function add($name, ActionFactory $factory) {
		$this->factories[ $name ] = $factory;
	}
	
	public function createAction($name, Responder $responder) {
		if ( !isset($this->factories[ $name ]) ) {
			throw new ActionNotFound();
		}
		
		return $this->factories[ $name ]->create($responder);
	}
	
	/**
	 * @return ActionFactory[]
	 */
	public function getFactories(): array {
		return $this->factories;
	}
	
}