<?php

if ( ! function_exists( 'educator_edge_map_post_audio_meta' ) ) {
	function educator_edge_map_post_audio_meta() {
		$audio_post_format_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'educator' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'educator' ),
				'description'   => esc_html__( 'Choose audio type', 'educator' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'educator' ),
					'self'            => esc_html__( 'Self Hosted', 'educator' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#edgt_edgt_audio_self_hosted_container',
						'self'            => '#edgt_edgt_audio_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#edgt_edgt_audio_embedded_container',
						'self'            => '#edgt_edgt_audio_self_hosted_container'
					)
				)
			)
		);
		
		$edgt_audio_embedded_container = educator_edge_add_admin_container(
			array(
				'parent'          => $audio_post_format_meta_box,
				'name'            => 'edgt_audio_embedded_container',
				'hidden_property' => 'edgt_audio_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$edgt_audio_self_hosted_container = educator_edge_add_admin_container(
			array(
				'parent'          => $audio_post_format_meta_box,
				'name'            => 'edgt_audio_self_hosted_container',
				'hidden_property' => 'edgt_audio_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'educator' ),
				'description' => esc_html__( 'Enter audio URL', 'educator' ),
				'parent'      => $edgt_audio_embedded_container,
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'educator' ),
				'description' => esc_html__( 'Enter audio link', 'educator' ),
				'parent'      => $edgt_audio_self_hosted_container,
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_post_audio_meta', 23 );
}