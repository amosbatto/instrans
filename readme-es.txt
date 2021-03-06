instrans.php -- Software para Insertar Traslaciones
    Instalación
    Descripción
    Formato
    Notas
        Usando --replace con --bilingual inserciones
        Usando --strip con --bilingual inserciones
        Opción --statusbar
        Procesando Directorios
        Opción --search
        Errores de sintaxis
        Valor de devuelto
        ¿Por qué demora tanto?
        ¿Por qué usa tanta memoria?
    Ejemplos de uso
        Ejemplo Basico
        Ejemplo --comment
        Ejemplo --bilingual
        Ejemplo --statusbar
        Ejemplo --search
    Licencia y Autor
    Documentación en Otras Lenguas


INSTALACIÓN:

Para usar instrans, necesita PHP 5 con interfaz de línea de mandato (command
line interface). (Tal vez instrans funcionaría con PHP 4, pero no lo he
probado.)

MS-Windows:
Si se usa MS Windows, descargue php-5.X.X-Win32.zip de http://www.php.net  
Descompactelo en un nuevo archivo donde quiere instalarlo y haga doble clic en
php-5.X.X-installer.exe. Después hay que añadir PHP a su variable "Path" para
indicar donde se queda PHP. En Windows XP, vaya a Inicio->Configuración->
Panel de control->Sistema. Bajo la pestaña "Opciones Avanzadas", haga clic en
"Variables de Entorno" y seleccione "Path" en la caja "Variables del Sistema".
Haga clic en "Editar" y añada la ruta donde PHP es instalado. Por ejemplo, si
PHP es instalado en el directorio "C:\Archivos de Programa\PHP5", su nueve
"Path" puede aparecerse como:
    c:\WINDOWS;c:\WINDOWS\System32;c:\Archivos de Programa\PHP5

En sistemas más viejas, puede cambiar el Path en DOS así:
    echo $PATH
           [Verifique que $PATH exista.]
    $PATH = $PATH + ";C:\Archivos de Programa\PHP5"
    echo $PATH
           [Verifique que $PATH fuese cambiado]

En algunos sistemas, necesita usar la variable "$Path" en lugar de "$PATH".

Después de instalar PHP 5, descargue y descompacte
www.ciber-runa.net/instrans.zip. Ahora puede utilizar el script instrans.php.

GNU/Linux, UNIX, Cygwin, y Mac OS X:
Usuarios de derivativas de UNIX deben instalar el PHP 5 del repositorio
de su distribución. Por ejemplo, usuarios de Debian y su derivativas pueden
instalarlo así:
    su            
         [entregue la contraseña de root]
    apt-get install php5-cli
    exit

Usuarios de Ubuntu usan:
    sudo apt-get install php5-cli

Después de instalar PHP 5, descargue y descompacte
www.ciber-runa.net/instrans.zip  Ahora puede utilizar el script instrans.php.


DESCRIPCIÓN:

El programa instrans.php inserta frases traducidas de archivo(s) PO en otro(s)
archivo(s) PO. Instrans es designado para ayudar traductores de software en
lenguas indígenas que tengan necesidades especiales.  También puede
ser usado por traductores haciendo translaciones trilingües o por
traductores que quieran insertar translaciones automáticamente de otra lengua.

Instrans permite que el traductor trata con tres lenguas a la misma vez en un
archivo PO. Eso es útil cuando se traduce lenguas en lugares donde inglés no
es el idioma predominante escrito.  Por ejemplo, en América Latina y en África
Francesa muchos traductores de lenguas indígenas no pueden leer inglés y
necesitan ver las frases en español o francés.  Instrans también puede ser
usado para insertar frases traducidas de otra lengua cuando la traductor no
quiere duplicar el trabajo ya hecho en otra traducción. Por ejemplo, muchas
lenguas indígenas utiliza muchas frases prestadas de otras lenguas,
especialmente en el contexto de la informática. Traductores puede utilizar
instrans para insertar las frases prestadas en sus archivos PO.

