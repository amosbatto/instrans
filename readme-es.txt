instrans.php -- Software para Insertar Traslaciones
    Instalaci�n
    Descripci�n
    Formato
    Notas
        Usando --replace con --bilingual inserciones
        Usando --strip con --bilingual inserciones
        Opci�n --statusbar
        Procesando Directorios
        Opci�n --search
        Errores de sintaxis
        Valor de devuelto
        �Por qu� demora tanto?
        �Por qu� usa tanta memoria?
    Ejemplos de uso
        Ejemplo Basico
        Ejemplo --comment
        Ejemplo --bilingual
        Ejemplo --statusbar
        Ejemplo --search
    Licencia y Autor
    Documentaci�n en Otras Lenguas


INSTALACI�N:

Para usar instrans, necesita PHP 5 con interfaz de l�nea de mandato (command
line interface). (Tal vez instrans funcionar�a con PHP 4, pero no lo he
probado.)

MS-Windows:
Si se usa MS Windows, descargue php-5.X.X-Win32.zip de http://www.php.net  
Descompactelo en un nuevo archivo donde quiere instalarlo y haga doble clic en
php-5.X.X-installer.exe. Despu�s hay que a�adir PHP a su variable "Path" para
indicar donde se queda PHP. En Windows XP, vaya a Inicio->Configuraci�n->
Panel de control->Sistema. Bajo la pesta�a "Opciones Avanzadas", haga clic en
"Variables de Entorno" y seleccione "Path" en la caja "Variables del Sistema".
Haga clic en "Editar" y a�ada la ruta donde PHP es instalado. Por ejemplo, si
PHP es instalado en el directorio "C:\Archivos de Programa\PHP5", su nueve
"Path" puede aparecerse como:
    c:\WINDOWS;c:\WINDOWS\System32;c:\Archivos de Programa\PHP5

En sistemas m�s viejas, puede cambiar el Path en DOS as�:
    echo $PATH
           [Verifique que $PATH exista.]
    $PATH = $PATH + ";C:\Archivos de Programa\PHP5"
    echo $PATH
           [Verifique que $PATH fuese cambiado]

En algunos sistemas, necesita usar la variable "$Path" en lugar de "$PATH".

Despu�s de instalar PHP 5, descargue y descompacte
www.ciber-runa.net/instrans.zip. Ahora puede utilizar el script instrans.php.

GNU/Linux, UNIX, Cygwin, y Mac OS X:
Usuarios de derivativas de UNIX deben instalar el PHP 5 del repositorio
de su distribuci�n. Por ejemplo, usuarios de Debian y su derivativas pueden
instalarlo as�:
    su            
         [entregue la contrase�a de root]
    apt-get install php5-cli
    exit

Usuarios de Ubuntu usan:
    sudo apt-get install php5-cli

Despu�s de instalar PHP 5, descargue y descompacte
www.ciber-runa.net/instrans.zip  Ahora puede utilizar el script instrans.php.


DESCRIPCI�N:

El programa instrans.php inserta frases traducidas de archivo(s) PO en otro(s)
archivo(s) PO. Instrans es designado para ayudar traductores de software en
lenguas ind�genas que tengan necesidades especiales.  Tambi�n puede
ser usado por traductores haciendo translaciones triling�es o por
traductores que quieran insertar translaciones autom�ticamente de otra lengua.

Instrans permite que el traductor trata con tres lenguas a la misma vez en un
archivo PO. Eso es �til cuando se traduce lenguas en lugares donde ingl�s no
es el idioma predominante escrito.  Por ejemplo, en Am�rica Latina y en �frica
Francesa muchos traductores de lenguas ind�genas no pueden leer ingl�s y
necesitan ver las frases en espa�ol o franc�s.  Instrans tambi�n puede ser
usado para insertar frases traducidas de otra lengua cuando la traductor no
quiere duplicar el trabajo ya hecho en otra traducci�n. Por ejemplo, muchas
lenguas ind�genas utiliza muchas frases prestadas de otras lenguas,
especialmente en el contexto de la inform�tica. Traductores puede utilizar
instrans para insertar las frases prestadas en sus archivos PO.

Cada objeto PO tiene el formato siguiente:
    L�NEA-DE-ESPACIO
    # COMENTARIO-DE-TRADUCTOR
    #. COMENTARIO-AUTOM�TICO
    #: REFERENCIA...
    #, BANDERA...
    msgid FRASE-NO-TRADUCIDA
    msgstr FRASE-TRADUCIDA

