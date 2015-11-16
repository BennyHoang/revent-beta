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
define('DB_NAME', 'u626729560_reven');

/** MySQL database username */
define('DB_USER', 'u626729560_reven');

/** MySQL database password */
define('DB_PASSWORD', '3mNMapVmqY');

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
define('AUTH_KEY',         'Y5c7cgxyhU236KDByUZA7KxXfDskKWCr6ZuZrqEf5fjsgSQvzoL5Ey6Ll8o8KD1E');

define('SECURE_AUTH_KEY',  'dGFAPIn8DKMsrb4cCrSAZYdm3qlCQA49K4fE20pnYc40LHnFfgYIyXzRg4WEh42S');

define('LOGGED_IN_KEY',    'c9keegTUsI83rgXXUvL6DdZEUeHpzsOTDcT92f2oYuhXxFhsfEyuKSbVJZrpDmqy');

define('NONCE_KEY',        '6rrwmyRU8LCQO1R0TyeMOrvb1eG27C4zHDJbgQUyEOrqHwRafy9r1IloCnyBI36e');

define('AUTH_SALT',        'y0ZwrGlNJWV0bsG6OSjRxZiBlkg61XfUiu4Phiq30YqcAl0XYavdxIDxJUWWTGOM');

define('SECURE_AUTH_SALT', 'FB9egrjp0VlIM04iD2A5WbE7kCFXLcmC0LJ6InjfeAgbU8RNPr1MxkYuirQ0kFT3');

define('LOGGED_IN_SALT',   'WZZs3CdulIVJ3CA4qQ3CMb3DO4VGf8E304xe9J74pPn30RQTAIaF3hgvEybx9j7s');

define('NONCE_SALT',       'gRDsRSBr4R9UnBNlhkUD4L0Yp18z9TUjoWeSrxBu6EgsiLC8CABvxdOW1iu0IL5p');



/**

 * Other customizations.

 */

/*
define('FORCE_SSL_ADMIN', false);

define('WP_HOME', 'http://universellutvikling.com/news');
define('WP_SITEURL', 'http://universellutvikling.com/news');

/*update_option('siteurl','http://www.revent.no');
update_option('home','http://www.revent.no');*/

define( 'UPLOADS', 'wp-content/'.'opplastninger' );

/*
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

*/

/**

 * Turn off automatic updates since these are managed upstream.

 */

define('AUTOMATIC_UPDATER_DISABLED', true);



/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'osod_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */





/*Endre media labels*/

    define ( 'RTMEDIA_MEDIA_SLUG', 'media' );
    define ( 'RTMEDIA_MEDIA_LABEL', 'Galleri' );
    define ( 'RTMEDIA_ALL_SLUG', 'all' );
    define ( 'RTMEDIA_ALL_LABEL', 'Alle' );
    define ( 'RTMEDIA_ALBUM_SLUG', 'album' );
    define ( 'RTMEDIA_ALBUM_PLURAL_SLUG', 'albums' );
    define ( 'RTMEDIA_ALBUM_LABEL', 'Bildalbum' );
    define ( 'RTMEDIA_ALBUM_PLURAL_LABEL', 'Album' );
    define ( 'RTMEDIA_UPLOAD_SLUG', 'upload' );
    define ( 'RTMEDIA_UPLOAD_LABEL', 'Last opp' );
    define ( 'RTMEDIA_GLOBAL_ALBUM_LABEL', 'Ikke legg i album' );
    define ( 'RTMEDIA_PHOTO_SLUG', 'photo' );
    define ( 'RTMEDIA_PHOTO_PLURAL_SLUG', 'photos' );
    define ( 'RTMEDIA_PHOTO_LABEL', 'Bilde' );
    define ( 'RTMEDIA_PHOTO_PLURAL_LABEL', 'Alle bilder' );
    define ( 'RTMEDIA_VIDEO_SLUG', 'video' );
    define ( 'RTMEDIA_VIDEO_PLURAL_SLUG', 'videos' );
    define ( 'RTMEDIA_VIDEO_LABEL', 'Video' );
    define ( 'RTMEDIA_VIDEO_PLURAL_LABEL', 'Videoer' );
    define ( 'RTMEDIA_MUSIC_SLUG', 'music' );
    define ( 'RTMEDIA_MUSIC_PLURAL_SLUG', 'music' );
    define ( 'RTMEDIA_MUSIC_LABEL', 'Musikk' );
    define ( 'RTMEDIA_MUSIC_PLURAL_LABEL', 'Musikk' );
    define ( 'RTMEDIA_DOCUMENT_SLUG', 'document' );
    define ( 'RTMEDIA_DOCUMENT_LABEL', 'Dokument' );
    define ( 'RTMEDIA_DOCUMENT_PLURAL_LABEL', 'Dokumenter' );
    define ( 'RTMEDIA_PLAYLIST_SLUG', 'playlist' );
    define ( 'RTMEDIA_PLAYLIST_LABEL', 'Spilleliste' );
    define ( 'RTMEDIA_PLAYLIST_PLURAL_LABEL', 'Spillelister' );
    define ( 'RTMEDIA_OTHER_SLUG', 'other' );
    define ( 'RTMEDIA_OTHER_LABEL', 'Annet' );
    define ( 'RTMEDIA_OTHER_PLURAL_LABEL', 'Annet' );
    define ( 'RTMEDIA_FAVLIST_SLUG', 'favlist' );
    define ( 'RTMEDIA_FAVLIST_LABEL', 'Favorittliste' );
    define ( 'RTMEDIA_FAVLIST_PLURAL_LABEL', 'Favorittlister' );
    define ( 'RTMEDIA_USER_LIKES_LABEL', 'Like');
    define ( 'RTMEDIA_USER_LIKES_PLURAL_LABEL', 'Liker');









/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('DISABLE_WP_CRON', false);
