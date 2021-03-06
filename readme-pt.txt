instrans.php -- Software para Inserir Translações

    Instalação
    Descrição
    Formato
    Notas
        Usando --replace com --bilingual inserções
        Usando --strip com --bilingual inserções
        Opção --statusbar
        Processando diréctorios
        Opção --search
        Erros de sintaxe
        Valor de volto
        Por quê demora tanto?
        Por quê usa tanta memória?
    Exemplos de uso
        Exemplo básico
        Exemplo com --comment
        Exemplo com --bilingual
        Exemplo com --statusbar
        Exemplo com --search
    Licencia y autor
    Documentação em outras línguas



INSTALAÇÃO:

Para usar instrans, necessita PHP 5 com interface de linha de mandato (command
line interface). (Tal vez instrans funcionaria com PHP 4, mas não o tenho 
provado.)

MS-Windows:
Si você usa MS Windows, baixe php-5.X.X-Win32.zip de http://www.php.net 
Descompacte-lo num novo arquivo onde quer instalar-lo y faz dobre clic em
php-5.X.X-installer.exe. Depois tem que sumar PHP a sua variável PATH para
indicar onde se queda PHP. Em Windows XP, vai a Inicio->Configuração->
Painel de controle->Sistema. Baixo a pestana «Opções Avançadas», faz clic em
«Variáveis de Entorno» y selecione «Path» numa caixa «Variáveis do Sistema».
Faz clic em «Editar» y adicione a senda onde PHP é instalado. Por exemplo, si
PHP é instalado em c:\Arquivos de Programa\PHP5, sua nova Path pode
aparecer como:
    C:\MySQL\Server;C:\ATI;C:\Arquivos de Programa\PHP5

Em sistemas mais velhas, pode trocar a Path em DOS assim:
    $PATH = $PATH + ";C:\Arquivos de Programa\PHP5"    

Depois de instalar PHP 5, baixe y descompacte
www.ciber-runa.net/instrans.zip.  Agora pode utilizar o script instrans.php.

Linux, UNIX, Cygwin, e Mac OS X:    
Usuários de Linux, UNIX, Cygwin, e OS X devem instalar o PHP 5 do repositório
de sua distribuição. Por exemplo, usuários de Debian e seus derivativos podem
instalar-lo assim:
    su            
         [entregue a contracena de root]
    apt-get install php5-cli
    exit

Usuários de Ubuntu usam:
    sudo apt-get install php5-cli
    
Depois de instalar PHP 5, baixe y descompacte
www.ciber-runa.net/instrans.zip  Agora pode utilizar o script instrans.php.


DESCRIÇÃO:

O programa instrans.php insere frases traduzidas de arquivo(s) PO em outro(s)
arquivo(s) PO. Instrans é designado para ajudar tradutores de software em
línguas indígenas que tenham necessidades especiais.  Também pode
ser usado por tradutores fazendo translações trilingues ou por
tradutores que querem inserir translações automaticamente de outra língua.

Instrans permite que o tradutor trata com três línguas á mesma vez num
arquivo PO. Isto é útil quando se traduz línguas em lugares onde inglês não
é o idioma predominante escrito.  Por exemplo, na América Latina y na África
Francesa muitos tradutores de línguas indígenas não podem ler inglês e
necessitam ver as frases em espanhol ou francês.  Instrans também pode ser
usado para inserir frases traduzidas de outra língua quando o tradutor não
queira duplicar o trabalho já feito em outra translação. Por exemplo, muitas
línguas indígenas utilizam muitas frases prestadas de outras línguas,
especialmente no contexto da informática. Tradutores pode utilizar
instrans para inserir as frases prestadas em seus arquivos PO.

Cada objeto PO tem o formato seguinte:
    LINHA-DE-ESPAÇO
    # COMENTÁRIO-DE-TRADUTOR
    #. COMENTÁRIO-AUTOMÁTICO
    #: REFERENCIA...
    #, BANDEIRA...
    msgid FRASE-NO-TRADUZIDA
    msgstr FRASE-TRADUZIDA

