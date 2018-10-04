<?php
// Page Builder - Commitment

if( ! class_exists( 'Page_Builder_Commitment_Section' ) ) {
    class Page_Builder_Commitment_Section extends Element_Section {
        
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
                     $this->get_name() . '-commitment',
                     $this->get_name() . '-commitment' . '-' . $this->get_id(),
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
                                        
            $row = new Element_Row(); 
                     
            $column = new Element_Column(); 
            
            // Editor
            $editor = new Element_Editor( [ 'fields' => $fields ] ); // set fields from Constructor
            $column->add_child( $editor );
            
            $html = new Element_Html( [ 'fields' => [ 'html' => $this->grid() ] ] ); // set fields from Constructor
            $column->add_child( $html );
            
            $row->add_child( $column );
            
            $this->add_child( $row ); 
        }
        
        
        
        private function grid() {
            
            $grid = $this->get_fields( 'grid' );
                                                
            $grid_items = '';
            
            if( ! empty( $grid ) ) {
                
                foreach( $grid as $item ) {
                                        
                    $thumbnail = sprintf( '<span class="column shrink">%s</span>', _s_get_acf_image( $item['grid_image'], 'icon-small' ) );
                                                 
                    $title = _s_format_string( $item['grid_title'], 'h4', [ 'class' => 'column' ] );
                                        
                    $grid_items .= sprintf( '<div class="column column-block"><div class="panel align-middle" data-equalizer-watch>%s%s</div></div>', 
                                     $thumbnail, $title );
                }
            }
            
            return sprintf( '<div class="grid"><div class="row small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="medium">%s</div></div>', $grid_items );   
        }
        
    }
}
   
new Page_Builder_Commitment_Section;
