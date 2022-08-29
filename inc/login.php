<?php
/*
 * Login Logo
*/

function bam_custom_login_logo() {
    ?>
    <style type="text/css">
        body {
            background: #fff !important;
        }
        h1 a {
            background-image:url(<?php echo BAM_URL . '/img/logos/logo-bon-appetit-maski.svg' ?>) !important;
            background-size: 100% !important;
            width: 200px !important;
            height: 220px !important;
        }
    </style>
    <?php
}
add_filter( 'login_head', 'bam_custom_login_logo' );
