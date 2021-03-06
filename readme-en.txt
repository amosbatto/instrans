instrans.php -- Software to Insert Translations
    Instalation
    Description
    Format
    Notes
        Using --replace with --bilingual insertions
        Using --strip with --bilingual insertions
        --statusbar Option
        Processing Directories
        --search Option:
        Syntax Errors
        Return Value
        Why so slow?
        Why using so much memory?
    Examples of usage
        Basic Example
        --comment Example
        --bilingual Example
        --statusbar Example
        --search Example
    License and Author
    Documentation in Other Languages
        

INSTALATION

In order to use instrans, first install PHP 5 with the command line interface.
(Intrans might work with PHP 4, but I haven´t tried it.)

MS-Windows:
If you use MS Windows, download php-5.X.X-Win32.zip from http://www.php.net
Unzip it and double click in php-5.X.X-installer.exe to install it. Afterwards
add the dirctory where you installed PHP to your PATH variable. In Windows XP,
go to: Start->Setup->Control Panels->System->Advanced->Environment Variables.  
In the System Variables box, select PATH and click on Edit and add the path
where you installed PHP to the end of the line. For instance, if PHP is
installed in the directory "c:\Program Files\PHP5", then your PATH variable
might look something like:
    c:\WINDOWS;c:\WINDOWS\System32;c:\Program Files\PHP5

On older systems, you might have to change the PATH variable in the DOS
command line like this:
    echo $PATH
                      [Verify that the $PATH exists.]
    $PATH = $PATH + ";C:\Program Files\PHP5"
    echo $PATH
                     [Verify that the $PATH was changed.]

On some systems, you need to use the variable "$Path" in place of "$PATH".

After instalaring PHP 5, download and unzip www.ciber-runa.net/instrans.zip 
Now the script instrans.php can be used.

GNU/Linux, UNIX, Cygwin, and Mac OS X:
Users of UNIX-like systems should install PHP 5 from the repository
of their distribution. For example, users of Debian and its derivatives can
install PHP 5 with apt-get:
    su            
                   [enter the password of root]
    apt-get install php5-cli
    exit

In Ubuntu use the sudo command:
    sudo apt-get install php5-cli

After instalaring PHP 5, download and unzip www.ciber-runa.net/instrans.zip 
Now the script instrans.php can be used.


DESCRIPTION:

The program instrans.php inserts translated phrases from PO file(s) into other
PO file(s).  Instrans is designed to help software translators of indigenous
and minority languages who have special needs.  It can also be used by
software translators doing trilingual translations or by translators who
want to automatically insert translations from another language.

Instrans permites the translator to deal with three or more languages as once
inside a PO file.  This can be useful when translating languages in places
where English isn't the dominant written language. For example, in Latin America
and in French Africa, many translators of indigenous languages can't read
the original English PO file and need to see the phrases in Spanish or French.  
Instrans can also be used to automatically insert translated phrases from
another language. For instance, many minority languages borrow heavily from
a dominant written language, so the translators can use instrans to
automatically insert the borrowed phrases into their PO file.

Each PO object has the following format:
    WHITESPACE
    # TRANSLATOR-COMMENTS
    #. AUTOMATIC-COMMENTS
    #: REFERENCE...
    #, FLAG...
    msgid UNTRANSLATED-PHRASE
    msgstr TRANSLATED-PHRASE

Instrans extracts each msgstr from TRANSLATIONS-PO and inserts it in the
ORIGINAL-PO (or optionally in the NEW-PO) where there is a matching msgid.
If there isn't a matching msgid, nothing is inserted.  If there is more than
one matching msgid, instrans searchs for one that has a matching automatic
comment or a matching reference.  By default, instrans only inserts a
translated phrase when the msgstr in the ORIGINAL PO is empty, but existing
msgstr's can be overwritten with the --overwrite option. In addition, there
are options to insert the translated phrases as a translator comment or to
make a bilingual msgstr or to insert translated phrases from the menus in the
status bar. There is also a --search option to look for matching phrases used
in other programs.


FORMAT:

   php instrans.php [OPTIONS] ORIGINAL-PO TRANSLATIONS-PO [NEW-PO]

OPTIONS:

