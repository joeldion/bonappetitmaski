<?php 
/*
 * CPT Restaurateurs
 */

function bam_resto_cpt() {

    $args = [
        'labels'        =>  [
            'name'                  =>  'Restaurateurs',
            'singular_name'         =>  'Restaurateur',
            'add_new_item'          =>  'Ajouter un restaurateur',
            'edit_item'             =>  'Modifier le restaurateur',
            'new_item'              =>  'Nouveau restaurateur',
            'all_items'             =>  'Tous les restaurateurs',
            'view_item'             =>  'Voir le restaurateur',
            'search_items'          =>  'Rechercher parmi les restaurateurs',
            'not_found'             =>  'Aucun restaurateur trouvé',
            'not_found_in_trash'    =>  'Aucun restaurateur trouvé dans la corbeille',
            'menu_item'             =>  'Restaurateurs'
        ],
        'public'        =>  false,
        'supports'      =>  [ 'title', 'thumbnail' ],
        'show_ui'       =>  true,
        'menu_position' =>  5,
        'menu_icon'     =>  'dashicons-food'
    ];

    register_post_type( 'resto', $args );

}
add_action( 'init', 'bam_resto_cpt', 9 );

