<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 18:10
 */

namespace Application;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Utils\Actions\ActionRegistryBuilder;
use Utils\Actions\ActionType;

class ApplicationActionType implements ActionType {
	
	public function buildRegistry(ActionRegistryBuilder $builder, array $options) {
		// TODO: Implement buildRegistry() method.
	}
	
	public function configureOptions(OptionsResolver $resolver) {
		// TODO: Implement configureOptions() method.
	}
}