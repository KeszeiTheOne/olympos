<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 17:46
 */

namespace Utils\Actions;

interface ActionRegistryBuilderFactory {
	
	public function create($name, ActionType $type = null, array $options = null);
}