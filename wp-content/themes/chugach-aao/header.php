<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo THEME_FAVICONS;?>/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEME_FAVICONS;?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEME_FAVICONS;?>/favicon-16x16.png">
<link rel="manifest" href="<?php echo THEME_FAVICONS;?>/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <ul class="skip-link screen-reader-text">
        <li><a href="#content" class="screen-reader-shortcut"><?php esc_html_e( 'Skip to content', '_s' ); ?></a></li>
        <li><a href="#footer" class="screen-reader-shortcut"><?php esc_html_e( 'Skip to footer', '_s' ); ?></a></li>
    </ul>
        
    <header id="masthead" class="site-header" role="banner" itemscope itemtype="https://schema.org/WPHeader">
		<div class="wrap">
                    
			<div class="row align-middle">
                
                    <?php
                    $phone = '(206) 440-9077';
                             
                    if( !empty( $phone ) ) {
                        $number = _s_format_telephone_url( $phone );
                        printf( '<a href="%s" class="phone hide-for-large">%s</a>', $number, get_svg( 'phone-mobile' ) );
                    }
                    ?>
                                
                <div class="columns site-branding">
                    <div class="site-title">
                    <?php
                    $site_url = home_url();
                    $logo = sprintf('<img src="%slogo.png" alt="site logo" />', trailingslashit( THEME_IMG ) );                    
                    printf('<a href="%s" title="%s">%s</a>',
                            $site_url, get_bloginfo( 'name' ), $logo );
                    ?>
                    </div>
                </div><!-- .site-branding -->
                                    
                <div class="columns shrink header-widgets show-for-large">
                    <div class="row align-middle">
                    <?php
                    $tagline = '<span>24/7 Emergency Service</span>';
                    
                    $phone = sprintf( '<a href="%s">%s</a>', _s_format_telephone_url( $phone ), $phone );
                    $service_area = sprintf( '<span>%s 24/7 Service Area</span>', get_svg( 'service-icon' ) );
                    printf( '<div class="widget column widget-text">%s%s%s</div>', $tagline, $phone, $service_area );
                    
                    $schedule_appointment = sprintf( '<button class="button blue" data-open="schedule-appointment"><span>%s</span></a>', 
                                            __( 'Schedule Appointment' ) );
                    
                    printf( '<div class="widget column widget-menu">%s</div>', $schedule_appointment );
                    ?> 
                    </div>                   
                </div> 
                                                      
			</div>
            
            <?php
                printf( '<div class="wave-top show-for-large" aria-hidden="true">%s</div>', get_svg( 'wave-top' ) );
            ?> 
            <div class="nav-primary-wrapper">
                <div class="row small-collapse large-uncollapse"> 
                    <nav id="site-navigation" class="nav-primary" role="navigation" aria-label="Main" itemscope itemtype="https://schema.org/SiteNavigationElement">            
                        
                        <?php
                            // Desktop Menu
                            $args = array(
                                'theme_location' => 'primary',
                                'menu' => 'Primary Menu',
                                'container' => '',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_id'        => 'primary-menu',
                                'menu_class'     => 'menu',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                             );
                            wp_nav_menu($args);
                        ?>
                        
                    </nav>
                </div>  
            </div>
            
		</div><!-- wrap -->
         
	</header><!-- #masthead -->

<div id="page" class="site-container">

	<div id="content" class="site-content">