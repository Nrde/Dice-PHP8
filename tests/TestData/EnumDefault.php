<?php
/* Fixtures for EnumDefaultTest: PHP 8.1+ enums used as constructor parameter
 * types. Dice tries to autowire any class-typed parameter it can't otherwise
 * fill; enums can't be instantiated with `new`, so this exercises the
 * fallback to the parameter's default value. */

enum EnumDefaultStatus {
	case Active;
	case Inactive;
}

class EnumDefaultWithDefault {
	public function __construct(public EnumDefaultStatus $status = EnumDefaultStatus::Active) {
	}
}

class EnumDefaultWithoutDefault {
	public function __construct(public EnumDefaultStatus $status) {
	}
}