-m | --msgstr     Insert the translated phrases en the msgstrs which are empty.
                  If no type of insertion is specified, by default instrans
                  will do this type of insertion.  If you want to replace
                  msgstr which aren't empty, also use the option --overwrite.
                  
-b | --bilingual [=SEPARATOR]   
                  Append translated phrases to the end of existing msgstr's in
                  order to form bilingual phrases.  If there is an existing
                  msgstr, the two phrases will be divided by a SEPARATOR which
                  is " * " by default.  Phrases which contain new line
                  character(s) (\n) will be separated by another new line
                  instead of the SEPARATOR.
                  
-c | --comment [=LANGUAGE]    
                  Insert translated phrases as translator comments in the form:
                  #  [LANGUAGE] "TRANSLATED-PHRASE"
                  If the LANGUAGE is no specified, by default it will be the
                  name of TRANSLATIONS-PO.  The --comment option can be
                  combined with all the other options.  If --comment is used
                  with --statusbar, comments will only be inserted in status
                  bar objects in the form:
                  #  [LANGUAGE] MENU: "TRANSLATED-PHRASE"
                  
-s | --statusbar [=MENU-STRING STATUS-BAR-STRING]
                  Insert translated phrases from the menu into the status bar.
                  If an automatic comment is found which contains the
                  MENU-STRING, instrans will look for a corresponding PO object
                  which contains the STATUS-BAR-STRING and insert the
                  translated phrase there. By default, the MENU-STRING is
                  is "MENU" and the STATUS-BAR-STRING is "STATUSBAR".  Use this
                  option with care. You will probably have to edit the PO file
                  by hand afterwards.
                                                     
-o | --overwrite  Replace existing translated phrases. Without this option, the
                  translated frase will only be inserted when the msgstre is
                  empty.  Si inserting comments, this option will not overwrite
                  existing translator comments, except those in the form:
                  #  [...] "..."
                  
-r | --recursive  Process all the subdirectories en ORIGINAL-PO and
                  TRANSLATIONS-PO. This option will only take effect if
                  ORIGINAL-PO and TRASLACIONES-PO are directories.
                  
-e | --search     Search for translated phrases in any file or directory in
                  TRANSLATIONS-PO. Use this option to find translated phrases
                  used in other programs.
                  
-x | --strip [=STRING]   
                  Strip STRING from the translated phrase in insertions
                  --bilingual and --statusbar. If STRING isn't specified,
                  ampersands (&) will be stripped. STRING can be a Perl
                  expression. For example: --strip = "/<.+>/" would remove
                  all HTML codes.
                  
-p | --replace [=FIND REPLACEMENT]    
                  Replace FIND with REMPLACEMENT in the translated phrase in
                  insertions --bilingual and --statusbar. If FIND and
                  REPLACEMENT are not specified, programming variables will be
                  replaced with "@#@x@#@". Currently only C, Objective C, PHP,
                  UNIX shell, QT, gcc internal, and YCP variables are
                  recognized. Perl expressions can be used for FIND and
                  REPLACEMENT. For example:  -p = "/%([sd])/" "VAR_$1"
                  replaces "%s" with "VAR_s" and "%d" with "VAR_d".
                    
-v | --verbose    Show warnings and more information.

-q | --quiet      Don't show any screen messages.

-l | --log [=ARCHIVO]   Reroute all screen messages to a file. If the filename
                  isn't specified, by default it will be "instrans-log.txt".
                  
-f | --interface = XX   Specify the user interface language for instrans.
                  Instrans will default to English if it hasn't been translated
                  to the language of your locale. Currently the only options
                  are "en", "es", or "pt".

ORIGINAL-PO       The original PO file or directory.  If it is a directory, all
                  the PO files inside the directory will be processed.

TRANSLACIONS-PO   The PO file or directory which contains the translated
                  phrases which will be inserted into the ORIGINAL-PO (or
                  optionally into the NEW-PO).
                  
NEW-PO            [optional] If you don't want to overwrite the ORIGINAL-PO,
                  provide a new name for the file or directory to write.

                  
