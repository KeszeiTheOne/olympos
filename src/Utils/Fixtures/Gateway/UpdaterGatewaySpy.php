<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 23:27
 */

namespace Utils\Fixtures\Gateway;

use Utils\Gateway\UpdaterGateway;

class UpdaterGatewaySpy implements UpdaterGateway {
	
	use FinderGatewaySpyTrait, PersisterGatewaySpyTrait;
}