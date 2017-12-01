<?php
/**
 * Created by PhpStorm.
 * User: kebab
 * Date: 2017.12.01.
 * Time: 22:50
 */

namespace Tests\Utils\Actions\ActionRegistry;

use PHPUnit\Framework\TestCase;
use Utils\Actions\Exception\ActionNotFound;

interface ActionType {

	public function getAction($type);
}

class ActionRegistryTest extends TestCase {

	/**
	 * @test
	 */
	public function givenUnkownActionType_whenRun_ThrowActionNotFound() {
		$this->expectException(ActionNotFound::class);

		$this->getAction("not_founded_type");
	}

	public function getAction($type) {
		$action = new ActionRegistry();
		$action->getAction($type);
	}
}

class ActionRegistry implements ActionType {

	public function getAction($type) {
		throw new ActionNotFound();
	}
}