Enclose filenames which contain spaces inside double quotes.
Examples:
    php instrans.php "c:\My documents\fr-FR.po" es-ES.po "fr-FR 1.po"
    php "c:\My documentos\instrans.php" -b=" % " es-ES.po fr-FR.po
 
For Help:
    php instrans.php -h | --help | -? | /?

For more information and examples of usage:
    php instrans.php -i | --info


NOTES:

Using --replace with --bilingual insertions:

Use the option --bilingual with care and be prepared to revise the PO file(s)
afterwards. The inserted translated phrases can contain programming variables.
For example, programs written in C use the symbol %s to indicate a string, %d
to indicate an integer, and %f to indicate a real number which can contain a
decimal point. Normally PO objects with C variables are marked with the flag:
    #, c-format
When bilingual phrases are formed, the number of variables en the msgstr will
be doubled and this can cause errors in the program.  In order to avoid this
problem, use the option --replace.  If you don't specify FIND and REPLACEMENT,
instrans will search for PO objects with the flag "#, LANGUAGE-format" and
enclose any variables in the inserted translated phrase in "@#@". For example,
"@#@s@#@" replaces "%s" and "@#@-10.4f@#@" replaces "%-10.4f" in PO objects
marked with the "#, c-format" flag.  

If your version of PHP is 5.10 or later, the --verbose option will provide a
warning message everytime a variable has been replaced. It is recommended that
you use the --verbose and --log options with --bilingual, so that you have a
record of the changes.

Afterwards, do a search for "@#@" in your PO file(s) and replace these phrases
with something more apropriate en your translations. Unfortunately there are
many computer languages and instrans currently only recognizes C, Objective C,
PHP, UNIX shell, QT, gcc internal, and YCP variables.  In any case, you
shouldn't trust that instrans will take care of all the problematic variables,
so the PO file(s) should be reviewed afterwards.


Using --strip with --bilingual insertions

Many programs use the ampersand ("&" or "&amp;") en their menús and dialog
boxes to underline the following character and make it a direct access key.  
Ampersands can cause problems in --bilingual insertions, because a menu item
and an object in a dialog box can only have one direct access key. To avoid
this problem, use the --strip option without specifying the STRING to remove
ampersands from the translated phrase that will be inserted.

If the existing msgstr is empty, the ampersand won't be stripped when it is
inserted. Ampersands are often used to signify "and", so they are only stripped
from the inserted translated phrase when followed by an alphanumeric character
or an underscore. They aren't stripped if followed by a symbol, a space, or if
they appear at the end of the translated phrase.


--statusbar Option:

The --statusbar option is very experimental. Always make backup copies of your
PO files before using it. This option only works with programs that have
similar automatic comments for menu items and status bar items. For example,
in the program AbiWord, each menu item has an automatic comment that begins
with "MENU_LABEL_..." y each status bar item begins with "MENU_STATUSLINE_...".
In this case, instrans can look for the corresponding status bar item and
insert the msgstr from the menu item. Nonetheless, many programs don't label
their menus and status bars in a similar fashion and the --statusbar option
won't work properly. If you want to overwrite existing msgstr's, use the
--overwrite option with --statusbar.  If you want to insert menu items in
both the comments and the msgstrs, use the option --comment with --msgstr.  
You can use the option --bilingual with --statusbar, but this will append
the msgstr from the menu to the msgstr from the statusbar.

Similar to --bilingual insertions, the --strip option with specifying the STRING,
will remove ampersands ("&") from --statusbar insertions. Since status bars
don't have shortcut keys, it is recommended that --strip be used with the
--statusbar option. Likewise, --replace without specifying FIND and
REPLACEMENT will replace variables in --statusbar insertions. Sometimes
status bar messages contain variables, but it is safer to replace all the
variables first with --replace, then re-add the necessary variables later.


Processing Directories:

If the ORIGINAL-PO and TRANSLATIONS-PO are directories, instrans will process
all the files in the directory ORIGINAL-PO with the extention ".po", ".pot", or
".pox". Instrans will search for files with the same name in the directory
TRANSLATIONS-PO in order to insert the translated phrases.  The files in
ORIGINAL-PO that don't have the extension ".po", ".pot", or ".pox" will only be
copied to the directory NEW-PO without any insertions. Likewise, the PO files
en the directory ORIGINAL-PO that don't have a matching file with the same name
in TRANSLATIONS-PO will only be copied.

