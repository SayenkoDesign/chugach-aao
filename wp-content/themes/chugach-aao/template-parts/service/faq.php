<?php

// Home - Discount

if( ! class_exists( 'Home_Discount_Section' ) ) {
    class Home_Discount_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'faq' );
            
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
                     $this->get_name() . '-faq'
                ]
            );            
            
        }  
        
        
        public function before_render() {
                            
            $this->add_render_attribute( 'wrap', 'class', 'wrap' );
            
            $rain_drop = sprintf('<div class="raindrop"><img src="%sservice/drops.svg" alt="rain drops" width="139" height="151" /></div>', trailingslashit( THEME_IMG ) );
            
            return sprintf( '<%s %s>%s<div %s>', 
                            esc_html( $this->get_html_tag() ), 
                            $this->get_render_attribute_string( 'wrapper' ), 
                            $rain_drop,
                            $this->get_render_attribute_string( 'wrap' )
                            );
        }
       
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
                                                                                                            
            $row = new Element_Row(); 
            
            $column = new Element_Column(); 
            
            $fields['heading'] = sprintf( '<span>%s</span>', $fields['heading'] );
            
            // Header
            $header = new Element_Header( [ 'fields' => $fields ]  ); // set fields from Constructor
            $column->add_child( $header );
            $row->add_child( $column );
            $this->add_child( $row ); 
            
 
            $row = new Element_Row(); 
            $row->add_render_attribute( 'wrapper', 'class', 'large-unstack' );
            
            $column = new Element_Column(); 
        
            $faq_field = $this->get_fields( 'faq' );
                
            $faq_list = get_field( 'faq', $faq_field );
            
            $faq_list_partitions = c2c_array_partition( $faq_list, 2 );
            
            foreach( $faq_list_partitions as $fp ) {
                // faq
                $faq = new Element_FAQ( [ 'fields' => [ 'faq' => $fp ] ]  ); // set fields from Constructor
                $column->add_child( $faq );
                $row->add_child( $column );
            }
                                                
            $this->add_child( $row );                        
            
        }
        
    }
}
   
new Home_Discount_Section;
