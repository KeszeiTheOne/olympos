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

interface ActionType {
	
	public function buildRegistry($builder, array $options);
	
	public function configureOptions($resolver);
}