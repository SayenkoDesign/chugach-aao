<?php
/*
Template Name: About
*/

function kr_body_class( $classes ) {
  unset( $classes[array_search('page-template-default', $classes )] );
  $classes[] = 'page-builder';
  return $classes;
}
add_filter( 'body_class', 'kr_body_class', 99 );

get_header(); ?>

<?php
_s_get_template_part( 'template-parts/global', 'hero' );
_s_get_template_part( 'template-parts/about', 'mission' );

?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
	<?php
        while ( have_posts() ) :

        the_post();

        if ( have_rows('sections') ) {
		
			while ( have_rows('sections') ) { 
			
				the_row();
                
                // Use custom template part function so we can pass data
                _s_get_template_part( 'template-parts/page-builder', sprintf( 'section-%s', get_row_layout() ), ['data' => [] ] );
  					
			} // endwhile have_rows('sections')
			
 		
		} // endif have_rows('sections')

        endwhile; 	
    
	?>
	</main>


</div>

<?php
get_footer();
