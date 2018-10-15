<?php
// Page Builder - Block

if( ! class_exists( 'Services_Block_Section' ) ) {
    class Services_Block_Section extends Element_Section {
        
        static public $section_count;
        
        public function __construct() {
            parent::__construct();
                                    
            $fields = get_sub_field( 'block' );
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
            
            self::$section_count ++;
    
            $this->add_render_attribute(
                'wrapper', 'class', [
                     $this->get_name() . '-block',
                     $this->get_name() . '-block' . '-' . self::$section_count,
                ]
            );            
            
        } 
        
        public function before_render() {
                            
            $this->add_render_attribute( 'wrap', 'class', 'wrap' );
            
            $fields = $this->get_fields();
            $photo = '';
                        
            if( ! empty( $fields['photo'] ) ) {
                $photo = sprintf( '<div class="photo" style="background-image: url(%s);"></div>', 
                                  _s_get_acf_image( $fields['photo'], 'large', true ) );
                                                  
                $this->add_render_attribute( 'wrapper', 'class', sprintf( 'photo-%s', strtolower( $fields['photo_alignment'] ) ) );
            }
            
            return sprintf( '<%s %s><div %s>%s', 
                            esc_html( $this->get_html_tag() ), 
                            $this->get_render_attribute_string( 'wrapper' ), 
                            $this->get_render_attribute_string( 'wrap' ),
                            $photo
                            );
        }
       
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
                        
            // Set column order            
            if( 'left' == strtolower( $fields['photo_alignment'] ) ) {
                $column_order = [ 'small-order-1 large-order-1', 'small-order-2 large-order-2' ];
            }
            else {
                $column_order = [ 'small-order-1 large-order-2', 'small-order-2 large-order-1' ];
            }
                        
            
                                                                        
            $row = new Element_Row(); 
            $row->add_render_attribute( 'wrapper', 'class', 'align-middle large-unstack' );
                     
            // Photo
            $photo = new Element_Photo( [ 'fields' => $fields ]  );
            // Make sure we have a photo?         
            if( ! empty( $photo->get_element() ) ) {
                $column = new Element_Column(); 
                $column->add_render_attribute( 'wrapper', 'class', [$column_order[0], 'column-block' ] );
                $column->add_child( $photo );
                $row->add_child( $column );
            }
                                            
            $column = new Element_Column(); 
            $column->add_render_attribute( 'wrapper', 'class', [$column_order[1], 'column-block' ] );
            
            // Editor
            $editor = new Element_Editor( [ 'fields' => $fields ] ); // set fields from Constructor
            $column->add_child( $editor );            
            $row->add_child( $column );
            
            $this->add_child( $row ); 
        }
        
    }
}
   
new Services_Block_Section;
