<?php

add_action( 'wp_enqueue_scripts', 'bam_enqueue' );
add_action( 'admin_enqueue_scripts', 'bam_enqueue_admin' );

function bam_enqueue() {

    $version = BAM_VERSION;
    $js_file = 'bam-script.min.js';
    if ( current_user_can('administrator') ) {
        $version = time();
        $js_file = 'bam-script.js';
    }

    // Stylesheets
    wp_register_style(
        'bam-style',
        BAM_URL . '/style.min.css',
        [],
        $version,
        'all'
    );

    // Scripts
    wp_register_script(
        'bam-script',
        BAM_URL . '/assets/js/' . $js_file,
        ['jquery'],
        $version,
        true
    );

    wp_enqueue_style('bam-style');
    wp_enqueue_script('bam-script');

    wp_localize_script(
        'bam-script',
        'bamGlobals',
        [
            'baseURL'       =>  get_site_url(),
            'ajaxURL'       =>  admin_url('admin-ajax.php'),
            'bamJsonURL'    =>  BAM_URL . '/inc/google-map/json/bam-map-data.json',
            'hpJsonURL'     =>  BAM_URL . '/inc/google-map/json/hp-map-data.json',
            'iconURL'       =>  BAM_URL . '/img/icons/',
            'nonce'         =>  wp_create_nonce('bam_nonce'),
        ]
    );


}

function bam_enqueue_admin() {

    // Stylesheets
    wp_register_style(
        'bam-style-admin',
        BAM_URL . '/assets/css/bam-style-admin.css',
        [],
        time(),
        'all'
    );

    // Scripts
    wp_register_script(
        'bam-script-admin',
        BAM_URL . '/assets/js/bam-script-admin.js',
        [],
        time(),
        true
    );

    wp_register_script(
        'google-maps',
        'https://maps.googleapis.com/maps/api/js?key=' . BAM_GMAP_API_KEY . '&v=weekly',
        [],
        '1.0',
        true
    );

    wp_enqueue_style('bam-style-admin');
    if ( get_option( 'bam_activate_map') === '1' ) {
        wp_enqueue_script('google-maps');
    }
    wp_enqueue_script('bam-script-admin');

}