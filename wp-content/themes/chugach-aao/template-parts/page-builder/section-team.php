<?php
// Team

if( ! class_exists( 'Team_Section' ) ) {
    class Team_Section extends Element_Section {
        
        var $post_type = 'team';
        
        public function __construct() {
            parent::__construct();
            
            $fields = get_sub_field( 'fields' );
            $this->set_fields( $fields );
            
            $settings = get_sub_field( 'settings' );
            $this->set_settings( $settings );
                        
            // Render the section
            $this->render();
            
            // print the section
            $this->print_element();        
        }
              
        // Add default attributes to section        
        protected function _add_render_attributes() {
            
            // use parent attributes
            parent::_add_render_attributes();
    
            $this->add_render_attribute(
                'wrapper', 'class', [
                     $this->get_name() . '-team'
                ]
            );    
            
            $this->add_render_attribute(
                'wrapper', 'id', [
                     $this->get_name() . '-team'
                ], true
            );            
            
        }          
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
                                                                        
            $row = new Element_Row(); 
                             
            $column = new Element_Column(); 
            
            // Editor
            $editor = new Element_Editor( [ 'fields' => $fields ] ); // set fields from Constructor
            $column->add_child( $editor );
                        
            $row->add_child( $column );
            
            $html = new Element_Html( [ 'fields' => [ 'html' => $this->team() ] ] ); // set fields from Constructor
            $column->add_child( $html );
            
            $this->add_child( $row ); 
                        
        }
        
        
        private function team() {
        
            $loop = new WP_Query( array(
                'post_type' => $this->post_type,
                'order' => 'ASC',
                'orderby' => 'menu_order title',
                'posts_per_page' => -1,
            ) );
            
            $out = '';
            
            if ( $loop->have_posts() ) : 
                                    
                $grid_columns = 'large-up-4';
                
                $out .= sprintf( '<div class="row small-up-1 medium-up-2 %s align-center" data-equalizer data-equalize-on="medium">', $grid_columns );
          
                while ( $loop->have_posts() ) :
    
                    $loop->the_post(); 
                    
                    
                    $out .= sprintf( '<article id="post-%s" class="%s">', get_the_ID(), join( ' ', get_post_class( 'column column-block' ) ) );
    
                    $background = sprintf( ' style="background-image: url(%s)"', get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) );
                    
                    $linkedin = get_field( 'linkedin' );
                    if( ! empty( $linkedin ) ) {
                        $linkedin = sprintf( '<div class="social-icon">%s</div>', _s_format_string( get_svg( 'linkedin' ), 'a', [ 'href' => $linkedin ] ) );
                    }
                    
                    $title  = sprintf( '<header>%s%s</header>', the_title( '<h3>', '</h3>', false ), $linkedin );
                    
                    $position  = get_field( 'position' );
                    $position = _s_format_string( $position, 'p' );
                    
                    $description = get_field( 'description' );
                    $description = _s_format_string( $description, 'p' );
                                        
                    $out .= sprintf( '<div class="thumbnail"%s></div><div class="panel" data-equalizer-watch>%s%s%s', 
                            $background, 
                            $title, 
                            $position,
                            $description
                            
                          );
                    
                    $out .= '</article>';
    
                endwhile;
                
                $out .= '</div>';
                
            endif; 
            
            wp_reset_postdata();
            
            return $out;
        }
        
        
    }
}
   
new Team_Section;