Instrans extrae cada msgstr del TRASLACIONES-PO y lo inserta en el ORIGINAL-PO
(o opcionalmente en el NUEVO-PO) donde hay un msgid correspondiente.  Si no
hay un msgid correspondiente, no inserta nada. Si hay m�s que un msgid
correspondiente, instrans busca lo cual tenga un comentario autom�tico o
referencia equivalente. Por omisi�n instrans s�lo inserta una frase PO cuando
el msgstr en el ORIGINAL-PO es vac�o, pero puede borrar un msgstr existente y
insertar un frase PO nueva con la opci�n --overwrite.  Tambi�n hay opciones
para insertar las frases PO como comentarios o frases biling�es o en las
barras de estado. Adem�s hay una opci�n --search para buscar frases
correspondientes usadas en otros programas.


FORMATO:

   php instrans.php [OPCIONES] ORIGINAL-PO TRASLACIONES-PO [NUEVO-PO]

Opciones:

-m | --msgstr     Insertar las frases traducidas en los msgstr que son vac�os.
                  Si quiere reemplazar los que no son vac�os, use la opci�n
                  --overwrite con esta opci�n. Si no especifica el tipo de
                  inserci�n, har� esto por omisi�n.
                  
-b | --bilingual [=SEPARADOR]   
                  Pegar frases traducidas al fin de msgstr existentes para
                  formar frases biling�es. Si hay un msgstr existente, se
                  divide las dos frases por un SEPARADOR que es " * " por
                  omisi�n. Frases que contienen caracteres de nueva l�nea (\n)
                  ser� separado por otra nueva l�nea en lugar del SEPARADOR.
                  
-c | --comment [=IDIOMA]    
                  Insertar frases traducidas como comentarios en la forma:
                  #  [IDIOMA] "FRASE-TRADUCIDA"
                  Si no se espec�fica el IDIOMA, por omisi�n es el nombre de
                  TRASLACIONES-PO.  Puede combinar --comment con todas las
                  otras opciones. Si usa --comment con --statusbar, insertar�
                  comentarios s�lo en objetos PO de la barra de estado en la
                  forma:
                  #  [IDIOMA] MENU: "FRASE-TRADUCIDA"
                  
-s | --statusbar [=FRASE-MENU FRASE-BARRA-DE-ESTADO]
                  Insertar frases traducidas del men� en la barra del estado.
                  Si se encuentra un comentario autom�tico que contiene la
                  FRASE-MENU, busca otro objeto PO con la correspondiente
                  FRASE-BARRA-DE-ESTADO y inserta la frase traducida all�.
                  Por omisi�n FRASE-MENU es "MENU" y FRASE-BARRA-DE-ESTADO
                  es "STATUSBAR". Use esta opci�n con cuidado. Probablemente
                  tiene que editar a mano el archivo PO despu�s.
                    
-o | --overwrite  Reemplazar frases traducidas existentes. Sin esta opci�n,
                  s�lo inserta la frase traducida cuando el msgstr es vac�o.  
                  Si inserta comentarios, esta opci�n no borra los   
                  comentarios de traductor excepto los que tengan la forma:
                  #  [...] "..."

-r | --recursive    Procesar todos los subdirectorios en ORIGINAL-PO y
                  TRASLACIONES-PO. Esta opci�n s�lo tendr� efecto si
                  ORIGINAL-PO y TRASLACIONES-PO son directorios.

-e | --search     Buscar frases traducidas en cualquier archivo o directorio en
                  TRASLANCIONES-PO. Use esta opci�n para encontrar frases
                  traducidas de otros programas.

-x | --strip [=CADENA]   
                  Quitar la CADENA de la frase traducida en inserciones
                  --bilingual y --statusbar. Si no se especifica la CADENA, los
                  signos "&" ser�n quitado. CADENA puede ser un expresi�n
                  Perl. Por ejemplo, -strip = "/<.+>/"  quita todos los c�digos
                  HTML de la frase insertada.
                  
