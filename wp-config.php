<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'eedomestico01');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'eedomestico01');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '9T0NDn4qtT');

/** nome do host do MySQL */
define('DB_HOST', 'mysql.eedomestico.com.br');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'N<=jE[G-(~k=*U$H9H@{7^wwdRjsgJf-Ky/v8@+O%z^Mvr+9U%HI>tVL.oqxvO2,');
define('SECURE_AUTH_KEY',  '>NeyuYl**r5<idG+!h|XLU3J=?|#!>vDB8<iFsJh4ZD2}KlhSW$;M}kfSAAv@yRv');
define('LOGGED_IN_KEY',    'bw7Zh9>f-P)ds;0g7`=mERbC/]oV>&c_r~-&A!I; 2$8*wl`Ji6O dMl{>OEfM5#');
define('NONCE_KEY',        'FA^.[~25+SQ*( Lox>KZg}NBV]P~D}C^>k}bnwxF&hd Wc|r!z|-h`y_)4<zOV>`');
define('AUTH_SALT',        '{,o!zrJm|gd#y-I$_T*$5Y;0I|Xe!YH6>wtFY##iq@_hXG$6;6_BRkPz+FqVU]BG');
define('SECURE_AUTH_SALT', '}^:b(QWQ|dz?VPX9Ak+8F6p[V3C]yCeM`&(t++$P:obW 5C(u@]klrq =VpMtQ` ');
define('LOGGED_IN_SALT',   'fYjWg%z,|Y1@-Q*;XFd><39sdRRN&ebYE<aL!;.Bhkg8xno5+,w^!YaIST@{Q`|&');
define('NONCE_SALT',       '#7s!TC)>S3]@=p{^89M(1{.CpOaG66HaG;:fxf_e^Mn6X0G4j=40Swgm?irS2r1_');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = '3fsvc_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
