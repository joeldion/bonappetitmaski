<?php 
/*
 * Setting: Map
 */

add_settings_section(
    'bam-settings-map-section',
    'Carte',
    'bam_map_settings_section_callback',
    'bam-settings-page'
);

add_settings_field(
    'bam_activate_map',
    'Activer la carte',
    'bam_activate_map_markup',
    'bam-settings-page',
    'bam-settings-map-section'
);

register_setting( 'bam-settings', 'bam_activate_map' );

function bam_map_settings_section_callback() {}

function bam_activate_map_markup() {
    ?>
        <input type="checkbox" name="bam_activate_map" id="bam_activate_map" value="1" <?php checked( get_option( 'bam_activate_map'), '1', true ); ?>>
    <?php
}