The files in TRANSLATIONS-PO, however, which don't have a matching file in
ORIGINAL-PO will not be copied.  Similarly, the subdirectories in both  
ORIGINAL-PO y TRANSLATIONS-PO will be ignored and won't be copied over to
NEW-PO.  Si you want to process the subdirectories, use the option --recursive.
 
For exemple, if you have the directories "es-ES" and "fr-FR" below and want to
insert French phrases in the Spanish PO files, you can use the following
command:
    php instrans.php es-ES fr-FR es-fr
 
This will produce a NEW-PO directory called "es-fr":

ORIGINAL-PO:           TRASLACIONES-PO:        NEW-PO:
/es-ES/                /fr-FR/                 /es-fr/                    
      /intro.po              /intro.po               /intro.po  
      /readme.txt            /readme.txt             /readme.txt  [only copied]
      /main.po               /main.po                /main.po
      /main.c                /main.c                 /main.c      [only copied]
      /files.pot             /files.pot              /files.pot
      /makelist.po           /different.po           /makelist.po [only copied]
      /win/                  /win/                                   
          /frontend.po           /frontend.po         
          /search.po             /search.po
                               

Only the files "intro.po", "main.po", and "files.pot" in the directory
"es-ES" were processed because they have a PO extension and have matching files
in the directory "fr-FR" with the same filename. The other files in "es-ES"
were copied to the directory "es-fr" without insertions. The subdirectory "win"
was ignored and was not copied. Note that the file "different.po" in the
directory "fr-FR" was also not copied because it doesn't have a matching file
in "es-ES".


--search Option:

If you want to insert translated phrases from any of the files in a directory,
use the option --search.  For example, the command:
    php instrans.php --search es-ES/intro.po fr-FR intro-es-fr.po

will search for translated phrases in all the PO files in the directory "fr-FR"
and insert them in the new file "intro-es-fr.po". If you want to process all
the files in "es-ES" like this, looking in all the files in directory "fr-FR",
use the command:
   php instrans.php --search es-ES fr-FR es-fr  
   
If you want to search for translated frases in the subdirectory "win" as well,
use the option --recursive.


Syntax Errors:

If instrans encounters a syntax error in a PO object, it will provide a tally
of the number of syntax errors at the end of processing. In --verbose mode,
intrans issues a warning message and the line number where the syntax error
can be found. Syntax errors in the TRANSLATIONS-PO will be counted, but won't
be written to the NEW-PO. If a syntax error is encounted in ORIGINAL-PO and
it is a simple problem like a line not ending in double quotes, instrans will
fix the problem when writing to NEW-PO. If instrans can't determine where to
put a PO element in the NEW-PO, it will write "SYNTAX ERROR: " and the
line with the syntax error in the translator comment of the nearest PO object.
If your PO files have syntax errors, it is recommended that you use the
--verbose option so you can find and correct the syntax errors.

For example, if instrans encounters the following PO objects in ORIGINAL-PO:

 #: po/ap_Id.h.h:283            (Problems:                                 )
 msGiD "Edit"                   (msgid should not have capital letters     )
 msgstr"Editar"                 (msgstr should be followed by whitespace   )
    
 #: po/ap_Id.h.h:281
 msgi "Help"                    (Should be "msgid"                         )
 msgstr "Ayuda                  (Line should end in double quotes          )
    
The NEW-PO will be written:

 #: po/ap_Id.h.h:283            (How problems are treated:                 )
 msgid "Edit"                   (Fixed without warning message             )
 msgstr "Editar"                (Fixed without warning message             )
    
 # SYNTAX ERROR: msgi "Help"    (Line moved to comment with warning message)
 #: po/ap_Id.h.h:281       
 msgstr "Ayuda"                 (Fixed with warning message                )
    
Instrans will transform 'msGiD "Edit"' to 'msgid "Edit"' and 'msgstr"Editar"'
to 'msgstr "Editar"' with out issuing a warning or counting a syntax error.
However in the second PO object it will count syntax errors and issue warnings
in --verbose mode about the missing double quotation mark in 'msgstr "Ayuda'
and the unknown identifier "msgi". In the case of 'msgstr "Ayuda', instrans
will add the missing closing quotation mark, but it won't know what to do
with 'msgi "Help"' so it issues a warning and puts the line in a translator
comment after the words 'SYNTAX ERROR: '.    
 
 
Return Value:

Instrans returns a value of 0 if it processed the PO file[s) without problems.
A value between 1 and 20 is returned if errors are encounted opening or writing
files or processing data. A value between 20 and 40 is returned if there are
errors in the arguments passed by the user. If the user uses the options
--help or --info, instrans returns 41 or 42 respectively.


Why so slow?
 
Instrans can be very slow when processing large files. On my machine it takes
6 seconds to process the AbiWord PO file which has 1500 translated phrases, but
on older machines it can take much longer. Instrans.php was originally written
to be a web application in PHP, but it soon became clear that it would be a lot
more efficient for translators to download instrans and run it on their
computers at home.  While PHP is good at serving up web pages, it is horribly
slow at processing large amounts of data in files. If this really bothers you,
feel free to rewrite the code in a faster language.  


Why using so much memory?

If you processing a large PO file with thousands of objects or are using the
--search option with a large number of files, you can expect instrans to use
a lot of memory to hold all the PO objects that it finds.  Instrans is set to
use a maximum of 40MB of memory, but you can increase it by changing
ini_set('memory_limit', '40M');  in file "instrans-header.php".



EXAMPLES OF USAGE


Basic Example:

A translator of Bolivian Quechua has translated some phrases in the file
qu-BO.po, but wants to convert the rest of the untranslated phrases into
Spanish. She downloads the file es-ES.po and issues the following command:

    php instrans.php qu-BO.po es-ES.po

If qu-BO.po looked like this:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay"

#  Can "Print" be translated as "ñit'isqa"?  What is "Layout"?
#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "P&rint Layout"
msgstr ""

#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"¿Uqjinayachisqaykita %s archivopi \njallch'ayta munankichu?"
------------------------------------------

and es-ES.po looked like this:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Abrir"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Abrir un documento existente"

#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "P&rint Layout"
msgstr "Di&seño de impresión"

#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"¿Desea guardar los cambios al documento %s \nantes de cerrar?"
------------------------------------------

Then instrans will insert the phrase "Di&seño de impresión", but won't
touch the PO objects. The file qu-BO.po will be overwritten like this:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay"

#  Can "Print" be translated as "ñit'isqa"?  What is "Layout"?
#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "P&rint Layout"
msgstr "Di&seño de impresión"

#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"¿Uqjinayachisqaykita %s archivopi \njallch'ayta munankichu?"
------------------------------------------


--comment Example:

The first translator passes his PO file onto another translator of Bolivian
Quechua who can't read English.  He wants to insert Spanish translations as
comments in a new file called qu-BO-tras.po:

   php instrans.php --comment="es-ES" qu-BO.po es-ES.po qu-BO-tras.po

The new file qu-BO-tras.po will contain:
------------------------------------------
#  [es-ES] "&Abrir"
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#  [es-ES] "Abrir un documento existente"
#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay"

#  [es-ES] "Di&seño de impresión"
#  Can "Print" be translated as "ñit'isqa"?  What is "Layout"?
#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "P&rint Layout"
msgstr ""

#  [es-ES] ""
#  [es-ES] "¿Desea guardar los cambios al documento %s \nantes de cerrar?"
#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"¿Uqjinayachisqaykita %s archivopi \njallch'ayta munankichu?"
------------------------------------------


--bilingual Example:

Many Quechua speakers are not accustomed to read their own language and need
to see the translation in Spanish next to the Quechua. The translators decide
to make a bilingual version of their program.  The Quechua phrases will be
separated from the Spanish frases by " ][ ".  The --strip and --replace
options are used to remove any problematic ampersands and variables, so the
insertions won't cause any errors in the program. The --verbose and --log
options are used so that the translators will have a record of every place
were the variables have been replaced by "@#@x@#@". Afterwards they will go
through the PO file, and erase the "@#@x@#@".

  php instrans.php -v --log --strip --replace --bilingual=" ][ "
       qu-BO.po es-ES.po qu-es-BO.po
   