-p | --replace [=BUSQUEDA REEMPLAZO]    
                  Reemplazar BUSQUEDA por REEMPLAZO en la frase traducida en
                  inserciones --bilingual y --statusbar. Si no se especifica la
                  BUSQUEDA y el REEMPLAZO, variables de programaci�n ser�
                  reemplazado por "@#@x@#@". Actualmente solo C, Objective C,
                  PHP, UNIX shell, QT, gcc internal, y YCP variables son
                  reconocido.  BUSQUEDA y REEMPLAZO pueden ser expresiones
                  Perl. Por ejemplo:  -p = "/%([sd])/" "VAR_$1"
                  reemplaza "%s" por "VAR_s" y "%d" por "VAR_d".
 
-v | --verbose    Mostrar avisos y m�s informaci�n.

-q | --quiet      No mostrar ninguna mensaje de pantalla.

-l | --log [=ARCHIVO]   Desviar las mensajes de pantalla a un archivo. Si no
                  se especifica un archivo, por omisi�n es "instrans-log.txt".
                  
-f | --interface = XX   Especificar la lengua de la interfaz del usuario de
                  intrans. Por omisi�n instrans usar� ingl�s si no se hab�a
                  traducido en la lengua de su locale. Actualmente las �nicas
                  opciones son "en", "es", y "pt".
                  
                  
ORIGINAL-PO       El archivo PO original o directorio. Si es un directorio va
                  a procesar todo los archivos PO adentro del directorio.

TRASLACIONES-PO   El archivo PO que contiene las frases traducidas que ser�
                  insertado en el ORIGINAL-PO (o opcionalmente en NUEVO-PO).
                  
NUEVO-PO          [opcional] Si no quiere reemplazar el ARCHIVO-PO,
                  provea un nuevo nombre de archivo para escribir.

                  
Se encierran en comillas los archivos que contienen espacios en sus nombres.
Ejemplos:
  php instrans.php "c:\mis documentos\fr-FR.po" es-ES.po "fr-FR 1.po"
  php "c:\mis documentos\instrans.php" -b=" % " es-ES.po fr-FR.po
 
Para ayuda:
    php instrans.php -h | --help | -? | /?

Para m�s informaci�n y ejemplos de uso:
    php instrans.php -i | --info


NOTAS:

Usando --replace con inserciones --bilingual:

Use la opci�n --bilingual con cuidado y revise archivo(s) PO despu�s. Las
frases traducidas puede contener variables de programaci�n que puede causar
errores cuando est�n insertado. Por ejemplo, programas escrito en C usan el
s�mbolo %s para indicar un string (cadena de caracteres), %d para indicar un
intero, y %f para indicar un numero real que puede contener un punto decimal.
Normalmente frases PO con variables C son marcadas con la bandera:
     #, c-format
Cuando se hace una frase biling�e, va a duplicar el numero de variables en la
frase y esto puede causar errores en el programa. Para evitar este problema,
use la opci�n --replace.  Si no se especifica BUSQUEDA y REEMPLAZO, instrans
busca los objetos PO con la bandera "#, LANG-format" y encierra todas las
variables en "@#@". Por ejemplo, "@#@s@#@" reemplaza "%s" y "@#@-10.4f@#@"
reemplaza "%-10.4f".

Si su versi�n de PHP is 5.10 o despu�s, la opci�n --verbose provee una aviso
cada vez que una variable ha sido reemplazado. Se aconseja que utilice las
opciones --verbose y --log con --bilingual para que tenga un registro de los
cambios.

Despu�s haga una b�squeda por "@#@" en su archivo PO y reemplace estas frases
con algo m�s apropiado en sus traslaciones. Desafortunadamente, hay muchas
lenguas de la computadora y instrans actualmente s�lo reconoce variables de C,
Objective C, PHP, UNIX shell, QT, gcc interno, y YCP.  De todos modos, no debe
confiarse mucho en las substituciones y debe revisar su archivo PO despu�s.


Usando --strip con inserciones --bilingual:

Muchos programas usan el s�mbolo "&" o "&amp;" en los men�s y ventanas de
di�logo para subrayar el siguiente car�cter y hacerlo una tecla de acceso
directo. Si la opci�n --strip es usado sin especificar la CADENA, instrans
quitar� los signos "&" de las frases insertadas. Esto es �til porque un �tem
de men� y un objeto en un ventana de di�logo s�lo pueden tener 1 tecla de
acceso directo.  

