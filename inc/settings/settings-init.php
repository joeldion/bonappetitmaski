<?php 
/*
 * Settings
 */

add_action( 'admin_menu', 'bam_settings_admin_menu' );
add_action( 'admin_init', 'bam_settings_init' );

function bam_settings_admin_menu() {

    add_menu_page(
        'Paramètres',
        'Paramètres',
        'manage_options',
        'bam-settings-page',
        'bam_settings',
        'dashicons-admin-generic',
        5
    );

}

function bam_settings() {
    ?>
    <h1>Paramètres</h1>
    <hr>
    <div id="bam-settings">
        <form action="options.php" method="post">
            <?php
                submit_button();
                do_settings_sections( 'bam-settings-page' );
                settings_fields( 'bam-settings' );
                submit_button();
            ?>
        </form>
    </div>
    <?php
}

function bam_settings_init() {
    require_once( BAM_INC . 'settings/sections/section-menu.php' );
    require_once( BAM_INC . 'settings/sections/section-intro.php' );
    require_once( BAM_INC . 'settings/sections/section-prod.php' );
    require_once( BAM_INC . 'settings/sections/section-resto.php' );
    require_once( BAM_INC . 'settings/sections/section-map.php' );
    require_once( BAM_INC . 'settings/sections/section-contact.php' );
}