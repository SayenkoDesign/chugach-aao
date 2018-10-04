<?php

// Home - Discount

if( ! class_exists( 'Home_Discount_Section' ) ) {
    class Home_Discount_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'discount' );
            
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
                     $this->get_name() . '-discount'
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
                                                                        
            $row = new Element_Row(); 
            
            $column = new Element_Column(); 
            
            // Editor
            $editor = new Element_Editor( [ 'fields' => $this->get_fields() ]  ); // set fields from Constructor
            $column->add_child( $editor );
            
            $row->add_child( $column );
            
            $this->add_child( $row );
            
            $out = '';
                                            
            $photo = _s_get_acf_image( $this->get_fields( 'photo' ) );
            if( ! empty( $photo ) ) {
                $out .= sprintf( '<div class="column">%s</div>', $photo );
            }
            
            $discount_photo = _s_get_acf_image( $this->get_fields( 'discount_photo' ) );
            if( ! empty( $discount_photo ) ) {
                $discount_url = $this->get_fields( 'discount_url' );
                if( ! empty( $discount_url ) ) {
                    $url = $discount_url['url'];
                    if( ! empty( $url ) ) {
                        $out .= sprintf( '<div class="column column-block pipe-right"><a href="%s">%s</a></div>', $url, $discount_photo );
                    }
                }
                
            } 
            
            if( ! empty( $out ) ) {
                
                $row = new Element_Row(); 
            
                $column = new Element_Column(); 
                
                $html = sprintf( '<div class="row unstack-medium align-center">%s</div>', $out );

                $html = new Element_Html( [ 'fields' => array( 'html' => $html ) ]  ); // set fields from Constructor
                $column->add_child( $html );
                
                $row->add_child( $column );
            
                $this->add_child( $row );
            
                
            }
                        
            
        }
        
    }
}
   
new Home_Discount_Section;
