<?php
/*
Template Name: Contact
*/


get_header(); 

_s_get_template_part( 'template-parts/global', 'hero' );
_s_get_template_part( 'template-parts/contact', 'background-image' );

?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
	<?php
    section_default();
	function section_default() {
				
		global $post;
		
		$attr = array( 'class' => 'section-default' );
		
		$args = array(
            'html5'   => '<section %s>',
            'context' => 'section',
            'attr' => $attr,
        );
        
        _s_markup( $args );
        
        _s_structural_wrap( 'open' );
		
		print( '<div class="row large-unstack">' );
		
		while ( have_posts() ) :

			the_post();
            
                $details = get_field( 'contact_details' );
                $svg = '<svg height="39" width="28" xmlns="http://www.w3.org/2000/svg"><g fill="none"><path d="M14 0C6.28 0 0 6.15 0 13.71c0 2.555.722 5.048 2.09 7.21l11.113 17.54c.213.336.588.54.991.54h.01c.406-.003.782-.214.991-.555l10.83-17.71A13.481 13.481 0 0 0 28 13.712C28 6.15 21.72 0 14 0zm10.023 19.562l-9.846 16.1L4.073 19.718a11.238 11.238 0 0 1-1.755-6.006C2.318 7.41 7.567 2.27 14 2.27s11.674 5.14 11.674 11.44c0 2.067-.576 4.09-1.651 5.852z" fill="#3e52aa"/><path d="M14 6.882c-3.86 0-7 3.088-7 6.883 0 3.77 3.09 6.882 7 6.882 3.96 0 7-3.153 7-6.882 0-3.795-3.14-6.883-7-6.883zm0 11.486c-2.587 0-4.682-2.067-4.682-4.603 0-2.53 2.109-4.604 4.682-4.604s4.674 2.074 4.674 4.604c0 2.499-2.046 4.603-4.674 4.603z" fill="#df3838"/></g></svg>';
                if( ! empty( $details ) ) {
                    printf( '<div class="column column-block small-12 large-5"><div class="entry-content">%s%s</div></div>', $svg, $details );
                }
                
                
                print( '<div class="column column-block small-12 large-7">' );
                            
                echo '<div class="entry-content">';
                
                the_content();
                
                echo '</div>';
            
            echo '</div>';
            				
		endwhile;
		
		print( '</div>' );
        
		_s_structural_wrap( 'close' );
	    echo '</section>';
	}
	?>
	</main>


</div>

<?php
get_footer();
