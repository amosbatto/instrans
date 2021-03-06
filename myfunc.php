<?php
/************************************************************************
File:    myfunc.php
License: Latest version of GNU Lesser General Protection License (LGPL) 
		 which can be found at http://www.gnu.org 
Author:  Amos B. Batto (amosbatto@yahoo.com)
Created: 22 Jun 2006; Last Revised: 30 Jun 2006
 
This is my implementation of standard PHP functions which don't work the
way that I think that they should.  There is a lot that I don't like about
PHP and I imagine that this file will grow in time.
*************************************************************************/

/* my_strpos() is my version of the standard strpos() function. It
is capable of taking arrays as its haystack and offset arguments.
If needle is an array, it searches for the first element of that array.
If haystack is an array, it searches within each array element. If the 
needle isn't found, returns FALSE, otherwise it returns a two element
array.  The first element is the position in the array where found and 
the second is the position within the string.  For example:
	$a = array("this is OK", "but *big* is better");
	$a = my_strpos("*big*", $a);  
	//now $a[0]=1, $a[1]=4 (found in array element 1 at string position 4)
If you want to start searching at different position in the array, set
strOffset and arrayOffset.*/
function myStrPos($haystack, $needle, $strOffset = 0, $arrayOffset = 0)
{
	if (!is_string($needle))
	{
		if (is_array($needle))
			$needle = $needle[0];
		
		if (is_int($needle) || is_float($needle))
			$needle = (string) $needle;
		
		if (!$is_string($needle))
			return false;
	}
	
	$aRet[0] = 0;
	
	if (!is_array($haystack))
	{
		if (is_string($haystack) && $arrayOffset == 0)
		{
			$aRet[1] = strpos($haystack, $needle, $strOffset);
			return ($aRet[1] === false ? false : $aRet);
		}
		else 
			return false;
	}
	
	for ($cnt = $arrayOffset; $cnt < count($haystack); $cnt++)
	{	
		$aRet[1] = strpos($haystack[$cnt], $needle, ($arrayOffset == $cnt) ? $strOffset : 0 );
		if (!($aRet[1] === false)) //if found
		{
			$aRet[0] = $cnt; 
			return $aRet;
		}
	}
	return false;
}

//The following function doesn't work, because when called like this:
//my_implode(a_PoObj->aMsgid);
//It copies the aMsgid array to $a as an empty string. Really annoying!
//I don't understand why it does this

//argument that isn't an array. If passed any other variable type, it
//returns that type.  This is useful in the ObjPo::match() function, 
//which does type-sensitive comparisons, so you don't want to loose
//the variable type when comparing strings to Nulls.
function myImplode($a)
{
	if (is_array($a))
		return implode('', $a);
	else
		return $a;
}

//because realpath() doesn't work on directory names, created this function which
//can handle both file and directory names
function myRealPath($sFileOrDir)
{
	if (!file_exists($sFileOrDir))
		return false;
	elseif (is_file($sFileOrDir))
		return realpath($sFileOrDir);
	else //only directories left now
	{ 
		$sCWD = getcwd();
		chdir($sFileOrDir);
		$sPath = getcwd();
		chdir($sCWD); 
		return $sPath;
	}
}
?>
