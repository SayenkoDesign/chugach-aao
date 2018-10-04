<?php

// Service - Content

if( ! class_exists( 'Service_Content_Section' ) ) {
    class Service_Content_Section extends Element_Section {
        
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
                     $this->get_name() . '-content'
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
            
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            
                $content = _s_get_template_part( 'template-parts', 'content-page-no-heading', false, true );
                
                endwhile; //* end of one post
            
            endif; //* end loop

                                                                        
            return $content;
            
        }
        
    }
}
   
new Service_Content_Section;
