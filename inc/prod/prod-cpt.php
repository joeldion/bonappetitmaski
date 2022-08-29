<?php 
/*
 * CPT Producteur
 */

function bam_prod_cpt() {

    $args = [
        'labels'        =>  [
            'name'                  =>  'Producteurs',
            'singular_name'         =>  'Producteur',
            'add_new_item'          =>  'Ajouter un producteur',
            'edit_item'             =>  'Modifier le producteur',
            'new_item'              =>  'Nouveau producteur',
            'all_items'             =>  'Tous les producteurs',
            'view_item'             =>  'Voir le producteur',
            'search_items'          =>  'Rechercher parmi les producteurs',
            'not_found'             =>  'Aucun producteur trouvé',
            'not_found_in_trash'    =>  'Aucun producteur trouvé dans la corbeille',
            'menu_item'             =>  'Producteurs'
        ],
        'public'        =>  false,
        'supports'      =>  [ 'title', 'thumbnail' ],
        'show_ui'       =>  true,
        'menu_position' =>  5,
        'menu_icon'     =>  'dashicons-carrot'
    ];

    register_post_type( 'prod', $args );

}
add_action( 'init', 'bam_prod_cpt', 9 );