Instrans extrai cada msgstr do TRANSLAÇÕES-PO y lo insere no ORIGINAL-PO
(ou opcionalmente no NOVO-PO) onde tem um msgid correspondente.  Si não
tem una msgid correspondente, não insere nada. Si tem mais que um msgid
correspondente, instrans procura o qual tenha um comentário automático o
referência equivalente. Por omissão instrans só insere uma frase PO quando
o msgstr no ORIGINAL-PO não contem nada, mas pode borrar uma msgstr existente
e inserir uma nova frase traduzida com a opção --overwrite.  Também tem opções
para inserir as frases traduzidas como comentários ou frases bilingues ou no
barra de estado.  Ademais tem uma opção --search para procurar frases
correspondentes usadas em outros programas.



FORMATO:

   php instrans.php [OPÇÕES] ORIGINAL-PO TRANSLAÇÕES-PO [NOVO-PO]

Opções:

-m | --msgstr     Inserir as frases traduzidas nos msgstr que não contem nada.
                  Si quer substituir os que contem algo, use a opção
                  --overwrite com esta opção. Si não especifica o tipo de
                  inserção, fará isto por omissão.
                  
-b | --bilingual [=SEPARADOR]   
                  Pegar frases traduzidas ao fim de msgstr existentes para
                  formar frases bilingues. Si tem um msgstr existente, se
                  divide as dois frases por um SEPARADOR que é " * " por
                  omissão. Frases que contem caracteres de nova linha (\n)
                  será separado por outra nova linha em lugar do SEPARADOR.
                  
-c | --comment [=LÍNGUA]    
                  Inserir frases traduzidas como comentários na forma:
                  #  [LÍNGUA] "FRASE-TRADUZIDA"
                  Si não se específica a LÍNGUA, por omissão é o nome de
                  TRANSLAÇÕES-PO.  Pode combinar --comment com todas as
                  outras opções. Si usa --comment com --statusbar, inserirá
                  comentários só em objetos PO da barra de estado na forma:
                  #  [LÍNGUA] MENU: "FRASE-TRADUZIDA"
                  
-s | --statusbar [=FRASE-MENU FRASE-BARRA-DE-ESTADO]
                  Inserir frases traduzidas do menu na barra de estado.
                  Si encontra um comentário automático que contem a
                  FRASE-MENU, procura outro objecto PO com a correspondente
                  FRASE-BARRA-DE-ESTADO e insere a frase traduzida lá.
                  Por omissão FRASE-MENU é "MENU" e FRASE-BARRA-DE-ESTADO
                  é "STATUSBAR". Use esta opção com cuidado. Provavelmente
                  tem que editar á mão o arquivo PO depois.
                    
-o | --overwrite  Substituir frases traduzidas existentes. Sim esta opção,
                  só insere a frase traduzida quando o msgstr não contem nada.  
                  Si insere comentários, esta opção não borra os comentários
                  de tradutor excepto os que tenham a forma:
                  #  [...] "..."
                  
-n | --no-strip   Não eliminar as variáveis C e os signos "&" das frases
                  traduzidas. Por omissão, as variáveis e os signos "&" são
                  eliminados quando se usa as opções --bilingual e
                  --statusbar porque podem causar erros.

-r | --recursive  Processar todos os subdiretórios em ORIGINAL-PO e
                  TRANSLAÇÕES-PO. Esta opção só terá efeito si
                  ORIGINAL-PO e TRANSLAÇÕES-PO são directórios.
                  
-e | --search     Procurar frases traduzidas en qualquer arquivo o diretório
                  em TRANSLAÇÕES-PO. Use esta opção para procurar frases
                  traduzidas de outros programas.

-x | --strip [=CADEIA]   
                  Eliminar a CADEIA da frase traduzida em inserções
                  --bilingual e --statusbar. Si não especifica a CADEIA, os
                  signos "&" serão eliminado. CADEIA pode ser um expressão
                  Perl. Por exemplo, -strip = "/<.+>/"  elimina todos os
                  códigos HTML da frase inserida.
                  
