<?php
$gallery_classes = '';
$number_of_columns = educator_edge_get_meta_field_intersect('portfolio_single_gallery_columns_number');
if(!empty($number_of_columns)) {
	$gallery_classes .= ' edgt-ps-'.$number_of_columns.'-columns';
}
$space_between_items = educator_edge_get_meta_field_intersect('portfolio_single_gallery_space_between_items');
if(!empty($space_between_items)) {
	$gallery_classes .= ' edgt-ps-'.$space_between_items.'-space';
}
?>
<div class="edgt-grid-row">
	<div class="edgt-grid-col-8">
		<div class="edgt-ps-image-holder edgt-ps-gallery-images <?php echo esc_attr($gallery_classes); ?>">
			<div class="edgt-ps-image-inner">
				<?php
				$media = edgt_core_get_portfolio_single_media();
				
				if(is_array($media) && count($media)) : ?>
					<?php foreach($media as $single_media) : ?>
						<div class="edgt-ps-image">
							<?php edgt_core_get_portfolio_single_media_html($single_media); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="edgt-grid-col-4">
		<div class="edgt-ps-info-holder">
			<?php
            edgt_core_get_cpt_single_module_template_part('templates/single/parts/title', 'portfolio', $item_layout);
			//get portfolio content section
			edgt_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
			
			//get portfolio custom fields section
			edgt_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio categories section
			edgt_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
			
			//get portfolio date section
			edgt_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio tags section
			edgt_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
			
			//get portfolio share section
			edgt_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>