<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?>

</div><!-- #content -->

<?php
   _s_get_template_part( 'template-parts/global', 'footer-cta' );
?>

<footer class="site-footer" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">
    <?php
    printf( '<div class="wave-footer show-for-large">%s</div>', get_svg( 'wave-footer-bottom' ) );
    ?>
    <div class="wrap">
    
        
        
        <?php
        
        function footer_copyright() {
            
            $copyright = sprintf( '<p>&copy; %s Raymark Plubming & Sewer.</p>', 
                                      date( 'Y' ) );
                                      
            $designer  = sprintf( '<p>All rights reserved. <a href="%1$s" target="_blank">Seattle Web Design</a> by <a href="%1$s" target="_blank">Sayenko design</a></p>', 'https://www.sayenkodesign.com/' );
                                                        
            printf( '<div class="column row footer-copyright">%s%s</div>', $copyright, $designer );
        }
        
        ?>
            
        <div class="footer-widgets">
            
            <div class="row align-top align-center medium-unstack">
                    
                <?php
                $sidebars = [ 
                              'footer-1',
                              'footer-2',
                              'footer-3' ];
                foreach( $sidebars as $sidebar ) {
                    if( is_active_sidebar( $sidebar ) ){
                        printf( '<div class="%s column column-block ">', '' );
                        dynamic_sidebar( $sidebar );
                        echo '</div>';
                    }
                }
                ?>
                                                    
            </div>
        
        </div>   
            
        <?php
        footer_copyright();
        ?>
                          
     </div>
 
 </footer><!-- #colophon -->

<?php 
 
wp_footer(); 
?>
</body>
</html>
