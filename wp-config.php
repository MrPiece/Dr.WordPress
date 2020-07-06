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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'medical-order' );

/** MySQL database username */
define( 'DB_USER', 'mysql' );

/** MySQL database password */
define( 'DB_PASSWORD', 'mysql' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '=SPiY2k;]y*oKZhmi#/<Qu.<VZG0WG?d,-PwzlCVd{X-NQ#F.BfoNbQ745lEtlT`' );
define( 'SECURE_AUTH_KEY',  'w)rDE5s|n~}@eK;8m.}B83uAAc$r2xk=Z_{Q`^wx`fD:~aD9DH;-Z,QLvD^[mz(@' );
define( 'LOGGED_IN_KEY',    'JD4+%Y5G4PN#%l17TJ/aVCGS97UpmN68^38vr2%`pQ>~r<G:0KAIHW?(=DQ`/6)8' );
define( 'NONCE_KEY',        '-hk*7_#_!PUKo!|P(ZT1.+-]v33qkxAcy=P7!@:|7ZA)0vrT?K_0xZZjfg-dr#T.' );
define( 'AUTH_SALT',        'A;#DYIr94(Il%~8!-}&4*ywlj$0J0y?4,w/hc(:-J@{~%,U-B hkO?c*eAinqU;#' );
define( 'SECURE_AUTH_SALT', '%0zf.#r-6(op@8|{Ax~-EQ1N[}Z:`P/A>u/O(kC bn2> ;9k&8BvJcn>N6]J4y0X' );
define( 'LOGGED_IN_SALT',   'k}RoA*df#1V(-Ca.d[Q;f-l-l#0vA+gJ,&L[6}~L%<f3AA?sultzty,}yF$`vT4Z' );
define( 'NONCE_SALT',       'zvpzchDSSJL>j0MBT99GhC&M79*n=^>a-KHo_B:;5R>Ke?Qc;-Yd?sm.FY]FiC!;' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define( 'UPLOADS', get_home_url() . '/wp-content/uploads/2020/06/' );