Cada objeto PO tiene el formato siguiente:
    LÍNEA-DE-ESPACIO
    # COMENTARIO-DE-TRADUCTOR
    #. COMENTARIO-AUTOMÁTICO
    #: REFERENCIA...
    #, BANDERA...
    msgid FRASE-NO-TRADUCIDA
    msgstr FRASE-TRADUCIDA

Instrans extrae cada msgstr del TRASLACIONES-PO y lo inserta en el ORIGINAL-PO
(o opcionalmente en el NUEVO-PO) donde hay un msgid correspondiente.  Si no
hay un msgid correspondiente, no inserta nada. Si hay más que un msgid
correspondiente, instrans busca lo cual tenga un comentario automático o
referencia equivalente. Por omisión instrans sólo inserta una frase PO cuando
el msgstr en el ORIGINAL-PO es vacío, pero puede borrar un msgstr existente y
insertar un frase PO nueva con la opción --overwrite.  También hay opciones
para insertar las frases PO como comentarios o frases bilingües o en las
barras de estado. Además hay una opción --search para buscar frases
correspondientes usadas en otros programas.


FORMATO:

   php instrans.php [OPCIONES] ORIGINAL-PO TRASLACIONES-PO [NUEVO-PO]

Opciones:

-m | --msgstr     Insertar las frases traducidas en los msgstr que son vacíos.
                  Si quiere reemplazar los que no son vacíos, use la opción
                  --overwrite con esta opción. Si no especifica el tipo de
                  inserción, hará esto por omisión.
                  
-b | --bilingual [=SEPARADOR]   
                  Pegar frases traducidas al fin de msgstr existentes para
                  formar frases bilingües. Si hay un msgstr existente, se
                  divide las dos frases por un SEPARADOR que es " * " por
                  omisión. Frases que contienen caracteres de nueva línea (\n)
                  será separado por otra nueva línea en lugar del SEPARADOR.
                  
-c | --comment [=IDIOMA]    
                  Insertar frases traducidas como comentarios en la forma:
                  #  [IDIOMA] "FRASE-TRADUCIDA"
                  Si no se específica el IDIOMA, por omisión es el nombre de
                  TRASLACIONES-PO.  Puede combinar --comment con todas las
                  otras opciones. Si usa --comment con --statusbar, insertará
                  comentarios sólo en objetos PO de la barra de estado en la
                  forma:
                  #  [IDIOMA] MENU: "FRASE-TRADUCIDA"
                  
-s | --statusbar [=FRASE-MENU FRASE-BARRA-DE-ESTADO]
                  Insertar frases traducidas del menú en la barra del estado.
                  Si se encuentra un comentario automático que contiene la
                  FRASE-MENU, busca otro objeto PO con la correspondiente
                  FRASE-BARRA-DE-ESTADO y inserta la frase traducida allí.
                  Por omisión FRASE-MENU es "MENU" y FRASE-BARRA-DE-ESTADO
                  es "STATUSBAR". Use esta opción con cuidado. Probablemente
                  tiene que editar a mano el archivo PO después.
                    
-o | --overwrite  Reemplazar frases traducidas existentes. Sin esta opción,
                  sólo inserta la frase traducida cuando el msgstr es vacío.  
                  Si inserta comentarios, esta opción no borra los   
                  comentarios de traductor excepto los que tengan la forma:
                  #  [...] "..."

-r | --recursive    Procesar todos los subdirectorios en ORIGINAL-PO y
                  TRASLACIONES-PO. Esta opción sólo tendrá efecto si
                  ORIGINAL-PO y TRASLACIONES-PO son directorios.

-e | --search     Buscar frases traducidas en cualquier archivo o directorio en
                  TRASLANCIONES-PO. Use esta opción para encontrar frases
                  traducidas de otros programas.

-x | --strip [=CADENA]   
                  Quitar la CADENA de la frase traducida en inserciones
                  --bilingual y --statusbar. Si no se especifica la CADENA, los
                  signos "&" serán quitado. CADENA puede ser un expresión
                  Perl. Por ejemplo, -strip = "/<.+>/"  quita todos los códigos
                  HTML de la frase insertada.
                  