-p | --replace [=PROCURA SUBSTITUÇÃO]
                  Substituir PROCURA por SUBSTITUÇÃO na frase traduzida em
                  inserções --bilingual e --statusbar. Si não especifica a
                  PROCURA e a SUBSTITUÇÃO, variáveis de programação será
                  substituído por "@#@x@#@". Atualmente solo C, Objective C,
                  PHP, UNIX shell, QT, gcc internal, e YCP variáveis são
                  reconhecido.  PROCURA e SUBSTITUÇÃO podem ser expressões
                  Perl. Por exemplo:  -p = "/%([sd])/" "VAR_$1"
                  substitui "%s" por "VAR_s" e "%d" por "VAR_d".
                  
-v | --verbose    Mostrar avisos e mais informação.

-q | --quiet      Não mostrar nenhuma mensagem.

-l | --log [=ARQUIVO]   Desviar as mensagens a um arquivo. Si não
                  se especifica um arquivo, por omissão é "instrans-log.txt".
                  
-f | --interface = XX   Especificar a idioma da interface do usuário de
                  instrans. Por omissão instrans usará inglês si não foi
                  traduzido no idioma de seu locale. Atualmente as únicas
                  opções são "en" , es", e "pt" (inglês, espanhol, e
                  português).

                  
ORIGINAL-PO       O arquivo PO original ou diretório. Si é um diretório vai
                  processar todo os arquivos PO adentro do diretório.

TRANSLAÇÕES-PO    O arquivo ou diretório PO que contem as frases traduzidas
                  que será inserido no ORIGINAL-PO (ou opcionalmente no
                  NOVO-PO).
                  
NOVO-PO           [opcional] Si não quer substituir o ARQUIVO-PO,
                  entregue um novo nome de arquivo para escrever.

                  
Se encerram em aspas os arquivos que contem espaços em seus nomes.
Exemplos:
    php instrans.php "c:\meus documentos\fr-FR.po" es-ES.po "fr-FR 1.po"
    php "c:\meus documentos\instrans.php" -b=" % " es-ES.po fr-FR.po
              
Para ajuda:
    php instrans.php -h | --help | -? | /?

Para mais informação e exemplos de uso:
    php instrans.php -i | --info


NOTAS:

Usando --replace com --bilingual inserções:

Use a opção --bilingual com cuidado e revise o(s) arquivo(s) PO depois. As
frases traduzidas podem conter variáveis. Por exemplo, programas escrito em C
usam o símbolo %s para indicar um string (cadeia de caracteres), %d para
indicar um inteiro, e %f para indicar um número real que possa conter um ponto
decimal. Normalmente frases PO com variáveis C são marcadas com a bandeira:
     #, c-format
Quando faz uma frase bilíngue, vai duplicar o número de variáveis na
frase e isto pode causar erros no programa. Para evitar este problema,
use a opção --replace. Si não se especifica PROCURA e SUBSTITUÇÃO
instrans procura os objetos PO com a bandeira "#, c-format" e encerra os
variáveis em "@#@". Por exemplo, "@#@s@#@" substitui "%s" e
"@#@-10.4f@#@" substitue "%-10.4f".

Si sua versão de PHP é 5.10 ou depois, a opção --verbose provei uma aviso
cada vez que uma variável tem sido substituído. Se aconselha que utilize as
opções --verbose e --log com --bilingual para que tenha um registro das
alterações.

Depois faz uma pesquisa por "@#@" em seu arquivo PO e substitui estas
frases com algo mais apropriado em suas translações. Infortunadamente,
tem muitos idiomas do computador e actualmente instrans somente reconhece
variáveis de C, Objective C, PHP, UNIX shell, QT, gcc interno, e YCP. De
todos modos, no deve confiar-se muito nas substituições e deve revisar
seu(s) arquivo(s) PO depois.


Usando --strip com inserções --bilingual:

Muitas programas usam o símbolo "&" ou "&amp;" em seus menus e janelas de
diálogo para sublinhar o seguinte caracter e fazer uma tecla de acesso direito.
Si a opção --strip é usado sem especificar a CADEIA, instrans eliminará os
signos "&" das frases inseridas. Isto é útil porque um item de menu e um
objeto numa janela de diálogo só pode ter 1 tecla de acesso direito.

