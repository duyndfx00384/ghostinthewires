<?php
$share_type = isset($share_type) ? $share_type : 'list';
?>
<?php if(educator_edge_options()->getOptionValue('enable_social_share') === 'yes' && educator_edge_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="edgt-blog-share">
        <?php echo educator_edge_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>