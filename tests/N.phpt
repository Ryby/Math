<?php

require __DIR__ . '/bootstrap.php';

use Tester\Assert;
use Ryby\Math\Exceptions\DivisionByZeroException;
use Ryby\Math\Exceptions\Exception;
use Ryby\Math\N;

Assert::exception(function() {
	Assert::same('21.00', N::add(10.123, 10.879));
}, Exception::class);


N::setScale(2);

Assert::same('21.00', N::add(10.123, 10.879));
Assert::same('-0.75', N::sub(10.123, 10.879));
Assert::same('110.12', N::mul(10.123, 10.879));
Assert::same('0.93', N::div(10.123, 10.879));
Assert::same(0, N::comp('1.00001', '1'));
Assert::same(1, N::comp('1.00001', '1', 5));
Assert::same('74.08', N::pow('4.2', '3'));
Assert::same('25', N::pow('5', '2'));
Assert::same('25.13', N::round('25.1313', '2'));
Assert::same('25.16', N::round('25.1563', '2'));
Assert::same('6.00', N::addMultiple(['1', '2', '3.001']));
Assert::same('6.0010', N::addMultiple(['1', '2', '3.001'], 4));
Assert::same('5.01', N::min(['5.01', '6']));
Assert::same('5.0', N::min(['5.0001', '5.0002'], 1));


Assert::exception(function() {
	N::div(1, 0);
}, DivisionByZeroException::class);
