<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 17:45
 */

namespace Utils\Actions;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionRegistryFactory implements ActionRegistryBuilderFactory {
	
	public function create($name, ActionType $type = null, array $options = null) {
		return new ActionRegistry($this->createBuilder($name, $type, $options));
	}
	
	private function createBuilder($name, ActionType $type = null, array $options = null) {
		$builder = new ActionRegistryBuilder($name, $this);
		
		if ( null !== $type ) {
			$resolver = new OptionsResolver();
			$type->configureOptions($resolver);
			$resolvedOptions = $resolver->resolve($options);
			$type->buildRegistry($builder, $resolvedOptions);
		}
		
		return $builder;
	}
	
}