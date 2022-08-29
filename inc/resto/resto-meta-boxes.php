<?php

/*
 *  Meta Box: Producteur
*/

add_action( 'add_meta_boxes', 'bam_resto_details_meta_box' );
add_action( 'save_post', 'bam_resto_details_meta_box_save' );

function bam_resto_details_meta_box() {

    add_meta_box(
        'bam_resto_details',
        'Information',
        'bam_resto_details_callback',
        'resto',
        'normal',
        'high'
    );

}

function bam_resto_details_callback() {

    wp_nonce_field( 'bam_resto_details', 'bam_resto_details_nonce' );

    global $post;
    $id = $post->ID;
    $address = esc_html( get_post_meta( $id, '_bam_resto_address', true ) );
    $city = esc_html( get_post_meta( $id, '_bam_resto_city', true ) );
    $postal_code = esc_html( get_post_meta( $id, '_bam_resto_postal_code', true ) );
    $gmap_url = esc_html( get_post_meta( $id, '_bam_resto_gmap_url', true ) );
    $phone = esc_html( get_post_meta( $id, '_bam_resto_phone', true ) );    
    $desc = esc_html( get_post_meta( $id, '_bam_resto_desc', true ) );
    $menu = esc_html( get_post_meta( $id, '_bam_resto_menu', true ) );
    $menu_file_name = basename( get_attached_file( $menu ) );
    $menu_url = wp_get_attachment_url( $menu );
    $hide_menu = esc_attr( get_post_meta( $id, '_bam_resto_menu_hide', true ) );
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
                   <input type="text" id="bam-address" name="bam-resto-address" value="<?php echo $address; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-city">
                        <span class="option-title">Municipalité</span>                        
                    </label>
                </th>           
                <td>
                    <select id="bam-city" name="bam-resto-city">
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
                   <input type="text" id="bam-postal-code" name="bam-resto-postal-code" value="<?php echo $postal_code; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-gmap_url">
                        <span class="option-title">URL Google Maps</span>                        
                    </label>
                </th>            
                <td>
                   <input type="url" id="bam-gmap-url" name="bam-resto-gmap-url" value="<?php echo $gmap_url; ?>">
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-phone">
                        <span class="option-title">Téléphone</span>                        
                    </label>
                </th>            
                <td>
                   <input type="tel" id="bam-phone" name="bam-resto-phone" value="<?php echo $phone; ?>">
                </td>
            </tr>
            <tr valign="top">   
                <th>
                    <label for="bam-menu">
                        <span class="option-title">Menu</span>                        
                    </label>
                </th>             
                <td>
                    <a href="#" class="button button-primary bam-media-upload" id="bam-media-upload">Sélectionner
                        <?php /* <div class="bam-media-upload__preview" id="bam-slider-preview" style=""></div> */ ?>
                    </a>
                    <?php /* <a href="#" class="button button-primary bam-media-remove" id="bam-media-remove">Retirer</a> */ ?>
                    <input type="hidden" id="bam-resto-menu" name="bam-resto-menu" value="<?php echo $menu; ?>">
                    <p id="bam-media-name">
                        <?php if ( $menu_file_name !== '' ): ?>
                            Fichier sélectionné : <a href="<?php echo $menu_url; ?>" target="_blank"><?php echo $menu_file_name; ?></a>
                        <?php endif; ?>
                    </p>                  
                    <p>
                        <label for="bam-menu-hide">
                            <input type="checkbox" id="bam-menu-hide" name="bam-resto-menu-hide" value="1" <?php checked( $hide_menu, '1', true ); ?>>
                            Cacher le menu
                        </label>
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th>
                    <label for="bam-desc">
                        <span class="option-title">Description</span>                        
                    </label>
                </th>            
                <td>
                   <textarea id="bam-desc" name="bam-resto-desc" rows="5"><?php echo $desc; ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
    <?php

}

function bam_resto_details_meta_box_save( $post_id ) {

    if (! isset($_POST[ 'bam_resto_details_nonce' ])) {
        return $post_id;
    }
    $nonce = $_POST[ 'bam_resto_details_nonce' ];
    if (! wp_verify_nonce( $nonce, 'bam_resto_details' )) {
        return $post_id;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }
    if (! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $data_address = sanitize_text_field( $_POST[ 'bam-resto-address' ] );
    $data_city = sanitize_text_field( $_POST[ 'bam-resto-city' ] );
    $data_postal_code = sanitize_text_field( $_POST[ 'bam-resto-postal-code' ] );
    $data_gmap_url = sanitize_text_field( $_POST[ 'bam-resto-gmap-url' ] );
    $data_phone = sanitize_text_field( $_POST[ 'bam-resto-phone' ] );
    $data_menu = sanitize_text_field( $_POST[ 'bam-resto-menu' ] );
    $data_menu_hide = sanitize_text_field( $_POST[ 'bam-resto-menu-hide' ] );
    $data_desc = sanitize_text_field( $_POST[ 'bam-resto-desc' ] );

    update_post_meta( $post_id, '_bam_resto_address', $data_address );
    update_post_meta( $post_id, '_bam_resto_city', $data_city );
    update_post_meta( $post_id, '_bam_resto_postal_code', $data_postal_code );
    update_post_meta( $post_id, '_bam_resto_gmap_url', $data_gmap_url );
    update_post_meta( $post_id, '_bam_resto_phone', $data_phone );
    update_post_meta( $post_id, '_bam_resto_menu', $data_menu );
    update_post_meta( $post_id, '_bam_resto_menu_hide', $data_menu_hide );
    update_post_meta( $post_id, '_bam_resto_desc', $data_desc );

}