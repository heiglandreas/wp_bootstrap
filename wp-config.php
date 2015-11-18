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
define('DB_NAME', 'wpcomposertest');

/** MySQL database username */
define('DB_USER', 'wpcomposertest');

/** MySQL database password */
define('DB_PASSWORD', 'wpcomposertest');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('ABSPATH', __DIR__ . '/wp/');
define('WP_SITEURL', 'http://development.local/wpcomposertest/wp');
define('WP_HOME', 'http://development.local/wpcomposertest/');
define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
define('WP_CONTENT_URL', 'http://development.local/wpcomposertest/wp-content');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'c)-` D_3OcuY$O|:rf|q?R+K[G[FPMSK5]?<HHlkn@*3/@icyOA{{r!r58^6tB~#');
define('SECURE_AUTH_KEY',  '*+8z$Y&|RM.0QUUu+Rg^IAo}$>OQsQ>qK+/t*C=Q(DtCxu@%ZZn[y01${#a6GT-^');
define('LOGGED_IN_KEY',    'TY!9kRv)$dMH6)Dkqywi{C1L/jN|O>*wZCio5.e[(%Kx/-s@#k<i70C)q|JXX?1M');
define('NONCE_KEY',        '3Fzb9n[g-,,$%=u4LwE<(yA!QpJ8?kB+e{QCM_3EOaifvVv:yOs]Zgi<7qRf/}2j');
define('AUTH_SALT',        '~;{ {-uv(ChS/@JO~OXeFI}Jd:mWvi~|dkSS<rGE9>V:([R=i_Fkk R4rA^|Zfq<');
define('SECURE_AUTH_SALT', 'bbcv Rp.As:*JQjNZ2|-r)<3UgzhY5<Wl[`&6]6M9$DuDofN-7M;|v>C^KDNh.(c');
define('LOGGED_IN_SALT',   ' 8Rw#.hh R|w>Gc~Z=mEy73n.+CI|;+0~~Qx.|Nj`qo5oc_]UT<l-#(^[zN6zK-)');
define('NONCE_SALT',       'y/OK4YjiMmh?-!tg!YqEVU1OLIs;:#6a+ x1|7fge%)`:yzMMw-+?<-70d|+bJpn');

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
