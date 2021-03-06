<?php
/************************************************************************
File: instrans-header.php
License: Latest version of GNU Lesser General Protection License (LGPL) 
		which can be found at http://www.gnu.org 
Author: Amos B. Batto (amosbatto@yahoo.com)
Created: 22 Jun 2006
Last Revised: 05 Feb 2021 
 
This is the header file for instrans.php.  It contains:
1. the PHP initialization settings
2. the global variables for instrans.php
3. any definitions (define()) for instrans.php
*************************************************************************/

ini_set('auto_detect_line_endings', 'On');
//set no max time for this program to run.
ini_set('max_execution_time', 0);
//set unlimited amount of memory
ini_set('memory_limit', -1);

//define return codes used by PoObj::addLine()
define('SYNTAX_ERR_UNKNOWN',     -5);
define('SYNTAX_ERR_NO_QUOTES',   -4);
define('SYNTAX_ERR_MSGID_NO_DEF',-3);
define('SYNTAX_ERR_ELEM_ORDER',  -2);
define('SYNTAX_ERR_NO_STR',      -1);
define('SYNTAX_WHITESPACE',   0);
define('SYNTAX_COMMENT',      1);
define('SYNTAX_DOMAIN',       2);
define('SYNTAX_MSGCTXT',      3);
define('SYNTAX_MSGCTXT_CONT', 4);
define('SYNTAX_MSGID',        5);
define('SYNTAX_MSGID_CONT',   6);
define('SYNTAX_MSGIDPL',      7);
define('SYNTAX_MSGIDPL_CONT', 8);
define('SYNTAX_MSGSTR',       9);
define('SYNTAX_MSGSTR_CONT', 10);
define('SYNTAX_MSGSTRN',     11);
define('SYNTAX_MSGSTRN_CONT',12);

define('INDEX_TRANS_PO_LEN', 10);	//length in characters of the phrases in the index $aIndexTransPo

define('DEF_VAR_REPLACE', '@#@$1@#@');

$iLastElement = 0; //holds the last PO element read by function PoObj::addLine()


//Define Global Variables:
$sOrigPo = null;		//name de the original PO file o directory
//$rOrigPoDir = null;		//resource handle for sOrigPo if a directory
$sTransPo =	null;		//name of PO file or directory containing translations to be inserted in sOrigPo 
$rTransPoDir = null;	//resource handle for sTransPo if a directory
$sNewPo = null;			//new PO file or directory that will be written
$sNewPoDir = null;		//resource handle for rNewPoFile if a directory
$sTempDir = null;		//name of the temporary directory to be renamed to sNewPo when done processing
$rTempDir = null;		//resource handle for sTempDir
$sTempFile = null;		//name of temporary file being written, so won't overwrite sOrigPoFile until done processing it.
$rTempFile = null;		//resource handle for sTempFile
//Need a temporary directory because sNewPo can be the same as sOrigPo, so don't want
//to overwrite sOrigPo at the same time as you are reading from it.

$bLog = false;			//If true, then redirect screen messages to a log file
$rLogFile =	null;		//resource handle for log file
$sLogFile =	"instrans-log.txt";	//filename for rLogFile

//Set default values which can be changed by arguments passed by the user:
$bMsgstrIns = false;	//if true, insert transalations from rTransPoFile in the msgstr
$bCommentIns = false;	//if true, insert translations from rTransPoFile as comments
$bOverwrite = false;	//If true, overwrite existing msgstr (or comments)
$bVerbose = false;		//If true, display warnings and summary info at the end
$bQuiet = false;		//If true, don't display any screen messages
$bRecursive = false;	//If true, process the subdirectories as well.
$bSearch = false;		//If true, then look through files or directories for matching msgid's  
$bStrip = false;		//If true, strip $bStripStr from the inserted translated phrase
$sStripStr = null;		//String to strip.  Can be a Perl search expression.
						//If $sStripStr is NULL, but bStrip is true, then strip Ampersands (&)
$bReplace = false;		//If true, replace $sReplaceFind in the inserted translated phrase
						//in --statusbar and --bilingual insertions.
$sReplaceFind = null;	//String which can be a Perl Expression which is searched for
$sReplaceWithWhat = null;	//String which can be a Perl expression which replaces $sReplaceFind  
						//If bReplace is true, but $sReplaceFind is null, then replace programming
						//variables which can cause errors in the inserted translated phrases. 
						
//$bShowPath = false;	//Not implemented//If true, show complete path of filenames in messages 						

//If bBilingualIns=true, then transation from rTransPoFile will be appended to msgstr so 
//both languages appear together: 
//	msgstr "ORIGINAL-STRING sBilingualSeparator APPENDED-STRING"
//	Example: msgstr "open * abrir" 
$bBilingualIns = false; 	
$sBilingualSeparator = ' * ';

$bStatusBarIns = false;	//if true, insert menu items in the status bar  
$sMenuSrch = null;		//The strings to search for in the automatic comments in order 
$sStatusBarSrch = null;	//to find the menu and status bar PO objects 
$sLangComment = null;	//Language indentifier to be inserted with comments
$bDebug = false;		//pass the argument -d or --debug get debugging information
$bOrigDir = false; 		//if true, processing a whole directory of Original PO files
$bTransDir = false; 	//if true, processing a whole directory of Translations PO files


//Set global counter variables to 0
$totStrips = 0; 
$totReplaces = 0;
$totOrigPoFileLines = 0;
$totTransPoFileLines = 0;
$totNewPoFileLines = 0;
$totOrigPoObjs = 0;
$totTransPoObjs = 0;
$totNewPoObjs = 0;
$totOrigPoSyntaxErr = 0;
$totTransPoSyntaxErr = 0; 
$totNewPoSyntaxErr = 0;
//$totFraseInserts = 0;	//not implemented yet

$cntStrips = 0; 		//make global because used outside processPoFile()
$cntReplaces = 0;		//ditto

$cntTransPoFileLines = 0;	//make the transPoFile counters global because used by
$cntTransPoObjs = 0;		//both processTransPoFile() and processOrigPoFile() functions
$cntTransPoSyntaxErr = 0;

$sErr = null; 		//global error message 
$aTransPo = null;	//array of PO objects pulled from TRANSLATION-PO by processTransPoFile()
//index the first 10 letters of the msgid and its position in the aTransPo array. 
$aIndexTransPo[] = array('' => 0);	



?>