-p | --replace [=BUSQUEDA REEMPLAZO]    
                  Reemplazar BUSQUEDA por REEMPLAZO en la frase traducida en
                  inserciones --bilingual y --statusbar. Si no se especifica la
                  BUSQUEDA y el REEMPLAZO, variables de programación será
                  reemplazado por "@#@x@#@". Actualmente solo C, Objective C,
                  PHP, UNIX shell, QT, gcc internal, y YCP variables son
                  reconocido.  BUSQUEDA y REEMPLAZO pueden ser expresiones
                  Perl. Por ejemplo:  -p = "/%([sd])/" "VAR_$1"
                  reemplaza "%s" por "VAR_s" y "%d" por "VAR_d".
 
-v | --verbose    Mostrar avisos y más información.

-q | --quiet      No mostrar ninguna mensaje de pantalla.

-l | --log [=ARCHIVO]   Desviar las mensajes de pantalla a un archivo. Si no
                  se especifica un archivo, por omisión es "instrans-log.txt".
                  
-f | --interface = XX   Especificar la lengua de la interfaz del usuario de
                  intrans. Por omisión instrans usará inglés si no se había
                  traducido en la lengua de su locale. Actualmente las únicas
                  opciones son "en", "es", y "pt".
                  
                  
ORIGINAL-PO       El archivo PO original o directorio. Si es un directorio va
                  a procesar todo los archivos PO adentro del directorio.

TRASLACIONES-PO   El archivo PO que contiene las frases traducidas que será
                  insertado en el ORIGINAL-PO (o opcionalmente en NUEVO-PO).
                  
NUEVO-PO          [opcional] Si no quiere reemplazar el ARCHIVO-PO,
                  provea un nuevo nombre de archivo para escribir.

                  
Se encierran en comillas los archivos que contienen espacios en sus nombres.
Ejemplos:
  php instrans.php "c:\mis documentos\fr-FR.po" es-ES.po "fr-FR 1.po"
  php "c:\mis documentos\instrans.php" -b=" % " es-ES.po fr-FR.po
 
Para ayuda:
    php instrans.php -h | --help | -? | /?

Para más información y ejemplos de uso:
    php instrans.php -i | --info


NOTAS:

Usando --replace con inserciones --bilingual:

Use la opción --bilingual con cuidado y revise archivo(s) PO después. Las
frases traducidas puede contener variables de programación que puede causar
errores cuando están insertado. Por ejemplo, programas escrito en C usan el
símbolo %s para indicar un string (cadena de caracteres), %d para indicar un
intero, y %f para indicar un numero real que puede contener un punto decimal.
Normalmente frases PO con variables C son marcadas con la bandera:
     #, c-format
Cuando se hace una frase bilingüe, va a duplicar el numero de variables en la
frase y esto puede causar errores en el programa. Para evitar este problema,
use la opción --replace.  Si no se especifica BUSQUEDA y REEMPLAZO, instrans
busca los objetos PO con la bandera "#, LANG-format" y encierra todas las
variables en "@#@". Por ejemplo, "@#@s@#@" reemplaza "%s" y "@#@-10.4f@#@"
reemplaza "%-10.4f".

Si su versión de PHP is 5.10 o después, la opción --verbose provee una aviso
cada vez que una variable ha sido reemplazado. Se aconseja que utilice las
opciones --verbose y --log con --bilingual para que tenga un registro de los
cambios.

Después haga una búsqueda por "@#@" en su archivo PO y reemplace estas frases
con algo más apropiado en sus traslaciones. Desafortunadamente, hay muchas
lenguas de la computadora y instrans actualmente sólo reconoce variables de C,
Objective C, PHP, UNIX shell, QT, gcc interno, y YCP.  De todos modos, no debe
confiarse mucho en las substituciones y debe revisar su archivo PO después.


Usando --strip con inserciones --bilingual:

Muchos programas usan el símbolo "&" o "&amp;" en los menús y ventanas de
diálogo para subrayar el siguiente carácter y hacerlo una tecla de acceso
directo. Si la opción --strip es usado sin especificar la CADENA, instrans
quitará los signos "&" de las frases insertadas. Esto es útil porque un ítem
de menú y un objeto en un ventana de diálogo sólo pueden tener 1 tecla de
acceso directo.  

Los signos "&" son sólo quitado si el msgstr existente es vacío. Porque "&" es
muy usado para significar "y", sólo lo quita si es seguido por un carácter
alfabético o un numero. No lo quita si es seguido por un símbolo, un espacio,
o se aparece en el fin de una frase traducida.


Opción --statusbar:

La opción --statusbar es muy experimental. Siempre haga copias de reserva de
sus archivos antes que usarla. Esta opción sólo sirve con programas que
tienen comentarios automáticos parecidos del menú y de la barra del estado.
Por ejemplo en el programa AbiWord, cada frase traducida de menú tiene un
comentario automático de "MENU_LABEL_..." y cada frase traducida de la barra
de estado tiene un comentario automático de "MENU_STATUSLINE_...".  En este
caso, puede buscar la correspondiente barra del estado y insertar el msgstr
del menú. Sin embargo muchos programas no nombran sus menús y barras del
estado en una manera parecida y la opción --statusbar no sirve bien.  Si
quiere borrar el msgstr existente y reemplazarlo con el msgstr del menú, debe
usar la opción --overwrite.  Si quiere insertarlo en ambos msgstr y en el
comentarios, usa las opciones --comment con --msgstr.  Puede usar la opción
--bilingual con --statusbar, pero va a pegar el msgstr del statusbar con
msgstr del menú. 

Como en las inserciones de --bilingual, la opción --strip sin especificar la
CADENA, quitará signos "&" de las inserciones de --statusbar. Ya que barras de
estado no tienen teclas de acceso directo, se aconseja que use --strip con la
opción --statusbar. También puede usar la opción --replace sin especificar
BUSQUEDA y REEMPLAZO para quitar variables en inserciones de --statusbar. A
veces mensajes en la barra de estado contienen variables, pero es más seguro
reemplazar todas las variables primero, y luego añadir las variables
necesarias.


Procesando Directorios:

Si ORIGINAL-PO y TRASLACIONES-PO son directorios, instrans procesará todos los
archivos en el directorio ORIGINAL-PO con la extensión ".po", ".pot", o ".pox".
Instrans buscará archivos del mismo nombre en el directorio TRASLACIONES-PO
para insertar las frases traducidas.  Los archivos en ORIGINAL-PO que no tengan
la extensión ".po", ".pot", o ".pox" serán solamente copiado al archivo
NUEVO-PO sin insertar nada. También los archivos PO en el directorio
ORIGINAL-PO que no tengan un correspondiente archivo con el mismo nombre en
TRASLACIONES-PO serán solamente copiado.

Sin embargo, los archivos en TRASLACIONES-PO que no tengan un correspondiente
archivo en ORIGINAL-PO, no serán copiado. También, los subdirectorios en ambos
ORIGINAL-PO y TRASLACIONES-PO serán ignorado y no copiado.  Si quiere procesar
los subdirectorios, use la opción --recursive.
 
Por ejemplo, si tiene los directorios "es-ES" y "fr-FR" abajo y quiere insertar
las frases francesas en los archivos PO españoles, puede usar el mandato
siguiente:
     php instrans.php es-ES fr-FR es-fr
 
Va a producir un directorio NUEVO-PO "es-fr" así:

ORIGINAL-PO:         TRASLACIONES-PO:       NUEVO-PO:           
/es-ES/              /fr-FR/                /es-fr/                    
      /intro.po            /intro.po              /intro.po  
      /readme.txt          /readme.txt            /readme.txt  [sólo copiado]
      /main.po             /main.po               /main.po
      /main.c              /main.c                /main.c      [sólo copiado]
      /files.pot           /files.pot             /files.pot
      /makelist.po         /different.po          /makelist.po [sólo copiado]
      /win/                /win/                                   
          /frontend.po         /frontend.po         
          /search.po           /search.po
                               