Os signos "&" são somente eliminado si o msgstr existente é vazio. Porque "&" é
muito usado para significar "e", somente o elimina si é seguido por um caracter
alfabético ou um numero. Não o elimina si é seguido por um símbolo, um espaço,
ou se aparece no fim de uma frase traduzida.

Si a opção --strip é usado sem especificar a CADEIA, também eliminará os signos
"&" das inserções de --statusbar. Ja que barras de estado não têm teclas de
acesso direito, se aconselha que use --strip com a opção --statusbar.


Opção --statusbar:

A opção --statusbar é muito experimental. Sempre faz copias de reserva de
seus arquivos antes que usar-a. Esta opção só serve com programas que
tem comentários automáticos parecidos do menu y da barra de estado.
Por exemplo no programa AbiWord, cada frase traduzida de menu tem um
comentário automático de "MENU_LABEL_..." y cada frase traduzida da barra
de estado tem um comentário automático de "MENU_STATUSLINE_...".  Em este
caso, pode procurar a correspondente barra de estado e inserir o msgstr
do menu. Sim embargo muitos programas não tem nomes de seus menus e barras de
estado numa maneira parecida e a opção --statusbar não serve bem.  Si
quer borrar o msgstr existente e substituir-o com o msgstr do menu, deve
usar a opção --overwrite.  Si quer inserir-o nos msgstr y nos comentários,
usa as opções --comment com --msgstr.  Pode usar a opção --bilingual com
--statusbar, mas vai pegar o msgstr da barra de estado com o msgstr do menu.

Como nas inserções de --bilingual, a opção --strip sem especificar a
CADEIA, eliminará signos "&" das inserções de --statusbar. Já que barras de
estado não têm teclas de acesso direito, se aconselha que use --strip com a
opção --statusbar. Também pode usar a opção --replace sem especificar
PROCURA e SUBSTITUÇÃO para eliminar variáveis em inserções de --statusbar. As
vezes mensagens na barra de estado contêm variáveis, mas é mais seguro
substituir todas as variáveis primeiro, e logo acrescentar as variáveis
necessárias.


Processando directórios:

Si ORIGINAL-PO e TRANSLAÇÕES-PO são diretórios, instrans processará todos os
arquivos no diretório ORIGINAL-PO com a extensão ".po", ".pot", ou ".pox".
Instrans procurará arquivos de mesmo nome no diretório TRANSLAÇÕES-PO para
inserir as frases traduzidas.  Os arquivos no ORIGINAL-PO que não tenham o
extensão ".po", ".pot", ou ".pox" serão só copiado ao arquivo NOVO-PO sem
inserir nada. Também os arquivos PO no diretório ORIGINAL-PO que não tenham
um arquivo correspondente com o mesmo nome em TRANSLAÇÕES-PO serão só copiado.

Sem embargo, os arquivos em TRANSLAÇÕES-PO que não tenham um correspondente
arquivo em ORIGINAL-PO, não serão copiado. Também, os subdiretórios em ambos
ORIGINAL-PO e TRANSLAÇÕES-PO serão ignorado y não copiado.  Si você quer
processar os subdiretórios, use a opção --recursive.
 
Por exemplo, si você tem os diretórios "es-ES" y "fr-FR" abaixo y quer inserir
as frases francesas nos arquivos PO espanhóis, pode usar o mandato seguinte:
    php instrans.php es-ES fr-FR es-fr
 
Vai produzir um diretório NOVO-PO "es-fr" assim:

ORIGINAL-PO:           TRANSLAÇÕES-PO:         NOVO-PO:           
/es-ES/                /fr-FR/                 /es-fr/                    
      /intro.po              /intro.po               /intro.po  
      /readme.txt            /readme.txt             /readme.txt  [só copiado]
      /main.po               /main.po                /main.po
      /main.c                /main.c                 /main.c      [só copiado]
      /files.pot             /files.pot              /files.pot
      /makelist.po           /different.po           /makelist.po [só copiado]
      /win/                  /win/                                   
          /frontend.po           /frontend.po         
          /search.po             /search.po
                               

