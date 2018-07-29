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
define('AUTH_KEY',         '%bMtE(h@pNf/~c{;prg}Bi>n|^3j7s3Vu/^lxb~><sd[M+@NBTQF:Ow0lCuLFd@8');
define('SECURE_AUTH_KEY',  'To&9)v$ KJ([|iD#J>~ePy8)Q*f?FE7F<9JB<SgdOEJ-ij6fur8~X1lxU*~J*_24');
define('LOGGED_IN_KEY',    'ht_jkbc/X+B8+<Q,0,O.%P1E*f94<;M.j<]x2z%D}Z%@Q3!h%]uZZRD&GY1$2d,u');
define('NONCE_KEY',        '=(SjL:sAo0xV]VW>sEI$eB*z+I08j3*Y6yo)vAC?w;@W90SQPIzt0Ah0o835.Y*a');
define('AUTH_SALT',        'e0m.$MiiTf8F-z#[06rXQwLi=J]z6$#K`ehAkl-[M|9PgN(<^X%Oi`7,s|xCM)*U');
define('SECURE_AUTH_SALT', 'Sn*v#sZ45:*YGp.-jewp-IE+),q .Uo;AM1FDv]L7?GLM-#:@+Vg%;Y/_S&^`u-8');
define('LOGGED_IN_SALT',   'JJEq|, @<dCpAPIInVwo!(:7 cIzV9f5zr=52xWVDieE1MRe=rj{32l_{7Y4tpoV');
define('NONCE_SALT',       'f#f(2Y<YSi_ll5A23z2V:>9nC*ii{kcX6=3C@urnF9U;>9UH;hkYXkWYJ[ jm^hl');

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

define('WP_MEMORY_LIMIT', '128M');