Solamente los archivos "intro.po", "main.po", y "files.pot" en el directorio
"es-ES" fueron procesado porque tienen una extensión PO y hay archivos
correspondientes en el directorio "fr-FR" con el mismo nombre. Los otros
archivos en "es-ES" fueron copiado al directorio "es-fr" sin inserciones. El
subdirectorio "win" fue ignorado y no fue copiado. Anota que el archivo
"different.po" en el directorio "fr-FR" no fue copiado tampoco porque no
había un correspondiente archivo en "es-ES".  


Opción --search

Si quiere insertar frases traducidos de qualquier archivo en un directorio,
use la opción --search.  Por ejemplo, el mandato:
    php instrans.php --search es-ES/intro.po fr-FR intro-mess.po

Instrans va a buscar frases traducidas en todos los archivos PO en el
directorio "fr-FR" y insertarlas en el archivo nuevo "intro-mess.po". Si quiere
procesar todos los archivos en es-ES así, buscando en todos los archivos de
fr-FR, usa el mandato:
    php instrans.php --search es-ES fr-FR es-fr  
   
Si quiere buscar en el subdirectorio "win" también, usa la opción --recursive.


Errores de Sintaxis:

Si instrans encuentra un error de sintaxis en un objeto PO, va a añadirlo al
conteo de errores de sintaxis y mostrarlo al fin de procesamiento. En modo
--verbose, instrans muestra mensajes de aviso y el numero de línea en
el archivo donde puede encontrar los errores de sintaxis. En TRASLACIÓNES-PO
los errores de sintaxis son contado, pero no serán escrito al NUEVO-PO. Si un
error de sintaxis es encontrado en ORIGINAL-PO y es un problema sencillo como
una línea no terminada en comillas, instrans lo arreglará al escribir al
NUEVO-PO.  Si instrans no puede determinar donde ponga un elemento PO en
NUEVO-PO, escribirá "SYNTAX ERROR: " y la línea con el error de sintaxis en el
comentario de traductor del objeto PO más cerca. Si su archivos PO tienen
errores, se recomienda que use la opción --verbose para que Ud. pueda encontrar
y corregir los errores de sintaxis después.

Por ejemplo, si instrans encuentra los siguientes objetos PO in ORIGINAL-PO:

 #: po/ap_Id.h.h:283            (Problemas:                                )
 msGiD "Edit"                   (msgid no debe tener letras mayúsculas     )
 msgstr"Editar"                 (falta espacio entre msgstr y "editar"     )
    
 #: po/ap_Id.h.h:281
 msgi "Help"                    (Debe ser "msgid"                          )
 msgstr "Ayuda                  (Línea debe terminar en comillas.          )
    
El NUEVO-PO será escrito:

 #: po/ap_Id.h.h:283            (Cómo problemas son tratado:               )
 msgid "Edit"                   (Arreglado sin mensaje de aviso            )
 msgstr "Editar"                (Arreglado sin mensaje de aviso            )
    
 # SYNTAX ERROR: msgi "Help"    (Línea es traslado al comentario con aviso )
 #: po/ap_Id.h.h:281       
 msgstr "Ayuda"                 (Arreglado con un mensaje de aviso         )
    
Instrans transformará 'msGiD "Edit"' a 'msgid "Edit"' y 'msgstr"Editar"'
a 'msgstr "Editar"' sin emitir un aviso o contar un error. Sin embargo en el
segundo objeto PO, instrans contará errores de sintaxis y emitirá avisos en
el modo --verbose sobre las comillas faltadas en 'msgstr "Ayuda' y la palabra
desconocida "msgi".  En el caso de 'msgstr "Ayuda', instrans añadirá las
comillas finales automáticamente, pero no sabrá que hacer con 'msgi "Help"'.
Va a proveer un aviso y poner la línea en el comentario de traductor después
de las palabras 'SYNTAX ERROR: '.    
 

Valor de devuelto:
 
