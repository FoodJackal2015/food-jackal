<?php
/*
 * @category  Random String Generator
 * @package   classes/security
 * @author    Graham Murray <x13504987@student.ncirl.ie>
 * @copyright Copyright (c) 2015
*/
class RandomGenerator{
	
	/* Random String Generator */
	public function generateRandomString($length)
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    
	    //Make random string for the lenth of the parameter for length
	    for ($i = 0; $i < $length; $i++) 
	    {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    
    	return $randomString;
    }
    
}
	
?>
