<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'buzzer' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'nm$!-Vd8mVQ*DhJr<rr5JAaavDE0XPTM~#>=;+h_lTN&5/]`3i[g=ik.J3=7ItRC' );
define( 'SECURE_AUTH_KEY',  'RxRR=,c4R|Cc9j#54`^noBN~T,^u(D5DG:%(/uBK~D-3}mn5]M{N)cU?R-MY}`js' );
define( 'LOGGED_IN_KEY',    '8qH&%XwIeOiF-DcD? (6`oeP7)=@1BXpijF`s(BrOa$CtAyLxT9CG>f|X$Kf_FXL' );
define( 'NONCE_KEY',        '9<l#b^NDyA}q Uk[(?,S.0A(!#Y9% ;yJC:SMBAM$qL)gM8*3F;56TnyORFeiu&9' );
define( 'AUTH_SALT',        'dm{*553]E}=1s,5+-ULn:/aOvBj D>9N`=CVe ^v,-Hk6PVY=EI5*BB:c$SZpC4L' );
define( 'SECURE_AUTH_SALT', '!Z)Nw$%bb+L`=p]1-K+.5E!qjLf&maXWB|`LIR}>_M6l1uexw!Ja!C;@DEg)!DgG' );
define( 'LOGGED_IN_SALT',   '$|g)$r!~q(zFI+2_?kbp~zC)n}x]v@-&2m/GaO%+lp><Y=DQFjZO7z3UN8~axU-~' );
define( 'NONCE_SALT',       'A&}^5a~O=Y/}$_DvJ@hOKz<(iOeC9=.p9uy.<r@0hjqPCj9TNRZgso^!]9O/d!yP' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