Instrans devuelve un valor de 0 si procesa sin problemas. Devuelve 1-20 si
encuentra errores abriendo y escribiendo archivos o procesando datos. Devuelve
20-40 si encuentra errores en los argumentos pasado por el usuario. Devuelve
41-42 en el caso de la opción --help o --formato.


¿Por qué demora tanto?

Instrans puede demorar mucho al procesar archivos grandes. En mi maquina
gasta 6 segundos procesando el archivo PO de AbiWord que contiene 1500 frases
traducidas, pero gasta mucho más tiempo en maquinas más viejas. Originalmente
instrans fue escrito para ser una aplicación de web en PHP. Dentro de poco fue
claro que fuese más eficaz de descargarlo de internet y utilizarlo en casa.
Aunque PHP es bueno para servir paginas web, procesa muy lentamente grandes
cantidades de datos en archivos. Si esto te molesta mucho, sientese libre para
re-escribir el código en una lengua más rápida.  


¿Por qué usa tanta memoria?

Si procesa archivos PO grandes con millares de objetos o usa la opción --search
con una grande cantidad de archivos, instrans utiliza mucha memoria para
cargar todos los objetos encontrados.  Por defecto puede utilizar un máximo de
40MB de memoria, pero puede aumentarla. Cambie el mandato
ini_set('memory_limit', '40M');  en el archivo "instrans-header.php".


EJEMPLOS DE USO


Ejemplo Basico:

Una traductora de quechua boliviano ha traducido algunas frases en el archivo
qu-BO.po, pero quiere convertir las frases no traducidas al castellano.  
Ella descarga el archivo es-ES.po y entrega el mandato:

     php instrans.php qu-BO.po es-ES.po

Si qu-BO.po se aparece así:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay"

#  ¿Puede traducir "Print" como "ñit'isqa"? ¿Qué es "Layout"?
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
"¿Uqjinayachisqaykita «%s» archivopi \njallch'ayta munankichu?"
------------------------------------------

y es-ES.po se aparece así:
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

Entonces instrans insertará la frase "Di&seño de impresión" pero no tocará
los otros objetos PO. El archivo qu-BO.po será sobre-escrito así:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay"

#  ¿Puede traducir "Print" como "ñit'isqa"? ¿Qué es "Layout"?
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
"¿Uqjinayachisqaykita «%s» archivopi \njallch'ayta munankichu?"
------------------------------------------


Ejemplo con --comment:

La primera traductora pasa el archivo PO a otro traductor de quechua boliviano
que no puede leer inglés, él quiere insertar traslaciones castellanas como
comentarios en un archivo nuevo llamado qu-BO-tras.po:

    php instrans.php --comment="es-ES" qu-BO.po es-ES.po qu-BO-tras.po

El nuevo archivo qu-BO-tras.po contendrá:
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
#  ¿Puede traducir "Print" como "ñit'isqa"? ¿Qué es "Layout"?.
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
"¿Uqjinayachisqaykita «%s» archivopi \njallch'ayta munankichu?"
------------------------------------------


Ejemplo con --bilingual:

Muchos quechua-hablantes no son acostumbrado a leerlo y necesita ver la
traducción en español al lado del quechua. Los traductores deciden
hacer una versión bilingüe.  Las frases quechuas serán separados de las
frases españoles por " ][ ".  Las opciones --strip y --replace son usado
para quitan cualquier signo "&" o variable que pueda causar errores. Las
opciones --verbose y --log son usado para que los traductores tengan un
registro de cada lugar donde las variables había sido reemplazado por
"@#@x@#@".  Después ellos revise el archivo PO y borrar los "@#@x@#@".

    php instrans.php -v --log --strip --replace --bilingual=" ][ "
        qu-BO.po es-ES.po qu-es-BO.po
   
