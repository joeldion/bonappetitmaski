<?php 
/*
 * Setting: Menus
 */

add_settings_section(
    'bam-settings-menu-section',
    'Menu',
    'home_menu_settings_section_callback',
    'bam-settings-page'
);

add_settings_field(
    'bam_menu_item_text_1',
    'Texte de l\'élément de menu 1',
    'bam_menu_item_text_1_markup',
    'bam-settings-page',
    'bam-settings-menu-section'
);

add_settings_field(
    'bam_menu_item_text_2',
    'Texte de l\'élément de menu 2',
    'bam_menu_item_text_2_markup',
    'bam-settings-page',
    'bam-settings-menu-section'
);

add_settings_field(
    'bam_menu_item_text_3',
    'Texte de l\'élément de menu 3',
    'bam_menu_item_text_3_markup',
    'bam-settings-page',
    'bam-settings-menu-section'
);

register_setting( 'bam-settings', 'bam_menu_item_text_1' );
register_setting( 'bam-settings', 'bam_menu_item_text_2' );
register_setting( 'bam-settings', 'bam_menu_item_text_3' );

function home_menu_settings_section_callback() {}

function bam_menu_item_text_1_markup() {
    ?>
    <input type="text" name="bam_menu_item_text_1" id="bam-menu-item-text-1" size="40" maxlength="40" value="<?php echo get_option( 'bam_menu_item_text_1' ); ?>">
    <?php
}

function bam_menu_item_text_2_markup() {
    ?>
    <input type="text" name="bam_menu_item_text_2" id="bam-menu-item-text-2" size="40" maxlength="40" value="<?php echo get_option( 'bam_menu_item_text_2' ); ?>">
    <?php
}

function bam_menu_item_text_3_markup() {
    ?>
    <input type="text" name="bam_menu_item_text_3" id="bam-menu-item-text-3" size="40" maxlength="40" value="<?php echo get_option( 'bam_menu_item_text_3' ); ?>">
    <?php
}