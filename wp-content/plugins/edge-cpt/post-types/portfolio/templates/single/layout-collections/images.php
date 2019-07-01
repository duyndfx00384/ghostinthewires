<div class="edgt-ps-image-holder">
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
<div class="edgt-grid-row">
    <?php edgt_core_get_cpt_single_module_template_part('templates/single/parts/title', 'portfolio', $item_layout); ?>
	<div class="edgt-grid-col-8">
        <?php edgt_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
    </div>
	<div class="edgt-grid-col-4">
        <div class="edgt-ps-info-holder">
            <?php
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