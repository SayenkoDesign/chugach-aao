<?php
// Home - Hero Video

if( ! class_exists( 'Hero_Video_Section' ) ) {
    class Hero_Video_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'hero' );
            $this->set_fields( $fields );
            
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
                     $this->get_name() . '-hero',
                     $this->get_name() . '-hero' . '-' . $this->get_id(),
                ]
            ); 
            
            $background_image       = $this->get_fields( 'background_image' );
            $background_position_x  = $this->get_fields( 'background_position_x' );
            $background_position_y  = strtolower( $this->get_fields( 'background_position_y' ) );
            $background_overlay     = strtolower( $this->get_fields( 'background_overlay' ) );
            
            if( ! empty( $background_image ) ) {
                $background_image = _s_get_acf_image( $background_image, 'hero', true );
                $this->add_render_attribute( 'wrapper', 'class', 'hero-background' );
                                
                $this->add_render_attribute( 'wrap', 'style', sprintf( 'background-image: url(%s);', $background_image ) );
                $this->add_render_attribute( 'wrap', 'style', sprintf( 'background-position: %s %s;', 
                                                                          $background_position_x, $background_position_y ) );
                
                if( true == $background_overlay ) {
                     $this->add_render_attribute( 'wrap', 'class', 'background-overlay' ); 
                }
                                                                          
            }             
            
        }  
        
        
        public function after_render() {
        
            $wave = sprintf( '<div class="wave-bottom show-for-large">%s</div>', get_svg( 'wave-bottom' ) );
                
            return sprintf( '</div>%s</section>', $wave );
        }
       
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
            
            // BB Charcoal styles
            $before_heading   = empty( $fields['before_heading'] ) ? '' : _s_format_string( sprintf( '<span>%s</span>', $fields['before_heading'] ), 'h2' );            
            $heading          = empty( $fields['heading'] ) ? '' : _s_format_string( $fields['heading'], 'h1' );
            $button           = empty( $fields['video_button_text'] ) ? '' : _s_format_string( $fields['video_button_text'], 'span' );
                                                
            if( empty( $heading  ) ) {
                return;     
            }
                        
            $video_url = empty( $fields['video_url'] ) ? '' : $fields['video_url'];
            
            $video = youtube_embed( $video_url );
            
            $play = sprintf( '<button class="play-video align-center align-middle" data-open="modal-video" data-src="%s">
                              <span class="screen-reader-text">Play Video</span>%s %s</button>', 
                              $video, get_svg( 'video-play' ), $button );
            
            $html = sprintf( '<div class="hero-caption">%s%s%s</div>', $before_heading, $heading, $play );
                                                                        
            $row = new Element_Row(); 
            $row->add_render_attribute( 'wrapper', 'class', 'align-middle text-center' );
            
            $column = new Element_Column(); 

            $html = new Element_Html( [ 'fields' => array( 'html' => $html ) ]  ); // set fields from Constructor
            $column->add_child( $html );
                        
            $row->add_child( $column );
                        
            $this->add_child( $row );
        }
        
    }
}
   
new Hero_Video_Section;
