<?php

/*
Global - Hero
		
*/


if( ! class_exists( 'Hero_Section' ) ) {
    class Hero_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'hero' );            
            $this->set_fields( $fields );
            
            $settings = [];
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
                     $this->get_name() . '-hero'
                ]
            );
        }
        
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields(); 
            
            $heading = $this->get_fields( 'heading' ) ? $this->get_fields( 'heading' ) : get_the_title();
            $heading = preg_replace('/#/', '<span style="text-decoration: underline;">', $heading, 1); // will replace first 'abc'
            $heading = preg_replace('/#/', '</span>', $heading);    // will replace all others
            $heading = _s_format_string( $heading, 'h1' );
            
            
            $icon = $this->get_fields( 'icon' );
            $icon = sprintf( '<div class="icon">%s</div>', _s_get_acf_image( $icon, 'medium' ) );

            return sprintf( '<div class="row"><div class="column"><div class="caption">%s%s</div></div></div>', $icon, $heading );
        }
    }
}
   
new Hero_Section; 