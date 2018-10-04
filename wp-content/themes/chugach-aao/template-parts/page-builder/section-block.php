<?php
// Page Builder - Block

if( ! class_exists( 'Page_Builder_Block_Section' ) ) {
    class Page_Builder_Block_Section extends Element_Section {
        
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
       
        
        // Add content
        public function render() {
                        
            // Set column order            
            if( 0 == $this->get_id() % 2 ) {
                $column_order = [ 'small-order-1', 'large-order-2' ];
            }
            else {
                $column_order = [ 'small-order-2', 'large-order-1' ];   
            }
                        
            $fields = $this->get_fields();
                                                                        
            $row = new Element_Row(); 
            $row->add_render_attribute( 'wrapper', 'class', 'align-middle large-unstack' );
                     
            // Photo
            $photo = new Element_Photo( [ 'fields' => $fields ]  );
            // Make sure we have a photo?         
            if( ! empty( $photo->get_element() ) ) {
                $column = new Element_Column(); 
                $column->add_render_attribute( 'wrapper', 'class', $column_order[0] );
                $column->add_child( $photo );
                $row->add_child( $column );
            }
                                            
            $column = new Element_Column(); 
            $column->add_render_attribute( 'wrapper', 'class', $column_order[1] );
            
            // Editor
            $editor = new Element_Editor( [ 'fields' => $fields ] ); // set fields from Constructor
            $column->add_child( $editor );            
            $row->add_child( $column );
            
            $this->add_child( $row ); 
        }
        
    }
}
   
new Page_Builder_Block_Section;
