<?php
// Home Intro

if( ! class_exists( 'Home_Services_Section' ) ) {
    class Home_Services_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'services' );
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
                     $this->get_name() . '-services'
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
            
            $services = $this->get_fields( 'services' );
            
            $grid_items = '';
            
            if( ! empty( $services ) ) {
                                
                foreach( $services as $service ) {
                    
                    $title = _s_format_string( $service->post_title, 'h3' );
                    
                    $hero = get_field( 'hero', $service->ID );
                    $icon = $hero['icon'];
                    
                    $thumbnail = sprintf( '<div class="icon">%s</div>', _s_get_acf_image( $icon, 'medium' ) );
                                                         
                    $link = get_permalink( $service->ID );
                    
                    $grid_items .= sprintf( '<div class="column column-block"><a href="%s" class="grid-item">%s<div class="panel" data-equalizer-watch>%s</div></a></div>', 
                                     $link, $thumbnail, $title );
                }
            }
            
            $grid = sprintf( '<div class="grid" data-equalizer data-equalize-on="medium"><div class="row small-up-1 medium-up-2 xlarge-up-3 xxxlarge-up-4">%s</div></div>', $grid_items );
            
            $html = new Element_Html( [ 'fields' => [ 'html' => $grid ] ] ); // set fields from Constructor
            $column->add_child( $html );
                        
            $row->add_child( $column );
            
            $this->add_child( $row );
                                                
            
        }
        
    }
}
   
new Home_Services_Section;