Los signos "&" son s�lo quitado si el msgstr existente es vac�o. Porque "&" es
muy usado para significar "y", s�lo lo quita si es seguido por un car�cter
alfab�tico o un numero. No lo quita si es seguido por un s�mbolo, un espacio,
o se aparece en el fin de una frase traducida.


Opci�n --statusbar:

La opci�n --statusbar es muy experimental. Siempre haga copias de reserva de
sus archivos antes que usarla. Esta opci�n s�lo sirve con programas que
tienen comentarios autom�ticos parecidos del men� y de la barra del estado.
Por ejemplo en el programa AbiWord, cada frase traducida de men� tiene un
comentario autom�tico de "MENU_LABEL_..." y cada frase traducida de la barra
de estado tiene un comentario autom�tico de "MENU_STATUSLINE_...".  En este
caso, puede buscar la correspondiente barra del estado y insertar el msgstr
del men�. Sin embargo muchos programas no nombran sus men�s y barras del
estado en una manera parecida y la opci�n --statusbar no sirve bien.  Si
quiere borrar el msgstr existente y reemplazarlo con el msgstr del men�, debe
usar la opci�n --overwrite.  Si quiere insertarlo en ambos msgstr y en el
comentarios, usa las opciones --comment con --msgstr.  Puede usar la opci�n
--bilingual con --statusbar, pero va a pegar el msgstr del statusbar con
msgstr del men�. 

Como en las inserciones de --bilingual, la opci�n --strip sin especificar la
CADENA, quitar� signos "&" de las inserciones de --statusbar. Ya que barras de
estado no tienen teclas de acceso directo, se aconseja que use --strip con la
opci�n --statusbar. Tambi�n puede usar la opci�n --replace sin especificar
BUSQUEDA y REEMPLAZO para quitar variables en inserciones de --statusbar. A
veces mensajes en la barra de estado contienen variables, pero es m�s seguro
reemplazar todas las variables primero, y luego a�adir las variables
necesarias.


Procesando Directorios:

Si ORIGINAL-PO y TRASLACIONES-PO son directorios, instrans procesar� todos los
archivos en el directorio ORIGINAL-PO con la extensi�n ".po", ".pot", o ".pox".
Instrans buscar� archivos del mismo nombre en el directorio TRASLACIONES-PO
para insertar las frases traducidas.  Los archivos en ORIGINAL-PO que no tengan
la extensi�n ".po", ".pot", o ".pox" ser�n solamente copiado al archivo
NUEVO-PO sin insertar nada. Tambi�n los archivos PO en el directorio
ORIGINAL-PO que no tengan un correspondiente archivo con el mismo nombre en
TRASLACIONES-PO ser�n solamente copiado.

Sin embargo, los archivos en TRASLACIONES-PO que no tengan un correspondiente
archivo en ORIGINAL-PO, no ser�n copiado. Tambi�n, los subdirectorios en ambos
ORIGINAL-PO y TRASLACIONES-PO ser�n ignorado y no copiado.  Si quiere procesar
los subdirectorios, use la opci�n --recursive.
 
Por ejemplo, si tiene los directorios "es-ES" y "fr-FR" abajo y quiere insertar
las frases francesas en los archivos PO espa�oles, puede usar el mandato
siguiente:
     php instrans.php es-ES fr-FR es-fr
 
Va a producir un directorio NUEVO-PO "es-fr" as�:

ORIGINAL-PO:         TRASLACIONES-PO:       NUEVO-PO:           
/es-ES/              /fr-FR/                /es-fr/                    
      /intro.po            /intro.po              /intro.po  
      /readme.txt          /readme.txt            /readme.txt  [s�lo copiado]
      /main.po             /main.po               /main.po
      /main.c              /main.c                /main.c      [s�lo copiado]
      /files.pot           /files.pot             /files.pot
      /makelist.po         /different.po          /makelist.po [s�lo copiado]
      /win/                /win/                                   
          /frontend.po         /frontend.po         
          /search.po           /search.po
                               

Solamente los archivos "intro.po", "main.po", y "files.pot" en el directorio
"es-ES" fueron procesado porque tienen una extensi�n PO y hay archivos
correspondientes en el directorio "fr-FR" con el mismo nombre. Los otros
archivos en "es-ES" fueron copiado al directorio "es-fr" sin inserciones. El
subdirectorio "win" fue ignorado y no fue copiado. Anota que el archivo
"different.po" en el directorio "fr-FR" no fue copiado tampoco porque no
hab�a un correspondiente archivo en "es-ES".  


