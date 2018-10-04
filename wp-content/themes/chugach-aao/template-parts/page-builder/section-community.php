<?php
// Page Builder - Community

if( ! class_exists( 'Page_Builder_Community_Section' ) ) {
    class Page_Builder_Community_Section extends Element_Section {
        
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
                     $this->get_name() . '-community',
                     $this->get_name() . '-community' . '-' . $this->get_id(),
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
                        
            // Set column order            
            if( 0 == $this->get_id() % 2 ) {
                $column_order = [ 'small-order-2', 'large-order-1' ];
            }
            else {
                $column_order = [ 'small-order-1', 'large-order-2' ];   
            }
                        
            $fields = $this->get_fields();
                                                                        
            $row = new Element_Row(); 
            $row->add_render_attribute( 'wrapper', 'class', 'large-unstack' );
                                                                 
            $column = new Element_Column(); 
            $column->add_render_attribute( 'wrapper', 'class', $column_order[1] );
                       
            $html = new Element_Html( [ 'fields' => [ 'html' => $this->photos() ] ] ); // set fields from Constructor
            $column->add_child( $html );
            $row->add_child( $column );
            
            
            $column = new Element_Column(); 
            $column->add_render_attribute( 'wrapper', 'class', $column_order[0] );
            
            // Editor
            $editor = new Element_Editor( [ 'fields' => $fields ] ); // set fields from Constructor
            $column->add_child( $editor );
            $row->add_child( $column );
            
            $this->add_child( $row ); 
        }
        
        
        private function photos() {
            
            $photos = $this->get_fields( 'photos' );
                                    
            if( empty( $photos ) ) {
                return;
            }
            
            $photo_classes = [ 'width-60', 'width-40', 'width-100' ];
            $items = '';
            
            foreach( $photos as $key => $photo ) {
                $background = _s_get_acf_image( $photo['ID'], 'large', true );
                $style = sprintf( ' style="background-image: url(%s);"', $background );
                $items .= sprintf( '<div class="%s"><div class="background"%s></div></div>', $photo_classes[$key], $style );
            }
                                   
            return sprintf( '<div class="photo-grid clearfix">%s</div>', $items );   
        }
        
    }
}
   
new Page_Builder_Community_Section;
