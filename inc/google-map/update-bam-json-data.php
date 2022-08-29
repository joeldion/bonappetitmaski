<?php 

/*
 * Save prod data as JSON
 */

function bam_save_prod_json() {

    $args = [
        'post_type'     =>  'prod',
        'post_status'   =>  'publish',
        'order'         =>  'asc',
        'orderby'       =>  'title'
    ];

    $prod = new WP_Query( $args );
    $json_file = BAM_INC . 'google-map/json/bam-map-data.json';
    $json_data = [];    

    while ( $prod->have_posts() ): $prod->the_post();

        $id = get_the_ID();
        $coord = esc_html( get_post_meta( $id, '_bam_prod_coord', true ) );
        $address = esc_html( get_post_meta( $id, '_bam_prod_address', true ) );
        $city = esc_html( get_post_meta( $id, '_bam_prod_city', true ) );
        $fulladdress = $address . ', ' . $city;
        $data = [
            'id'          =>  $id,
            'title'       =>  get_the_title(),
            'address'     =>  $fulladdress,
            'gmap'        =>  esc_url( get_post_meta( $id, '_bam_prod_gmap_url', true ) ),
            'phone'       =>  esc_html( get_post_meta( $id, '_bam_prod_phone', true ) ),
            'website'     =>  esc_url( get_post_meta( $id, '_bam_prod_website', true ) ),            
            'lat'         =>  floatval( explode( ',', $coord )[0] ),
            'lng'         =>  floatval( explode( ',', $coord )[1] )
        ];

        $data = json_encode( $data );
        array_push( $json_data, $data );

    endwhile;

    $json_file = BAM_INC . 'google-map/json/bam-map-data.json';
    file_put_contents( $json_file, '[' . implode( ',', $json_data ) . ']' );

}