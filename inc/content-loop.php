<?php 
/*
 * Content Loop
 */

function bam_content_loop( $post_type ) {

    ob_start();

    $args = [
        'post_type'     =>  $post_type,
        'post_status'   =>  'publish',
        'order'         =>  'asc',
        'orderby'       =>  'title'
    ];

    $items = new WP_Query( $args );
    
    while ( $items->have_posts() ): $items->the_post();

        $id             = get_the_ID();
        $address        = esc_html( get_post_meta( $id, "_bam_{$post_type}_address",  true ) );
        $city           = esc_html( get_post_meta( $id, "_bam_{$post_type}_city",     true ) );
        $full_address   = $address . ', ' . $city;
        $gmap_url       = esc_url( get_post_meta( $id, "_bam_{$post_type}_gmap_url", true ) );
        if ( empty( $gmap_url ) ) {
            $gmap_url = 'https://www.google.com/maps/place/' . str_replace( ' ', '+', $full_address ) . '+QC+Canada';
        }
        $phone          = esc_html( get_post_meta( $id, "_bam_{$post_type}_phone",    true ) );
        $phone_href     = 'tel:+1' . preg_replace( '/\-|\s+/', '', $phone );
        $website        = esc_html( get_post_meta( $id, "_bam_{$post_type}_website",  true ) );
        $menu           = $post_type === 'resto' ? esc_html( get_post_meta( $id, "_bam_resto_menu",  true ) ) : '';
        $hide_menu      = esc_attr( get_post_meta( $id, "_bam_resto_menu_hide",  true ) );
        $btn_link       = !empty( $menu ) ? wp_get_attachment_url( $menu ) : $website;
        $btn_label      = !empty( $menu ) ? 'Menu' : 'En savoir plus';
        $desc           = esc_html( get_post_meta( $id, "_bam_{$post_type}_desc",     true ) ); 
 
        ?>
        <div class="card">
            <h3 class="card__logo">
            <?php 
                the_post_thumbnail(
                    'bam-card',
                    [
                        'title'  => get_the_title(),
                        'alt'    => get_the_title(),
                        'srcset' => bam_srcset( get_the_ID() )['post'],
                    ]
                ); 
            ?>
            </h3>
            <div class="card__content">
                <?php if ( $post_type === 'prod' ): ?>
                    <h3 class="card__title"><?php the_title(); ?></h3>
                <?php endif; ?>                
                <p class="card__desc"><?php echo $desc; ?></p>
                <a href="<?php echo $gmap_url; ?>" class="card__address icon icon--location" target="_blank"><?php echo $full_address; ?></a>
                <a href="<?php echo $phone_href; ?>" class="card__phone icon icon--phone"><?php echo $phone; ?></a> 
                <?php if ( $hide_menu !== '1' ): ?>
                <a href="<?php echo $btn_link; ?>" class="card__btn" target="_blank"><?php echo $btn_label; ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php

    endwhile;

    return ob_get_clean();

}