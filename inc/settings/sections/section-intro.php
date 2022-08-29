<?php 
/*
 * Setting: Intro Text
 */

add_settings_section(
    'bam-settings-intro-section',
    'Introduction',
    'home_intro_settings_section_callback',
    'bam-settings-page'
);

add_settings_field(
    'bam_intro_text',
    'Texte d\'introduction',
    'bam_intro_text_markup',
    'bam-settings-page',
    'bam-settings-intro-section'
);
register_setting( 'bam-settings', 'bam_intro_text' );

function home_intro_settings_section_callback() {}

function bam_intro_text_markup() {

    wp_editor(
        get_option( 'bam_intro_text' ),
        'bam_intro_text',
        [
            'media_buttons' => false,
            'drag_drop_upload' => false,
            'textarea_rows' => 5
        ]
    );

}