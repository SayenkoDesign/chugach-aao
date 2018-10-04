<?php

// Service - Contact

if( ! class_exists( 'Service_Contact_Section' ) ) {
    class Service_Contact_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'contact' );
            
            if( empty( array_filter( $fields ) ) ) {
                return false;
            }
            
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
                     $this->get_name() . '-contact'
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
                                                                        
            $row = new Element_Row(); 
            $row->add_render_attribute( 'wrapper', 'class', 'large-unstack' );
            
            
            if( ! empty( $this->get_fields( 'column_left' ) ) ) {
                $editor = new Element_Editor( [ 'fields' => [ 'editor' => $this->get_fields( 'column_left' ) ] ]  );
                $column = new Element_Column(); 
                $column->add_child( $editor );
                $row->add_child( $column );
            }
            
            
            if( ! empty( $this->get_fields( 'column_left' ) ) ) {
                $icon = sprintf('<span class="icon shadow"><img src="%sservice/siren.svg" alt="rain drops" width="61" height="78" /></span>', trailingslashit( THEME_IMG ) );
                $content_right = sprintf( '<div class="caption">%s<div class="wrap">%s</div></div>', $icon, $this->get_fields( 'column_right' ));
                $editor = new Element_Editor( [ 'fields' => [ 'editor' => $content_right ] ]  );
                $column = new Element_Column(); 
                $column->add_child( $editor );
                $row->add_child( $column );
            }
            
            
                        
            $this->add_child( $row );
        }
        
    }
}
   
new Service_Contact_Section;
