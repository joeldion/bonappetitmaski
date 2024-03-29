<?php
/*
 * Get external BAM JSON data
 */

$json_file_local = '/var/www/html/bonappetitmaski/wp-content/themes/bonappetitmaski/inc/google-map/json/hp-map-data.json';
$json_file_external = file_get_contents( 'https://hangartspublics.com/wp-content/themes/hangarts/inc/google-map/json/hp-map-data.json' );
$array_data = json_decode( $json_file_external, true );
$json_data = '[';
foreach ( $array_data as $key => $data ) {
    $json_data .= json_encode( $data );
    if ( $key !== array_key_last( $array_data ) ) $json_data .= ',';
}
$json_data .= ']';
file_put_contents( $json_file_local, $json_data );