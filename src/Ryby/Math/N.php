<?php

namespace Ryby\Math;

use Ryby\Math\Exceptions\DivisionByZeroException;
use Ryby\Math\Exceptions\Exception;

class N
{

	static $scale = NULL;

	const ADD = 'bcadd';
	const SUB = 'bcsub';
	const MUL = 'bcmul';
	const DIV = 'bcdiv';
	const COMP = 'bccomp';
	const POW = 'bcpow';

	public static function setScale($scale)
	{
		self::$scale = $scale;
		return bcscale($scale);
	}

	/**
	 * http://php.net/manual/en/function.bcscale.php#79628
	 * @param type $a
	 * @param type $scale
	 * @return type
	 */
	public static function round($number, $scale = 0)
	{
		$fix = "5";
		for ($i = 0; $i < $scale; $i++) {
			$fix = "0$fix";
		}
		$number = bcadd($number, "0.$fix", $scale + 1);
		return bcdiv($number, "1.0", $scale);
	}

	public static function pow($a, $b, $scale = NULL)
	{
		return self::execute(self::POW, $a, $b, $scale);
	}

	public static function add($a, $b, $scale = NULL)
	{
		return self::execute(self::ADD, $a, $b, $scale);
	}

	public static function sub($a, $b, $scale = NULL)
	{
		return self::execute(self::SUB, $a, $b, $scale);
	}

	public static function mul($a, $b, $scale = NULL)
	{
		return self::execute(self::MUL, $a, $b, $scale);
	}

	public static function div($a, $b, $scale = NULL)
	{
		if (self::comp($b, 0) === 0) {
			throw new DivisionByZeroException;
		}
		return self::execute(self::DIV, $a, $b, $scale);
	}

	public static function comp($a, $b, $scale = NULL)
	{
		return self::execute(self::COMP, $a, $b, $scale);
	}

	private static function checkRequirements()
	{
		if (!self::$scale) {
			throw new Exception('Scale must be set!');
		}
	}

	private static function execute($func, $a, $b, $scale)
	{
		self::checkRequirements();
		return $scale ? $func($a, $b, $scale) : $func($a, $b);
	}

}
