<?php

define('SYNTAX_ERR_NO_STR', -1);
define('SYNTAX_ERR_MSGID_NO_DEF', -2);
define('SYNTAX_ERR_NO_QUOTES', -3);
define('SYNTAX_ERR_UNKNOWN', -4);
define('SYNTAX_WHITESPACE', 0);
define('SYNTAX_COMMENT', 1);
define('SYNTAX_DOMAIN', 2);
define('SYNTAX_MSGID', 3);
define('SYNTAX_MSGID_CONT',4);
define('SYNTAX_MSGIDPL',5);
define('SYNTAX_MSGIDPL_CONT',6);
define('SYNTAX_MSGSTR',7);
define('SYNTAX_MSGSTR_CONT',8);
define('SYNTAX_MSGSTRN',9);
define('SYNTAX_MSGSTRN_CONT',10);

$startTime = microtime(true);

ini_set("auto_detect_line_endings", "On");
//set no max time for this program to run.
ini_set("max_execution_time", 0);

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
$bMsgstrIns = false;	//if true, then insert transalations from rTransPoFile in the msgstr
$bCommentIns = false;	//if true, then insert translations from rTransPoFile as comments
$bOverwrite = false;	//If true, then overwrite existing msgstr (or comments)
$bVerbose = false;		//If true, then display warnings and summary info at the end
$bQuiet = false;		//If true, then don't display any screen messages
$bRecursive = false;	//If true, then process the subdirectories as well.
$bSearch = false;		//If true, then search for  
$bNoStripVar = false;	//If true, then don't strip C/C++ variables and & (keyboard accelerators) 
						//from the translated frase when using the options --statusbar and 
						//--bilingual. Having these can cause errors in the program. 
						
//$bShowPath = false;	//Not implemented//If true, then show complete path of filenames in messages 						

//If bBilingualIns=true, then transation from rTransPoFile will be appended to msgstr so 
//both languages appear together: 
//	msgstr "ORIGINAL-STRING sBilingualSeparator APPENDED-STRING"
//	Example: msgstr "open * abrir" 
$bBilingualIns = false; 	
$sBilingualSeparator = ' * ';

$bStatusBarIns	= false;	//if true, then insert menu items in the status bar  
$sMenuSrch	= null;		//The strings to search for in the automatic comments in order 
$sStatusBarSrch = null;	//to find the menu and status bar PO objects 
$sLangComment = null;	//Language indentifier to be inserted with comments
$bDebug = false;		//pass the argument -d or --debug get debugging information
$bOrigDir = false; 		//if true, then processing a whole directory of Original PO files
$bTransDir = false; 	//if true, then processing a whole directory of Translations PO files


//Set global counter variables to 0
$totAmpersandStrips = 0; 
$totVarStrips = 0;
$totOrigPoFileLines = 0;
$totTransPoFileLines = 0;
$totNewPoFileLines = 0;
$totOrigPoObjs = 0;
$totTransPoObjs = 0;
$totNewPoObjs = 0;
$totOrigPoSyntaxErr = 0;
$totTransPoSyntaxErr = 0; 
$totNewPoSyntaxErr = 0;
$totFraseInserts = 0;//not implemented yet

$cntAmpersandStrips = 0; //make global because used outside processPoFile()
$cntVarStrips = 0;		//ditto

$cntTransPoFileLines = 0;	//make the transPoFile counters global because used by
$cntTransPoObjs = 0;		//both processTransPoFile() and processOrigPoFile() functions
$cntTransPoSyntaxErr = 0;

$sErr = ''; //global error message 
$aTransPo;	//array of PO objects pulled from the TRANSLATION-PO file by processPoFile()
$sOrigWDir = getcwd(); //store the original working directory, so can return to it later

//open files with the interface translations so instrans is multi-lingual
$sProgramPath = pathinfo(realpath($argv[0]), PATHINFO_DIRNAME);
