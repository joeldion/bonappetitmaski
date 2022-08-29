<?php 
/*
 * Setting: Contact
 */

add_settings_section(
    'bam-settings-contact-section',
    'Informations de contact',
    'bam_contact_settings_section_callback',
    'bam-settings-page'
);

add_settings_field(
    'bam_contact_title',
    'Titre de la section',
    'bam_contact_title_markup',
    'bam-settings-page',
    'bam-settings-contact-section'
);

add_settings_field(
    'bam_contact_phone',
    'Téléphone',
    'bam_contact_phone_markup',
    'bam-settings-page',
    'bam-settings-contact-section'
);

add_settings_field(
    'bam_contact_email',
    'Courriel',
    'bam_contact_email_markup',
    'bam-settings-page',
    'bam-settings-contact-section'
);

register_setting( 'bam-settings', 'bam_contact_title' );
register_setting( 'bam-settings', 'bam_contact_phone' );
register_setting( 'bam-settings', 'bam_contact_email' );

function bam_contact_settings_section_callback() {}

function bam_contact_title_markup() {
    ?>
    <input type="text" name="bam_contact_title" id="bam-contact-title" size="40" maxlength="30" value="<?php echo get_option( 'bam_contact_title' ); ?>">
    <?php
}

function bam_contact_phone_markup() {
    ?>
    <input type="tel" name="bam_contact_phone" id="bam-contact-phone" size="40" value="<?php echo get_option( 'bam_contact_phone' ); ?>">
    <?php
}

function bam_contact_email_markup() {
    ?>
    <input type="email" name="bam_contact_email" id="bam-contact-email" size="40" value="<?php echo get_option( 'bam_contact_email' ); ?>">
    <?php
}