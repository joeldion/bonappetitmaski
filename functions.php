<?php 

setlocale(LC_ALL, 'fr_CA');

/*
 * CONSTANTS
 */

// Theme Directory Path
defined( 'BAM_DOMAIN' ) or define( 'BAM_DOMAIN', 'bonappetitmaski' );

// Theme Directory Path
defined( 'BAM_DIR' ) or define( 'BAM_DIR', get_template_directory() );

// Theme Inc Path
defined( 'BAM_INC' ) or define( 'BAM_INC', get_template_directory() . '/inc/' );

// Theme Directory URL
defined( 'BAM_URL' ) or define( 'BAM_URL', get_template_directory_uri() );

// Theme Version
defined( 'BAM_VERSION' ) or define( 'BAM_VERSION', '1.5.1' );

defined( 'BAM_GMAP_API_KEY' ) or define( 'BAM_GMAP_API_KEY', 'AIzaSyDstOhGvliYV88yU24zUUNxDDA0sKzV6ng' );

// Municipalités
defined( 'BAM_MUNI' ) or define( 'BAM_MUNI', 
    [
        'Charette',
        'Louiseville',
        'Maskinongé',
        'Saint-Alexis-des-Monts',
        'Saint-Barnabé',
        'Saint-Boniface',
        'Sainte-Angèle-de-Prémont',
        'Saint-Édouard-de-Maskinongé',
        'Saint-Élie-de-Caxton',
        'Saint-Étienne-des-Grès',
        'Sainte-Ursule',
        'Saint-Justin',
        'Saint-Léon-le-Grand',
        'Saint-Mathieu-du-Parc',
        'Saint-Paulin',
        'Saint-Sévère',
        'Yamachiche'
    ]
);

// Theme Support
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support( 'html5', [ 'search-form' ] );
add_theme_support('menus');

/*
 * INCLUDES
 */
require_once( BAM_INC . 'enqueue.php' );
require_once( BAM_INC . 'login.php' );
require_once( BAM_INC . 'detect-ie.php' );
require_once( BAM_INC . 'image-sizes.php' );
require_once( BAM_INC . 'content-loop.php' );
require_once( BAM_INC . 'clean-admin-menu.php' );
require_once( BAM_INC . 'settings/settings-init.php' );
require_once( BAM_INC . 'prod/prod-init.php' );
require_once( BAM_INC . 'resto/resto-init.php' );
// require_once( BAM_INC . 'google-map/get-markers-data.php' );
// require_once( BAM_INC . 'google-map/update-json-data.php' );
require_once( BAM_INC . 'google-map/google-map-init.php' );