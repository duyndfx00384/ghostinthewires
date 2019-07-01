<?php if(!empty($resume)) { ?>
    <div class="edgt-ts-info-row">
        <span aria-hidden="true" class="icon_document_alt edgt-ts-bio-icon"></span>
        <a href="<?php echo esc_url($resume); ?>" download target="_blank">
                            <span class="edgt-ts-bio-info">
                                <?php echo esc_html__('Download Resume', 'edge-lms'); ?>
                            </span>
        </a>
    </div>
<?php } ?>