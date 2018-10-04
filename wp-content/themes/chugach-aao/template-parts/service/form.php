<?php

// Service - Form

if( ! class_exists( 'Service_Form_Section' ) ) {
    class Service_Form_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                                              
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
                     $this->get_name() . '-form'
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
                                                                                    
            $form_id = get_field( 'form_id' );
            
            if( empty( $form_id ) ) {
                return false;
            }
            
            $form = do_shortcode( sprintf( '[gravityform id="%s" title="false" description="false" ajax="true"]', $form_id ) );
            
            $html = sprintf( '<div class="service-form">%s</div>', $form );
            
            $row = new Element_Row(); 
            
            $column = new Element_Column(); 

            $html = new Element_Html( [ 'fields' => array( 'html' => $html ) ]  ); // set fields from Constructor
            
            $column->add_child( $html );
                
            $row->add_child( $column );
        
            $this->add_child( $row );
            
        }
        
    }
}
   
new Service_Form_Section;