El archivo qu-es-BO.po contendrá:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay ][ Abrir"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay ][ Abrir un documento existente"

#  ¿Puede traducir "Print" como "ñit'isqa"? ¿Qué es "Layout"?
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

El separador " ][ " no es insertado antes de la frase "Di&seño de impresión"
porque el msgstr fue vació. Las dos frases en Msg_ConfirmSave son separados
por un carácter de nueva línea (\n) en lugar de " ][ " porque el msgstr ya
contiene una nueva línea. En este caso la ventana de diálogo se expande por
el tamaño del mensaje, pero en otros casos el tamaño de ventana es fijado y
una traslación de líneas múltiples no es posible. Hay que chequear cada
ventana de diálogo para verificar que quepa la frase bilingüe.
 
Porque el msgstr de MENU_LABEL_VIEW_PRINT no tenía un signo "&" (símbolo de
acceso directo), el "&" no es quitado el la frase insertado "Di&seño de
impresión", pero en el caso de MENU_LABEL_FILE_OPEN, el msgstr ya tenía un "&".
Por eso, "&" es quitado de la frase "&Abrir" antes que insertarla.


Ejemplo con --statusbar:

Los traductores quechuas no les gustan los menús bilingües porque son muy
grandes y incómodos. Por eso ellos deciden poner las traslaciones españoles
de los menús en la barra del estado. Si un usuario no sabe lo que significa
un menú puede mirar abajo en la barra del estado. Ellos usan la opción
--overwrite para borrar y reemplazar los msgstr existentes.  Las opciones
--strip y --replace son usado para quitar cualquier signo "&" y
variable que pueda causar problemas.

 php instrans --strip --replace --overwrite --verbose
    --statusbar="MENU_LABEL_" "MENU_STATUSLINE_"
    qu-BO.po es-ES.po qu-BO-prueba.po

Entonces el archivo nuevo qu-BO-pruebe.po contendrá:
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

#  ¿Puede traducir "Print" como "ñit'isqa"? ¿Qué es "Layout"?
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
    
Ahora cuando el ratón pasa sobre Abrir en el menú Archivo, el usuario de
este software va a ver "Kichay" en el menú y "Abrir" en la barra de estado.


Ejemplo con --search:

Los traductores bolivianos deciden traducir un programa nuevo al quechua,
pero el programa todavía no había traducido en español.  No hay un archivo PO
donde pueden sacar las frases españoles.  Sin embargo, ellos observan que otros
programas habían sido traducido en español y esos otros programas tienen muchas
de las mismas frases como su programa nuevo.  Quieren insertar esas frases
sacado de muchos programas en los comentarios en el nuevo archivo qu-es.po.
Ellos recolectan todos los archivos PO de esos programas en el directorio
"es-muchos" y en sus subdirectorios y entregan el mandato:

   php instrans.php -c --search --recursive qu-BO.po es-muchos qu-es.po
 
 
LICENCIA Y AUTOR

---***---
Licencia:  Actual versión de GNU Licencia de Protección General Reducida (LGPL)
           que se puede leer en: http://www.gnu.org
Autor:     Amos Batto (amosbatto@yahoo.com)
Creado:    22 Jun 2006, Última actualización: 20 sep 2007

Este script fue escrito como parte del proyecto www.ciber-runa.net
para ayudar gente crear traducciones de software en lenguas indígenas.

Por favor mande reportajes de fallos o sus sugerencias a amosbatto@yahoo.com
para que yo pueda mejorar instrans.php. Gracias.
---***---
 
 
DOCUMENTACIÓN EN OTRAS LENGUAS

Versiones de este documento:
readme-en.txt  readme-en.html (English)
readme-es.txt  readme-es.html (español)
readme-pt.txt  readme-pt.html (português)

Porque instrans es designado para ayudar traductores que no puedan leer inglés,
estamos buscando para gente que pueda traducir este programa en otras lenguas.
Especialmente necesitamos una traducción francesa.

----------------------------------------------
Nota: Si Ud. no puede ver todo este documento en DOS, necesita aumentar el
"Tamaño del búfer de pantalla" en la pestaña "Diseño". Puede encontrarlo bajo
"Propiedades" en el menú [c:\] a la izquierda arriba de la ventana de DOS. 
