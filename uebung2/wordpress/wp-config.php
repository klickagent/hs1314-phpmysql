<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'rootpw');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-$p{l+pa.y`mB6+!LC*/`GNF1ECgU+{Krqcwp*zHC_ g>|}8#9~:Pd(9gat-FIuU');
define('SECURE_AUTH_KEY',  'M-?^/RML}VM(cd)w-k?F:*RLFE)K-$s$e213[knC[T|CsBTFk-xBTUt+m^2$ENnK');
define('LOGGED_IN_KEY',    's1gg_.if=;+`.Vve|esYo+EL1G#UR:=7I{p|SOueC-mS36L@Pe4*xB/ew<]agxc6');
define('NONCE_KEY',        '+%rc8BIStm@(dJBUZd>ZpK-}Ok2RKp&<gM.r%7Rt+hD8zv6tN+V,J]tvA[*o[@5y');
define('AUTH_SALT',        '&,%_7}{`Weu+1&-<&>VUSsXre[^h/|1+v8`.7J+:7)tlbzU,D-wzaD0/9SUVn[*A');
define('SECURE_AUTH_SALT', '&X8k!1 0dC#MeEK,+@F^)BuISxsK`BUa)fxHvf7|Iv#mP<q#Zve.d% v2eOo}`=&');
define('LOGGED_IN_SALT',   'N>Y^e?kRuk>e/I8_fTukbLTS3?]aB?]kb/|QY-AT) x<~Rkxq--5j(Dvj)9J|XT;');
define('NONCE_SALT',       'o=X?0&Z&&!4-ae!-KYV4gXVb&91#t>7S:2u|lHZKw7r uM!zYnK|p2_o$Vord@Ze');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