Somente os arquivos "intro.po", "main.po", e "files.pot" no diretório "es-ES"
foram processado porque têm uma extensão PO e têm arquivos correspondentes no
diretório "fr-FR" com o mesmo nome. Os outros arquivos em "es-ES" foram só
copiado ao diretório "es-fr" sem inserções. O subdiretório "win" foi ignorado
y não foi copiado. Anota que o arquivo "different.po" no diretório "fr-FR" não
foi copiado tampouco porque não tem um correspondente arquivo em "es-ES".  

Si você que inserir frases traduzidos de qualquer arquivo de diferente nome,
use a opção --search.  Por exemplo, o mandato:
    php instrans.php --search es-ES/intro.po fr-FR intro-mess.po

Vai procurar frases traduzidas em todos os arquivos PO no directório "fr-FR" y
inserir-las no arquivo novo "intro-mess.po". Si quer processar todos
os arquivos em es-ES assim, procurando em todos os arquivos de fr-FR, usa o
mandato:
   php instrans.php --search es-ES fr-FR es-fr  
   
Si você quer procurar no subdiretório "win" também, use a opção --recursive.


Opção --search:

Si você quer inserir frases traduzidos de qualquer arquivo num diretório,
use a opção --search.  Por exemplo, o mandato:
    php instrans.php --search es-ES/intro.po fr-FR intro-mess.po

Instrans vai procurar frases traduzidas em todos os arquivos PO no
diretório "fr-FR" e inserir-as no arquivo novo "intro-mess.po". Si quer
processar todos os arquivos em es-ES assim, procurando em todos os arquivos de
fr-FR, use o mandato:
   php instrans.php --search es-ES fr-FR es-fr  
   
Si quer procurar no subdiretório "win" também, use a opção --recursive.


Erros de Sintaxe:

Si instrans encontra um erro de sintaxe num objeto PO, vai acrescentar-o ao
conto de erros de sintaxe e mostrar-o ao fim de processamento. Em modo
--verbose, instrans mostra mensagens de aviso e o número de linha no
arquivo onde pode encontrar os erros de sintaxe. Em TRASLACIÓNES-PO
os erros de sintaxe são contado, mas não serão escrito ao NUEVO-PO. Si um
erro de sintaxe é encontrado em ORIGINAL-PO i é um problema simples como
uma linha não terminada em aspas, instrans o arregalará ao escrever ao
NOVO-PO.  Si instrans não pode determinar onde ponha um elemento PO em
NOVO-PO, escreverá "SYNTAX ERROR: " e a linha com o erro de sintaxe no
comentário de tradutor do objeto PO mais perto. Si seus arquivos PO têm
erros, se recomenda que use a opção --verbose para que você possa procurar e
corrigir os erros de sintaxe depois.

Por exemplo, si instrans encontra os seguintes objetos PO em ORIGINAL-PO:

 #: po/ap_Id.h.h:283            (Problemas:                                )
 msGiD "Edit"                   (msgid não deve ter letras mayúsculas      )
 msgstr"Editar"                 (falta espaço entre msgstr e "editar"      )
    
 #: po/ap_Id.h.h:281
 msgi "Help"                    (Deve ser "msgid"                          )
 msgstr "Ayuda                  (Linha deve terminar em aspas              )
    
El NUEVO-PO será escrito:

 #: po/ap_Id.h.h:283            (Como problemas são solucionado:           )
 msgid "Edit"                   (Arregalado sem mensajem de aviso          )
 msgstr "Editar"                (Arregalado sem mensajem de aviso          )
    
 # SYNTAX ERROR: msgi "Help"    (Linha é traslado ao comentário com aviso  )
 #: po/ap_Id.h.h:281       
 msgstr "Ayuda"                 (Arregalado com um mensagem de aviso       )
    
Instrans transformará 'msGiD "Edit"' a 'msgid "Edit"' e 'msgstr"Editar"'
a 'msgstr "Editar"' sem emitir um aviso ou contar um erro. Sem embargo no
segundo objeto PO, instrans contará erros de sintaxe e emitirá avisos no
modo --verbose sobre as aspas faltadas em 'msgstr "Ayuda' e a palavra
desconhecida "msgi".  No caso de 'msgstr "Ayuda', instrans acrescentará as
aspas finais automaticamente, mas não saberá que fazer com 'msgi "Help"'.
Vai mostrar um aviso e pôr a linha no comentário de tradutor depois
das palavras 'SYNTAX ERROR: '.    


