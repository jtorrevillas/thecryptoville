<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'thecryptoville');

/** MySQL database username */
define('DB_USER', 'mysqldev');

/** MySQL database password */
define('DB_PASSWORD', 'mysqldev1');

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
define('AUTH_KEY',         'HsARY:WHQZ-/Ni.}EUaN#]+IIUtN/UdkuQ/XM4[!i0Isg&f&0(]*U];d~/y|aY6c');
define('SECURE_AUTH_KEY',  ' :o@f0`RL|;=`N@T5OYmTyMzb8mCzT>?#D,~3[pRt~N2}Z/k*b}D^rt@JqDVd3q4');
define('LOGGED_IN_KEY',    '?=2U*QSlXQ7?Xb$` Hd@PB*uBk7JK%_u7kHib+(5qW?^^(XbkHFSeI#GMln.xhoU');
define('NONCE_KEY',        'b_L$]{ @A;%cMn^a2eTY7!*g2ioBgvOkJ(:zw~:,jKTFK5<phRvRCq0*hz7Y)p`1');
define('AUTH_SALT',        'sAz#gqT0b9m9x2+<wW`{+%<bdQQ6.h%rK4[S_BA M<-jD[~FC:6^a2ew]IC%!yEa');
define('SECURE_AUTH_SALT', 'Q5JSn@J?r`:2,A/wWhdiIXT8YZ# dr23<{x+KPrGeOy30r:%{Ne<2-Jp!jfxP,^*');
define('LOGGED_IN_SALT',   '?Z6|]T#H9L}M8o5w<noi35Y?Md[y/+U@?~q@o:,G%a/,Pnvg<@-aAwu<.te)pa0H');
define('NONCE_SALT',       '>,cy@A0%_#gg]Y:1rt/V7H|qdTQW;V?1Ui>tyM`gto4={:D?>t_i{`j$4lm{;vMg');

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
