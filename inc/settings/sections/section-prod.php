<?php 
/*
 * Setting: Producteurs (description)
 */

add_settings_section(
    'bam-settings-prod-section',
    'Section Producteurs',
    'home_prod_settings_section_callback',
    'bam-settings-page'
);

add_settings_field(
    'bam_prod_text',
    'Description',
    'bam_prod_text_markup',
    'bam-settings-page',
    'bam-settings-prod-section'
);

add_settings_field(
    'bam_prod_dates',
    'Dates',
    'bam_prod_dates_markup',
    'bam-settings-page',
    'bam-settings-prod-section'
);

add_settings_field(
    'bam_prod_hours',
    'Heures',
    'bam_prod_hours_markup',
    'bam-settings-page',
    'bam-settings-prod-section'
);

register_setting( 'bam-settings', 'bam_prod_text' );
register_setting( 'bam-settings', 'bam_prod_dates' );
register_setting( 'bam-settings', 'bam_prod_hours' );

function home_prod_settings_section_callback() {}

function bam_prod_text_markup() {

    wp_editor(
        get_option( 'bam_prod_text' ),
        'bam_prod_text',
        [
            'media_buttons' => false,
            'drag_drop_upload' => false,
            'textarea_rows' => 5
        ]
    );

}

function bam_prod_dates_markup() {
    ?>
    <input type="text" name="bam_prod_dates" id="bam_prod_dates" size="40" maxlength="30" value="<?php echo get_option( 'bam_prod_dates' ); ?>">
    <?php
}

function bam_prod_hours_markup() {
    ?>
    <input type="text" name="bam_prod_hours" id="bam_prod_hours" size="40" maxlength="30" value="<?php echo get_option( 'bam_prod_hours' ); ?>">
    <?php
}