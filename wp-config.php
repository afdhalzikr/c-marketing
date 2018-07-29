<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'solokradjo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '<Wog$ioQ{N<Dlgq`Th:p{bUY|%`)Qip>-6K}1y^{GWR6kuxwlG#:)p6@r Bx%50)');
define('SECURE_AUTH_KEY',  'ho,M~_C8UIZ-|*Z^CT!Z/[6Z_`&F@yvvgf&3!Re`,@E{IivBhC*1)4L8M{Ec`eO:');
define('LOGGED_IN_KEY',    '#<pCbQ{@&I?DR6vS@X6[G&#LzEyRJ^kc!z#0TVOk-|1.o3y)lGhj7CeVRH~V)#<B');
define('NONCE_KEY',        '`#p&C>-_[g8!8N)$QO+F9=d:$SiQobJ$3Gk+*!4J &jtNI!mdXfAM ::.n~#2^7F');
define('AUTH_SALT',        'FT%+g|O@uotw+$b:|k2i+p:.G8}oP},]j5lW|{jY<wg+cdwyx~(E#P`c&@71)&|?');
define('SECURE_AUTH_SALT', ']|=,R<%SY4k]FL.$bF%HdDlT?l2r!bpi~^+Z,5e^|!x^bdn@`|MibHy9j]?D%5)w');
define('LOGGED_IN_SALT',   'MSddxnx@6N/9g.!(xAm5>h??<fDCW;aCMR<l?G#G[[%|@-B&_JX>4j3;V;Ag_Wv&');
define('NONCE_SALT',       'dRL(~k5%eO9,IL^=BUBUjh&Ut#au_j{=|/8#2|[7/:r t_;O4#sw|2r=[*nk98Df');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
