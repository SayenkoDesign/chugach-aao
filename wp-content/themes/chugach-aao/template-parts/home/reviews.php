<?php

/*
Logos
		
*/    
    
if( ! class_exists( 'Reviews_Section' ) ) {
    class Reviews_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
            
            $fields = [];
            $fields = get_field( 'reviews' );
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
                     $this->get_name() . '-reviews',
                     $this->get_name() . '-reviews' . '-' . $this->get_id(),
                ]
            );
        }
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
            
            $fields = $this->get_fields();
                                                
            $row = new Element_Row(); 
            
            $column = new Element_Column(); 
                            
            // Header
            $header = new Element_Header( [ 'fields' => $fields ]  ); // set fields from Constructor
            $column->add_child( $header );
            
            $logos = $this->get_logos();
            
            $html = new Element_Html( [ 'fields' => array( 'html' => $logos ) ]  ); // set fields from Constructor
            $column->add_child( $html );
            
            $row->add_child( $column );
            
            $this->add_child( $row );
        }
        
        
        private function get_logos( $featured = false ) {
            
            $logos = $this->get_fields( 'logos');
            
            $columns = $featured_columns = '';
            
            if( ! empty( $logos ) ) {
                
                foreach( $logos as $logo ) {
                    $image = $logo['image'];
                    $url = $logo['url'];
                    $is_featured = empty( $logo['featured'] ) ? '' : $logo['featured'];
                    $image = _s_get_acf_image( $image, 'thumbnail' );
                    $tag = 'span';
                    $this->set_render_attribute( 'anchor', 'href', '' );
                    if( !empty( $url ) ) {
                        $tag = 'a';
                        
                        $this->add_render_attribute( 'anchor', 'href', $url, true );
                        
                        $logo = sprintf( '<div class="column column-block"><div class="logo"><%1$s %2$s>%3$s</%1$s></div></div>', 
                                        $tag, 
                                        $this->get_render_attribute_string( 'anchor' ), 
                                        $image ); 
                        
                        if( $is_featured ) {
                            $featured_columns .= $logo;
                        }
                        else {
                            $columns .= $logo;
                        }
                        
                        
                    }
                    else {
                        $logo = sprintf( '<div class="column column-block"><div class="logo"><%1$s>%2$s</%1$s></div></div>', 
                                        $tag, 
                                        $image );
                        
                        if( $is_featured ) {
                            $featured_columns .= $logo;
                        }
                        else {
                            $columns .= $logo;
                        } 
                    }
                    
                    
                }
                
                $show = $featured ? $featured_columns : $columns;
                $large_columns = $featured ? '' : ' large-up-4';
                
                return sprintf( '<div class="row small-up-1 medium-up-2%s align-middle align-center logos">%s</div>', 
                                $large_columns, $show );
                
            }
        }
    }
}
   
new Reviews_Section;

    