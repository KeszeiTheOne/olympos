<?php
/**
 * Copyright (c) 2017. Olympos
 */

/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.02.
 * Time: 23:18
 */

namespace Utils\Fixtures\Gateway;

use Utils\Gateway\FinderGateway;

class FinderGatewaySpy implements FinderGateway {
	
	use FinderGatewaySpyTrait;
}