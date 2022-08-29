<?php 
/*
 * Setting: Restaurateurs (description)
 */

add_settings_section(
    'bam-settings-resto-section',
    'Section Restaurateurs',
    'home_resto_settings_section_callback',
    'bam-settings-page'
);

add_settings_field(
    'bam_resto_text',
    'Description',
    'bam_resto_text_markup',
    'bam-settings-page',
    'bam-settings-resto-section'
);

add_settings_field(
    'bam_resto_dates',
    'Dates',
    'bam_resto_dates_markup',
    'bam-settings-page',
    'bam-settings-resto-section'
);

register_setting( 'bam-settings', 'bam_resto_text' );
register_setting( 'bam-settings', 'bam_resto_dates' );


function home_resto_settings_section_callback() {}

function bam_resto_text_markup() {

    wp_editor(
        get_option( 'bam_resto_text' ),
        'bam_resto_text',
        [
            'media_buttons' => false,
            'drag_drop_upload' => false,
            'textarea_rows' => 5
        ]
    );

}

function bam_resto_dates_markup() {
    ?>
    <input type="text" name="bam_resto_dates" id="bam_resto_dates" size="40" maxlength="30" value="<?php echo get_option( 'bam_resto_dates' ); ?>">
    <?php
}