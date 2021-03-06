<?php
//mygettext.php is my implementation of gettext, because I couldn't get php-gettext to work and 
//GNU gettext isn't automatically included in the PHP build. Because iconv_get_encoding() 
//doesn't query the OS to find out what kind of output encoding is needed, I had to 
//include some ugly code to find it.
define('DEF_SOURCE_LANG', 'es');
define('DEF_INTERFACE_LANG', 'en');
define('DEF_CHARSET', 'ISO-8859-1');

$bDOS = false;				//if true, OS contains MS-DOS, otherwise assume some form of UNIX
$sCharSet = DEF_CHARSET;	//set the default character set for output. 
$sInterfaceLang = DEF_INTERFACE_LANG;	//set the default interface language	
$aGetText = NULL;			//array which will hold the gettext translations				

//Because PHP doesn't bother looking up the interface language of the computer, 
//I have created this ugly work-around to get it.
if (isset($_ENV['OS']) && !strncasecmp($_ENV['OS'], 'WINDOWS_', 8)) //if MS-Windows
{
	$bDOS = True;
	$sCharSet = 'CP850';
	
	if (isset($GLOBALS['ProgramFiles']))
	{
		if (strpos($GLOBALS['ProgramFiles'], 'Program Files') !== false)
			$sInterfaceLang = "en";
		elseif (strpos($GLOBALS['ProgramFiles'], 'Archivos de Programa') !== false)
			$sInterfaceLang = "es";
		elseif (strpos($GLOBALS['ProgramFiles'], 'Arquivos de Programa') !== false)
			$sInterfaceLang = "pt";
	}
}
elseif (isset($_ENV['LANG'])) 	//if a Linux/UNIX/OS X system
{ 
	//get user interface language
	$sLang = strtolower(substr($_ENV['LANG'], 0, 2));
	
	if ($sLang == DEF_SOURCE_LANG || file_exists(pathinfo(realpath($argv[0]),
			PATHINFO_DIRNAME) . '/locale/' . $sLang))
	{
		$sInterfaceLang = $sLang;
	}
	
	//get user interface character set
	//LANG usually has the form: "en_US.UTF-8", so get whatever follows the period
	$iChSet = strpos($_ENV['LANG'], '.');
	
	if($iChSet !== false && ++$iChSet < strlen($_ENV['LANG']))
	{
		$sCharSet = substr($_ENV['LANG'], $iChSet);
	
		//if unrecognized character set, then set back to default character set
		if (strpos($sCharSet, 'UTF') !== 0 && strpos($sCharSet, 'ISO') !== 0 && 
			strpos($sCharSet, 'CP') !== 0 && strpos($sCharSet,  'UCS') !== 0 && 
			stripos($sCharSet, 'MAC') !== 0)
		{
			$sCharSet = DEF_CHARSET;
		}
	}
}

//equivalent to the gettext() or _() functions
function __($str)
{
	global $aGetText, $sInterfaceLang;
	$sRet = $sInterfaceLang == DEF_SOURCE_LANG ? $str : $aGetText[$str];
	
	if ($sRet == '')	//will match if passed an empty string or a NULL or O
		return $str;
	else
		return $sRet; 
}
?>