The new file qu-es-BO.po will contain:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay ][ Abrir"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay ][ Abrir un documento existente"

#  Can "Print" be translated as "ñit'isqa"?  What is "Layout"?
#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "P&rint Layout"
msgstr "Di&seño de impresión"

#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"¿Uqjinayachisqaykita %s archivopi \njallch'ayta munankichu?"
"\n¿Desea guardar los cambios al documento @#@s@#@ \nantes de cerrar?"
------------------------------------------

The separator " ][ " is not inserted before the phrase "Di&seño de impresión"
because the msgstr was empty. The two phrases in Msg_ConfirmSave PO object are
separated by a new line character (\n) in place of " ][ " because the msgstr
already contained a new line character. In this case the dialog box is able
to expand according to the the size of the message, but in other cases the size
of the window is fixed and multi-line translation is not possible. You have to
check each dialog box to verify if the bilingual phrase will fit.
 
Becaue the msgstr of MENU_LABEL_VIEW_PRINT did not have an ampersand ("&"), the
ampersand was not stripped from the inserted phrase "Di&seño de impresión", but
in the case of MENU_LABEL_FILE_OPEN, el msgstr already had an ampersand. For
this reason, the ampersand was stripped from the phrase "&Abrir" before it was
inserted.


--statusbar Example:

The Quechua translators don't like the bilingual menus because they are very
large and cumbersome. For this reason, they decide to put Spanish translations
from the menus in the status bar.  If users doesn't know what a Quechua phrase
in the menu means, they can look down in the status bar. The --overwrite option
is used to overwrite existing msgstr's. Otherwise, the Spanish translations
from the menus would not be inserted into non-blank status bar PO objects. 
The --strip and --replace options are used to remove any problematic
ampersands and variables that might cause errors.

   php instrans --strip --replace --statusbar="MENU_LABEL_" "MENU_STATUSLINE_"
      --overwrite --verbose qu-BO.po es-ES.po qu-BO-test.po

The new file qu-BO-test.po will contain:
------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#  [es-ES] MENU: "&Abrir"
#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Abrir"

#  Can "Print" be translated as "ñit'isqa"?  What is "Layout"?
#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "Print Layout"
msgstr ""

#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"¿Uqjinayachisqaykita %s archivopi \njallch'ayta munankichu?"
--------------------------------------

Now when the mouse passes over Open in the File menu, the user of this software
will see "Kichay" in the menú and "Abrir" in the status bar.


--search Example:

The Bolivian translators decide to translate a new program into Quechua, but it
hasn't been translated into Spanish yet, so there is no Spanish PO file to pull
translated frases from. They notice however that other programs have been
translated into Spanish and they have many of the same phrases as their new
program. They want to insert these Spanish phrases in both the comments and in
the empty msgstrs in the file qu-BO.po.  They collect all the Spanish PO files
from these various programs together in the directory "es-muchos" and in its
subdirectories, then issue the command:

   php instrans.php -c -m --search --recursive qu-BO.po es-muchos qu-es.po


LICENSE AND AUTHOR
 
---***---
License:   The most recent version of the GNU Lesser General Protection License 
           (LGPL) which can be found at: http://www.gnu.org
Author:    Amos Batto (amosbatto@yahoo.com)
Created:   22 Jun 2006, Last updated: 20 Sep 2007

This script was written as part of the www.ciber-runa.net project to help
people create translations of software in indigenous and minority languages.

Please send me feedback and bug reports to amosbatto@yahoo.com, so I can
improve this script. Thanks.
---***---


DOCUMENTATION IN OTHER LANGUAGES:

Versions of this document:
readme-en.txt  readme-en.html (English)
readme-es.txt  readme-es.html (español)
readme-pt.txt  readme-pt.html (português)

Because instrans is designed for translators who often can't read English,
we are looking for people who can translate this document into other
languages.  We especially need a French translation of this file.

-----------------
NOTE: If you can't see all of this document in MS-DOS with the --info option,
you need to increase the "Screen Buffer Size" in the "Layout" tab. You can find
it under "Properties" in the [c:\] menu in the upper left corner of the DOS
window.