Valor de devolto:
 
Instrans devolve um valor de 0 si processa sim problemas. Devolve 1-20 si
encontra erros abrindo e escrevendo arquivos ou processando dates. Devolve
20-40 si encontra erros nos argumentos passado por o usuário. Devolve 41-42
no caso da opção --help ou --formato.


Por quê demora tanto?

Instrans pode demorar muito ao processar arquivos grandes. Em minha maquina
gasta 6 segundos processando o arquivo PO de AbiWord que contem 1500 frases
traduzidas, mas gasta muito mais tempo em maquinas mais velhas. Originalmente
instrans foi escrito para ser uma aplicação de web em PHP. Dentro de pouco foi
claro que fora mais eficaz de baixá-lo de internet y utilizar-o em casa.
PHP é bom para servir paginas web, mas processa muito de vagar
quantidades grandes de dates em arquivos. Si isto te molesta muito, sente-se
livre para re-escrever o código numa língua mais rápida.  


Por quê usa tanta memória?

Si processa arquivos PO grandes com milhares de objetos ou usa a opção --search
com muitos arquivos, instrans utiliza muita memória para carregar todos os objetos
PO encontrados.  Por defeito instrans utiliza um máximo de 40MB de memória,
mas pode aumentar-a. Troque o mandato   ini_set('memory_limit', '40M');  
no arquivo "instrans-header.php".



EXEMPLOS DE USO

Exemplo básico:
Uma tradutora de quechua boliviano tem traduzido algumas frases no arquivo
qu-BO.po, mas quer converter as frases não traduzidas a espanhol. Ela descarga
o arquivo es-ES.po i entrega o mandato:

     php instrans.php qu-BO.po es-ES.po

Si qu-BO.po aparece assim:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay"

#  Pode traduzir "Print" como "ñit'isqa"?  Quê é "Layout"?
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

e es-ES.po aparece assim:
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

Então instrans inserirá a frase "Di&seño de impresión", mas não tocará
os outros objectos PO.  O arquivo qu-BO.po será sob-escrito assim:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay"

#  Pode traduzir "Print" como "ñit'isqa"?  Quê é "Layout"?
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


Exemplo com --comment:
A primeira tradutora passa o arquivo PO a outro tradutor de quechua boliviano
que não pode ler inglês, ele quer inserir translações espanholas como
comentários num arquivo novo chamado qu-BO-tras.po:

     php instrans.php --comment="es-ES" qu-BO.po es-ES.po qu-BO-tras.po

O novo arquivo qu-BO-tras.po contenderá:
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
#  Pode traduzir "Print" como "ñit'isqa"?  Quê é "Layout"?.
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


Exemplo com --bilingual:
Muita gente que fala quechua não são acostumado a ler-lo e necessita
ver a tradução em espanhol ao lado do quechua. Os tradutores decidem
fazer uma versão bilíngue do programa.  As frases quechuas serão separados
das frases espanholas por " ][ ".  As opções --strip e --replace são usado
para quitam qualquer signo "&" ou variável que possa causar erros. As
opções --verbose e --log são usado para que os tradutores tenham um
registro de cada lugar onde as variáveis havia sido substituído por
"@#@x@#@".  Depois eles podem revisar o arquivo PO e borrar os
"@#@x@#@".

   php instrans.php -v --log --strip --replace --bilingual=" ][ "
       qu-PE.po es-ES.po qu-es-PE.po
   
O arquivo qu-es-PE.po conterá:
------------------------------------------
#. MENU_LABEL_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:285
msgid "&Open"
msgstr "&Kichay ][ Abrir"

#. MENU_STATUSLINE_FILE_OPEN
#: po/tmp/ap_String_Id.h.h:1692
msgid "Open an existing document"
msgstr "Kasqaña documentota kichay ][ Abrir un documento existente"