Opci�n --search

Si quiere insertar frases traducidos de qualquier archivo en un directorio,
use la opci�n --search.  Por ejemplo, el mandato:
    php instrans.php --search es-ES/intro.po fr-FR intro-mess.po

Instrans va a buscar frases traducidas en todos los archivos PO en el
directorio "fr-FR" y insertarlas en el archivo nuevo "intro-mess.po". Si quiere
procesar todos los archivos en es-ES as�, buscando en todos los archivos de
fr-FR, usa el mandato:
    php instrans.php --search es-ES fr-FR es-fr  
   
Si quiere buscar en el subdirectorio "win" tambi�n, usa la opci�n --recursive.


Errores de Sintaxis:

Si instrans encuentra un error de sintaxis en un objeto PO, va a a�adirlo al
conteo de errores de sintaxis y mostrarlo al fin de procesamiento. En modo
--verbose, instrans muestra mensajes de aviso y el numero de l�nea en
el archivo donde puede encontrar los errores de sintaxis. En TRASLACI�NES-PO
los errores de sintaxis son contado, pero no ser�n escrito al NUEVO-PO. Si un
error de sintaxis es encontrado en ORIGINAL-PO y es un problema sencillo como
una l�nea no terminada en comillas, instrans lo arreglar� al escribir al
NUEVO-PO.  Si instrans no puede determinar donde ponga un elemento PO en
NUEVO-PO, escribir� "SYNTAX ERROR: " y la l�nea con el error de sintaxis en el
comentario de traductor del objeto PO m�s cerca. Si su archivos PO tienen
errores, se recomienda que use la opci�n --verbose para que Ud. pueda encontrar
y corregir los errores de sintaxis despu�s.

Por ejemplo, si instrans encuentra los siguientes objetos PO in ORIGINAL-PO:

 #: po/ap_Id.h.h:283            (Problemas:                                )
 msGiD "Edit"                   (msgid no debe tener letras may�sculas     )
 msgstr"Editar"                 (falta espacio entre msgstr y "editar"     )
    
 #: po/ap_Id.h.h:281
 msgi "Help"                    (Debe ser "msgid"                          )
 msgstr "Ayuda                  (L�nea debe terminar en comillas.          )
    
El NUEVO-PO ser� escrito:

 #: po/ap_Id.h.h:283            (C�mo problemas son tratado:               )
 msgid "Edit"                   (Arreglado sin mensaje de aviso            )
 msgstr "Editar"                (Arreglado sin mensaje de aviso            )
    
 # SYNTAX ERROR: msgi "Help"    (L�nea es traslado al comentario con aviso )
 #: po/ap_Id.h.h:281       
 msgstr "Ayuda"                 (Arreglado con un mensaje de aviso         )
    
Instrans transformar� 'msGiD "Edit"' a 'msgid "Edit"' y 'msgstr"Editar"'
a 'msgstr "Editar"' sin emitir un aviso o contar un error. Sin embargo en el
segundo objeto PO, instrans contar� errores de sintaxis y emitir� avisos en
el modo --verbose sobre las comillas faltadas en 'msgstr "Ayuda' y la palabra
desconocida "msgi".  En el caso de 'msgstr "Ayuda', instrans a�adir� las
comillas finales autom�ticamente, pero no sabr� que hacer con 'msgi "Help"'.
Va a proveer un aviso y poner la l�nea en el comentario de traductor despu�s
de las palabras 'SYNTAX ERROR: '.    
 

Valor de devuelto:
 
Instrans devuelve un valor de 0 si procesa sin problemas. Devuelve 1-20 si
encuentra errores abriendo y escribiendo archivos o procesando datos. Devuelve
20-40 si encuentra errores en los argumentos pasado por el usuario. Devuelve
41-42 en el caso de la opci�n --help o --formato.


�Por qu� demora tanto?

Instrans puede demorar mucho al procesar archivos grandes. En mi maquina
gasta 6 segundos procesando el archivo PO de AbiWord que contiene 1500 frases
traducidas, pero gasta mucho m�s tiempo en maquinas m�s viejas. Originalmente
instrans fue escrito para ser una aplicaci�n de web en PHP. Dentro de poco fue
claro que fuese m�s eficaz de descargarlo de internet y utilizarlo en casa.
Aunque PHP es bueno para servir paginas web, procesa muy lentamente grandes
cantidades de datos en archivos. Si esto te molesta mucho, sientese libre para
re-escribir el c�digo en una lengua m�s r�pida.  


