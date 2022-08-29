<?php

/*
 *  Meta Box: Producteur
*/

add_action( 'add_meta_boxes', 'bam_prod_details_meta_box' );
add_action( 'save_post', 'bam_prod_details_meta_box_save' );

function bam_prod_details_meta_box() {

    add_meta_box(
        'bam_prod_details',
        'Information',
        'bam_prod_details_callback',
        'prod',
        'normal',
        'high'
    );

}

function bam_prod_details_callback() {

    wp_nonce_field( 'bam_prod_details', 'bam_prod_details_nonce' );

    global $post;
    $address = esc_html( get_post_meta( $post->ID, '_bam_prod_address', true ) );
    $city = esc_html( get_post_meta( $post->ID, '_bam_prod_city', true ) );
    $postal_code = esc_html( get_post_meta( $post->ID, '_bam_prod_postal_code', true ) );
    $gmap_url = esc_html( get_post_meta( $post->ID, '_bam_prod_gmap_url', true ) );
    $phone = esc_html( get_post_meta( $post->ID, '_bam_prod_phone', true ) );
    $website = esc_html( get_post_meta( $post->ID, '_bam_prod_website', true ) );
    $desc = esc_html( get_post_meta( $post->ID, '_bam_prod_desc', true ) );
    $coord = esc_html( get_post_meta( $post->ID, '_bam_prod_coord', true ) );
    $lat = intval( explode( ',', $coord )[0] );
    $lng = intval( explode( ',', $coord )[1] );

    $json_data = [
        'id'            =>  $post->ID,
        'address'       =>  $address,
        'city'          =>  $city,
        'postal_code'   =>  $postal_code,
        'phone'         =>  $phone,
        'website'       =>  $website,
        'lat'           =>  $lat,
        'lng'           =>  $lng    
    ];
    $json_data = json_encode( $json_data );
    
    ?>

    <table class="form-table bam-meta-box">
        <tbody>
            <tr valign="top">
                <th>
                    <label for="bam-address">
                        <span class="option-title">Adresse</span>                        
                    </label>
                </th>           
                <td>
                   <input type="text" id="bam-address" name="bam-prod-address" value="<?php echo $address; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-city">
                        <span class="option-title">Municipalité</span>                        
                    </label>
                </th>           
                <td>
                    <select id="bam-city" name="bam-prod-city" >
                    <?php foreach ( BAM_MUNI as $muni ): ?>
                        <option value="<?php esc_html_e( $muni ); ?>" <?php selected($city, $muni); ?>>
                            <?php esc_html_e( $muni ); ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-postal_code">
                        <span class="option-title">Code postal</span>                        
                    </label>
                </th>            
                <td>
                   <input type="text" id="bam-postal-code" name="bam-prod-postal-code" value="<?php echo $postal_code; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-gmap_url">
                        <span class="option-title">URL Google Maps</span>                        
                    </label>
                </th>            
                <td>
                   <input type="url" id="bam-gmap-url" name="bam-prod-gmap-url" value="<?php echo $gmap_url; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-phone">
                        <span class="option-title">Téléphone</span>                        
                    </label>
                </th>            
                <td>
                   <input type="tel" id="bam-phone" name="bam-prod-phone" value="<?php echo $phone; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-website">
                        <span class="option-title">Site Internet</span>                        
                    </label>
                </th>            
                <td>
                   <input type="url" id="bam-website" name="bam-prod-website" value="<?php echo $website; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-desc">
                        <span class="option-title">Description</span>                        
                    </label>
                </th>            
                <td>
                   <textarea id="bam-desc" name="bam-prod-desc" rows="5"><?php echo $desc; ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" id="bam-coord" name="bam-prod-coord" value>   
    <?php
}

function bam_prod_details_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'bam_prod_details_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'bam_prod_details_nonce' ];
    if (! wp_verify_nonce( $nonce, 'bam_prod_details' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_address = sanitize_text_field( $_POST[ 'bam-prod-address' ] );
    $data_city = sanitize_text_field( $_POST[ 'bam-prod-city' ] );
    $data_postal_code = sanitize_text_field( $_POST[ 'bam-prod-postal-code' ] );
    $data_gmap_url = sanitize_text_field( $_POST[ 'bam-prod-gmap-url' ] );
    $data_phone = sanitize_text_field( $_POST[ 'bam-prod-phone' ] );
    $data_website = sanitize_text_field( $_POST[ 'bam-prod-website' ] );
    $data_desc = sanitize_text_field( $_POST[ 'bam-prod-desc' ] );
    $data_coord = sanitize_text_field( $_POST[ 'bam-prod-coord' ] );

    update_post_meta( $post_id, '_bam_prod_address', $data_address );
    update_post_meta( $post_id, '_bam_prod_city', $data_city );
    update_post_meta( $post_id, '_bam_prod_postal_code', $data_postal_code );
    update_post_meta( $post_id, '_bam_prod_gmap_url', $data_gmap_url );
    update_post_meta( $post_id, '_bam_prod_phone', $data_phone );
    update_post_meta( $post_id, '_bam_prod_website', $data_website );
    update_post_meta( $post_id, '_bam_prod_desc', $data_desc );
    update_post_meta( $post_id, '_bam_prod_coord', $data_coord );

    // Save data as a json file for Google map
    bam_save_prod_json();

}