#  Pode traduzir "Print" como "ñit'isqa"?  Quê é "Layout"?
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
"\n¿Desea guardar los cambios al documento %s \nantes de cerrar?"
------------------------------------------

O separador " ][ " não é inserido antes da frase "Di&seño de impresión"
porque o msgstr não contem algo. As dois frases em Msg_ConfirmSave são
separados por um caracter de nova linha (\n) em lugar de " ][ " porque o msgstr
já contem uma nova linha. Em este caso a janela de diálogo se expande por
o tamanho do mensagem, mas em outros casos o tamanho da janela é fixado e uma
translação de linhas múltiplas não é possível. Tem que verificar cada janela de
diálogo para ver si cabe a frase bilíngue.
 
Porque o msgstr de MENU_LABEL_VIEW_PRINT não tem um signo "&" (símbolo de
aceso direito), o "&" não é quitado da frase inserido "Di&seño de
impresión", mas no caso de MENU_LABEL_FILE_OPEN, o msgstr já tem um "&".
Por isso, "&" é quitado da frase "&Abrir" antes que inserir-la.


Exemplo com --statusbar:
Os tradutores quechuas não gostam dos menus bilingues porque são muito
grandes e incómodos. Por isso eles decidem pôr as translações espanholas
dos menus na barra de estado. Si um usuário não sabe o que significa
um menu pode mirar abaixo na barra de estado. Eles usam a opção --overwrite
para borrar e substituir os msgstr existentes.  As opções
--strip e --replace são usado para quitar qualquer signo "&" e variável que
possam causar problemas.

 php instrans --strip --replace --overwrite --verbose
    --statusbar="MENU_LABEL_" "MENU_STATUSLINE_"
    qu-BO.po es-ES.po qu-BO-prueba.po

Então o arquivo novo qu-BO-prueba.po conterá:
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

#  Pode traduzir "Print" como "ñit'isqa"?  Quê é "Layout"?
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
    
Agora quando o ratão passa sob Abrir no menu Arquivo, o usuário deste
software vai ver "Kichay" no menu e "Abrir" na barra de estado.


Exemplo com --search:
Os tradutores bolivianos decidem traduzir um programa novo ao quechua, mas
o programa ainda não tenha traduzido em espanhol.  Não tem um arquivo PO
onde podem sacar as frases espanhóis.  Sem embargo, eles observam que outros
programas tenham sido traduzido em espanhol i esses outros programas têm
muitas das mesmas frases como seu programa novo.  Querem inserir essas frases
sacado de muitos programas nos comentários no novo arquivo qu-es.po.
Eles coletam todos os arquivos PO de esses programas no diretório
"es-muchos" i em seus subdiretórios i entregam o mandato:

   php instrans.php -c --search --recursive qu-BO.po es-muchos qu-es.po

   
LICENCIA E AUTOR   
   
---***---
Licencia:  Atual versão de GNU Licencia de Proteção Geral Menor (LGPL)
           que pode ler em: http://www.gnu.org
Autor:     Amos Batto (amosbatto@yahoo.com)
Criado:    22 Jun 2006, Última atualização: 20 sep 2007

Este script foi escrito como parte do projecto www.ciber-runa.net
para ajudar gente criar traduções de software em línguas indígenas.

Por favor mande reportagens de erros em instrans.php ou suas sugestões a
amosbatto@yahoo.com para que eu possa melhorar o programa. Obrigado.
---***---


DOCUMENTAÇÃO EM OUTRAS LÍNGUAS

Versões deste documento:
readme-en.txt  readme-en.html (English)
readme-es.txt  readme-es.html (español)
readme-pt.txt  readme-pt.html (português)

Porque instrans é designado para ajudar tradutores que não possam ler inglês
estamos procurando gente que possa traduzir este programa em outras
línguas. Especialmente necessitamos uma tradução francesa.

---------------------------------------
Nota: Si você no pode ver todo este documento em MS-DOS, necessita
aumentar o "Tamanho do búfer de tela" na pestana "Layout". Pode encontrar-o
baixo "Propriedades" no menu [c:\] á esquerda acima da janela de MS-DOS.