�Por qu� usa tanta memoria?

Si procesa archivos PO grandes con millares de objetos o usa la opci�n --search
con una grande cantidad de archivos, instrans utiliza mucha memoria para
cargar todos los objetos encontrados.  Por defecto puede utilizar un m�ximo de
40MB de memoria, pero puede aumentarla. Cambie el mandato
ini_set('memory_limit', '40M');  en el archivo "instrans-header.php".


EJEMPLOS DE USO


Ejemplo Basico:

Una traductora de quechua boliviano ha traducido algunas frases en el archivo
qu-BO.po, pero quiere convertir las frases no traducidas al castellano.  
Ella descarga el archivo es-ES.po y entrega el mandato:

     php instrans.php qu-BO.po es-ES.po

Si qu-BO.po se aparece as�:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqa�a documentota kichay"

#  �Puede traducir "Print" como "�it'isqa"? �Qu� es "Layout"?
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
"�Uqjinayachisqaykita �%s� archivopi \njallch'ayta munankichu?"
------------------------------------------

y es-ES.po se aparece as�:
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
msgstr "Di&se�o de impresi�n"

#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"�Desea guardar los cambios al documento %s \nantes de cerrar?" 
------------------------------------------

Entonces instrans insertar� la frase "Di&se�o de impresi�n" pero no tocar�
los otros objetos PO. El archivo qu-BO.po ser� sobre-escrito as�:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqa�a documentota kichay"

#  �Puede traducir "Print" como "�it'isqa"? �Qu� es "Layout"?
#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "P&rint Layout"
msgstr "Di&se�o de impresi�n"

#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"�Uqjinayachisqaykita �%s� archivopi \njallch'ayta munankichu?"
------------------------------------------


Ejemplo con --comment:

La primera traductora pasa el archivo PO a otro traductor de quechua boliviano
que no puede leer ingl�s, �l quiere insertar traslaciones castellanas como
comentarios en un archivo nuevo llamado qu-BO-tras.po:

    php instrans.php --comment="es-ES" qu-BO.po es-ES.po qu-BO-tras.po

El nuevo archivo qu-BO-tras.po contendr�:
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
msgstr "Kasqa�a documentota kichay"

#  [es-ES] "Di&se�o de impresi�n"
#  �Puede traducir "Print" como "�it'isqa"? �Qu� es "Layout"?.
#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "P&rint Layout"
msgstr ""

#  [es-ES] ""
#  [es-ES] "�Desea guardar los cambios al documento %s \nantes de cerrar?"
#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"�Uqjinayachisqaykita �%s� archivopi \njallch'ayta munankichu?"
------------------------------------------


Ejemplo con --bilingual:

Muchos quechua-hablantes no son acostumbrado a leerlo y necesita ver la
traducci�n en espa�ol al lado del quechua. Los traductores deciden
hacer una versi�n biling�e.  Las frases quechuas ser�n separados de las
frases espa�oles por " ][ ".  Las opciones --strip y --replace son usado
para quitan cualquier signo "&" o variable que pueda causar errores. Las
opciones --verbose y --log son usado para que los traductores tengan un
registro de cada lugar donde las variables hab�a sido reemplazado por
"@#@x@#@".  Despu�s ellos revise el archivo PO y borrar los "@#@x@#@".

    php instrans.php -v --log --strip --replace --bilingual=" ][ "
        qu-BO.po es-ES.po qu-es-BO.po
   
