<?php
/* Regression test for: a class-typed constructor parameter that Dice can't
 * autowire (e.g. a PHP 8.1+ enum) should fall back to its default value
 * instead of letting PHP's "Cannot instantiate enum" \Error escape as a
 * fatal error. This is not specific to this fork - it reproduces on
 * upstream Level-2/Dice too, since enums postdate that code. */
class EnumDefaultTest extends DiceTest {

	public function testEnumParamWithDefaultResolvesToDefault() {
		$obj = $this->dice->create('EnumDefaultWithDefault');
		$this->assertSame(EnumDefaultStatus::Active, $obj->status);
	}

	public function testEnumParamWithoutDefaultThrowsTypeErrorNotFatal() {
		// No default and nothing supplied: Dice falls back to null, and PHP's
		// own (catchable) TypeError enforces the non-nullable enum type -
		// this must not surface as the internal "Cannot instantiate enum"
		// \Error from inside Dice's own autowiring.
		$this->expectException(\TypeError::class);
		$this->dice->create('EnumDefaultWithoutDefault');
	}
}
