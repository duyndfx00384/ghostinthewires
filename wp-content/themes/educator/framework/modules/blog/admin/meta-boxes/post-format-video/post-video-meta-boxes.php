<?php

if ( ! function_exists( 'educator_edge_map_post_video_meta' ) ) {
	function educator_edge_map_post_video_meta() {
		$video_post_format_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'educator' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'educator' ),
				'description'   => esc_html__( 'Choose video type', 'educator' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'educator' ),
					'self'            => esc_html__( 'Self Hosted', 'educator' )
				),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						'social_networks' => '#edgt_edgt_video_self_hosted_container',
						'self'            => '#edgt_edgt_video_embedded_container'
					),
					'show'       => array(
						'social_networks' => '#edgt_edgt_video_embedded_container',
						'self'            => '#edgt_edgt_video_self_hosted_container'
					)
				)
			)
		);
		
		$edgt_video_embedded_container = educator_edge_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'edgt_video_embedded_container',
				'hidden_property' => 'edgt_video_type_meta',
				'hidden_value'    => 'self'
			)
		);
		
		$edgt_video_self_hosted_container = educator_edge_add_admin_container(
			array(
				'parent'          => $video_post_format_meta_box,
				'name'            => 'edgt_video_self_hosted_container',
				'hidden_property' => 'edgt_video_type_meta',
				'hidden_value'    => 'social_networks'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'educator' ),
				'description' => esc_html__( 'Enter Video URL', 'educator' ),
				'parent'      => $edgt_video_embedded_container,
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'educator' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'educator' ),
				'parent'      => $edgt_video_self_hosted_container,
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_post_video_meta', 22 );
}