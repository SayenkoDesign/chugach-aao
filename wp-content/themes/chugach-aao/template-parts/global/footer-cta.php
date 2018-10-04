<?php
// Footer - CTA

if( ! class_exists( 'Footer_CTA_Section' ) ) {
    class Footer_CTA_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
            
            $show_footer_cta = false;

            // default to TRUE for the blog
            if( is_page() && ! is_front_page() ) {
                $show_footer_cta = get_field( 'page_settings_call_to_action' );
            }
            else {
                $show_footer_cta = true;
            }
            
            if( ! $show_footer_cta ) {
                return false;
            }
                        
            $fields = get_field( 'footer_cta', 'option' );
                                                
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
                     $this->get_name() . '-footer-cta'
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
                                       
            $row = new Element_Row(); 
            $row->add_render_attribute( 'wrapper', 'class', 'align-middle text-center' );
            $column = new Element_Column(); 
            $column->add_render_attribute( 'wrapper', 'class', 'column-block' );  
            
                         
            // Editor
            $editor = new Element_Editor( [ 'fields' => $fields ] ); // set fields from Constructor
            $column->add_child( $editor );
            
             // Button
            $button = new Element_Button( [ 'fields' => $fields ]  ); // set fields from Constructor
            $button->add_render_attribute( 'anchor', 'class', [ 'button', 'yellow' ] ); 
            $modal = $fields['modal'];
            $modal_button_text = $fields['modal_button_text'];
            if( ! empty( $modal ) && !empty( $modal_button_text ) ) {
                $button->set_settings( 'url', '#' ); 
                $button->add_render_attribute( 'anchor', 'data-open', 'schedule-appointment' ); 
                $button->set_settings( 'title', $modal_button_text ); 
            }
            $column->add_child( $button );
            
            $row->add_child( $column );
            
            $this->add_child( $row );         
        }
        
    }
}
   
new Footer_CTA_Section;
