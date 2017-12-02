<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 17:41
 */

namespace Utils\Actions;

use InvalidArgumentException;

class ActionRegistryBuilder {
	
	private $name;
	
	/**
	 * @var ActionRegistryBuilder[]
	 */
	private $children = [];
	
	/**
	 * @var ActionRegistryBuilderFactory
	 */
	private $factory;
	
	public function __construct($name, ActionRegistryBuilderFactory $factory) {
		
		$this->name = $name;
		$this->factory = $factory;
	}
	
	public function add($child, $type = null, array $options = []) {
		if ( !$child instanceof ActionRegistryBuilder ) {
			$child = $this->create($child, $type, $options);
		}
		
		$this->children[ $child->getName() ] = $child;
		
		return $this;
	}
	
	public function create($name, $type = null, array $options = []) {
		return $this->factory->create($name, $type, $options);
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function buildActions() {
		$factories = [];
		
		foreach ( $this->children as $child ) {
			foreach ( $child->buildActions() as $name => $factory ) {
				$fqn = $this->name . "." . $name;
				$factories[ $fqn ] = $factory;
			}
		}
		
		return $factories;
	}
	
	public function get($name) {
		if ( !$this->has($name) ) {
			throw new InvalidArgumentException();
		}
		
		return $this->children[ $name ];
	}
	
	public function has($name) {
		return isset($this->children[ $name ]);
	}
	
	public function remove($name) {
		unset($this->children[ $name ]);
	}
	
	public function getChildren() {
		return $this->children;
	}
}