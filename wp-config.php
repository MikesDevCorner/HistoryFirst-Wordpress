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
define('DB_NAME', 'd02d7d63');

/** MySQL database username */
define('DB_USER', 'd02d7d63');

/** MySQL database password */
define('DB_PASSWORD', 'LMrbL4K6pfBVJzDrcBJk');

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
define('AUTH_KEY',         ']d{;f=;aEXuS<1JUEE4,Mbcq(gc]Qj_/VtELHo`8Q#}`SpdT>:zR}cj+V_rk)`Oa');
define('SECURE_AUTH_KEY',  'rM/a.oJUKZ;F?`$4B&qmKVxdZ4`l&s[28,_<f?bqES`0$q|<]i1aTqs<_K|2a/ss');
define('LOGGED_IN_KEY',    'kx<V>HW__|X3O4kFILEl-5QW;4B]T(9tjrMT@|Va:h|r`!Es:/]DMXPc}lDl1E5{');
define('NONCE_KEY',        '/L[v6G]xdXx8i1;|wqY}Uh1_:x*+^!4L1UGox*-[6n2p?<WM<nW@JD#lc1W|OrX8');
define('AUTH_SALT',        '}v4cM!.-XcdN?36JfNhs]v.uxnxlGg=g,/&9K#2zzJi^AtG3j5lJ:64i!faj}u8_');
define('SECURE_AUTH_SALT', 'a-iS(HasPR@@4EFk%Gdox-brjDb?,mziWW{&tt0M9`H|jiJQephI=NOdvo(EV(-<');
define('LOGGED_IN_SALT',   'Lhp>}/R&mU}qcbgzSVhCprlV[&(myz=9U`wRF:C23,[Uv%A>J+]|1CH-RbZmLy,M');
define('NONCE_SALT',       'hr({3@I}H*S8bBn_k/k.2!F`:wW3eHuA/gFc=Zr7ccr#UA?$1f}59pkj6{8Tg?|l');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 's1s1j_';
define( 'WP_POST_REVISIONS', 10 );

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