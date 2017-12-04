<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 17:39
 */

namespace Utils\Actions;

use Symfony\Component\OptionsResolver\OptionsResolver;

interface ActionType {
	
	public function buildRegistry(ActionRegistryBuilder $builder, array $options);
	
	public function configureOptions(OptionsResolver $resolver);
}