El archivo qu-es-BO.po contendr�:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay ][ Abrir"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqa�a documentota kichay ][ Abrir un documento existente"

#  �Puede traducir "Print" como "�it'isqa"? �Qu� es "Layout"?
#. MENU_LABEL_VIEW_PRINT
#: po/tmp/ap_String_Id.h.h:309
msgid "P&rint Layout"
msgstr "Di&se�o de impresi�n"

#. MSG_ConfirmSave
#: po/tmp/ap_String_Id.h.h:1995
#, c-format
msgid ""
"Save changes to document %s \nbefore closing?"
msgstr ""
"�Uqjinayachisqaykita %s archivopi \njallch'ayta munankichu?"
"\n�Desea guardar los cambios al documento @#@s@#@ \nantes de cerrar?"
------------------------------------------

El separador " ][ " no es insertado antes de la frase "Di&se�o de impresi�n"
porque el msgstr fue vaci�. Las dos frases en Msg_ConfirmSave son separados
por un car�cter de nueva l�nea (\n) en lugar de " ][ " porque el msgstr ya
contiene una nueva l�nea. En este caso la ventana de di�logo se expande por
el tama�o del mensaje, pero en otros casos el tama�o de ventana es fijado y
una traslaci�n de l�neas m�ltiples no es posible. Hay que chequear cada
ventana de di�logo para verificar que quepa la frase biling�e.
 
Porque el msgstr de MENU_LABEL_VIEW_PRINT no ten�a un signo "&" (s�mbolo de
acceso directo), el "&" no es quitado el la frase insertado "Di&se�o de
impresi�n", pero en el caso de MENU_LABEL_FILE_OPEN, el msgstr ya ten�a un "&".
Por eso, "&" es quitado de la frase "&Abrir" antes que insertarla.


Ejemplo con --statusbar:

Los traductores quechuas no les gustan los men�s biling�es porque son muy
grandes y inc�modos. Por eso ellos deciden poner las traslaciones espa�oles
de los men�s en la barra del estado. Si un usuario no sabe lo que significa
un men� puede mirar abajo en la barra del estado. Ellos usan la opci�n
--overwrite para borrar y reemplazar los msgstr existentes.  Las opciones
--strip y --replace son usado para quitar cualquier signo "&" y
variable que pueda causar problemas.

 php instrans --strip --replace --overwrite --verbose
    --statusbar="MENU_LABEL_" "MENU_STATUSLINE_"
    qu-BO.po es-ES.po qu-BO-prueba.po

Entonces el archivo nuevo qu-BO-pruebe.po contendr�:
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

#  �Puede traducir "Print" como "�it'isqa"? �Qu� es "Layout"?
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
"�Uqjinayachisqaykita %s archivopi \njallch'ayta munankichu?"
--------------------------------------
    
Ahora cuando el rat�n pasa sobre Abrir en el men� Archivo, el usuario de
este software va a ver "Kichay" en el men� y "Abrir" en la barra de estado.


Ejemplo con --search:

Los traductores bolivianos deciden traducir un programa nuevo al quechua,
pero el programa todav�a no hab�a traducido en espa�ol.  No hay un archivo PO
donde pueden sacar las frases espa�oles.  Sin embargo, ellos observan que otros
programas hab�an sido traducido en espa�ol y esos otros programas tienen muchas
de las mismas frases como su programa nuevo.  Quieren insertar esas frases
sacado de muchos programas en los comentarios en el nuevo archivo qu-es.po.
Ellos recolectan todos los archivos PO de esos programas en el directorio
"es-muchos" y en sus subdirectorios y entregan el mandato:

   php instrans.php -c --search --recursive qu-BO.po es-muchos qu-es.po
 
 
LICENCIA Y AUTOR

---***---
Licencia:  Actual versi�n de GNU Licencia de Protecci�n General Reducida (LGPL)
           que se puede leer en: http://www.gnu.org
Autor:     Amos Batto (amosbatto@yahoo.com)
Creado:    22 Jun 2006, �ltima actualizaci�n: 20 sep 2007

Este script fue escrito como parte del proyecto www.ciber-runa.net
para ayudar gente crear traducciones de software en lenguas ind�genas.

Por favor mande reportajes de fallos o sus sugerencias a amosbatto@yahoo.com
para que yo pueda mejorar instrans.php. Gracias.
---***---
 
 
DOCUMENTACI�N EN OTRAS LENGUAS

Versiones de este documento:
readme-en.txt  readme-en.html (English)
readme-es.txt  readme-es.html (espa�ol)
readme-pt.txt  readme-pt.html (portugu�s)

Porque instrans es designado para ayudar traductores que no puedan leer ingl�s,
estamos buscando para gente que pueda traducir este programa en otras lenguas.
Especialmente necesitamos una traducci�n francesa.

----------------------------------------------
Nota: Si Ud. no puede ver todo este documento en DOS, necesita aumentar el
"Tama�o del b�fer de pantalla" en la pesta�a "Dise�o". Puede encontrarlo bajo
"Propiedades" en el men� [c:\] a la izquierda arriba de la ventana de DOS. 
