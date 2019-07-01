<?php

if(!function_exists('edgt_core_map_testimonials_meta')) {
    function edgt_core_map_testimonials_meta() {
        $testimonial_meta_box = educator_edge_add_meta_box(
            array(
                'scope' => array('testimonials'),
                'title' => esc_html__('Testimonial', 'edge-cpt'),
                'name' => 'testimonial_meta'
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'        	=> 'edgt_testimonial_title',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Title', 'edge-cpt'),
                'description' 	=> esc_html__('Enter testimonial title', 'edge-cpt'),
                'parent'      	=> $testimonial_meta_box,
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'        	=> 'edgt_testimonial_text',
                'type'        	=> 'text',
                'label'       	=> esc_html__('Text', 'edge-cpt'),
                'description' 	=> esc_html__('Enter testimonial text', 'edge-cpt'),
                'parent'      	=> $testimonial_meta_box,
            )
        );
	
	    educator_edge_add_meta_box_field(
		    array(
			    'name'        	=> 'edgt_testimonial_author',
			    'type'        	=> 'text',
			    'label'       	=> esc_html__('Author', 'edge-cpt'),
			    'description' 	=> esc_html__('Enter author name', 'edge-cpt'),
			    'parent'      	=> $testimonial_meta_box,
		    )
	    );
	
	    educator_edge_add_meta_box_field(
		    array(
			    'name'        	=> 'edgt_testimonial_author_position',
			    'type'        	=> 'text',
			    'label'       	=> esc_html__('Author Position', 'edge-cpt'),
			    'description' 	=> esc_html__('Enter author job position', 'edge-cpt'),
			    'parent'      	=> $testimonial_meta_box,
		    )
	    );
    }

    add_action('educator_edge_meta_boxes_map', 'edgt_core_map_testimonials_meta', 95);
}