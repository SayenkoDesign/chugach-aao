<?php

// Home - About

if( ! class_exists( 'Home_About_Section' ) ) {
    class Home_About_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'about' );
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
                     $this->get_name() . '-about'
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
                                                
            $row = new Element_Row(); 
            
            $column = new Element_Column(); 
                            
            // Header
            $header = new Element_Header( [ 'fields' => $fields ]  ); // set fields from Constructor
            $column->add_child( $header );
            
            // Editor
            $editor = new Element_Editor( [ 'fields' => $fields ]  ); // set fields from Constructor
            $column->add_child( $editor );
                                            
            // Button
            $button = new Element_Button( [ 'fields' => $fields ]  ); // set fields from Constructor
            $button->add_render_attribute( 'anchor', 'class', [ 'button', 'green' ] ); 
            $column->add_child( $button );
            
            $grid = $this->get_fields( 'grid' );
            
            $grid_items = '';
                        
            if( ! empty( $grid ) ) {
                
                foreach( $grid as $item ) {
                    
                    $title = _s_format_string( $item['grid_title'], 'h3' );
                    
                    $thumbnail = sprintf( '<div class="icon">%s</div>', _s_get_acf_image( $item['grid_image'], 'icon-medium' ) );
                                                                     
                    $grid_items .= sprintf( '<div class="column column-block"><div class="grid-item">%s<div class="panel" data-equalizer-watch>%s</div></div></div>', $thumbnail, $title );
                }
            }
            
            $grid = sprintf( '<div class="grid"><div class="row small-up-1 medium-up-2 xlarge-up-3 xxxlarge-up-4" data-equalizer data-equalize-on="medium">%s</div></div>', $grid_items );
            
            $html = new Element_Html( [ 'fields' => [ 'html' => $grid ] ] ); // set fields from Constructor
            $column->add_child( $html );
                        
            $row->add_child( $column );
                        
            $this->add_child( $row );
        }
        
    }
}
   
new Home_About_Section;
