<!DOCTYPE html>
<html lang="fr">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-75VQ8BNCTF"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-75VQ8BNCTF');
        </script>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Barlow&display=swap" rel="stylesheet"> 
        <link rel="icon" href="<?php echo get_home_url(); ?>/favicon.ico" type="image/x-icon" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class( 'container' ); ?>>

        <?php
            if ( is_IE() ) {
                echo ie_modal();
                exit();
            }
        ?>
    
        <header class="header" role="banner">

            <h1 class="header__logo">                
                <a href="<?php echo get_home_url(); ?>" aria-label="Accueil">
                    <img src="<?php echo BAM_URL; ?>/img/logos/logo-bon-appetit-maski.svg" alt="Bon appétit Maski" title="Bon appétit Maski" width="270">
                </a>                              
            </h1>

            <nav class="header__nav" role="navigation">
                <ul class="nav">
                    <li class="nav__item">
                        <a href="#" data-target="#producteurs">
                            <?php esc_html_e( get_option( 'bam_menu_item_text_1' ) ); ?>
                            <span class="nav__subtitle"><?php esc_html_e( get_option( 'bam_prod_dates' ) ); ?></span>
                        </a>
                    </li>
                    <li class="nav__item">
                        <a href="#" data-target="#restaurants">
                            <?php esc_html_e( get_option( 'bam_menu_item_text_2' ) ); ?>                        
                            <span class="nav__subtitle"><?php esc_html_e( get_option( 'bam_resto_dates' ) ); ?></span>                            
                        </a>
                    </li>    
                    <li class="nav__item">
                        <a href="#" data-target="#contact">
                            <?php esc_html_e( get_option( 'bam_menu_item_text_3' ) ); ?>
                            <?php /* <span class="nav__subtitle">&nbsp;</span> */ ?>
                        </a>
                    </li>
                </ul>
            </nav>

        </header>
        
        <main class="content">

            <section class="section section--intro">
                <div class="section__desc">
                    <?php echo wpautop( get_option( 'bam_intro_text' ) ); ?>
                </div>
            </section>

            <section class="section section--listing" id="producteurs">

                <h2 class="section__logo">
                <img src="<?php echo BAM_URL; ?>/img/logos/logo-bon-appetit-maski-prod.png" alt="Tournée des producteurs Bon appétit Maski" title="Tournée des producteurs Bon appétit Maski" height="235" width="300">
                </h2>

                <h3 class="section__subtitle">
                    <?php esc_html_e( get_option( 'bam_prod_dates' ) ); ?><br /> 
                    <?php esc_html_e( get_option( 'bam_prod_time' ) ); ?>
                </h3>

                <div class="section__desc">
                    <?php echo wpautop( get_option( 'bam_prod_text' ) ); ?>
                </div>

                <?php echo bam_content_loop( 'prod' ); ?>

            </section>

            <section class="section section--map" id="itineraire">

                <h2 class="section__title">Planifiez votre itinéraire gourmand</h2> 

                <div class="section__desc">
                    <p>En plus des producteurs, plusieurs artistes et artisans de la région ouvriront leurs portes pour vous démontrer leur savoir-faire. Plus d'information : <a href="https://hangartspublics.com/" target="_blank" rel="noopener">hangartspublics.com</a></p>
                    <p>Vous pouvez aussi faire la tournée confortablement assis en autobus au départ de Trois-Rivières avec <a href="https://www.escapademauricie.com/fr-ca/arts-et-tournee-gourmande-maskinonge" target="_blank" rel="noopener">Escapade Mauricie</a>.</p>
                </div>

                <div class="map-container">
                    <div id="map-prod" class="map"></div>
                    <div class="filters">
                        <div class="filter filter--bam" data-cat="bam">
                            <span class="filter__checkbox filter__checkbox--bam"></span>
                            <span class="filter__label">Producteurs</span>
                        </div>
                        <div class="filter filter--hp" data-cat="hp">
                            <span class="filter__checkbox filter__checkbox--hp"></span>
                            <span class="filter__label">Artisans et artisans</span>
                        </div>                   
                    </div>
                </div>  

            </section>

            <section class="section section--listing" id="restaurants">

                <?php /* <h2 class="section__title">Événement gourmand en restaurant</h2> */ ?>

                <h2 class="section__logo">
                    <img src="<?php echo BAM_URL; ?>/img/logos/logo-bon-appetit-maski-resto.png" alt="Événement gourmand en restaurant Bon appétit Maski" title="Événement gourmand en restaurant Bon appétit Maski" height="235" width="300">
                </h2>

                <h3 class="section__subtitle"><?php esc_html_e( get_option( 'bam_resto_dates' ) ); ?></h3>

                <div class="section__desc">
                    <?php echo wpautop( get_option( 'bam_resto_text' ) ); ?>
                </div>

                <?php echo bam_content_loop( 'resto' ); ?>

            </section>

            <section class="section section--contact" id="contact">

                <h2 class="section__title"><?php esc_html_e( get_option( 'bam_contact_title' ) ); ?></h2>

                <div class="contact">
                    <a href="tel:+<?php echo preg_replace( '/\-|\s+/', '', get_option( 'bam_contact_phone' ) ); ?>" class="contact__phone">
                        <?php esc_html_e( get_option( 'bam_contact_phone' ) ); ?>
                    </a>
                    <a href="mailto:<?php esc_html_e( get_option( 'bam_contact_email' ) ); ?>" class="contact__email">
                        <?php esc_html_e( get_option( 'bam_contact_email' ) ); ?>
                    </a>
                </div>

            </section>

            <section class="section section--partners">

                <h2 class="section__title">Partenaires</h2>
                    
                <div class="logos logos--3">

                    <div class="logo">
                        <a href="https://www.quebec.ca/" class="logo__link" target="_blank" rel="noopener">
                            <img src="<?php echo BAM_URL; ?>/img/logos/logo-quebec.svg" alt="Gouvernement du Québec" class="logo__img" width="200">
                        </a>
                    </div>

                    <div class="logo">
                        <a href="https://www.mauricie.upa.qc.ca/syndicats/syndicats-locaux/syndicat-upa-de-maskinonge" class="logo__link" target="_blank" rel="noopener">
                            <img src="<?php echo BAM_URL; ?>/img/logos/logo-upa-maskinonge.png" alt="UPA Maskinongé" class="logo__img" width="200">
                        </a>
                    </div>
                    <div class="logo">
                        <a href="https://www.sadcmaskinonge.qc.ca/" class="logo__link" target="_blank" rel="noopener">
                            <img src="<?php echo BAM_URL; ?>/img/logos/logo-sadc-mrc-maskinonge.png" alt="SADC de la MRC de Maskinongé" class="logo__img" width="200">
                        </a>
                    </div>

                </div>

                <div class="logos logos--2">

                    <div class="logo">
                        <a href="https://mrcmaskinonge.ca/" class="logo__link" target="_blank" rel="noopener">
                            <img src="<?php echo BAM_URL; ?>/img/logos/logo-mrc-maskinonge.svg" alt="MRC de Maskinongé" class="logo__img" width="200">
                        </a>
                    </div> 
                    <div class="logo">
                        <a href="https://www.maski.quebec/tourisme/" class="logo__link" target="_blank" rel="noopener">
                            <img src="<?php echo BAM_URL; ?>/img/logos/logo-tourisme-maskinonge.svg" alt="Tourisme Maskinongé" class="logo__img" width="200">
                        </a>
                    </div>

                </div>

            </section>
            
        </main>

        <footer class="footer">

            <div class="footer__content">

                <a href="https://mauriciemiam.ca/" class="footer__logo" target="_blank" rel="noopener">
                    <img src="<?php echo BAM_URL; ?>/img/logos/logo-miam-fierte.svg" alt="Fierté MIAM" class="logo__img" width="200">
                </a>
                
                <div class="footer__colophon"> &copy;&nbsp;<?php echo date('Y'); ?>&nbsp;-&nbsp;Tous droits réservés MRC de Maskinongé </div>

            </div>

        </footer>

        <?php wp_footer(); ?>

        <a href="#" class="back-to-top" id="back-to-top"></a>

        <?php if ( get_option( 'bam_activate_map') === '1' ): ?>
                <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo BAM_GMAP_API_KEY; ?>&callback=initMap&v=weekly" defer></script>
        <?php endif; ?>
    </body>
</html>