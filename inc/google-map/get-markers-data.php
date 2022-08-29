<?php 
/*
 * Get Locations Data for Google Map
 */

function bam_get_markers_data( $post_type ) {

    ob_start();

    $args = [
        'post_type'     =>  $post_type,
        'post_status'   =>  'publish',
        'order'         =>  'asc',
        'orderby'       =>  'title'
    ];

    $markers = new WP_Query( $args );
    
    $markers_data = [];

    while ( $markers->have_posts() ): $markers->the_post();

        $id             = get_the_ID();
        $address        = esc_html( get_post_meta( $id, "_bam_{$post_type}_address",  true ) );
        $city           = esc_html( get_post_meta( $id, "_bam_{$post_type}_city",     true ) );
        $full_address   = $address . ', ' . $city;
        $gmap_url       = esc_url( get_post_meta( $id, "_bam_{$post_type}_gmap_url", true ) );
        $phone          = esc_html( get_post_meta( $id, "_bam_{$post_type}_phone",    true ) );
        $phone_href     = 'tel:+1' . preg_replace( '/\-|\s+/', '', $phone );
        $website        = esc_html( get_post_meta( $id, "_bam_{$post_type}_website",  true ) );

        $data = [
            'title'         =>  get_the_title(),
            'address'       =>  $full_address,
            'gmap_url'      =>  $gmap_url,
            'phone'         =>  $phone,
            'phone_href'    =>  $phone_href,
            'website'       =>  $website
        ];

        array_push( $markers_data, json_encode( $data ) );

    endwhile;

    foreach( $markers_data as $marker_data ) {        
        echo $marker_data;
    }

}