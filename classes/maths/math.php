<?php
/*
 * @category  Calculations
 * @package   classes/security
 * @file      math.php
 * @data      01/12/15
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
 * @description This file deals with an functionlity for modifiying numbers not built in with standard php
*/

class Maths{

	/* Truncate a number without rounding to two decimals*/
	function truncate_number( $number, $precision = 2)
	{
	    // Decided if number is negative
	    $negative = $number / abs($number);
	    // Cast the number to a positive to solve rounding
	    $number = abs($number);
	    // Calculate precision number for dividing / multiplying
	    $precision = pow(10, $precision);
	    // re-applying the negative value to ensure returns correctly negative / positive
	    return floor( $number * $precision ) / $precision * $negative;
	}
}//Close class
?>
