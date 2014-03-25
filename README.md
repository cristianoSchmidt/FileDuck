FileDuck
=========

FileDuck é um framework PHP para compilação e gerenciamento de arquivos.

Funcionalidades:

  - Unificação de arquivos
  - Minificação de Javascripts e CSS ( [YUICompressor][1] )
  - Internacionalização
  - Controle de cache ( ETag | LastModified | Expires | MaxAge )


Exemplos de utilização
--------------

**Utilização Basica**

```sh
<?php

require_once __DIR__ . '/../FileDuck.php';

//Sobrescrevendo do arquivo config.php em tempo de execução
$config = array();
$config['provider'] = 'array';
$config['lang'] = isset($_GET['lang'])  ? $_GET['lang'] : 'pt_BR'; // Definindo linguagem via QueryString

$fileDuck = new FileDuck( $config );

$fileDuck->add( __DIR__ .'/js/example.js' );
$fileDuck->add( __DIR__ .'/js/example2.js' );

//( text/javascript | text/css  | text/plain | etc..)
$fileDuck->renderFile( 'text/javascript' ); //Renderizando o a saida com MimeType text/javascript.

```
**Internacionalização**

Arquivo original pre compilação com as tags de internacionalização 
```sh
function alertMsg ( )
{
   var msg = document.getElementById('msg').value;

   alert( '_[[Hello world]]' );
   alert( '_[[Message: $msg$]]' );
}
```

Arquivo compilado que sera entregue ao cliente
```sh
function alertMsg ( )
{
   var msg = document.getElementById('msg').value;

   alert( 'Ola mundo' );
   alert( 'Mensagem: ' + msg );
}
```

Notas: 
  - Strings contidas entre os tokens *_[[*  *]]* serão internacionalizadas
  - Variaveis contidas entre o token *$* serão reescritas com o token trocado pelos operadores de concatenação configurado
    

Configurações
-------------

    'cacheModel' => 'MaxAge', // Modelo de cache a ser utilizado (  NONE | ETag | LastModified | Expires | MaxAge )
    'cacheExpireTime' => '43200', // Caso utilize cache Expire. 43200 Minutos = 30 Dias
    'cacheMaxAgeTime' => '2880', // Caso utilize cache MaxAge. 2880 Minutos = 2 Dia
    'cacheFolder' => '/tmp/fileDuck',
    'debugFile' => '/tmp/fileDuck/debug.log', 
    'debug' => false, 
    'lang' => 'pt_BR', // Linguagem padrão
    'tokens' => array('_[[' , ']]' , '$' ), // Tokens de inicio  , fim , variavel
    'wrapVarTokens' => array( '+' , '+' ), // Operador incio , fim;  Usado para envolver variaveis
    'YUICompressor' => false, // YUICompressor
    'requireQuotes' => false, // Traduções obrigatoriamente nescessitam estar envolvidas em aspas
    'provider' => 'array' // Provedor de internacionalização
    'environment' => 'dev' // ( dev | prod )

License
----

[GLP][2]

[1]: http://yui.github.io/yuicompressor/
[2]: http://www.gnu.org/copyleft/gpl.html