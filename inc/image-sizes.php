<?php
/*
 * Custom Image Sizes
*/
function bam_image_sizes() {
    add_image_size( 'bam-card', 300, 200 );
    add_image_size( 'bam-card-2x', 600, 400 );
    add_filter('big_image_size_threshold', '__return_false');
}
add_action('after_setup_theme', 'bam_image_sizes');

function remove_default_image_sizes() {
    remove_image_size('thumbnail');
    remove_image_size('medium');
    remove_image_size('medium_large');
    remove_image_size('large');
}
add_action('init', 'remove_default_image_sizes');

function bam_srcset( $post_id ) {

    $id = get_post_thumbnail_id($post_id);
    $srcset;

    $srcset_card    = wp_get_attachment_image_src($id, 'bam-card')[0] . ' 1x, ';
    $srcset_card   .= wp_get_attachment_image_src($id, 'bam-card-2x')[0] . ' 2x, ';

    $srcset = [
        'card'  =>  $srcset_card
    ];

}